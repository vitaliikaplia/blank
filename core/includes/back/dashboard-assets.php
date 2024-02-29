<?php

if(!defined('ABSPATH')){exit;}

/** wp dashboard assets */
function custom_dashboard_assets(){

    wp_register_style( 'custom-dashboard', TEMPLATE_DIRECTORY_URL . 'assets/css/dashboard.min.css', false, ASSETS_VERSION);
    wp_enqueue_style( 'custom-dashboard' );

    global $pagenow;
    if($pagenow == "index.php"){
        wp_register_script( 'custom-dashboard-js', TEMPLATE_DIRECTORY_URL . 'assets/js/dashboard.min.js', '', ASSETS_VERSION, true);
        wp_enqueue_script( 'custom-dashboard-js' );
    }

    wp_register_script( 'custom-gutenberg', TEMPLATE_DIRECTORY_URL . 'assets/js/gutenberg.min.js', '', ASSETS_VERSION, true);
    wp_enqueue_script( 'custom-gutenberg' );

}
add_action( 'admin_enqueue_scripts', 'custom_dashboard_assets' );
