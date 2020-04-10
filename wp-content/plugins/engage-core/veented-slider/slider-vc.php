<?php

//
// Register the slider in Visual Composer
//

add_action("admin_init", "veented_slider_vc_map");

function veented_slider_vc_map() {

	if( function_exists( 'vc_map' ) ) {

		vc_map( array(
		   "name" => esc_html__("Engage Slider", "engage"),
		   "base" => "engage_slider",
		   "class" => "font-awesome",
		   "icon" => "fa-picture-o",
		   "category" => 'Media',
		   "params" => array(
				array(
				   "type" => "dropdown",
				   "class" => "hidden-label",
				   "value" => veented_slider_vc_cats(),
				   "heading" => esc_html__( "Choose Slider", "engage" ),
				   "param_name" => "cats",
				   "admin_label" => true,
				   "description" => esc_html__( "Select the slider location.", "engage" )
				),
				array(
					"type" => "dropdown",
					"class" => "hidden-label",
					"value" => array(
						esc_html__( 'Fullwidth', 'engage' ) => 'fullwidth',
						esc_html__( 'No', 'engage' ) => 'no'
					),
					"heading" => esc_html__( "Fullwidth slider?", "engage" ),
					"param_name" => "fullwidth",
					"description" => esc_html__( "Stretch the slider to take 100% of the browser window?", "engage" )
				),
				array(
				   "type" => "dropdown",
				   "class" => "hidden-label",
				   "heading" => esc_html__("Height", 'engage'),
				   "param_name" => "height",
				   "value" => array(
					   	'Fullscreen' => 'fullscreen',
					   	'Custom' => 'custom'
				   	)
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Custom Height', 'engage' ),
					'param_name' => 'height_custom',
					'dependency' => array(
						'element' => 'height',
						'value' => 'custom',
					),
					'value' => '700px',
					"description" => esc_html__("Set a custom height for your slider in pixels i.e: 400px, 600px, 800px", 'engage'),
				),
				array(
				   "type" => "dropdown",
				   "class" => "hidden-label",
				   "value" => array(
					   'Yes' => 'yes',
					   'No' => 'no'
				   ),
				   "heading" => esc_html__("Animated Texts?", 'engage'),
				   "param_name" => "animated",
				   "description" => esc_html__("Enable to fade in animation effect for slides content.", 'engage')
				),
				array(
				   "type" => "dropdown",
				   "class" => "hidden-label",
				   "value" => array(
					   'Yes' => 'yes',
					   'No' => 'no'
				   ),
				   "heading" => esc_html__("Parallax?", 'engage'),
				   "param_name" => "parallax",
				   "description" => esc_html__("Enable the parallax effect for slides. Works perfectly only if slider is used in the first row on your page.", 'engage')
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
				   "type" => "dropdown",
				   "class" => "hidden-label",
				   "value" => array(
					   'True' => 'true',
					   'False' => 'false'
				   ),
				   "heading" => esc_html__("Simulate Touch", 'engage'),
				   "param_name" => "simulate_touch",
				   "group" => esc_html__("Settings", 'engage'),
				   "description" => esc_html__("If enabled, slider will accept mouse events like touch events (click and drag to change slides).", 'engage')
				),
				array(
				   "type" => "dropdown",
				   "class" => "hidden-label",
				   "value" => array(
					   esc_html__("True", 'engage') => 'true',
					   esc_html__("False", 'engage') => 'false'
				   ),
				   "heading" => esc_html__("Slider Loop", 'engage'),
				   "param_name" => "loop",
				   "group" => esc_html__("Settings", 'engage'),
				   "description" => esc_html__("Enable continuous loop mode.", 'engage')
				),
				array(
				   "type" => "dropdown",
				   "class" => "hidden-label",
				   "value" => array(
					   'Slide' => 'slide',
					   'Fade' => 'fade',
					   'Cube' => 'cube',
					   'Coverflow' => 'coverflow',
					   'Flip' => 'flip'
				   ),
				   "heading" => esc_html__("Slide Effect", 'engage'),
				   "param_name" => "slider_effect",
				   "group" => esc_html__("Settings", 'engage'),
				   "description" => esc_html__("Enable to fade in animation effect for slides content.", 'engage')
				),
				array(
				   "type" => "dropdown",
				   "class" => "hidden-label",
				   "value" => array(
					   esc_html__("Horizontal", 'engage') => 'horizontal',
					   esc_html__("Vertical", 'engage') => 'vertical',
				   ),
				   "heading" => esc_html__("Slide Direction", 'engage'),
				   "param_name" => "slider_direction",
				   "group" => esc_html__("Settings", 'engage'),
				   "description" => esc_html__("Enable to fade in animation effect for slides content.", 'engage')
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Autoplay', 'engage' ),
					'param_name' => 'autoplay',
					'value' => '7000',
					"group" => esc_html__("Settings", 'engage'),
					"description" => esc_html__("Delay between transitions (in ms). Leave empty to disable autoplay.", 'engage'),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Speed', 'engage' ),
					'param_name' => 'slider_speed',
					'value' => '300',
					"group" => esc_html__("Settings", 'engage'),
					"description" => esc_html__("Duration of transition between slides (in ms). Default: 300", 'engage'),
				),
				array(
				   "type" => "dropdown",
				   "class" => "hidden-label",
				   "value" => array(
					   esc_html__("True", 'engage') => 'true',
					   esc_html__("False", 'engage') => 'false'
				   ),
				   "heading" => esc_html__("Arrow Navigation?", 'engage'),
				   "param_name" => "arrow_navigation",
				   "group" => esc_html__("Navigation", 'engage'),
				   "description" => esc_html__("Enable or disable the arrow navigation.", 'engage'),
				),
				array(
				   "type" => "dropdown",
				   "class" => "hidden-label",
				   "value" => array(
					   esc_html__("True", 'engage') => 'true',
					   esc_html__("False", 'engage') => 'false'
				   ),
				   "heading" => esc_html__("Bullet Navigation?", 'engage'),
				   "param_name" => "bullet_navigation",
				   "group" => esc_html__("Navigation", 'engage'),
				   "description" => esc_html__("Enable or disable the bullet/dots navigation.", 'engage'),
				),
		   )
		));

	}

}
