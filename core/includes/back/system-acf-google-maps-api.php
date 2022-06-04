<?php

if(!defined('ABSPATH')){exit;}

/** dashboard ACF maps Google maps api key */
if (function_exists('get_fields')) {
    function my_acf_google_map_api( $api ){
        $api['key'] = cached_field('website_options/google_maps_api_key');
        return $api;
    }
    add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
}
