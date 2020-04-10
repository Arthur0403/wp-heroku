<?php
    /**
     * ReduxFramework Config File
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "engage_options";

    add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => false,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'engage' ),
        'page_title'           => esc_html__( 'Engage Theme Options', 'engage' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
		     'templates_path'		=> get_template_directory() . '/framework/theme-panel/engage/templates/panel/',
        // OPTIONAL -> Give you extra features
        'page_priority'        => 3,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'engage-options',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.
        'disable_tracking' => true,

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        'use_cdn'              => false,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'dark',
                'shadow'  => true,
                'rounded' => false,
                'style'   => 'tipsy',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'fade',
                    'duration' => '300',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'fade',
                    'duration' => '300',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.

    // Add content after the form.
    $args['footer_text'] = '<p>' . esc_html__( 'Need help? Visit our dedicated', 'engage' ) . ' <a href="http://veented.ticksy.com/" target="_blank">' . esc_html__( 'Support Forums', 'engage' ) . '</a>.</p>';

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    $img_uri = get_template_directory_uri() . '/framework/theme-panel/engage/assets/';

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'General', 'engage' ),
        'id'     => 'general',
        'desc'   => esc_html__( 'General Settings.', 'engage' ),
        'icon'   => 'fa fa-home',
        'fields' => array(
            array(
                'id'       => 'page_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Default Page Layout', 'engage' ),
                'subtitle' => esc_html__( 'Choose a default page layout for your pages: Fullwidth, Sidebar Right or Sidebar Left', 'engage' ),
                'options'  => array(
                    'no_sidebar' => array(
                        'alt' => 'No Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'sidebar_left' => array(
                        'alt' => 'Sidebar Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'sidebar_right' => array(
                        'alt' => 'Sidebar Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),
                    'sidebar_both' => array(
                        'alt' => '2 Sidebars',
                        'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                    ),
                ),
                'default'  => 'no_sidebar'
            ),
            array(
                'id'       => 'sidebar_width',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Sidebar Width', 'engage' ),
                'subtitle' => esc_html__( 'Choose a width of the page sidebar. Default is 30%.', 'engage' ),
                'options'  => array(
                	"default" => esc_html__( "Default", 'engage' ),
                	"33" => '33%',
                	"25" => '25%'
                ),
                'default' => 'default',
            ),
            array(
                'id'       => 'page_width',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Page Content Width', 'engage' ),
                'subtitle' => esc_html__( 'Choose a width for your page content.', 'engage' ),
                'options'  => array(
                	"normal" => esc_html__( "Normal", 'engage' ),
                	"stretch" => esc_html__( 'Stretch', 'engage' ),
                    "stretch_no_padding" => esc_html__( "Stretch, no padding", 'engage' ),
                    "narrow" => esc_html__( "Narrow", 'engage' ),
                ),
                'default' => 'normal'
            ),
            array(
                'id'             => 'p_content_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'units'          => 'px',
                //'display_units' 	=> false,
                'units_extended' => 'false',
                'left' => false,
                'right' => false,
                'title'          => esc_html__( 'Page Top/Bottom Padding', 'engage' ),
                'subtitle'       => esc_html__( 'Set a top (between Title Area and Content) and bottom (between Content and Footer) padding. In pixels.', 'engage' ),
                'default'            => array(
                    'padding-top'     => '',
                    'padding-bottom'  => '',
                    'units'          => 'px',
                )
            ),
            array(
                'id'       => 'stt',
                'type'     => 'switch',
                'title'    => esc_html__( 'Scroll to Top Button', 'engage' ),
                'subtitle' => esc_html__( 'Enable the Scroll to Top button on your website.', 'engage' ),
                'default'  => true,
            ),
            array(
                'id'       => 'page_loader',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Loader', 'engage' ),
                'subtitle' => esc_html__( 'Enable a page loading effect. You may adjust page laoder styling in Styling / Misc menu.', 'engage' ),
                'default'  => true,
            ),
            array(
                'id'       => 'page_fadeout',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Fade Out Effect', 'engage' ),
                'subtitle' => esc_html__( 'Enable a "fade out" effect of your site whenever a navigation link is clicked.', 'engage' ),
                'default'  => false,
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Logo', 'engage' ),
        'id'     => 'logo',
        'desc'   => esc_html__( 'Website Logo Settings.', 'engage' ),
        'icon'   => 'fa fa-eye',
        'fields' => array(
            array(
                'id'       => 'site_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Website Logo Image', 'engage' ),
                'subtitle' => esc_html__( "Upload your website's logo image.", 'engage' ),
                'default'  => array( 'url' => get_template_directory_uri() . '/img/logos/logo-dark.png' ),
            ),
            array(
                'id'       => 'site_logo_white',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Light Logo Version', 'engage' ),
                'subtitle' => esc_html__( "Used for Dark Header skin.", 'engage' ),
                'default'  => array( 'url' => get_template_directory_uri() . '/img/logos/logo-light.png' ),
            ),
            array(
                'id'       => 'logo_tablet',
                'type'     => 'media',
                'url'      => false,
                'title'    => esc_html__( 'Tablet Logo Version', 'engage' ),
                'subtitle' => esc_html__( "Optional: logo to be displayed on tablet devices.", 'engage' ),
                'default'  => '',
            ),
            array(
                'id'       => 'logo_mobile',
                'type'     => 'media',
                'url'      => false,
                'title'    => esc_html__( 'Mobile Logo Version', 'engage' ),
                'subtitle' => esc_html__( "Optional: logo to be displayed on mobile devices like smartphones.", 'engage' ),
                'default'  => '',
            ),
            array(
                'id'       => 'logo_height',
                'type'     => 'text',
                'title'    => esc_html__( 'Logo Height', 'engage' ),
                'subtitle' => esc_html__( 'Height of the logo image.', 'engage' ),
                'default'  => '',
                'class' => 'textfield-tiny pixel-field',
            ),
            array(
                'id'       => 'logo_link',
                'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Logo link', 'engage' ),
                'subtitle' => esc_html__( 'Enable or disable the logo link.', 'engage' ),
                'options'  => array(
                    "enable" => esc_html__( "Enable", 'engage' ),
                    "disable" => esc_html__( "Disable", 'engage' )
                ),
                'default'  => 'enable'
            ),
        )
    ) );

    // Header Tab

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header', 'engage' ),
        'id'         => 'header',
        'icon'   => 'fa fa-columns',
    ));

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Header General', 'engage' ),
        'id'     => 'header_general',
        'subsection' => true,
        'desc'   => esc_html__( 'Header Settings.', 'engage' ),
        'fields' => array(
            array(
                'id'       => 'header_position',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Header Position', 'engage' ),
                'subtitle' => esc_html__( 'Choose position of your site header.', 'engage' ),
                'options'  => array(
                    'top' => array(
                        'title' => esc_html__( 'Top Header', 'engage' ),
                        'img' => $img_uri . 'img/headers/top-right.png'
                    ),
                    'left' => array(
                        'title' => esc_html__( 'Left', 'engage' ),
                        'img' => $img_uri . 'img/headers/left.png'
                    ),
                    'right' => array(
                        'title' => esc_html__( 'Right', 'engage' ),
                        'img' => $img_uri . 'img/headers/right.png'
                    ),
                ),
                'default'  => 'top'
            ),
            // LEFT/RIGHT HEADER RELATED

        	array(
        	    'id'       => 'sideh_logo_spacing',
        	    'type'     => 'spacing',
        	    'title'    => esc_html__( 'Logo Image Spacing', 'engage' ),
        	    'subtitle' => esc_html__( 'Specify the top and bottom margin of the logo image.', 'engage' ),
        	    'default'  => '',
        	    'left' => false,
        	    'right' => false,
        	    'display-units' => false,
        	    'units' => array( 'px' ),
        	    'mode' => 'margin',
        	    'output' => array( '#aside-logo' ),
        	    'required' => array(
        	    	'header_position',
        	    	'equals',
        	    	array( "left", "right" )
        	    ),
        	),
        	array(
        	    'id'       => 'sideh_icons',
        	    'type'     => 'switch',
        	    'title'    => esc_html__( 'Social Icons', 'engage' ),
        	    'subtitle' => esc_html__( 'Enable Social Icons under the navigation section.', 'engage' ),
        	    'default'  => true,
        	    'required' => array(
        	    	'header_position',
        	    	'equals',
        	    	array( "left", "right" )
        	    ),
        	),

            // TOP HEADER RELATED
            array(
                'id'       => 'header_style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Header Style', 'engage' ),
                'subtitle' => esc_html__( 'Choose a style of your Site Header.', 'engage' ),
                'options'  => array(
                    'classic' => array(
                        'title' => esc_html__( 'Classic', 'engage' ),
                        'img' => $img_uri . 'img/headers/top-right.png'
                    ),
                    'top-logo-center' => array(
                        'title' => esc_html__( 'Top Center Logo', 'engage' ),
                        'img' => $img_uri . 'img/headers/top-logo-top.png'
                    ),
                    'top-logo' => array(
                        'title' => esc_html__( 'Top Logo', 'engage' ),
                        'img' => $img_uri . 'img/headers/top-logo.png'
                    ),
                    'split-menu' => array(
                        'title' => esc_html__( 'Split Menu', 'engage' ),
                        'img' => $img_uri . 'img/headers/top-center.png'
                    ),
                    'overlay-fullscreen' => array(
                       'title' => esc_html__( 'Overlay Nav', 'engage' ),
                        'img' => $img_uri . 'img/headers/overlay-fullscreen.png'
                    ),
                ),
                'required' => array(
                	'header_position',
                	'equals',
                	array( "", "top" )
                ),
                'default'  => 'classic'
            ),

            array(
                'id'       => 'header_top_social',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Social Icons', 'engage' ),
                'subtitle' => esc_html__( 'Enable social icons in your Header.', 'engage' ),
                'default'  => true,
                'required' => array(
                	array(
                		'header_position',
                		'equals',
                		array( "", "top" )
                	),
                	array(
                		'header_style',
                		'equals',
                		array( "top-logo" )
                	)
                ),
            ),

			array(
			    'id'       => 'header_top_text',
			    'type'     => 'textarea',
			    'title'    => esc_html__( 'Header Extra Content', 'engage' ),
			    'subtitle' => esc_html__( 'Add some additional text content to your header.', 'engage' ),
			    'default'  => 'E-Mail: <a href="mailto:hello@site.com">hello@site.com</a> Phone: 591 341 4344',
			    'required' => array(
			        array(
			        	'header_position',
			        	'equals',
			        	array( "", "top" )
			        ),
			        array(
			        	'header_style',
			        	'equals',
			        	array( "top-logo" )
			        )
			    ),
			),

			array(
			    'id'       => 'header_split_nav',
			    'type'     => 'select',
			    'select2' => array(
			    	'minimumResultsForSearch' => 20,
			    	'allowClear' => false
			    ),
			    'title'    => esc_html__( 'Secondary Nav Menu', 'engage' ),
			    'subtitle' => esc_html__( 'Choose a secondary menu for the split style header. You can create new menus in Appearance / Menus.', 'engage' ),
			    'data' => 'menus',
			    'default'  => 'same',
			    'required' => array(
			    	array(
			    		'header_position',
			    		'equals',
			    		array( "", "top" )
			    	),
			    	array(
			    		'header_style',
			    		'equals',
			    		array( "split-menu" )
			    	)
			    ),
			),
			array(
			    'id'       => 'header_sticky',
			    'type'     => 'button_set',
			    'title'    => esc_html__( 'Sticky Header', 'engage' ),
			    'subtitle' => esc_html__( 'Choose the header behaviour on scroll. "Appear after scroll" - the header will re-appear after page scroll.', 'engage' ),
			    'options'  => array(
			    	'sticky' => esc_html__( 'Sticky', 'engage' ),
                    'sticky-appear' => esc_html__( 'Appear after Scroll', 'engage' ),
			    	'not-sticky' => esc_html__( 'Not Sticky', 'engage' )
			    ),
			    'hint' => array(
			            'content' => esc_html__( 'Sticky Appear - inital header is fixed and sticky header appears on scroll.', 'engage' )
			    ),
			    'default' => 'sticky',
			    'required' => array(
			    	'header_position',
			    	'equals',
			    	array( "", "top" )
			    ),
			),
                array(
	                'id'       => 'header_sticky_scroll',
	                'type'     => 'text',
	                'title'    => esc_html__( 'Scroll Amount', 'engage' ),
	                'subtitle' => esc_html__( 'Amount of pixels to be scrolled for the header to re-appear. Default: 500', 'engage' ),
	                'default'  => '',
	                'class' => 'textfield-tiny pixel-field',
	                'required' => array(
	                    array(
	                    	'header_position',
	                    	'equals',
	                    	array( "", "top" )
	                    ),
	                    array(
	                    	'header_style',
	                    	'equals',
	                    	array( "", "classic", "center-logo-split", "overlay-fullscreen" )
	                    ),
                        array(
	                    	'header_sticky',
	                    	'equals',
	                    	array( "sticky-appear" )
	                    )
	                ),
	            ),
            array(
                'id'       => 'header_skin',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Header Skin', 'engage' ),
                'subtitle' => esc_html__( 'Choose a skin for your Header.', 'engage' ),
                'options'  => array(
                    "light" => esc_html__( "Light", 'engage' ),
                    "dark" 	=> esc_html__( "Dark - white font color", 'engage' ),
                ),
                'default'  => 'light',
                'required' => array(
                	'header_position',
                	'equals',
                	array( "", "top" )
                ),
            ),
            array(
                'id'       => 'header_scroll_skin',
                'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Header Scroll Skin', 'engage' ),
                'subtitle' => esc_html__( 'Choose a skin for your Header after scroll.', 'engage' ),
                'options'  => array(
                	"same" => "Same as initial skin",
                    "light" => "Light",
                    "dark" 	=> "Dark",
                ),
                'default'  => 'same',
                'required' => array(
                	'header_position',
                	'equals',
                	array( "", "top" )
                ),
            ),
            	array(
            	    'id'       => 'header_color',
            	    'type'     => 'color',
            	    'title'    => esc_html__( 'Header Color', 'engage' ),
            	    'subtitle' => esc_html__( 'Background color of your site header.', 'engage' ),
            	    'default'  => '',
            	    'transparent' => false,
//            	    'output' => array(
//            	    	'background-color' => '#header'
//            	    ),
            	    'required' => array(
            	    	'header_position',
            	    	'equals',
            	    	array( "", "top" )
            	    ),
            	),
            	array(
            	    'id'       => 'header_scroll_color',
            	    'type'     => 'color',
            	    'title'    => esc_html__( 'Header Scroll Color', 'engage' ),
            	    'subtitle' => esc_html__( 'Background color of your header after scroll.', 'engage' ),
            	    'default'  => '',
            	    'transparent' => false,
            	    'required' => array(
            	    	'header_position',
            	    	'equals',
            	    	array( "", "top" )
            	    ),
            	),
            array(
                'id'       => 'header_opacitys',
                'type' => 'slider',
                'title'    => esc_html__( 'Header Opacity', 'engage' ),
                'subtitle' => esc_html__( 'Opacity of the header\'s background color. 1.0 = 100%, 0.3 = 30%', 'engage' ),
                'required' => array(
                	'header_position',
                	'equals',
                	array( "", "top" )
                ),
                "default" => 1,
                "min" => 0,
                "step" => .05,
                "max" => 1,
                'resolution' => 0.01,
                'display_value' => 'text'
            ),
            array(
                'id'       => 'header_scroll_opacity',
                'type'     => 'slider',
                'title'    => esc_html__( 'Header Scroll Opacity', 'engage' ),
                'subtitle' => esc_html__( 'Opacity of the header\'s background color after scroll. 1.0 = 100%, 0.3 = 30%', 'engage' ),
                'required' => array(
                	'header_position',
                	'equals',
                	array( "", "top" )
                ),
                "default" => 1,
                "min" => 0,
                "step" => .01,
                "max" => 1,
                'resolution' => 0.01,
            ),
            array(
                'id'       => 'header_separator',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Header Separator', 'engage' ),
                'subtitle' => esc_html__( 'Choose a default header separator i.e. shadow below header.', 'engage' ),
                'options'  => array(
                	'shadow' => esc_html__( 'Shadow', 'engage' ),
                    'border' => esc_html__( 'Border', 'engage' ),
                    'none' => esc_html__( 'None', 'engage' ),
                ),
                'required' => array(
                	'header_position',
                	'equals',
                	array( "", "top" )
                ),
                'default' => 'shadow',
            ),
            	array(
            	    'id'       => 'header_separator_border',
            	    'type'     => 'border',
	                'select2' => array(
	                	'minimumResultsForSearch' => 20,
	                	'allowClear' => false
	                ),
            	    'title'    => esc_html__( 'Header Border', 'engage' ),
            	    'subtitle' => esc_html__( 'Header Border Styling.', 'engage' ),
            	    'default'  => '',
            	    'left' => false,
            	    'right' => false,
            	    'bottom' => true,
            	    'top' => false,
            	    'all' => false,
            	    'output' => array( '.footer' ),
            	    'class' => 'third-level',
            	    'required' => array(
            	    	array(
            	    		'header_position',
            	    		'equals',
            	    		array( "", "top" )
            	    	),
            	    	array(
            	    		'header_separator',
            	    		'equals',
            	    		array( "border" )
            	    	),
            	    )
            	),
            array(
                'id'       => 'header_separator_transparent',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Transparent Header Separator', 'engage' ),
                'subtitle' => esc_html__( 'Choose a default separator for transparent headers (with opacity below 1.0).', 'engage' ),
                'hint' => array(
                        'content' => esc_html__( 'You may change the header opacity in Theme Options globally or individually on each page in the "Header" metabox tab.', 'engage' )
                ),
                'options'  => array(
                	'shadow' => esc_html__( 'Shadow', 'engage' ),
                    'border' => esc_html__( 'Border', 'engage' ),
                    'none' => esc_html__( 'None', 'engage' ),
                ),
                'required' => array(
                	'header_position',
                	'equals',
                	array( "", "top" )
                ),
                'default' => 'border',
            ),
           // array(
           //     'id'       => 'header_wpml',
           //     'type'     => 'button_set',
           //     'title'    => esc_html__( 'Header Language Switcher', 'engage' ),
           //     'subtitle' => esc_html__( 'Add a language switcher to your site navigation? Requires a WPML plugin.', 'engage' ),
           //     'hint' => array(
           //             'content' => esc_html__( 'The switcher is visible only if a current page has a translated version.', 'engage' )
           //     ),
           //     'class' => 'required-wpml',
           //     'options'  => array(
           //     	'yes' => esc_html__( 'Yes', 'engage' ),
           //      'no' => esc_html__( 'No', 'engage' ),
           //     ),
           //     'required' => array(
           //     	'header_position',
           //     	'equals',
           //     	array( "", "top" )
           //     ),
           //     'default' => 'no',
           // ),
            array(
                'id'       => 'header_search',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Search', 'engage' ),
                'subtitle' => esc_html__( 'Enable/Disable the Search field in Header.', 'engage' ),
                'default'  => true,
                'required' => array(
                	'header_position',
                	'equals',
                	array( "", "top" )
                ),
            ),
            array(
                   'id' => 'header-styling-start',
                   'type' => 'section',
                   'title' => esc_html__( 'Advanced Header Styling', 'engage' ),
                   'subtitle' => esc_html__( 'Take a full control over your header looks.', 'engage' ),
                   'indent' => true,
                   'required' => array(
						'header_position',
						'equals',
						array( "", "top" )
                   ),
            ),

            	array(
	                'id'       => 'header_container',
	                'type'     => 'button_set',
	                'title'    => esc_html__( 'Header Container', 'engage' ),
	                'subtitle' => esc_html__( 'Choose your header\'s container width. Fullwidth = stretched to browser window size.', 'engage' ),
	                'options'  => array(
	                	'boxed' => esc_html__( 'Boxed', 'engage' ),
	                	'fullwidth' => esc_html__( 'Fullwidth', 'engage' )
	                ),
	                'default' => 'boxed',
	                'required' => array(
	                	'header_position',
	                	'equals',
	                	array( "", "top" )
	                ),
	            ),

	            array(
	                'id'       => 'header_height',
	                'type'     => 'text',
	                'title'    => esc_html__( 'Header Initial Height', 'engage' ),
	                'subtitle' => esc_html__( 'Height of the header in initial state, in pixels.', 'engage' ),
	                'default'  => '',
	                'class' => 'textfield-tiny pixel-field',
	                'required' => array(
	                    array(
	                    	'header_position',
	                    	'equals',
	                    	array( "", "top" )
	                    ),
	                    array(
	                    	'header_style',
	                    	'equals',
	                    	array( "", "classic", "center-logo-split", "split-menu","overlay-fullscreen" )
	                    ),
	                ),
	            ),
	            array(
	                'id'       => 'header_scroll_height',
	                'type'     => 'text',
	                'title'    => esc_html__( 'Header Scroll Height', 'engage' ),
	                'subtitle' => esc_html__( 'Height of the header after scroll, in pixels.', 'engage' ),
	                'default'  => '',
	                'class' => 'textfield-tiny pixel-field',
	                'required' => array(
		                array(
		                	'header_position',
		                	'equals',
		                	array( "", "top" )
		                ),
		                array(
		                	'header_style',
		                	'equals',
		                	array( "", "classic", "center-logo-split", "split-menu", "overlay-fullscreen" )
		                ),
                        array(
                            'header_sticky',
                            'equals',
                            array( "sticky", "sticky-appear" )
                        )
	                ),
	            ),

				array(
				    'id'       => 'nav_typo',
				    'type'     => 'typography',
	                'select2' => array(
	                	'minimumResultsForSearch' => 20,
                		'allowClear' => false
	                ),
				    'title'    => esc_html__( 'Navigation Elements', 'engage' ),
				    'subtitle' => esc_html__( 'Specify the header naivgation elements typography.', 'engage' ),
				    'google'   => true,
				    "text-align" => false,
				    "line-height" => false,
				    "font-style" => true,
				    "color" => false,
				    "font-family" => true,
				    "letter-spacing" => true,
				    "text-transform" => true,
				    "output" => array( "#main-menu > ul > li > a,.main-menu > ul > li > a" )
				),
				array(
				    'id'       => 'nav_spacing',
				    'type'     => 'spacing',
				    'title'    => esc_html__( 'Navigation Elements Spacing', 'engage' ),
				    'subtitle' => esc_html__( 'Specify the left and right padding for navigation elements.', 'engage' ),
				    'default'  => '',
				    'top' => false,
				    'bottom' => false,
				    'display-units' => false,
				    'units' => array( 'px' ),
				    'output' => array( '#main-menu > ul > li > a,.main-menu > ul > li > a' )
				),
				array(
				    'id'       => 'nav_light_color',
				    'type'     => 'link_color',
				    'title'    => esc_html__( 'Light Skin Nav Items Color', 'engage' ),
				    'subtitle' => esc_html__( 'Color of the navigation items in the light header skin.', 'engage' ),
				    'default'  => '',
				    'transparent' => false,
				    'visited' => false,
				    'active' => false,
				    'output' => '.header-light #main-menu > ul > li > a,.header-light .main-menu > ul > li > a'
				),
				array(
				    'id'       => 'nav_light_active',
				    'type'     => 'color',
				    'title'    => esc_html__( 'Light Skin Active Item', 'engage' ),
				    'subtitle' => esc_html__( 'Color of active navigation item in the light header skin.', 'engage' ),
				    'default'  => '',
				    'transparent' => false,
				    'output' => '.header-light #main-menu > ul > li.current-page-ancestor > a, .header-light #main-menu > ul > li.current-page-parent > a, .header-light #main-menu > ul > li.current-menu-ancestor > a, .header-light #main-menu > ul > li.current_page_ancestor > a, .header-light #main-menu > ul > li.current_page_item > a, .header-light .main-menu > ul > li.current_page_item > a,.header-light #main-navigation #main-menu>ul>li.current>a, .header-light #main-navigation .main-menu>ul>li.current>a'
				),
				array(
				    'id'       => 'nav_light_active_bg',
				    'type'     => 'color',
				    'title'    => esc_html__( 'Light Skin Active Item BG', 'engage' ),
				    'subtitle' => esc_html__( 'Background color of active navigation item in the light header skin.', 'engage' ),
				    'default'  => '',
				    'transparent' => false,
				    'output' => array( 'background-color' => '.header-light .main-menu > ul > li.current-page-ancestor > a, .header-light .main-menu > ul > li.current-page-parent > a, .header-light .main-menu > ul > li.current-menu-ancestor > a, .header-light .main-menu > ul > li.current_page_ancestor > a, .header-light .main-menu > ul > li.current_page_item > a' )
				),
				array(
				    'id'       => 'nav_dark_color',
				    'type'     => 'link_color',
				    'title'    => esc_html__( 'Dark Skin Nav Items Color', 'engage' ),
				    'subtitle' => esc_html__( 'Color of the navigation items in the dark header skin.', 'engage' ),
				    'default'  => '',
				    'transparent' => false,
				    'visited' => false,
				    'active' => false,
				    'output' => '.header-dark #main-menu > ul > li > a,.header-dark .main-menu > ul > li > a'
				),
				array(
				    'id'       => 'nav_dark_active',
				    'type'     => 'color',
				    'title'    => esc_html__( 'Dark Skin Active Item', 'engage' ),
				    'subtitle' => esc_html__( 'Color of active navigation item in the dark header skin.', 'engage' ),
				    'default'  => '',
				    'transparent' => false,
				    'output' => '.header-dark #main-menu > ul > li.current-page-ancestor > a, .header-dark #main-menu > ul > li.current-page-parent > a, .header-dark #main-menu > ul > li.current-menu-ancestor > a, .header-dark #main-menu > ul > li.current_page_ancestor > a, .header-dark #main-menu > ul > li.current_page_item > a,#wrapper.header-transparent .header-dark #main-navigation #main-menu>ul>li.current>a,#wrapper.header-transparent .header-dark #sticky-nav #main-menu>ul>li.current>a,.header-dark #main-navigation #main-menu>ul>li.current>a, .header-dark #main-navigation .main-menu>ul>li.current>a'
				),
				array(
				    'id'       => 'nav_dark_active_bg',
				    'type'     => 'color_rgba',
				    'title'    => esc_html__( 'Dark Skin Active Item BG', 'engage' ),
				    'subtitle' => esc_html__( 'Background color of active navigation item in the dark header skin.', 'engage' ),
				    'default'  => '',
				    'transparent' => false,
				    'output' => array( 'background-color' => '.header-dark #main-menu > ul > li.current-page-ancestor > a, .header-dark #main-menu > ul > li.current-page-parent > a, .header-dark #main-menu > ul > li.current-menu-ancestor > a, .header-dark #main-menu > ul > li.current_page_ancestor > a, .header-dark #main-menu > ul > li.current_page_item > a' )
				),
				// Menu items style
				array(
				    'id'       => 'nav_active_style',
				    'type'     => 'button_set',
				    'title'    => esc_html__( 'Active Item Style', 'engage' ),
				    'subtitle' => esc_html__( 'Choose a style for the active item in your site navigation.', 'engage' ),
				    'options'  => array(
				    	'default' => esc_html__( 'Default', 'engage' ),
				        'border-bottom' => esc_html__( 'Border Bottom', 'engage' ),
				        'border-top' => esc_html__( 'Border Top', 'engage' ),
				    ),
				    'default' => 'default',
				),
					array(
					    'id'       => 'nav_active_border_top',
					    'type'     => 'border',
	                'select2' => array(
	                	'minimumResultsForSearch' => 20,
	                	'allowClear' => false
	                ),
					    'title'    => esc_html__( 'Border Style', 'engage' ),
					    'subtitle' => esc_html__( 'Active item border styling.', 'engage' ),
					    'default'  => '',
					    'left' => false,
					    'right' => false,
					    'bottom' => false,
					    'top' => true,
					    'all' => false,
					    'output' => array( '.site-header.active-style-border-top .main-menu > ul > li.current-page-ancestor > a, .site-header.active-style-border-top .main-menu > ul > li.current-page-parent > a, .site-header.active-style-border-top .main-menu > ul > li.current-menu-ancestor > a, .site-header.active-style-border-top .main-menu > ul > li.current_page_ancestor > a, .site-header.active-style-border-top .main-menu > ul > li.current_page_item > a' ),
					    'class' => 'third-level',
					    'required' => array(
					    	array(
					    		'nav_active_style',
					    		'equals',
					    		array( "border-top" )
					    	),
					    )
					),
					array(
					    'id'       => 'nav_active_border_bottom',
					    'type'     => 'border',
	                'select2' => array(
	                	'minimumResultsForSearch' => 20,
	                	'allowClear' => false
	                ),
					    'title'    => esc_html__( 'Border Style', 'engage' ),
					    'subtitle' => esc_html__( 'Active item border styling.', 'engage' ),
					    'default'  => '',
					    'left' => false,
					    'right' => false,
					    'bottom' => true,
					    'top' => false,
					    'all' => false,
					    'output' => array( '.site-header.active-style-border-bottom .main-menu > ul > li.current-page-ancestor > a, .site-header.active-style-border-bottom .main-menu > ul > li.current-page-parent > a, .site-header.active-style-border-bottom .main-menu > ul > li.current-menu-ancestor > a, .site-header.active-style-border-bottom .main-menu > ul > li.current_page_ancestor > a, .site-header.active-style-border-bottom .main-menu > ul > li.current_page_item > a' ),
					    'class' => 'third-level',
					    'required' => array(
					    	array(
					    		'header_position',
					    		'equals',
					    		array( "", "top" )
					    	),
					    	array(
					    		'nav_active_style',
					    		'equals',
					    		array( "border-bottom" )
					    	),
					    )
					),

            array(
                'id'     => 'header-styling-end',
                'type'   => 'section',
                'indent' => false,
            ),

            array(
                   'id' => 'sideh-styling-start',
                   'type' => 'section',
                   'title' => esc_html__( 'Side Header Styling', 'engage' ),
                   'subtitle' => esc_html__( 'Take a full control over your side header looks.', 'engage' ),
                   'indent' => true,
                   'required' => array(
            			'header_position',
            			'equals',
            			array( "left", "right" )
                   ),
            ),
            	array(
            	    'id'       => 'sideh_skin',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Side Header Skin', 'engage' ),
            	    'subtitle' => esc_html__( 'Choose a skin for your Header. You can overwrite each aspect in options below.', 'engage' ),
            	    'options'  => array(
            	        "light" => esc_html__( "Light", 'engage' ),
            	        "dark" 	=> esc_html__( "Dark", 'engage' ),
            	    ),
            	    'default'  => 'light',
            	),
            	array(
            	    'id'       => 'sideh_bg_color',
            	    'type'     => 'background',
            	    'title'    => esc_html__( 'Side Header Background', 'engage' ),
            	    'subtitle' => esc_html__( 'Specify background settings of your Side Header.', 'engage' ),
            	    'default'  => '',
            	    'transparent' => false,
            	    'background-attachment' => false,
            	    'preview_height' => '100px',
            	    'output' => array( 'background-color' => '#wrapper #aside-nav' )
            	),
            	array(
            	    'id'       => 'sideh_shadow',
            	    'type'     => 'switch',
            	    'title'    => esc_html__( 'Side Header Shadow', 'engage' ),
            	    'subtitle' => esc_html__( 'Enable a box shadow around the side header.', 'engage' ),
            	    'default'  => true,
            	),
            	array(
            	    'id'       => 'sideh_typo',
            	    'type'     => 'typography',
	                'select2' => array(
	                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
	                ),
            	    'title'    => esc_html__( 'Navigation Items', 'engage' ),
            	    'subtitle' => esc_html__( 'Specify the Side Header navigation items typography.', 'engage' ),
            	    'google'   => false,
            	    "text-align" => false,
            	    "line-height" => false,
            	    "font-style" => true,
            	    "color" => false,
            	    "font-family" => true,
            	    "letter-spacing" => true,
            	    "text-transform" => true,
            	    "output" => array( ".aside-nav #main-aside-menu > ul > li > a" ),
            	),
            		array(
            		    'id'       => 'sideh_nav_active',
            		    'type'     => 'color',
            		    'title'    => esc_html__( 'Navigation Active Item', 'engage' ),
            		    'subtitle' => esc_html__( 'Color of the active navigation item.', 'engage' ),
            		    'default'  => '',
            		    'transparent' => false,
            		    'output' => array( 'color' => '#aside-nav #main-aside-menu > ul > li.current-page-parent > a,#aside-nav #main-aside-menu > ul > li.current-page-ancestor > a,#aside-nav #main-aside-menu > ul > li.current-menu-ancestor > a,#aside-nav #main-aside-menu > ul > li.current_page_ancestor > a,#aside-nav #main-aside-menu > ul > li.current_page_item > a,#aside-nav #main-aside-menu > ul > li.current_page_ancestor > a,#aside-nav #main-aside-menu > ul > li.current_page_parent > a,.aside-nav #main-aside-menu > ul > li > a.is-open,.aside-nav #main-aside-menu ul > li.current_page_item > a' )
            		),
            		array(
            		    'id'       => 'sideh_nav_links',
            		    'type'     => 'link_color',
            		    'title'    => esc_html__( 'Navigation Links Color', 'engage' ),
            		    'subtitle' => esc_html__( 'Specify colors of Side Header navigation links in initial and hover state.', 'engage' ),
            		    'default'  => '',
            		    'transparent' => false,
            		    'active' => false,
            		    'class' => 'third-level',
            		    'output' => '.aside-nav #main-aside-menu ul > li > a'
            		),
            		array(
            		    'id'       => 'sideh_nav_bg_hover',
            		    'type'     => 'color',
            		    'title'    => esc_html__( 'Navigation Links Active/Hover BG', 'engage' ),
            		    'subtitle' => esc_html__( 'Background color of activate navigation elements and in hover state.', 'engage' ),
            		    'default'  => '',
            		    'transparent' => false,
            		    'output' => array( 'background-color' => '#aside-nav #main-aside-menu > ul > li > a:hover,#aside-nav #main-aside-menu > ul > li > a.is-open,#aside-nav #main-aside-menu > ul > li.current-page-parent > a,#aside-nav #main-aside-menu > ul > li.current-page-ancestor > a,#aside-nav #main-aside-menu > ul > li.current-menu-ancestor > a,#aside-nav #main-aside-menu > ul > li.current_page_ancestor > a,#aside-nav #main-aside-menu > ul > li.current_page_item > a,#aside-nav #main-aside-menu > ul > li.current_page_ancestor > a,#aside-nav #main-aside-menu > ul > li.current_page_parent > a' )
            		),
            	array(
            	    'id'       => 'sideh_nav_spacing',
            	    'type'     => 'spacing',
            	    'title'    => esc_html__( 'Navigation Elements Spacing', 'engage' ),
            	    'subtitle' => esc_html__( 'Specify the side, top and bottom padding for navigation elements.', 'engage' ),
            	    'default'  => '',
            	    'display-units' => false,
            	    'units' => array( 'px' ),
            	    'output' => array( '#main-aside-menu > ul > li a' )
            	),
            	array(
            	    'id'       => 'sideh_align',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Text Alignment', 'engage' ),
            	    'subtitle' => esc_html__( 'Set alignment for your Side Header navigation elements.', 'engage' ),
            	    'options'  => array(
            	    	'left' => esc_html__( 'Left', 'engage' ),
            	        'center' => esc_html__( 'Center', 'engage' ),
            	        'right' => esc_html__( 'Right', 'engage' ),
            	    ),
            	    'default' => 'left',
            	),
            	array(
            	    'id'       => 'sideh_separator_c',
            	    'type'     => 'color',
            	    'title'    => esc_html__( 'Item Separator Color', 'engage' ),
            	    'subtitle' => esc_html__( 'Color of the separator between menu items.', 'engage' ),
            	    'default'  => '',
            	    'transparent' => false,
            	    'output' => array( 'border-color' => '#main-aside-menu > ul > li' )
            	),
            	array(
            	    'id'       => 'sideh_dropdown_color',
            	    'type'     => 'color',
            	    'title'    => esc_html__( 'Dropdown Menu Background', 'engage' ),
            	    'subtitle' => esc_html__( 'Side Header dropdown menus background color.', 'engage' ),
            	    'default'  => '',
            	    'transparent' => false,
            	    'output' => array( 'background-color' => '#main-aside-menu ul > li > ul.dropdown-menu' )
            	),
            	array(
            	    'id'       => 'sideh_dropdown_typo',
            	    'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
            	    'title'    => esc_html__( 'Dropdown Menu Typography', 'engage' ),
            	    'subtitle' => esc_html__( 'Specify the Side Header dropdown menu navigation elements typography.', 'engage' ),
            	    'google'   => false,
            	    "text-align" => false,
            	    "line-height" => false,
            	    "font-style" => true,
            	    "color" => false,
            	    "font-family" => true,
            	    "letter-spacing" => true,
            	    "text-transform" => true,
            	    "output" => array( ".aside-nav #main-aside-menu .dropdown-menu > li > a" ),
            	),
            	array(
            	    'id'       => 'sideh_dropdown_links',
            	    'type'     => 'link_color',
            	    'title'    => esc_html__( 'Dropdown Menu Links Color', 'engage' ),
            	    'subtitle' => esc_html__( 'Specify colors of dropdown menu links in initial and hover state.', 'engage' ),
            	    'default'  => '',
            	    'transparent' => false,
            	    'active' => false,
            	    'class' => 'third-level',
            	    'output' => '#aside-nav nav ul.dropdown-menu > li > a'
            	),
            array(
                'id'     => 'sideh-styling-end',
                'type'   => 'section',
                'indent' => false,
            ),

        )
    ) );

    // Top Bar

        Redux::setSection( $opt_name, array(
            'title'  => esc_html__( 'Top Bar', 'engage' ),
            'id'     => 'topbar',
            'subsection' => true,
            'desc'   => esc_html__( 'Top Bar Settings.', 'engage' ),
    //        'icon'   => 'fa fa-columns',
            'fields' => array(
                array(
                    'id'       => 'topbar',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Top Bar', 'engage' ),
                    'subtitle' => esc_html__( 'Enable/Disable the Top Bar section. Please note that Top Bar is available only for specific Header Styles.', 'engage' ),
                    'default'  => false,
                ),
                array(
                    'id'       => 'topbar_left',
                    'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                    'title'    => esc_html__( 'Left side content type', 'engage' ),
                    'subtitle' => esc_html__( 'Choose a content type for the left side of the Top Bar section. Menu option pulls a menu assigned to "Top Bar Left" Theme Location.', 'engage' ),
                    'options'  => array(
                        "social" => esc_html__( "Social Icons", 'engage' ),
	                    "menu" => esc_html__( "Menu", 'engage' ),
                        "text" => esc_html__( "Text", 'engage' ),
                        "textsocial" => esc_html__( "Text + Social Icons", 'engage' )
                    ),
                    'default'  => 'text'
                ),
                	array(
                	    'id'       => 'topbar_text_left',
                	    'type'     => 'textarea',
                	    'title'    => esc_html__( 'Left Top Bar Text', 'engage' ),
                	    'subtitle' => esc_html__( 'The text content that is being selectable as one of the "content types" for the Top Bar. Supports HTML.', 'engage' ),
                	    'default'  => 'E-Mail: hello@site.com Phone: 591 341 4344',
                	    'required' => array(
                	    	array(
                	    		'topbar_left',
                	    		'equals',
                	    		array( "text", "textsocial" )
                	    	),
                	    )
                	),
                array(
                    'id'       => 'topbar_left_account',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Login / My Account', 'engage' ),
                    'subtitle' => esc_html__( 'Enable/Disable the login form in the left side of Top Bar.', 'engage' ),
                    'default'  => false,
                ),
                array(
                    'id'       => 'topbar_right',
                    'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                    'title'    => esc_html__( 'Right side content type', 'engage' ),
                    'subtitle' => esc_html__( 'Choose a content type for the right side of the Top Bar section. Menu option pulls a menu assigned to "Top Bar Right" Theme Location.', 'engage' ),
                    'options'  => array(
                        "social" => esc_html__( "Social Icons", 'engage' ),
                        "menu" => esc_html__( "Menu", 'engage' ),
                        "text" => esc_html__( "Text", 'engage' ),
                        "textsocial" => esc_html__( "Text + Social Icons", 'engage' )
                    ),
                    'default'  => 'social'
                ),
	                array(
	                    'id'       => 'topbar_text_right',
	                    'type'     => 'textarea',
	                    'title'    => esc_html__( 'Right Top Bar Text', 'engage' ),
	                    'subtitle' => esc_html__( 'The text content that is being selectable as one of the "content types" for the Top Bar. Supports HTML.', 'engage' ),
	                    'default'  => 'E-Mail: hello@waxom.com Phone: 591 341 344',
	                    'required' => array(
	                    	array(
	                    		'topbar_right',
	                    		'equals',
	                    		array( "text", "textsocial" )
	                    	),
	                    )
	                ),
                array(
                    'id'       => 'topbar_right_account',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Login / My Account', 'engage' ),
                    'subtitle' => esc_html__( 'Enable/Disable the login form in the right side of Top Bar.', 'engage' ),
                    'default'  => false,
                ),
                array(
                	'id' => 'topbar-styling-start',
                	'type' => 'section',
                	'title' => esc_html__( 'Top Bar Styling', 'engage' ),
                	'subtitle' => esc_html__( 'Mega menus related styling. Some options like background color are shared with regulard dropdown menus.', 'engage' ),
                	'indent' => true,
                	'required' => array(
                		array(
                			'header_position',
                			'equals',
                			array( "", "top" )
                		),
                	)
                ),
                	array(
                	    'id'       => 'topbar_skin',
                	    'type'     => 'button_set',
                	    'title'    => esc_html__( 'Top Bar Skin', 'engage' ),
                	    'subtitle' => esc_html__( 'Choose the Top Bar skin. You can later overwrite default styling.', 'engage' ),
                	    'options'  => array(
                	    	"default" => esc_html__( "Default", 'engage' ),
                	        "light" => esc_html__( "Light", 'engage' ),
                	        "dark" => esc_html__( "Dark", 'engage' )
                	    ),
                	    'default'  => 'default'
                	),
                	array(
                	    'id'       => 'topbar_bg',
                	    'type'     => 'color',
                	    'title'    => esc_html__( 'Top Bar Background Color', 'engage' ),
                	    'subtitle' => esc_html__( 'Specify the background color of the Top Bar.', 'engage' ),
                	    'default'  => '',
                	    'transparent' => false,
                	    'output' => array( 'background-color' => '#topbar' )
                	),
                	array(
                	    'id'       => 'topbar_border',
                	    'type'     => 'color',
                	    'title'    => esc_html__( 'Top Bar Bottom Border', 'engage' ),
                	    'subtitle' => esc_html__( 'Specify the color of the Top Bar bottom border.', 'engage' ),
                	    'default'  => '',
                	    'output' => array( 'border-color' => '#topbar' )
                	),
	                array(
	                    'id'       => 'topbar_typo',
	                    'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
	                    'title'    => esc_html__( 'Top Bar Text', 'engage' ),
	                    'subtitle' => esc_html__( 'Specify font options of the Top Bar texts.', 'engage' ),
	                    'google'   => false,
	                    "text-align" => false,
	                    "line-height" => true,
	                    "font-style" => true,
	                    "color" => true,
	                    "font-family" => false,
	                    "letter-spacing" => true,
	                    "text-transform" => true,
	                    "output" => array( "#topbar,#topbar p" )
	                ),
	                array(
	                    'id'       => 'topbar_links',
	                    'type'     => 'link_color',
	                    'title'    => esc_html__( 'Top Bar Links', 'engage' ),
	                    'subtitle' => esc_html__( 'Specify colors of the Top Bar links.', 'engage' ),
	                    'active' => false,
	                    'visited' => false,
	                    "output" => array( '.topbar a' )
	                ),
	                array(
	                    'id'       => 'topbar_separator',
	                    'type'     => 'color',
	                    'title'    => esc_html__( 'Top Bar Elements Separator', 'engage' ),
	                    'subtitle' => esc_html__( 'Specify the color of the separator between Top Bar elements.', 'engage' ),
	                    'default'  => '',
	                    'output' => array( 'border-color' => '#topbar .topbar-social a,#topbar .topbar-menu > div > ul > li,#topbar .topbar-menu > div > ul > li:last-child,#topbar .topbar-social a:last-child' )
	                ),

                array(
                    'id'     => 'topbar-styling-end',
                    'type'   => 'section',
                    'indent' => false,
                ),

        	)
        ) );

        Redux::setSection( $opt_name, array(
                'title'  => esc_html__( 'Dropdown Menu', 'engage' ),
                'id'     => 'dropdown-menus',
                'subsection' => true,
                'desc'   => esc_html__( 'Dropdown menu styling and settings.', 'engage' ),
        //        'icon'   => 'fa fa-columns',
                'fields' => array(
                    array(
                        'id'       => 'dropdown_skin',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Dropdown Menu Skin', 'engage' ),
                        'subtitle' => esc_html__( 'Choose a skin for the dropdown menu. You may overwrite particular or all design aspects below.', 'engage' ),
                        'options'  => array(
                        	"dark" 	=> esc_html__( "Dark", 'engage' ),
                            "white" => esc_html__( "White", 'engage' ),
                        ),
                        'default'  => 'dark'
                    ),
                    array(
                        'id'       => 'dropdown_bg',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Dropdown Menu Background Color', 'engage' ),
                        'subtitle' => esc_html__( 'Background color of dropdown menu.', 'engage' ),
                        'default'  => '',
                        'transparent' => false,
                        'output' => array( 'background-color' => '#header .main-nav .dropdown-menu' )
                    ),
                    array(
                        'id'       => 'dropdown_shadow',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Dropdown Menu Shadow', 'engage' ),
                        'subtitle' => esc_html__( 'Enable a box shadow around the dropdown menu.', 'engage' ),
                        'default'  => true,
                        'required' => array(
                        	array(
                        		'header_position',
                        		'equals',
                        		array( "", "top" )
                        	),
                        )
                    ),
                    array(
                        'id'       => 'dropdown_top_border',
                        'type'     => 'border',
	                'select2' => array(
	                	'minimumResultsForSearch' => 20,
	                	'allowClear' => false
	                ),
                        'title'    => esc_html__( 'Dropdown Menu Top Border', 'engage' ),
                        'subtitle' => esc_html__( 'Specify the top border of the dropdown menu.', 'engage' ),
                        'default'  => '',
                        'left' => false,
                        'right' => false,
                        'bottom' => false,
                        'all' => false,
                        'style' => false,
                        'output' => array( '#header #main-menu .dropdown-menu' )
                    ),
                    array(
                        'id'       => 'dropdown_typo',
                        'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                        'title'    => esc_html__( 'Dropdown Menu Typography', 'engage' ),
                        'subtitle' => esc_html__( 'Specify the dropdown menu elements typography.', 'engage' ),
                        'google'   => false,
                        "text-align" => false,
                        "line-height" => false,
                        "font-style" => true,
                        "color" => false,
                        "font-family" => true,
                        "letter-spacing" => true,
                        "text-transform" => true,
                        "output" => array( "#header #main-menu li:not(.mega-menu) > .dropdown-menu a" )
                    ),
                    array(
                        'id'       => 'dropdown_links',
                        'type'     => 'link_color',
                        'title'    => esc_html__( 'Dropdown Menu Links', 'engage' ),
                        'subtitle' => esc_html__( 'Specify colors of dropdown menu links.', 'engage' ),
                        'active' => false,
                        'visited' => false,
                        "output" => array( '#header #main-menu .dropdown-menu a' )
                    ),
                    array(
                        'id'       => 'dropdown_links_bg',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Dropdown Menu Link Hover BG', 'engage' ),
                        'subtitle' => esc_html__( 'Background color of the dropdown menu item on hover.', 'engage' ),
                        'default'  => '',
                        'transparent' => false,
                        'output' => array( 'background-color' => '#header #main-menu .dropdown-menu a:hover' )
                    ),
                    array(
                        'id'       => 'dropdown_separator',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Dropdown Menu Item Separator', 'engage' ),
                        'subtitle' => esc_html__( 'Enable separator between dropdown menu items.', 'engage' ),
                        'default'  => false,
                    ),
                    	array(
                    	    'id'       => 'dropdown_separator_c',
                    	    'type'     => 'color',
                    	    'title'    => esc_html__( 'Item Separator Color', 'engage' ),
                    	    'subtitle' => esc_html__( 'Color of the separator between dropdown menu items.', 'engage' ),
                    	    'default'  => '',
                    	    'class' => 'third-level',
                    	    'transparent' => false,
                    	    'required' => array(
                    	    	array(
                    	    		'dropdown_separator',
                    	    		'equals',
                    	    		array( true )
                    	    	),
                    	    ),
                    	    'output' => array( 'border-color' => '#header.dropdown-menu-separator #main-menu > ul > li:not(.mega-menu) .dropdown-menu li' )
                    	),

                    array(
						'id' => 'mega-styling-start',
						'type' => 'section',
						'title' => esc_html__( 'Mega Menu Styling', 'engage' ),
						'subtitle' => esc_html__( 'Mega menus related styling. Some options like background color are shared with regulard dropdown menus.', 'engage' ),
						'indent' => true,
						'required' => array(
							array(
								'header_position',
								'equals',
								array( "", "top" )
							),
						)
                    ),

                    array(
                        'id'       => 'mega_heading_typo',
                        'type'     => 'typography',
	                		'select2' => array(
	                		'minimumResultsForSearch' => 20,
	                		'allowClear' => false
	                	),
                        'title'    => esc_html__( 'Mega Menu Column Heading', 'engage' ),
                        'subtitle' => esc_html__( 'Specify the mega menu column heading typography.', 'engage' ),
                        'google'   => false,
                        "text-align" => false,
                        "line-height" => false,
                        "font-style" => true,
                        "color" => true,
                        "font-family" => true,
                        "letter-spacing" => true,
                        "text-transform" => true,
                        "output" => array( "#header #main-menu > ul > li.mega-menu > ul.dropdown-menu > li > a" )
                    ),
	                    array(
	                        'id'       => 'mega_separator',
	                        'type'     => 'switch',
	                        'title'    => esc_html__( 'Mega Menu Column Separator', 'engage' ),
	                        'subtitle' => esc_html__( 'Enable a separator between mega menu columns.', 'engage' ),
	                        'default'  => true,
	                    ),
	                    	array(
	                    	    'id'       => 'mega_separator_c',
	                    	    'type'     => 'color',
	                    	    'title'    => esc_html__( 'Column Separator Color', 'engage' ),
	                    	    'subtitle' => esc_html__( 'Specify the color of the mega menu columns separator.', 'engage' ),
	                    	    'default'  => '',
	                    	    'transparent' => false,
	                    	    'class' => 'third-level',
	                    	    'required' => array(
	                    	    	array(
	                    	    		'mega_separator',
	                    	    		'equals',
	                    	    		array( true )
	                    	    	),
	                    	    ),
	                    	    'output' => array( 'border-color' => '#header #main-menu li.mega-menu > ul > li:after' )
	                    	),

                    array(
                        'id'     => 'mega-styling-end',
                        'type'   => 'section',
                        'indent' => false,
                    ),


            	)
            ) );


    Redux::setSection( $opt_name, array(
            'title'  => esc_html__( 'Mobile Header', 'engage' ),
            'id'     => 'mobile-menu',
            'subsection' => true,
            'desc'   => esc_html__( 'Mobile header settings.', 'engage' ),
            'fields' => array(
                array(
                    'id'       => 'mobileh_sticky',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Mobile Header Sticky', 'engage' ),
                    'subtitle' => esc_html__( 'Shall your mobile header be sticky?', 'engage' ),
                    'options'  => array(
                    	"yes" => esc_html__( "Yes", 'engage' ),
                    	"no" => esc_html__( "No", 'engage' ),
                    ),
                ),
                array(
                    'id'       => 'mobileh_layout',
                    'type'     => 'select',
                    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
                    'title'    => esc_html__( 'Mobile Header Layout', 'engage' ),
                    'subtitle' => esc_html__( 'Choose a layout of your mobile header to change position of logo, icons and more.', 'engage' ),
                    'options'  => array(
                    	"def" => esc_html__( "Logo Left, Menu Icon Right", 'engage' ),
                    	"logo_center" => esc_html__( "Logo Centered, Menu Icon Right", 'engage' ),
                    ),
                ),
                array(
                    'id'       => 'mobileh_search',
                    'type'     => 'select',
                    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
                    'title'    => esc_html__( 'Search Icon', 'engage' ),
                    'subtitle' => esc_html__( 'Choose position of the search icon in your mobile header. Position "right" works only with a Logo Center layout set in the "Mobile Header Layout" option above.', 'engage' ),
                    'options'  => array(
                    	"def" => esc_html__( "Default", 'engage' ),
                    	"left" => esc_html__( "Left", 'engage' ),
                        "right" => esc_html__( "Right", 'engage' ),
                        "disable" => esc_html__( "Disable", 'engage' ),
                    ),
                    'required' => array(
                        array(
                            'header_search',
                            'not',
                            array( false )
                        ),
                    ),
                ),
                array(
                    'id'       => 'mobile_dropdown',
                    'type'     => 'select',
                    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
                    'title'    => esc_html__( 'Dropdown menu action', 'engage' ),
                    'subtitle' => esc_html__( 'Choose if mobile dropdown menu should be accessible only with the arrow or by clicking the parent item (default).', 'engage' ),
                    'options'  => array(
                    	"parent" => esc_html__( "Open with parent menu", 'engage' ),
                    	"arrow" => esc_html__( "Open with arrow", 'engage' ),
                    ),
                ),
                array(
                    'id'       => 'topbar_mobile',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Top Bar on Mobile', 'engage' ),
                    'subtitle' => esc_html__( 'Enable the Top Bar on mobile devices.', 'engage' ),
                    'default'  => false,
                    'required' => array(
                        array(
                            'topbar',
                            'equals',
                            true
                        ),
                    )
                ),
                array(
                    'id'       => 'topbar_mobile_align',
                    'type'     => 'select',
                    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
                    'title'    => esc_html__( 'Top Bar Mobile Alignment', 'engage' ),
                    'subtitle' => esc_html__( 'Choose the Top Bar content alignment in mobile view.', 'engage' ),
                    'options'  => array(
                        "center" => esc_html__( "Center", 'engage' ),
                        "left" => esc_html__( "Left", 'engage' ),
                    ),
                    'required' => array(
                        array(
                            'topbar',
                            'equals',
                            true
                        ),
                        array(
                            'topbar_mobile',
                            'equals',
                            true
                        ),
                    ),
                )

        	)
        ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page Title', 'engage' ),
        'id'         => 'section_pagetitle',
        'icon'   => 'fa fa-columns',
    ));

    // Page Title

     Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Page Title General', 'engage' ),
        'id'     => 'pagetitle',
        'subsection' => true,
        'desc'   => esc_html__( 'Page Title Section Settings.', 'engage' ),
//        'icon'   => 'fa fa-columns',
        'fields' => array(
            array(
                'id'       => 'header_title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Title', 'engage' ),
                'subtitle' => esc_html__( 'Enable/Disable the Page Title area globally.', 'engage' ),
                'default'  => true,
            ),
            array(
        	    'id'       => 'pagetitle_height',
        	    'type'     => 'text',
        	    'title'    => esc_html__( 'Page Title Height', 'engage' ),
        	    'subtitle' => esc_html__( 'Enter height of the Page Title Area in pixels. Leave blank for default.', 'engage' ),
        	    'default'  => '',
        	    'class' => 'textfield-tiny pixel-field',
        	),
			array(
			    'id'       => 'pagetitle_typography',
			    'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
			    'title'    => esc_html__( 'Page Title Typography', 'engage' ),
			    'subtitle' => esc_html__( 'Typography settings of the Page Title main heading.', 'engage' ),
			    'google'   => false,
			    "text-align" => false,
			    "line-height" => false,
			    "font-family" => false,
			    "letter-spacing" => true,
			    "text-transform" => true,
			    "preview" => false,
			    "color" => true,
			    'default'  => array(
			        'font-size'   => '',
			        'font-family' => '',
			        'font-weight' => '',
			        'letter-spacing' => '',
			        'color' => ''
			    ),
			    'output' => '.page-title h1'
			),
			array(
			    'id'       => 'pagetitle_subtitle_typography',
			    'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
			    'title'    => esc_html__( 'Page Subtitle Typography', 'engage' ),
			    'subtitle' => esc_html__( 'Typography settings of the Page Title main heading.', 'engage' ),
			    'google'   => false,
			    "text-align" => false,
			    "line-height" => false,
			    "font-family" => false,
			    "letter-spacing" => true,
			    "text-transform" => true,
			    "preview" => false,
			    "color" => true,
			    'default'  => array(
			        'font-size'   => '',
			        'font-family' => '',
			        'font-weight' => '',
			        'letter-spacing' => '',
			        'color' => ''
			    ),
			    'output' => '.page-title p.page-subtitle'
			),
            array(
                'id'       => 'pagetitle_align',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Text Alignment', 'engage' ),
                'subtitle' => esc_html__( 'Default page title text alignment.', 'engage' ),
                'options'  => array(
                	'left' => esc_html__( 'Left', 'engage' ),
                    'center' => esc_html__( 'Center', 'engage' ),
                    'right' => esc_html__( 'Right', 'engage' ),
                ),
                'default' => 'left',
            ),
            array(
                'id'       => 'pagetitle_blog_align',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Text Alignment for Blog Posts', 'engage' ),
                'subtitle' => esc_html__( 'Default page title alignment for single blog posts.', 'engage' ),
                'options'  => array(
                	'left' => esc_html__( 'Left', 'engage' ),
                    'center' => esc_html__( 'Center', 'engage' ),
                    'right' => esc_html__( 'Right', 'engage' ),
                ),
                'default' => 'left',
            ),
			array(
			    'id'       => 'pagetitle_height_custom',
			    'type'     => 'text',
			    'title'    => esc_html__( 'Custom Page Title Height', 'engage' ),
			    'subtitle' => esc_html__( 'Insert in pixels amount of space above and below the page title text. Default value: 45px', 'engage' ),
			    'default'  => '45px',
			    'required' => array('pagetitle_height','=', 'custom' )
			),
			array(
			    'id'       => 'pagetitle_separator',
			    'type'     => 'switch',
			    'title'    => esc_html__( 'Page Title Separator', 'engage' ),
			    'subtitle' => esc_html__( 'Enable/Disable a bottom border of the Page Title section and set it properties.', 'engage' ),
			    'default'  => false
			),

			array(
			    'id'       => 'pagetitle_separator_s',
			    'type'     => 'border',
	                'select2' => array(
	                	'minimumResultsForSearch' => 20,
	                	'allowClear' => false
	                ),
			    'title'    => esc_html__( 'Page Title Separator', 'engage' ),
			    'subtitle' => esc_html__( 'Specify the Page Title separator.', 'engage' ),
			    'default'  => '',
			    'left' => false,
			    'right' => false,
			    'top' => false,
			    'all' => false,
			    'output' => array( '#page-title.page-title-with-separator' ),
			    'required' => array(
			    	array(
			    		'pagetitle_separator',
			    		'=',
			    		true
			    	),
			    )
			),
			array(
				'id' => 'pagetitle-bg-start',
				'type' => 'section',
				'title' => esc_html__( 'Page Title Background', 'engage' ),
				'subtitle' => esc_html__( 'Customize the Page Title Area background.', 'engage' ),
				'indent' => true,
				'required' => array(
					array(
						'header_position',
						'equals',
						array( "", "top" )
					),
				)
			),
			array(
			    'id'       => 'pagetitle_bg_color',
			    'type'     => 'color',
			    'title'    => esc_html__( 'Page Title Background Color', 'engage' ),
			    'subtitle' => esc_html__( 'Background color of the Page Title section.', 'engage' ),
			    'default'  => '',
			    'transparent' => false,
			    'output' => array( 'background-color' => '#page-title' )
			),
			array(
			    'id'       => 'pagetitle_bg_color2',
			    'type'     => 'color',
			    'title'    => esc_html__( 'Background Color Gradient', 'engage' ),
			    'subtitle' => esc_html__( 'Create a beautiful gradient by selecting a second color. This is going to be the end color.', 'engage' ),
			    'default'  => '',
			    'transparent' => false,
			    'required' => array(
			    	array( 'pagetitle_bg_color','not', '' )
			    )
			),
			array(
			    'id'       => 'pagetitle_bg_image',
			    'type'     => 'media',
			    'url'      => true,
			    'readonly' => false,
			    'title'    => esc_html__( 'Page Title Background Image', 'engage' ),
			    'subtitle' => esc_html__( "Background image of the Page Title section.", 'engage' ),
			    'default'  => array(
			    	'url' => ''
			    ),
			),
				array(
				    'id'       => 'pagetitle_bg_options',
				    'type'     => 'background',
				    'url'      => false,
				    'title'    => esc_html__( 'Background Image Settings', 'engage' ),
				    'subtitle' => esc_html__( 'Specify parameters of the background image.', 'engage' ),
				    'compiler' => 'true',
				    'transparent' => false,
				    'background-image' => false,
				    'background-color' => false,
				    'preview' => false,
				    'required' => array(
			    		array( 'pagetitle_bg_image', 'not', '' )
			    	),
			    	'output' => '.page-title-wrapper .page-title-bg'
				),
			array(
			    'id'       => 'pagetitle_bg_image_overlay',
			    'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
			    'title'    => esc_html__( 'Background Image Overlay', 'engage' ),
			    'subtitle' => esc_html__( 'Use it to make your background image darker or lighter without modifying the image itself.', 'engage' ),
			    'options'  => array(
			    	"none" => "None",
			    	"dark30" => "Dark 30%",
			        "dark50" => "Dark 50%",
			        "dark70" => "Dark 70%",
			        "dark80" => "Dark 80%",
			        "dark90" => "Dark 90%",
			        "light30" => "Light 30%",
			        "light50" => "Light 50%",
			        "light70" => "Light 70%",
			        "light80" => "Light 80%",
			        "light90" => "Light 90%"
			    ),
			    'default'  => 'none',
			    'required' => array( 'pagetitle_bg_image', 'not', '' )
			),

			array(
			    'id'     => 'pagetitle-bg-end',
			    'type'   => 'section',
			    'indent' => false,
			),

			// Page Title with BG

			array(
            	'id' => 'pagetitle-withbg-start',
            	'type' => 'section',
            	'title' => esc_html__( 'Page Title with Background', 'engage' ),
            	'subtitle' => esc_html__( 'Optional styling that will be used as default for Page Title Areas with a background (color or image). Useful when you don\'t use a background image by default and only on few pages and need different text styling for those.', 'engage' ),
            	'indent' => true,
            	'required' => array(
            		array(
            			'header_position',
            			'equals',
            			array( "", "top" )
            		),
            	)
            ),
            	array(
            	    'id'       => 'pt_with_bg_height',
            	    'type'     => 'dimensions',
            	    'title'    => esc_html__( 'Page Title Height', 'engage' ),
            	    'subtitle' => esc_html__( 'Enter default height for the Page Title Area with a background.', 'engage' ),
            	    'default'  => '',
            	    'width' => false,
            	    'units' => 'px',
            	    'class' => 'no-icon',
            	    'output' => '#wrapper #page-title.page-title-with-bg,#page-title.page-title-with-bg .page-title-wrapper'
            	),
            	array(
            	    'id'       => 'pt_with_bg_typography',
            	    'type'     => 'typography',
	                'select2' => array(
	                	'minimumResultsForSearch' => 20,
                	'allowClear' => false,
	                ),
            	    'title'    => esc_html__( 'Page Title Typography', 'engage' ),
            	    'subtitle' => esc_html__( 'Typography settings of the main heading in Page Titles with a background.', 'engage' ),
            	    'google'   => false,
            	    "text-align" => false,
            	    "line-height" => false,
            	    "font-family" => false,
            	    "letter-spacing" => true,
            	    "text-transform" => true,
            	    "preview" => false,
            	    "color" => true,
            	    'default'  => array(
            	        'font-size'   => '',
            	        'font-family' => '',
            	        'font-weight' => '',
            	        'letter-spacing' => '',
            	        'color' => ''
            	    ),
            	    'output' => '#page-title.page-title-with-bg h1'
            	),
            	array(
            	    'id'       => 'pt_with_bg_subtitle_typography',
            	    'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
            	    'title'    => esc_html__( 'Page Subtitle Typography', 'engage' ),
            	    'subtitle' => esc_html__( 'Typography settings of the main heading in Page Titles with a background.', 'engage' ),
            	    'google'   => false,
            	    "text-align" => false,
            	    "line-height" => false,
            	    "font-family" => false,
            	    "letter-spacing" => true,
            	    "text-transform" => true,
            	    "preview" => false,
            	    "color" => true,
            	    'default'  => array(
            	        'font-size'   => '',
            	        'font-family' => '',
            	        'font-weight' => '',
            	        'letter-spacing' => '',
            	        'color' => ''
            	    ),
            	    'output' => '#page-title.page-title-with-bg  p.page-subtitle'
            	),
            	array(
            	    'id'       => 'pt_with_bg_breadcrumbs',
            	    'type'     => 'color',
            	    'title'    => esc_html__( 'Breadcrumbs Color', 'engage' ),
            	    'subtitle' => esc_html__( 'Breadcrumbs link colors in Page Titles with a background.', 'engage' ),
            	    'default'  => '',
            	    'transparent' => false,
            	    'output' => '.page-title-with-bg .breadcrumbs a,.page-title-with-bg .breadcrumbs li,.page-title-with-bg .breadcrumbs li:after,.page-title .blog-meta li a, .page-title .blog-meta li'
            	),

            array(
                'id'     => 'pagetitle-withbg-end',
                'type'   => 'section',
                'indent' => false,
            ),

         ),

    ));

    // Breadcrumbs

    Redux::setSection( $opt_name, array(
            'title'  => esc_html__( 'Breadcrumbs', 'engage' ),
            'id'     => 'subsection_breadcrumbs',
            'subsection' => true,
            'desc'   => esc_html__( 'Breadcrumbs Settings.', 'engage' ),
            'fields' => array(

    			array(
    			    'id'       => 'breadcrumbs',
    			    'type'     => 'button_set',
    			    'title'    => esc_html__( 'Breadcrumbs', 'engage' ),
    			    'subtitle' => esc_html__( 'Enable/Disable the Breadcrumbs navigation. You can also enable/disable it individually on each page/post.', 'engage' ),
    			    'options'  => array(
    			    	"yes" => esc_html__( "Enabled", 'engage' ),
    			    	"no" 	=> esc_html__( "Disabled", 'engage' ),
    			    ),
    			    'default' => 'yes'
    			),
                array(
                    'id'       => 'breadcrumbs_typography',
                    'type'     => 'typography',
                    'select2' => array(
                        'minimumResultsForSearch' => 20,
                        'allowClear' => false
                    ),
                    'title'    => esc_html__( 'Breadcrumbs Typography', 'engage' ),
                    'subtitle' => esc_html__( 'Typography settings for breadcrumbs navigation.', 'engage' ),
                    'google'   => false,
                    "text-align" => false,
                    "line-height" => false,
                    "font-family" => false,
                    "letter-spacing" => true,
                    "text-transform" => true,
                    "preview" => false,
                    "color" => false,
                    'required' => array( 'breadcrumbs','equals', array('yes') ),
                    'default'  => array(
                        'font-size'   => '',
                        'font-family' => '',
                        'font-weight' => '',
                        'letter-spacing' => '',
                        'color' => ''
                    ),
                    'output' => '.page-title .breadcrumbs'
                ),
    			array(
    			    'id'       => 'pagetitle_breadcrumbs_color',
    			    'type'     => 'link_color',
    			    'title'    => esc_html__( 'Breadcrumbs Link Color', 'engage' ),
    			    'subtitle' => esc_html__( 'Color of the breadcrumbs links.', 'engage' ),
    			    'default'  => '',
    			    'active' => false,
    			    'visited' => false,
    			    'required' => array('breadcrumbs','equals', array('yes')),
    			    'output' => '.page-title .breadcrumbs a,#page-title .blog-meta li a'
    			),
    			array(
    			    'id'       => 'pagetitle_breadcrumbs_current_color',
    			    'type'     => 'color',
    			    'title'    => esc_html__( 'Breadcrumbs Current Page Color', 'engage' ),
    			    'subtitle' => esc_html__( 'Color of the current page item.', 'engage' ),
    			    //'subtitle' => esc_html__( 'Main Accent color.', 'engage' ),
    			    'default'  => '',
    			    'transparent' => false,
    			    'required' => array('breadcrumbs','equals', array('yes')),
    			    'output' => '.page-title .breadcrumbs li,#page-title .blog-meta li span'
    			),
    			array(
    			    'id'       => 'pagetitle_breadcrumbs_separator_color',
    			    'type'     => 'color',
    			    'title'    => esc_html__( 'Breadcrumbs Separator Color', 'engage' ),
    			    'subtitle' => esc_html__( 'Color of the separator.', 'engage' ),
    			    'default'  => '',
    			    'transparent' => false,
    			    'required' => array('breadcrumbs','equals', array('yes')),
    			    'output' => '.breadcrumbs li::after,.blog-meta li span.meta-label,.page-title .blog-meta li'
    			),

             ),

        ));

// Breadcrumbs

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Page Title Responsive', 'engage' ),
    'id'     => 'subsection_pt_responsive',
    'subsection' => true,
    'desc'   => esc_html__( 'Response Page Title settings.', 'engage' ),
    'fields' => array(

        array(
            'id'       => 'pt_tablet_spacing',
            'type'     => 'spacing',
            'title'    => esc_html__( 'Tablet Top/Bottom Padding', 'engage' ),
            'subtitle' => esc_html__( 'Specify the top & bottom padding (spacing) of the Page Title section on tablet devices.', 'engage' ),
            'default'  => '',
            'left' => false,
            'right' => false,
            'display-units' => false,
            'units' => array( 'px' ),
            'output' => array( '#wrapper #page-title .page-title-inner' ),
            'output_responsive' => 'max-width: 1000px'
        ),
        array(
            'id'       => 'pt_mobile_spacing',
            'type'     => 'spacing',
            'title'    => esc_html__( 'Mobile Top/Bottom Padding', 'engage' ),
            'subtitle' => esc_html__( 'Specify the top & bottom padding (spacing) of the Page Title section on small mobile devices.', 'engage' ),
            'default'  => '',
            'left' => false,
            'right' => false,
            'display-units' => false,
            'units' => array( 'px' ),
            'output' => array( '#wrapper #page-title .page-title-inner' ),
            'output_responsive' => 'max-width: 480px'
        ),
    ),

));


    // Footer

    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Footer', 'engage' ),
        'id'    => 'footer',
        'icon'  => 'fa fa-download',
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Footer General', 'engage' ),
        'id'     => 'footer-general',
        'subsection' => true,
        'desc'   => esc_html__( 'General Footer Settings.', 'engage' ),
        'fields' => array(
            array(
                'id'       => 'footer_enabled',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Area', 'engage' ),
                'subtitle' => esc_html__( 'Enable/Disable the Footer area (section with site copyright text) globally.', 'engage' ),
                'default'  => true,
            ),
            array(
                'id'       => 'copyright',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Copyright Text', 'engage' ),
                'subtitle' => esc_html__( 'Copyright text displayed in the footer. You can use {year} to pull a current year.', 'engage' ),
                'default'  => 'Copyright {year}. All rights reserved.',
            ),
            array(
                'id'       => 'footer_style',
                'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Footer Style', 'engage' ),
                'subtitle' => esc_html__( 'Choose a style of your footer.', 'engage' ),
                'options'  => array(
                    "classic" => esc_html__( "Classic aligned", 'engage' ),
                    "centered" => esc_html__( "Centered", 'engage' )
                ),
                'default'  => 'classic'
            ),
            	array(
            	    'id'       => 'footer_logo',
            	    'type'     => 'media',
            	    'url'      => true,
            	    'title'    => esc_html__( 'Footer Image', 'engage' ),
            	    'subtitle' => esc_html__( "Optional image to be displayed above the copyright text i.e. site logo.", 'engage' ),
            	    'default'  => array( 'url' => get_template_directory_uri() . '/img/logos/logo-light.png' ),
            	    'required' => array( 'footer_style','equals', 'centered' )
            	),
            array(
                'id'       => 'footer_icons',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Social Icons', 'engage' ),
                'subtitle' => esc_html__( 'Enable/Disable social icons displayed in the Footer.', 'engage' ),
                'default'  => true,
            ),
            array(
                'id'       => 'footer_widgets',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Widgets Area', 'engage' ),
                'subtitle' => esc_html__( 'Enable/Disable the Footer Widgets area globally. Please visit Appearance / Widgets menu to add new widgets!', 'engage' ),
                'default'  => true,
            ),
            array(
                'id'       => 'footer_widgets_layout',
                'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Footer Widgets Layout', 'engage' ),
                'subtitle' => esc_html__( 'Choose the layout for the Footer Widgets Layout.', 'engage' ),
                'options'  => array(
                    "4cols" => "1/4 + 1/4 + 1/4 + 1/4",
                    "3cols" => "1/3 + 1/3 + 1/3",
                    "2cols" => "1/2 + 1/2",
                    "1col" => "1/1 (1 fullwidth col)",
                    "3cols2" => "2/4 + 1/4 + 1/4",
                    "5cols" => "1/5 + 1/5 + 1/5 + 1/5 + 1/5",
                    "5cols2" => "1/6 + 1/6 + 1/6 + 1/6 + 2/6"
                ),
                'default'  => '4cols',
                'required' => array( 'footer_widgets','equals', true )
            ),
            array(
                'id'       => 'footer_width',
                'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Footer Content Width', 'engage' ),
                'subtitle' => esc_html__( 'Choose the footer container width.', 'engage' ),
                'options'  => array(
                    "boxed" => esc_html__( "Regular", 'engage' ),
                    "stretched" => esc_html__( "Stretched", 'engage' ),
                    "stretched_no_padding" => esc_html__( "Stretched No Padding", 'engage' ),
                ),
                'default'  => 'boxed',
            ),
//            array(
//                'id'       => 'footer_column_margin',
//                'type'     => 'text',
//                'title'    => esc_html__( 'First column top margin', 'engage' ),
//                'subtitle' => esc_html__( 'Set a top margin for the first column of the Widgets Area. Handy if you want to vertically center the first column content (for example with a logo image) with the rest of the columns. Example: -20px.', 'engage'),
//                'default'  => '-27px',
//            ),

    	)
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Footer Styling', 'engage' ),
        'id'     => 'footer-styling',
        'subsection' => true,
        'class' => 'no-general-options',
        'desc'   => esc_html__( 'Footer Styling.', 'engage' ),
        'fields' => array(
        	array(
        	       'id' => 'section-footer-start',
        	       'type' => 'section',
        	       'title' => esc_html__( 'Footer Widgets Area', 'engage' ),
        	       'subtitle' => esc_html__( 'Styling related to the Footer Widgets Area section. For the "Copyright" section please scroll down.', 'engage' ),
        	       'indent' => true
        	),
	            array(
	                'id'       => 'footer_skin',
	                'type'     => 'button_set',
	                'title'    => esc_html__( 'Footer Widgets Area Skin', 'engage' ),
	                'subtitle' => esc_html__( 'Choose a skin for the Footer Widgets Section. Dark skin comes with dark background and light texts. You can later overwrite those with below options.', 'engage' ),
	                'options'  => array(
	                    "dark" => esc_html__( "Dark", 'engage' ),
	                    "light" => esc_html__( "Light", 'engage' )
	                ),
	                'default' => 'dark'
	            ),
	            array(
	                'id'       => 'footer_typo_heading',
	                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
	                'title'    => esc_html__( 'Widgets Heading', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the widgets heading typography.', 'engage' ),
	                'google'   => false,
	                "text-align" => true,
	                "line-height" => true,
	                "font-style" => true,
	                "color" => true,
	                "font-family" => false,
	                "letter-spacing" => true,
	                "text-transform" => true,
	                "output" => array( "#footer .footer-widget .widget-title" )
	            ),
	            array(
	                'id'       => 'footer_typo_text',
	                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
	                'title'    => esc_html__( 'Regular Text', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the paragraph text typograpy.', 'engage' ),
	                'google'   => false,
	                "text-align" => true,
	                "line-height" => true,
	                "font-style" => true,
	                "color" => true,
	                "font-family" => false,
	                "letter-spacing" => true,
	                "text-transform" => true,
	                "output" => array( "#footer-main p,#footer-main,#footer .widget,.footer-main .widget-contact-details > div" )
	            ),
	            array(
	                'id'       => 'footer_typo_links',
	                'type'     => 'link_color',
	                'title'    => esc_html__( 'Links', 'engage' ),
	                'subtitle' => esc_html__( 'Specify colors of regular links.', 'engage' ),
	                'active' => false,
	                'visited' => false,
	                "output" => array( '#footer-main a, #footer-main .widget a' )
	            ),
	            array(
	                'id'       => 'footer_typo_list_links',
	                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
	                'title'    => esc_html__( 'List Links', 'engage' ),
	                'subtitle' => esc_html__( 'Specify typography of links in list type widgets i.e. Recent Posts.', 'engage' ),
	                'google'   => false,
	                "text-align" => false,
	                "line-height" => false,
	                "font-style" => true,
	                "color" => true,
	                "font-family" => false,
	                "font-size" => true,
	                "text-transform" => true,
	                "output" => array( '#footer-main .widget ul li a' )
	            ),
	            array(
	                'id'       => 'footer_typo_list_subtitles',
	                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
	                'title'    => esc_html__( 'List Subtitles', 'engage' ),
	                'subtitle' => esc_html__( 'Specify typography of subtitles in list widgets i.e. Recent Posts.', 'engage' ),
	                'google'   => false,
	                "text-align" => false,
	                "line-height" => false,
	                "font-style" => true,
	                "color" => true,
	                "font-family" => false,
	                "font-size" => true,
	                "text-transform" => true,
	                "output" => array( '#footer-main .classic-meta-section' )
	            ),
	            array(
	                'id'       => 'footer_list_separator',
	                'type'     => 'button_set',
	                'title'    => esc_html__( 'List Item Separators', 'engage' ),
	                'subtitle' => esc_html__( 'Enable a border separator between list items.', 'engage' ),
	                'default'  => 'yes',
	                'transparent' => false,
	                'options'  => array(
	                    "yes" => esc_html__( "Yes", 'engage' ),
	                    "no" => esc_html__( "No", 'engage' ),
	                ),
	            ),
	            array(
	                'id'       => 'footer_list_separator_style',
	                'type'     => 'color',
	                'title'    => esc_html__( 'List Item Separator Color', 'engage' ),
	                'subtitle' => esc_html__( 'Specify a color of the list items separator', 'engage' ),
	                'default'  => '',
	                'transparent' => false,
	                'output' => array( 'border-color' => '#footer #footer-main .widget li, #footer-main .widget-contact-details > div' ),
	                'required' => array( 'footer_list_separator','not', 'no' )
	            ),
	            array(
	                'id'       => 'footer_list_style',
	                'type'     => 'button_set',
	                'title'    => esc_html__( 'List Item Style', 'engage' ),
	                'subtitle' => esc_html__( 'Choose the style of list item elements (arrow by default).', 'engage' ),
	                'default'  => 'arrow',
	                'transparent' => false,
	                'options'  => array(
	                    "arrow" => esc_html__( "Arrow", 'engage' ),
	                    "none" => esc_html__( "None", 'engage' ),
	                ),
	            ),
	            array(
	                'id'       => 'footer_arrows_color',
	                'type'     => 'color',
	                'title'    => esc_html__( 'List Arrows Color', 'engage' ),
	                'subtitle' => esc_html__( 'Select color for arrows in list type widgets i.e. Recent Posts.', 'engage' ),
	                'default'  => '',
	                'transparent' => false,
	                'output' => array( '#footer .widget_categories li a:before, #footer .widget_recent_entries li a:before, #footer .widget_pages li a:before, #footer .widget_meta li a:before, #footer .widget_archive li a:before, #footer .widget_nav_menu li a:before, #footer .widget_text li:before' ),
	                'required' => array( 'footer_list_style', 'not', 'none' )
	            ),
	            array(
	                'id'       => 'footer_bg',
	                'type'     => 'color',
	                'title'    => esc_html__( 'Section Background Color', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the background color of the Footer Widgets Area.', 'engage' ),
	                'default'  => '',
	                'transparent' => true,
	                'output' => array( 'background-color' => '#footer-main' )
	            ),
	            	array(
	            	    'id'       => 'footer_main_bg_image',
	            	    'type'     => 'media',
	            	    'url'      => true,
	            	    'readonly' => false,
	            	    'title'    => esc_html__( 'Section Background Image', 'engage' ),
	            	    'subtitle' => esc_html__( "Background image of the Footer Widgets Area.", 'engage' ),
	            	    'default'  => array(
	            	    	'url' => ''
	            	    ),
	            	),
	            		array(
	            		    'id'       => 'footer_main_bg_options',
	            		    'type'     => 'background',
	            		    'url'      => false,
	            		    'title'    => esc_html__( 'Background Image Settings', 'engage' ),
	            		    'subtitle' => esc_html__( 'Specify parameters of the background image.', 'engage' ),
	            		    'compiler' => 'true',
	            		    'transparent' => false,
	            		    'background-image' => false,
	            		    'background-color' => false,
	            		    'preview' => false,
	            		    'required' => array(
	            	    		array( 'footer_main_bg_image', 'not', '' )
	            	    	),
	            	    	'output' => '#footer-main'
	            		),
	            array(
	                'id'       => 'footer_border',
	                'type'     => 'border',
	                'select2' => array(
	                	'minimumResultsForSearch' => 20,
	                	'allowClear' => false
	                ),
	                'title'    => esc_html__( 'Section Top Border', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the top border of the section.', 'engage' ),
	                'default'  => '',
	                'left' => false,
	                'right' => false,
	                'bottom' => false,
	                'all' => false,
	                'output' => array( '.footer' )
	            ),
	            array(
	                'id'       => 'footer_spacing',
	                'type'     => 'spacing',
	                'title'    => esc_html__( 'Section Top & Bottom Padding', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the space below and above the content.', 'engage' ),
	                'default'  => '',
	                'left' => false,
	                'right' => false,
	                'display-units' => false,
	                'units' => array( 'px' ),
	                'output' => array( '.footer-main' )
	            ),
            array(
                'id'     => 'section-footer-end',
                'type'   => 'section',
                'indent' => false,
            ),
            array(
                   'id' => 'section-copyright-start',
                   'type' => 'section',
                   'title' => esc_html__( 'Footer Bottom Bar', 'engage' ),
                   'subtitle' => esc_html__( 'Styling related to bottom bar of the footer with the copyright section. ', 'engage' ),
                   'indent' => true
            ),
	            array(
	                'id'       => 'copyright_skin',
	                'type'     => 'button_set',
	                'title'    => esc_html__( 'Footer Bottom Skin', 'engage' ),
	                'subtitle' => esc_html__( 'Choose a skin for the Footer Bottom Section. Dark skin comes with dark background and light texts. You can later overwrite those with below options.', 'engage' ),
	                'options'  => array(
	                    "dark" => esc_html__( "Dark", 'engage' ),
	                    "light" => esc_html__( "Light", 'engage' )
	                ),
	                'default' => 'dark'
	            ),
	            array(
	                'id'       => 'copyright_typo_text',
	                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
	                'title'    => esc_html__( 'Copyright Text', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the copyright text typograpy.', 'engage' ),
	                'google'   => false,
	                "text-align" => true,
	                "line-height" => true,
	                "font-style" => true,
	                "color" => true,
	                "font-family" => false,
	                "letter-spacing" => true,
	                "text-transform" => true,
	                "output" => array( ".footer-bottom .copyright, .footer-bottom p" )
	            ),
	            array(
	                'id'       => 'copyright_links',
	                'type'     => 'link_color',
	                'title'    => esc_html__( 'Links', 'engage' ),
	                'subtitle' => esc_html__( 'Specify colors of regular links in the copyright section.', 'engage' ),
	                'active' => false,
	                'visited' => false,
	                "output" => array( '.footer-bottom a, .footer-bottom .copyright a' )
	            ),
	            array(
	                'id'       => 'copyright_icons_size',
	                'type'     => 'button_set',
	                'title'    => esc_html__( 'Social Icons Size', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the size of social icons.', 'engage' ),
	                'options'  => array(
	                    "small" => esc_html__( "Small", 'engage' ),
	                    "medium" => esc_html__( "Medium", 'engage' ),
	                    "large" => esc_html__( "Large", 'engage' )
	                ),
	                'default'  => 'small',
	            ),
	            array(
	                'id'       => 'copyright_icons_border',
	                'type'     => 'button_set',
	                'title'    => esc_html__( 'Social Icons Shape', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the shape of social icons.', 'engage' ),
	                'options'  => array(
	                    "circle" => esc_html__( "Circle", 'engage' ),
	                    "round" => esc_html__( "Round", 'engage' ),
	                    "square" => esc_html__( "Square", 'engage' ),
	                ),
	                'default'  => 'circle',
	            ),
	            array(
	                'id'       => 'copyright_icons_size',
	                'type'     => 'button_set',
	                'title'    => esc_html__( 'Social Icons Size', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the size of social icons.', 'engage' ),
	                'options'  => array(
	                    "small" => esc_html__( "Small", 'engage' ),
	                    "medium" => esc_html__( "Medium", 'engage' ),
	                    "large" => esc_html__( "Large", 'engage' )
	                ),
	                'default'  => 'small',
	            ),
	            array(
	                'id'       => 'copyright_icons_hover',
	                'type'     => 'button_set',
	                'title'    => esc_html__( 'Social Icons Hover Effect', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the hover effect of social icons.', 'engage' ),
	                'options'  => array(
	                    "regular" => esc_html__( "Regular", 'engage' ),
	                    "slide_over" => esc_html__( "Slide Over", 'engage' ),
	                ),
	                'default'  => 'regular',
	            ),
	            array(
	                'id'       => 'copyright_icons',
	                'type'     => 'color',
	                'title'    => esc_html__( 'Social Icons Color', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the color of social icons.', 'engage' ),
	                'default'  => '',
	                'transparent' => false,
	                'output' => array( 'color' => '.footer-bottom .vntd-social-icons a' )
	            ),
	            array(
	                'id'       => 'copyright_icons_bg',
	                'type'     => 'color_rgba',
	                'title'    => esc_html__( 'Social Icons Background Color', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the background color of social icons.', 'engage' ),
	                'default'  => '',
	                'output' => array( 'background-color' => '.footer-bottom .vntd-social-icons a' )
	            ),
	            array(
	                'id'       => 'copyright_bg',
	                'type'     => 'color',
	                'title'    => esc_html__( 'Section Background Color', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the background color of the Footer Bottom Area.', 'engage' ),
	                'default'  => '',
	                'transparent' => false,
	                'output' => array( 'background-color' => '#footer,#footer .footer-bottom' )
	            ),
	            array(
	                'id'       => 'copyright_border',
	                'type'     => 'border',
	                'select2' => array(
	                	'minimumResultsForSearch' => 20,
	                	'allowClear' => false
	                ),
	                'title'    => esc_html__( 'Section Top Border', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the top border of the section.', 'engage' ),
	                'default'  => '',
	                'left' => false,
	                'right' => false,
	                'bottom' => false,
	                'all' => false,
	                'output' => array( '.footer-bottom' )
	            ),
	            array(
	                'id'       => 'copyright_spacing',
	                'type'     => 'spacing',
	                'title'    => esc_html__( 'Section Top & Bottom Padding', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the space below and above the content.', 'engage' ),
	                'default'  => '',
	                'left' => false,
	                'right' => false,
	                'display-units' => false,
	                'units' => array( 'px' ),
	                'output' => array( '.footer-bottom' )
	            ),
            array(
                'id'     => 'section-copyright-end',
                'type'   => 'section',
                'indent' => false,
            ),
    	)
    ) );

    // Blog

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog', 'engage' ),
        'id'         => 'section_blog',
        'icon'   => 'fa fa-pencil',
    ));


    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Blog General', 'engage' ),
        'id'     => 'blog',
        'subsection' => true,
        'desc'   => esc_html__( 'General Blog Settings.', 'engage' ),
        'fields' => array(
            array(
                'id'       => 'blog_style',
                'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Blog Style', 'engage' ),
                'subtitle' => esc_html__( 'Choose a style for your Blog Index page.', 'engage' ),
                'options'  => array(
                    "classic" => "Classic - Large Image",
                    "left_image" => "Left Image",
                    "masonry" => "Masonry"
                ),
                'default'  => 'classic'
            ),
            array(
                'id'       => 'blog_boxed',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Item Style', 'engage' ),
                'subtitle' => esc_html__( 'Choose an additional style for your posts in the Blog index page.', 'engage' ),
                'options'  => array(
                	'boxed' => esc_html__( 'Boxed', 'engage' ),
                    'boxed_no_border' => esc_html__( 'Boxed no border', 'engage' ),
                    'not_boxed' => esc_html__( 'Not Boxed', 'engage' ),
                ),
                'default' => 'boxed',
                'required' => array(
                	'blog_style',
                	'equals',
                	array( "classic", "masonry" )
                )
            ),
            array(
                'id'       => 'blog_masonry_cols',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Masonry Columns', 'engage' ),
                'subtitle' => esc_html__( 'Select number of columns for blog masonry.', 'engage' ),
                'options'  => array(
                	"6" => "6",
                	"5" => "5",
                    "4" => "4",
                    "3" => "3",
                    "2" => "2",
                ),
                'default'  => '3',
                'required' => array('blog_style','=',"masonry")
            ),
            array(
                'id'       => 'blog_ajax',
                'type'     => 'switch',
                'title'    => esc_html__( 'Ajax Pagination', 'engage' ),
                'subtitle' => esc_html__( 'Enable/Disable the Ajax Pagination.', 'engage' ),
                'default'  => false
            ),
            array(
                'id'       => 'blog_page_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Blog Page Layout', 'engage' ),
                'subtitle' => esc_html__( 'Choose a page layout for your blog index page (page set as Posts Page).', 'engage' ),
                'options'  => array(
                    'no_sidebar' => array(
                        'alt' => esc_html__( 'No Sidebar', 'engage' ),
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'sidebar_left' => array(
                        'alt' => esc_html__( 'Sidebar Left', 'engage' ),
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'sidebar_right' => array(
                        'alt' => esc_html__( 'Sidebar Right', 'engage' ),
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),
                    'sidebar_both' => array(
                        'alt' => esc_html__( '2 Sidebars', 'engage' ),
                        'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                    ),
                ),
                'default'  => 'sidebar_right'
            ),
            array(
                'id'       => 'blog_meta',
                'type'     => 'switch',
                'title'    => esc_html__( 'Blog Meta Section', 'engage' ),
                'subtitle' => esc_html__( 'Display the blog post meta section under the post title on the blog index page.', 'engage' ),
                'default' => true
            ),
            array(
                'id'       => 'blog_meta_author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Blog Meta Author', 'engage' ),
                'subtitle' => esc_html__( 'Display the post author in the blog post meta section under the post title.', 'engage' ),
                'default' => true,
                'required' => array(
                    'blog_meta',
                    'equals',
                    true
                )
            ),
            array(
                'id'       => 'blog_meta_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Blog Meta Date', 'engage' ),
                'subtitle' => esc_html__( 'Display the post date in the blog post meta section under the post title.', 'engage' ),
                'default' => true,
                'required' => array(
                    'blog_meta',
                    'equals',
                    true
                )
            ),
    	)
    ) );

    // Blog -> Single Post

    Redux::setSection( $opt_name, array(
            'title'  => esc_html__( 'Single Posts', 'engage' ),
            'id'     => 'subsection_blog_single',
            'subsection' => true,
            'desc'   => esc_html__( 'Single blog post options.', 'engage' ),
            'fields' => array(

    			array(
    			    'id'       => 'blog_single_media',
    			    'type'     => 'switch',
    			    'title'    => esc_html__( 'Post Media', 'engage' ),
    			    'subtitle' => esc_html__( 'Display post media on single post page according to post format i.e. video player for "video" format etc.', 'engage' ),
    			    'default' => true
    			),

    			array(
    			    'id'       => 'blog_single_meta',
    			    'type'     => 'switch',
    			    'title'    => esc_html__( 'Blog Meta Section', 'engage' ),
    			    'subtitle' => esc_html__( 'Display the blog post meta section under the post title on a single blog post page.', 'engage' ),
    			    'default' => true
    			),
                array(
                    'id'       => 'blog_single_meta_author',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Blog Meta Author', 'engage' ),
                    'subtitle' => esc_html__( 'Display the post author in the blog post meta section under the post title.', 'engage' ),
                    'default' => true,
                    'required' => array(
                        'blog_single_meta',
                        'equals',
                        true
                    )
                ),
                array(
                    'id'       => 'blog_single_meta_date',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Blog Meta Date', 'engage' ),
                    'subtitle' => esc_html__( 'Display the post date in the blog post meta section under the post title.', 'engage' ),
                    'default' => true,
                    'required' => array(
                        'blog_single_meta',
                        'equals',
                        true
                    )
                ),
                array(
                    'id'       => 'blog_single_meta_comments',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Blog Meta Comments Number', 'engage' ),
                    'subtitle' => esc_html__( 'Display the number of comments in the blog post meta section under the post title.', 'engage' ),
                    'default' => false,
                    'required' => array(
                        'blog_single_meta',
                        'equals',
                        true
                    )
                ),
                array(
                    'id'       => 'blog_single_meta_cats',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Blog Meta Categories', 'engage' ),
                    'subtitle' => esc_html__( 'Display the post categories in the blog post meta section under the post title.', 'engage' ),
                    'default' => true,
                    'required' => array(
                        'blog_single_meta',
                        'equals',
                        true
                    )
                ),

    			array(
    			    'id'       => 'blog_trackback',
    			    'type'     => 'switch',
    			    'title'    => esc_html__( 'Post Trackbacks', 'engage' ),
    			    'subtitle' => esc_html__( 'Display the post trackback URL address with CSS.', 'engage' ),
    			    'default'  => true,
    			),

    			array(
    			    'id'       => 'blog_post_tags',
    			    'type'     => 'switch',
    			    'title'    => esc_html__( 'Post Tags', 'engage' ),
    			    'subtitle' => esc_html__( 'Display post tags under the post content.', 'engage' ),
    			    'default'  => true,
    			),

    			array(
    			    'id'       => 'blog_post_author',
    			    'type'     => 'switch',
    			    'title'    => esc_html__( 'Post Author', 'engage' ),
    			    'subtitle' => esc_html__( 'Display the post author section under the post content.', 'engage' ),
    			    'default'  => true,
    			),

    			array(
    			    'id'       => 'blog_post_nav',
    			    'type'     => 'switch',
    			    'title'    => esc_html__( 'Blog Post Navigation', 'engage' ),
    			    'subtitle' => esc_html__( 'Display the navigation to next/prev posts on a single blog post.', 'engage' ),
    			    'default'  => true,
    			),

                array(
                    'id'       => 'comments_website',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Comments Website URL', 'engage' ),
                    'subtitle' => esc_html__( 'Enable or disable the "Website" field in the post comments form.', 'engage' ),
                    'default'  => true,
                ),

    			array(
    			    'id'       => 'blog_post_layout',
    			    'type'     => 'image_select',
    			    'title'    => esc_html__( 'Single Blog Post layout', 'engage' ),
    			    'subtitle' => esc_html__( 'Choose a default page layout for your single blog posts.', 'engage' ),
    			    'options'  => array(
    			        'no_sidebar' => array(
    			            'alt' => 'No Sidebar',
    			            'img' => ReduxFramework::$_url . 'assets/img/1col.png'
    			        ),
    			        'sidebar_left' => array(
    			            'alt' => 'Sidebar Left',
    			            'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
    			        ),
    			        'sidebar_right' => array(
    			            'alt' => 'Sidebar Right',
    			            'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
    			        ),
                  'sidebar_both' => array(
                      'alt' => '2 Sidebars',
                      'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                  ),
    			    ),
    			    'default'  => 'sidebar_right'
    			),
    			array(
    			    'id'       => 'blog_post_width',
    			    'type'     => 'button_set',
    			    'title'    => esc_html__( 'Single Post Content Width', 'engage' ),
    			    'subtitle' => esc_html__( 'Choose a content width for single blog posts.', 'engage' ),
    			    'options'  => array(
    			    	"normal" => esc_html__( "Normal", 'engage' ),
    			    	"stretch" => esc_html__( 'Stretch', 'engage' ),
    			        "stretch_no_padding" => esc_html__( "Stretch, no padding", 'engage' ),
    			        "narrow" => esc_html__( "Narrow", 'engage' ),
    			    ),
    			    'default' => 'normal'
    			),
                array(
                    'id' => 'blog-single-extras',
                    'type' => 'section',
                    'title' => esc_html__( 'Extras', 'engage' ),
                    'subtitle' => esc_html__( 'Additional single blog posts settings.', 'engage' ),
                    'indent' => true,
                ),
                array(
                    'id'       => 'blog-single-pagetitle',
                    'type'     => 'select',
                    'select2' => array(
                        'minimumResultsForSearch' => 20,
                        'allowClear' => false
                    ),
                    'title'    => esc_html__( 'Page Title Background', 'engage' ),
                    'subtitle' => esc_html__( 'Specify a default page title style.', 'engage' ),
                    'options'  => array(
                        "default" => esc_html__( "Default", 'engage' ),
                        "featured_img" => esc_html__( "Use the Featured Image as a Background", 'engage' ),
                    ),
                    'default'  => 'classic'
                ),

                array(
                    'id'     => 'pagetitle-bg-end',
                    'type'   => 'section',
                    'indent' => false,
                ),

             ),

        ));

    // Portfolio

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Portfolio', 'engage' ),
        'id'         => 'portfolio',
        'icon'   => 'fa fa-briefcase',
    ));

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Portfolio General', 'engage' ),
        'id'     => 'portfolio_general',
        'desc'   => esc_html__( 'Portfolio Settings.', 'engage' ),
        'subsection' => true,
        'fields' => array(
            array(
                'id'       => 'portfolio_page',
                'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'data'     => 'pages',
                'title'    => esc_html__( 'Main Portfolio Page', 'engage' ),
                'subtitle' => esc_html__( 'Select a default portfolio page for the "Back to portfolio" link on single portfolio posts.', 'engage' ),
            ),
            array(
                'id'       => 'portfolio_slug',
                'type'     => 'text',
                'title'    => esc_html__( 'Portfolio Permalink Slug', 'engage' ),
                'subtitle' => esc_html__( 'Customize the permalink structure slug. Defaults to the "portfolio" value. Must NOT contain any special characters.', 'engage' ),
                'default'  => '',
                'class' => '',
            ),

            array(
               'id' => 'portfolio-grid-start',
               'type' => 'section',
               'title' => esc_html__( 'Portfolio Grid Settings', 'engage' ),
               'subtitle' => esc_html__( 'Default settings for your portfolio grids. You may later adjust them individually for each Portfolio Grid element in Visual Composer.', 'engage' ),
               'indent' => true,
            ),
            	array(
            	    'id'       => 'portfolio_item_style',
            	    'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
            	    'title'    => esc_html__( 'Grid Item Style', 'engage' ),
            	    'subtitle' => esc_html__( 'Choose a style of your portfolio grid items.', 'engage' ),
            	    'options'  => array(
            	    	"caption" => esc_html__( "With Caption", "engage" ),
            	    	"caption_overlay" => esc_html__( "With Overlay Caption", "engage" ),
            	    	"minimal" => esc_html__( "Minimal (just image)", "engage" ) ,
            	    ),
            	    'default' => 'caption'
            	),
            		array(
            		    'id'       => 'portfolio_item_caption_style',
            		    'type'     => 'button_set',
            		    'title'    => esc_html__( 'Caption Display', 'engage' ),
            		    'subtitle' => esc_html__( 'Should caption be always displayed or show only on hover?', 'engage' ),
            		    'options'  => array(
            		    	"visible" => esc_html__( "Always Visible", "engage" ),
            		    	"hover" => esc_html__( "Slide on Hover", "engage" ),
            		    ),
            		    'default' => 'visible',
            		    'required' => array(
            		    	'portfolio_item_style',
            		    	'equals',
            		    	array( "caption" )
            		    )
            		),
            		array(
            		    'id'       => 'portfolio_item_caption_align',
            		    'type'     => 'button_set',
            		    'title'    => esc_html__( 'Caption Alignment', 'engage' ),
            		    'subtitle' => esc_html__( 'Set alignment of the caption\'s content.', 'engage' ),
            		    'options'  => array(
            		    	"left" => esc_html__( "Left", "engage" ),
            		    	"center" => esc_html__( "Center", "engage" ),
            		    ),
            		    'default' => 'left',
            		    'required' => array(
            		    	'portfolio_item_style',
            		    	'equals',
            		    	array( "caption" )
            		    )
            		),
            		array(
            		    'id'       => 'portfolio_item_caption_content',
            		    'type'     => 'button_set',
            		    'title'    => esc_html__( 'Caption Content', 'engage' ),
            		    'subtitle' => esc_html__( 'Choose caption content.', 'engage' ),
            		    'options'  => array(
            		    	"title_categories" => esc_html__( "Title + Categories", "engage" ),
            		    	"title" => esc_html__( "Title", "engage" ),
            		    ),
            		    'default' => 'title_categories',
            		    'required' => array(
            		    	'portfolio_item_style',
            		    	'equals',
            		    	array( "caption" )
            		    )
            		),
            		array(
            		    'id'       => 'portfolio_love',
            		    'type'     => 'button_set',
            		    'title'    => esc_html__( 'Love Button', 'engage' ),
            		    'subtitle' => esc_html__( 'Enable the love (likes) button.', 'engage' ),
            		    'options'  => array(
            		    	"yes" => esc_html__( "Yes", "engage" ),
            		    	"no" => esc_html__( "No", "engage" ),
            		    ),
            		    'default' => 'yes',
            		    'required' => array(
            		    	'portfolio_item_style',
            		    	'equals',
            		    	array( "caption" )
            		    )
            		),
            		array(
            		    'id'       => 'portfolio_caption_border',
            		    'type'     => 'button_set',
            		    'title'    => esc_html__( 'Caption Border', 'engage' ),
            		    'subtitle' => esc_html__( 'Enable border around the caption.', 'engage' ),
            		    'options'  => array(
            		    	"on" => esc_html__( "Yes", "engage" ),
            		    	"off" => esc_html__( "No", "engage" ),
            		    ),
            		    'default' => 'on',
            		    'required' => array(
            		    	'portfolio_item_style',
            		    	'equals',
            		    	array( "caption" )
            		    )
            		),
            		// Overlay Caption
            		array(
            		    'id'       => 'portfolio_item_caption_position',
            		    'type'     => 'button_set',
            		    'title'    => esc_html__( 'Overlay Caption Position', 'engage' ),
            		    'subtitle' => esc_html__( 'Choose position of the item title.', 'engage' ),
            		    'options'  => array(
            		    	"center" => esc_html__( "Center", "engage" ),
            		    	"bottom_left" => esc_html__( "Bottom left", "engage" ),
            		    ),
            		    'default' => 'center',
            		    'required' => array(
            		    	'portfolio_item_style',
            		    	'equals',
            		    	array( "caption_overlay" )
            		    )
            		),
            		array(
            		    'id'       => 'portfolio_item_caption_categories',
            		    'type'     => 'button_set',
            		    'title'    => esc_html__( 'Love Button', 'engage' ),
            		    'subtitle' => esc_html__( 'Enable the love (likes) button.', 'engage' ),
            		    'options'  => array(
            		    	"yes" => esc_html__( "yes", "engage" ),
            		    	"no" => esc_html__( "no", "engage" ),
            		    ),
            		    'default' => 'no',
            		    'required' => array(
            		    	'portfolio_item_style',
            		    	'equals',
            		    	array( "caption_overlay" )
            		    )
            		),

            	// End caption related

            	array(
            	    'id'       => 'portfolio_item_hover_style',
            	    'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
            	    'title'    => esc_html__( 'Grid Item Hover Style', 'engage' ),
            	    'subtitle' => esc_html__( 'Choose a hover style for your portfolio grid items.', 'engage' ),
            	    'options'  => array(
            	    	"zoom_link" => esc_html__( "Zoom Icon + Link Icon", "engage" ),
            	    	"title" => esc_html__( "Title", "engage" ),
            	    	"title_categories" => esc_html__( "Title, Categories", "engage" ),
            	    	"title_icons" => esc_html__( "Title, Zoom + Link icons", "engage" ),
            	    	"none" => esc_html__( "None", "engage" ),
            	    ),
            	    'default' => 'zoom_link',
            	),

            	array(
            	    'id'       => 'portfolio_image_hover_effect',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Item Image Hover Effect', 'engage' ),
            	    'subtitle' => esc_html__( 'Choose a hover effect for grid images.', 'engage' ),
            	    'options'  => array(
            	    	"zoom" => esc_html__( "Zoom Image", "engage" ),
            	    	"push_right" => esc_html__( "Push Right", "engage" ),
            	    	"none" => esc_html__( "None", "engage" ),
            	    ),
            	    'default' => 'zoom',
            	),

            	array(
            	    'id'       => 'portfolio_image_hover_overlay',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Item Image Hover Overlay', 'engage' ),
            	    'subtitle' => esc_html__( 'Choose a hover overlay effect for grid images.', 'engage' ),
            	    'options'  => array(
            	    	"dark" => esc_html__( "Dark", "engage" ),
            	    	"accent" => esc_html__( "Accent", "engage" ),
            	    	"none" => esc_html__( "None", "engage" ),
            	    ),
            	    'default' => 'dark',
            	),

            	array(
            	    'id'       => 'portfolio_thumb_space',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Grid Item Spacing', 'engage' ),
            	    'subtitle' => esc_html__( 'Enable spacing between the grid items.', 'engage' ),
            	    'options'  => array(
            	    	"yes" => esc_html__( "Yes", "engage" ),
            	    	"no" => esc_html__( "No", "engage" ),
            	    ),
            	    'default' => 'yes',
            	),

            	array(
            	    'id'       => 'portfolio_layout_type',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Layout Type', 'engage' ),
            	    'subtitle' => esc_html__( 'Choose a layout for your portfolio grid items: classic grid, masonry or mosaic. Mosaic: thumbnail sizes are displayed according to individual post "Thumbnail aspect ratio" option (wide, tall, big).', 'engage' ),
            	    'options'  => array(
            	    	"grid" 		=> esc_html__( "Grid", "engage" ),
            	    	"masonry" 	=> esc_html__( "Masonry", "engage" ),
            	    	"mosaic" 	=> esc_html__( "Mosaic", "engage" ),
            	    ),
            	    'default' => 'grid',
            	),

            	array(
            	    'id'       => 'portfolio_pagination',
            	    'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
            	    'title'    => esc_html__( 'Pagination Type', 'engage' ),
            	    'subtitle' => esc_html__( 'Choose pagination type for your grid.', 'engage' ),
            	    'options'  => array(
            	    	"no" 		=> esc_html__( "Disable", "engage" ),
            	    	"classic" 	=> esc_html__( "Classic", "engage" ),
            	    	"ajax" 		=> esc_html__( "Ajax - load posts on click", "engage" ),
            	    ),
            	    'default' => 'no',
            	),

            		array(
            		    'id'       => 'portfolio_more_button_style',
            		    'type'     => 'button_set',
            		    'title'    => esc_html__( 'Load More Button Style', 'engage' ),
            		    'subtitle' => esc_html__( 'Choose style for your "Load more" ajax button.', 'engage' ),
            		    'options'  => array(
            		    	"normal" 	=> esc_html__( "Normal", "engage" ),
            		    	"fullwidth" => esc_html__( "Fullwidth", "engage" ),
            		    ),
            		    'default' => 'normal',
            		    'required' => array(
            		    	'portfolio_pagination',
            		    	'equals',
            		    	array( "ajax" )
            		    )
            		),

            	// Posts Order

            	array(
            	    'id'       => 'portfolio_orderby',
            	    'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
            	    'title'    => esc_html__( 'Order posts by', 'engage' ),
            	    'subtitle' => esc_html__( 'Sort/order your posts by a certain value.', 'engage' ),
            	    'options'  => array(
            	    	"date" => esc_html__( "Date", 'engage' ),
            	    	"none" => esc_html__( "None - no order", 'engage' ),
            	    	"ID" => esc_html__( "Post ID", 'engage' ),
            	    	"author" => esc_html__( "Author", 'engage' ),
            	    	"title" => esc_html__( "Title", 'engage' ),
            	    	"name" => esc_html__( "Name (slug)", 'engage' ),
            	    	"menu_order" => esc_html__( "Menu Order", 'engage' )
            	    ),
            	    'default' => 'date',
            	),

            	array(
            	    'id'       => 'portfolio_order',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Order posts by', 'engage' ),
            	    'subtitle' => esc_html__( 'Posts order.', 'engage' ),
            	    'options'  => array(
            	    	"desc" => esc_html__( "Descending (DESC)", 'engage' ),
            	    	"asc" => esc_html__( "Ascending (ASC)", 'engage' )
            	    ),
            	    'default' => 'desc',
            	),

            	// Filters

            	array(
            	    'id'       => 'portfolio_filter',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Grid Filters', 'engage' ),
            	    'subtitle' => esc_html__( 'Enable or disable grid filters.', 'engage' ),
            	    'options'  => array(
            	    	"yes" 	=> esc_html__( "Yes", "engage" ),
            	    	"no" 	=> esc_html__( "No", "engage" ),
            	    ),
            	    'default' => 'yes',
            	),

            		array(
            		    'id'       => 'portfolio_filter_align',
            		    'type'     => 'button_set',
            		    'title'    => esc_html__( 'Grid Filters Alignment', 'engage' ),
            		    'subtitle' => esc_html__( 'Set alignment of grid filters.', 'engage' ),
            		    'options'  => array(
            		    	"center" 	=> esc_html__( "Center", "engage" ),
            		    	"left" 		=> esc_html__( "Left", "engage" ) ,
            		    	"right" 	=> esc_html__( "Right", "engage" ),
            		    	"mixed" 	=> esc_html__( "Mixed", "engage" )
            		    ),
            		    'default' => 'center',
            		    'required' => array(
            		    	'portfolio_filter',
            		    	'equals',
            		    	array( "yes" )
            		    )
            		),

            		array(
            		    'id'       => 'portfolio_filter_orderby',
            		    'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
            		    'title'    => esc_html__( 'Grid Filters Order', 'engage' ),
            		    'subtitle' => esc_html__( 'Sort/order your grid filter items by a certain field.', 'engage' ),
            		    'options'  => array(
            		    	"slug" 		=> esc_html__( "Slug", "engage" ),
            		    	"name" 		=> esc_html__( "Name", "engage" ),
            		    	"term_id" 	=> esc_html__( "Term ID", "engage" ),
            		    	"id" 		=> esc_html__( "ID", "engage" ),
            		    ),
            		    'default' => 'slug',
            		    'required' => array(
            		    	'portfolio_filter',
            		    	'equals',
            		    	array( "yes" )
            		    )
            		),

            array(
                'id'     => 'portfolio-grid-end',
                'type'   => 'section',
                'indent' => false,
            ),

         )
    ));

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Single Posts', 'engage' ),
        'id'     => 'portfolio_single',
        'desc'   => esc_html__( 'Single portfolio post page settings.', 'engage' ),
        'subsection' => true,
        'fields' => array(

            array(
                'id'       => 'portfolio_layout',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Default Portfolio Post Layout', 'engage' ),
                'subtitle' => esc_html__( 'Choose layout for your portfolio post.', 'engage' ),
                'hint' 	   => array(
                    'content' => esc_html__( 'Side - Media displayed on left side, post content in sidebar on the right.', 'engage' )
                ),
                'options'  => array(
                	"side" 	=> esc_html__( "Side", "engage" ),
                	"fullwidth" => esc_html__( "Fullwidth", "engage" ),
                ),
                'default' => 'side'
            ),
            array(
                'id'       => 'g_portfolio_details_display',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Project Details', 'engage' ),
                'subtitle' => esc_html__( 'Display or hide the project details.', 'engage' ),
                'hint' 	   => array(
                    'content' => esc_html__( 'Project Details is area with information like Project Categories, Skills, Client etc, defined below.', 'engage' )
                ),
                'default' => true
            ),
            array(
                'id'       => 'g_portfolio_project_heading',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show About Project Heading', 'engage' ),
                'subtitle' => esc_html__( 'Display or hide the "About Project" heading above the Post Content.', 'engage' ),
                'default' => true
            ),
            array(
            	'id' => 'portfolio_separator1',
            	'type' => 'divide',
            	'title' => '',
            ),
            array(
                'id'       => 'g_portfolio_media_display',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Media', 'engage' ),
                'subtitle' => esc_html__( 'Display or hide the portfolio post media, defined below (or Featured Image if no media defined).', 'engage' ),
                'default' => true
            ),
            array(
                'id'       => 'g_portfolio_gallery_type',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Default Gallery Type', 'engage' ),
                'subtitle' => esc_html__( 'Choose a default type for portfolio post gallery.', 'engage' ),
                'options'  => array(
                	"list" 		=> esc_html__( "Image List", "engage" ),
                	"slider" 	=> esc_html__( "Image Slider", "engage" ),
                ),
                'default' => 'list'
            ),

            array(
            	'id' => 'portfolio_separator2',
            	'type' => 'divide',
            	'title' => '',
            ),

            array(
                'id'       => 'g_portfolio_details_heading',
                'type'     => 'switch',
                'title'    => esc_html__( 'Project Details Heading', 'engage' ),
                'subtitle' => esc_html__( 'Display or hide the "Project Details" heading above the Post Details area.', 'engage' ),
                'default' => true
            ),
            array(
                'id'       => 'g_portfolio_display_categories',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Project Categories', 'engage' ),
                'subtitle' => esc_html__( 'Display project categories.', 'engage' ),
                'default' => true
            ),
            array(
                'id'       => 'g_portfolio_display_skills',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Project Skills', 'engage' ),
                'subtitle' => esc_html__( 'Display project skills.', 'engage' ),
                'default' => true
            ),

            array(
            	'id' => 'portfolio_separator3',
            	'type' => 'divide',
            	'title' => '',
            ),

            array(
                'id'       => 'g_portfolio_navigation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Navigation', 'engage' ),
                'subtitle' => esc_html__( 'Display post navigation.', 'engage' ),
                'default' => true
            ),

    	)
    ) );

    Redux::setSection( $opt_name, array(
    	'title'  => esc_html__( 'Portfolio Styling', 'engage' ),
    	'id'     => 'portfolio_styling',
    	'desc'   => esc_html__( 'Portfolio styling options.', 'engage' ),
    	'subsection' => true,
    	'fields' => array(
    		array(
    		   'id' => 'portfolio-styling-start',
    		   'type' => 'section',
    		   'title' => esc_html__( 'Portfolio Grid Styling', 'engage' ),
    		   'subtitle' => esc_html__( 'Advanced styling options for the portfolio grid.', 'engage' ),
    		   'indent' => true,
    		),

    			array(
    			    'id'       => 'portfolio_t_title',
    			    'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
    			    'title'    => esc_html__( 'Portfolio Item Title', 'engage' ),
    			    'subtitle' => esc_html__( 'Specify the typograpy of the grid item title.', 'engage' ),
    			    'google'   => false,
    			    "text-align" => false,
    			    "line-height" => true,
    			    "font-style" => true,
    			    "color" => true,
    			    "font-family" => false,
    			    "letter-spacing" => true,
    			    "text-transform" => true,
    			    "output" => array( ".portfolio-item-caption h4 a,.portfolio-caption_overlay .portfolio-item-caption h4 a" )
    			),
    			array(
    			    'id'       => 'portfolio_t_subtitle',
    			    'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
    			    'title'    => esc_html__( 'Portfolio Item Subtitle', 'engage' ),
    			    'subtitle' => esc_html__( 'Specify the typograpy of the grid item subtitle (i.e. categories in caption).', 'engage' ),
    			    'google'   => false,
    			    "text-align" => false,
    			    "line-height" => true,
    			    "font-style" => true,
    			    "color" => true,
    			    "font-family" => false,
    			    "letter-spacing" => true,
    			    "text-transform" => true,
    			    "output" => array( ".portfolio-item-caption .caption-categories" )
    			),
    			array(
    			    'id'       => 'portfolio_caption_bg',
    			    'type'     => 'color',
    			    'title'    => esc_html__( 'Caption Background Color', 'engage' ),
    			    'subtitle' => esc_html__( 'Specify the caption background color. Works only if caption is enabled.', 'engage' ),
    			    'default'  => '',
    			    'transparent' => false,
    			    'output' => array( 'background-color' => '.portfolio-item-caption' )
    			),
    			array(
    			    'id'       => 'portfolio_caption_border_st',
    			    'type'     => 'border',
	                'select2' => array(
	                	'minimumResultsForSearch' => 20,
	                	'allowClear' => false
	                ),
    			    'title'    => esc_html__( 'Caption Border', 'engage' ),
    			    'subtitle' => esc_html__( 'Specify the portfolio item caption border. Works only if the "Caption Border" is set to "Yes".', 'engage' ),
    			    'default'  => '',
    			    'all' => true,
    			    'output' => array( '.caption-visible .portfolio-item-caption' )
    			),


    		array(
    		    'id'     => 'portfolio-styling-end',
    		    'type'   => 'section',
    		    'indent' => false,
    		),

            array(
    		   'id' => 'port-nav-start',
    		   'type' => 'section',
    		   'title' => esc_html__( 'Portfolio Navigation Styling', 'engage' ),
    		   'subtitle' => esc_html__( 'Advanced styling options for the portfolio single post navigation area.', 'engage' ),
    		   'indent' => true,
    		),

                array(
                    'id'       => 'por_nav_cont',
                    'type'     => 'select',
                    'select2' => array(
                        'minimumResultsForSearch' => 20,
                        'allowClear' => false
                    ),
                    'title'    => esc_html__( 'Next/Prev Content Type', 'engage' ),
                    'subtitle' => esc_html__( 'Choose the content of the next/prev button. Label is i.e. "Next Project".', 'engage' ),
                    'options'  => array(
                        "all" 		=> esc_html__( "Label + Title", "engage" ),
                        "title" 	=> esc_html__( "Title", "engage" ),
                        "label" 	=> esc_html__( "Label", "engage" ),
                    ),
                    'default' => 'all',
                ),
    			array(
    			    'id'       => 'por_nav_bg',
    			    'type'     => 'color',
    			    'title'    => esc_html__( 'Background Color', 'engage' ),
    			    'subtitle' => esc_html__( 'Background color of the portfolio navigation section.', 'engage' ),
    			    'default'  => '',
    			    'transparent' => false,
    			    'output' => array( 'background-color' => '.portfolio-nav' )
    			),
    			array(
    			    'id'       => 'por_nav_border',
    			    'type'     => 'border',
	                'select2' => array(
	                	'minimumResultsForSearch' => 20,
	                	'allowClear' => false
	                ),
    			    'title'    => esc_html__( 'Border', 'engage' ),
    			    'subtitle' => esc_html__( 'Specify the portfolio navigation top border.', 'engage' ),
    			    'default'  => '',
    			    'all' => false,
                    'top' => true,
                    'left' => false,
                    'right' => false,
    			    'output' => array( '.portfolio-nav.post-navigation' )
    			),
                array(
	                'id'       => 'por_nav_spacing',
	                'type'     => 'spacing',
	                'title'    => esc_html__( 'Top & Bottom Padding', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the top and bottom padding of the portfolio nav content.', 'engage' ),
	                'default'  => '',
	                'left' => false,
	                'right' => false,
	                'display-units' => false,
	                'units' => array( 'px' ),
	                'output' => array( '.portfolio-nav.post-navigation' )
	            ),
    			array(
    			    'id'       => 'por_nav_title',
    			    'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
    			    'title'    => esc_html__( 'Post Title Typography', 'engage' ),
    			    'subtitle' => esc_html__( 'Typograpy of the post title in portfolio navigation area.', 'engage' ),
    			    'google'   => false,
    			    "text-align" => false,
    			    "line-height" => true,
    			    "font-style" => true,
    			    "color" => true,
    			    "font-family" => false,
    			    "letter-spacing" => true,
    			    "text-transform" => true,
    			    "output" => array( ".post-navigation a span.post-nav-title" )
    			),

    		array(
    		    'id'     => 'port-nav-end',
    		    'type'   => 'section',
    		    'indent' => false,
    		),

    	)

    ) );

    // Contact Page

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Contact Page & Maps', 'engage' ),
        'desc' => esc_html__( 'Contact page and maps related settings.', 'engage' ),
        'id'     => 'contact_page',
        'icon'   => 'fa fa-envelope-o',
        'fields' => array(
            array(
                'id'       => 'contact_email',
                'type'     => 'text',
                'title'    => esc_html__( 'Contact Form E-Mail', 'engage' ),
                'subtitle' => esc_html__( 'Enter the destination e-mail address for the Contact Form messages.', 'engage' ),
                'default'  => '',
                'validate' => 'email',
                'class' => '',
            ),
            array(
        	    'id'       => 'contact_layout',
        	    'type'     => 'button_set',
        	    'title'    => esc_html__( 'Contact Page Layout', 'engage' ),
        	    'subtitle' => esc_html__( 'Select the contact template layout. Side: Contact Form next to the Page Content, Fullwidth: Contact Form below the Page Content.', 'engage' ),
        	    'options'  => array(
        	    	'side' => esc_html__( 'Side', "engage" ),
        	    	'fullwidth' => esc_html__( 'Fullwidth', "engage" )
        	    ),
        	    'default' => 'side',
        	),
        	array(
        	    'id'       => 'contact_form_width',
        	    'type'     => 'button_set',
        	    'title'    => esc_html__( 'Contact Form Width', 'engage' ),
        	    'subtitle' => esc_html__( 'Choose width of the Contact Form area.', 'engage' ),
        	    'options'  => array(
        	    	'2_3' => '2/3',
        	    	'1_2' => '1/2',

        	    ),
        	    'default' => '2_3',
        	),
            array(
                'id'       => 'cf_success_msg',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Form Success Message', 'engage' ),
                'subtitle' => esc_html__( 'Enter the contact form success message or leave blank to use a default one and be able to translate it with a plugin.', 'engage' ),
                'default'  => '',
                'class' => '',
            ),
            array(
                'id'       => 'cf_consent_ask',
                'type'     => 'switch',
                'title'    => esc_html__( 'GDPR Consent Ask', 'engage' ),
                'subtitle' => esc_html__( 'Enable the GDPR related checkbox that is required before submitting the contact form. You may translate the checkbox label either with a translation plugin or via Theme Options / Translate panel if you use a simple translation.', 'engage' ),
                'default'  => true
            ),
            array(
                   'id' => 'contact-google-maps',
                   'type' => 'section',
                   'title' => esc_html__( 'Google Maps', 'engage' ),
                   'subtitle' => esc_html__( 'Contact Template Google Map related options.', 'engage' ),
                   'indent' => true,
            ),
            array(
                'id'       => 'google_maps_api',
                'type'     => 'text',
                'placeholder' => esc_html__( 'Your API key goes here..' , 'engage' ),
                'title'    => esc_html__( 'Google Maps API Key', 'engage' ),
                'subtitle' => esc_html__( 'Paste your Google Maps Api Key. This is necessary for the Google Map to work on your website. For more information, check ', 'engage' ) . '<a href="https://veented.ticksy.com/article/7856/" target="_blank">' . esc_html__('this article', 'engage'). '</a>.',
                'default'  => ""
            ),
            array(
               'id'       => 'contact_map',
               'type'     => 'switch',
               'title'    => esc_html__( 'Google Map', 'engage' ),
               'subtitle' => esc_html__( 'Enable Google Map in Contact page template.', 'engage' ),
               'default'  => true
           	),
           	array(
       		    'id'       => 'contact_map_address',
       		    'type'     => 'text',
       		    'title'    => esc_html__( 'Map Address', 'engage' ),
       		    'subtitle' => esc_html__( 'Enter the map address in lat,long format i.e. 40.719175,-74.0015925. If Google Geocoding API is enabled for your API key, a full address format can be used, like: "Canal St, New York, NY 10013, USA". For more information, check', 'engage' ) . ' <a href="https://veented.ticksy.com/article/14770/" target="_blank">' . esc_html__( 'this article', 'engage' ) . '</a>.',
       		    'default'  => '40.719175,-74.0015925',
       		    'class' => '',
       		    'required' => array(
       		       	'contact_map',
       		       	'equals',
       		       	true
       		       )
       		),
           	array(
           	    'id'       => 'contact_map_style',
           	    'type'     => 'select',
           	    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
           	    'title'    => esc_html__( 'Map Style', 'engage' ),
           	    'subtitle' => esc_html__( 'Choose the map style.', 'engage' ),
           	    'options'  => array(
           	    	'light' => esc_html__( 'Light', "engage" ),
           	    	'dark' => esc_html__( 'Dark', "engage" ),
           	    	'regular' => esc_html__( 'Regular Colors', "engage" ),
           	    	'grayscale' => esc_html__( 'Grayscale', "engage" ),
           	    	'dark_green' => esc_html__( 'Dark Green', "engage" ),
           	    	'light_dream' => esc_html__( 'Light Dream', "engage" )
           	    ),
           	    'default' => 'light',
           	    'required' => array(
           	    	'contact_map',
           	    	'equals',
           	    	true
           	    )
           	),
           	array(
           	    'id'       => 'contact_map_height',
           	    'type'     => 'text',
           	    'title'    => esc_html__( 'Map Height', 'engage' ),
           	    'subtitle' => esc_html__( 'Enter height of the map in pixels.', 'engage' ),
           	    'default'  => '460',
           	    'class' => 'textfield-tiny pixel-field',
           	    'required' => array(
           	       	'contact_map',
           	       	'equals',
           	       	true
           	       )
           	),
           	array(
       		    'id'       => 'contact_map_width',
       		    'type'     => 'button_set',
       		    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false  ),
       		    'title'    => esc_html__( 'Map Width', 'engage' ),
       		    'subtitle' => esc_html__( 'Select the map width.', 'engage' ),
       		    'options'  => array(
       		    	'stretch' => esc_html__( 'Stretch', "engage" ),
       		    	'contain' => esc_html__( 'Contain', "engage" )
       		    ),
       		    'default' => 'stretch',
       		),
       		array(
   			    'id'       => 'contact_map_position',
   			    'type'     => 'button_set',
   			    'title'    => esc_html__( 'Map Position', 'engage' ),
   			    'subtitle' => esc_html__( 'Shall the map appear before the page content or after it?', 'engage' ),
   			    'options'  => array(
   			    	'before' => esc_html__( 'Before Content', "engage" ),
   			    	'after' => esc_html__( 'After Content', "engage" )
   			    ),
   			    'default' => 'before',
   			),
   			array(
   			    'id'       => 'contact_map_zoom',
   			    'type' => 'slider',
   			    'title'    => esc_html__( 'Map Zoom', 'engage' ),
   			    'subtitle' => esc_html__( 'Specify the zoom of the map. Default: 14', 'engage' ),
   			    "default" => 1,
   			    "min" => 1,
   			    "step" => 1,
   			    "max" => 30,
   			    'resolution' => 1,
   			    'default' => 14,
   			    'display_value' => 'text'
   			),
   			array(
   			   'id'       => 'contact_map_marker',
   			   'type'     => 'switch',
   			   'title' => esc_html__( 'Map Marker', 'engage' ),
   			   'subtitle' => esc_html__( 'Enable a map marker at the center of the map.', 'engage' ),
   			   'default'  => true
   			),
   			array(
			    'id'       => 'contact_marker_title',
			    'type'     => 'text',
			    'title'    => esc_html__( 'Marker Title', 'engage' ),
			    'subtitle' => esc_html__( 'Enter the marker title displayed in a small popup after clicking the marker.', 'engage' ),
			    'default'  => 'Marker Title',
			    'class' => '',
			    'required' => array(
			       	'contact_map_marker',
			       	'equals',
			       	true
			       )
			),
			array(
			    'id'       => 'contact_marker_text',
			    'type'     => 'text',
			    'title'    => esc_html__( 'Marker Description', 'engage' ),
			    'subtitle' => esc_html__( 'Enter the marker description displayed in a small popup after clicking the marker.', 'engage' ),
			    'default'  => 'Marker description goes here.',
			    'class' => '',
			    'required' => array(
			       	'contact_map_marker',
			       	'equals',
			       	true
			       )
			),
			array(
			    'id'       => 'contact_marker_color',
			    'type'     => 'select',
			    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
			    'title'    => esc_html__( 'Marker Color', 'engage' ),
			    'subtitle' => esc_html__( 'Choose the map style.', 'engage' ),
			    'options'  => array(
			    	"red" => esc_html__( "Red", "engage" ),
		    		"amber" => esc_html__( "Amber", "engage" ),
		    		"blue" => esc_html__( "Blue", "engage" ),
		    		"dark" => esc_html__( "Dark", "engage" ),
		    		"indigo" => esc_html__( "Indigo", "engage" ),
		    		"orange" => esc_html__( "Orange", "engage" ),
		    		"pink" => esc_html__( "Pink", "engage" ),
		    		"purple" => esc_html__( "Purple", "engage" ),
		    		"teal" => esc_html__( "Teal (Green)", "engage" ),
		    		"white" => esc_html__( "White", "engage" )
			    ),
			    'default' => 'red',
			    'required' => array(
			       	'contact_map_marker',
			       	'equals',
			       	true
			       )
			),
            array(
                   'id' => 'end-contact-google-maps',
                   'type' => 'section',
                   'indent' => false,
            ),

    	)
    ) );

    // Sidebars

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Sidebars', 'engage' ),
        'desc' => esc_html__( 'Sidebar related options.', 'engage' ),
        'id'     => 'sidebars',
        'icon'   => 'fa fa-indent',
        'fields' => array(
            array(
                'id'       => 'sidebar_generator',
                'type'     => 'info',
                'style' => 'info',
                'title'    => esc_html__( 'New Sidebars', 'engage' ),
                'subtitle' => esc_html__( 'You can create new sidebars (widget areas) directly from your Appearance / Widgets menu right ', 'engage' ) . '<a target="_blank" href="' . esc_url( admin_url( 'widgets.php' ) ) . '">' . esc_html__( 'here', 'engage' ) . '</a>.',
            ),

    	)
    ) );

    // Social Icons

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Social Profiles', 'engage' ),
        'id'     => 'socialicons',
        'icon'   => 'fa fa-twitter',
        'fields' => array(
        	array(
        	    'id'        => 'social_profiles',
        	    'type'      => 'social_profiles',
        	    'title'     => esc_html__( 'Social Profiles', 'engage' ),
        	    'subtitle'  => esc_html__( 'Click an icon to activate it, drag and drop to change the icon order.', 'engage' ),
        	    'color_pickers' => false,
                'icons' => array(
                    array (
                        'id'         => 'telegram',
                        'icon'       => 'fa-telegram',
                        'enabled'    => false,
                        'name'       => esc_html__( 'Telegram', 'engage' ),
                        'background' => '',
                        'color'      => '',
                        'url'        => '',
                    ),
                    array (
                        'id'         => 'houzz',
                        'icon'       => 'fa-houzz',
                        'enabled'    => false,
                        'name'       => esc_html__( 'Houzz', 'engage' ),
                        'background' => '',
                        'color'      => '',
                        'url'        => '',
                    )
                )


            ),
    	)
    ) );

    // Shortcodes

    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Elements', 'engage' ),
        'id'    => 'el',
        'icon'  => 'fa fa-tasks'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Buttons', 'engage' ),
        'id'         => 'el_buttons',
        'desc' 		 => esc_html__( 'Styling options for buttons.', 'engage' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'el_btn_color',
                'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Default Button Color', 'engage' ),
                'subtitle' => esc_html__( 'Choose a default color of your buttons. You may adjust accent colors under "Styling" tab.', 'engage' ),
                'options'  => array(
                	"accent" => esc_html__( "Accent Color 1", "engage" ),
                	"accent2" => esc_html__( "Accent Color 2", "engage" ),
                	"accent3" => esc_html__( "Accent Color 3", "engage" ),
                ),
                'default' => ''
            ),
            array(
                'id'       => 'el_btn_color_hover',
                'type'     => 'select',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Default Button Hover', 'engage' ),
                'subtitle' => esc_html__( 'Choose a default hover color/effect for your buttons. You may adjust accent colors under "Styling" tab.', 'engage' ),
                'options'  => array(
                	"dark" => esc_html__( "Dark", "engage" ),
                	"white" => esc_html__( "White", "engage" ),
                	"accent" => esc_html__( "Accent Color 1", "engage" ),
                	"accent2" => esc_html__( "Accent Color 2", "engage" ),
                	"accent3" => esc_html__( "Accent Color 3", "engage" ),
                	"opacity" => esc_html__( "Lower Opacity", "engage" ),
                ),
                'default' => ''
            ),
            array(
                'id'       => 'el_btn_style',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Button Style', 'engage' ),
                'subtitle' => esc_html__( 'Choose a default style for your buttons.', 'engage' ),
                'options'  => array(
                	"solid" => esc_html__( "Solid", "engage" ),
                	"outline" => esc_html__( "Outline", "engage" )
                ),
                'default' => ''
            ),
            array(
                'id'       => 'el_btn_shadow',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Button Shadow', 'engage' ),
                'subtitle' => esc_html__( 'Enable a delicate shadow under your buttons.', 'engage' ),
                'options'  => array(
                	"yes" => esc_html__( "Yes", "engage" ),
                	"no" => esc_html__( "No", "engage" ),
                ),
                'default' => ''
            ),
            array(
                'id'       => 'el_btn_border_radius',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Button Border Radius', 'engage' ),
                'subtitle' => esc_html__( 'Select a border radius for your buttons.', 'engage' ),
                'options'  => array(
                	"regular" => esc_html__( "Regular", "engage" ),
                	"circle" => esc_html__( "Circle", "engage" ),
                	"square" => esc_html__( "Square", "engage" ),
                ),
                'default' => ''
            ),
            array(
                'id'       => 'el_btn_size',
                'type'     => 'spacing',
                'mode' 	   => 'padding',
                'units' 	=> 'px',
                'title'    => esc_html__( 'Default Button Size', 'engage' ),
                'subtitle' => esc_html__( 'Adjust default button size by modifying it\'s top, bottom, left and right padding values.', 'engage' ),
                'default' => '',
                'output' => '.btn-regular'
            ),
            array(
               'id' => 'el_btn-styling-start',
               'type' => 'section',
               'title' => esc_html__( 'Advanced Button Styling', 'engage' ),
               'subtitle' => esc_html__( 'Advanced styling options for your buttons.', 'engage' ),
               'indent' => true,
            ),
	            array(
	                'id'       => 'el_btn_typo',
	                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
	                'title'    => esc_html__( 'Default Button Typography', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the typograpy of your buttons.', 'engage' ),
	                'google'   => false,
	                "text-align" => false,
	                "line-height" => false,
	                "font-style" => true,
	                "color" => false,
	                "font-family" => false,
	                "letter-spacing" => true,
	                "text-transform" => true,
	                "preview" => false,
	                "output" => array( ".btn" )
	            ),
	            array(
	                'id'       => 'el_btn_small_typo',
	                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
	                'title'    => esc_html__( 'Small Button Typography', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the typograpy of your "small" sized buttons.', 'engage' ),
	                'google'   => false,
	                "text-align" => false,
	                "line-height" => false,
	                "font-style" => true,
	                "color" => false,
	                "font-family" => false,
	                "letter-spacing" => true,
	                "text-transform" => true,
	                "preview" => false,
	                "output" => array( ".btn-small" )
	            ),
	            array(
	                'id'       => 'el_btn_m_typo',
	                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
	                'title'    => esc_html__( 'Medium Button Typography', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the typograpy of your "medium" sized buttons.', 'engage' ),
	                'google'   => false,
	                "text-align" => false,
	                "line-height" => false,
	                "font-style" => true,
	                "color" => false,
	                "font-family" => false,
	                "letter-spacing" => true,
	                "text-transform" => true,
	                "preview" => false,
	                "output" => array( ".btn-medium" )
	            ),
	            array(
	                'id'       => 'el_btn_l_typo',
	                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
	                'title'    => esc_html__( 'Large Button Typography', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the typograpy of your "large" sized buttons.', 'engage' ),
	                'google'   => false,
	                "text-align" => false,
	                "line-height" => false,
	                "font-style" => true,
	                "color" => false,
	                "font-family" => false,
	                "letter-spacing" => true,
	                "text-transform" => true,
	                "preview" => false,
	                "output" => array( ".btn-large" )
	            ),
	            array(
	                'id'       => 'el_btn_xl_typo',
	                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
	                'title'    => esc_html__( 'XLarge Button Typography', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the typograpy of your "extra large" sized buttons.', 'engage' ),
	                'google'   => false,
	                "text-align" => false,
	                "line-height" => false,
	                "font-style" => true,
	                "color" => false,
	                "font-family" => false,
	                "letter-spacing" => true,
	                "text-transform" => true,
	                "preview" => false,
	                "output" => array( ".btn-xlarge" )
	            ),
	            array(
	                'id'       => 'el_btn_xl_typo',
	                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
	                'title'    => esc_html__( 'XXLarge Button Typography', 'engage' ),
	                'subtitle' => esc_html__( 'Specify the typograpy of your "XXL" sized buttons.', 'engage' ),
	                'google'   => false,
	                "text-align" => false,
	                "line-height" => false,
	                "font-style" => true,
	                "color" => false,
	                "font-family" => false,
	                "letter-spacing" => true,
	                "text-transform" => true,
	                "preview" => false,
	                "output" => array( ".btn-xxlarge" )
	            ),
            array(
               'id' => 'el_btn-styling-end',
               'type' => 'section',
               'indent' => false,
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Call to Action', 'engage' ),
        'id'         => 'el_cta',
        'desc' 		 => esc_html__( 'Default styling for the Call to Action element.', 'engage' ),
        'subsection' => true,
        'fields'     => array(
        	array(
        	    'id'       => 'el_cta_h',
        	    'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
        	    'title'    => esc_html__( 'Heading Typography', 'engage' ),
        	    'subtitle' => esc_html__( 'Specify the typograpy of the main heading.', 'engage' ),
        	    'google'   => false,
        	    "text-align" => false,
        	    "line-height" => false,
        	    "font-style" => true,
        	    "color" => false,
        	    "font-family" => false,
        	    "letter-spacing" => true,
        	    "text-transform" => true,
        	    "preview" => false,
        	    "output" => array( "h2.cta-heading" )
        	),
            array(
                'id'       => 'el_cta_s',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Subtitle Typography', 'engage' ),
                'subtitle' => esc_html__( 'Specify the typograpy of the subtitle.', 'engage' ),
                'google'   => false,
                "text-align" => false,
                "line-height" => false,
                "font-style" => true,
                "color" => true,
                "font-family" => false,
                "letter-spacing" => true,
                "text-transform" => true,
                "preview" => false,
                "output" => array( ".cta-subtitle" )
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Content Box', 'engage' ),
        'id'         => 'el_cbox',
        'desc' 		 => esc_html__( 'Default styling for the Content Box element.', 'engage' ),
        'subsection' => true,
        'fields'     => array(
        	array(
        	    'id'       => 'el_cbox_t',
        	    'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
        	    'title'    => esc_html__( 'Box Title Typography', 'engage' ),
        	    'subtitle' => esc_html__( 'Specify the typograpy of the Content Box title.', 'engage' ),
        	    'google'   => false,
        	    "text-align" => false,
        	    "line-height" => false,
        	    "font-style" => true,
        	    "color" => false,
        	    "font-family" => false,
        	    "letter-spacing" => true,
        	    "text-transform" => true,
        	    "preview" => false,
        	    "output" => array( ".vntd-content-box .simple-grid-title" )
        	),
            array(
                'id'       => 'el_cbox_p',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Text Typography', 'engage' ),
                'subtitle' => esc_html__( 'Specify the typograpy of the Content Box text.', 'engage' ),
                'google'   => false,
                "text-align" => false,
                "line-height" => false,
                "font-style" => true,
                "color" => true,
                "font-family" => false,
                "letter-spacing" => true,
                "text-transform" => true,
                "preview" => false,
                "output" => array( ".vntd-content-box .simple-grid-description" )
            ),
            array(
                'id'       => 'el_cbox_r',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Read More Typography', 'engage' ),
                'subtitle' => esc_html__( 'Specify the typograpy of the Read More link.', 'engage' ),
                'google'   => false,
                "text-align" => false,
                "line-height" => false,
                "font-style" => true,
                "color" => true,
                "font-family" => false,
                "letter-spacing" => true,
                "text-transform" => true,
                "preview" => false,
                "output" => array( ".vntd-content-box .simple-grid-btn" )
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Icon Boxes', 'engage' ),
        'id'         => 'el_icon_box',
        'desc' 		 => esc_html__( 'Styling options for Icon Boxes.', 'engage' ),
        'subsection' => true,
        'fields'     => array(
        	array(
        	    'id'       => 'el_icon_box_h_t',
        	    'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
        	    'title'    => esc_html__( 'Heading Text', 'engage' ),
        	    'subtitle' => esc_html__( 'Specify the typograpy of the Icon Box heading.', 'engage' ),
        	    'google'   => false,
        	    "text-align" => false,
        	    "line-height" => false,
        	    "font-style" => true,
        	    "color" => false,
        	    "font-family" => false,
        	    "letter-spacing" => true,
        	    "text-transform" => true,
        	    "preview" => false,
        	    "output" => array( "h5.icon-box-title" )
        	),
            array(
                'id'       => 'el_icon_box_t',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Description Text', 'engage' ),
                'subtitle' => esc_html__( 'Specify the typograpy of the description text in Icon Boxes.', 'engage' ),
                'google'   => false,
                "text-align" => false,
                "line-height" => false,
                "font-style" => true,
                "color" => true,
                "font-family" => false,
                "letter-spacing" => true,
                "text-transform" => true,
                "preview" => false,
                "output" => array( "p.icon-description" )
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Special Heading', 'engage' ),
        'id'         => 'el_shead',
        'desc' 		 => esc_html__( 'Default styling for the Special Heading element.', 'engage' ),
        'subsection' => true,
        'fields'     => array(
        	array(
        	    'id'       => 'el_shead_h',
        	    'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
        	    'title'    => esc_html__( 'Heading Typography', 'engage' ),
        	    'subtitle' => esc_html__( 'Specify the typograpy of the main heading.', 'engage' ),
        	    'google'   => false,
        	    "text-align" => false,
        	    "line-height" => false,
        	    "font-style" => true,
        	    "color" => false,
        	    "font-family" => false,
        	    "letter-spacing" => true,
        	    "text-transform" => true,
        	    "preview" => false,
        	    "output" => array( ".special-heading .special-heading-title" )
        	),
            array(
                'id'       => 'el_shead_s',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Subtitle Typography', 'engage' ),
                'subtitle' => esc_html__( 'Specify the typograpy of the subtitle.', 'engage' ),
                'google'   => false,
                "text-align" => false,
                "line-height" => false,
                "font-style" => true,
                "color" => true,
                "font-family" => false,
                "letter-spacing" => true,
                "text-transform" => true,
                "preview" => false,
                "output" => array( ".special-heading .special-heading-subtitle" )
            ),
        )
    ) );

    // Appearance

    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Styling', 'engage' ),
        'id'    => 'appearance',
        'icon'  => 'fa fa-paint-brush'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General Styling', 'engage' ),
        'desc' 		 => esc_html__( 'General theme styling. You may find much more styling options in various Theme Options panel locations like Header, Footer, Elements etc.', 'engage' ),
        'id'         => 'appearance_general',
        'subsection' => true,
        'fields'     => array(
        	array(
        	    'id'       => 'accent_color',
        	    'type'     => 'color',
        	    'title'    => esc_html__( 'Accent Color', 'engage' ),
        	    'subtitle' => esc_html__( 'Main Accent color. Also available as "color-accent" or "bg-color-accent" CSS classes.', 'engage' ),
        	    'default'  => '#218fe6',
        	    'transparent' => false
        	),
        	array(
        	    'id'       => 'theme_skin',
        	    'type'     => 'button_set',
        	    'title'    => esc_html__( 'Theme Skin', 'engage' ),
        	    'subtitle' => esc_html__( 'Choose a general theme skin. You can later overwrite default options.', 'engage' ),
        	    'options'  => array(
        	        "light" => esc_html__( "Light", 'engage' ),
        	        "dark" => esc_html__( "Dark", 'engage' )
        	    ),
        	    'default'  => 'light'
        	),
        	array(
        	    'id'       => 'bg_color',
        	    'type'     => 'color',
        	    'title'    => esc_html__( 'Site Background Color', 'engage' ),
        	    'subtitle' => esc_html__( 'Pick the main website background color.', 'engage' ),
        	    'default'  => '',
        	    'transparent' => false
        	),
      		array(
      		   'id' => 'styling-colors-begin',
      		   'type' => 'section',
      		   'title' => esc_html__( 'Other Colors', 'engage' ),
      		   'subtitle' => esc_html__( 'Customize other theme colors for use in various locations.', 'engage' ),
      		   'indent' => true,
      		),
      		    array(
      		        'id'       => 'accent_color2',
      		        'type'     => 'color',
      		        'title'    => esc_html__( 'Accent Color 2', 'engage' ),
      		        'subtitle' => esc_html__( 'Secondary accent color. Also available as "color-accent-2" or "bg-color-accent-2" CSS classes.', 'engage' ),
      		        'default'  => '',
      		        'transparent' => false,
      		        'output' => array(
      		        	'background-color' => '#wrapper .bg-color-accent-2,.btn.btn-hover-accent2:hover, .bg.btn-accent2,.btn-accent2,.header-light .main-nav li.nav-button a:hover span,body #wrapper .button:hover',
      		        	'color' => '.color-accent-2'
      		        )
      		    ),
      		    array(
      		        'id'       => 'accent_color3',
      		        'type'     => 'color',
      		        'title'    => esc_html__( 'Accent Color 3', 'engage' ),
      		        'subtitle' => esc_html__( 'Third accent color. Also available as "color-accent-3" or "bg-color-accent-3" CSS classes.', 'engage' ),
      		        'default'  => '',
      		        'transparent' => false,
      		        'output' => array(
      		        	'background-color' => '#wrapper .bg-color-accent-3,.btn-accent3,.btn.btn-hover-accent3:hover',
      		        	'color' => '.color-accent-3'
      		        )
      		    ),
      		    array(
      		        'id'       => 'custom_gradient',
      		        'type'     => 'color_gradient',
      		        'title'    => esc_html__( 'Predefined Gradient 1', 'engage' ),
      		        'subtitle' => esc_html__( 'Predefined gradient to be used in various locations i.e. row background. Also available as "color-gradient-1" or "bg-gradient-1" CSS classes.', 'engage' ),
      		        'transparent' => false,
      		        'default'  => array(
      		            'from' => '',
      		            'to'   => '',
      		        ),
      		    ),
      		    array(
      		        'id'       => 'custom_gradient2',
      		        'type'     => 'color_gradient',
      		        'title'    => esc_html__( 'Predefined Gradient 2', 'engage' ),
      		        'subtitle' => esc_html__( 'Predefined gradient to be used in various locations i.e. row background. Also available as "color-gradient-2" or "bg-gradient-2" CSS classes.', 'engage' ),
      		        'transparent' => false,
      		        'default'  => array(
      		            'from' => '',
      		            'to'   => '',
      		        ),
      		    ),
      		    array(
      		        'id'       => 'bg_color1',
      		        'type'     => 'color',
      		        'title'    => esc_html__( 'Predefined Background 1', 'engage' ),
      		        'subtitle' => esc_html__( 'Predefined background color that you may use with "bg-color-1" class for various elements and locations.', 'engage' ),
      		        'default'  => '',
      		        'transparent' => false,
      		        'output' => array( 'background-color' => '#wrapper .bg-color-1' )
      		    ),
      		    array(
      		        'id'       => 'bg_color2',
      		        'type'     => 'color',
      		        'title'    => esc_html__( 'Predefined Background 2', 'engage' ),
      		        'subtitle' => esc_html__( 'Predefined background color that you may use with "bg-color-2" class for various elements and locations.', 'engage' ),
      		        'default'  => '',
      		        'transparent' => false,
      		        'output' => array( 'background-color' => '#wrapper .bg-color-2' )
      		    ),
      		array(
      		   'id' => 'styling-colors-end',
      		   'type' => 'section',
      		   'indent' => false,
      		),
        ),

    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Content', 'engage' ),
        'desc' 		 => esc_html__( 'Content styling options.', 'engage' ),
        'id'         => 'styling_content',
        'subsection' => true,
        'fields'     => array(
        	array(
        	    'id'       => 'content_links_color',
        	    'type'     => 'link_color',
        	    'title'    => esc_html__( 'Links Color', 'engage' ),
        	    'subtitle' => esc_html__( 'Specify colors of regular content links in initial and hover state.', 'engage' ),
        	    'default'  => '',
        	    'transparent' => false,
        	    'active' => false,
        	    'class' => 'third-level',
        	    'output' => array( 'a, p a' )
        	),
            array(
                'id'       => 'light_scheme_h_c',
                'type'     => 'color',
                'title'    => esc_html__( 'Light Scheme Headings Color', 'engage' ),
                'subtitle' => esc_html__( 'Specify a color of headings in sections/rows with a "Light Scheme" (Row Settings).', 'engage' ),
                'default'  => '',
                'transparent' => false
            ),
            array(
                'id'       => 'light_scheme_t_c',
                'type'     => 'color',
                'title'    => esc_html__( 'Light Scheme Text Color', 'engage' ),
                'subtitle' => esc_html__( 'Specify a color of texts in sections/rows with a "Light Scheme" (Row Settings).', 'engage' ),
                'default'  => '',
                'transparent' => false
            ),
        ),

    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Sidebar & Widgets', 'engage' ),
        'desc' 		 => esc_html__( 'Widget styling options.', 'engage' ),
        'id'         => 'styling_sidebars',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'widgets_heading_t',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Widget Headings', 'engage' ),
                'subtitle' => esc_html__( 'Specify typography of widget headings.', 'engage' ),
                'google'   => true,
                "text-align" => false,
                "line-height" => true,
                "font-size" => true,
                "font-style" => false,
                "font-family" => false,
                "color" => true,
                "preview" => false,
                "letter-spacing" => true,
                "text-transform" => true,
                "output" => array( '.widget > h5' )
            ),
            array(
                'id'       => 'widgets_separator',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Widget Separator', 'engage' ),
                'subtitle' => esc_html__( 'Enable a line separator between widgets.', 'engage' ),
                'default'  => '',
                'options'  => array(
                    "yes" => esc_html__( "Yes", 'engage' ),
                    "no" => esc_html__( "No", 'engage' ),
                ),
            ),
            array(
                'id'       => 'widgets_separator_c',
                'type'     => 'color',
                'title'    => esc_html__( 'Widget Separator Color', 'engage' ),
                'subtitle' => esc_html__( 'Color of the widget separator line.', 'engage' ),
                'default'  => '',
                'transparent' => false,
                'required' => array(
                	'widgets_separator',
                	'not',
                	array( "no" )
                ),
                'output' => array( 'border-color' => '.widget' )
            ),
        ),

    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Forms', 'engage' ),
        'desc' 		 => esc_html__( 'Forms styling options.', 'engage' ),
        'id'         => 'styling_forms',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'forms_typo',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Input Typography', 'engage' ),
                'subtitle' => esc_html__( 'Specify typography of form text inputs.', 'engage' ),
                'google'   => true,
                "text-align" => false,
                "line-height" => true,
                "font-size" => true,
                "font-style" => false,
                "font-family" => false,
                "color" => false,
                "preview" => false,
                "letter-spacing" => true,
                "text-transform" => true,
                "output" => array( '.form-control, body .section-page input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), .section-page textarea, #wrapper .section-page select' )
            ),
            array(
                'id'       => 'forms_style',
                'type'     => 'multi_field',
                'title'    => esc_html__( 'Form Input', 'engage' ),
                'subtitle' => esc_html__( 'Specify styling of text form inputs.', 'engage' ),
                'default'  => '',
                'output' => array( '.form-control, #wrapper .section-page input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), body .section-page textarea, #wrapper .section-page select,.site-header input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), .site-header textarea, .site-header select' ),
            ),
            array(
                'id'       => 'forms_style_hover',
                'type'     => 'multi_field',
                'title'    => esc_html__( 'Form Input Hover', 'engage' ),
                'subtitle' => esc_html__( 'Specify styling of text form inputs in hover state.', 'engage' ),
                'default'  => '',
                'border_radius' => false,
                'border_width' => false,
                'output' => array( '#wrapper .section-page input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):hover, body .section-page textarea:hover, #wrapper .section-page select:hover' ),
            ),
            array(
                'id'       => 'forms_style_focus',
                'type'     => 'multi_field',
                'title'    => esc_html__( 'Form Input Focus', 'engage' ),
                'subtitle' => esc_html__( 'Specify styling of text form inputs in focus state.', 'engage' ),
                'default'  => '',
                'transparent' => true,
                'border_radius' => false,
                'border_width' => false,
                'output' => array( '#wrapper .section-page input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, body .section-page textarea:focus, #wrapper .section-page select:focus' ),
            ),
            array(
                'id'       => 'forms_label',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Field Label', 'engage' ),
                'subtitle' => esc_html__( 'Specify typography of field labels (Contact Form 7 and Gravity Forms).', 'engage' ),
                'google'   => true,
                "text-align" => false,
                "line-height" => true,
                "font-size" => true,
                "font-style" => false,
                "font-family" => false,
                "color" => false,
                "preview" => false,
                "letter-spacing" => true,
                "text-transform" => true,
                "output" => array( '.section-page .gform_wrapper label.gfield_label' )
            ),

        ),

    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page Loader', 'engage' ),
        'desc' 		 => esc_html__( 'Styling of the Page Loader.', 'engage' ),
        'id'         => 'styling_ploader',
        'subsection' => true,
        'fields'     => array(
        	array(
        	    'id'       => 'loader_color1',
        	    'type'     => 'color',
        	    'title'    => esc_html__( 'Page Loader Spinner Color 1', 'engage' ),
        	    'subtitle' => esc_html__( 'Color of the spinner moving element.', 'engage' ),
        	    'default'  => '',
        	    'transparent' => false,
        	    'output' => array( 'border-bottom-color' => '.loader-wrapper .loader-circle::before' )
        	),
        	array(
        	    'id'       => 'loader_color2',
        	    'type'     => 'color',
        	    'title'    => esc_html__( 'Page Loader Spinner Color 2', 'engage' ),
        	    'subtitle' => esc_html__( 'Color of the spinner ring.', 'engage' ),
        	    'default'  => '',
        	    'transparent' => false,
        	    'output' => array( 'border-color' => '.loader-circle::before' )
        	),
            array(
                'id'       => 'loader_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Page Loader Background', 'engage' ),
                'subtitle' => esc_html__( 'Background color of the page loader.', 'engage' ),
                'default'  => '',
                'transparent' => false,
                'output' => array( 'background-color' => '.loader-wrapper' )
            ),
            array(
                'id'       => 'loader_size',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Loader Size', 'engage' ),
                'subtitle' => esc_html__( 'Enter diameter of the page loader spinner. Default: 50 px.', 'engage' ),
                'default'  => '',
                'class' => 'textfield-tiny pixel-field',
            ),
            array(
                'id'       => 'loader_thickness',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Loader Thickness', 'engage' ),
                'subtitle' => esc_html__( 'Thickness of the spinner ring. Default: 2 px.', 'engage' ),
                'default'  => '',
                'class' => 'textfield-tiny pixel-field',
            ),

        ),

    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Typography', 'engage' ),
        'id'         => 'appearance_typography',
        'desc'   => esc_html__( 'Typography settings for your website. You may find additional typography options for other site elements in various options like Footer -> Footer Styling.', 'engage' ),
        'icon'   => 'fa fa-text-height',
        'class' => 'no-general-options',
        'fields'     => array(

        	array(
        	   'id' => 'typography-general-start',
        	   'type' => 'section',
        	   'title' => esc_html__( 'General Typography', 'engage' ),
        	   'subtitle' => esc_html__( 'General website typography settings.', 'engage' ),
        	   'indent' => true,
        	),
        	array(
        	    'id'       => 'typo_font_smooth',
        	    'type'     => 'button_set',
        	    'title'    => esc_html__( 'Antialiased Font Smoothing', 'engage' ),
        	    'subtitle' => esc_html__( 'Enable or disable antialiased font smoothing method for webkit browsers (Chrome, Safari).', 'engage' ),
        	    'options'  => array(
        	    	"on" => esc_html__( "On", "engage" ),
        	    	"off" => esc_html__( "Off", "engage" )
        	    ),
        	    'default' => ''
        	),
            array(
                'id'       => 'typography_body',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Body Font', 'engage' ),
                'subtitle' => esc_html__( 'Specify the body font properties.', 'engage' ),
                'google'   => true,
                "text-align" => false,
                "font-style" => false,
                'default'  => array(
                    'font-family' => 'Open Sans',
                ),
            ),
            array(
                'id'       => 'typography_primary',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Headings', 'engage' ),
                'subtitle' => esc_html__( 'Specify the general styling of your headings. You may adjust those options in individual options below.', 'engage' ),
                'google'   => true,
                "text-align" => false,
                "line-height" => false,
                "font-size" => false,
                "font-style" => false,
                "color" => false,
                "text-transform" => true,
                'default'  => array(
                    'font-family' => 'Open Sans',
                    'font-weight' => '400',
                    "font-size" => '',
                    "text-transform" => ''
                ),
            ),
            array(
                'id'       => 't_additional',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Additional Font', 'engage' ),
                'subtitle' => esc_html__( 'Specify an additional font to be used in various locations (Special Headings, Hero Sections etc).', 'engage' ),
                'google'   => true,
                "text-align" => false,
                "line-height" => true,
                "font-size" => false,
                "font-style" => false,
                "color" => false,
                "text-transform" => true,
                "letter-spacing" => true,
                "output" => array( '.font-additional,.font-additional h1, .font-additional h2, .font-additional h3, .font-additional h4, .font-additional h5, .font-additional h6' )
            ),
            array(
                'id'       => 'typo_h1',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Heading H1', 'engage' ),
                'subtitle' => esc_html__( 'Specify the H1 heading typography.', 'engage' ),
                'google'   => true,
                "text-align" => false,
                "letter-spacing" => true,
                "preview" => false,
                'output' => array( 'h1' )
            ),
            array(
                'id'       => 'typo_h2',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Heading H2', 'engage' ),
                'subtitle' => esc_html__( 'Specify the H2 heading typography.', 'engage' ),
                'google'   => true,
                "text-align" => false,
                "letter-spacing" => true,
                "preview" => false,
                'output' => array( 'h2' )
            ),
            array(
                'id'       => 'typo_h3',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Heading H3', 'engage' ),
                'subtitle' => esc_html__( 'Specify the H3 heading typography.', 'engage' ),
                'google'   => true,
                "text-align" => false,
                "letter-spacing" => true,
                "preview" => false,
                'output' => array( 'h3' )
            ),
            array(
                'id'       => 'typo_h4',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Heading H4', 'engage' ),
                'subtitle' => esc_html__( 'Specify the H4 heading typography.', 'engage' ),
                'google'   => true,
                "text-align" => false,
                "letter-spacing" => true,
                "preview" => false,
                'output' => array( 'h4' )
            ),
            array(
                'id'       => 'typo_h5',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Heading H5', 'engage' ),
                'subtitle' => esc_html__( 'Specify the H5 heading typography.', 'engage' ),
                'google'   => true,
                "text-align" => false,
                "letter-spacing" => true,
                "preview" => false,
                'output' => array( 'h5' )
            ),
            array(
                'id'       => 'typo_h6',
                'type'     => 'typography',
                'select2' => array(
                	'minimumResultsForSearch' => 20,
                	'allowClear' => false
                ),
                'title'    => esc_html__( 'Heading H6', 'engage' ),
                'subtitle' => esc_html__( 'Specify the H6 heading typography.', 'engage' ),
                'google'   => true,
                "text-align" => false,
                "letter-spacing" => true,
                "preview" => false,
                'output' => array( 'h6' )
            ),
            array(
               'id' => 'typography-general-end',
               'type' => 'section',
               'indent' => false,
            ),

        )
    ) );

    // Archives/Search

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Archives/Search', 'engage' ),
        'id'     => 'archives',
        'icon'   => 'fa fa-search',
        'fields' => array(
            array(
                'id'       => 'archives_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Archives Page Layout', 'engage' ),
                'subtitle' => esc_html__( 'Choose a default page layout for your pages: Fullwidth, Sidebar Right or Sidebar Left', 'engage'),
                'options'  => array(
                    'fullwidth' => array(
                        'alt' => 'No Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'sidebar_left' => array(
                        'alt' => 'Sidebar Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'sidebar_right' => array(
                        'alt' => 'Sidebar Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),
                    'sidebar_both' => array(
                        'alt' => '2 Sidebars',
                        'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                    ),
                ),
                'default'  => 'sidebar_right'
            ),
            array(
                'id'       => 'archives_page_title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Archives Page Page Title', 'engage' ),
                'subtitle' => esc_html__( 'Enable/Disable the Page Title area on the Archives page.', 'engage' ),
                'default'  => true
            ),
            array(
                'id'       => 'search_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Search Page Layout', 'engage' ),
                'subtitle' => esc_html__( 'Choose a default page layout for your pages: Fullwidth, Sidebar Right or Sidebar Left', 'engage' ),
                'options'  => array(
                    'fullwidth' => array(
                        'alt' => 'No Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'sidebar_left' => array(
                        'alt' => 'Sidebar Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'sidebar_right' => array(
                        'alt' => 'Sidebar Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),
                ),
                'default'  => 'sidebar_right'
            ),
            array(
                'id'       => 'search_page_title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Search Page Page Title', 'engage' ),
                'subtitle' => esc_html__( 'Enable/Disable the Page Title area on the Archives page.', 'engage' ),
                'default'  => true
            ),

    	)
    ) );

    //if ( class_exists('Woocommerce') ) {
	    Redux::setSection( $opt_name, array(
	        'title'  => esc_html__( 'WooCommerce', 'engage' ),
	        'desc' => esc_html__( 'These options are related with a WooCommerce plugin. Please install it in order to use ecommerce functionality on your website.', 'engage' ),
	        'id'     => 'woocommerce',
	        'icon'   => 'fa fa-shopping-cart',
	        'fields' => array(
	            array(
	                'id'       => 'header_woocommerce',
	                'type'     => 'switch',
	                'title'    => esc_html__( 'Shopping Cart Icon', 'engage' ),
	                'subtitle' => esc_html__( 'Enable/Disable the WooCommerce icon in the Header section.', 'engage' ),
	                'default'  => true
	            ),
	            array(
	                'id'       => 'shop_cols',
	                'type'     => 'button_set',
	                'title'    => esc_html__( 'Shop Page Columns', 'engage' ),
	                'subtitle' => esc_html__( 'Select number of columns for your shop products page.', 'engage' ),
	                'options'  => array(
	                    "4" => "4",
	                    "3" => "3",
	                    "2" => "2",
	                ),
	                'default'  => '3',
	            ),
              array(
	                'id'       => 'wc_product_page_title',
	                'type'     => 'switch',
	                'title'    => esc_html__( 'Product Page Title Area', 'engage' ),
	                'subtitle' => esc_html__( 'Enable/Disable the Page Title area on single product pages.', 'engage' ),
	                'default'  => true
	            ),

	    	)
	    ) );
   // }

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Translate', 'engage' ),
        'desc' => esc_html__( 'This tab allows you to easily translate certain theme strings without a need to use a translation plugin. Leave fields blank for defaults.', 'engage' ),
        'id'     => 'etranslate',
        'icon'   => 'fa fa-flag-o',
        'fields' => array(
            array(
                'id'       => 't_enable',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Translation', 'engage' ),
                'subtitle' => esc_html__( 'Enable/Disable the translation. If you use an external translation plugin or want to have a multilingual website (using WPML), make sure this option is disabled. When it\'s disabled, you will only be able to translate theme phrases using the plugin.', 'engage' ),
                'default'  => false
            ),
            array(
                'id'       => 't_read-more',
                'type'     => 'text',
                'title'    => esc_html__( 'Read more', 'engage' )
            ),
            array(
                'id'       => 't_view-page',
                'type'     => 'text',
                'title'    => esc_html__( 'View Page', 'engage' )
            ),
            array(
                'id'       => 't_visit-site',
                'type'     => 'text',
                'title'    => esc_html__( 'Visit Site', 'engage' )
            ),
            array(
                'id'       => 't_by',
                'type'     => 'text',
                'title'    => esc_html__( 'By', 'engage' )
            ),
            array(
                'id'       => 't_on',
                'type'     => 'text',
                'title'    => esc_html__( 'on', 'engage' )
            ),
            array(
                'id'       => 't_in',
                'type'     => 'text',
                'title'    => esc_html__( 'in', 'engage' )
            ),
            array(
                'id'       => 't_comment',
                'type'     => 'text',
                'title'    => esc_html__( 'Comment', 'engage' )
            ),
            array(
                'id'       => 't_comments',
                'type'     => 'text',
                'title'    => esc_html__( 'Comments', 'engage' )
            ),

            array(
                'id'       => 't_reply',
                'type'     => 'text',
                'subtitle' => esc_html__( '"Reply" to a post comment string.', 'engage' ),
                'title'    => esc_html__( 'Reply', 'engage' )
            ),
            array(
                'id'       => 't_leave-comment',
                'type'     => 'text',
                'title'    => esc_html__( 'Leave a comment', 'engage' )
            ),
            array(
                'id'       => 't_previous-post',
                'type'     => 'text',
                'subtitle' => esc_html__( 'Blog post navigation', 'engage' ),
                'title'    => esc_html__( 'Previous Post', 'engage' )
            ),
            array(
                'id'       => 't_next-post',
                'type'     => 'text',
                'subtitle' => esc_html__( 'Blog post navigation', 'engage' ),
                'title'    => esc_html__( 'Next Post', 'engage' )
            ),
            array(
                'id'       => 't_home',
                'type'     => 'text',
                'subtitle' => esc_html__( '"Home" link label in the Breadcrumbs area.', 'engage' ),
                'title'    => esc_html__( 'Home', 'engage' )
            ),
            array(
                'id'       => 't_page-not-found',
                'type'     => 'text',
                'title'    => esc_html__( 'Page not found', 'engage' )
            ),
            array(
                'id'       => 't_archives',
                'type'     => 'text',
                'title'    => esc_html__( 'Archives', 'engage' )
            ),
            array(
                'id'       => 't_search-results',
                'type'     => 'text',
                'title'    => esc_html__( 'Search results', 'engage' )
            ),
            array(
                'id'       => 't_search-results-for',
                'type'     => 'text',
                'title'    => esc_html__( 'Search results for', 'engage' )
            ),
            array(
                'id'       => 't_blog',
                'type'     => 'text',
                'title'    => esc_html__( 'Blog', 'engage' )
            ),
            array(
                'id'       => 't_search-big-placeholder',
                'type'     => 'text',
                'title'    => esc_html__( 'Type and Hit Enter..', 'engage' )
            ),
            array(
                'id'       => 't_search-placeholder',
                'type'     => 'text',
                'title'    => esc_html__( 'Search...', 'engage' )
            ),


            array(
               'id' => 't__contact-form',
               'type' => 'section',
               'title' => esc_html__( 'Forms', 'engage' ),
               'subtitle' => esc_html__( 'Translate contact and comment form strings.', 'engage' ),
               'indent' => true,
            ),
            array(
                'id'       => 't_name',
                'type'     => 'text',
                'title'    => esc_html__( 'Name', 'engage' )
            ),
            array(
                'id'       => 't_email',
                'type'     => 'text',
                'title'    => esc_html__( 'Email', 'engage' )
            ),
            array(
                'id'       => 't_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Subject', 'engage' )
            ),
            array(
                'id'       => 't_message',
                'type'     => 'text',
                'title'    => esc_html__( 'Message', 'engage' )
            ),
            array(
                'id'       => 't_send',
                'type'     => 'text',
                'title'    => esc_html__( 'Send', 'engage' )
            ),
            array(
                'id'       => 't_comment-form-consent',
                'type'     => 'text',
                'title'    => esc_html__( 'Comment Form Cookie Consent', 'engage' ),
                'desc'      => esc_html__( 'Used in Comments Form. Default:', 'engage' ) . ' "' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'engage' ) . '"'
            ),
            array(
                'id'       => 't_website',
                'type'     => 'text',
                'title'    => esc_html__( 'Website', 'engage' ),
                'desc'  => esc_html__( 'Used in the Comments Form (optional)', 'engage' )
            ),
            array(
                'id'       => 't_consent-ask',
                'type'     => 'textarea',
                'rows'      => 3,
                'title'    => esc_html__( 'Consent Ask Text', 'engage' ),
                'desc'  => esc_html__( 'Displayed below the default Contact Form (if enabled in Theme Options / Contact). Default: I consent to having this website store my submitted information so they can respond to my inquiry.', 'engage' )
            ),
            //
            array(
                'id' => 'end_t__contact-form',
                'type' => 'section',
                'indent' => false,
            ),


            array(
               'id' => 't__portfolio',
               'type' => 'section',
               'title' => esc_html__( 'Portfolio', 'engage' ),
               'subtitle' => esc_html__( 'Translate portfolio related strings.', 'engage' ),
               'indent' => true,
            ),
            array(
                'id'       => 't_about-project',
                'type'     => 'text',
                'title'    => esc_html__( 'About Project', 'engage' )
            ),
            array(
                'id'       => 't_project-details',
                'type'     => 'text',
                'title'    => esc_html__( 'Project Details', 'engage' )
            ),
            array(
                'id'       => 't_categories',
                'type'     => 'text',
                'title'    => esc_html__( 'Categories', 'engage' )
            ),
            array(
                'id'       => 't_skills',
                'type'     => 'text',
                'title'    => esc_html__( 'Skills', 'engage' )
            ),
            array(
                'id'       => 't_project-url',
                'type'     => 'text',
                'title'    => esc_html__( 'Project URL', 'engage' )
            ),
            array(
                'id'       => 't_client',
                'type'     => 'text',
                'title'    => esc_html__( 'Client', 'engage' )
            ),
            array(
                'id'       => 't_pdate',
                'type'     => 'text',
                'title'    => esc_html__( 'Date', 'engage' )
            ),
            array(
                'id'       => 't_budget',
                'type'     => 'text',
                'title'    => esc_html__( 'Budget', 'engage' )
            ),
            array(
                'id'       => 't_previous-project',
                'type'     => 'text',
                'subtitle' => esc_html__( 'Portfolio post navigation', 'engage' ),
                'title'    => esc_html__( 'Previous Project', 'engage' )
            ),
            array(
                'id'       => 't_next-project',
                'type'     => 'text',
                'subtitle' => esc_html__( 'Portfolio post navigation', 'engage' ),
                'title'    => esc_html__( 'Next Project', 'engage' )
            ),
            array(
                'id'       => 't_view-all',
                'type'     => 'text',
                'subtitle' => esc_html__( 'Filtering menu "View All"', 'engage' ),
                'title'    => esc_html__( 'View All', 'engage' )
            ),
            array(
                'id' => 'end_t__portfolio',
                'type' => 'section',
                'indent' => false,
            ),

            array(
                'id' => 't__wc',
                'type' => 'section',
                'title' => esc_html__( 'WooCommerce', 'engage' ),
                'subtitle' => esc_html__( 'WooCommerce related strings.', 'engage' ),
                'indent' => true,
            ),
            array(
                'id'       => 't_view-details',
                'type'     => 'text',
                'title'    => esc_html__( 'View Details', 'engage' )
            ),
            array(
                'id'       => 't_default-order',
                'type'     => 'text',
                'title'    => esc_html__( 'Default Order', 'engage' )
            ),
            array(
                'id'       => 't_sort-by',
                'type'     => 'text',
                'title'    => esc_html__( 'Sort by', 'engage' )
            ),
            array(
                'id'       => 't_price',
                'type'     => 'text',
                'title'    => esc_html__( 'Price', 'engage' )
            ),
            array(
                'id'       => 't_date',
                'type'     => 'text',
                'title'    => esc_html__( 'Date', 'engage' )
            ),
            array(
                'id'       => 't_popularity',
                'type'     => 'text',
                'title'    => esc_html__( 'Popularity', 'engage' )
            ),
            array(
                'id'       => 't_show',
                'type'     => 'text',
                'title'    => esc_html__( 'Show', 'engage' )
            ),
            array(
                'id'       => 't_products',
                'type'     => 'text',
                'title'    => esc_html__( 'Products', 'engage' )
            ),
            array(
                'id' => 'end_t__wc',
                'type' => 'section',
                'indent' => false,
            ),
            array(
                'id' => 't__login-form',
                'type' => 'section',
                'title' => esc_html__( 'Login Form', 'engage' ),
                'subtitle' => esc_html__( 'Translate the login form strings.', 'engage' ),
                'indent' => true,
            ),
            array(
                'id'       => 't_username_or_email',
                'type'     => 'text',
                'title'    => esc_html__( 'Username or Email Address', 'engage' )
            ),
            array(
                'id'       => 't_password',
                'type'     => 'text',
                'title'    => esc_html__( 'Password', 'engage' )
            ),
            array(
                'id'       => 't_remember_me',
                'type'     => 'text',
                'title'    => esc_html__( 'Remember Me', 'engage' )
            ),
            array(
                'id'       => 't_login',
                'type'     => 'text',
                'title'    => esc_html__( 'Log in', 'engage' )
            ),
            array(
                'id' => 'end_t__lf',
                'type' => 'section',
                'indent' => false,
            ),

        )
    ) );

    // Advanced

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Advanced', 'engage' ),
        'id'     => 'advanced',
        'icon'   => 'fa fa-wrench',
        'fields' => array(
          array(
              'id'       => 'custom_css',
              'type'     => 'ace_editor',
              'title'    => esc_html__( 'Custom CSS Code', 'engage' ),
              'subtitle' => esc_html__( 'Paste your CSS code here.', 'engage' ),
              'mode'     => 'css',
              'theme'		 => 'chrome',
              'default'  => ""
          )
    	)
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Plugin Updates', 'engage' ),
        'id'     => 'plugin-updates',
        'icon'   => 'fa fa-cloud-download',
        'fields' => array(
        	array(
        	    'id'       => 'plugin_updates_info',
        	    'type'     => 'info',
              'style' => 'info',
        	    'title'    => esc_html__( 'Instant Plugin Updates', 'engage' ),
        	    'desc' => esc_html__( "To get the latest version of premium plugins bundled with the theme, you don't have to wait for the theme update anymore. Just visit our", 'engage' ) . "<a href='https://plugins.veented.com/' target='_blank'>Veented Plugins</a>" . esc_html__( "service to get an instant access to the latest version of all bundled plugins.", 'engage' )
        	),

    	)
    ) );

    /*
     * <--- END SECTIONS
     */
