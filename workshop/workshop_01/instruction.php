<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../style/normalize.css" />
  <link rel="stylesheet" href="../../style/interface.css" />
  <link rel="stylesheet" href="../../style/style.css" />
  <script src="https://unpkg.com/pagedjs/dist/paged.polyfill.js"></script>
  <title>Document</title>
</head>

<body class="page-workshop">
  <div class="global page-board">
    <article>

      <?php
      require_once "instruction/content_instruction.php";
      ?>

    </article>
  </div>
  <script src="../../libraries/jquery.min.js"></script>
  <script src="../../libraries/jquery-ui.min.js"></script>
  <script type="module" src="../../js/script.js"></script>
  <script>
    $(document).ready(function() {
      setTimeout('window.print();', 500);
    });
  </script>
</body>

</html>