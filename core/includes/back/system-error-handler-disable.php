<?php

if(!defined('ABSPATH')){exit;}

/**
 * Disable Site Health Email Notifications
 * https://wpbeaches.com/remove-wordpress-site-health-dashboard-and-menu-item/
 */

add_filter( 'wp_fatal_error_handler_enabled', '__return_false' );
