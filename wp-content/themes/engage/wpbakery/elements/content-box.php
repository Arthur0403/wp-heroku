<?php 

// Portfolio Grid

return array(
	"name" => esc_html__( "Content Box", "engage" ),
	"base" => "vntd_content_box",
	"class" => "font-awesome",
	"icon" => "fa-square-o",
	"controls" => "full",
	"category" => array(
		esc_html__( 'Engage', 'engage' ),
	),
	"description" => esc_html__( "Simple content box.", 'engage' ),
	"params" => array(
		
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Item Image', "engage" ),
			'param_name' => 'img',
			'value' => '',
			'description' => esc_html__( 'Select featured image.', "engage" ) 
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Item Title', "engage" ),
			'param_name' => 'title',
			'admin_label' => true,
			'value' => esc_html__( 'Item Title', 'engage' ),
			'description' => esc_html__( 'Enter the item title.', "engage" ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Item Description', "engage" ),
			'param_name' => 'text',
			'description' => esc_html__( 'Enter an optional item description.', "engage" ) 
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Button Label', "engage" ),
			'param_name' => 'btn_label',
			'value' => esc_html__( 'Learn More', 'engage' ),
			'description' => esc_html__( 'Item button label.', "engage" ) 
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Item Linke Type", "engage" ),
			"param_name" => "link_type",
			"value" => array(
				esc_html__( "Inner Page", "engage" ) => "inner",
				esc_html__( "External URL", "engage" ) => "external",
			),
			"description" => esc_html__( "Choose link source type.", "engage" ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Item URL', "engage" ),
			'param_name' => 'item_url',
			'description' => esc_html__( 'Optional item URL.', "engage" ),
			'dependency' => Array(
				"element" => "link_type",
				'value' => array(
					"external" 
				) 
			) 
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Item Link Page', "engage" ),
			'param_name' => 'item_link_page',
			'value' => engage_vc_pages_array(),
			'description' => esc_html__( 'Optional item URL.', "engage" ),
			'dependency' => Array(
				"element" => "link_type",
				'value' => array(
					"inner" 
				) 
			) 
		),
		
		// Item Style
		
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Image Size", "engage" ),
			"param_name" => "img_size",
			"value" => array(
				esc_html__( "Regular", "engage" ) => "regular",
				esc_html__( "Portrait", "engage" ) => "portrait",
				esc_html__( "Custom", "engage" ) => "custom" 
			),
			"description" => esc_html__( "Choose thumbnail size.", "engage" ),
			"group" => esc_html__( "Item Design", 'engage' )
		),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Custom Image Size', 'engage' ),
				'param_name' => 'img_size_custom',
				'value' => '600x360',
				'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full. Alternatively enter image size in pixels: 200x100 (Width x Height).', 'engage' ),
				"group" => esc_html__( "Item Design", 'engage' ),
				'dependency' => Array(
					"element" => "img_size",
					'value' => array(
						"custom" 
					) 
				),
			),
		
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Caption Style", "engage" ),
			"param_name" => "caption_style",
			"value" => array(
				esc_html__( "Boxed", "engage" ) => "boxed",
				esc_html__( "Boxed no border", "engage" ) => "boxed_no_border",
				esc_html__( "Classic", "engage" ) => "classic" 
			),
			"description" => esc_html__( "Choose caption style.", "engage" ),
			"group" => esc_html__( "Item Design", 'engage' )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Caption Title Tag", "engage" ),
			"param_name" => "title_tag",
			"value" => array(
				esc_html__( "Theme Defaults", "engage" ) => "",
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			),
			"description" => esc_html__( "Choose HTML tag for the caption title.", "engage" ),
			"group" => esc_html__( "Item Design", 'engage' )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Caption Alignment", "engage" ),
			"param_name" => "caption_align",
			"value" => array(
				esc_html__( "Left", "engage" ) => "left",
				esc_html__( "Center", "engage" ) => "center" 
			),
			"description" => esc_html__( "Set alignment of the caption's content.", "engage" ),
			"group" => esc_html__( "Item Design", 'engage' )
		),
		
		// Image Hover Effect
		
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Item Image Hover Effect", "engage" ),
			"param_name" => "image_hover_effect",
			"value" => array(
				esc_html__( "Zoom Image", "engage" ) => "zoom",
				esc_html__( "None", "engage" ) => "none" ,
			),
			"description" => esc_html__( "Choose a hover effect for grid images.", "engage" ),
			"group" => esc_html__( "Item Design", 'engage' )
		),
		
		// Arrow
		
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Button Arrow", "engage" ),
			"param_name" => "btn_arrow",
			"value" => array(
				esc_html__( "Yes", "engage" ) => "yes",
				esc_html__( "No", "engage" ) => "no" 
			),
			"description" => esc_html__( "Enable or disable the button arrow.", "engage" ),
			"group" => esc_html__( "Item Design", 'engage' )
		),
		
	) 
);