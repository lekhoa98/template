$(function () {
  // Add rel 'noopener' for a with _blank target to prevent security rish
  $("a")
    .filter('[href^="http"], [href^="//"]')
    .not('[href*="' + window.location.host + '"]')
    .attr("rel", "noopener nofollow")
    .not(".trusted")
    .attr("target", "_blank");
});

// Resize thumbnail box height
function thumbImg(dom, ratio_pc, ratio_sp) {
  if (dom && ratio_pc && ratio_sp && $(dom).length > 0) {
    var ratio = ratio_pc;
    if ($(window).width() < 768) {
      ratio = ratio_sp;
    }
    var h = Math.round($(dom).width() / ratio);
    $(dom).css("height", h).addClass("loaded");
  } else {
    return false;
  }
}

function IEdetection() {
  var ua = window.navigator.userAgent;
  var msie = ua.indexOf("MSIE ");
  if (msie > 0) {
    // IE 10 or older, return version number
    return "IE " + parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)), 10);
  }
  var trident = ua.indexOf("Trident/");
  if (trident > 0) {
    // IE 11, return version number
    var rv = ua.indexOf("rv:");
    return "IE " + parseInt(ua.substring(rv + 3, ua.indexOf(".", rv)), 10);
  }
  var edge = ua.indexOf("Edge/");
  if (edge > 0) {
    //Edge (IE 12+), return version number
    return "IE " + parseInt(ua.substring(edge + 5, ua.indexOf(".", edge)), 10);
  }
  // User uses other browser
  return "Not IE";
}

function handleGoogleFontLoader() {
  (function (d) {
    WebFontConfig = {
      google: {
        families: [
          "Playfair+Display:400",
          "Gentium+Basic:400",
          "Noto+Sans+JP:400,700,900",
          "La+Belle+Auror:400",
          "Oswald:200",
          "Roboto:w400,700&display=swap"
        ],
      },
    };

    var wf = d.createElement("script"),
      s = d.scripts[0];
    wf.src = JS_APP_URL + "assets/js/lib/webfont.min.js";
    wf.async = true;
    wf.defer = true;
    s.parentNode.insertBefore(wf, s);
  })(document);
}
