<?php
function my_custom_download_post_type() {
  register_post_type('download', array (
    'labels'                  => array (
      'name'                  => __( 'ダウンロード' ),
      'singular_name'         => __( 'ダウンロード' ),
      'add_new'               => __( '新しくダウンロードを書く' ),
      'add_new_item'          => __( 'ダウンロード記事を書く' ),
      'edit_item'             => __( 'ダウンロード記事を編集' ),
      'new_item'              => __( '新しいダウンロード記事' ),
      'view_item'             => __( 'ダウンロード記事を見る' ),
      'search_staff'          => __( 'ダウンロード記事を探す' ),
      'not_found'             => __( 'ダウンロード記事はありません' ),
      'not_found_in_trash'    => __( 'ゴミ箱にダウンロード記事はありません' ),
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
add_action ( 'init', 'my_custom_download_post_type' );