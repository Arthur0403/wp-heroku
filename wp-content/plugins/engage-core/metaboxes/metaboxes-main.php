<?php

if ( ! function_exists( "engage_add_metaboxes" ) ) {

    function engage_add_metaboxes( $metaboxes ) {

        // Declare your sections
        $boxSections = array();

        // Blog Post

        $boxSections[] = array(
          'title'         => esc_html__('Blog Post', 'engage'),
          'icon'          => 'el el-pencil', // Only used with metabox position normal or advanced
          'post_type'		=> array( 'post' ),
          'fields'        => array(
              array(
                  'id'       => 'post_media',
                  'type'     => 'button_set',
                  'title'    => esc_html__( 'Post Media', 'engage' ),
                  'subtitle' => esc_html__( 'Display post media on single post page according to post format i.e. video player for "video" format etc.', 'engage' ),
                  'options'  => array(
                  	"default" => esc_html__( "Default", "engage" ),
                  	"display" => esc_html__( "Display", "engage" ),
                      "disable" 	=> esc_html__( "Hide", "engage" ),
                  ),
                  'default' => 'default',
                  'placeholder' => 'Default'
              ),
              array(
                  'id'       => 'page_title_blog_meta',
                  'type'     => 'button_set',
                  'title'    => esc_html__( 'Blog Meta Section', 'engage' ),
                  'subtitle' => esc_html__( 'Display the blog post meta section under the post title.', 'engage' ),
                  'options'  => array(
                      'default' => esc_html__( 'Default', 'engage' ),
                      'yes' => esc_html__( 'Yes', 'engage' ),
                      'no' => esc_html__( 'No', 'engage' ),
                  ),
              ),
          ),
        );

        // Portfolio Post

        $boxSections[] = array(
            'title'         => esc_html__('Portfolio Post', 'engage'),
            'icon'          => 'el el-briefcase', // Only used with metabox position normal or advanced
            'post_type'		=> array( 'portfolio' ),
            'fields'        => array(
            	array(
            	    'id'       => 'portfolio_info',
            	    'type'     => 'editor',
            	    'title'    => esc_html__( 'Project Information', 'engage' ),
            	    'hint' 	   => array(
            	            'content' => esc_html__( 'If this textarea is not empty then the default post content will be placed under the media part so you may use it to add complex content with Visual Composer for example.', 'engage' )
            	    ),
            	    'subtitle' => esc_html__( 'Leave empty to use the standard post content as your "About Project" section.', 'engage' ),
            	    'args' => array(
            	    	'wpautop' => true,
            	    	'media_buttons' => false,
            	    	'textarea_rows' => 6
            	    ),
            	),
                array(
                    'id'       => 'portfolio_layout',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Post Layout', 'engage' ),
                    'subtitle' => esc_html__( 'Choose layout for your portfolio post.', 'engage' ),
                    'hint' 	   => array(
                            'content' => esc_html__( 'Side - Media displayed on left side, post content in sidebar on the right.', 'engage' )
                    ),
                    'options'  => array(
                    	"default" 	=> esc_html__( "Default", "engage" ),
                    	"side" 		=> esc_html__( "Side", "engage" ),
                    	"fullwidth" => esc_html__( "Fullwidth", "engage" ),
                    ),
                    'default' => 'default'
                ),
                array(
                    'id'       => 'portfolio_details_display',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Project Details', 'engage' ),
                    'subtitle' => esc_html__( 'Display or hide the project details.', 'engage' ),
                    'hint' 	   => array(
                            'content' => esc_html__( 'Project Details is area with information like Project Categories, Skills, Client etc, defined below.', 'engage' )
                    ),
                    'options'  => array(
                    	"default" 	=> esc_html__( "Default", "engage" ),
                    	"yes" 	=> esc_html__( "Yes", "engage" ),
                        "no" 	=> esc_html__( "No", "engage" ),
                    ),
                    'default' => 'default'
                ),
                array(
                    'id'       => 'portfolio_project_heading',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show About Project Heading', 'engage' ),
                    'subtitle' => esc_html__( 'Display or hide the "About Project" heading above the Post Content.', 'engage' ),
                    'options'  => array(
                    	"default" 	=> esc_html__( "Default", "engage" ),
                    	"yes" 	=> esc_html__( "Yes", "engage" ),
                        "no" 	=> esc_html__( "No", "engage" ),
                    ),
                    'default' => 'default'
                ),
                array(
        			'id' => 'portfolio_separator1',
        			'type' => 'divide',
        			'title' => '',
            	),
            	array(
            	    'id'       => 'portfolio_media_display',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Show Media', 'engage' ),
            	    'subtitle' => esc_html__( 'Display or hide the portfolio post media, defined below (or Featured Image if no media defined).', 'engage' ),
            	    'options'  => array(
            	    	"default" 	=> esc_html__( "Default", "engage" ),
            	    	"yes" 	=> esc_html__( "Yes", "engage" ),
            	        "no" 	=> esc_html__( "No", "engage" ),
            	    ),
            	    'default' => 'default'
            	),
            	array(
            	    'id'       => 'portfolio_video_type',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Video Media', 'engage' ),
            	    'subtitle' => esc_html__( 'Display video in your portfolio post.', 'engage' ),
            	    'options'  => array(
            	    	"disable" 	=> esc_html__( "Disable", "engage" ),
            	    	"oembed" 	=> esc_html__( "oEmbed (YouTube etc)", "engage" ),
            	        "self_hosted" 	=> esc_html__( "Self Hosted", "engage" ),
            	    ),
            	    'default' => 'disable'
            	),
            		array(
            		    'id'       => 'portfolio_video_file',
            		    'type'     => 'media',
            		    'title'    => esc_html__( 'Self Hosted Video', 'engage' ),
            		    'subtitle' => esc_html__( 'Choose a video file from your library or insert URL.', 'engage' ),
            		    'default'  => '',
            		    'url' => true,
            		    'mode' => false,
            		    'readonly' => false,
            		    'preview' => false,
            		    'required' => array('portfolio_video_type', '=', 'self_hosted')
            		),
            		array(
            		    'id'       => 'portfolio_video_url',
            		    'type'     => 'text',
            		    'title'    => esc_html__( 'Video URL', 'engage' ),
            		    'subtitle' => esc_html__( 'Insert URL to your video from YouTube, Vimeo etc.', 'engage' ),
            		    'default'  => '',
            		    'mode' => false,
            		    'placeholder' => 'http://',
            		    'required' => array('portfolio_video_type', '=', 'oembed')
            		),
            	array(
            	    'id'       => 'portfolio_gallery',
            	    'type'     => 'gallery',
            	    'title'    => esc_html__( 'Image Gallery', 'engage' ),
            	    'subtitle' => esc_html__( 'Add images to your post\'s gallery.', 'engage' ),
            	),
            	array(
            	    'id'       => 'portfolio_gallery_type',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Gallery Type', 'engage' ),
            	    'subtitle' => esc_html__( 'Choose a type for your gallery: image slider or list with images displayed one under another.', 'engage' ),
            	    'options'  => array(
            	    	"default" 	=> esc_html__( "Default", "engage" ),
            	    	"list" 		=> esc_html__( "Image List", "engage" ),
            	    	"slider" 	=> esc_html__( "Image Slider", "engage" ),
            	    ),
            	    'default' => 'default'
            	),

            	array(
            		'id' => 'portfolio_separator2',
            		'type' => 'divide',
            		'title' => '',
            	),

            	array(
            	    'id'       => 'portfolio_details_heading',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Project Details Heading', 'engage' ),
            	    'subtitle' => esc_html__( 'Display or hide the "Project Details" heading above the Post Details area.', 'engage' ),
            	    'options'  => array(
            	    	"default" 	=> esc_html__( "Default", "engage" ),
            	    	"yes" 	=> esc_html__( "Yes", "engage" ),
            	        "no" 	=> esc_html__( "No", "engage" ),
            	    ),
            	    'default' => 'default'
            	),
            	array(
            	    'id'       => 'portfolio_display_categories',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Display Project Categories', 'engage' ),
            	    'subtitle' => esc_html__( 'Display project categories.', 'engage' ),
            	    'options'  => array(
            	    	"default" 	=> esc_html__( "Default", "engage" ),
            	    	"yes" 	=> esc_html__( "Yes", "engage" ),
            	        "no" 	=> esc_html__( "No", "engage" ),
            	    ),
            	    'default' => 'default'
            	),
            	array(
            	    'id'       => 'portfolio_display_skills',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Display Project Skills', 'engage' ),
            	    'subtitle' => esc_html__( 'Display project skills.', 'engage' ),
            	    'options'  => array(
            	    	"default" 	=> esc_html__( "Default", "engage" ),
            	    	"yes" 	=> esc_html__( "Yes", "engage" ),
            	        "no" 	=> esc_html__( "No", "engage" ),
            	    ),
            	    'default' => 'default'
            	),
            	array(
            	    'id'       => 'portfolio_link',
            	    'type'     => 'text',
            	    'title'    => esc_html__( 'Project Link', 'engage' ),
            	    'placeholder' => 'http://',
            	    'subtitle' => esc_html__( 'Insert project link URL. Optional.', 'engage' ),
            	),
            	array(
            	    'id'       => 'portfolio_client',
            	    'type'     => 'text',
            	    'title'    => esc_html__( 'Project Client', 'engage' ),
            	    'subtitle' => esc_html__( 'Insert your project client. Optional.', 'engage' ),
            	),
            		array(
            		    'id'       => 'portfolio_client_url',
            		    'type'     => 'text',
            		    'title'    => esc_html__( 'Project Client URL', 'engage' ),
            		    'subtitle' => esc_html__( 'Insert optional client\'s site URL.', 'engage' ),
            		    'required' => array('portfolio_client', 'not', '')
            		),
            	array(
            	    'id'       => 'portfolio_date',
            	    'type'     => 'date',
            	    'title'    => esc_html__( 'Project Date', 'engage' ),
            	    'subtitle' => esc_html__( 'Pick a completion date for your project.', 'engage' ),
            	),
            	array(
            	    'id'       => 'portfolio_budget',
            	    'type'     => 'text',
            	    'title'    => esc_html__( 'Project Budget', 'engage' ),
            	    'subtitle' => esc_html__( 'Insert project\'s budget. Optional.', 'engage' ),
            	),
            	array(
            	    'id'       => 'portfolio_extra1',
            	    'type'     => 'text',
            	    'title'    => esc_html__( 'Extra Field Label', 'engage' ),
            	    'subtitle' => esc_html__( 'Additional field displayed in your Project Details area.', 'engage' ),
            	),
            		array(
            		    'id'       => 'portfolio_extra1_value',
            		    'type'     => 'text',
            		    'title'    => esc_html__( 'Extra Field Value', 'engage' ),
            		    'subtitle' => esc_html__( 'Additional field value.', 'engage' ),
            		    'required' => array( 'portfolio_extra1', 'not', '' )
            		),
            	array(
            		'id' => 'portfolio_separator3',
            		'type' => 'divide',
            		'title' => '',
            	),

            	array(
            	    'id'       => 'portfolio_navigation',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Post Navigation', 'engage' ),
            	    'subtitle' => esc_html__( 'Display post navigation.', 'engage' ),
            	    'options'  => array(
            	    	"default" 	=> esc_html__( "Default", "engage" ),
            	    	"yes" 	=> esc_html__( "Yes", "engage" ),
            	        "no" 	=> esc_html__( "No", "engage" ),
            	    ),
            	    'default' => 'default'
            	),

            	array(
            	    'id'       => 'portfolio_parent',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Parent Portfolio Page', 'engage' ),
            	    'subtitle' => esc_html__( 'The portfolio post parent page used for navigation.', 'engage' ),
            	    'options'  => array(
            	    	"default" 	=> esc_html__( "Default", "engage" ),
            	    	"custom" 	=> esc_html__( "Custom", "engage" ),
            	    ),
            	    'default' => 'default'
            	),

            		array(
            		    'id'       => 'portfolio_parent_page',
            		    'type'     => 'select',
            		    'data'     => 'pages',
            		    'title'    => esc_html__( 'Portfolio Parent Page', 'engage' ),
            		    'subtitle' => esc_html__( 'Select this portfolio post\'s parent page.', 'engage' ),
            		    'required' => array( 'portfolio_parent', '=', 'custom' )
            		),

            	array(
            	    'id'       => 'portfolio_thumb_ratio',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Thumbnail Aspect Ratio', 'engage' ),
            	    'subtitle' => esc_html__( 'Choose thumbnail\'s aspect ratio for masonry portfolio grids.', 'engage' ),
            	    'options'  => array(
            	    	"default" 	=> esc_html__( "Default", "engage" ),
            	    	"tall" 	=> esc_html__( "Tall", "engage" ),
            	        "wide" 	=> esc_html__( "Wide", "engage" ),
            	        "big" 	=> esc_html__( "Big", "engage" ),
            	    ),
            	    'default' => 'default'
            	),

                array(
            		'id' => 'portfolio_separator3',
            		'type' => 'divide',
            		'title' => '',
            	),
                array(
            	    'id'       => '_post_like_count',
            	    'type'     => 'text',
            	    'title'    => esc_html__( 'Post Likes', 'engage' ),
            	    'subtitle' => esc_html__( 'Number of heart likes the post got.', 'engage' ),
                    'class' => 'textfield-tiny tiny-field'
            	),


            ),
        );

        // General

        $boxSections[] = array(
            'title'         => esc_html__('General', 'engage'),
            'icon'          => 'el-icon-home', // Only used with metabox position normal or advanced
            'fields'        => array(

            	array(
            	    'id'       => 'page__layout',
            	    'type'     => 'select',
            	    'title'    => esc_html__( 'Page Layout', 'engage' ),
            	    'subtitle' => esc_html__( 'Choose a layout for this page.', 'engage' ),
            	    'options'  => array(
            	    	"default" => esc_html__( "Default", 'engage' ),
            	    	"no_sidebar" => esc_html__( 'No Sidebar', 'engage' ),
            	        "sidebar_right" => esc_html__( "Sidebar Right", 'engage' ),
            	        "sidebar_left" 	=> esc_html__( "Sidebar Left", 'engage' ),
            	        "sidebar_both" 	=> esc_html__( "Sidebar Left & Right", 'engage' ),
            	    ),
            	    'default' => 'default',
            	    'placeholder' => 'Default'
            	),
            	array(
                    'id' => 'page_sidebar',
                    'title' => esc_html__( 'Sidebar', 'engage' ),
                    'subtitle' => 'Please select the sidebar you would like to display on this page. Note: You must first create the sidebar under Appearance > Widgets.',
                    'type' => 'select',
                    'data' => 'sidebars',
                ),
            	array(
            	    'id'       => 'sidebar__width',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Sidebar Width', 'engage' ),
            	    'subtitle' => esc_html__( 'Choose a width of the page sidebar.', 'engage' ),
            	    'options'  => array(
            	    	"default" => "Default",
            	    	"33" => '33%',
            	    	"25" => '25%'
            	    ),
            	    'default' => 'default',
            	),
            	array(
            	    'id'       => 'page__width',
            	    'type'     => 'select',
            	    'title'    => esc_html__( 'Page Content Width', 'engage' ),
            	    'subtitle' => esc_html__( 'Choose a width for this page.', 'engage' ),
            	    'options'  => array(
            	    	"default" => esc_html__( "Default", 'engage' ),
            	    	"normal" => esc_html__( "Normal", 'engage' ),
            	    	"stretch" => esc_html__( 'Stretch', 'engage' ),
            	        "stretch_no_padding" => esc_html__( "Stretch, no padding", 'engage' ),
            	        "narrow" => esc_html__( "Narrow", 'engage' ),
            	    ),
            	    'default' => 'default'
            	),

            	array(
            	    'id'             => 'page_content_padding',
            	    'type'           => 'spacing',
            	    'mode'           => 'padding',
            	    'units'          => 'px',
            	    //'display_units' 	=> false,
            	    'units_extended' => 'false',
            	    'left' => false,
            	    'right' => false,
            	    'title'          => esc_html__('Page Top/Bottom Padding', 'engage'),
            	    'subtitle'       => esc_html__('Set a top (between Title Area and Content) and bottom (between Content and Footer) padding. In pixels.', 'engage'),
            	    'default'            => array(
            	        'padding-top'     => '',
            	        'padding-bottom'  => '',
            	        'units'          => 'px',
            	    )
            	),

            	array(
            	    'id'       => 'bg__color',
            	    'type'     => 'color',
            	    'transparent' => false,
            	    'title'    => esc_html__( 'Background Color', 'engage' ),
            	    'subtitle' => esc_html__( 'Select page background color.', 'engage' ),
//            	    'output' => array(
//            	    	'background-color' => 'body'
//            	     ),
            	    'default'  => '',
            	),

            	array(
            	    'id'       => 'page_type',
            	    'type'     => 'button_set',
            	    'title'    => esc_html__( 'Page Type', 'engage' ),
            	    'subtitle' => esc_html__( 'Choose the page type.', 'engage' ),
            	    'options'  => array(
            	    	"default" => esc_html__( "Regular", 'engage' ),
            	    	"onepager" => esc_html__( "One Pager", 'engage' ),
            	    ),
            	    'default' => 'default'
            	),
            ),
        );

        // Header

        $boxSections[] = array(
           'title'         => esc_html__('Header', 'engage'),
           'icon'          => 'el el-minus', // Only used with metabox position normal or advanced
           'fields'        => array(
               array(
                   'id'       => 'page_header_skin',
                   'type'     => 'button_set',
                   'title'    => esc_html__( 'Header Skin', 'engage' ),
                   'subtitle' => esc_html__( 'Choose skin for Header in initial state.', 'engage' ),
                   'options'  => array(
                   	   "default" 	=> esc_html__( "Default", 'engage' ),
                       "light" 		=> esc_html__( "Light", 'engage' ),
                       "dark" 		=> esc_html__( "Dark", 'engage' ),
                       "transparent" => esc_html__( "Transparent", 'engage' )
                   ),
                   'desc' => esc_html__( 'Transparent header is basically a dark header (white text) with a transparent background.', 'engage' ),
                   'default' => 'default'
               ),
               array(
                   'id'       => 'page_header_color',
                   'type'     => 'color',
                   'transparent' => false,
                   'title'    => esc_html__( 'Header Color', 'engage' ),
                   'subtitle' => esc_html__( 'Choose color for Header in initial state.', 'engage' ),
                   'default'  => '',
                   'required' => array(
                   		"page_header_skin",
                   		"not",
                   		"transparent"
                   )
               ),
               array(
                   'id'       => 'page_header_opacity',
                   'type'     => 'text',
                   'title'    => esc_html__( 'Header Opacity', 'engage' ),
                   'subtitle' => esc_html__( 'Opacity of the header\'s background color in initial state. Value between 0 (fully transparent) to 1.0 (opaque). Other values: 0.3, 0.6, 0.8 etc.', 'engage' ),
                   'default'  => '',
                   'hint' => array(
                       'content' => esc_html__( 'Any value below 1.0 will place the page content behind Header if the Page Title is disabled so you might want to add some extra top padding.', 'engage' )
                   ),
                   'class' => 'textfield-tiny tiny-field',
                   'required' => array(
                   		"page_header_skin",
                   		"not",
                   		"transparent"
                   )
               ),
               array(
                   'id'       => 'page_header_separator',
                   'type'     => 'button_set',
                   'title'    => esc_html__( 'Header Separator', 'engage' ),
                   'subtitle' => esc_html__( 'Choose a type of your header separator.', 'engage' ),
                   'options'  => array(
                   	   "default" 	=> esc_html__( "Default", 'engage' ),
                       "shadow" 		=> esc_html__( "Shadow", 'engage' ),
                       "border" 		=> esc_html__( "Border", 'engage' ),
                       "none" 		=> esc_html__( "None", 'engage' ),
                   ),
                   'default' => 'default'
               ),
               array(
                   'id'       => 'page_custom_menu',
                   'type'     => 'select',
                   'title'    => esc_html__( 'Page Menu', 'engage' ),
                   'subtitle' => esc_html__( 'Choose a custom Menu for this particular page.', 'engage' ),
                   'data'  => 'menus'
               ),
               array(
                   'id'       => 'page_header_topbar_c',
                   'type'     => 'button_set',
                   'title'    => esc_html__( 'Top Bar', 'engage' ),
                   'subtitle' => esc_html__( 'Enable or disable the Top Bar individually on this page.', 'engage' ),
                   'options'  => array(
                   	   "default" 	=> esc_html__( "Default", 'engage' ),
                       "yes" 		=> esc_html__( "Yes", 'engage' ),
                       "no" 		=> esc_html__( "No", 'engage' ),
                   ),
                   'default' => 'default'
               ),
           ),
        );

        if ( function_exists( 'engage_custom_title_area_metabox' ) ) {
            $boxSections[] = engage_custom_title_area_metabox(); // You may use this to overwrite the entire Page Title tab in your Child Theme or a plugin.
        } else {
            $boxSections[] = array(
               'title'         => esc_html__( 'Page Title Area', 'engage' ),
               'icon'          => 'el el-website', // Only used with metabox position normal or advanced
               'fields'        => array(

                   array(
                       'id'       => 'custom_pagetitle',
                       'type'     => 'button_set',
                       'title'    => esc_html__( 'Page Title Area', 'engage' ),
                       'subtitle' => esc_html__( 'Choose a type of the Page Title section.', 'engage' ),
                       'options'  => array(
                           'enable' => esc_html__( 'Enable', 'engage' ),
                           'disable' => esc_html__( 'Disable', 'engage' ),
                       ),
                       'default' => 'enable'
                   ),

                   array(
                       'id'       => 'page_title_custom',
                       'type'     => 'text',
                       'title'    => esc_html__( 'Custom Title Text', 'engage' ),
                       'subtitle' => esc_html__( 'Type a different page title. Leave blank for default.', 'engage' ),
                       'default'  => '',
                       'required' => array(
                            array( 'custom_pagetitle', 'not', array( "disable" ) )
                        )
                   ),

                   // Subtitle

                   array(
                       'id'       => 'page_subtitle',
                       'type'     => 'text',
                       'title'    => esc_html__( 'Page Subtitle', 'engage' ),
                       'subtitle' => esc_html__( 'Optional page subtitle.', 'engage' ),
                       'default'  => '',
                       'required' => array( 'custom_pagetitle','not', array("disable") )
                   ),

                   array(
                            'id' => 'pagetitle_separator44',
                            'type' => 'divide',
                            'title' => '',
                    ),

                    // Background


                    array(
                        'id'       => 'custom_pagetitle_bg_image',
                        'type'     => 'media',
                        'url'      => true,
                        'readonly' => false,
                        'title'    => esc_html__( 'Background Image', 'engage' ),
                        'subtitle' => esc_html__( 'Choose background image.', 'engage' ),
                        'compiler' => 'true',
                        'required' => array( 'custom_pagetitle','not', array("disable") )
                    ),
                            array(
                                    'id'       => 'custom_pagetitle_bg_options',
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
                                        array( 'custom_pagetitle', 'not', array( "disable" ) ),
                                        array( 'custom_pagetitle_bg_image', 'not', '' )
                                    ),
                                    'output' => '.page-title-wrapper .page-title-bg'
                                ),
                            array(
                                'id'       => 'custom_pagetitle_bg_image_overlay',
                                'type'     => 'select',
                                'title'    => esc_html__( 'Background Image Overlay', 'engage' ),
                                'subtitle' => esc_html__( 'Choose an overlay for your background image.', 'engage' ),
                                'options'  => array(
                                    "none" => "None",
                                    "dark10" => "Dark 10%",
                                    "dark20" => "Dark 20%",
                                    "dark30" => "Dark 30%",
                                    "dark40" => "Dark 40%",
                                    "dark50" => "Dark 50%",
                                    "dark60" => "Dark 60%",
                                    "dark70" => "Dark 70%",
                                    "dark80" => "Dark 80%",
                                    "dark90" => "Dark 90%",
                                    "light20" => "Light 20%",
                                    "light40" => "Light 40%",
                                    "light60" => "Light 60%",
                                    "light80" => "Light 80%",
                                    "accent" => "Accent Color",
                                    "accent-light" => "Accent Light"
                                ),
                                'default'  => 'cover',
                                'required' => array(
                                    array( 'custom_pagetitle', 'not', array( "disable" ) ),
                                    array( 'custom_pagetitle_bg_image', 'not', '' )
                                )
                            ),

                        array(
                            'id'       => 'custom_pagetitle_bg_color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Background Color', 'engage' ),
                            'subtitle' => esc_html__( 'Background color of the Page Title area.', 'engage' ),
                            'default'  => '',
                            'transparent' => false,
                            'output' => array( 'background-color' => '#page-title' ),
                            'required' => array( 'custom_pagetitle','not', array("disable") )
                        ),
                        array(
                            'id'       => 'custom_pagetitle_bg_color2',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Background Color Gradient', 'engage' ),
                            'subtitle' => esc_html__( 'Create a beautiful gradient by selecting a second color. This is going to be the end color.', 'engage' ),
                            'default'  => '',
                            'transparent' => false,
                            'required' => array(
                                array( 'custom_pagetitle','not', array("disable") ),
                                array( 'custom_pagetitle_bg_color','not', '' )
                            )
                        ),

                    array(
                            'id' => 'pagetitle_separator3',
                            'type' => 'divide',
                            'title' => '',
                    ),

                        array(
                            'id'       => 'custom_pagetitle_fullscreen',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Fullscreen Page Title', 'engage' ),
                            'subtitle' => esc_html__( 'Choose size of your Page Title Area.', 'engage' ),
                            'default' => false,
                            'required' => array( 'custom_pagetitle','not', array("disable") )
                        ),

                        array(
                            'id'       => 'custom_pagetitle_height',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Page Title Height', 'engage' ),
                            'subtitle' => esc_html__( 'Enter height of the Page Title Area in pixels. Leave blank for default.', 'engage' ),
                            'default'  => '',
                            'class' => 'textfield-tiny pixel-field',
                            'required' => array(
                                array( 'custom_pagetitle','not', array("disable") ),
                                array( 'custom_pagetitle_fullscreen','not', true )
                             )
                        ),

                        array(
                                'id' => 'pagetitle_separator4',
                                'type' => 'divide',
                                'title' => '',
                        ),



                       // Typography & text colors

                       array(
                            'id'       => 'custom_pagetitle_align',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Text Alignment', 'engage' ),
                            'subtitle' => esc_html__( 'Choose text color scheme.', 'engage' ),
                            'options'  => array(
                                'default' => esc_html__( 'Default', 'engage' ),
                                'center' => esc_html__( 'Center', 'engage' ),
                                'left' => esc_html__( 'Left', 'engage' ),
                                'right' => esc_html__( 'Right', 'engage' ),
                            ),
                            'default' => 'default',
                            'required' => array( 'custom_pagetitle','not', array("disable") )
                        ),

                       array(
                           'id'       => 'custom_pagetitle_color',
                           'type'     => 'color',
                           'title'    => esc_html__( 'Title Color', 'engage' ),
                           'subtitle' => esc_html__( 'Custom color of the page title heading. Leave blank for default.', 'engage' ),
                           'default'  => '',
                           'transparent' => false,
                           'required' => array( 'custom_pagetitle','not', array("disable") ),
                           'output' => '#wrapper #page-title h1'
                       ),

                       array(
                           'id'       => 'custom_pagetitle_heading_size',
                           'type'     => 'typography',
                           'title'    => esc_html__( 'Title Font Size', 'engage' ),
                           'subtitle' => esc_html__( 'Enter size of the page title heading in pixels. Leave blank for default.', 'engage' ),
                           'default'  => '',
                           'google'   => false,
                           "text-align" => false,
                           "line-height" => false,
                           "font-style" => false,
                           "font-weight" => false,
                           "color" => false,
                           "font-family" => false,
                           "letter-spacing" => false,
                           "text-transform" => false,
                           'preview' => false,
                           'required' => array(
                                array( 'custom_pagetitle','not', array("disable") )
                            ),
                            'output' => '#wrapper #page-title h1'
                       ),

                       array(
                           'id'       => 'custom_pagetitle_subtitle_color',
                           'type'     => 'color',
                           'title'    => esc_html__( 'Subtitle Color', 'engage' ),
                           'subtitle' => esc_html__( 'Color of the page subtitle.', 'engage' ),
                           'default'  => '',
                           'transparent' => false,
                           'required' => array(
                                array( 'custom_pagetitle','not', array("disable") ),
                                array( 'page_subtitle','not', '' )
                            ),
                            'output' => '#wrapper #page-title .page-subtitle'
                       ),

                       array(
                           'id'       => 'custom_pagetitle_subtitle_size',
                           'type'     => 'typography',
                           'title'    => esc_html__( 'Subtitle Font Size', 'engage' ),
                           'subtitle' => esc_html__( 'Enter size of the page subtitle in pixels. Leave blank for default.', 'engage' ),
                           'default'  => '',
                           'google'   => false,
                           "text-align" => false,
                           "line-height" => false,
                           "font-style" => false,
                           "font-weight" => false,
                           "color" => false,
                           "font-family" => false,
                           "letter-spacing" => false,
                           "text-transform" => false,
                           'preview' => false,
                           'required' => array(
                                array( 'custom_pagetitle','not', array("disable") ),
                                array( 'page_subtitle','not', '' )
                            ),
                            'output' => '.page-title p.page-subtitle.'
                       ),

                       array(
                            'id' => 'pagetitle_separator1',
                            'type' => 'divide',
                            'title' => '',
                       ),

                       array(
                           'id'       => 'custom_pagetitle_breadcrumbs',
                           'type'     => 'button_set',
                           'title'    => esc_html__( 'Breadcrumbs', 'engage' ),
                           'subtitle' => esc_html__( 'Enable or disable the breadcrumbs navigation.', 'engage' ),
                           'options'  => array(
                               'default' => esc_html__( 'Default', 'engage' ),
                               'yes' => esc_html__( 'Yes', 'engage' ),
                               'no' => esc_html__( 'No', 'engage' ),
                           ),
                           'default' => 'default',
                           'required' => array( 'custom_pagetitle','not', array("disable") )
                       ),

                       array(
                           'id'       => 'custom_pagetitle_breadcrumbs_color',
                           'type'     => 'color',
                           'title'    => esc_html__( 'Breadcrumbs Color', 'engage' ),
                           'subtitle' => esc_html__( 'Color of breadcrumbs text.', 'engage' ),
                           'default'  => '',
                           'transparent' => false,
                           'required' => array(
                                array( 'custom_pagetitle','not', array("disable") ),
                                array( 'custom_pagetitle_breadcrumbs','not', array("no") )
                            ),
                       ),

                       array(
                            'id' => 'pagetitle_separator23',
                            'type' => 'divide',
                            'title' => '',
                       ),

                       array(
                           'id'       => 'pagetitle_parallax',
                           'type'     => 'button_set',
                           'title'    => esc_html__( 'Parallax', 'engage' ),
                           'subtitle' => esc_html__( 'Enable the parallax effect for the page title area.', 'engage' ),
                           'options'  => array(
                               'default' => esc_html__( 'Default', 'engage' ),
                               'yes' => esc_html__( 'Yes', 'engage' ),
                               'no' => esc_html__( 'No', 'engage' ),
                           ),
                           'default' => 'default',
                           'required' => array( 'custom_pagetitle','not', array("disable") )
                       ),

               ),
           );

        }

       // Custom CSS

       $boxSections[] = array(
           'title'         => esc_html__('Advanced', 'engage'),
           'icon'          => 'el el-cog', // Only used with metabox position normal or advanced
           'fields'        => array(
           		array(
           		    'id'       => 'body_classes',
           		    'type'     => 'text',
           		    'title'    => esc_html__( '#Wrapper Classes', 'engage' ),
           		    'subtitle' => esc_html__( 'Type CSS classes that will be added to the website\'s main container #wrapper. You may add as many classes as you want, just separate them with a space. You may later easily select them in your CSS code, like .myclass', 'engage' ),
           		    'mode'     => 'css',
           		    'theme'    => 'monokai',
           		    'default'  => ""
           		)
           ),
       );

        // Declare your metaboxes
        if (!isset($metaboxes) && !is_array($metaboxes)) { $metaboxes = array(); }

        $post_types_arr = array( 'page', 'post', 'acme_product', 'portfolio' );

        if ( has_filter( 'engage_page_settings_post_types' ) ) {
            $post_types_arr = apply_filters( 'engage_page_settings_post_types', $post_types_arr );
        }

        $metaboxes[] = array(
            'id'            => 'page_settings',
            'title'         => esc_html__( 'Page Settings', 'engage' ),
            'post_types'    => $post_types_arr,
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low - Priorities of placement
            'sections'      => $boxSections,
        );

        // Team Post

        $boxSections = array();

        $boxSections[] = array(
            'post_type'		=> array( 'team' ),
            'fields'        => array(
                array(
                    'id'       => 'name',
                    'type'     => 'text',
                    'placeholder' => 'John Doe',
                    'title'    => esc_html__( 'Member Name', 'engage' ),
                    'subtitle' => esc_html__( 'Team member full name.', 'engage' ),
                    'default'  => '',
                ),
                array(
                    'id'       => 'bio',
                    'type'     => 'textarea',
                    'title'    => esc_html__( 'Biography', 'engage' ),
                    'subtitle' => esc_html__( 'A short biography of the team member.', 'engage' ),
                    'default'  => '',
                    'placeholder' => esc_html__( 'Type...', 'engage' )
                ),
                array(
                   'id'       => 'hover_image',
                   'type'     => 'media',
                   'title'    => esc_html__( 'Hover Image', 'engage' ),
                   'subtitle' => esc_html__( 'Optional image of your team member displayed on hover.', 'engage' ),
                ),
                array(
                    'id'        => 'member_social_profiles',
                    'type'      => 'social_profiles',
                    'title'     => esc_html__( 'Social Profiles', 'engage' ),
                    'subtitle'  => esc_html__( 'Click an icon to activate it, drag and drop to change the icon order.', 'engage' ),
                ),
            ),
        );

        // Add Team Metabox

        $metaboxes[] = array(
            'id'            => 'team_settings',
            'title'         => esc_html__( 'Member Details', 'engage' ),
            'post_types'    => array( 'team' ),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low - Priorities of placement
            'sections'      => $boxSections,
        );

        // Testimonials

        $boxSections = array();

        $boxSections[] = array(
            'fields'        => array(
            	array(
            	    'id'       => 'testimonial_content',
            	    'type'     => 'textarea',
            	    'title'    => esc_html__( 'Text Content', 'engage' ),
            	    'subtitle' => esc_html__( 'Text content of the testimonial.', 'engage' ),
            	    'default'  => '',
            	    'placeholder' => esc_html__( 'Type...', 'engage' )
            	),
                array(
                    'id'       => 'name',
                    'type'     => 'text',
                    'placeholder' => 'John Doe',
                    'title'    => esc_html__( 'Author Name', 'engage' ),
                    'subtitle' => esc_html__( 'Team member full name.', 'engage' ),
                    'default'  => '',
                ),
                array(
                    'id'       => 'position',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Author Position', 'engage' ),
                    'subtitle' => esc_html__( 'Optional position of testimonial\'s author.', 'engage' ),
                    'default'  => '',
                ),
                array(
                    'id'       => 'website_url',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Website URL', 'engage' ),
                    'subtitle' => esc_html__( 'Optional URL to author\'s site.', 'engage' ),
                    'default'  => '',
                    'required' => array( 'name', 'not', '' )
                ),
            ),
        );

        // Add Team Metabox

        $metaboxes[] = array(
            'id'            => 'team_settings',
            'title'         => esc_html__( 'Testimonial Details', 'engage' ),
            'post_types'    => array( 'testimonials' ),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low - Priorities of placement
            'sections'      => $boxSections,
        );

        return apply_filters( 'engage_metaboxes', $metaboxes );

    }

    add_action("redux/metaboxes/engage_options/boxes", "engage_add_metaboxes");

}
