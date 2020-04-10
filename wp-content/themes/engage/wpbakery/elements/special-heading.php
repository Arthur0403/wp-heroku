<?php

// Engage Image Slider

return array(
		"name" => esc_html__( "Special Heading", "engage" ),
	"base" => "special_heading",
	"class" => "font-awesome",
	"icon" => "fa-header",
	"description" => esc_html__( "Centered heading text", 'engage' ),
	"category" => esc_html__( 'Content', 'engage' ),
	"params" => array_merge(
		array(
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Title", "engage" ),
				"param_name" => "title",
				"holder" => "h5",
				"description" => esc_html__( "Main heading text. Use (b)word(/b) tags for highlighted text.", "engage" ),
				"value" => "This is a Special Heading"
			),
			array(
				"type" => "textarea",
				"heading" => esc_html__( "Subtitle", "engage" ),
				"param_name" => "subtitle",
				"holder" => "span",
				"description" => esc_html__( "Smaller text visible below the Title. Use (b)word(/b) tags for highlighted words.", "engage" ),
				"value" => "This is a subtitle, feel free to change it!"
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Alignment", "engage" ),
				"param_name" => "align",
				"description" => esc_html__( "Set alignment for the special heading texts.", "engage" ),
				'value' => array(
					esc_html__( 'Theme defaults', "engage" ) => 'default',
					esc_html__( 'Left', "engage" ) => 'left',
					esc_html__( 'Center', "engage" ) => 'center',
					esc_html__( 'Right', "engage" ) => 'right',
				),
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Border", "engage" ),
				"param_name" => "border",
				"description" => esc_html__( "Border for the special heading. Below - displayed below the heading. Inline - line is displayed next to the heading.", "engage" ),
				'value' => array(
					esc_html__( 'Theme defaults', "engage" ) => 'default',
					esc_html__( 'Below the heading', "engage" ) => 'below',
					esc_html__( 'Inline border - next to the heading', "engage" ) => 'inline',
					esc_html__( 'Disable', "engage" ) => 'disable',
				),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Margin Top", "engage" ),
				"param_name" => "c_margin_top",
				"description" => esc_html__( "Special heading top margin. Leave blank for defaults.", "engage" ),
				"value" => ""
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Margin Bottom", "engage" ),
				"param_name" => "c_margin_bottom",
				"description" => esc_html__( "Special heading bottom margin. Leave blank for defaults", "engage" ),
				"value" => ""
			),
			// Begin Icons
			array(
				"type" => "checkbox",
				"heading" => esc_html__( "Add Icon?", "engage" ),
				"param_name" => "add_icon",
				"class" => "hidden-label",
				"value" => array(
					esc_html__( "Yes", "engage" ) => "true",
				),
				"description" => esc_html__( "Display icon above the special heading.", "engage" )
			),
		),
		engage_vc_icon_params( 'add_icon' ),
		// End icons
		array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra class name', "engage" ),
				'param_name' => 'el_class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', "engage" )
			),
	//			array(
	//				"type" => "dropdown",
	//				"heading" => esc_html__( "Animation", "engage" ),
	//				"param_name" => "animated",
	//				"class" => "hidden-label",
	//				"value" => array(
	//					esc_html__( "No", "engage" ) => "no",
	//					esc_html__( "Yes", "engage" ) => "yes"
	//				),
	//				"description" => esc_html__( "Enable the fade-in animation of the heading elements on site scroll.", "engage" )
	//			),
			array(
				"type" => "dropdown",
				"class" => "hidden-label",
				"heading" => esc_html__( "Heading Font Size", "engage" ),
				"param_name" => "font_size",
				"value" => array(
					esc_html__( 'Theme defaults' , 'engage' ) => 'default',
					'20px' => '20px',
					'22px' => '22px',
					'24px' => '24px',
					'28px' => '28px',
					'32px' => '32px',
					'36px' => '36px',
					'40px' => '40px',
					'44px' => '44px',
					'48px' => '48px',
					'52px' => '52px',
					'56px' => '56px'
				),
				'description' => esc_html__( 'Size of the main title font.', 'engage' ),
				'group' => esc_html__( "Design", "engage" )
			),
			array(
				"type" => "dropdown",
				"class" => "hidden-label",
				"heading" => esc_html__( "Heading Font Weight", "engage" ),
				"param_name" => "font_weight",
				"value" => array(
					esc_html__( 'Theme defaults', 'engage' ) => 'default',
					esc_html__( 'Light', 'engage' ) => '300',
					esc_html__( 'Normal', 'engage' ) => '400',
					esc_html__( 'Bold', 'engage' ) => '700'
				),
				'description' => esc_html__( 'Font weight of the Title.', 'engage' ),
				'group' => esc_html__( "Design", "engage" ),
				'dependency' => array(
					'element' => 'font_family',
					'value_not_equal_to' => 'custom',
				),
			),
			array(
				"type" => "dropdown",
				"class" => "hidden-label",
				"heading" => esc_html__( "Heading Font Transform", "engage" ),
				"param_name" => "text_transform",
				"value" => array(
					esc_html__( 'Theme defaults', 'engage' ) => 'default',
					esc_html__( 'None', 'engage' ) => 'none',
					esc_html__( 'Uppercase', 'engage' ) => 'uppercase'
				),
				'description' => esc_html__( 'Text transform attribute for the Title.', 'engage' ),
				'group' => esc_html__( "Design", "engage" )
			),
			array(
				"type" => "dropdown",
				"class" => "hidden-label",
				"heading" => esc_html__( "Heading HTML Tag", "engage" ),
				"param_name" => "heading_tag",
				"value" => array(
					esc_html__( 'Theme defaults' , 'engage' ) => 'default',
					'h1' => 'h1',
					'h2' => 'h2',
					'h3' => 'h3',
					'h4' => 'h4',
					'h5' => 'h5',
					'h6' => 'h6',
				),
				'description' => esc_html__( 'Select a HTML tag for the main heading.', 'engage' ),
				'group' => esc_html__( "Design", "engage" )
			),
			array(
				"type" => "dropdown",
				"class" => "hidden-label",
				"heading" => esc_html__( "Heading Color", "engage" ),
				"param_name" => "heading_color",
				"value" => array(
					esc_html__( 'Theme defaults' , 'engage' ) => '',
					esc_html__( "Accent Color", 'engage' ) => 'accent',
					esc_html__( "Accent Color 2", 'engage' ) => 'accent-2',
					esc_html__( "Accent Color 3", 'engage' ) => 'accent-3',
					esc_html__( "Predefined Gradient 1", 'engage' ) => 'gradient-1',
					esc_html__( "Predefined Gradient 2", 'engage' ) => 'gradient-2',
				),
				'description' => esc_html__( 'Select the heading text color. You may adjust customize in Theme Optionso / Styling panel.', 'engage' ),
				'group' => esc_html__( "Design", "engage" )
			),
			array(
				"type" => "dropdown",
				"class" => "hidden-label",
				"heading" => esc_html__( "Subtitle Font Family", "engage" ),
				"param_name" => "subtitle_ff",
				"value" => array(
					esc_html__( 'Theme Defaults', 'engage' ) => "default",
					esc_html__( 'Additional Font specified in Theme Options', 'engage' ) => "additional",
				),
				"description" => esc_html__( "Select a font family for the subtitle.", "engage" ),
				"group" => esc_html__( "Design", "engage" )
			),
			array(
				"type" => "dropdown",
				"class" => "hidden-label",
				"heading" => esc_html__( "Subtitle Font Size", "engage" ),
				"param_name" => "subtitle_fs",
				"value" => array(
					esc_html__( 'Theme defaults' , 'engage' ) => 'default',
					'12px' => '12px',
					'13px' => '13px',
					'14px' => '14px',
					'15px' => '15px',
					'16px' => '16px',
					'17px' => '17px',
					'18px' => '18px',
					'20px' => '20px',
					'22px' => '22px',
					'24px' => '24px',
					'26px' => '26px'
				),
				'description' => esc_html__( 'Size of the subtitle font.', 'engage' ),
				'group' => esc_html__( "Design", "engage" )
			),
			array(
				"type" => "dropdown",
				"class" => "hidden-label",
				"heading" => esc_html__( "Subtitle Color", "engage" ),
				"param_name" => "subtitle_color",
				"value" => array(
					esc_html__( 'Theme Defaults', 'engage' ) => '',
					esc_html__( "Accent Color", 'engage' ) => 'accent',
					esc_html__( "Accent Color 2", 'engage' ) => 'accent-2',
					esc_html__( "Accent Color 3", 'engage' ) => 'accent-3',
					esc_html__( "Predefined Gradient 1", 'engage' ) => 'gradient-1',
					esc_html__( "Predefined Gradient 2", 'engage' ) => 'gradient-2',
				),
				'description' => esc_html__( 'Subtitle text color.', 'engage' ),
				'group' => esc_html__( "Design", "engage" )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Subtitle Top Margin', "engage" ),
				'param_name' => 'subtitle_mt',
				'description' => esc_html__( 'Set a specific top margin in pixels. Example: 20px. Leave blank for default. ', "engage" ),
				'group' => esc_html__( "Design", "engage" )
			),
		)

	)
);
