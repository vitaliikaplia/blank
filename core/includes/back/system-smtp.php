<?php

if(!defined('ABSPATH')){exit;}

add_action( 'phpmailer_init', 'smtp_fix_phpmailer_init' );
function smtp_fix_phpmailer_init( $phpmailer ) {
    if(
        ( $smtp_host = get_option('smtp_host') ) &&
        ( $smtp_port = get_option('smtp_port') ) &&
        ( $smtp_username = get_option('smtp_username') ) &&
        ( $smtp_password = get_option('smtp_password') ) &&
        ( $smtp_from_name = get_option('smtp_from_name') )
    ){
        $phpmailer->Host = $smtp_host;
        $phpmailer->Port = $smtp_port;
        $phpmailer->Username = $smtp_username;
        $phpmailer->Password = $smtp_password;
        $phpmailer->SMTPAuth = true;
        $phpmailer->From     = $smtp_username;
        $phpmailer->FromName = $smtp_from_name;
        $phpmailer->SMTPSecure = 'ssl';
        $phpmailer->IsSMTP();
    }
}
