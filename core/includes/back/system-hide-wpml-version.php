<?php

if(!defined('ABSPATH')){exit;}

/**
 * Hide WPML version
 */

global $sitepress;
remove_action( 'wp_head', array( $sitepress, 'meta_generator_tag' ) );
