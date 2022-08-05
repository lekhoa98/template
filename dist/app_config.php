<?php
if (!defined("ABSPATH")) {
  // date_default_timezone_set('Asia/Ho_Chi_Minh'); // For Vietnam
  date_default_timezone_set('Asia/Tokyo'); // For Japan
}

$dist = '';
// get protocol.
$url = $_SERVER['HTTP_HOST'] . '/' . $dist;
$protocol = (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') || !empty($_SERVER["HTTPS"]) ? 'https://' : 'http://';

// Get dist folder.
$script_name = str_replace($_SERVER['QUERY_STRING'], '', $_SERVER['SCRIPT_NAME']);
$script_filename = str_replace(dirname(__FILE__), '', str_replace('private_html', 'public_html', $_SERVER['SCRIPT_FILENAME']));
$dist = trim(str_replace($script_filename, '', $script_name), "/");
if (!empty($dist)) $dist .= '/';
if (strpos($dist, ".php") !== false || strpos($dist, ".html") !== false || strpos($dist, ".htm") !== false) $dist = "";

// get host.
$app_url = $protocol . $_SERVER['HTTP_HOST'] . '/' . $dist;
define('APP_URL', $app_url);
define('APP_PATH', dirname(__FILE__) . '/');
define('APP_ASSETS', APP_URL . 'assets/');

define('GOOGLE_MAP_API_KEY', '');
define('GOOGLE_RECAPTCHA_KEY_API', '');
define('GOOGLE_RECAPTCHA_KEY_SECRET', '');

define('SMTP_ENABLED', false);
define('SMTP_DEBUG', 1);
define('SMTP_AUTH', true);
define('SMTP_SECURE', 'tls');
define('SMTP_HOST', "smtp.gmail.com");
define('SMTP_PORT', 587);
define('SMTP_USERNAME', "vntesthatch@gmail.com");
define('SMTP_PASSWORD', "cwipawnbkvszeprj");

/* email list for forms */
//contact
$aMailtoContact = array('alivetestmail@alive-web.co.jp');
$aBccToContact = array('vntesttongali@gmail.com', 'vntesthatch@gmail.com', 'alivevn.test.volcano@gmail.com');
$fromContact = "alivetestmail@alive-web.co.jp";
$fromName = "Company name";
