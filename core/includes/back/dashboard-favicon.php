<?php

if(!defined('ABSPATH')){exit;}

/**
 * Favicon for dashboard
 ****************************************************/
function favicon4admin() {
	echo '<link rel="shortcut icon" href="'.TEMPLATE_DIRECTORY_URL.'assets/img/favicon2x.ico?'.ASSETS_VERSION.'" />';
}
add_action( 'admin_head', 'favicon4admin' );
add_action( 'login_head', 'favicon4admin' );
