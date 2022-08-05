$(window).on("load resize", function (e) {
  $('a[href^="#"]:not([href="#"])').on("click", function (e) {
    var widthwin = $(window).width();
    var headerh = 135;
    if (widthwin < 768) headerh = 75;
    e.preventDefault();
    var target = this.hash,
      $target = $(target),
      pos = $target.offset().top - headerh;
    if ($target.length) $("html, body").stop().animate({ scrollTop: pos }, 800);
  });
});

$(function (e) {
  var widthwin = $(window).width();
  var headerh = 135;
  if (widthwin < 768) headerh = 75;
  var str = location.hash;
  if (str != "" && $(str).length != 0) {
    var n = str.replace("_temp", "");
    var pos = $(n).offset().top - headerh;
    $("html,body").scrollTop(pos);
  }
});
