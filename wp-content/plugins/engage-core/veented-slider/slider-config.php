<?php

// Load Slider Functions

require_once( 'slider-functions.php' );
require_once( 'slider-shortcode.php' );
require_once( 'slider-vc.php' );
require_once( 'slider-metaboxes.php' );

//
// New Post Type
//

add_action('init', 'veented_slider_register');

function veented_slider_register() {
    $args = array(
        'label' => esc_html__( 'Engage Slider', 'engage' ),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => true,
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => array( 'title', 'page-attributes' ),
        'hierarchical' => false
    );

    register_post_type( 'veented_slider' , $args );

    register_taxonomy(
    	"slide-locations",
    	array("veented_slider"),
    	array(
    		"hierarchical" => true,
    		"context" => "normal",
    		'show_ui' => true,
    		"label" => esc_html__( "Sliders", 'engage' ),
    		"singular_label" => esc_html__( "Slider", 'engage' ),
    		"rewrite" => true
    	)
    );
}


//
// Thumbnail column
//

add_filter( 'manage_edit-veented_slider_columns', 'veented_slider_columns_settings' ) ;

function veented_slider_columns_settings( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => esc_html__('Title', 'engage'),
		'date' => esc_html__('Date', 'engage'),
		'thumbnail' => esc_html__('Image', 'engage'),
	);

	return $columns;
}

add_action( 'manage_veented_slider_posts_custom_column', 'veented_slider_columns_content', 10, 2 );

function veented_slider_columns_content( $column, $post_id ) {
	global $post;
	the_post_thumbnail('thumbnail', array('class' => 'column-img'));
}
