<?php 

// Video Lightbox

return array(
	"name" => esc_html__( "Video Lightbox", "engage" ),
	"base" => "video_lightbox",
	"icon" => "fa-play-circle-o",
	"category" => array(
		"Video",
		"Media"
	),
	"class" => "font-awesome",
	"description" => esc_html__( "Video in lightbox window", 'engage' ),
	"params" => array(
		 array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Video link', "engage" ),
			'param_name' => 'link',
			'admin_label' => true,
			'description' => sprintf( esc_html__( 'Link to the video. More about supported formats at %s.', "engage" ), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>' ) 
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__( "Style", "engage" ),
			"param_name" => "style",
			"value" => array(
				esc_html__( "Text and Icon", "engage" ) => "text",
				esc_html__( "Image and Icon", "engage" ) => "img" 
			),
			"description" => esc_html__( "White Scheme - all text styled to white color, recommended for dark backgrounds. Custom - choose your own heading and text color.", "engage" ) 
		),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Placeholder Image', "engage" ),
				'param_name' => 'img',
				'value' => '',
				'description' => esc_html__( 'Select a video placeholder image.', "engage" ),
				'dependency' => Array(
					"element" => "style",
					'value' => array(
						"img" 
					) 
				) 
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Border Radius", "engage" ),
				"param_name" => "border",
				"value" => array(
					esc_html__( "Theme Defaults", "engage" ) => "",
					esc_html__( "Square", "engage" ) => "square",
					esc_html__( "Round", "engage" ) => "round"
				),
				"description" => esc_html__( "Select a border radius for the cover image.", "engage" ) 
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Box Shadow", "engage" ),
				"param_name" => "shadow",
				"value" => array(
					esc_html__( "Yes", "engage" ) => "yes",
					esc_html__( "No", "engage" ) => "no"
				),
				"description" => esc_html__( "Enable or disable a box shadow around the cover image.", "engage" ) 
			),
		array(
			"type" => "textfield",
			"class" => "hidden-label",
			"heading" => esc_html__( "Title", "engage" ),
			"param_name" => "title",
			"value" => "Our video",
			"desc" => esc_html__( 'Title of the element.', "engage" ),
			'dependency' => Array(
				"element" => "style",
				'value' => array(
					"text" 
				) 
			) 
		),
		array(
			"type" => "textfield",
			"class" => "hidden-label",
			"heading" => esc_html__( "Description", "engage" ),
			"param_name" => "description",
			"value" => "This is our video!",
			"desc" => esc_html__( 'Description of the lightbox video.', "engage" ),
			'dependency' => Array(
				"element" => "style",
				'value' => array(
					"text" 
				) 
			)
		),
		array(
			"type" => "textfield",
			"class" => "hidden-label",
			"heading" => esc_html__( "Video length", "engage" ),
			"param_name" => "length",
			"value" => "03:46",
			"desc" => esc_html__( 'Video length will be displayed under the description. You can leave it blank.', "engage" ),
			'dependency' => Array(
				"element" => "style",
				'value' => array(
					"text" 
				) 
			)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__( "Text Color Scheme", "engage" ),
			"param_name" => "color_scheme",
			"value" => array(
				esc_html__( "White Scheme", "engage" ) => "white",
				esc_html__( "Dark Scheme", "engage" ) => "dark" 
			),
			"description" => esc_html__( "White Scheme - all text styled to white color, recommended for dark backgrounds. Custom - choose your own heading and text color.", "engage" ),
			'dependency' => Array(
				"element" => "style",
				'value' => array(
					"text" 
				) 
			)
		)
	) 
);