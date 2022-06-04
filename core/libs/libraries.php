<?php

if(!defined('ABSPATH')){exit;}

/** acf */
if (function_exists('get_fields')) {
    if(HIDE_ACF){
        add_filter('acf/settings/show_admin', '__return_false');
    }
    add_filter('acf/settings/save_json', 'my_acf_json_save_point');
    function my_acf_json_save_point( $path ) {
        // update path
        $path = THEME_PATH . DS . 'core' . DS . 'acf-json';
        // return
        return $path;
    }
    add_filter('acf/settings/load_json', 'my_acf_json_load_point');
    function my_acf_json_load_point( $paths ) {
        // remove original path (optional)
        unset($paths[0]);
        // append path
        $paths[] = THEME_PATH . DS . 'core' . DS . 'acf-json';
        // return
        return $paths;
    }
    // ACF nav menu field
    require_once CORE_PATH . DS . 'libs' . DS . 'acf-nav-menu-field' . DS . 'nav-menu-v5.php';
}

/** timber */
require_once CORE_PATH . DS . 'libs' . DS . 'timber' . DS . 'timber.php';
Timber::$dirname = TIMBER_VIEWS;
