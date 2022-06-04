<?php

if(!defined('ABSPATH')){exit;}

function resize_images_at_upload($image_data){

    if(cached_field('resize_at_upload/enable') && in_array($image_data['type'], cached_field('resize_at_upload/formats'))) {
        $max_width  = cached_field('resize_at_upload/width');
        $max_height = cached_field('resize_at_upload/height');
        $resize_quality = cached_field('resize_at_upload/quality');
        $image_editor = wp_get_image_editor($image_data['file']);
        $image_editor->resize($max_width, $max_height, false);
        $image_editor->set_quality($resize_quality);
        $image_editor->save($image_data['file']);
    }

    return $image_data;

}
add_action('wp_handle_upload', 'resize_images_at_upload');
