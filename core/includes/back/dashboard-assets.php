<?php

if(!defined('ABSPATH')){exit;}

/** wp dashboard assets */
function custom_dashboard_assets(){
    wp_register_style( 'custom-dashboard-css', TEMPLATE_DIRECTORY_URL . 'assets/css/dashboard.min.css', false, ASSETS_VERSION);
    wp_enqueue_style( 'custom-dashboard-css' );
    global $pagenow;
    if($pagenow == "index.php"){
        wp_register_script( 'custom-dashboard-js', TEMPLATE_DIRECTORY_URL . 'assets/js/dashboard.min.js', '', ASSETS_VERSION, true);
        wp_enqueue_script( 'custom-dashboard-js' );
    }
}
add_action( 'admin_enqueue_scripts', 'custom_dashboard_assets' );
