handleGoogleFontLoader();
$(function () {
  // DOCUMENT READY
  // gNaviHover();
});
$(".hamburger").click(function(){
  $(this).toggleClass("active");
  if($(this).hasClass("active")===true)
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