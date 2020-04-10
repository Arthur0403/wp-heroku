<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css_animation
 * @var $css
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */
$el_class = $css = $css_animation = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'wpb_text_column wpb_content_element ' . $this->getCSSAnimation( $css_animation );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

// Extra Classes

$extra_classes = array();

if( $font_size != 'default' && $font_size != '' ) {
	$extra_classes[] = ' font-size-' . $font_size;
}

if ( $font_family == 'additional' ) {
	$extra_classes[] = ' font-additional';
}

if ( $text_color == 'white' ) {
	$extra_classes[] = ' color-scheme-white';
} elseif ( $text_color == 'accent' ) {
	$extra_classes[] = ' color-scheme-accent';
}

// End Extra Classes

$output = '
	<div class="' . esc_attr( $css_class ) . implode( ' ', $extra_classes ) . '">
		<div class="wpb_wrapper">
			' . wpb_js_remove_wpautop( $content, true ) . '
		</div>
	</div>
';

echo '' . $output;
