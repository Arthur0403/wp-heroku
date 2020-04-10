<?php

// Engage Pricing Box

return array(
	"name" => esc_html__( "Pricing Box", "engage" ),
	"base" => "pricing_box",
	"class" => "font-awesome",
	"icon" => "fa-usd",
	"category" => esc_html__( 'Content', 'engage' ),
	"description" => esc_html__( "Product box with prices", "engage" ),
	"params" => array(
		 array(
			"type" => "textfield",
			"heading" => esc_html__( "Box Title", "engage" ),
			"param_name" => "title",
			"description" => esc_html__( "Your Pricing Box title", "engage" ),
			"value" => "Standard",
			"admin_label" => true
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Price", "engage" ),
			"param_name" => "price",
			"description" => esc_html__( "Pricing Box price", "engage" ),
			"value" => "$99",
			"admin_label" => true
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Period", "engage" ),
			"param_name" => "period",
			"description" => esc_html__( "Pricing Box period", "engage" ),
			"value" => "Month"
		),
		array(
			"type" => "exploded_textarea",
			"heading" => esc_html__( "Features", "engage" ),
			"param_name" => "features",
			"value" => "Feature 1,Feature 2,Feature 3",
			"description" => esc_html__( 'Enter features here. Divide each feature with linebreaks (Enter). You can also use FontAwesome icons like fa-close for red cross icon or fa-check for green check icon!', "engage" )
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Add Icon?", "engage" ),
			"param_name" => "add_icon",
			"class" => "hidden-label",
			"value" => array(
				esc_html__( "Yes", "engage" ) => "true",
			),
			"description" => esc_html__( "Display an icon before each feature.", "engage" )
		),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', "engage" ),
				'param_name' => 'icon_fontawesome',
				'value' => 'fa fa-info-circle',
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'iconsPerPage' => 200 // default 100, how many icons per/page to display
				),
				'dependency' => array(
					"element" => 'add_icon',
					'value' => 'true',
				),
				'description' => esc_html__( 'Select icon from library.', "engage" )
			),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"value" => array(
				esc_html__( "Not Featured", "engage" ) => 'no',
				esc_html__( "Featured", "engage" ) => 'yes'
			),
			"heading" => esc_html__( "Featured?", "engage" ),
			"description" => esc_html__( 'Make the box stand out from the crew.', "engage" ),
			"param_name" => "featured"
		),

		array(
			"type" => "textfield",
			"heading" => esc_html__( "Button Label", "engage" ),
			"param_name" => "button_label",
			"description" => esc_html__( "Text visible on the box button", "engage" ),
			"value" => "Buy Now"
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Button URL", "engage" ),
			"param_name" => "button_url",
			"description" => esc_html__( "Button URL, start with http://", "engage" ),
			"value" => "#",
			'dependency' => Array(
				"element" => "button_label",
				'not_empty' => true
			)
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Animated", "engage" ),
			"param_name" => "animated",
			"value" => array(
				esc_html__( "No", "engage" ) => "no",
				esc_html__( "Yes", "engage" ) => "yes",
			),
			"description" => esc_html__( "Enable the element fade in animation on scroll", "engage" )
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Animation Delay", "engage" ),
			"param_name" => "animation_delay",
			"value" => '100',
			"description" => esc_html__( "Fade in animation delay. Can be used to create a nice delay effect if multiple elements of same type.", "engage" ),
			"dependency" => Array(
				"element" => "animated",
				'value' => 'yes'
			)
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Style", "engage" ),
			"param_name" => "style",
			"value" => array(
				esc_html__( "Default", "engage" ) => "",
				esc_html__( "Classic", "engage" ) => "classic",
			),
			"group" => esc_html__( "Design", "engage" ),
			"description" => esc_html__( "Choose style for your pricing boxes.", "engage" )
		),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Background Color", "engage" ),
				"param_name" => "bg",
				"value" => array(
					esc_html__( "Default", "engage" ) => "",
					esc_html__( "White", "engage" ) => "white",
					esc_html__( "Transparent Light", "engage" ) => "transparent_light",
					esc_html__( "Transparent Dark", "engage" ) => "transparent_dark",
					esc_html__( "None", "engage" ) => "none",
				),
				"group" => esc_html__( "Design", "engage" ),
				"description" => esc_html__( "Choose the pricing box background color.", "engage" )
			),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Box Border Radius", "engage" ),
			"param_name" => "border_radius",
			"value" => array(
				esc_html__( "Theme Defaults", "engage" ) => "default",
				esc_html__( "All sides", "engage" ) => "all",
				esc_html__( "Left side", "engage" ) => "left",
				esc_html__( "Right side", "engage" ) => "right",
				esc_html__( "None", "engage" ) => "none",
			),
			"group" => esc_html__( "Design", "engage" ),
			"description" => esc_html__( "Choose sides where smooth border radius should be applied.", "engage" )
		),

	)
);
