<?php 

// Engage Image Slider

return array(
	"name" => esc_html__( "Image Grid", "engage" ),
	"base" => "vntd_image_grid",
	"icon" => "fa-th",
	"class" => "font-awesome",
	"category" => array(
		esc_html__( "Media", "engage" ) 
	),
	"description" => esc_html__( "Simple Image Gallery.", "engage" ),
	"params" => array(
		 array(
			'type' => 'attach_images',
			'heading' => esc_html__( 'Images', "engage" ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_html__( 'Select images from media library.', "engage" ) 
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Images Size", "engage" ),
			"param_name" => "img_size",
			"value" => array(
				esc_html__( "Square", "engage" ) . ' (600x600)' => "square",
				esc_html__( "Masonry", "engage" ) . ' (600x***) - original aspect ratio' => "masonry",
				esc_html__( "Regular", "engage" ) . ' (600x420)' => "regular",
				esc_html__( "Custom size", "engage" ) => "custom" 
			),
			"description" => esc_html__( "Choose image size.", "engage" ),
		),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Custom Image Size', 'engage' ),
				'param_name' => 'img_size_custom',
				'value' => '600x500',
				'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full. Alternatively enter image size in pixels: 500x600 (Width x Height).', 'engage' ),
				'dependency' => Array(
					"element" => "img_size",
					'value' => array(
						"custom" 
					) 
				),
			),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'On click', "engage" ),
			'param_name' => 'onclick',
			'value' => array(
				esc_html__( 'Open lightbox', "engage" ) => 'image_lightbox',
				esc_html__( 'Do nothing', "engage" ) => 'disable' 
			),
			'description' => esc_html__( 'Define action for onclick event if needed.', "engage" ) 
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Hover Effect', "engage" ),
			'param_name' => 'hover',
			'value' => array(
				esc_html__( 'Scale image + Zoom Icon', "engage" ) => 'scale__icon',
				esc_html__( 'Scale image', "engage" ) => 'scale',
				esc_html__( 'Fade out image + Zoom Icon', "engage" ) => 'fadeout__icon',
				esc_html__( 'Fade out image', "engage" ) => 'fadeout',
				esc_html__( 'Darken image + Zoom Icon', "engage" ) => 'darken__icon',
				esc_html__( 'Darken image', "engage" ) => 'darken',
				esc_html__( 'None', "engage" ) => 'none' 
			),
			'description' => esc_html__( 'Specify the image hover effect.', "engage" ),
			"dependency" => Array(
				"element" => "onclick",
				'value' => array(
					'image_lightbox',
				) 
			)
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Columns", "engage" ),
			"param_name" => "cols",
			"value" => array( 6, 5, 4, 3, 2, 1 ),
			"std" => "3",
			'edit_field_class' => 'vc_col-sm-4',
			"description" => esc_html__( "Number of the image grid columns.", "engage" ) 
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Columns Tablet", "engage" ),
			"param_name" => "cols_tablet",
			"value" => array( esc_html( 'Default', 'engage' ) => '', 5, 4, 3, 2, 1 ),
			"std" => '',
			'edit_field_class' => 'vc_col-sm-4',
			"description" => esc_html__( "Number of columns on tablet devices.", "engage" ) 
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Columns Mobile", "engage" ),
			"param_name" => "cols_mobile",
			"value" => array( esc_html( 'Default', 'engage' ) => '', 4, 3, 2, 1 ),
			"std" => '',
			'edit_field_class' => 'vc_col-sm-4',
			"description" => esc_html__( "Number of columns on smartphone mobile devices.", "engage" ) 
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Item Gap", "engage" ),
			"param_name" => "gap",
			"value" => array( '0px', '1px', '2px', '3px', '4px', '5px', '7px', '10px', '12px', '15px', '20px', '25px', '30px', '35px', '40px' ),
			"std" => "5px",
			'edit_field_class' => 'vc_col-sm-6',
			"description" => esc_html__( "Specify the gap between gallery items.", "engage" ) 
		),
        array(
			"type" => "dropdown",
			"heading" => esc_html__( "Display Caption?", "engage" ),
			"param_name" => "captions",
			"value" => array( 
                esc_html__( 'Yes', 'engage' ) => '',
                esc_html__( 'No', 'engage' ) => 'no'
            ),
			"description" => esc_html__( "Enable a caption displayed under the image. Caption can be set directly in your Media library for each image.", "engage" ) 
		),
		array(
	        'type' => 'css_editor',
	        'heading' => esc_html__( 'Css', 'engage' ),
	        'param_name' => 'css',
	        'group' => esc_html__( 'Design options', 'engage' ),
	    ),
		
	) 
);