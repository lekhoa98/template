<?php
// below constant should be defined into wp-config.php file.
// define('WP_POST_REVISIONS', 10);
// define('AUTOSAVE_INTERVAL', 300);

// FOR ONCA PROJECTS
// ▼▼▼▼▼ START disable manual upgrade wordpress ▼▼▼▼▼
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);
remove_action('load-update-core.php', 'wp_update_plugins');
function remove_core_updates()
{
  global $wp_version;
  return (object) array('last_checked' => time(), 'version_checked' => $wp_version,);
}
add_filter('pre_site_transient_update_core', 'remove_core_updates');
add_filter('pre_site_transient_update_plugins', 'remove_core_updates');
add_filter('pre_site_transient_update_themes', 'remove_core_updates');
// ▲▲▲▲▲ FINISH disable manual upgrade wordpress ▲▲▲▲▲

add_filter('automatic_updater_disabled', '__return_true');
add_filter('auto_update_core', '__return_false');
add_filter('auto_update_plugin', '__return_false');
add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'rsd_link');
function disable_self_trackback(&$links)
{
  foreach ($links as $l => $link)
    if (0 === strpos($link, get_option('home')))
      unset($links[$l]);
}
add_action('pre_ping', 'disable_self_trackback');
function disable_wp_head_default()
{
  // all actions related to emojis
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
  remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
  remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
  remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
  remove_action('wp_head', 'index_rel_link'); // index link
  remove_action('wp_head', 'parent_post_rel_link', 10, 0); // prev link
  remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
  remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
  remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
  remove_action('wp_head', 'wp_resource_hints', 2);
  remove_action('wp_head', 'rest_output_link_wp_head');
  remove_action('wp_head', 'wp_shortlink_wp_head'); // remove linkn rel shortlink
  add_filter('show_admin_bar', '__return_false');
}
add_action('init', 'disable_wp_head_default');
function alive_remove_menu_pages()
{
  remove_menu_page('edit-comments.php');
  remove_menu_page('edit.php');
}
add_action('admin_menu', 'alive_remove_menu_pages');
if (!defined('APP_URL')) include_once(dirname(ABSPATH) . "/app_config.php");
include_once(TEMPLATEPATH . '/inc/post-type-init.php');

define('THEME_DIR', get_template_directory_uri());

// Disable Gutenberg
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);

//login logo
function custom_login_logo()
{
  echo '<style type="text/css">h1 a { background: url(' . get_bloginfo('template_directory') . '/images/logo.png) 50% 50% no-repeat !important; width:100% !important;}</style>';
}
add_action('login_head', 'custom_login_logo');

// Remove "Thank you for creating with WordPress"
function remove_footer_admin()
{
  return '';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// Update CSS within in Admin
function admin_style()
{
  wp_enqueue_style('admin-styles', get_template_directory_uri() . '/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');
function my_enqueue($hook)
{
  wp_enqueue_script('my_custom_script', get_template_directory_uri() . '/admin.js');
}
add_action('admin_enqueue_scripts', 'my_enqueue');

// link for logo
function new_wp_login_url()
{
  return home_url();
}
add_filter('login_headerurl', 'new_wp_login_url');

// title for logo
function new_wp_login_title()
{
  return get_option('blogname');
}
add_filter('login_headertitle', 'new_wp_login_title');

// Theme support
add_theme_support('post-thumbnails');

// Images size
function set_default_image_size()
{
  update_option('thumbnail_size_w', 300);
  update_option('thumbnail_size_h', 300);
  update_option('thumbnail_crop', 0);
  update_option('medium_size_w', 750);
  update_option('medium_size_h', 750);
}
add_action('init', 'set_default_image_size');

// paging
function my_option_posts_per_page()
{
  return 0;
}
function my_modify_posts_per_page()
{
  add_filter('option_posts_per_page', 'my_option_posts_per_page');
}
add_action('init', 'my_modify_posts_per_page', 0);

function wp_post_type_archive($options)
{
  global $wpdb;

  $post_type         = (!empty($options['post_type']))         ? $options['post_type']         : 'post';
  $home_url          = (!empty($options['home_url']))          ? $options['home_url']          : '';
  $have_count        = (!empty($options['have_count']))        ? $options['have_count']        : false;
  $add_zero_in_month = (!empty($options['add_zero_in_month'])) ? $options['add_zero_in_month'] : false;
  $add_zero_in_count = (!empty($options['add_zero_in_count'])) ? $options['add_zero_in_count'] : false;

  if ($home_url == "") $home_url  = home_url("/");
  $html = '';
  $txtCount = "";
  $posttype = get_post_type_object($post_type);
  $slug = $posttype->rewrite['slug'];
  $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date)
    FROM $wpdb->posts WHERE post_status = 'publish'
    AND post_type = '{$post_type}' ORDER BY post_date DESC");

  foreach ($years as $year) :
    if ($have_count) {
      $count = $wpdb->get_col("SELECT COUNT(*) countpost
        FROM $wpdb->posts WHERE post_status = 'publish'
        AND post_type = '{$post_type}' and YEAR(post_date) = '" . $year . "'");
      $txtCount = (!empty($add_zero_in_count)) ? '(' . sprintf("%02d", $count[0]) . ')' : '(' . $count[0] . ')';
    }
    $html .= '<li id="year' . $year . '"><a href="javascript:void(0);" class="dropdown">' . $year . '年 ' . $txtCount . '</a><ul class="sub">';

    $months = $wpdb->get_col("SELECT DISTINCT MONTH(post_date)
      FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = '{$post_type}'
      AND YEAR(post_date) = '" . $year . "' ORDER BY post_date DESC");

    foreach ($months as $month) :
      if ($have_count) {
        $count = $wpdb->get_col("SELECT COUNT(*) countpost
          FROM $wpdb->posts WHERE post_status = 'publish'
          AND post_type = '{$post_type}' and YEAR(post_date) = '" . $year . "' and MONTH(post_date) = '" . $month . "'");
        $txtCount = (!empty($add_zero_in_count)) ? '(' . sprintf("%02d", $count[0]) . ')' : '(' . $count[0] . ')';
      }
      $txtMonth = (!empty($add_zero_in_month)) ? sprintf("%02d", $month) : $month;
      $html .= '<li><a href="' . $home_url . $slug . "/" . $year . '/' . $month . '">' . $txtMonth . '月 ' . $txtCount . '</a></li>';
    endforeach;
    $html .= '</ul></li>';
  endforeach;
  return $html;
}

// for rewrite - this is alway at bottom of page
add_filter('post_type_link', 'custom_blog_permalink', 1, 3);
function custom_blog_permalink($post_link, $id = 0, $leavename)
{
  if (strpos('%post_id%', $post_link) === 'FALSE') {
    return $post_link;
  }
  $post = get_post($id);
  if (is_wp_error($post)) {
    return $post_link;
  }
  $post_type = get_post_type_object($post->post_type);
  return home_url($post_type->rewrite['slug'] . '/p' . $post->ID . '/');
}
function add_rewrites_init()
{
  global $wp_rewrite;
  $postoj =  get_post_types('', 'object');
  foreach ($postoj as $key => $ar) {
    $posttype = $ar->name;
    $slug = $ar->rewrite['slug'];
    $sgc = get_template_directory() . "/single-" . $posttype . ".php";
    $agr = get_template_directory() . "/archive-" . $posttype . ".php";
    if (@file_exists($sgc)) {
      add_rewrite_rule($slug . '/p([0-9]+)?$', 'index.php?post_type=' . $posttype . '&p=$matches[1]', 'top');
      add_rewrite_rule($slug . '/p([0-9]+)?/confirm/?', 'index.php?post_type=' . $posttype . '&p=$matches[1]&actionFlag=confirm', 'top');
      add_rewrite_rule($slug . '/p([0-9]+)?/complete/?', 'index.php?post_type=' . $posttype . '&p=$matches[1]&actionFlag=complete', 'top');
      add_rewrite_rule($slug . '/p([0-9]+)?/([0-9]+)/?', 'index.php?post_type=' . $posttype . '&p=$matches[1]&page=$matches[2]', 'top');
    }
    if (@file_exists($agr)) {
      add_rewrite_rule($slug . '/([0-9]{4})/([0-9]{1,2})/?$', 'index.php?post_type=' . $posttype . '&year=$matches[1]&monthnum=$matches[2]', 'top');
      add_rewrite_rule($slug . '/([0-9]{4})/([0-9]{1,2})/page/([0-9]{1,})/?$', 'index.php?post_type=' . $posttype . '&year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]', 'top');
    }
  }
  $wp_rewrite->flush_rules(false);
}
add_action('init', 'add_rewrites_init');
//end for rewrite - this is alway at bottom of page

// Remove Attachment URL
add_action('parse_request', 'custom_remove_attachment_url');
function custom_remove_attachment_url($wp)
{
  if (array_key_exists('attachment', $wp->query_vars)) unset($wp->query_vars['attachment']);
}

add_filter('query_vars', 'custom_query_vars_filter');
function custom_query_vars_filter($vars)
{
  $vars[] .= 'actionFlag';
  return $vars;
}

// Keep taxonomy hierarchical
add_filter('wp_terms_checklist_args', 'keep_taxonomy_hierarchical', 10, 2);
function keep_taxonomy_hierarchical($args, $idPost)
{
  $args['checked_ontop'] = false;
  return $args;
}

// remove css WP 5
function smartwp_remove_wp_block_library_css()
{
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
}
add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css');

// Disable auto redirect with same post_name
remove_action('template_redirect', 'redirect_canonical');
