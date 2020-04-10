<?php 

// Engage Icon List

return array(
	"name" => esc_html__( "Separator", "engage" ),
	"base" => "vntd_separator",
	"class" => "font-awesome",
	"icon" => "fa-minus",
	"category" => array( 'Content', 'Engage' ),
	"description" => esc_html__( "Simple separator line", 'engage' ),
	"params" => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Separator Color', "engage" ),
			'value' => array(
				esc_html__( 'Default', "engage" ) => '',
				esc_html__( 'Accent Color', "engage" ) => 'accent',
				esc_html__( 'Accent Color 2', "engage" ) => 'accent-2',
				esc_html__( 'Accent Color 3', "engage" ) => 'accent-3',
				esc_html__( 'Accent Color 4', "engage" ) => 'accent-4',
				esc_html__( 'Gray', "engage" ) => 'gray',
			),
			'param_name' => 'color',
			'description' => esc_html__( 'Choose the separator color.', "engage" ) 
		),		
	) 
);