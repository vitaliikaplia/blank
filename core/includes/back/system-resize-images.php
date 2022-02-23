<?php

if(!defined('ABSPATH')){exit;}

function resize_images_at_upload($image_data){

    $valid_types = array('image/gif','image/png','image/jpeg','image/jpg');

    if(in_array($image_data['type'], $valid_types)) {
        $max_width  = get_option('resize_upload_width');
        $max_height = get_option('resize_upload_height');
        $resize_quality = get_option('resize_upload_quality');
        $image_editor = wp_get_image_editor($image_data['file']);
        $image_editor->resize($max_width, $max_height, false);
        $image_editor->set_quality($resize_quality);
        $image_editor->save($image_data['file']);
    }

    return $image_data;
}

add_action('wp_handle_upload', 'resize_images_at_upload');
