<?php

if(!defined('ABSPATH')){exit;}

add_action( 'phpmailer_init', 'smtp_fix_phpmailer_init' );
function smtp_fix_phpmailer_init( $phpmailer ) {

    if(
        cached_field('smtp/enable') &&
        ( cached_field('smtp/host') ) &&
        ( cached_field('smtp/port') ) &&
        ( cached_field('smtp/username') ) &&
        ( cached_field('smtp/password') ) &&
        ( cached_field('smtp/from_name') )
    ){
        $phpmailer->Host = cached_field('smtp/host');
        $phpmailer->Port = cached_field('smtp/port');
        $phpmailer->Username = cached_field('smtp/username');
        $phpmailer->Password = cached_field('smtp/password');
        $phpmailer->SMTPAuth = true;
        $phpmailer->From     = cached_field('smtp/username');
        $phpmailer->FromName = cached_field('smtp/from_name');
        if(cached_field('smtp/secure')){
            $phpmailer->SMTPSecure = 'ssl';
        } else {
            $phpmailer->SMTPSecure = false;
        }
        $phpmailer->IsSMTP();
    }

}
