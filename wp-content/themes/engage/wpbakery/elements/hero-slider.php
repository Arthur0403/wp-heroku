<?php

// Hero Slider

return array(
	"name" => esc_html__( "Hero Slider", "engage" ),
	"base" => "vntd_hero_slider",
	"class" => "font-awesome",
	"icon" => "fa-picture-o",
	"description" => esc_html__( "Simple content slider.", "engage" ),
	"category" => esc_html__( 'Content', 'engage' ),
	"params" => array(
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Slides', "engage" ),
			'param_name' => 'slides',
			'description' => esc_html__( 'Add slides to your Hero Slider.', "engage" ),
			'value' => urlencode( json_encode( array(
				 array(
					'heading' => esc_html__( 'Slide Heading', "engage" ),
					'text' => esc_html__( 'This is an example slide text content, feel free to change it.', 'engage' ),
					'btn_label' => esc_html__( 'Learn More', 'engage' ),
					'btn_url' => '#',
					'image' => '',
					'align' => '',
					'color' => '',
					'bg_color' => ''
				),
				array(
					'heading' => esc_html__( 'Second Heading', "engage" ),
					'text' => esc_html__( 'This is another example slide text content, feel free to change it.', 'engage' ),
					'btn_label' => esc_html__( 'Learn More', 'engage' ),
					'btn_url' => '#',
					'image' => '',
					'align' => 'center',
					'color' => '',
					'bg_color' => ''
				),
			) ) ),
			'params' => array(
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Slide Image', "engage" ),
					'param_name' => 'image',
					'value' => '',
					'description' => esc_html__( 'Select the slide background image.', "engage" )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Slide Heading', "engage" ),
					'param_name' => 'heading',
					'admin_label' => true,
					'description' => esc_html__( 'Enter the slide heading.', "engage" ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Slide Content', "engage" ),
					'param_name' => 'text',
					'description' => esc_html__( 'Slide text content.', "engage" )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Label', "engage" ),
					'param_name' => 'btn_label',
					'description' => esc_html__( 'Slide button label.', "engage" )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button URL', "engage" ),
					'param_name' => 'btn_url',
					'description' => esc_html__( 'Button URL.', "engage" ),
				),
				array(
					"type" => "dropdown",
					"class" => "hidden-label",
					"heading" => esc_html__( "Content Align", "engage" ),
					"param_name" => "align",
					"value" => array(
						esc_html__( 'Center', 'engage' ) => "center",
						esc_html__( 'Left', 'engage' ) => "left",
						esc_html__( 'Right', 'engage' ) => "right"
					),
					"description" => esc_html__( "Choose the alignment of the slide content.", "engage" )
				),
				array(
					"type" => "dropdown",
					"class" => "hidden-label",
					"heading" => esc_html__( "Color Scheme", "engage" ),
					"param_name" => "color",
					"value" => array(
						esc_html__( 'White', 'engage' ) => "white",
						esc_html__( 'Dark', 'engage' ) => "dark",
					),
					"description" => esc_html__( "Choose a color scheme of the slide text content.", "engage" )
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_html__( "Background Image Overlay", 'engage' ),
					"param_name" => "bg_overlay",
					"value" => $bg_overlay_arr,
					"description" => esc_html__( "Set a background overlay to darken or lighten the background image and improve text visibility.", "engage" )
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', "engage" ),
					'param_name' => 'bg_color',
					'value' => '',
					'description' => esc_html__( 'Select the slide background color.', "engage" )
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color 2', "engage" ),
					'param_name' => 'bg_color2',
					'value' => '',
					'description' => esc_html__( 'Choose a secondary color to create a beautiful gradient.', "engage" )
				),
			)
		),

		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Slider Height", "engage" ),
			"param_name" => "height",
			"group" => esc_html__( "Settings", "engage" ),
			"value" => array(
				esc_html__( 'Custom', 'engage' ) => 'custom',
				esc_html__( 'Fullscreen', 'engage' ) => 'fullscreen',
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Custom Height', "engage" ),
			'param_name' => 'height_custom',
			'dependency' => array(
				"element" => 'height',
				'value' => 'custom'
			),
			'value' => '700px',
			"group" => esc_html__( "Settings", "engage" ),
			"description" => esc_html__( "Set a custom height for your hero section in pixels i.e: 400px, 600px, 800px", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"value" => array(
				esc_html__( 'Fullwidth', 'engage' ) => 'fullwidth',
				esc_html__( 'No', 'engage' ) => 'no'
			),
			"heading" => esc_html__( "Fullwidth section?", "engage" ),
			"param_name" => "fullwidth",
			"description" => esc_html__( "Stretch the section to take 100% of the browser window?", "engage" ),
			"group" => esc_html__( "Settings", "engage" )
		),
		array(
			"type" => "checkbox",
			"class" => "hidden-label",
			"heading" => esc_html__( "Arrow Navigation", "engage" ),
			"param_name" => "nav",
			"std" => "true",
			'value' => array( esc_html__( 'Yes', 'engage' ) => 'true' ),
			"description" => esc_html__( "Enable the arrow navigation.", "engage" ),
			'group' => esc_html__( "Settings", "engage" )
		),
		array(
			"type" => "checkbox",
			"class" => "hidden-label",
			"heading" => esc_html__( "Slider Autoplay", "engage" ),
			"param_name" => "autoplay",
			"std" => "true",
			'value' => array( esc_html__( 'Yes', 'engage' ) => 'true' ),
			"description" => esc_html__( "Enable the autoplay of the carousel.", "engage" ),
			'group' => esc_html__( "Settings", "engage" )
		),
		array(
			"type" => "textfield",
			"class" => "hidden-label",
			"heading" => esc_html__( "Autoplay Speed", "engage" ),
			"param_name" => "autoplay_timeout",
			"value" => "7000",
			"description" => esc_html__( "Time beetween slides in miliseconds i.e. 1000 = 1 second. Default: 7000", "engage" ),
			'group' => esc_html__( "Settings", "engage" ),
			"dependency" => Array(
				"element" => "autoplay",
				'value' => array(
					"true" 
				)
			),
		),
		array(
			"type" => "checkbox",
			"class" => "hidden-label",
			"heading" => esc_html__( "Scroll down button?", "engage" ),
			"param_name" => "scroll_btn",
			'value' => array( esc_html__( 'Yes', 'engage' ) => 'true' ),
			"description" => esc_html__( "Enable a button that scrolls below the hero section.", "engage" ),
			'group' => esc_html__( "Settings", "engage" ),
		),

		// Design Tab
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Main Heading Font Size", "engage" ),
			"param_name" => "heading_size",
			//"std"	=> "default",
			"value" => array(
				esc_html__( 'Default value', 'engage' ) => 'default',
				'40px' => '40px',
				'46px' => '46px',
				'50px' => '50px',
				'52px' => '52px',
				'56px' => '56px',
				'64px' => '64px',
				'68px' => '68px',
				'72px' => '72px'
			),
			'group' => esc_html__( "Design", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Subtitle Font Size", "engage" ),
			"param_name" => "subtitle_fs",
			//"std"	=> "default",
			"value" => array(
				esc_html__( 'Default value', 'engage' ) => 'default',
				'14px' => '14px',
				'15px' => '15px',
				'16px' => '16px',
				'18px' => '18px',
				'20px' => '20px',
				'22px' => '22px',
				'24px' => '24px',
				'26px' => '26px'
			),
			'group' => esc_html__( "Design", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Content container width", "engage" ),
			"param_name" => "subtitle_width",
			"value" => array(
				'Default' => 'default',
				'Narrow (500px)' => 'narrow'
			),
			'group' => esc_html__( "Design", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Button Color", "engage" ),
			"param_name" => "button1_color",
			"value" => array(
				'Light' => "light",
				'Dark' => "dark"
			),
			'dependency' => array(
				"element" => 'button1_label',
				'not_empty' => true
			),
			'group' => esc_html__( "Design", "engage" )
		),
		array(
		   "type" => "dropdown",
		   "class" => "hidden-label",
		   "heading" => esc_html__( "Buttons Border Radius", "engage" ),
		   "param_name" => "btn_radius",
		   "value" => array(
		   	esc_html__( "Default", "engage" ) => "default",
		   	esc_html__( "Circle", "engage" ) => "circle",
		   	esc_html__( "Square (no radius)", "engage" ) => "square",
		   ),
		   	'group' => esc_html__( "Design", "engage" )
		),


	)
);
