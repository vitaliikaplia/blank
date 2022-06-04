<?php

if(!defined('ABSPATH')){exit;}

function cached_field($field){
    if($field){
        $fields = cache_general_fields();

        if (strpos($field, '/') !== false) {
            $levels = explode("/", $field);
            $field = $fields[$levels[0]][$levels[1]];
        } else {
            $field = $fields[$field];
        }
        return $field;
    }
}
