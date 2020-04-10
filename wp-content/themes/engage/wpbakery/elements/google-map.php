<?php

// Engage Google Map

$marker_colors_array = array(
    esc_html__( "Default Google Pin Icon", "engage" ) => "def",
	esc_html__( "Amber", "engage" ) => "amber",
	esc_html__( "Blue", "engage" ) => "blue",
	esc_html__( "Dark", "engage" ) => "dark",
	esc_html__( "Indigo", "engage" ) => "indigo",
	esc_html__( "Orange", "engage" ) => "orange",
	esc_html__( "Pink", "engage" ) => "pink",
	esc_html__( "Purple", "engage" ) => "purple",
	esc_html__( "Red", "engage" ) => "red",
	esc_html__( "Teal (Green)", "engage" ) => "teal",
	esc_html__( "White", "engage" ) => "white"
);

return array(
	"name" => esc_html__( "Google Map", "engage" ),
	"base" => "vntd_gmap",
	"class" => "font-awesome",
	"icon" => "fa-map-o",
	"category" => array( 'Content', 'Engage' ),
	"description" => esc_html__( "Map block", 'engage' ),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "hidden-label",
			"heading" => esc_html__( "Map Address", "engage" ),
			"param_name" => "address",
			"value" => Engage_Theme::$default_address_ll,
			"description" => esc_html__( 'Enter the map address in lat,long format i.e. 40.719175,-74.0015925. If Google Geocoding API is enabled for your key, a full address format can be used, like: "Canal St, New York, NY 10013, USA". For more information, check <a href="https://veented.ticksy.com/article/14770/" target="_blank">this article</a>.', "engage" )
		),
		array(
			"type" => "textfield",
			"class" => "hidden-label",
			"heading" => esc_html__( "Map Height", "engage" ),
			"param_name" => "height",
			"value" => '400',
			"description" => esc_html__( "Height of the map element in pixels.", "engage" )
		),
		array(
			"type" => "textfield",
			"class" => "hidden-label",
			"heading" => esc_html__( "Map Zoom", "engage" ),
			"param_name" => "zoom",
			"value" => '14',
			"description" => esc_html__( "Choose the map zoom. Default value: 15", "engage" )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Map Style', "engage" ),
			'admin_label' => true,
			'value' => array(
				esc_html__( 'Regular Colors', "engage" ) => 'regular',
				esc_html__( 'Dark', "engage" ) => 'dark',
				esc_html__( 'Light', "engage" ) => 'light',
				esc_html__( 'Grayscale', "engage" ) => 'grayscale',
				esc_html__( 'Dark Green', "engage" ) => 'dark_green',
				esc_html__( 'Light Dream', "engage" ) => 'light_dream'
			),
			'param_name' => 'map_style',
			'description' => esc_html__( 'Choose a style for your map.', "engage" )
		),
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Map Markers', "engage" ),
			'param_name' => 'markers',
			'description' => esc_html__( 'Add multiple markers to your map.', "engage" ),
			'value' => urlencode( json_encode( array(
				array(
					'title' => esc_html__( 'Map Marker', "engage" ),
					'text' => esc_html__( 'This is an example marker description.', 'engage' ),
					'color' => 'red',
					'location' => 'center',
					'location_custom' => ''
				),
			) ) ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Marker Title', "engage" ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => esc_html__( 'Map marker title', "engage" ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Marker Description', "engage" ),
					'param_name' => 'text',
					'description' => esc_html__( 'Marker text content.', "engage" )
				),
				array(
					"type" => "dropdown",
					"class" => "hidden-label",
					"heading" => esc_html__( "Marker Color", "engage" ),
					"param_name" => "color",
					"value" => $marker_colors_array,
					"std" => 'red',
					"description" => esc_html__( "Marker 1 Title.", "engage" )
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Marker Location", "engage" ),
					"param_name" => "location",
					"value" => array(
						esc_html__( "Map Center", "engage" ) => "center",
						esc_html__( "Custom", "engage" ) => "custom"
					),
					"description" => esc_html__( "Location of the marker on your map.", "engage" )
				),
				array(
					"type" => "textfield",
					"class" => "hidden-label",
					"heading" => esc_html__( "Marker Custom Location", "engage" ),
					"param_name" => "location_custom",
					"value" => '40.7302327,-74.0100041',
					"description" => esc_html__( "Marker custom location in latitude,longitude format like: 40.7302327,-74.0100041. You may find this website useful: " , "engage" ) . '<a href="http' . '://' . 'www.latlong.net/convert-address-to-lat-long.html" target="_blank">LatLong.net</a>',
					'dependency' => array(
						"element" => 'location',
						'value' => 'custom',
					),
				),
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Mouse scroll for zoom', "engage" ),
			'value' => array(
				esc_html__( 'No', "engage" ) => 'false',
				esc_html__( 'Yes', "engage" ) => 'true'
			),
			'param_name' => 'map_scroll',
			'description' => esc_html__( 'Choose a style for your map.', "engage" )
		)

	)
);
