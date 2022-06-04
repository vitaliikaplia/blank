<?php

if(!defined('ABSPATH')){exit;}

/** prepare translations */
function admin_fields_labels_loc($label){

	$loc = array();

	$loc['Title'] = __('Title', TEXTDOMAIN);
	$loc['Text'] = __('Text', TEXTDOMAIN);
	$loc['Maintenance mode'] = __('Maintenance mode', TEXTDOMAIN);
	$loc['Enable maintenance mode for anonymous users'] = __('Enable maintenance mode for anonymous users', TEXTDOMAIN);
    $loc['Website options'] = __('Website options', TEXTDOMAIN);
	$loc['Disable all updates'] = __('Disable all updates', TEXTDOMAIN);
	$loc['Disable customizer'] = __('Disable customizer', TEXTDOMAIN);
	$loc['Disable src set'] = __('Disable src set', TEXTDOMAIN);
	$loc['Remove default image sizes'] = __('Remove default image sizes', TEXTDOMAIN);
	$loc['Disable core privacy tools'] = __('Disable core privacy tools', TEXTDOMAIN);
	$loc['Enable CYR3LAT'] = __('Enable CYR3LAT', TEXTDOMAIN);
	$loc['Disable DNS prefetch'] = __('Disable DNS prefetch', TEXTDOMAIN);
	$loc['Disable Rest API'] = __('Disable Rest API', TEXTDOMAIN);
	$loc['Disable Emojis'] = __('Disable Emojis', TEXTDOMAIN);
	$loc['Disable Embeds'] = __('Disable Embeds', TEXTDOMAIN);
	$loc['Disable dashboard widgets'] = __('Disable dashboard widgets', TEXTDOMAIN);
	$loc['Hide admin top bar'] = __('Hide admin top bar', TEXTDOMAIN);
	$loc['Disable admin email verification'] = __('Disable admin email verification', TEXTDOMAIN);
	$loc['Disable comments'] = __('Disable comments', TEXTDOMAIN);
	$loc['Delete child media'] = __('Delete child media', TEXTDOMAIN);
	$loc['Enable HTML cache'] = __('Enable HTML cache', TEXTDOMAIN);
	$loc['Enable minify'] = __('Enable minify', TEXTDOMAIN);
	$loc['Inline scripts and styles'] = __('Inline scripts and styles', TEXTDOMAIN);
	$loc['Google maps API key'] = __('Google maps API key', TEXTDOMAIN);
	$loc['Resize at upload'] = __('Resize at upload', TEXTDOMAIN);
	$loc['Enable'] = __('Enable', TEXTDOMAIN);
	$loc['Width'] = __('Width', TEXTDOMAIN);
	$loc['Height'] = __('Height', TEXTDOMAIN);
	$loc['Quality'] = __('Quality', TEXTDOMAIN);
	$loc['Formats'] = __('Formats', TEXTDOMAIN);
	$loc['Custom code'] = __('Custom code', TEXTDOMAIN);
	$loc['Header custom code'] = __('Header custom code', TEXTDOMAIN);
	$loc['Footer custom code'] = __('Footer custom code', TEXTDOMAIN);
	$loc['SMTP'] = __('SMTP', TEXTDOMAIN);
	$loc['Host'] = __('Host', TEXTDOMAIN);
	$loc['Port'] = __('Port', TEXTDOMAIN);
	$loc['Username'] = __('Username', TEXTDOMAIN);
	$loc['Password'] = __('Password', TEXTDOMAIN);
	$loc['From name'] = __('From name', TEXTDOMAIN);
	$loc['Secure'] = __('Secure', TEXTDOMAIN);

	if(isset($loc[$label])){
		return $loc[$label];
	} else {
		return $label;
	}
}

/** translate field labels */
function my_acf_translate_fields( $field ) {

    global $pagenow;

    if($pagenow == 'index.php'){

        if(isset($field['label'])){
            $field['label'] = admin_fields_labels_loc($field['label']);
        }
        if(isset($field['instructions'])){
            $field['instructions'] = admin_fields_labels_loc($field['instructions']);
        }
        if(isset($field['message'])){
            $field['message'] = admin_fields_labels_loc($field['message']);
        }
        if(isset($field['button_label'])){
            $field['button_label'] = admin_fields_labels_loc($field['button_label']);
        }

    }

	return $field;

}
add_filter('acf/load_field', 'my_acf_translate_fields');
