<?php

if(!defined('ABSPATH')){exit;}

/**
 * Fixing timezone
 */
date_default_timezone_set(wp_timezone_string());

/**
 * Constants
 */
define('TEXTDOMAIN', 'blank' );
define('THEME_PATH', trailingslashit( get_template_directory() ) );
define('CORE_PATH', THEME_PATH . 'core');
define('TEMPLATE_DIRECTORY_URL', trailingslashit( get_template_directory_uri() ) );
define('CORE_URL', TEMPLATE_DIRECTORY_URL . 'core' );
define('ADMIN_AJAX_URL', admin_url('admin-ajax.php') );
define('BLOGINFO_NAME', get_bloginfo("name") );
define('BLOGINFO_URL', get_bloginfo("url") );
define('TIMBER_VIEWS', 'views' );
define('IMG_TEMPLATE_DIRECTORY_URL', TEMPLATE_DIRECTORY_URL . "assets/img" );
define('ASSETS_VERSION', get_option('assets_version') );
define('SVG_SPRITE_URL', TEMPLATE_DIRECTORY_URL . "assets/svg/sprite.svg?ver=".ASSETS_VERSION );
$parsed_url = parse_url(BLOGINFO_URL);
define('BLOGINFO_JUST_DOMAIN', $parsed_url['host']);
define('TRANSIENTS_TIME', 48 * HOUR_IN_SECONDS);
if(get_option('enable_html_cache')){
	define('TIMBER_CACHE_TIME', 48 * HOUR_IN_SECONDS);
} else {
	define('TIMBER_CACHE_TIME', false);
}
define('HIDE_ACF', false);
define('DISABLE_GUTENBERG', false);

/**
 * Multilingual constants + WPML
 */
if(defined('ICL_LANGUAGE_CODE')){
	define('BLOGINFO_LANGUAGE', ICL_LANGUAGE_CODE);
	define('LANG_SUFFIX', "_".ICL_LANGUAGE_CODE);
    define('ICL_DONT_LOAD_NAVIGATION_CSS', 1);
    define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', 1);
    define('ICL_DONT_LOAD_LANGUAGES_JS', 1);
	define('PAGE_ON_FRONT', icl_object_id(get_option('page_on_front'), 'page', false, BLOGINFO_LANGUAGE));
	define('PAGE_FOR_POSTS', icl_object_id(get_option('page_for_posts'), 'page', false, BLOGINFO_LANGUAGE));
} else {
	define('BLOGINFO_LANGUAGE', get_locale());
	define('LANG_SUFFIX', "_".BLOGINFO_LANGUAGE);
	define('PAGE_ON_FRONT', get_option('page_on_front'));
	define('PAGE_FOR_POSTS', get_option('page_for_posts'));
}

/**
 * Template author information
 */
$currentTheme = wp_get_theme();
define('AUTHOR_URL', $currentTheme->get( 'AuthorURI' ) );
define('AUTHOR_TITLE', $currentTheme->get( 'Author' ) );

/**
 * Theme activation
 */
function myactivationfunction($oldname, $oldtheme=false) {
    add_option('assets_version', '0.01');
    add_option('resize_upload_width', '2048');
    add_option('resize_upload_height', '2048');
    add_option('resize_upload_quality', '80');
}
add_action("after_switch_theme", "myactivationfunction", 10 ,  2);

/**
 * Theme deactivation
 */
function mydeactivationfunction($newname, $newtheme) {
    delete_option('assets_version');
    delete_option('resize_upload_width');
    delete_option('resize_upload_height');
    delete_option('resize_upload_quality');
}
add_action("switch_theme", "mydeactivationfunction", 10 , 2);

/**
 * Load lang files
 */
load_theme_textdomain(TEXTDOMAIN, CORE_PATH . '/lang');

/**
 * Load WordPress includes script
 */
require_once ABSPATH . 'wp-admin/includes/file.php';

/**
 * Cache
 */
$includedFiles = list_files( CORE_PATH . '/cache' );
if(is_array($includedFiles) && $includedFiles){
	foreach($includedFiles as $file){
		require_once $file;
	}
}

/**
 * Include all modules
 */
$includedFiles = list_files( CORE_PATH . '/includes' );
if(is_array($includedFiles) && $includedFiles){
	foreach($includedFiles as $file){
		require_once $file;
	}
}

/**
 * Gutenberg
 */
require_once CORE_PATH . '/gutenberg.php';

/**
 * Include ajax scripts
 */
$includedAjax = list_files( CORE_PATH . '/ajax' );
if(is_array($includedAjax) && $includedAjax){
	foreach($includedAjax as $ajax){
		require_once $ajax;
	}
}

/**
 * Libraries
 */
require_once CORE_PATH . '/libs/libraries.php';

/**
 * Timber
 */
class BlankSite extends TimberSite {

	function __construct() {
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );

		if ( ! is_admin() ) {
			parent::__construct();
		}
	}

	function add_to_context( $context ) {
		$context['site'] = $this;
		$context['assets'] = ASSETS_VERSION;
		$context['site_language'] = BLOGINFO_LANGUAGE;
		$context['svg_sprite'] = SVG_SPRITE_URL;
        $context['general_fields'] = cache_general_fields();
        $context['front_fields'] = cache_front_fields();
        $context['blog_fields'] = cache_blog_fields();
        $context['localization'] = custom_localization();

		return $context;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own functions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		return $twig;
	}

}

new BlankSite();

/**
 * Maintenance mode
 */
if(get_option( 'enable_maintenance_mode' )){
	global $pagenow;
	if(!is_admin() && !is_user_logged_in() && $pagenow != "wp-login.php"){
		wp_die('<h1>'.__("Website under Maintenance", TEXTDOMAIN).'</h1><p>'.__("We are performing scheduled maintenance. We will be back online shortly!", TEXTDOMAIN).'</p>');
	}
}

/**
 * ACF notification
 */
if (!function_exists('get_fields')) {
    function sample_admin_notice__success() {
        ?>
        <div class="notice notice-error">
            <p><?php _e("Please, install Advanced Custom Fields PRO version", TEXTDOMAIN); ?></p>
        </div>
        <?php
    }
    add_action( 'admin_notices', 'sample_admin_notice__success' );
}
