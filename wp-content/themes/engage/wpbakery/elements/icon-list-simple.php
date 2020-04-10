<?php

// Engage Icon List

return array(
	"name" => esc_html__( "Simple Icon List", "engage" ),
	"base" => "vntd_list",
	"class" => "font-awesome",
	"icon" => "fa-list-ul",
	"category" => array( 'Content', 'Engage' ),
	"description" => esc_html__( "Simple Icon List", 'engage' ),
	"params" => array(
		array(
			"type" => "exploded_textarea",
			"heading" => esc_html__( "List Items", "engage" ),
			"param_name" => "items",
			"value" => "List Item 1,List Item 2,List Item 3",
			"description" => esc_html__( 'Enter list items here. Divide each item with linebreaks (Enter). Comma "," is a special character and cannot be used directly. Please use the (comma) shortcode instead.', "engage" ) 
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', "engage" ),
			'param_name' => 'icon',
			'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 100 // default 100, how many icons per/page to display
			),
			'description' => esc_html__( 'Select icon from library.', "engage" )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon Color', "engage" ),
			'value' => array(
				esc_html__( 'Accent Color', "engage" ) => 'accent',
				esc_html__( 'Accent Color 2', "engage" ) => 'accent-2',
				esc_html__( 'Accent Color 3', "engage" ) => 'accent-3',
				esc_html__( "Predefined Gradient 1", 'engage' ) => 'gradient-1',
				esc_html__( "Predefined Gradient 2", 'engage' ) => 'gradient-2',
				esc_html__( 'Gray', "engage" ) => 'gray',
//				esc_html__( 'White', "engage" ) => 'white',
//				esc_html__( 'Transparent', "engage" ) => 'transparent',
			),
			'param_name' => 'icon_color',
			'description' => esc_html__( 'Choose color of icons in the list.', "engage" )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon Style', "engage" ),
			'value' => array(
				esc_html__( 'Simple', "engage" ) => 'simple',
				esc_html__( 'Circle', "engage" ) => 'circle',
			),
			'param_name' => 'style',
			'description' => esc_html__( 'Choose a style of icons in the list.', "engage" )
		),

	)
);
