<?php

// Engage Image Slider

return array(
		"name" => esc_html__( "Price Heading", "engage" ),
	"base" => "price_heading",
	"class" => "font-awesome",
	"icon" => "fa-header",
	"description" => esc_html__( "Heading with price.", 'engage' ),
	"category" => esc_html__( 'Content', 'engage' ),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Heading Text", "engage" ),
			"param_name" => "title",
			"holder" => "h5",
			"description" => esc_html__( "Heading text.", "engage" ),
			"value" => ""
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Price Label", "engage" ),
			"param_name" => "label",
			"holder" => "span",
			"description" => esc_html__( "Enter the price label i.e. $10.", "engage" ),
			"value" => "$10"
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Add Border?", "engage" ),
			"param_name" => "border",
			"description" => esc_html__( "Enable a border below the heading.", "engage" ),
			'value' => array(
				esc_html__( 'Theme Defaults', "engage" ) => '',
				esc_html__( 'Yes', "engage" ) => 'yes',
				esc_html__( 'No', "engage" ) => 'no',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', "engage" ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', "engage" )
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Heading HTML Tag", "engage" ),
			"param_name" => "h_tag",
			"description" => esc_html__( "Choose the heading tag.", "engage" ),
			'value' => array(
				esc_html__( 'Theme Defaults', "engage" ) => '',
				esc_html__( 'H6', "engage" ) => 'h6',
				esc_html__( 'H5', "engage" ) => 'h5',
				esc_html__( 'H4', "engage" ) => 'h4',
				esc_html__( 'H3', "engage" ) => 'h3',
				esc_html__( 'H2', "engage" ) => 'h2',
				esc_html__( 'H1', "engage" ) => 'h1',
			),
			'group' => esc_html__( "Styling", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Heading Color", "engage" ),
			"param_name" => "h_color",
			"value" => array(
				esc_html__( 'Theme Defaults', 'engage' ) => '',
				esc_html__( 'Accent Color', 'engage' ) => 'accent',
			),
			'description' => esc_html__( 'Heading text color.', 'engage' ),
			'group' => esc_html__( "Styling", "engage" )
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Price Label Size", "engage" ),
			"param_name" => "label_size",
			"description" => esc_html__( "Choose the size of the price label.", "engage" ),
			'value' => array(
				esc_html__( 'Theme Defaults', "engage" ) => '',
				esc_html__( 'Small', 'engage' ) => 'small'
			),
			'group' => esc_html__( "Styling", "engage" )
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Price Label Font Weight", "engage" ),
			"param_name" => "label_fw",
			"description" => esc_html__( "Choose font weight for your label.", "engage" ),
			'value' => array(
				esc_html__( 'Theme Defaults', "engage" ) => '',
				esc_html__( 'Normal', 'engage' ) => 'normal',
				esc_html__( 'Bold', 'engage' ) => 'bold'
			),
			'group' => esc_html__( "Styling", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Price Label Color", "engage" ),
			"param_name" => "label_color",
			"value" => array(
				esc_html__( 'Theme Defaults', 'engage' ) => '',
				esc_html__( 'Accent Color', 'engage' ) => 'accent',
				esc_html__( 'Accent Color 2', 'engage' ) => 'accent-2',
				esc_html__( 'Accent Color 3', 'engage' ) => 'accent-3',
				esc_html__( 'Dark', 'engage' ) => 'dark',
				esc_html__( 'Dark Grey', 'engage' ) => 'dark-grey',
				esc_html__( 'Custom', 'engage' ) => 'custom',
			),
			'description' => esc_html__( 'Choose color for the price label.', 'engage' ),
			'group' => esc_html__( "Styling", "engage" )
		),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Label Custom Color", "engage" ),
				"param_name" => "label_color_c",
				"class" => "hidden-label",
				"description" => esc_html__( "Choose a custom color for the price label.", "engage" ),
				"dependency" => Array(
					"element" => "label_color",
					'value' => array(
						'custom'
					)
				),
				'group' => esc_html__( "Styling", "engage" )
			),
		// End icons

		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS Box', 'engage' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design options', 'engage' ),
		),


	)
);
