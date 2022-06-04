<?php

if(!defined('ABSPATH')){exit;}

/** remove dns-prefetch */
if(cached_field('website_options/disable_dns_prefetch')){
	remove_action( 'wp_head', 'wp_resource_hints', 2 );
}
