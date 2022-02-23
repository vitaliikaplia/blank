<?php

if(!defined('ABSPATH')){exit;}

/**
 * Dashboard ACF maps Google maps api key
 */
if (function_exists('get_fields')) {
    function my_acf_google_map_api( $api ){
        $api['key'] = get_option("google_maps_api_key");
        return $api;
    }
    add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
}
