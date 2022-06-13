// menu index

function displayMenu() {
  $(".menu").css({ transition: "left 0.8s cubic-bezier(0.2, 0.4, 0.2, 1), top 0.8s cubic-bezier(0.2, 0.4, 0.2, 1)" });
  $(".menu").css({ left: "calc(" + -$(".menu").width() + "px + 100vw - var(--margin-small) * 2" });
  $(".menu .arrow-rotate").css({ transform: "rotate(0deg)" });
}

function hideMenu() {
  $(".menu").css({ transition: "left 0.8s cubic-bezier(0.2, 0.4, 0.2, 1), top 0.8s cubic-bezier(0.2, 0.4, 0.2, 1)" });
  $(".menu").css({ left: "100vw" });
  $(".menu .arrow-rotate").css({ transform: "rotate(180deg)" });
}

// article

var transitionArticle = $(".container-article").css({
  transition: "left 0.8s cubic-bezier(0.2, 0.4, 0.2, 1), margin 0.8s ease-in-out, width 0.8s ease-in-out, height 0.8s ease-in-out",
});
var articleFull = false;

//display
$(".navigation-bottom-l").click(function () {
  transitionArticle;
  $(".container-article").css({ left: "0" });
  $(".container-article .arrow-rotate").css({ transform: "rotate(180deg)" });
});

//hide
$(".close-article .arrow").click(function () {
  transitionArticle;
  $(".container-article").removeClass("fullscreen");
  $(".article").removeClass("article-fullscreen");
  $(".button-fullscreen").css({ transform: "rotate(0deg)" });
  $(".container-article").css({ left: "calc(" + -$(".container-article").width() + "px - var(--margin-small) * 2" });
  $(".container-article .arrow-rotate").css({ transform: "rotate(0deg)" });
  articleFull = false;
});

// fullscreen

$(".close-article .button-fullscreen").click(function () {
  if (articleFull == false) {
    transitionArticle;
    $(".container-article").addClass("fullscreen");
    $(".article").css({ transition: "margin 0.8s ease-in-out, padding 0.8s ease-in-out" });
    $(".article").addClass("article-fullscreen");
    $(".button-fullscreen").css({ transform: "rotate(90deg)" });
    articleFull = true;
  } else {
    transitionArticle;
    $(".container-article").removeClass("fullscreen");
    $(".article").removeClass("article-fullscreen");
    $(".button-fullscreen").css({ transform: "rotate(0deg)" });
    articleFull = false;
  }
});

// button print

var articlePrint = false;

$(".button-print").click(function () {
  if (articlePrint == false) {
    $(".instruction-print").attr("src", "instruction.php");
    $(".instruction-print").css({ display: "block" });
    $(".button-print").text("FERMER");
    articlePrint = true;
  } else {
    $(".instruction-print").attr("src", "");
    $(".instruction-print").css({ display: "none" });
    $(".button-print").text("IMPRIMER");
    articlePrint = false;
  }
});

// set scale of imgs and videos

var numberVisual = $(".content").find(".visual").length;

$(".page-board").css({ width: numberVisual * 8 + 100 + "vw", height: numberVisual * 8 + 100 + "vh" });
$(".background-grid div").css({ width: numberVisual * 8 + 100 + "vw", height: numberVisual * 8 + 100 + "vh" });

// set position of images and videos

var windowWidth = window.innerWidth;
var windowHeight = window.innerHeight;
var boardWidth = $(".page-board").width() - windowHeight;
var boardHeight = $(".page-board").height() - windowHeight;

$(".visual").each(function () {
  $(this).css({ left: Math.floor(Math.random() * boardWidth) + "px", top: Math.floor(Math.random() * boardHeight) + "px", opacity: "1" });
});

// set properties of visuals

$(".visual").draggable({
  containment: ".page-board",
});

$(".visual").resizable({
  handles: "n, s, e, w, ne, nw, se, sw",
  minWidth: 400,
  minHeight: 200,
  containment: ".page-board",
});

$(".visual").resizable({
  aspectRatio: true,
});

// keep visual when hovered on top

$(".visual").on("drag", function () {
  $(this).addClass("top").removeClass("bottom");
  $(this).siblings().removeClass("top").addClass("bottom");
});

$(".visual").on("resize", function () {
  $(this).addClass("top").removeClass("bottom");
  $(this).siblings().removeClass("top").addClass("bottom");
});

$(".visual").click(function () {
  $(this).addClass("top").removeClass("bottom");
  $(this).siblings().removeClass("top").addClass("bottom");
});

// get colors

var colorBoard = $(".background").css("background-color");
var colorBoardToArray = colorBoard.match(/\d+/g);
var Red = colorBoardToArray[0];
var Green = colorBoardToArray[1];
var Blue = colorBoardToArray[2];

// map

var mapWidth = numberVisual / 1.2 + 16;
var mapOpen = true;

// arrow map

$(".open-map").click(function () {
  if (mapOpen == true) {
    $("#minimap").css({ transition: "right 0.8s cubic-bezier(0.2, 0.4, 0.2, 1)" });
    $("#minimap").css({ right: -mapWidth + "vw" });
    $(".open-map .arrow-rotate").css({ transform: "rotate(180deg)" });
    mapOpen = false;
  } else {
    $("#minimap").css({ transition: "right 0.8s cubic-bezier(0.2, 0.4, 0.2, 1)" });
    $("#minimap").css({ right: "0" });
    $(".open-map .arrow-rotate").css({ transform: "rotate(0deg)" });
    mapOpen = true;
  }
});

// map

$("#minimap").css({ width: mapWidth + "vw" });

pagemap(document.querySelector("#minimap"), {
  viewport: null,
  styles: {
    ".visual": "rgba(" + Red + "," + Green + "," + Blue + ",0.64)",
    // ".visual": "rgba(" + 255 + "," + 255 + "," + 255 + ",0.48)",
  },
  back: "rgba(" + Red + "," + Green + "," + Blue + ",0.16)",
  view: "rgba(" + Red + "," + Green + "," + Blue + ",0.32)",
  drag: "rgba(" + Red + "," + Green + "," + Blue + ",0.48)",
  // back: "rgba(" + Red + "," + Green + "," + Blue + ",1)",
  // view: "rgba(" + 255 + "," + 255 + "," + 255 + ",0.32)",
  // drag: "rgba(" + 255 + "," + 255 + "," + 255 + ",0.48)",
  interval: 8,
});
