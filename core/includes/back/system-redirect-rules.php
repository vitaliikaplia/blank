<?php

if(!defined('ABSPATH')){exit;}

add_action('init', function () {
    $general_fields = cache_general_fields();
    if (!empty($general_fields['redirect_rules']) && is_array($general_fields['redirect_rules'])) {
        $REQUEST_URI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';

        foreach ($general_fields['redirect_rules'] as $rule) {
            $old = str_replace(["https://", "http://", BLOGINFO_JUST_DOMAIN], "", rtrim($rule['old_url'], '/') . '/');
            $new = $rule['new_url'];

            if ($REQUEST_URI === $old) {
                wp_redirect($new, 301);
                exit;
            }
        }
    }
});
