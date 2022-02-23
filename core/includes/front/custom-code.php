<?php

if(!defined('ABSPATH')){exit;}

/**
 * Header
 */
function frontend_custom_header(){
	if ($custom_header_code = get_option('custom_header')) {
		echo $custom_header_code . "\n";
	}
}
add_filter('wp_head', 'frontend_custom_header');

/**
 * Footer
 */
function frontend_custom_footer(){
	if ($custom_footer_code = get_option('custom_footer')) {
		echo $custom_footer_code . "\n";
	}
}
add_action('wp_footer', 'frontend_custom_footer',99);
