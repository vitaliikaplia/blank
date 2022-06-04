<?php

if(!defined('ABSPATH')){exit;}

/** disable Site Health Email Notifications */

add_filter( 'wp_fatal_error_handler_enabled', '__return_false' );
