<?php 

// Team Members

$params = array(
	array(
		"type" => "textfield",
		"class" => "hidden-label",
		"heading" => esc_html__( "Person Name", "engage" ),
		"param_name" => "name",
		"value" => '',
		"admin_label" => true,
		"description" => esc_html__( "Full name of the person.", "engage" ) 
	),
	array(
		"type" => "textfield",
		"class" => "hidden-label",
		"heading" => esc_html__( "Position", "engage" ),
		"param_name" => "position",
		"value" => '',
		"description" => esc_html__( "Enter person position i.e. Designer.", "engage" ) 
	),
	array(
		'type' => 'attach_image',
		'heading' => esc_html__( 'Person Image', "engage" ),
		'param_name' => 'img',
		'value' => '',
		'description' => esc_html__( 'Select a person image.', "engage" ),
	),
	array(
		"type" => "textarea",
		"class" => "hidden-label",
		"heading" => esc_html__( "Biography", "engage" ),
		"param_name" => "bio",
		"value" => '',
		"description" => esc_html__( "Optional short biography.", "engage" ),
	),
	array(
		"type" => "textfield",
		"class" => "hidden-label",
		"heading" => esc_html__( "Person Site", "engage" ),
		"param_name" => "link",
		"value" => '',
		"description" => esc_html__( "Optional URL to an individual person site/page i.e. www.site.com/john-doe.", "engage" ) 
	),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Style", "engage" ),
		"param_name" => "style",
		"value" => array(
			esc_html__( "Modern - icons displayed on hover, name centered below", "engage" ) => "modern",
			esc_html__( "Classic", "engage" ) => "classic",
		),
		"group" => esc_html__( 'Styling', 'engage' ),
		"description" => esc_html__( "Choose a style for your team members grid.", "engage" ) 
	),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Boxed Style", "engage" ),
		"param_name" => "boxed",
		"value" => array(
			esc_html__( "No", "engage" ) => "no",
			esc_html__( "Boxed Solid", "engage" ) => "boxed-solid",
			esc_html__( "Boxed Border", "engage" ) => "boxed-border",
		),
		"group" => esc_html__( 'Styling', 'engage' ),
		"description" => esc_html__( "Choose a boxed style for your team member grid items.", "engage" ) 
	),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Person Image Size", "engage" ),
		"param_name" => "img_size",
		"value" => array(
			esc_html__( "Square", "engage" ) . ' (600x600)' => "square",
			esc_html__( "Regular", "engage" ) . ' (600x420)' => "regular",
			esc_html__( "Custom size", "engage" ) => "custom" 
		),
		"group" => esc_html__( 'Styling', 'engage' ),
		"description" => esc_html__( "Choose the thumbnail size.", "engage" ) 
	),
	array(
		'type' => 'textfield',
		'heading' => esc_html__( 'Custom Image Size', 'engage' ),
		'param_name' => 'img_size_custom',
		'value' => '',
		"group" => esc_html__( 'Styling', 'engage' ),
		'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty for defaults.', 'engage' ),
		"dependency" => Array(
			"element" => "img_size",
			'value' => array(
				'custom',
			) 
		)
	),
);

$social_params = engage_social_params();

$params = array_merge( $params, $social_params );

return array(
	"name" => esc_html__( "Person", "engage" ),
	"base" => "vntd_person",
	"class" => "font-awesome",
	"icon" => "fa-user",
	"controls" => "full",
	"category" => array(
		esc_html__( 'Content', 'engage' ),
		esc_html__( 'Engage', 'engage' ) 
	),
	"description" => esc_html__( "Display person details.", "engage" ),
	"params" => $params 
);