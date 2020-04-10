<?php

// Shortcode Processing

function engage_social_icons($atts, $content = null) {
	$attss = extract(shortcode_atts(array(
		"border" => 'round',
		"color" => 'outline',
		"size" => 'regular',
		"effect" => 'none',
		"el_class" => '',
		"align" => 'left',
		"css" => ''
	), $atts));

	// Icon Effect

	$icon_class = '';

	if( $effect != 'none' ) {
		$icon_class = ' icon-hover-' . esc_attr( $effect );
	}

	if( $color == 'colorful' ) {
		$color = 'colorful icon-colored social-icons-colored';
	}

	// Icons Loop

	$icons = '';
	$icon_arr = array( 'facebook', 'twitter', 'google', 'houzz', 'telegram', 'tumblr', 'linkedin', 'vimeo', 'pinterest', 'instagram','dribbble', 'skype','flickr', 'dropbox', 'youtube','email', 'dribbble', 'soundcloud', 'rss' );

	// New icons list

	if ( function_exists( 'engage_social_sites_array' ) ) {
		$icon_arr = engage_social_sites_array();
	}

	foreach( $icon_arr as $icon_name => $icon_title ) {
		if( array_key_exists( $icon_name, $atts ) ) {
		    $url = $atts[$icon_name];
		    if ( $icon_name == 'email' ) $url = 'mailto:' . $url;
			$icons .= '<a href="' . $url . '" class="social icon-' . $icon_name . $icon_class . '" target="_blank">';
			if ( $icon_name == 'email' ) $icon_name = 'envelope';
			$icons .= '<i class="fa fa-' . $icon_name . ' icon-primary"></i>';
			if( $effect == 'slideup' ) $icons .= '<i class="fa fa-' . $icon_name . ' icon-secondary"></i>';
			$icons .= '</a>';
		}
	}

	$custom_css = '';

	if( function_exists( 'vc_shortcode_custom_css_class' ) ) {
		$custom_css = vc_shortcode_custom_css_class( $css );
	}

	return '<div class="vntd-social-icons social-icons-' . esc_attr( $size ) . ' social-icons-' . esc_attr( $color ) . ' social-icons-' . esc_attr( $border ) . ' social-icons-effect-' . esc_attr( $effect ) . ' icons-align-' . esc_attr( $align ) . ' ' . $custom_css . '">' . $icons . '</div>';
}
remove_shortcode('social_icons');
add_shortcode('social_icons', 'engage_social_icons');
