<?php

if(!defined('ABSPATH')){exit;}

function add_redirect_rules_metabox() {
    add_meta_box(
        'redirect_rules_metabox',
        __('Redirect Rules Options', TEXTDOMAIN),
        'render_redirect_rules_metabox',
        'redirect-rules',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_redirect_rules_metabox');

function render_redirect_rules_metabox($post) {
    wp_nonce_field('redirect_rules_metabox', 'redirect_rules_nonce');

    $old_url = get_post_meta($post->ID, 'old_url', true);
    $new_url = get_post_meta($post->ID, 'new_url', true);
    $code = get_post_meta($post->ID, 'code', true);
    if (!$code) $code = '301'; // Значення за замовчуванням

    ?>
    <p>
        <label for="old_url"><?php echo __('Old URL:', TEXTDOMAIN); ?></label>
        <input type="url" id="old_url" name="old_url" value="<?php echo esc_url($old_url); ?>" style="width: 100%;" placeholder="https://<?php echo BLOGINFO_JUST_DOMAIN; ?>/..." required>
    </p>
    <p>
        <label for="new_url"><?php echo __('New URL:', TEXTDOMAIN); ?></label>
        <input type="url" id="new_url" name="new_url" value="<?php echo esc_url($new_url); ?>" style="width: 100%;" placeholder="https://<?php echo BLOGINFO_JUST_DOMAIN; ?>/..." required>
    </p>
    <p>
        <label><?php echo __('Code:', TEXTDOMAIN); ?></label><br>
        <label>
            <input type="radio" name="code" value="301" <?php checked($code, '301'); ?> required>
            301
        </label>
        <label>
            <input type="radio" name="code" value="302" <?php checked($code, '302'); ?> required>
            302
        </label>
    </p>
    <?php
}

function save_redirect_rules_metabox($post_id) {
    if (!isset($_POST['redirect_rules_nonce']) || !wp_verify_nonce($_POST['redirect_rules_nonce'], 'redirect_rules_metabox')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['old_url'])) {
        update_post_meta($post_id, 'old_url', esc_url_raw($_POST['old_url']));
    }

    if (isset($_POST['new_url'])) {
        update_post_meta($post_id, 'new_url', esc_url_raw($_POST['new_url']));
    }

    if (isset($_POST['code'])) {
        update_post_meta($post_id, 'code', sanitize_text_field($_POST['code']));
    }
}
add_action('save_post_redirect-rules', 'save_redirect_rules_metabox');

add_action('init', function () {
    $redirect_posts = get_posts([
        'post_type' => 'redirect-rules',
        'numberposts' => -1
    ]);
    if ($redirect_posts) {
        $REQUEST_URI = isset($_SERVER['REQUEST_URI']) ? rtrim($_SERVER['REQUEST_URI'], '/') . '/' : '/';
        foreach ($redirect_posts as $post) {
            $old_url = get_post_meta($post->ID, 'old_url', true);
            $new_url = get_post_meta($post->ID, 'new_url', true);
            $code = get_post_meta($post->ID, 'code', true);

            if (!$old_url || !$new_url || !$code) {
                continue; // Пропускаємо цей запис, якщо якесь з полів відсутнє
            }

            // Видаляємо протокол і домен з old_url
            $old = str_replace(["https://", "http://", parse_url(get_bloginfo('url'), PHP_URL_HOST)], "", rtrim($old_url, '/') . '/');

            if ($REQUEST_URI === $old) {
                wp_redirect($new_url, $code);
                exit;
            }
        }
    }
});
