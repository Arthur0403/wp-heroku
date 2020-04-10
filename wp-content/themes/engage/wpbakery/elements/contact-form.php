<?php

// Contact Form

return array(
	"name" => esc_html__( "Contact Form", "engage" ),
	"base" => "engage_contact_form",
	"class" => "font-awesome",
	"icon" => "fa-envelope-o",
	"controls" => "full",
	"category" => esc_html__( 'Content', 'engage' ),
	"description" => esc_html__( "Simple contact form", 'engage' ),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Color Scheme", "engage" ),
			"param_name" => "scheme",
			"value" => array(
				esc_html__( "Default", 'engage' ) => "",
				esc_html__( "White Scheme", 'engage' ) => "white",
				esc_html__( "Dark Scheme", 'engage' ) => "dark"
			),
			"description" => esc_html__( "Choose the color scheme for your Contact Form. White scheme suits dark backgrounds perfectly.", "engage" )
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Alignment", "engage" ),
			"param_name" => "btn_align",
			"value" => array(
				esc_html__( "Default", 'engage' ) => "",
				esc_html__( "Left", 'engage' ) => "left",
				esc_html__( "Center", 'engage' ) => "center"
			),
			"description" => esc_html__( "Select the form submit button alignment.", "engage" )
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'engage' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'engage' ),
		),
	)
);
