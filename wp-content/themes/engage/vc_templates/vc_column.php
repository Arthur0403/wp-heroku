<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */
$el_class = $width = $css = $offset = $col_padding = $col_padding_side = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
    $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
	'wpb_column',
	'vc_column_container',
	$width,
);

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
	$css_classes[]='vc_col-has-fill';
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

// Begin Engage Related

$column_classes = array();

if( $col_padding != '' && $col_padding != '0' ) {

	$column_classes[] = ' col-has-padding col-padding-' . $col_padding;
	$column_classes[] = 'col-padding-' . $col_padding_side;

	if ( strpos( $col_padding_side, 'all') !== false || strpos( $col_padding_side, 'top') !== false ) {
		$wrapper_attributes[] = 'data-padding-top="' . $col_padding . '"';
	}

	if ( strpos( $col_padding_side, 'all') !== false || strpos( $col_padding_side, 'bottom') !== false ) {
		$wrapper_attributes[] = 'data-padding-bottom="' . $col_padding . '"';
	}

}

// End Engage Related

$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . implode( ' ', $column_classes ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';

// Veented

$inline_css = '';


// Background image resize

$inline_css = engage_section_bg_image( $css, '1600' );

$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '"' . $inline_css . '>';

$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo '' . $output;
