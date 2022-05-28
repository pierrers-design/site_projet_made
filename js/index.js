function displayMenu() {
  $(".menu").css({ transition: "left 0.8s cubic-bezier(0.2, 0.4, 0.2, 1), top 0.8s cubic-bezier(0.2, 0.4, 0.2, 1)" });
  $(".menu").css({ left: "calc(100vw - calc(" + $(".menu").width() + "px + calc(var(--floating-space) * 2))", top: "0px" });
  $(".arrow-rotate").css({ transform: "rotate(0deg)" });
}

function hideMenu() {
  $(".menu").css({ transition: "left 0.8s cubic-bezier(0.2, 0.4, 0.2, 1), top 0.8s cubic-bezier(0.2, 0.4, 0.2, 1)" });
  $(".menu").css({ left: "100vw", top: "0px" });
  $(".arrow-rotate").css({ transform: "rotate(180deg)" });
}

$(".menu").draggable({
  cancel: "p, h2, h3, h4, h5",
});

$(".menu").on("drag", function () {
  $(".menu").css({ transition: "none" });
});