<?php

if(!defined('ABSPATH')){exit;}

// Remove the "Update" button from the post edit screen for custom post types
function remove_update_post_widget_cpt() {
    $custom_post_types = array('mail-log');
    global $post_type;
    if(in_array($post_type, $custom_post_types)) {
        remove_meta_box('submitdiv', $post_type, 'side');
    }
}
add_action('do_meta_boxes', 'remove_update_post_widget_cpt');

// Set single column layout for custom post types
function set_single_column_layout_cpt($columns) {
    $columns['mail-log'] = 1; // for your custom post type
    return $columns;
}
add_filter('screen_layout_columns', 'set_single_column_layout_cpt');
function set_screen_layout_cpt($selected) {
    return 1; // Set the number of columns
}
add_filter('get_user_option_screen_layout_mail-log', 'set_screen_layout_cpt');

// This function allows administrators to preview the content of a mail log entry
function mail_log_preview(){

    if(is_user_logged_in() && current_user_can('manage_options') && !empty($_GET['secret-mail-log-preview']) && $_GET['secret-mail-log-preview'] && !empty($_GET['mail-log-id']) && $_GET['mail-log-id']){

        $mail_log_id = intval($_GET['mail-log-id']);

        // check if $mail_log_id is id of post type mail-log
        $post = get_post($mail_log_id);
        if(!$post || $post->post_type !== 'mail-log'){
            wp_die(__('Invalid mail log ID', TEXTDOMAIN));
        }

        $mail_html = $post->post_content;
        echo $mail_html;

        exit;

    }

}
add_action('init', 'mail_log_preview');

// Add custom meta boxes for the mail log post type
function add_custom_email_log_meta_box() {
    add_meta_box(
        'custom-email-log-information-fields-meta-box',
        __('Email log information', TEXTDOMAIN),
        'email_log_render_custom_fields',
        'mail-log',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_custom_email_log_meta_box');

// Render custom fields for the mail log meta box
function email_log_render_custom_fields($post) {
    $context = Timber::context();
    $context['log_id'] = $post->ID;
    $context['recipient'] = get_post_meta($post->ID, 'recipient', true);
    Timber::render( 'dashboard/email-log-meta.twig', $context );
}

// Add a second meta box for email preview
function add_custom_email_log_meta_box_2() {
    add_meta_box(
        'custom-email-log-information-fields-meta-box-2',
        __('Email preview', TEXTDOMAIN),
        'email_log_preview_custom',
        'mail-log',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_custom_email_log_meta_box_2');

// Render the email preview in an iframe
function email_log_preview_custom($post) {
    echo '<iframe class="mailPreview" style="width: 100%;" src="/?secret-mail-log-preview=true&mail-log-id='.$post->ID.'"></iframe>';
}

// Add custom columns to the mail log post type in the admin dashboard
add_filter('manage_mail-log_posts_columns', 'add_mail_log_custom_columns');
function add_mail_log_custom_columns($columns) {
    // Вставимо наші колонки після заголовку
    $new_columns = [];

    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;

        if ($key === 'title') {
            $new_columns['recipient'] = __('Recipient', TEXTDOMAIN);
        }
    }

    return $new_columns;
}

// Render custom columns for the mail log post type
add_action('manage_mail-log_posts_custom_column', 'render_mail_log_custom_columns', 10, 2);
function render_mail_log_custom_columns($column, $post_id) {
    switch ($column) {
        case 'recipient':
            echo esc_html(get_post_meta($post_id, 'recipient', true));
            break;
    }
}
