<?php

if(!defined('ABSPATH')){exit;}

/**
 * Header CSS
 */
function custom_header_css(){
    if(get_option( 'inline_scripts_and_styles' )){
        if($header_css = get_transient( 'header_css' )){
            echo $header_css;
        } else {
            $css  = '';
            $css .= file_get_contents( TEMPLATE_DIRECTORY_URL . "assets/css/style.min.css" );
            $css = str_replace('../',TEMPLATE_DIRECTORY_URL . 'assets/', $css);
            $header_css = '<style type="text/css">'.$css.'</style>';
            set_transient( 'header_css', $header_css, TRANSIENTS_TIME );
            echo "\n";
            echo $header_css;
        }
    } else {
        echo "\n";
        echo '<link rel="stylesheet" href="'.TEMPLATE_DIRECTORY_URL.'assets/css/style.min.css?ver='.ASSETS_VERSION.'" type="text/css" media="screen" />';
    }
}
add_filter('wp_head', 'custom_header_css');
