<?php

//
// New Post Type
//


add_action( 'init', 'engage_testimonial_register' );

function engage_testimonial_register() {
    $args = array(
        'label' => esc_html__( 'Testimonials', 'engage' ),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => true,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => array('title','thumbnail')
       );

    register_post_type( 'testimonials' , $args );

    register_taxonomy(
    	"testimonials-category",
    	array("testimonials"),
    	array(
    		"hierarchical" => true,
    		"context" => "normal",
    		'show_ui' => true,
    		"label" => esc_html__( "Categories", "engage" ),
    		"singular_label" => esc_html__( "Category", "engage" ),
    		"rewrite" => true
    	)
    );
}
