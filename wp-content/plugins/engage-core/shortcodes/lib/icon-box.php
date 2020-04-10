<?php

// Icon Box Shortcode

function engage_icon_box( $atts, $content = null )
{

    $defaultFont      = 'fontawesome';
    $defaultIconClass = 'fa fa-adjust';

    extract( shortcode_atts( array(
        "icon" => 'heart-o',
        "icon_type" => $defaultFont,
        "style" => 'centered-outline',
        "color" => '',
        "color_custom" => '',
        "title" => esc_html__( 'Icon Box Title', "engage" ),
        "text" => esc_html__( 'Icon Box text content, feel free to change it!', "engage" ),
        "url" => '',
        "link_label" => '',
        "target" => '_self',
        "animated" => 'no',
        "animation_delay" => 100,
        "c_margin_bottom" => '',
        "icon_align" => 'center',
        "icon_size" => 'medium',
        "bg" => 'no',
        "bg_color" => '1',
        "bg_color_custom" => '',
        "color_scheme" => '',
        "color_heading" => '',
        "color_text" => ''
    ), $atts ) );

    // WPBakery Page Builder Check
  	if ( ! function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
  		return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
  	}

    $inline_css = '';
    $icon_classes = array();
    $i_classes = $i_style = '';

    // Icon Related

    $icon = str_replace( 'fa-', '', $icon );
    vc_icon_element_fonts_enqueue( $icon_type );

    $iconClass = isset( $atts['icon_' . $icon_type] ) ? $atts['icon_' . $icon_type] : $defaultIconClass;

    // Default color

    if ( !$color && ( strpos( $style, 'outline' ) !== false || $style == 'centered-boxed' || $style == 'centered-boxed-2' ) ) {
        $color = 'gray';
    } elseif ( !$color ) {
        $color = '';
    }

    // Icon Style

    $icon_classes[] = 'box-' . esc_attr( $style );

    // Icon Align

    $aligned_class = 'box-centered';

    if ( strpos( $style, 'left' ) !== false ) {
        $aligned_class = 'box-aligned box-aligned-left';
    } elseif ( strpos( $style, 'right' ) !== false ) {
        $aligned_class = 'box-aligned box-aligned-right';
    } else { // Big Icon
        if ( $icon_align == 'left' || $icon_align == 'right' ) {
            $aligned_class .= ' big-icon-' . $icon_align;
        }
        if ( $icon_size != '' ) {
            $icon_classes[] = 'icon-size-' . $icon_size;
        }
    }

    $icon_classes[] = $aligned_class;

    // Colors

    if ( $color_scheme == 'white' ) {
        $icon_classes[] = 'color-scheme-white';
    }

    // Background Color

    if ( $bg == 'yes' ) {

        $icon_classes[] = 'box-with-bg';

        $icon_classes[] = 'bg-color-' . $bg_color;

        if ( $bg_color == 'custom' && $bg_color_custom != '' ) {
            $inline_css .= 'background-color:' . $bg_color_custom . ';';
        }

    }

    // Icon Color

    if ( $style == 'aligned-left-circle' || $style == 'centered-circle' || $style == 'aligned-right-circle' ) {
        if ( $color == '' ) {
            $color = 'accent';
        }
        $i_classes = ' bg-color-' . esc_attr( $color );
        if( $color_custom != '' ) {
            $i_style = 'style="background-color:' . esc_attr( $color_custom ) .';"';
        }
    } elseif ( $color != '' ) {
        $i_classes = ' color-' . esc_attr( $color );
        if( $color_custom != '' ) {
            $i_style = 'style="color:' . esc_attr( $color_custom ) .';"';
        }
    }

    // Animation

    $animated_data = '';

    if ( $animated == 'yes' ) {
        wp_enqueue_script( 'appear', '', '', '', true );
        $icon_classes[] = Engage_Core::get_animated_class();
        $animated_data  = ' data-animation="fadeIn" data-animation-delay="' . $animation_delay . '"';
    }

    // Icon Link

    if ( $url ) {
        $icon_classes[] = ' icon-box-with-link';
    }

    // Margin bottom

    if ( $c_margin_bottom != '' ) {
        $inline_css .= 'margin-bottom:' . str_replace( 'px', '', $c_margin_bottom ) . 'px;';
    }

    if( $inline_css ) {
        $inline_css = 'style="' . esc_attr( $inline_css ) . '";';
    }

    // Output

    $output = '<div class="vntd-icon-box vntd-content-element ' . implode( ' ', $icon_classes ) . '"' . $animated_data . $inline_css . '>';

    if ( $url ) $output .= '<a href="' . esc_url( $url ) . '" target="' . esc_attr( $target ) . '">';

    $output .= '<div class="icon-box-icon' . $i_classes. '"' . $i_style . '><i class="' . $iconClass . '"></i></div>';

    $heading_inline = $text_inline = '';
    if ( $color_heading != '' ) $heading_inline = 'style="color:' . esc_attr( $color_heading ) . '!important;"';
    if ( $color_text != '' ) $text_inline = 'style="color:' . esc_attr( $color_text ) . '!important;"';

    $output .= '<div class="icon-box-content">';
    $output .= '<h5 class="icon-box-title"' . $heading_inline .'>' . $title . '</h5>';
    $output .= '<p class="icon-description"' . $text_inline . '>' . $text . '</p>';
    if ( $url && $link_label != '' ) {
        $output .= '<span class="post-more post-more-icon">' . esc_html( $link_label ) . '</span>';
    }
    $output .= '</div>';

    if ( $url ) $output .= '</a>';

//	if ( $url && $style == 'big-centered-square' || $url && $style == 'big-centered-circle' || $url && $style == 'big-centered-circle-outline' ) {
//		$output .= '<a href="' . esc_url( $url ) . '" target="' . esc_attr( $target ) . '" class="box-button circle"><i class="fa fa-plus"></i></a>';
//	}

    $output .= '</div>';

    return $output;

}
remove_shortcode( 'icon_box' );
add_shortcode( 'icon_box', 'engage_icon_box' );
