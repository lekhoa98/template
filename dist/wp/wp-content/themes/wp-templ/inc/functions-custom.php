<?php
// COMMON FUNCTIONS
function get_first_image($cnt, $noimg = true)
{
  $first_img = '';
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/Ui', $cnt, $matches);
  if (!empty($matches) && !empty($matches[1])) {
    for ($i = 0; $i <= 10; $i++) {
      $first_img = $matches[1][$i];
      $ext = substr($first_img, strrpos($first_img, '.') + 1);
      if (($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'bmp' || $ext == 'webb' || $ext == 'gif' || $ext == 'svg') && strpos($first_img, 'file://') === false) return $first_img;
    }
  }
  if ((empty($first_img) || $first_img == "") && $noimg) $first_img = APP_URL . "assets/img/common/other/img_nophoto.jpg";
  elseif (empty($noimg)) return false;
  return $first_img;
}
function get_post_image($postObj = null, $size = 'medium')
{
  global $post;
  if (!empty($postObj)) $post = $postObj;
  $image = wp_get_attachment_image_src(get_post_thumbnail_id(), $size);
  $image_content = get_first_image($post->post_content);
  $img_url = !empty($image) ? $image[0] : $image_content;
  return $img_url;
}

function cutString($str, $len, $moreStr = "...")
{
  $mystr = "";
  $str = strip_tags($str);
  $str = preg_replace('/\r\n|\n|\r|[[\/\!]*?[^\[\]]*?]|si/', '', $str);
  if (mb_strlen($str) > $len) {
    $newstr = mb_substr($str, 0, $len);
    $mystr = $newstr . $moreStr;
  } else $mystr = $str;
  return $mystr;
}

function curPageURL()
{
  $pageURL = 'http';
  if (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") $pageURL .= "s";
  $pageURL .= "://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
  return $pageURL;
}
$current_url = curPageURL();

function get_curl($url)
{
  if (function_exists('curl_init')) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    $output = curl_exec($ch);
    echo curl_error($ch);
    curl_close($ch);
    return $output;
  } else return file_get_contents($url);
}
// END COMMON FUNCTIONS

// FIX MISSED SCHEDULE TESTED UP TO 6.0.1
add_action('wp_head', 'wpcs_publish_scheduled_posts');
function wpcs_publish_scheduled_posts()
{
  if (is_front_page() || is_single()) {
    global $wpdb;
    $now = gmdate('Y-m-d H:i:00');

    $post_types = get_post_types(array(
      'public'                => true,
      'exclude_from_search'   => false,
      '_builtin'              => false
    ), 'names', 'and');
    $str = implode('\',\'', $post_types);

    if ($str) $sql = "Select ID from $wpdb->posts WHERE post_type in ('post','page','$str') AND post_status='future' AND post_date_gmt<'$now'";
    else  $sql = "Select ID from $wpdb->posts WHERE post_type in ('post','page') AND post_status='future' AND post_date_gmt<'$now'";

    $resulto = $wpdb->get_results($sql);
    if ($resulto) foreach ($resulto as $thisarr) wp_publish_post($thisarr->ID);
  }
}
