<?php

// Contact Details Shortcode

function vntd_sc_contact_details( $atts, $content = null )
{
	extract( shortcode_atts( array(
		"color" => 'accent',
		"elements" => '',
		"border" => 'off',
		"size" => 'regular',
		"style" => '',
		"address" => '35th Ave, Queens, NY 11106, USA',
		"address_map" => 'yes',
		"phone" => '123 456 7893',
        "mobile" => '123 456 7893',
        "email1" => 'contact@mywebsite.com',
        "email2" => '',
        "title" => esc_html__( 'Contact Details', 'engage' ),
        "desc" => '',
        "tag" => 'h5'
	), $atts ) );
	
	$css_classes = array();

	$css_classes[] = 'icon-list-' . esc_attr( $size );

	// Border

	if( $border == 'off' ) {
		$css_classes[] = 'icon-list-no-border';
	} else {
		$css_classes[] = 'icon-list-border';
	}

	// Icons Color

	$icon_css = '';

	if( $color != 'gray' ) {
		$css_classes[] = 'icon-list-color-' . esc_attr( $color );
		if ( $style == 'outline' ) {
			$selector = ' color-';
		} else {
			$selector = ' bg-color-';
		}
		$icon_css = $selector . esc_attr( $color );
	}

	if ( $style == 'outline' ) {
		$css_classes[] = 'icon-list-outline';
	}

	// Style

	$css_classes[] = 'icon-list-circle';

	// Shortcode Output

	ob_start();

	echo '<div class="vntd-contact-details vntd-icon-list ' . implode( ' ', $css_classes ) . '">';

    // Title

    if ( $title != '' ) {
        $title_tag = $tag;
        echo '<' . $title_tag . '>' . esc_html( $title ) . '</' . $title_tag . '>';
    }

    // Description

    if ( $desc != '' ) {
        echo '<p class="contact-details-desc">' . esc_html( $desc ) . '</p>';
    }

    // The list

    echo '<ul class="icon-list">';

    // Address

    if ( $address != '' ) {
        $map_url = '';

        if ( $address_map != 'no' ) {
            $map_url = 'https://www.google.com/maps/place/' . str_replace( ' ', '+', $address ) . '/';
        }

        echo '<li class="contact-details-address"><a href="' . $map_url . '" target="_blank" title="' . esc_html( 'View Map' , 'engage' ) . '"><i class="fa fa-map-o' . $icon_css . '"></i><span class="icon-list-text">' . esc_html( $address ) . '</span></a></li>';
    }

    // Phone 1

    if ( $phone != '' ) {
        echo '<li class="contact-details-phone"><a href="tel:' . str_replace( ' ', '', esc_html( $phone ) ) . '"><i class="fa fa-phone' . $icon_css . '"></i><span class="icon-list-text">' . esc_html( $phone ) . '</span></a></li>';
    }

    // Mobile Phone

    if ( $mobile != '' ) {
        echo '<li class="contact-details-mobile"><a href="tel:' . str_replace( ' ', '', esc_html( $mobile ) ) . '"><i class="fa fa-mobile' . $icon_css . '"></i><span class="icon-list-text">' . esc_html( $mobile ) . '</span></a></li>';
    }

    // Email 1

    if ( $email1 != '' ) {
        echo '<li class="contact-details-email email1"><a href="mailto:' . esc_html( $email1 ) . '"><i class="fa fa-envelope-o' . $icon_css . '"></i><span class="icon-list-text">' . esc_html( $email1 ) . '</span></a></li>';
    }

    // Email 2

    if ( $email2 != '' ) {
        echo '<li class="contact-details-email email2"><a href="mailto:' . esc_html( $email2 ) . '"><i class="fa fa-envelope-o' . $icon_css . '"></i><span class="icon-list-text">' . esc_html( $email2 ) . '</span></a></li>';
    }

    // End list

	echo '</ul></div>';

	$content = ob_get_contents();
	ob_end_clean();

	return $content;

}
remove_shortcode( 'vntd_contact_details' );
add_shortcode( 'vntd_contact_details', 'vntd_sc_contact_details' );
