<?php

function engage_image_slider( $atts, $content = null ) {

	$output = $link_start = $link_end = $slider_images = $nav_arrow = $nav_bullet = $gallery_class = '';

    extract(shortcode_atts(array(
        'onclick' => 'image_lightbox',
        'img_size' => 'large',
        'bullet_nav' => 'yes',
        'autoplay' => 'yes',
        'images' => '',
    ), $atts));

		// Vc check
		if ( ! function_exists( 'wpb_getImageBySize' ) ) {
			return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
		}

    wp_enqueue_script('engage-sliders', '', '', '', true);
		wp_enqueue_style('swiper');

		// OnClick action
    if ( $onclick == 'image_lightbox' ) {
        wp_enqueue_script( 'magnific-popup', '', '', '', true );
        $gallery_class = ' mp-gallery';
    }

    if ( $images == '' ) return esc_html__( "No images selected.", "engage" );

    $images = explode( ',', $images);
    $i = -1;

    if( $img_size != "custom" ) {
    	$img_size_custom = $img_size;
    }

    foreach ( $images as $attach_id ) {

        $i++;

        if ( strpos( $attach_id, 'http') !== false ) {
        	$thumbnail = '<img class="vc_single_image-img" src="' . $attach_id . '/' . $img_size . '" />';
        	$big_image = $attach_id . '/1920x1300';
        } else {
        	$post_thumbnail = wpb_getImageBySize(array( 'attach_id' => $attach_id, 'thumb_size' => $img_size_custom ));
        	$thumbnail = $post_thumbnail['thumbnail'];
        	$big_image = wp_get_attachment_image_src( $attach_id, 'full' );
        	$big_image = $big_image[0];
        }

        $link_start = $link_end = '';

        if ( $onclick == 'image_lightbox' ) {
            $link_start = '<a href="' . $big_image . '">';
            $link_end = '</a>';
        }

        $slider_images .= '<div class="swiper-slide">' . $link_start . $thumbnail . $link_end . '</div>';

    }

    $output .= '<div class="engage-swiper-slider swiper-container' . $gallery_class . '"><div class="swiper-wrapper">';

    $output .= $slider_images;

	$output .= '</div>';

	if( $bullet_nav == 'yes' ){
		$output .= '<div class="engage-slider-pagination swiper-pagination"></div>';
	}

	$output .= '</div>';

    return $output;

}

remove_shortcode( "engage_image_slider" );
add_shortcode( "engage_image_slider", "engage_image_slider" );
