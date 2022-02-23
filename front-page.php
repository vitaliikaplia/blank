<?php

if(!defined('ABSPATH')){exit;}

/**
 * Front page
 */
$context = Timber::get_context();
$context['post'] = new TimberPost();

Timber::render( array( 'home.twig' ), $context, TIMBER_CACHE_TIME );
