<?php

if(!defined('ABSPATH')){exit;}

/** ACF */
if (function_exists('get_fields')) {
    if(HIDE_ACF){
        add_filter('acf/settings/show_admin', '__return_false');
    }
    add_filter('acf/settings/save_json', 'my_acf_json_save_point');
    function my_acf_json_save_point( $path ) {
        // update path
        $path = THEME_PATH . '/core/json-acf';
        // return
        return $path;
    }
    add_filter('acf/settings/load_json', 'my_acf_json_load_point');
    function my_acf_json_load_point( $paths ) {
        // remove original path (optional)
        unset($paths[0]);
        // append path
        $paths[] = THEME_PATH . '/core/json-acf';
        // return
        return $paths;
    }
    // ACF nav menu field
    require_once CORE_PATH . '/libs/acf-nav-menu-field/nav-menu-v5.php';
	// Options page for ACF
    acf_add_options_sub_page(array(
        'page_title'  => __('Options', TEXTDOMAIN),
        'menu_title'  => __('Options', TEXTDOMAIN),
        'slug' => 'options',
        'parent_slug' => 'themes.php',
    ));
}

/** Timber */
require_once CORE_PATH . '/libs/timber/timber.php';
Timber::$dirname = TIMBER_VIEWS;
