<?php

$params = array(
	array(
		'type' => 'attach_images',
		'heading' => esc_html__( 'Images', "engage" ),
		'param_name' => 'images',
		'value' => '',
		'description' => esc_html__( 'Select images from media library.', "engage" )
	),
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'On click', "engage" ),
		'param_name' => 'onclick',
		'value' => array(
			esc_html__( 'Do nothing', "engage" ) => 'link_no',
			esc_html__( 'Open custom link', "engage" ) => 'custom_link'
		),
		'description' => esc_html__( 'Define action for onclick event if needed.', "engage" )
	),
	array(
		'type' => 'exploded_textarea',
		'heading' => esc_html__( 'Custom links', "engage" ),
		'param_name' => 'custom_links',
		'description' => esc_html__( 'Enter links for each logo here. Divide links with linebreaks (Enter) . ', "engage" ),
		'dependency' => array(
			"element" => 'onclick',
			'value' => array(
				'custom_link'
			)
		)
	),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Open link in a new tab?', "engage" ),
			'param_name' => 'link_target',
			'value' => array(
				esc_html__( 'No', "engage" ) => 'no',
				esc_html__( 'Yes', "engage" ) => 'yes'
			),
			'description' => esc_html__( 'Select if you want the link to open in a new browser tab/window.', "engage" ),
			'dependency' => array(
				"element" => 'onclick',
				'value' => array(
					'custom_link'
				)
			)
		),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Type", "engage" ),
		"param_name" => "type",
		'value' => array(
			esc_html__( 'Carousel', "engage" ) => 'carousel',
			esc_html__( 'Static Grid', "engage" ) => 'grid'
		),
		"description" => esc_html__( "Choose a type of displaying your logos.", "engage" )
	),
	array(
		"type" => "dropdown",
		"heading" => esc_html__( "Columns", "engage" ),
		"param_name" => "cols",
		"value" => array(
			"7",
			"6",
			"5",
			"4",
			"3",
			"2"
		),
		'dependency' => array(
			"element" => 'type',
			'value' => array(
				'carousel'
			)
		),
		"std" => "4",
		"description" => esc_html__( "Number of columns", "engage" )
	),
	array(
		"type" => "dropdown",
		"heading" => esc_html__( "Carousel autoplay?", "engage" ),
		"param_name" => "autoplay",
		"value" => array(
			__( 'Yes', 'engage' ) => 'true',
			__( 'No', 'engage' ) => 'false'
		),
		'dependency' => array(
			"element" => 'type',
			'value' => array(
				'carousel'
			)
		),
		"std" => "true",
		"description" => esc_html__( "Should the carousel play automatically?", "engage" )
	),
	array(
		"type" => "textfield",
		"heading" => esc_html__( "Carousel autoplay timeout", "engage" ),
		"param_name" => "autoplay_timeout",
		'dependency' => array(
			"element" => 'type',
			'value' => array(
				'carousel'
			)
		),
		"std" => "7000",
		"description" => esc_html__( "Specify the carousel autoplay timeout (only if autoplay is enabled), in miliseconds i.e. 7000 = 7 seconds.", "engage" )
	),
	array(
		"type" => "dropdown",
		"heading" => esc_html__( "Columns", "engage" ),
		"param_name" => "cols_grid",
		"value" => array(
			"5",
			"4",
			"3",
			"2"
		),
		'dependency' => array(
			"element" => 'type',
			'value' => array(
				'grid'
			)
		),
		"std" => "4",
		"description" => esc_html__( "Number of columns", "engage" )
	),
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Logos Height', "engage" ),
		'param_name' => 'logos_height',
		'value' => array(
			esc_html__( 'Regular', "engage" ) => 'regular',
			esc_html__( 'High (max height 200px)', "engage" ) => 'high',
			esc_html__( 'Higher (max height 260px)', "engage" ) => 'higher'
		),
		'description' => esc_html__( 'Use the "high" option for high, vertical logo images.', "engage" )
	),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Bullet Navigation", "engage" ),
		"param_name" => "dots",
		"value" => array(
			"True" => "true",
			"False" => "false"
		),
		"description" => esc_html__( "Enable or disable the carousel bullet navigation", "engage" )
	)
);

// Add responsive group

$params = array_merge( $params, engage_responsive_params() );

// Blog

return array(
	"name" => esc_html__( "Client Logos", "engage" ),
	"base" => "client_logos",
	"icon" => "fa-css3",
	"class" => "font-awesome",
	"category" => array(
		esc_html__( "Carousels", "engage" ),
		'Engage'
	),
	"description" => esc_html__( "Carousel of logo images.", "engage" ),
	"params" => $params
);
