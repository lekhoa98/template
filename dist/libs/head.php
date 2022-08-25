<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="format-detection" content="telephone=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php
  // set viewport by user agent.
  require_once 'ua.class.php';
  $ua = new UserAgent();
  if ($ua->set() === 'tablet') echo '<meta content="width=1024, shrink-to-fit=no" name="viewport">';
  else echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">';

  $current_url = $globalCanonical = 'http' . (!empty($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
  include(APP_PATH . 'libs/argument.php');
  include(APP_PATH . 'libs/functions.php'); ?>
  <link rel="canonical" href="<?php echo $thisCanonical ?>">
  <script src="<?php echo APP_ASSETS ?>js/ipad.min.js"></script>
  <script>
    if (isIpad()) document.querySelectorAll('meta[name="viewport"]')[0].setAttribute("content", "width=1024, shrink-to-fit=no");
  </script>
  
  <title><?php echo $titlepage ?></title>
  <meta name="description" content="<?php echo $desPage; ?>">
  <meta name="keywords" content="<?php echo $keyPage; ?>">

  <!--facebook-->
  <meta property="og:title" content="<?php echo $titlepage ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo htmlspecialchars($current_url); ?>">
  <meta property="og:image" content="<?php echo (!empty($ogimg)) ? $ogimg : APP_ASSETS . 'img/common/other/fb_image.jpg'; ?>">
  <meta property="og:site_name" content="<?php echo (function_exists('get_bloginfo') && get_bloginfo('name')) ? get_bloginfo('name') : '' ?>">
  <meta property="og:description" content="<?php echo $desPage; ?>">
  <meta property="fb:app_id" content="">
  <!--/facebook-->

  <!-- Twitter -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:url" content="<?php echo htmlspecialchars($current_url); ?>">
  <meta name="twitter:title" content="<?php echo $titlepage ?>">
  <meta name="twitter:description" content="<?php echo $desPage; ?>">
  <meta name="twitter:image" content="<?php echo (!empty($ogimg)) ? $ogimg : APP_ASSETS . 'img/common/other/fb_image.jpg'; ?>">
  <meta name="twitter:site" content="<?php echo (function_exists('get_bloginfo') && get_bloginfo('name')) ? get_bloginfo('name') : '' ?>">
  <meta name="twitter:creator" content="<?php echo (function_exists('get_bloginfo') && get_bloginfo('name')) ? get_bloginfo('name') : '' ?>">
  <!-- /Twitter -->

  <!--css-->
  <link href="<?php echo APP_ASSETS; ?>css/style.min.css" rel="stylesheet" media="all">
  <link href="<?php echo APP_ASSETS; ?>css/custom.css" rel="stylesheet" media="all">
  <!--/css-->

  <!-- Favicons, uncomment out when you get the project's favicon -->
  <!-- <link rel="icon" href="<?php echo APP_ASSETS; ?>img/common/icon/favicon.ico" type="image/vnd.microsoft.icon"> -->

  <?php
  // include_once(APP_PATH.'wp/wp-load.php');
  if (defined('ABSPATH')) wp_head();
  ?>