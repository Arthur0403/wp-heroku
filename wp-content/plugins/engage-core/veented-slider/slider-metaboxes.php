<?php

// Engage Slider Metaboxes

if ( !function_exists( 'engage_slider_metaboxes' ) ) {

	function engage_slider_metaboxes( $metaboxes ) {

	    // Extra

	    $boxSections = array();

        $boxSections[] = array(
            'title'         => esc_html__('General', 'engage'),
            'icon'          => 'el el-icon-home', // Only used with metabox position normal or advanced
            'fields'        => array(
                array(
                    'id'       => 'slide_heading',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Slide Heading', 'engage' ),
                    'subtitle' => esc_html__( 'Main slide heading text.', 'engage' ),
                    'default'  => '',
                ),
                array(
                    'id'       => 'slide_subtitle',
                    'type'     => 'textarea',
                    'title'    => esc_html__( 'Slide Subtitle', 'engage' ),
                    'subtitle' => esc_html__( 'Slide subtitle paragraph text.', 'engage' ),
                    'default'  => '',
                ),
                array(
                    'id'       => 'slide_top_heading',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Slide Top Heading', 'engage' ),
                    'subtitle' => esc_html__( 'Additional text displayed above the Slide Heading.', 'engage' ),
                    'default'  => ''
                ),
                array(
                    'id'       => 'slide_button1_label',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Button 1 Label', 'engage' ),
                    'subtitle' => esc_html__( 'Slide button 1.', 'engage' ),
                    'default'  => ''
                ),
	                array(
	                    'id'       => 'slide_button1_action',
	                    'type'     => 'select',
	                    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
	                    'title'    => esc_html__( 'Button 1 Action', 'engage' ),
	                    'subtitle' => esc_html__( 'Slide button 1.', 'engage' ),
	                    'options'  => array(
	                    	"scroll" => "Scroll after slider",
	                        "link" => "Link",
	                        "link_external" => "External link",
	                        "scroll_to" => "Scroll to section",
                            "video" => esc_html__( "Open Video Lightbox", 'engage' )
	                    ),
	                    'default' => 'scroll'
	                ),
		                array(
		                    'id'       => 'slide_button1_action_offset',
		                    'type'     => 'text',
		                    'title'    => esc_html__( 'Button 1 Scroll Offset', 'engage' ),
		                    'subtitle' => esc_html__( 'Button 1 offset on the "Scroll after slider" action in pixels.', 'engage' ),
		                    'default'  => '',
		                    'class' => 'pixel-field',
		                    'required' => array( 'slide_button1_action','equals', array("scroll") )
		                ),
		                array(
		                    'id'       => 'slide_button1_link_page',
		                    'type'     => 'select',
		                    'title'    => esc_html__( 'Button 1 Link Page', 'engage' ),
		                    'subtitle' => esc_html__( 'Choose a page on your website button 1 links to.', 'engage' ),
		                    'data' => 'posts',
                            'args'  => array(
                                'post_type'      => apply_filters( 'engage_link_post_types', array( 'post', 'portfolio', 'page' ) ),
                                'posts_per_page' => -1
                            ),
		                    'required' => array( 'slide_button1_action','equals', array("link") )
		                ),
		                array(
		                    'id'       => 'slide_button1_link_url',
		                    'type'     => 'text',
		                    'title'    => esc_html__( 'Button 1 Link URL', 'engage' ),
		                    'subtitle' => esc_html__( 'Insert website url or section #unique_id (if "Scroll to section" action chosen).', 'engage' ),
		                    'default' => 'http://',
		                    'required' => array( 'slide_button1_action','equals', array("link_external", "scroll_to") )
		                ),
                        array(
                            'id'       => 'slide_button1_video_url',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Button 1 Video URL', 'engage' ),
                            'subtitle' => esc_html__( 'Enter the URL for a lightbox video (YouTube or Vimeo only), like:', 'engage' ) . ' http://www.youtube.com/watch?v=7HKoqNJtMTQ',
                            'default' => 'http://',
                            'required' => array( 'slide_button1_action','equals', array( "video" ) )
                        ),
		                array(
		                    'id'       => 'slide_button1_link_target',
		                    'type'     => 'select',
		                    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
		                    'title'    => esc_html__( 'Button 1 Link Target', 'engage' ),
		                    'subtitle' => esc_html__( 'Choose a button link target.', 'engage' ),
		                    'default' => '_self',
		                    'options' => array(
		                    	"_self" => "Open in the same tab (_self)",
		                    	"_blank" => "Open in a new tab (_blank)"
		                    ),
		                    'required' => array( 'slide_button1_action','equals', array("link", "link_external") )
		                ),
                array(
                    'id'       => 'slide_button2_label',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Button 2 Label', 'engage' ),
                    'subtitle' => esc_html__( 'Slide button 2.', 'engage' ),
                    'default'  => ''
                ),
                	array(
                	    'id'       => 'slide_button2_action',
                	    'type'     => 'select',
                	    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
                	    'title'    => esc_html__( 'Button 2 Action', 'engage' ),
                	    'subtitle' => esc_html__( 'Slide button 2.', 'engage' ),
                	    'options'  => array(
                	    	"scroll" => "Scroll after slider",
                	    	"link" => "Link",
                	    	"link_external" => "External link",
                	    	"scroll_to" => "Scroll to section",
                            "video" => esc_html__( "Open Video Lightbox", 'engage' )
                	    ),
                	    //'required' => array( 'slide_button1_action','==', '' )
                	),
                	    array(
                	        'id'       => 'slide_button2_action_offset',
                	        'type'     => 'text',
                	        'title'    => esc_html__( 'Button 2 Scroll Offset', 'engage' ),
                	        'subtitle' => esc_html__( 'Button 2 offset on the "Scroll after slider" action in pixels.', 'engage' ),
                	        'default'  => '',
                	        'class' => 'pixel-field',
                	        'required' => array( 'slide_button2_action','equals', array("scroll") )
                	    ),
                	    array(
                	        'id'       => 'slide_button2_link_page',
                	        'type'     => 'select',
                	        'title'    => esc_html__( 'Button 2 Link Page', 'engage' ),
                	        'subtitle' => esc_html__( 'Choose a page on your website button 2 links to.', 'engage' ),
                            'data' => 'posts',
                            'args'  => array(
                                'post_type'      => apply_filters( 'engage_link_post_types', array( 'post', 'portfolio', 'page' ) ),
                                'posts_per_page' => -1
                            ),
                	        'required' => array( 'slide_button2_action','equals', array("link") )
                	    ),
                	    array(
                	        'id'       => 'slide_button2_link_url',
                	        'type'     => 'text',
                	        'title'    => esc_html__( 'Button 2 Link URL', 'engage' ),
                	        'subtitle' => esc_html__( 'Insert website url or section #unique_id (if "Scroll to section" action chosen).', 'engage' ),
                	        'default' => 'http://',
                	        'required' => array( 'slide_button2_action','equals', array("link_external", "scroll_to") )
                	    ),
                        array(
                            'id'       => 'slide_button2_video_url',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Button 2 Video URL', 'engage' ),
                            'subtitle' => esc_html__( 'Enter the URL for a lightbox video (YouTube or Vimeo only), like:', 'engage' ) . ' http://www.youtube.com/watch?v=7HKoqNJtMTQ',
                            'default' => 'http://',
                            'required' => array( 'slide_button2_action','equals', array( "video" ) )
                        ),
                	    array(
                	        'id'       => 'slide_button2_link_target',
                	        'type'     => 'select',
                	        'title'    => esc_html__( 'Button 2 Link Target', 'engage' ),
                	        'subtitle' => esc_html__( 'Choose a button link target.', 'engage' ),
                	        'default' => '_self',
                	        'options' => array(
                	        	"_self" => "Open in the same tab (_self)",
                	        	"_blank" => "Open in a new tab (_blank)"
                	        ),
                	        'required' => array( 'slide_button2_action','equals', array("link", "link_external") )
                	    ),

            	array(
            	    'id'       => 'slide_animation',
            	    'type'     => 'select',
            	    'title'    => esc_html__( 'Content Animation', 'engage' ),
            	    'subtitle' => esc_html__( 'Enable the content animation on slide start.', 'engage' ),
            	    'options'  => array(
            	    	"default" => "Yes",
            	        "no" => "No",
            	    ),
            	    'default' => 'default'
            	),
            ),
        );

        // Background Slider Tab

        $boxSections[] = array(
            'title'         => esc_html__('Background', 'engage'),
            'icon'          => 'el el-icon-picture', // Only used with metabox position normal or advanced
            'fields'        => array(
                array(
                    'id'       => 'slide_background_type',
                    'type'     => 'select',
                    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
                    'title'    => esc_html__( 'Background Type', 'engage' ),
                    'subtitle' => esc_html__( 'Media type for the slide background.', 'engage' ),
                    'options'  => array(
                    	"image" => esc_html__( "Image", 'engage' ),
                    	"video" => esc_html__( "Video - self hosted", 'engage' ),
                        "youtube" => "YouTube video",
                        "color" => esc_html__( "Solid Color", 'engage' ),
                    ),
                    'default' => 'image'
                ),

                // Begin image related controls:

                array(
                    'id'       => 'slide_image',
                    'type'     => 'media',
                    'url'      => true,
                    'readonly' => false,
                    'title'    => esc_html__( 'Background Image', 'engage' ),
                    'subtitle' => esc_html__( 'If not specifiec, Featured Image will be used.', 'engage' ),
                    'required' => array( 'slide_background_type','equals', array("image") )
                ),

                // Video related controls:

                array(
                    'id'       => 'slide_youtube_url',
                    'type'     => 'text',
                    'title'    => esc_html__( 'YouTube Video ID', 'engage' ),
                    'subtitle' => esc_html__( 'Insert the YouTube video URL. Example: http://youtu.be/BsekcY04xvQ. Note: Featured Image will be used as a placeholder before the video is loaded.', 'engage' ),
                    'default'  => 'http://youtu.be/BsekcY04xvQ',
                    'required' => array( 'slide_background_type','equals', array("youtube") )
                ),

                // Self Hosted Video

                array(
                    'id'       => 'slide_video_mp4',
                    'type'     => 'media',
                    'url' 	   => true,
                    'title'    => esc_html__( 'Video MP4 File', 'engage' ),
                    'subtitle' => esc_html__( 'Insert your video file in ".mp4" format.', 'engage' ),
                    'default'  => '',
                    'mode' => false,
                    'required' => array( 'slide_background_type', 'equals', array("video") )
                ),

                array(
                    'id'       => 'slide_video_webm',
                    'type'     => 'media',
                    'url' 	   => true,
                    'title'    => esc_html__( 'Video WEBM File', 'engage' ),
                    'subtitle' => esc_html__( 'Insert your video file in ".webm" format for cross browser compatibility. Not required.', 'engage' ),
                    'default'  => '',
                    'mode' => false,
                    'required' => array( 'slide_background_type', 'equals', array("video") )
                ),

                // Background Overlay

                array(
                    'id'       => 'slide_bg_img_position',
                    'type'     => 'select',
                    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
                    'title'    => esc_html__( 'Background Image Position', 'engage' ),
                    'subtitle' => esc_html__( 'Choose position of the slide background image.', 'engage' ),
                    'options'  => array(
                    	'' => esc_html__( 'Default', 'engage' ),
                        'center center' => esc_html__( 'Center Center', 'engage' ),
                        'center top' => esc_html__( 'Center Top', 'engage' ),
                        'center bottom' => esc_html__( 'Center Bottom', 'engage' ),
                        'left center' => esc_html__( 'Left Center', 'engage' ),
                        'left top' => esc_html__( 'Left Top', 'engage' ),
                        'left bottom' => esc_html__( 'Left Bottom', 'engage' ),
                        'right center' => esc_html__( 'Right Center', 'engage' ),
                        'right top' => esc_html__( 'Right Top', 'engage' ),
                        'right bottom' => esc_html__( 'Right Bottom', 'engage' ),
                    ),
                    'default' => 'none',
                    'required' => array( 'slide_background_type','equals', array( "image" ) )
                ),

                array(
                    'id'       => 'slide_bg_overlay',
                    'type'     => 'select',
                    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
                    'title'    => esc_html__( 'Background Overlay', 'engage' ),
                    'subtitle' => esc_html__( 'Choose an overlay for your background image.', 'engage' ),
                    'options'  => array(
                    	"none" => esc_html__( "None", 'engage' ),
                    	"dark10" => esc_html__( "Dark 10%", 'engage' ),
                    	"dark20" => esc_html__( "Dark 20%", 'engage' ),
                    	"dark30" => esc_html__( "Dark 30%", 'engage' ),
                    	"dark40" => esc_html__( "Dark 40%", 'engage' ),
                    	"dark60" => esc_html__( "Dark 60%", 'engage' ),
                    	"dark80" => esc_html__( "Dark 80%", 'engage' ),
                    	"dark90" => esc_html__( "Dark 90%", 'engage' ),
                    	"light10" => esc_html__( "Light 10%", 'engage' ),
                    	"light20" => esc_html__( "Light 20%", 'engage' ),
                    	"light40" => esc_html__( "Light 40%", 'engage' ),
                    	"light60" => esc_html__( "Light 60%", 'engage' ),
                    	"light80" => esc_html__( "Light 80%", 'engage' ),
                    	"accent"  => esc_html__( "Accent Color", 'engage' ),
                    	"accent-light"  => esc_html__( "Accent Light", 'engage' ),
                    ),
                    'default' => 'none',
                    'required' => array( 'slide_background_type','equals', array( "youtube", "image", "video" ) )
                ),

                // Slide background color

                array(
                    'id'       => 'slide_bg_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Background Color', 'engage' ),
                    'subtitle' => esc_html__( 'Slide background color.', 'engage' ),
                    'transparent' => false
                ),

                array(
                    'id'       => 'slide_bg_color2',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Background Color 2', 'engage' ),
                    'subtitle' => esc_html__( 'Add secondary color to create a beautiful gradient.', 'engage' ),
                    'transparent' => false
                ),

            ),
        );

        // Appearance Slider Tab

        $boxSections[] = array(
            'title'         => esc_html__('Appearance', 'engage'),
            'icon'          => 'el el-icon-brush', // Only used with metabox position normal or advanced
            'fields'        => array(
            	array(
            	    'id'       => 'slide_color',
            	    'type'     => 'select',
            	    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
            	    'title'    => esc_html__( 'Color Scheme', 'engage' ),
            	    'subtitle' => esc_html__( 'Choose a main color scheme. Affects slider texts and navigation color (if slider used as a hero section).', 'engage' ),
            	    'options'  => array(
            	    	"white" => "White",
            	    	"dark" => "Dark",
            	    ),
            	),
            	array(
            	    'id'       => 'slide_content_align',
            	    'type'     => 'select',
            	    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
            	    'title'    => esc_html__( 'Content Align', 'engage' ),
            	    'subtitle' => esc_html__( 'Alignment of the slide content.', 'engage' ),
            	    'options'  => array(
            	    	"center" => "Center",
            	    	"left" => "Left",
            	    	"right" => "Right",
            	    ),
            	),
            	array(
            	    'id'       => 'slide_content_container',
            	    'type'     => 'select',
            	    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
            	    'title'    => esc_html__( 'Container Width', 'engage' ),
            	    'subtitle' => esc_html__( 'Width of the content container.', 'engage' ),
            	    'options'  => array(
            	    	"narrow" => "Narrow - 560px",
            	    	"boxed" => "Contain in grid - 1200px",
            	    	"stretched" => "Stretched",
            	    ),
            	),
            	array(
            	    'id'       => 'slide_content_width',
            	    'type'     => 'select',
            	    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
            	    'title'    => esc_html__( 'Content Width', 'engage' ),
            	    'subtitle' => esc_html__( 'Width of the slide content.', 'engage' ),
            	    'options'  => array(
            	    	"narrow" => "Narrow - 560px",
            	    	"fullwidth" => "Fullwidth",
            	    ),
            	),
                array(
                    'id'       => 'slide_heading_typography',
                    'type'     => 'typography',
                    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
                    'title'    => esc_html__( 'Slide Heading Typography', 'engage' ),
                    'subtitle' => esc_html__( 'Adjust the typography for your slide heading. To change the font size on smaller screens, please visit', 'engage' ) . ' <a href="https://veented.ticksy.com/article/15039/" target="_blank">' . esc_html__( 'this article', 'engage') . '</a>.',
                    'google'   => true,
                    "text-align" => false,
                    "line-height" => false,
                    "font-family" => true,
                    "letter-spacing" => true,
                    "text-transform" => true,
                    "preview" => true,
                    'default'  => array(
                        'font-size'   => '',
                        'font-family' => '',
                        'font-weight' => '',
                        'color' => ''
                    ),
                ),
                array(
                    'id'       => 'slide_subtitle_typography',
                    'type'     => 'typography',
                    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
                    'title'    => esc_html__( 'Slide Subtitle Typography', 'engage' ),
                    'subtitle' => esc_html__( 'Adjust the typography for your slide subtitle. To change the font size on smaller screens, please visit', 'engage' ) . ' <a href="https://veented.ticksy.com/article/15039/" target="_blank">' . esc_html__( 'this article', 'engage') . '</a>.',
                    'google'   => true,
                    "text-align" => false,
                    "line-height" => false,
                    "font-family" => true,
                    "letter-spacing" => true,
                    "text-transform" => true,
                    "preview" => true,
                    'default'  => array(
                        'font-size'   => '',
                        'font-family' => '',
                        'font-weight' => '',
                    ),
                ),
                array(
                    'id'       => 'slide_top_heading_t',
                    'type'     => 'typography',
                    'select2' => array( 'minimumResultsForSearch' => 20, 'allowClear' => false ),
                    'title'    => esc_html__( 'Slide Top Heading Typography', 'engage' ),
                    'subtitle' => esc_html__( 'Adjust the typography for your slide Top Heading. To change the font size on smaller screens, please visit', 'engage' ) . ' <a href="https://veented.ticksy.com/article/15039/" target="_blank">' . esc_html__( 'this article', 'engage') . '</a>.',
                    'google'   => true,
                    "text-align" => false,
                    "line-height" => false,
                    "font-family" => true,
                    "letter-spacing" => true,
                    "text-transform" => true,
                    "preview" => true,
                    'default'  => array(
                        'font-size'   => '',
                        'font-family' => '',
                        'font-weight' => '',
                        'color' => ''
                    ),
                ),
                array(
                    'id'       => 'slide_button1_style',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Button 1 Style', 'engage' ),
                    'subtitle' => esc_html__( 'Style of the first button.', 'engage' ),
                    'options'  => array(
                    	"bordered" => esc_html__( "Bordered (Outline)", 'engage' ),
                    	"solid" => esc_html__( "Solid Background", 'engage' ),
                    ),
                ),
                array(
                    'id'       => 'slide_button1_color',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Button 1 Color', 'engage' ),
                    'subtitle' => esc_html__( 'Color of the first button.', 'engage' ),
                    'options'  => Engage_Theme::color_array( true ),
                ),
	                array(
	                    'id'       => 'slide_button1_color_custom',
	                    'type'     => 'color',
	                    'transparent' => false,
	                    'title'    => esc_html__( 'Button 1 Text Color', 'engage' ),
	                    'subtitle' => esc_html__( 'Choose a custom text color.', 'engage' ),
	                    'required' => array( 'slide_button1_color', 'equals', array( "custom" ) )
	                ),
	                array(
	                    'id'       => 'slide_button1_bg_color_custom',
	                    'type'     => 'color',
	                    'transparent' => false,
	                    'title'    => esc_html__( 'Button 1 Background Color', 'engage' ),
	                    'subtitle' => esc_html__( 'Choose a custom background (or border if bordered style) color.', 'engage' ),
	                    'required' => array( 'slide_button1_color', 'equals', array( "custom" ) )
	                ),
                array(
                    'id'       => 'slide_button1_hover_color',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Button 1 Hover Color', 'engage' ),
                    'subtitle' => esc_html__( 'Hover color of the first button.', 'engage' ),
                    'options'  => Engage_Theme::hover_color_array(),
                ),
                // ** Secondary Button Begin **
                array(
                    'id'       => 'slide_button2_style',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Button 2 Style', 'engage' ),
                    'subtitle' => esc_html__( 'Style of the secondary button.', 'engage' ),
                    'options'  => array(
                    	"bordered" => esc_html__( "Bordered (Outline)", 'engage' ),
                    	"solid" => esc_html__( "Solid Background", 'engage' ),
                    ),
                ),
                array(
                    'id'       => 'slide_button2_color',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Button 2 Color', 'engage' ),
                    'subtitle' => esc_html__( 'Color of the secondary button.', 'engage' ),
                    'options'  => Engage_Theme::color_array( true ),
                ),
                	array(
                	    'id'       => 'slide_button2_color_custom',
                	    'type'     => 'color',
                	    'transparent' => false,
                	    'title'    => esc_html__( 'Button 2 Text Color', 'engage' ),
                	    'subtitle' => esc_html__( 'Choose a custom text color.', 'engage' ),
                	    'required' => array( 'slide_button2_color', 'equals', array( "custom" ) )
                	),
                	array(
                	    'id'       => 'slide_button2_bg_color_custom',
                	    'type'     => 'color',
                	    'transparent' => false,
                	    'title'    => esc_html__( 'Button 2 Background Color', 'engage' ),
                	    'subtitle' => esc_html__( 'Choose a custom background (or border if bordered style) color.', 'engage' ),
                	    'required' => array( 'slide_button2_color', 'equals', array( "custom" ) )
                	),
                array(
                    'id'       => 'slide_button2_hover_color',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Button 2 Hover Color', 'engage' ),
                    'subtitle' => esc_html__( 'Hover color of the secondary button.', 'engage' ),
                    'options'  => Engage_Theme::hover_color_array(),
                ),
                array(
                    'id'       => 'slide_buttons_border',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Buttons Border Radius', 'engage' ),
                    'subtitle' => esc_html__( 'Choose the border radius for your buttons.', 'engage' ),
                    'options'  => array(
                    	"default" => esc_html__( "Default (slightly rounded)", "engage" ),
                    	"circle" => esc_html__( "Circle", "engage" ),
                    	"square" => esc_html__( "Square (no radius)", "engage" )
                    ),
                ),
            ),

        );

        // Add metabox

        $metaboxes[] = array(
            'id'            => 'slide_settings',
            'title'         => esc_html__( 'Slide Settings', 'engage' ),
            'post_types'    => array( 'veented_slider' ),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low - Priorities of placement
            'sections'      => $boxSections,
        );

	    return $metaboxes;

	}

	// Change {$redux_opt_name} to your opt_name

	add_action( "redux/metaboxes/engage_options/boxes", "engage_slider_metaboxes" );
}
