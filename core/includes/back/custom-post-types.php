<?php

if(!defined('ABSPATH')){exit;}

register_post_type('mail-log', array(
        'label' => __('Mail log', TEXTDOMAIN),
        'description' => '',
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array('slug' => '', 'with_front' => false),
        'query_var' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'menu_position' => 88,
        'menu_icon' => 'dashicons-email-alt',
        'supports' => array('title','editor'),
        'capabilities' => array(
            'create_posts' => false
        ),
        'labels' => array (
            'name' => __('Mail log', TEXTDOMAIN),
            'singular_name' => __('Mail log', TEXTDOMAIN),
            'menu_name' => __('Mail log', TEXTDOMAIN),
            'add_new' => __('Add', TEXTDOMAIN),
            'add_new_item' => __('Add', TEXTDOMAIN),
            'edit' => __('Edit', TEXTDOMAIN),
            'edit_item' => __('Edit', TEXTDOMAIN),
            'new_item' => __('New', TEXTDOMAIN),
            'view' => __('View', TEXTDOMAIN),
            'view_item' => __('View', TEXTDOMAIN),
            'search_items' => __('Search for mail logs', TEXTDOMAIN),
            'not_found' => __('No mail logs found', TEXTDOMAIN),
            'not_found_in_trash' => __('No mail logs found in trash', TEXTDOMAIN),
            'parent' => __('Parent', TEXTDOMAIN),
        )
    )
);
