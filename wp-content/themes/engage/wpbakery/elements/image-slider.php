<?php 

// Engage Image Slider

return array(
	"name" => esc_html__( "Image Slider", "engage" ),
	"base" => "engage_image_slider",
	"icon" => "fa-file-picture-o",
	"class" => "font-awesome",
	"category" => array(
		esc_html__( "Media", "engage" ) 
	),
	"description" => esc_html__( "Simple Image Slider.", "engage" ),
	"params" => array(
		 array(
			'type' => 'attach_images',
			'heading' => esc_html__( 'Images', "engage" ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_html__( 'Select images from media library.', "engage" ) 
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Images size', 'engage' ),
			'param_name' => 'img_size',
			'value' => 'large',
			'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size. If used slides per view, this will be used to define carousel wrapper size.', 'engage' ),
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
			'type' => 'checkbox',
			'heading' => esc_html__( 'Slider autoplay', 'engage' ),
			'param_name' => 'autoplay',
			'std' => 'yes',
			'description' => esc_html__( 'Enable autoplay mode.', 'engage' ),
			'value' => array( esc_html__( 'Yes', 'engage' ) => 'yes' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Bullet Navigation', 'engage' ),
			'param_name' => 'bullet_nav',
			'std' => 'yes',
			'description' => esc_html__( 'Enable bullet navigation.', 'engage' ),
			'value' => array( esc_html__( 'Yes', 'engage' ) => 'yes' ),
		),
//			array(
//				'type' => 'checkbox',
//				'heading' => esc_html__( 'Arrow Navigation', 'engage' ),
//				'param_name' => 'arrow_nav',
//				'description' => esc_html__( 'Enable arrow navigation.', 'engage' ),
//				'value' => array( esc_html__( 'Yes', 'engage' ) => 'yes' ),
//			),
	) 
);