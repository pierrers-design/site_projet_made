<?php

/********************************
Simple PHP File Manager
Copyright John Campbell (jcampbell1)

Liscense: MIT
 ********************************/

//Disable error report for undefined superglobals
error_reporting(error_reporting() & ~E_NOTICE);

// must be in UTF-8 or `basename` doesn't work
setlocale(LC_ALL, 'en_US.UTF-8');

$tmp_dir = dirname($_SERVER['SCRIPT_FILENAME']);
if (DIRECTORY_SEPARATOR === '\\') $tmp_dir = str_replace('/', DIRECTORY_SEPARATOR, $tmp_dir);
$tmp = get_absolute_path($tmp_dir . '/' . $_REQUEST['file']);

if ($tmp === false)
	err(404, 'File or Directory Not Found');
if (substr($tmp, 0, strlen($tmp_dir)) !== $tmp_dir)
	err(403, "Forbidden");
if (strpos($_REQUEST['file'], DIRECTORY_SEPARATOR) === 0)
	err(403, "Forbidden");
if (preg_match('@^.+://@', $_REQUEST['file'])) {
	err(403, "Forbidden");
}


if (!$_COOKIE['_sfm_xsrf'])
	setcookie('_sfm_xsrf', bin2hex(openssl_random_pseudo_bytes(16)));
if ($_POST) {
	if ($_COOKIE['_sfm_xsrf'] !== $_POST['xsrf'] || !$_POST['xsrf'])
		err(403, "XSRF Failure");
}

$file = $_REQUEST['file'] ?: '.';

if ($_GET['do'] == 'list') {
	if (is_dir($file)) {
		$directory = $file;
		$result = [];
		$files = array_diff(scandir($directory), ['.', '..']);
		foreach ($files as $entry) {
			$i = $directory . '/' . $entry;
			$stat = stat($i);
			$result[] = [
				'mtime' => $stat['mtime'],
				'size' => $stat['size'],
				'name' => basename($i),
				'path' => preg_replace('@^\./@', '', $i),
				'is_dir' => is_dir($i),
				'is_file' => is_file($i),
				'extension' => pathinfo($i, PATHINFO_EXTENSION)
			];
		}
		usort($result, function ($f1, $f2) {
			$f1_key = ($f1['is_dir'] ?: 2) . $f1['name'];
			$f2_key = ($f2['is_dir'] ?: 2) . $f2['name'];
			return $f1_key > $f2_key;
		});
	} else {
		err(412, "Not a Directory");
	}
	echo json_encode(['success' => true, 'is_writable' => is_writable($file), 'results' => $result]);
	exit;
} elseif ($_GET['do'] == 'download') {
	$filename = basename($file);
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	header('Content-Type: ' . finfo_file($finfo, $file));
	header('Content-Length: ' . filesize($file));
	header(sprintf(
		'Content-Disposition: attachment; filename=%s',
		strpos('MSIE', $_SERVER['HTTP_REFERER']) ? rawurlencode($filename) : "\"$filename\""
	));
	ob_flush();
	readfile($file);
}

// from: http://php.net/manual/en/function.realpath.php#84012
function get_absolute_path($path)
{
	$path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
	$parts = explode(DIRECTORY_SEPARATOR, $path);
	$absolutes = [];
	foreach ($parts as $part) {
		if ('.' == $part) continue;
		if ('..' == $part) {
			array_pop($absolutes);
		} else {
			$absolutes[] = $part;
		}
	}
	return implode(DIRECTORY_SEPARATOR, $absolutes);
}

function err($code, $msg)
{
	http_response_code($code);
	header("Content-Type: application/json");
	echo json_encode(['error' => ['code' => intval($code), 'msg' => $msg]]);
	exit;
}

function asBytes($ini_v)
{
	$ini_v = trim($ini_v);
	$s = ['g' => 1 << 30, 'm' => 1 << 20, 'k' => 1 << 10];
	return intval($ini_v) * ($s[strtolower(substr($ini_v, -1))] ?: 1);
}
$MAX_UPLOAD_SIZE = min(asBytes(ini_get('post_max_size')), asBytes(ini_get('upload_max_filesize')));
?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="../../../../../style/normalize.css">
	<link rel="stylesheet" href="../../../../../style/style.css">
	<script src="../../../../../libraries/jquery.min.js"></script>
	<script>
		(function($) {
			$.fn.tablesorter = function() {
				var $table = this;
				this.find('th').click(function() {
					var idx = $(this).index();
					var direction = $(this).hasClass('sort_asc');
					$table.tablesortby(idx, direction);
				});
				return this;
			};
			$.fn.tablesortby = function(idx, direction) {
				var $rows = this.find('tbody tr');

				function elementToVal(a) {
					var $a_elem = $(a).find('td:nth-child(' + (idx + 1) + ')');
					var a_val = $a_elem.attr('data-sort') || $a_elem.text();
					return (a_val == parseInt(a_val) ? parseInt(a_val) : a_val);
				}
				$rows.sort(function(a, b) {
					var a_val = elementToVal(a),
						b_val = elementToVal(b);
					return (a_val > b_val ? 1 : (a_val == b_val ? 0 : -1)) * (direction ? 1 : -1);
				})
				this.find('th').removeClass('sort_asc sort_desc');
				$(this).find('thead th:nth-child(' + (idx + 1) + ')').addClass(direction ? 'sort_desc' : 'sort_asc');
				for (var i = 0; i < $rows.length; i++)
					this.append($rows[i]);
				this.settablesortmarkers();
				return this;
			}
			$.fn.retablesort = function() {
				var $e = this.find('thead th.sort_asc, thead th.sort_desc');
				if ($e.length)
					this.tablesortby($e.index(), $e.hasClass('sort_desc'));

				return this;
			}
			$.fn.settablesortmarkers = function() {
				this.find('thead th span.indicator').remove();
				return this;
			}
		})(jQuery);
		$(function() {
			var XSRF = (document.cookie.match('(^|; )_sfm_xsrf=([^;]*)') || 0)[2];
			var MAX_UPLOAD_SIZE = <?php echo $MAX_UPLOAD_SIZE ?>;
			var $tbody = $('#list');
			$(window).on('hashchange', list).trigger('hashchange');
			$('#table').tablesorter();

			$('#table').on('click', '.delete', function(data) {
				$.post("", {
					'do': 'delete',
					file: $(this).attr('data-file'),
					xsrf: XSRF
				}, function(response) {
					list();
				}, 'json');
				return false;
			});

			$('#mkdir').submit(function(e) {
				var hashval = decodeURIComponent(window.location.hash.substr(1)),
					$dir = $(this).find('[name=name]');
				e.preventDefault();
				$dir.val().length && $.post('?', {
					'do': 'mkdir',
					name: $dir.val(),
					xsrf: XSRF,
					file: hashval
				}, function(data) {
					list();
				}, 'json');
				$dir.val('');
				return false;
			});

			function list() {
				var hashval = window.location.hash.substr(1);
				$.get('?do=list&file=' + hashval, function(data) {
					$tbody.empty();
					$('#breadcrumb').empty().html(renderBreadcrumbs(hashval));
					if (data.success) {
						$.each(data.results, function(k, v) {
							$tbody.append(renderFileRow(v));
						});
						!data.results.length && $tbody.append('<div class="empty"><p>Ce dossier est vide :(<p><div>')
						data.is_writable ? $('body').removeClass('no_write') : $('body').addClass('no_write');
					} else {
						console.warn(data.error.msg);
					}
					$('#table').retablesort();
				}, 'json');
			}

			function renderFileRow(data) {
				const imgExt = ["png", "jpg", "gif", "jpeg", "JPEG", "webp"];
				const vidExt = ["mp4", "webm", "mov"];
				const nopeExt = ["php"];
				var linkFolder = $('<a class="name" />')
					.attr('href', data.is_dir ? '#' + encodeURIComponent(data.path) : './' + data.path)
					.text(data.name).append('<img class="folderIcon" src="../../../../../import/folder.min.svg">');
				var linkExtFile = $('<a class="name" target="_blank" />')
					.attr('href', data.is_dir ? '#' + encodeURIComponent(data.path) : './' + data.path)
					.text(data.name).append('<img class="fileIcon" src="../../../../../import/file.min.svg">');
				var linkExtImg = $('<a class="name" target="_blank" />')
					.attr('href', data.is_dir ? '#' + encodeURIComponent(data.path) : './' + data.path)
					.text(data.name).append($('<img class="thumbnail">').attr('src', data.is_dir ? '#' + encodeURIComponent(data.path) : './' + data.path));
				var linkExtVid = $('<a class="name" target="_blank" />')
					.attr('href', data.is_dir ? '#' + encodeURIComponent(data.path) : './' + data.path)
					.text(data.name).append($('<video class="thumbnail">').attr('src', data.is_dir ? '#' + encodeURIComponent(data.path) : './' + data.path));
				var $dl_link = $('<a/>').attr('href', '?do=download&file=' + encodeURIComponent(data.path))
					.addClass('download').text('↓');
				var perms = [];

				// directory
				if (data.is_dir == true) {
					var $html = $('<tr />')
						.addClass('is_dir')
						.append($('<td class="first-column" />').append(linkFolder))
						.append($('<td/>').attr('data-sort', data.is_dir ? -1 : data.size)
							.html($('<span class="data-infos data-size" />').text(formatFileSize(data.size))))
						.append($('<td/>').attr('data-sort', data.mtime).html($('<span class="data-infos" />').text(formatTimestamp(data.mtime))))
						.append($('<td/>').append($dl_link))
					return $html;
				}

				// basic file
				if ((data.is_file == true) && !(imgExt.includes(data.extension) || vidExt.includes(data.extension) || nopeExt.includes(data.extension))) {
					var $html = $('<tr />')
						.addClass('is_file')
						.append($('<td class="first-column" />').append(linkExtFile))
						.append($('<td/>').attr('data-sort', data.is_dir ? -1 : data.size)
							.html($('<span class="data-infos" />').text(formatFileSize(data.size))))
						.append($('<td/>').attr('data-sort', data.mtime).html($('<span class="data-infos" />').text(formatTimestamp(data.mtime))))
						.append($('<td/>').append($dl_link).append(data.is_deleteable ? $delete_link : ''))
					return $html;
				}

				// image file
				if ((data.is_file == true) && (imgExt.includes(data.extension))) {
					var $html = $('<tr />')
						.addClass('is_file')
						.append($('<td class="first-column table-image" />').append(linkExtImg))
						.append($('<td/>').attr('data-sort', data.is_dir ? -1 : data.size)
							.html($('<span class="data-infos" />').text(formatFileSize(data.size))))
						.append($('<td/>').attr('data-sort', data.mtime).html($('<span class="data-infos" />').text(formatTimestamp(data.mtime))))
						.append($('<td/>').append($dl_link).append(data.is_deleteable ? $delete_link : ''))
					return $html;
				}

				// video file
				if ((data.is_file == true) && (vidExt.includes(data.extension))) {
					var $html = $('<tr />')
						.addClass('is_file')
						.append($('<td class="first-column table-image" />').append(linkExtVid))
						.append($('<td/>').attr('data-sort', data.is_dir ? -1 : data.size)
							.html($('<span class="data-infos" />').text(formatFileSize(data.size))))
						.append($('<td/>').attr('data-sort', data.mtime).html($('<span class="data-infos" />').text(formatTimestamp(data.mtime))))
						.append($('<td/>').append($dl_link).append(data.is_deleteable ? $delete_link : ''))
					return $html;
				}
			}

			function renderBreadcrumbs(path) {
				var base = "",
					$html = $('<div/>').append($('<a href=#>global</a></div>'));
				$.each(path.split('%2F'), function(k, v) {
					if (v) {
						var v_as_text = decodeURIComponent(v);
						$html.append($('<span/>').text(' -> '))
							.append($('<a/>').attr('href', '#' + base + v).text(v_as_text));
						base += v + '%2F';
					}
				});
				return $html;
			}

			function formatTimestamp(unix_timestamp) {
				var m = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
				var d = new Date(unix_timestamp * 1000);
				return [d.getDate(), ' ', m[d.getMonth()], ' ', d.getFullYear(), " "].join('');
			}

			function formatFileSize(bytes) {
				var s = ['bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB'];
				for (var pos = 0; bytes >= 1000; pos++, bytes /= 1024);
				var d = Math.round(bytes * 10);
				return pos ? [parseInt(d / 10), ".", d % 10, " ", s[pos]].join('') : bytes + ' bytes';
			}
		})
	</script>
</head>

<body>
	<div class="container-explorer page-maker">
		<div id="top">
			<div id="breadcrumb"></div>
		</div>
		<table cellspacing="0" id="table">
			<thead>
				<tr>
					<th>NOM</th>
					<th>TAILLE</th>
					<th>DATE</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="list">

			</tbody>
		</table>
	</div>
</body>

</html>