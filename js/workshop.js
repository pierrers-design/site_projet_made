var dir = "../../workshop/workshop_01/creations/";
var fileextension = ".png";

$.ajax({
  //This will retrieve the contents of the folder if the folder is configured as 'browsable'
  url: dir,
  success: function (data) {
    //List all .png file names in the page
    $(data)
      .find("a:contains(" + fileextension + ")")
      .each(function () {
        var filename = this.href.replace(dir);
        $(".content").append("<img src='" + filename + "'>");
      });
  },
});

$("img").draggable();
