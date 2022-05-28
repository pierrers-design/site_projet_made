$(".loaded").draggable({
  containment: ".global",
});

$(".loaded").resizable({
  aspectRatio: true,
  handles: "n, e, w, s, ne, nw, se, sw",
});

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

$(".loaded").each(function () {
  var positionX = $(".global").width() * 0.88;
  var positionY = $(".global").height() * 0.64;

  $(this).css({ left: "" + Math.floor(Math.random() * positionX) + "px", top: "" + Math.floor(Math.random() * positionY) + "px" });
  console.log(positionY);
  console.log(positionX);
});
