<?php

if(!defined('ABSPATH')){exit;}

/** hide some dashboard pages */
//if(is_admin()){
	//function remove_menus(){
		//remove_menu_page( 'tools.php' );                  //Tools
		//remove_menu_page( 'index.php' );                  //Dashboard
		//remove_menu_page( 'edit.php' );                   //Posts
		//remove_menu_page( 'upload.php' );                 //Media
		//remove_menu_page( 'edit.php?post_type=page' );    //Pages
		//remove_menu_page( 'themes.php' );                 //Appearance
		//remove_menu_page( 'users.php' );                  //Users
        //remove_submenu_page( 'tools.php', 'site-health.php' );
        //remove_menu_page( 'edit-comments.php' );          //Comments
		//remove_menu_page( 'plugins.php' );                //Plugins
		//remove_menu_page( 'options-general.php' );        //Settings
		//remove_submenu_page( 'tools.php', 'site-health.php' );
		//remove_menu_page( 'sitepress-multilingual-cms/menu/languages.php');
	//}
	//add_action( 'admin_menu', 'remove_menus', 999 );
//}

/** add dashboard menu separators */
function add_admin_menu_separator($position) {
    global $menu;
    $menu[$position] = array(
        0	=>	'',
        1	=>	'read',
        2	=>	'separator' . $position,
        3	=>	'',
        4	=>	'wp-menu-separator'
    );
}
function set_admin_menu_separator() {
    add_admin_menu_separator(25);
    add_admin_menu_separator(87);
}
add_action('admin_menu', 'set_admin_menu_separator');
