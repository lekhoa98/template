<?php
if (!function_exists('createSVG')) {
  function createSVG($w = "", $h = "")
  {
    if (is_numeric($w) && is_numeric($h) && $w > 0 && $h > 0) {
      $enc = base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ' . $w . ' ' . $h . '"></svg>');
      return 'data:image/svg+xml;base64,' . $enc;
    }
  }
}

// Canonical check for SEO
$hasParam = strpos($globalCanonical, '?');
$isValidParamsCanonical = false;
if ($hasParam) {
  $regexUrlParam = '/(?:\?|\&)(?:(paged=|pages=|page=|s=))(?:\:?)/i';
  preg_match_all($regexUrlParam, $globalCanonical, $urlParams);
  if (empty(array_filter($urlParams))) $globalCanonical = substr($globalCanonical, 0, $hasParam);
  else $isValidParamsCanonical = true;
}
$thisCanonical = (!empty($thisCanonical)) ? $thisCanonical : $globalCanonical;
if (substr($thisCanonical, -1) != '/') $thisCanonical .= '/';
if ($isValidParamsCanonical) $thisCanonical = rtrim($thisCanonical, "/");
