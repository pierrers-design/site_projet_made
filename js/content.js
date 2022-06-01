var numberLoaded = $(".content").find(".loaded").length;

var windowWidth = window.innerWidth;
var windowHeight = window.innerHeight;
var boardWidth = $(".global").width() - windowHeight;
var boardHeight = $(".global").height() - windowHeight;

var colorBoard = $(".grid-below").css("background-color");
var colorBoardToArray = colorBoard.match(/\d+/g);
var Red = colorBoardToArray[0];
var Green = colorBoardToArray[1];
var Blue = colorBoardToArray[2];

// set scrollbar color

// set scale of imgs and videos

$(".page-board").css({ width: numberLoaded * 8 + 100 + "vw", height: numberLoaded * 8 + 100 + "vh" });
$(".background-grid div").css({ width: numberLoaded * 8 + 100 + "vw", height: numberLoaded * 8 + 100 + "vh" });

// set position of images and videos

$(".visual").each(function () {
  $(this).css({ left: Math.floor(Math.random() * boardWidth + 200) + "px", top: Math.floor(Math.random() * boardHeight + 200) + "px", opacity: "1" });
});

$(".article").each(function () {
  $(this).css({ left: Math.floor((Math.random() * windowWidth) / 1.5) + "px", top: Math.floor((Math.random() * windowHeight) / 1.5) + "px", opacity: "1" });
});

// set properties of elements

$(".loaded").draggable({
  containment: ".global",
});

$(".loaded").resizable({
  handles: "ne, nw, se, sw",
  minWidth: 400,
  minHeight: 200,
  containment: ".global",
});

$(".visual").resizable({
  aspectRatio: true,
});

// keep element on top

$(".loaded").on("drag", function () {
  $(this).addClass("top").removeClass("bottom");
  $(this).siblings().removeClass("top").addClass("bottom");
});

$(".loaded").on("resize", function () {
  $(this).addClass("top").removeClass("bottom");
  $(this).siblings().removeClass("top").addClass("bottom");
});

$(".loaded").click(function () {
  $(this).addClass("top").removeClass("bottom");
  $(this).siblings().removeClass("top").addClass("bottom");
});

// map

$("#minimap").css({ width: numberLoaded / 1.2 + 16 + "vw" });

pagemap(document.querySelector("#minimap"), {
  viewport: null,
  styles: {
    ".loaded": "rgba(" + Red + "," + Green + "," + Blue + ",0.64)",
    // ".loaded": "rgba(" + 255 + "," + 255 + "," + 255 + ",0.48)",
  },
  back: "rgba(" + Red + "," + Green + "," + Blue + ",0.16)",
  view: "rgba(" + Red + "," + Green + "," + Blue + ",0.32)",
  drag: "rgba(" + Red + "," + Green + "," + Blue + ",0.48)",
  // back: "rgba(" + Red + "," + Green + "," + Blue + ",1)",
  // view: "rgba(" + 255 + "," + 255 + "," + 255 + ",0.32)",
  // drag: "rgba(" + 255 + "," + 255 + "," + 255 + ",0.48)",
  interval: 16,
});

function map() {
  $("#minimap").css({ opacity: "0" });
}
