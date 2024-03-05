<?php

if(!defined('ABSPATH')){exit;}

if (class_exists('ACF')) {
    if(get_option('hide_acf')){
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
    // Options page for ACF
    $sub_page = array(
        'title' => __("Framework", TEXTDOMAIN),
        'slug' => 'options',
        'capability' => 'edit_posts',
        'position'   => 30,
        'icon_url'   => TEMPLATE_DIRECTORY_URL . 'assets/svg/favicon.svg'
    );
    acf_add_options_page($sub_page);
    // Main label for ACF options pages
    acf_set_options_page_menu(__("Framework", TEXTDOMAIN));
    acf_set_options_page_title( __("Framework", TEXTDOMAIN) );
}
