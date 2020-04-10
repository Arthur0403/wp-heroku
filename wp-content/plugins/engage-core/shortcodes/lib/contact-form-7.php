<?php

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Contact Block
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

function engage_contact_form7($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => '',
		"color_scheme" => '',
		"btn_align" => 'left'
	), $atts));

	// If the form is submitted

	$output = '<div class="vntd-contact-form contact-form-' . $color_scheme . ' btn-align-' . esc_attr( $btn_align ) . '">';
	$output .= do_shortcode('[contact-form-7 id="' . esc_attr( $id ) . '"]');
	$output .= '</div>';

	return $output;

}
remove_shortcode( 'engage_contact_form7' );
add_shortcode( 'engage_contact_form7', 'engage_contact_form7' );
