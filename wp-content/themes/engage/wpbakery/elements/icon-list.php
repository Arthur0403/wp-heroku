<?php 

// Engage Icon List

return array(
	"name" => esc_html__( "Icon List", "engage" ),
	"base" => "vntd_icon_list",
	"class" => "font-awesome",
	"icon" => "fa-list-ul",
	"category" => array( 'Content', 'Engage' ),
	"description" => esc_html__( "Advanced Icon List", 'engage' ),
	"params" => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icons Style', "engage" ),
			'value' => array(
				esc_html__( 'Regular', "engage" ) => '',
				esc_html__( 'Outline (no background)', 'engage' ) => 'outline',
			),
			'param_name' => 'style',
			'description' => esc_html__( 'Choose the style of your icons.', "engage" ) 
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icons Color', "engage" ),
			'value' => array(
				esc_html__( 'Gray', "engage" ) => 'gray',
				esc_html__( 'Transparent White', "engage" ) => 'transparent-white',
				esc_html__( "Accent Color", 'engage' ) => 'accent',
				esc_html__( "Accent Color 2", 'engage' ) => 'accent-2',
				esc_html__( "Accent Color 3", 'engage' ) => 'accent-3',
				esc_html__( "Predefined Gradient 1", 'engage' ) => 'gradient-1',
				esc_html__( "Predefined Gradient 2", 'engage' ) => 'gradient-2',
			),
			'param_name' => 'icons_color',
			'description' => esc_html__( 'Choose color of icons in the list.', "engage" ) 
		),
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'List Elements', "engage" ),
			'param_name' => 'elements',
			'description' => esc_html__( 'Add list elements.', "engage" ),
			'value' => urlencode( json_encode( array(
				array(
					'text' => esc_html__( 'First element description.', 'engage' ),
					'icon_fontawesome' => 'fa fa-envelope',
				),
				array(
					'text' => esc_html__( 'Secondary element description.', 'engage' ),
					'icon_fontawesome' => 'fa fa-envelope',
				),
			) ) ),
			'params' => array(
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', "engage" ),
					'param_name' => 'icon_fontawesome',
					'value' => 'fa fa-info-circle',
					'settings' => array(
						'emptyIcon' => false, // default true, display an "EMPTY" icon?
						'iconsPerPage' => 100 // default 100, how many icons per/page to display
					),
					'description' => esc_html__( 'Select icon from library.', "engage" ) 
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Text Description', "engage" ),
					'param_name' => 'text',
					'admin_label' => true,
					'description' => esc_html__( 'Text description of the icon list element. Simple HTML anchor tags allowed (a, span, br) with a class attribute.', "engage" ),
				),
			) 
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
			'description' => esc_html__( 'Choose size of icons.', "engage" ) 
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Border', "engage" ),
			'value' => array(
				esc_html__( 'On', "engage" ) => 'on',
				esc_html__( 'Off', "engage" ) => 'off',
			),
			'param_name' => 'border',
			'description' => esc_html__( 'Enable/disable 1px solid border between list elements.', "engage" ) 
		),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', "engage" ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', "engage" )
        )

    )
);