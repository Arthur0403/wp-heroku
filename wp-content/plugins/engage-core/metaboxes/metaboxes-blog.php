<?php

function engage_metaboxes_blog( $metaboxes ) {

	// Post Format: Gallery

	$boxSections = array();

	$boxSections[] = array(
	    'title'         => '',
	    'fields'        => array(
	    	array(
	    	    'id'       => 'blog_post_gallery',
	    	    'type'     => 'gallery',
	    	    'title'    => esc_html__( 'Image Gallery', 'engage' ),
	    	    'subtitle' => esc_html__( 'Add images to your post\'s gallery. They will be displayed as image slider.', 'engage' ),
	    	),
	    ),
	);

	$metaboxes[] = array(
	    'id'            => 'blog_post_format_gallery',
	    'title'         => esc_html__( 'Post Gallery', 'engage' ),
	    'post_types'    => array( 'post' ),
	    //'post_format' 	=> array( 'gallery' ), // Visibility of box based on post format
	    'position'      => 'normal', // normal, advanced, side
	    'priority'      => 'high', // high, core, default, low - Priorities of placement
	    'sections'      => $boxSections,
	);

	// Post Format: Audio

	$boxSections = array();

	$boxSections[] = array(
	    'title'         => '',
	    'fields'        => array(
	    	array(
	    	    'id'       => 'format_audio_source',
	    	    'type'     => 'select',
	    	    'title'    => esc_html__( 'Audio File Source', 'engage' ),
	    	    'subtitle' => esc_html__( 'Choose the audio file.', 'engage' ),
	    	    'options'  => array(
	    	    	"self_hosted" => esc_html__( "Self Hosted", 'engage' ),
	    	    	"external" => esc_html__( 'External Link', 'engage' )
	    	    ),
	    	    'default'  => 'self_hosted',
	    	    'url' => true,
	    	    'mode' => false
	    	),
	        array(
	            'id'       => 'format_audio_file',
	            'type'     => 'media',
	            'title'    => esc_html__( 'Audio File', 'engage' ),
	            'subtitle' => esc_html__( 'Choose the audio file.', 'engage' ),
	            'default'  => '',
	            'url' => true,
	            'mode' => false,
	            'required' => array('format_audio_source', '=', 'self_hosted')
	        ),
	        array(
	            'id'       => 'format_audio_url',
	            'type'     => 'text',
	            'title'    => esc_html__( 'Audio File URL', 'engage' ),
	            'subtitle' => esc_html__( 'Insert URL to the audio file.', 'engage' ),
	            'default'  => '',
	            'mode' => false,
	            'required' => array('format_audio_source', '=', 'external')
	        ),
	        array(
	            'id'       => 'format_audio_bg_color',
	            'type'     => 'color',
	            'title'    => esc_html__( 'Background Color', 'engage' ),
	            'subtitle' => esc_html__( 'Choose a background color for your audio player.', 'engage' ),
	            'default'  => '',
	            'transparent' => false
	        ),
	    ),
	);

	$metaboxes[] = array(
	    'id'            => 'blog_post_format_audio',
	    'title'         => esc_html__( 'Audio Post Format', 'engage' ),
	    'post_types'    => array( 'post' ),
	    //'post_format' 	=> array( 'audio' ), // Visibility of box based on post format
	    'position'      => 'normal', // normal, advanced, side
	    'priority'      => 'high', // high, core, default, low - Priorities of placement
	    'sections'      => $boxSections,
	);

	// Post Format: Video

	$boxSections = array();

	$boxSections[] = array(
	    'title'         => '',
	    'fields'        => array(
	        array(
	            'id'       => 'format_video_source',
	            'type'     => 'button_set',
	            'title'    => esc_html__( 'Video File Source', 'engage' ),
	            'subtitle' => esc_html__( 'Choose the audio file.', 'engage' ),
	            'options'  => array(
	            	"external" => "External",
	            	"self_hosted" => "Self Hosted"
	            ),
	            'default'  => 'external',
	        ),
	        array(
	            'id'       => 'format_video_file',
	            'type'     => 'media',
	            'title'    => esc_html__( 'Video File', 'engage' ),
	            'subtitle' => esc_html__( 'Choose the video file.', 'engage' ),
	            'default'  => '',
	            'url' => true,
	            'mode' => false,
	            'required' => array('format_video_source', '=', 'self_hosted')
	        ),
	        array(
	            'id'       => 'format_video_url',
	            'type'     => 'text',
	            'title'    => esc_html__( 'Video URL', 'engage' ),
	            'subtitle' => esc_html__( 'Insert URL to your video from YouTube, Vimeo etc..', 'engage' ),
	            'default'  => '',
	            'mode' => false,
	            'required' => array('format_video_source', '=', 'external')
	        ),
	    ),
	);

	$metaboxes[] = array(
	    'id'            => 'blog_post_format_video',
	    'title'         => esc_html__( 'Video Post Format', 'engage' ),
	    'post_types'    => array( 'post' ),
	    'position'      => 'normal', // normal, advanced, side
	    //'post_format' 	=> array( 'video' ),
	    'priority'      => 'high', // high, core, default, low - Priorities of placement
	    'sections'      => $boxSections,
	);

	// Post Format: Quote

	$boxSections = array();

	$boxSections[] = array(
	    'title'         => '',
	    'fields'        => array(
	        array(
	            'id'       => 'format_quote_content',
	            'type'     => 'textarea',
	            'title'    => esc_html__( 'Quote Content', 'engage' ),
	            'subtitle' => esc_html__( 'Insert the text content of the post\'s quote.', 'engage' ),
	            'default'  => ''
	        ),
	        array(
	            'id'       => 'format_quote_author',
	            'type'     => 'text',
	            'title'    => esc_html__( 'Quote Author', 'engage' ),
	            'subtitle' => esc_html__( 'Insert the quote\'s author.', 'engage' ),
	            'default'  => ''
	        ),
	        array(
	            'id'       => 'format_quote_bg_color',
	            'type'     => 'color',
	            'title'    => esc_html__( 'Background Color', 'engage' ),
	            'subtitle' => esc_html__( 'Choose a background color for your quote type post. Default is accent color.', 'engage' ),
	            'default'  => '',
	            'transparent' => false
	        ),
	    ),
	);

	$metaboxes[] = array(
	    'id'            => 'blog_post_format_quote',
	    'title'         => esc_html__( 'Quote Post Format', 'engage' ),
	    'post_types'    => array( 'post' ),
	    'position'      => 'normal', // normal, advanced, side
	    //'post_format' 	=> array( 'quote' ),
	    'priority'      => 'high', // high, core, default, low - Priorities of placement
	    'sections'      => $boxSections,
	);

	// Post Format: Link

	$boxSections = array();

	$boxSections[] = array(
	    'title'         => '',
	    'fields'        => array(
	        array(
	            'id'       => 'format_link_url',
	            'type'     => 'text',
	            'title'    => esc_html__( 'Link URL', 'engage' ),
	            'subtitle' => esc_html__( 'Insert the URL address of desired website.', 'engage' ),
	            'placeholder' => 'http://www.google.com',
	            'default'  => ''
	        ),
	        array(
	            'id'       => 'format_link_label',
	            'type'     => 'text',
	            'title'    => esc_html__( 'Link Label', 'engage' ),
	            'subtitle' => esc_html__( 'Label for the link.', 'engage' ),
	            'default'  => ''
	        ),
	        array(
	            'id'       => 'format_link_bg_color',
	            'type'     => 'color',
	            'title'    => esc_html__( 'Background Color', 'engage' ),
	            'subtitle' => esc_html__( 'Choose a background color for your link type post. Default is accent color.', 'engage' ),
	            'default'  => '',
	            'transparent' => false
	        ),
	    ),
	);

	$metaboxes[] = array(
	    'id'            => 'blog_post_format_link',
	    'title'         => esc_html__( 'Link Post Format', 'engage' ),
	    'post_types'    => array( 'post' ),
	    'position'      => 'normal', // normal, advanced, side
	    //'post_format' 	=> array( 'link' ),
	    'priority'      => 'high', // high, core, default, low - Priorities of placement
	    'sections'      => $boxSections,
	);

	return apply_filters( 'engage_metaboxes_blog_config', $metaboxes );

}

add_action( "redux/metaboxes/engage_options/boxes", "engage_metaboxes_blog" );
