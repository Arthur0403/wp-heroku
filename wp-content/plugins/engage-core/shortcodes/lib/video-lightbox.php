<?php

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Video Lightbox
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if( !function_exists('engage_video_lightbox') ) {
	function engage_video_lightbox( $atts, $content = null )
	{
		extract( shortcode_atts( array(
			"link" => '',
			"description" => 'This is our video!',
			"title" => "Our Video",
			"length" => "03:46",
			"color_scheme" => 'white',
			'img' => '',
			'style' => 'text',
			'shadow' => 'yes',
			'border' => ''
		), $atts ) );

		wp_enqueue_script( 'magnific-popup', '', '', '', true );
		wp_enqueue_style( 'magnific-popup' );

		$output = '<div class="video-lightbox color-scheme-' . esc_attr( $color_scheme ) . ' video-lightbox-' . esc_attr( $style ) . '"><div class="video-lightbox-inner"><a href="' . $link . '" class="video-link mp-video">';

		if ( $style == 'img' ) {

			if ( $img == '' ) {
				$output .= esc_html__( 'Please select a cover image.', 'engage' );
			} else {

				if ( strpos( $img, 'unsplash') !== false || strpos( $img, 'veented.com') !== false ) {
					$img_url = $img;
				} else {
					$img_url = wp_get_attachment_image_src( $img, 'full' );
					$img_url = $img_url[0];
				}
				$extra_classes = '';

				if ( $shadow == 'no' ) $extra_classes .= ' video-lightbox-no-shadow';
				if ( $border == 'round' ) $extra_classes .= ' video-lightbox-round';

				$output .= '<div class="video-lightbox-image-holder' . $extra_classes . '" style="background-image:url(' . esc_url( $img_url ) . ')"><div class="bg-overlay bg-overlay-dark20"></div><div class="video-lightbox-image-icon"><i class="engage-icon-icon engage-icon-triangle-right-17"></i></div></div>';
			}

			$output .= '</a>'; // Close lightbox link

		} else {
			$output .= '<i class="engage-icon-icon engage-icon-triangle-right-17"></i></a>';

			if ( $title ) {
				$output .= '<h2 class="video-lightbox-title">' . $title . '</h2>';
			}

			if ( $description ) {
				$output .= '<p class="video-lightbox-description">' . $description . '</p>';
			}

			if ( $length ) {
				$output .= '<p class="video-lightbox-length">' . $length . '</p>';
			}
		}

		$output .= '</div></div>';


		return $output;

	}
}
remove_shortcode( 'video_lightbox' );
add_shortcode( 'video_lightbox', 'engage_video_lightbox' );
