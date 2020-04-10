<?php

// Hero Section

//array_push( $bg_overlay_arr, array( esc_html__( "Custom", 'engage' ) ) );

$bg_overlay_arr[ esc_html__( "Custom color", 'engage' ) ] = 'custom';

return array(
	"name" => esc_html__( "Hero Section", "engage" ),
	"base" => "vntd_hero_section",
	"class" => "font-awesome",
	"icon" => "fa-eye",
	"description" => esc_html__( "Simple Hero Section", 'engage' ),
	"category" => array( esc_html__( 'Content', 'engage' ), 'Engage' ),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Top Heading", "engage" ),
			"param_name" => "top_heading",
			"description" => esc_html__( "Additional heading displayed above the main one.", "engage" ),
			"value" => "",
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Main Heading", "engage" ),
			"param_name" => "heading",
			"description" => esc_html__( "Main Heading.", "engage" ),
			"value" => "Design Your Life",
		),

		array(
			"type" => "textarea",
			"heading" => esc_html__( "Subtitle", "engage" ),
			"param_name" => "subtitle",
			"description" => esc_html__( "Smaller text visible below the Main one.", "engage" ),
			"value" => "Contrary to popular belief, Lorem Ipsum is not simply random text. Piece of classical Latin literature."
		),

		array(
			"type" => "textfield",
			"heading" => esc_html__( "Button 1 Label", "engage" ),
			"param_name" => "btn1_label",
			"description" => esc_html__( "First button label.", "engage" ),
			"value" => "Button Text",
		),
        array(
            "type" => "dropdown",
            "class" => "hidden-label",
            "heading" => esc_html__( "Button 1 Action", "engage" ),
            "param_name" => "btn1_action",
            "value" => array(
                esc_html__( "Link", "engage" ) => "link",
                esc_html__( "Open Video Lightbox", "engage" ) => "video"
            ),
            'dependency' => array(
                "element" => 'btn1_label',
                'not_empty' => true,
            ),
            "description" => esc_html__( "Choose the click action for the button.", "engage" )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__( "Button 1 Video URL", "engage" ),
            "param_name" => "btn1_video",
            "description" => esc_html__( "Enter the URL for a lightbox video (YouTube or Vimeo only), like:", "engage" ) . ' http://www.youtube.com/watch?v=7HKoqNJtMTQ',
            'dependency' => array(
                "element" => 'btn1_action',
                'value' => 'video',
            ),
        ),
		array(
			"type" => "vc_link",
			"heading" => esc_html__( "Button 1 URL", "engage" ),
			"param_name" => "btn1_url",
			"description" => esc_html__( "First button URL (external link or #section_id)", "engage" ),
			'dependency' => array(
				"element" => 'btn1_action',
				'value' => 'link',
			),
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Button 2 Label", "engage" ),
			"param_name" => "btn2_label",
			"description" => esc_html__( "Secondary button label.", "engage" ),
			"value" => ""
		),
        array(
            "type" => "dropdown",
            "class" => "hidden-label",
            "heading" => esc_html__( "Button 2 Action", "engage" ),
            "param_name" => "btn2_action",
            "value" => array(
                esc_html__( "Link", "engage" ) => "link",
                esc_html__( "Open Video Lightbox", "engage" ) => "video"
            ),
            'dependency' => array(
                "element" => 'btn2_label',
                'not_empty' => true,
            ),
            "description" => esc_html__( "Choose the click action for the button.", "engage" )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__( "Button 2 Video URL", "engage" ),
            "param_name" => "btn2_video",
            "description" => esc_html__( "Enter the URL for a lightbox video (YouTube or Vimeo only), like:", "engage" ) . ' http://www.youtube.com/watch?v=7HKoqNJtMTQ',
            'dependency' => array(
                "element" => 'btn2_action',
                'value' => 'video',
            ),
        ),
		array(
			"type" => "vc_link",
			"heading" => esc_html__( "Button 2 URL", "engage" ),
			"param_name" => "btn2_url",
			"description" => esc_html__( "Secondary button URL (external link or #section_id)", "engage" ),
            'dependency' => array(
                "element" => 'btn2_action',
                'value' => 'link',
            ),
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Content Align", "engage" ),
			"param_name" => "content_align",
			"value" => array(
				esc_html__( "Center", "engage" ) => "center",
				esc_html__( "Left", "engage" ) => "left",
				esc_html__( "Right", "engage" ) => 'right'
			),
			"description" => esc_html__( "Choose the alignment of the hero section text content (heading, subtitle, button).", "engage" )
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Extra Image', "engage" ),
			'param_name' => 'img_extra',
			'value' => '',
			'description' => esc_html__( 'Upload an extra image to be displayed in your Hero Section. It will be displayed above the texts.', "engage" ),
			'dependency' => array(
				"element" => 'content_align',
				'value' => 'center'
			),
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Extra Image Width", "engage" ),
			"param_name" => "img_width",
			"description" => esc_html__( "Width of your extra image i.e. 500px, 80%.", "engage" ),
			"value" => "500px",
			'dependency' => array(
				"element" => 'content_align',
				'value' => 'center'
			),
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Extra Image Top Margin", "engage" ),
			"param_name" => "img_margin",
			"description" => esc_html__( "Top margin of your extra image i.e. 100px to push the image down by 100 pixels.", "engage" ),
			"value" => "0px",
			'dependency' => array(
				"element" => 'content_align',
				'value' => 'center'
			),
		),
		array(
			"type" => "checkbox",
			"class" => "hidden-label",
			"heading" => esc_html__( "Scroll down button?", "engage" ),
			"param_name" => "scroll_btn",
			'value' => array( esc_html__( 'Yes', 'engage' ) => 'true' ),
			"description" => esc_html__( "Enable a button that scrolls below the hero section.", "engage" )
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Scroll Offset", "engage" ),
			"param_name" => "scroll_offset",
			"description" => esc_html__( "Insert offset in pixels for the scroll effect after clicking the Scroll button i.e. 20px = scroll 20px more.", "engage" ),
			"value" => "",
			'dependency' => array(
				"element" => 'scroll_btn',
				'value' => 'true'
			)
		),

		// Background Group

		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Background Type", "engage" ),
			"param_name" => "media_type",
			"value" => array(
				esc_html__( 'Images', 'engage' ) => 'images',
				esc_html__( 'YouTube video', 'engage' ) => 'youtube',
				esc_html__( 'Self hosted video', 'engage' ) => 'video'
			),
			"group" => esc_html__( "Background", "engage" ),
		),
		array(
			'type' => 'attach_images',
			'heading' => esc_html__( 'Images', "engage" ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_html__( 'Select images from media library. If more than one is selected they will be displayed as a slider.', "engage" ),
			'dependency' => array(
				"element" => 'media_type',
				'value' => 'images'
			),
			"group" => esc_html__( "Background", "engage" ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'YouTube video ID', "engage" ),
			'param_name' => 'youtube_id',
			'value' => 'https://youtu.be/SLC1y4nAyzE', // default video url
			'description' => esc_html__( 'Insert your desired YouTube video ID. Example: nKAxHHTxXIU', "engage" ),
			'dependency' => array(
				"element" => 'media_type',
				'value' => array(
					'youtube'
				)
			),
			"group" => esc_html__( "Background", "engage" ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Video URL', "engage" ),
			'param_name' => 'video_url',
			'value' => '', // default video url
			'description' => esc_html__( 'Insert link to the self hosted video, like: http://www.site.com/video.mp4', "engage" ),
			'dependency' => array(
				"element" => 'media_type',
				'value' => array(
					'video'
				)
			),
			"group" => esc_html__( "Background", "engage" ),
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Video Placeholder', "engage" ),
			'param_name' => 'video_img',
			'value' => '',
			'description' => esc_html__( 'Select an image that will be used as a placeholder until the video is loaded.', "engage" ),
			'dependency' => array(
				"element" => 'media_type',
				'value' => array( 'youtube', 'video' )
			),
			"group" => esc_html__( "Background", "engage" ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Images Carousel Autoplay', "engage" ),
			'param_name' => 'img_autoplay',
			'value' => '15000',
			'description' => esc_html__( 'Set the images carousel autoplay timeout. In miliseconds. I.e. 15000 = 15 seconds. Set to 0 to disable autoplay.', "engage" ),
			'dependency' => array(
				"element" => 'media_type',
				'value' => array( 'images' )
			),
			"group" => esc_html__( "Background", "engage" ),
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__( "Background Image Overlay", 'engage' ),
			"param_name" => "bg_overlay",
			"value" => $bg_overlay_arr,
			"group" => esc_html__( "Background", "engage" ),
			"description" => esc_html__( "Set a background overlay to darken or lighten the background image/video and make the text better visible.", "engage" )
		),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Overlay color', "engage" ),
				'param_name' => 'bg_overlay_color',
				"class" => "hidden-label",
				'value' => '', // default video url
				'description' => esc_html__( 'Choose a custom color for the section overlay.', "engage" ),
				'dependency' => array(
					"element" => 'bg_overlay',
					'value' => array(
						'custom'
					)
				),
				'group' => esc_html__( "Background", "engage" )
			),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__( "Background Image Position", 'engage' ),
			"param_name" => "bg_img_position",
			"value" => $bg_position_arr,
			"group" => esc_html__( "Background", "engage" ),
			'dependency' => array(
				"element" => 'media_type',
				'value' => array( 'images' )
			),
			"description" => esc_html__( "Define the background image CSS position.", "engage" )
		),
		engage_vc_gradient_color1( 'Background' ),
		engage_vc_gradient_color2( 'Background' ),
		//
		// Settings Group
		//

		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Height", "engage" ),
			"param_name" => "height",
			"group" => esc_html__( "Settings", "engage" ),
			"value" => array(
				esc_html__( 'Fullscreen', 'engage' ) => 'fullscreen',
				esc_html__( 'Custom', 'engage' ) => 'custom'
			),
			'edit_field_class' => 'vc_col-sm-6',
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
			'edit_field_class' => 'vc_col-sm-6',
			"description" => esc_html__( "Set a custom height for your hero section in pixels i.e: 400px, 600px, 800px", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"value" => array(
				esc_html__( 'Fullwidth', 'engage' ) => 'fullwidth',
				esc_html__( 'Fullwidth, stretch content', 'engage' ) => 'fullwidth-stretch',
				esc_html__( 'No', 'engage' ) => 'no'
			),
			"heading" => esc_html__( "Fullwidth section?", "engage" ),
			"param_name" => "fullwidth",
			"description" => esc_html__( "Stretch the section to take 100% of the browser window?", "engage" ),
			"group" => esc_html__( "Settings", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Content Container", "engage" ),
			"param_name" => "container",
			"value" => array(
				esc_html__( 'Default (in grid)', 'engage' ) => 'default',
				esc_html__( 'Stretch', 'engage' ) => 'stretch'
			),
			"description" => esc_html__( "Should the content stretch horizontally or stay in grid (1170px)?", "engage" ),
			'group' => esc_html__( "Settings", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Content Width", "engage" ),
			"param_name" => "content_width",
			"value" => array(
				esc_html__( 'Default', 'engage' ) => 'default',
				esc_html__( 'Narrow (500px)', 'engage' ) => 'narrow'
			),
			"description" => esc_html__( "Choose the width of the content.", "engage" ),
			'group' => esc_html__( "Settings", "engage" )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Content Vertical Offset', "engage" ),
			'param_name' => 'content_offset',
			'value' => '',
			"group" => esc_html__( "Settings", "engage" ),
			"description" => esc_html__( "Set a vertical offset for the hero section content i.e. 30px to push the content 30 pixels down. You may use negative values like -50px to push the content by 50 pixels to the top.", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"value" => array(
				esc_html__( 'Yes', 'engage' ) => 'yes',
				esc_html__( 'No', 'engage' ) => 'no'
			),
			"heading" => esc_html__( "Parallax?", "engage" ),
			"param_name" => "parallax",
			"description" => esc_html__( "Enable the parallax effect for images.", "engage" ),
			"group" => esc_html__( "Settings", "engage" )
		),
			array(
				"type" => "checkbox",
				"class" => "hidden-label",
				"heading" => esc_html__( "Arrow Navigation", "engage" ),
				"param_name" => "arrow_nav",
				"std" => "true",
				'value' => array( esc_html__( 'Yes', 'engage' ) => 'true' ),
				"description" => esc_html__( "Enable the arrow navigation (if more than one image added).", "engage" ),
				'group' => esc_html__( "Settings", "engage" ),
				'dependency' => array(
					"element" => 'media_type',
					'value' => 'images'
				),
			),

		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"value" => array(
				esc_html__( 'Classic side', 'engage' ) => 'side',
				esc_html__( 'Bottom', 'engage' ) => 'bottom',
			),
			"heading" => esc_html__( "Arrow Navigation Style", "engage" ),
			"param_name" => "arrow_nav_s",
			"description" => esc_html__( "Choose a style for the arrow navigation.", "engage" ),
			'dependency' => array(
				"element" => 'arrow_nav',
				'value' => 'true'
			),
			"group" => esc_html__( "Settings", "engage" )
		),
		array(
			"type" => "checkbox",
			"class" => "hidden-label",
			"heading" => esc_html__( "Video controls?", "engage" ),
			"param_name" => "video_controls",
			"std" => "true",
			'value' => array( esc_html__( 'Yes', 'engage' ) => 'true' ),
			"description" => esc_html__( "Enable video controls (play/pause/mute).", "engage" ),
			'group' => esc_html__( "Settings", "engage" ),
			'dependency' => array(
				"element" => 'media_type',
				'value' => 'youtube'
			),
		),
		array(
			"type" => "checkbox",
			"class" => "hidden-label",
			"heading" => esc_html__( "Mute video?", "engage" ),
			"param_name" => "video_mute",
			"std" => "true",
			'value' => array( esc_html__( 'Yes', 'engage' ) => 'true' ),
			"description" => esc_html__( "Mute the background video.", "engage" ),
			'group' => esc_html__( "Settings", "engage" ),
			'dependency' => array(
				"element" => 'media_type',
				'value' => 'youtube'
			),
		),
		array(
			"type" => "checkbox",
			"class" => "hidden-label",
			"heading" => esc_html__( "Autoplay video?", "engage" ),
			"param_name" => "video_autoplay",
			'value' => array( esc_html__( 'Yes', 'engage' ) => 'true' ),
			"description" => esc_html__( "Play the video automatically?.", "engage" ),
			'group' => esc_html__( "Settings", "engage" ),
			'dependency' => array(
				"element" => 'media_type',
				'value' => 'youtube'
			),
		),

		// Design Tab
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Color Scheme", "engage" ),
			"param_name" => "color",
			"value" => array(
				esc_html__( 'White', 'engage' ) => "white",
				esc_html__( 'Dark', 'engage' ) => "dark",
			),
			"description" => esc_html__( "Choose a color scheme of the hero section texts.", "engage" ),
			"group" => esc_html__( "Styling", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Main Heading Font Size", "engage" ),
			"param_name" => "heading_fs",
			//"std"	=> "default",
			"description" => esc_html__( 'Main heading font size.', 'engage' ),
			"value" => array(
				esc_html__( 'Default value', 'engage' ) => 'default',
				'40px' => '40px',
				'46px' => '46px',
				'50px' => '50px',
				'52px' => '52px',
				'56px' => '56px',
				'64px' => '64px',
				'68px' => '68px',
				'72px' => '72px',
				'76px' => '76px',
				'78px' => '78px',
				'82px' => '82px',
				'86px' => '86px',
				'90px' => '90px',
				'100px' => '100px',
			),
			'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( "Styling", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Heading Font Family", "engage" ),
			"param_name" => "font_family",
			"value" => array(
				esc_html__( 'Theme Defaults', 'engage' ) => "default",
				esc_html__( 'Body Font', 'engage' ) => "body",
				esc_html__( 'Additional Font specified in Theme Options', 'engage' ) => "additional",
				esc_html__( 'Custom Google Font', 'engage' ) => "custom",
			),
			"description" => esc_html__( "Select a type of font for your hero section heading.", "engage" ),
			'edit_field_class' => 'vc_col-sm-4',
			"group" => esc_html__( "Styling", "engage" )
		),
		array(
			'type' => 'google_fonts',
			'param_name' => 'google_font',
			'value' => '',
			'settings' => array(
				'fields' => array(
					'font_family_description' => esc_html__( 'Select font family.', 'engage' ),
					'font_style_description' => esc_html__( 'Select font styling.', 'engage' ),
				),
			),
			'group' => esc_html__( "Styling", "engage" ),
			'edit_field_class' => 'vc_col-sm-4',
			'dependency' => array(
				'element' => 'font_family',
				'value' => 'custom',
			),
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Heading Text Transform", "engage" ),
			"param_name" => "heading_tt",
			"description" => esc_html__( 'Choose a text transformation of your main heading.', 'engage' ),
			"value" => array(
				esc_html__( 'Default', 'engage' ) => 'default',
				esc_html__( 'Normal', 'engage' ) => 'normal',
				esc_html__( 'Uppercase', 'engage' ) => 'uppercase'
			),
			'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( "Styling", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Heading Font Weight", "engage" ),
			"param_name" => "heading_fw",
			"description" => esc_html__( 'Choose a font weight of your main heading.', 'engage' ),
			"value" => array(
				esc_html__( 'Default', 'engage' ) => 'default',
				esc_html__( 'Bold', 'engage' ) => 'bold',
				esc_html__( 'Normal', 'engage' ) => 'normal'
			),
			'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( "Styling", "engage" )
		),


		// Top Heading

		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Top Heading Font Size", "engage" ),
			"param_name" => "top_heading_fs",
			"class" => 'vntd-vc-section-start',
			"description" => esc_html__( 'Choose a font size for your Top Heading.', 'engage' ),
			'dependency' => array(
				'element' => 'top_heading',
				'not_empty' => true,
			),
			"value" => array(
				esc_html__( 'Theme Defaults', 'engage' ) => 'default',
				'15px' => '15px',
				'16px' => '16px',
				'17px' => '17px',
				'18px' => '18px',
				'19px' => '19px',
				'20px' => '20px',
				'21px' => '21px',
				'22px' => '22px',
				'23px' => '23px',
				'24px' => '24px',
				'26px' => '26px',
				'28px' => '28px',
				'30px' => '30px',
				'32px' => '32px',
				'36px' => '36px',
				'40px' => '40px',
				'44px' => '44px'
			),
			'group' => esc_html__( "Styling", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Top Heading Text Transform", "engage" ),
			"param_name" => "top_heading_tt",
			"description" => esc_html__( 'Choose a text transformation of your main heading.', 'engage' ),
			'dependency' => array(
				'element' => 'top_heading',
				'not_empty' => true,
			),
			"value" => array(
				esc_html__( 'Default', 'engage' ) => 'default',
				esc_html__( 'Normal', 'engage' ) => 'normal',
				esc_html__( 'Uppercase', 'engage' ) => 'uppercase'
			),
			'group' => esc_html__( "Styling", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Top Heading Font Weight", "engage" ),
			"param_name" => "top_heading_fw",
			"description" => esc_html__( 'Choose a font weight of your main heading.', 'engage' ),
			"value" => array(
				esc_html__( 'Default', 'engage' ) => 'default',
				esc_html__( 'Bold', 'engage' ) => 'bold',
				esc_html__( 'Normal', 'engage' ) => 'normal'
			),
			'dependency' => array(
				'element' => 'top_heading',
				'not_empty' => true,
			),
			'group' => esc_html__( "Styling", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Top Heading Font Family", "engage" ),
			"param_name" => "top_heading_ff",
			"value" => array(
				esc_html__( 'Theme Defaults', 'engage' ) => "",
				esc_html__( 'Additional Font specified in Theme Options', 'engage' ) => "additional"
			),
			'dependency' => array(
				'element' => 'top_heading',
				'not_empty' => true,
			),
			"description" => esc_html__( "Select a type of font for your hero section heading.", "engage" ),
			"group" => esc_html__( "Styling", "engage" )
		),

		// Subtitle

		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Subtitle Font Family", "engage" ),
			"param_name" => "subtitle_ff",
			"value" => array(
				esc_html__( 'Theme Defaults', 'engage' ) => "default",
				esc_html__( 'Additional Font specified in Theme Options', 'engage' ) => "additional"
			),
			"description" => esc_html__( "Select a type of font for your hero subtitle.", "engage" ),
			"group" => esc_html__( "Styling", "engage" )
		),

		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Subtitle Font Size", "engage" ),
			"param_name" => "subtitle_fs",
			//"std"	=> "default",
			"value" => array(
				esc_html__( 'Theme Defaults', 'engage' ) => 'default',
				'15px' => '15px',
				'16px' => '16px',
				'17px' => '17px',
				'18px' => '18px',
				'19px' => '19px',
				'20px' => '20px',
				'21px' => '21px',
				'22px' => '22px',
				'23px' => '23px',
				'24px' => '24px',
				'26px' => '26px',
				'28px' => '28px',
				'30px' => '30px',
				'32px' => '32px',
				'36px' => '36px',
				'40px' => '40px',
				'44px' => '44px'
			),
			"description" => esc_html__( 'Font size of the subtitle text.', 'engage' ),
			'group' => esc_html__( "Styling", "engage" )
		),
		array(
		   "type" => "dropdown",
		   "class" => "hidden-label",
		   "heading" => esc_html__( "Button 1 Color", "engage" ),
		   "param_name" => "btn1_color",
		   "value" => array(
		   		esc_html__( 'White', 'engage' ) => "white",
			   	esc_html__( 'Accent', 'engage' ) => "accent",
			   	esc_html__( 'Dark', 'engage' ) => "black",
		   	),
		   	'dependency' => array(
		   		"element" => 'btn1_label',
		   		'not_empty' => true
		   	),
            'edit_field_class' => 'vc_col-sm-6',
		   	'group' => esc_html__( "Styling", "engage" )
		),
		array(
		   "type" => "dropdown",
		   "class" => "hidden-label",
		   "heading" => esc_html__( "Button 1 Style", "engage" ),
		   "param_name" => "btn1_style",
		   "value" => array(
			   	esc_html__( "Outline", "engage" ) => 'outline',
			   	esc_html__( "Solid", "engage" ) => 'solid',
			   	esc_html__( "Plain text", "engage" ) => 'text'
		   	),
		   	'dependency' => array(
		   		"element" => 'btn1_label',
		   		'not_empty' => true
		   	),
            'edit_field_class' => 'vc_col-sm-6',
		   	'group' => esc_html__( "Styling", "engage" )
		),
		array(
		   "type" => "dropdown",
		   "class" => "hidden-label",
		   "heading" => esc_html__( "Button 2 Color", "engage" ),
		   "param_name" => "btn2_color",
		   "value" => array(
		   		esc_html__( 'Accent', 'engage' ) => "accent",
		   		esc_html__( 'White', 'engage' ) => "white",
			   	esc_html__( 'Dark', 'engage' ) => "dark",
		   	),
		   	'dependency' => array(
		   		'element' => 'btn2_label',
		   		'not_empty' => true,
		   	),
            'edit_field_class' => 'vc_col-sm-6',
		   	'group' => esc_html__( "Styling", "engage" )
		),
		array(
		   "type" => "dropdown",
		   "class" => "hidden-label",
		   "heading" => esc_html__( "Button 2 Style", "engage" ),
		   "param_name" => "btn2_style",
		   "value" => array(
		   		esc_html__( "Solid", "engage" ) => 'solid',
			   	esc_html__( "Outline", "engage" ) => 'outline',
		   	),
		   	'dependency' => array(
		   		'element' => 'btn2_label',
		   		'not_empty' => true,
		   	),
            'edit_field_class' => 'vc_col-sm-6',
		   	'group' => esc_html__( "Styling", "engage" )
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
		   	'group' => esc_html__( "Styling", "engage" )
		),

		// Responsive Height

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Tablet Height', "engage" ),
			'param_name' => 'h_t',
			'value' => '',
			"group" => esc_html__( "Responsive", "engage" ),
			'edit_field_class' => 'vc_col-sm-6 no-top-pd',
			"description" => esc_html__( "Set the Hero Section height on tablet devices (iPad) i.e. 600px, 400px.", "engage" )
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Mobile Height', "engage" ),
			'param_name' => 'h_m',
			'value' => '',
			"group" => esc_html__( "Responsive", "engage" ),
			'edit_field_class' => 'vc_col-sm-6 no-top-pd',
			"description" => esc_html__( "Set the Hero Section height on mobile devices (iPhone) i.e. 400px, 300px.", "engage" )
		),

        // Advanced

        array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Button 1 CSS Class', "engage" ),
			'param_name' => 'btn1_class',
			'dependency' => array(
		   		"element" => 'btn1_label',
		   		'not_empty' => true
		   	),
			"group" => esc_html__( "Advanced", "engage" ),
			"description" => esc_html__( "Optional: add a custom CSS class to the first button.", "engage" )
		),
        array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Button 2 CSS Class', "engage" ),
			'param_name' => 'btn2_class',
			'dependency' => array(
		   		"element" => 'btn2_label',
		   		'not_empty' => true
		   	),
			"group" => esc_html__( "Advanced", "engage" ),
			"description" => esc_html__( "Optional: add a custom CSS class to the second button.", "engage" )
		),

	)
);
