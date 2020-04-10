<?php

// Theme Updates

require_once get_template_directory() . "/framework/admin/theme-updates/class.wp-auto-theme-update.php";

// API Token verification

function engage_verify_envato_api_token( $token = null ) {
    
    if ( $token == null ) return false;
        
    $item_id = 19199913;
    
    $url = 'https://api.envato.com/v3/market/buyer/download?item_id=' . $item_id . '&shorten_url=true';
			
    $defaults = array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $token,
        ),
        'timeout' => 20,
    );
    
    $args = '';
    $args = wp_parse_args( $args, $defaults );

    $token = trim( str_replace( 'Bearer', '', $args['headers']['Authorization'] ) );
    
    if ( empty( $token ) ) {
        return false;
    }

    $response = wp_remote_get( esc_url_raw( $url ), $args );
    $response_code = wp_remote_retrieve_response_code( $response );

    if ( 200 === $response_code ) {
        return true;
    } else {
        return false;
    }   
    
}

add_filter( 'envato_customer_token','engage_envato_customer_token' );

function engage_envato_customer_token($token) {

    if ( get_option( 'vntd-envato-api-token' ) ) {
        return get_option( 'vntd-envato-api-token' ); 
    }
    
    return false;
    
}