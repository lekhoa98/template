<?php
function my_custom_media_post_type() {
  register_post_type('media', array (
    'labels'                  => array (
      'name'                  => __( 'メディア' ),
      'singular_name'         => __( 'メディア' ),
      'add_new'               => __( '新しくメディアを書く' ),
      'add_new_item'          => __( 'メディア記事を書く' ),
      'edit_item'             => __( 'メディア記事を編集' ),
      'new_item'              => __( '新しいメディア記事' ),
      'view_item'             => __( 'メディア記事を見る' ),
      'search_staff'          => __( 'メディア記事を探す' ),
      'not_found'             => __( 'メディア記事はありません' ),
      'not_found_in_trash'    => __( 'ゴミ箱にメディア記事はありません' ),
      'parent_item_colon'     => ''
    ),
    'public'                  => true,
    'rewrite'                 => true,
    'show_ui'                 => true,
    'supports'                => array ( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
    'query_var'               => true,
    'menu_icon'               => 'dashicons-welcome-write-blog',
    'has_archive'             => true,
    'hierarchical'            => false,
    'menu_position'           => 5,
    'capability_type'         => 'post',
    'show_in_admin_bar'       => true,
    'publicly_queryable'      => true,
  ));
}
add_action ( 'init', 'my_custom_media_post_type' );