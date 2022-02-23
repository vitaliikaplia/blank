<?php

if(!defined('ABSPATH')){exit;}

/**
 * Custom localization
 */
function custom_localization(){

	$localization['your_name'] = __("Your Name", TEXTDOMAIN);
	$localization['your_phone'] = __("Your Phone", TEXTDOMAIN);

	return $localization;

}
