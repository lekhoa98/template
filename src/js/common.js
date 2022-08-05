handleGoogleFontLoader();
$(function () {
  // DOCUMENT READY
  gNaviHover();
});
$("#hamburger").click(function(){
  $(".hamburger").toggleClass("active");
  if($(".hamburger").hasClass("active"))
  {
    $("#contact").addClass("hidden");
    $("#menu").fadeIn();
  }
  else{
    $("#contact").removeClass("hidden");
    $("#menu").fadeOut();
  }
});
$(window).resize(function () {
  $(".navSub").css("display", "none");
});