<?php

// Contact Form

return array(
	"name" => esc_html__( "Contact Details", "engage" ),
	"base" => "vntd_contact_details",
	"class" => "font-awesome",
	"icon" => "fa-envelope-open-o",
	"controls" => "full",
	"category" => esc_html__( 'Content', 'engage' ),
	"description" => esc_html__( "List your address, phone, email.", 'engage' ),
	"params" => array(
		array(
		    "type" => "textfield",
		    "heading" => esc_html__( "Title", 'engage' ),
		    "param_name" => "title",
		    "description" => esc_html__( "Optional title of the section.", 'engage' ),
		    "value" => esc_html__( "Contact Details", 'engage' )
		),
		array(
		    "type" => "textarea",
		    "heading" => esc_html__( "Description", 'engage'),
		    "param_name" => "desc",
		    "holder" => 'div',
		    "value" => "",
		    "description" => esc_html__( "Optional description.", 'engage' )
		),
		array(
		    "type" => "textfield",
		    "heading" => esc_html__( "Address", 'engage'),
		    "param_name" => "address",
		    "holder" => "div",
		    "description" => esc_html__( "Your address.", 'engage' ),
		    "value" => "35th Ave, Queens, NY 11106, USA"
		),
			array(
			    "type" => "dropdown",
			    "heading" => esc_html__( "Link to Google Map?", 'engage'),
			    "param_name" => "address_map",
			    "description" => esc_html__( "Should the address link to a separate Google Maps page?", 'engage' ),
			    "value" => array(
			    	esc_html__( "Yes", "engage" ) => "yes",
			    	esc_html__( "No", "engage" ) => "no",
			    ),
			    'dependency' => array(
			    	'element' => 'address',
			    	'not_empty' => true,
			    ),
			),
		array(
		    "type" => "textfield",
		    "heading" => esc_html__( "Phone", 'engage'),
		    "param_name" => "phone",
		    "holder" => "div",
		    'edit_field_class' => 'vc_col-sm-6',
		    "description" => esc_html__( "Your phone number.", 'engage' ),
		    "value" => "123 456 7893"
		),
		array(
		    "type" => "textfield",
		    "heading" => esc_html__( "Mobile Phone", 'engage'),
		    "param_name" => "mobile",
		    "holder" => "div",
		    'edit_field_class' => 'vc_col-sm-6',
		    "description" => esc_html__( "Your mobile phone number.", 'engage' ),
		    "value" => "123 456 7893"
		),
		array(
		    "type" => "textfield",
		    "heading" => esc_html__( "Email 1", 'engage'),
		    "param_name" => "email1",
		    "holder" => "div",
		    'edit_field_class' => 'vc_col-sm-6',
		    "description" => esc_html__( "Email address.", 'engage' ),
		    "value" => "contact@mywebsite.com"
		),
		array(
		    "type" => "textfield",
		    "heading" => esc_html__( "Email 2", 'engage'),
		    "param_name" => "email2",
		    "holder" => "div",
		    'edit_field_class' => 'vc_col-sm-6',
		    "description" => esc_html__( "Email address 2.", 'engage' ),
		    "value" => ""
		),

		// Styling Tab

        array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Title Heading Size', "engage" ),
			'value' => array(
				esc_html__( 'Default', "engage" ) => '',
				'h6' => 'h6',
                'h5' => 'h5',
                'h4' => 'h4',
                'h3' => 'h3',
                'h2' => 'h2',
                'h1' => 'h1',
			),
			'param_name' => 'tag',
			'group' => esc_html__( 'Styling', 'engage' ),
            'dependency' => array(
                'element' => 'title',
                'not_empty' => true,
            ),
			'description' => esc_html__( 'Choose the heading tag to manage the title size. Default: h5.', "engage" )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icons Style', "engage" ),
			'value' => array(
				esc_html__( 'Regular', "engage" ) => '',
				esc_html__( 'Outline (no background)', 'engage' ) => 'outline',
			),
			'param_name' => 'style',
			'group' => esc_html__( 'Styling', 'engage' ),
			'description' => esc_html__( 'Choose the style of your icons.', "engage" )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icons Color', "engage" ),
			'value' => array(
                esc_html__( "Accent Color", 'engage' ) => 'accent',
				esc_html__( "Accent Color 2", 'engage' ) => 'accent-2',
				esc_html__( "Accent Color 3", 'engage' ) => 'accent-3',
				esc_html__( 'Gray', "engage" ) => 'gray',
				esc_html__( 'Transparent White', "engage" ) => 'transparent-white',
				esc_html__( "Predefined Gradient 1", 'engage' ) => 'gradient-1',
				esc_html__( "Predefined Gradient 2", 'engage' ) => 'gradient-2',
			),
			'param_name' => 'color',
			'group' => esc_html__( 'Styling', 'engage' ),
			'description' => esc_html__( 'Choose color of icons in the list.', "engage" )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon Size', "engage" ),
			'value' => array(
				esc_html__( 'Regular', "engage" ) => 'regular',
				esc_html__( 'Medium', "engage" ) => 'medium',
				esc_html__( 'Large', "engage" ) => 'large',
			),
			'param_name' => 'size',
			'group' => esc_html__( 'Styling', 'engage' ),
			'description' => esc_html__( 'Choose size of icons.', "engage" )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Border', "engage" ),
			'value' => array(
                esc_html__( 'Off', "engage" ) => 'off',
				esc_html__( 'On', "engage" ) => 'on',
			),
			'param_name' => 'border',
			'group' => esc_html__( 'Styling', 'engage' ),
			'description' => esc_html__( 'Enable/disable 1px border between list elements.', "engage" )
		),

		// CSS Box Tab

		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS Box', 'engage' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Advanced Design', 'engage' ),
		),
	)
);
