<?php

if(!defined('ABSPATH')){exit;}

/**
 * Clear transients cache
 */
function my_acf_update_value( $value, $post_id, $field  ) {

    if (strpos($post_id, 'options') !== false) {
        delete_transient( 'general_fields'.LANG_SUFFIX );
    } elseif ($post_id && get_post_type( $post_id ) == "page" && $post_id == PAGE_ON_FRONT){
        delete_transient( 'front_fields'.LANG_SUFFIX );
        delete_transient( 'custom_page_' . $post_id . '_fields'.LANG_SUFFIX );
    } elseif ($post_id && get_post_type( $post_id ) == "page" && $post_id != PAGE_ON_FRONT && $post_id != PAGE_FOR_POSTS){
        delete_transient( 'custom_page_' . $post_id . '_fields'.LANG_SUFFIX );
    } elseif ($post_id && get_post_type( $post_id ) == "post" && $post_id != PAGE_ON_FRONT && $post_id != PAGE_FOR_POSTS){
        delete_transient( 'custom_page_' . $post_id . '_fields'.LANG_SUFFIX );
        delete_transient( 'blog_fields'.LANG_SUFFIX );
    } elseif ($post_id == PAGE_FOR_POSTS){
        delete_transient( 'blog_fields'.LANG_SUFFIX );
    }

    delete_transient( 'header_css' );
    delete_transient( 'footer_js' );

	return $value;
}
add_filter('acf/update_value', 'my_acf_update_value', 10, 3);

/**
 * Clear menus cache
 */
function clear_nav_menus_cache(){
    delete_transient( 'general_fields'.LANG_SUFFIX );
    delete_transient( 'blog_fields'.LANG_SUFFIX );
    delete_transient( 'front_fields'.LANG_SUFFIX );
}
add_action('wp_update_nav_menu', 'clear_nav_menus_cache');
