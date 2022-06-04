<?php

if(!defined('ABSPATH')){exit;}

add_action('wp_dashboard_setup', 'add_acf_options_dashboard_widget');
function add_acf_options_dashboard_widget()
{
    acf_form_head();
    wp_add_dashboard_widget('custom_acf_options_widget', __("Website options", TEXTDOMAIN), 'acf_options_dashboard_widget_callback');
}

function acf_options_dashboard_widget_callback($post, $callback_args)
{
    acf_form(array(
        'post_id'       => 'options',
        'submit_value'  => __('Update'),
        'return' => '?updated=true',
        'field_groups'=> array('group_61b8eae8b31d7'),
        'updated_message' => __("Settings updated", TEXTDOMAIN),
    ));
}
