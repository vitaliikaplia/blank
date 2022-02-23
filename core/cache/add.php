<?php

if(!defined('ABSPATH')){exit;}

/**
 * Cache general fields
 */
function cache_general_fields(){
    if (function_exists('get_fields')) {
        if($general_fields = get_transient( 'general_fields'.LANG_SUFFIX )){
            return $general_fields;
        } else {
            $general_fields = get_fields('options');
            set_transient( 'general_fields'.LANG_SUFFIX, $general_fields, TRANSIENTS_TIME );
            return $general_fields;
        }
    } else {
        return false;
    }
}

/**
 * Cache front fields
 */
function cache_front_fields(){
    if (function_exists('get_fields')) {
        if($front_fields = get_transient( 'front_fields'.LANG_SUFFIX )){
            return $front_fields;
        } else {
            $front_fields = get_fields(PAGE_ON_FRONT);
            set_transient( 'front_fields'.LANG_SUFFIX, $front_fields, TRANSIENTS_TIME );
            return $front_fields;
        }
    } else {
        return false;
    }
}

/**
 * Cache page fields
 */
function cache_fields($post_id){
    if (function_exists('get_fields')) {
        if($post_id){
            if($fields = get_transient( 'custom_page_' . $post_id . '_fields'.LANG_SUFFIX )){
                return $fields;
            } else {
                $fields = get_fields($post_id);
                set_transient( 'custom_page_' . $post_id . '_fields'.LANG_SUFFIX, $fields, TRANSIENTS_TIME );
                return $fields;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * Cache blog fields
 */
function cache_blog_fields(){
    if (function_exists('get_fields')) {
        if($blog_fields = get_transient( 'blog_fields'.LANG_SUFFIX )){
            return $blog_fields;
        } else {
            $blog_fields = get_fields(PAGE_FOR_POSTS);
            set_transient( 'blog_fields'.LANG_SUFFIX, $blog_fields, TRANSIENTS_TIME );
            return $blog_fields;
        }
    } else {
        return false;
    }
}
