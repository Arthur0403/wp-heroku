<?php

// Simple Line Separator

function vntd_separator( $atts, $content = null )
{
	extract( shortcode_atts( array(
		"color" => ''
	), $atts ) );

	// Shortcode Output

	if ( $color == '' ) $color = 'default';

	return '<div class="wpb_content_element"><div class="wpb_wrapper"><div class="vntd-separator separator-color-' . $color . '"></div></div></div>';

}
remove_shortcode( 'vntd_separator' );
add_shortcode( 'vntd_separator', 'vntd_separator' );
