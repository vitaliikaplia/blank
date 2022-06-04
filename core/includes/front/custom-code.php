<?php

if(!defined('ABSPATH')){exit;}

/** header */
function frontend_custom_header(){
	if ($custom_header_code = cached_field('custom_code/header')) {
		echo $custom_header_code . "\n";
	}
}
add_filter('wp_head', 'frontend_custom_header');

/** footer */
function frontend_custom_footer(){
	if ($custom_footer_code = cached_field('custom_code/footer')) {
		echo $custom_footer_code . "\n";
	}
}
add_action('wp_footer', 'frontend_custom_footer',99);
