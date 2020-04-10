<?php

function veented_slider_vc_cats() {

	$portfolio_categories = get_categories('taxonomy=slide-locations');

	$portfolio_cats = array();

	$portfolio_cats[ '-- Select Category --' ] = '';

	foreach($portfolio_categories as $portfolio_cat) {
		if(is_object($portfolio_cat)) {
			$portfolio_cats[ $portfolio_cat->name ] = $portfolio_cat->slug;
		}
	}

	return $portfolio_cats;

}

function vntd_slider_categories() {
	global $post;

	$terms = wp_get_object_terms($post->ID, "member-position");

	if($terms) {
		foreach ( $terms as $term ) {
			echo esc_textarea($term->name);
			if(end($terms) !== $term){
				echo ", ";
			}
		}
	}
}

function vntd_slider_item_class(){

	global $post;
	$output = '';
    $terms = wp_get_object_terms($post->ID, "member-position");
	foreach ( $terms as $term ) {
		$output .= $term->slug . " ";
	}

	return $output;

}

// Slide custom CSS

if( !function_exists( 'veented_slider_slide_css' ) ) {
	function veented_slider_slide_css( $slide_id ) {

		$output = '';

		$slide_id = '#' . esc_attr( $slide_id );

		// Background Color

		if( ( $color1 = get_post_meta( get_the_ID(), "slide_bg_color", TRUE ) ) ) {
			$output .= $slide_id . '{ background-color: ' . esc_attr( get_post_meta( get_the_ID(), "slide_bg_color", TRUE ) ) . '; }';
			if( ( $color2 = get_post_meta( get_the_ID(), "slide_bg_color2", TRUE ) ) ) {
				$output .= $slide_id . '{' . engage_css_gradient( $color1, $color2 ) . '}';
			}
		}

    // Top Heading

    if( array_filter( get_post_meta( get_the_ID(), "slide_top_heading_t", TRUE ) ) ) {

        $typography_field = get_post_meta( get_the_ID(), "slide_top_heading_t", TRUE );

        $output .= $slide_id . ' .veented-slide-top-heading {';

        $font_weight = '600';

        if( $typography_field['font-weight'] ) {
            $font_weight = $typography_field['font-weight'];
            $output .= 'font-weight: ' . esc_attr( $typography_field['font-weight'] ) . ';';
        }

        if( $typography_field['font-family'] ) {
            $font_family = str_replace( ' ', '-', $typography_field['font-family'] );
            wp_enqueue_style( 'vntd-google-font-' . $font_family, '//fonts.googleapis.com/css?family=' . str_replace( ' ', '+', $typography_field['font-family'] ) . ':' . $font_weight );
            $output .= 'font-family: \'' . esc_attr( $typography_field['font-family'] ) . '\', Helvetica, Arial, sans-serif;';
        }

        if( $typography_field['text-transform'] ) {
            $output .= 'text-transform: ' . esc_attr( $typography_field['text-transform'] ) . ';';
        }

        if( $typography_field['font-size'] ) {
            $output .= 'font-size: ' . esc_attr( $typography_field['font-size'] ) . ';';
        }

        if( $typography_field['letter-spacing'] ) {
            $output .= 'letter-spacing: ' . esc_attr( $typography_field['letter-spacing'] ) . ';';
        }

        if( $typography_field['color'] ) {
            $output .= 'color: ' . esc_attr( $typography_field['color'] ) . ';';
        }

        $output .= '}'; // End

    }

		// Main Heading

		if( array_filter( get_post_meta( get_the_ID(), "slide_heading_typography", TRUE ) ) ) {

			$typography_field = get_post_meta( get_the_ID(), "slide_heading_typography", TRUE );

			$output .= $slide_id . ' .veented-slide-heading {';

			$font_weight = '600';

			if( $typography_field['font-weight'] ) {
				$font_weight = $typography_field['font-weight'];
				$output .= 'font-weight: ' . esc_attr( $typography_field['font-weight'] ) . ';';
			}

			if( $typography_field['font-family'] ) {
				$font_family = str_replace( ' ', '-', $typography_field['font-family'] );
				wp_enqueue_style( 'vntd-google-font-' . $font_family, '//fonts.googleapis.com/css?family=' . str_replace( ' ', '+', $typography_field['font-family'] ) . ':' . $font_weight );
				$output .= 'font-family: \'' . esc_attr( $typography_field['font-family'] ) . '\', Helvetica, Arial, sans-serif;';
			}

			if( $typography_field['text-transform'] ) {
				$output .= 'text-transform: ' . esc_attr( $typography_field['text-transform'] ) . ';';
			}

			if( $typography_field['font-size'] ) {
				$output .= 'font-size: ' . esc_attr( $typography_field['font-size'] ) . ';';
			}

			if( $typography_field['letter-spacing'] ) {
				$output .= 'letter-spacing: ' . esc_attr( $typography_field['letter-spacing'] ) . ';';
			}

			if( $typography_field['color'] ) {
				$output .= 'color: ' . esc_attr( $typography_field['color'] ) . ';';
			}

			$output .= '}'; // End

		}

		// Slide subtitle

		if( array_filter( get_post_meta( get_the_ID(), "slide_subtitle_typography", TRUE ) ) ) {

			$typography_field = get_post_meta( get_the_ID(), "slide_subtitle_typography", TRUE );

			$output .= $slide_id . ' .veented-slide-subtitle {';

			$font_weight = '600';

			if( $typography_field['font-weight'] ) {
				$font_weight = $typography_field['font-weight'];
				$output .= 'font-weight: ' . esc_attr( $typography_field['font-weight'] ) . ';';
			}

			if( $typography_field['font-family'] ) {

				$font_family = str_replace( ' ', '-', $typography_field['font-family'] );

				wp_enqueue_style( 'vntd-google-font-' . $font_family, '//fonts.googleapis.com/css?family=' . str_replace( ' ', '+', $typography_field['font-family'] ) . ':' . $font_weight );

				$output .= 'font-family: \'' . esc_attr( $typography_field['font-family'] ) . '\', Helvetica, Arial, sans-serif;';
			}

			if( $typography_field['text-transform'] ) {
				$output .= 'text-transform: ' . esc_attr( $typography_field['text-transform'] ) . ';';
			}

			if( $typography_field['font-size'] ) {
				$output .= 'font-size: ' . esc_attr( $typography_field['font-size'] ) . ';';
			}

			if( $typography_field['letter-spacing'] ) {
				$output .= 'letter-spacing: ' . esc_attr( $typography_field['letter-spacing'] ) . ';';
			}

			if( $typography_field['color'] ) {
				$output .= 'color: ' . esc_attr( $typography_field['color'] ) . ';';
			}

			$output .= '}'; // End

		}

		return $output;

	}
}
