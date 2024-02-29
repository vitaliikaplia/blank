<?php

if(!defined('ABSPATH')){exit;}

/** custom jquery and other js */
function load_personal_resources() {

    if( !is_admin()){
		wp_deregister_script('jquery');
	}

    wp_register_script('jquery', TEMPLATE_DIRECTORY_URL . 'assets/js/jquery.min.js', '', '3.4.1', true);
    wp_enqueue_script('jquery');
    wp_register_script('plugins', TEMPLATE_DIRECTORY_URL.'assets/js/plugins.min.js', '', ASSETS_VERSION, true);
    wp_enqueue_script('plugins');
    wp_register_script('custom', TEMPLATE_DIRECTORY_URL.'assets/js/custom.min.js', '', ASSETS_VERSION, true);
    wp_enqueue_script('custom');

    wp_register_style('main', TEMPLATE_DIRECTORY_URL . 'assets/css/style.min.css', array(), ASSETS_VERSION, 'all');
    wp_enqueue_style('main');

    if($google_maps_api_key = get_option('google_maps_api_key')){
        wp_register_script('google_maps', '//maps.googleapis.com/maps/api/js?v=3&key='.$google_maps_api_key.'&language='.BLOGINFO_LANGUAGE.'&region='.BLOGINFO_LANGUAGE.'', '', ASSETS_VERSION, true);
        wp_enqueue_script('google_maps');
    }

}
add_action('wp_enqueue_scripts', 'load_personal_resources');
