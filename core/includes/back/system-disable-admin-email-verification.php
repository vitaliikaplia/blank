<?php

if(!defined('ABSPATH')){exit;}

if(cached_field('website_options/disable_admin_email_verification')){
    add_filter( 'admin_email_check_interval', '__return_false' );
}
