<?php

if ( !function_exists( 'engage_image_grid' ) ) {
	function engage_image_grid( $atts, $content = null ) {

		$content = $gallery_item_class = '';

	    extract( shortcode_atts( array(
    		"cols" => 3,
    		"cols_tablet" => 'default',
    		"cols_mobile" => 1,
    		"hover" => 'scale__icon',
    		"onclick" => 'image_lightbox',
    		"img_size" => 'square',
    		"img_size_custom" => '600x360',
    		"images" => '',
    		"gap" => '5',
    		"css" => '',
            "captions" => 'yes'
    	), $atts ) );

			// WPBakery Page Builder Check
		  if ( ! function_exists( 'vc_shortcode_custom_css_class' ) ) {
		    return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
		  }

    	if ( $images == '' ) return esc_html__( "No images selected.", "engage" );

    	// Tablet grid columns

    	if ( $cols_tablet == 'default' ) {

    		if ( $cols > 3 ) {
    			$cols_tablet = $cols-1;
    		} else {
    			$cols_tablet = $cols;
    		}

    	}

    	// Enqueue grid related scripts and styles

    	wp_enqueue_script( 'cube-portfolio' );
    	wp_enqueue_script( 'engage-grid' );
    	wp_enqueue_style( 'cube-portfolio' );

    	if ( $onclick == 'image_lightbox' ) {
    		wp_enqueue_script( 'magnific-popup', '', '', '', true );
    		$gallery_item_class = ' mp-gallery';
    	}

    	$grid_id = rand( 1,9999 );

    	$layout_class = $post_in = '';

    	// Gallery Container Classes

    	$container_classes = array();
    	$container_classes[] = 'grid-cols-' . $cols;

    	$hover_icon = false;

    	if ( strpos( $hover, '__' ) !== false) {
    		$hover = explode( '__', $hover );
    		$hover = $hover[0];
    		$hover_icon = true;
    		$container_classes[] = 'hover-effect-' . $hover . ' hover-icon';
    	} else {
    		$container_classes[] = 'hover-effect-' . $hover;
    	}

    	// Grid Data

    	$grid_options = array();

    	$grid_options[] = 'data-cols="' . $cols . '"';
    	$grid_options[] = 'data-cols-tablet="' . $cols_tablet . '"';
    	$grid_options[] = 'data-cols-mobile="' . $cols_mobile . '"';
    	$grid_options[] = 'item-gap="' . str_replace( 'px', '', $gap ) . '"';

    	// Image Size

    	if ( $img_size == 'square' ) {
    		$img_size = 'engage-masonry-square';
    	} elseif ( $img_size == 'regular' ) {
    		$img_size = 'engage-masonry-regular';
    	}

    	// Extra CSS

    	$el_css = vc_shortcode_custom_css_class( $css );

    	ob_start();

    	echo '<div class="vntd-image-gallery vntd-content-element ' . esc_attr( $el_css ) . '">';

    	echo '<div id="vntd-gallery-' . $grid_id . '" class="vntd-grid grid-items vntd-gallery-grid ' . esc_attr( implode( ' ', $container_classes ) ) . '" ' . implode( ' data-', $grid_options ) . '>';

	    $images = explode( ',', $images);
	    $i = -1;

		$gallery_items = '';

	    foreach ( $images as $attach_id ) {

	        $i++;

            $caption = false;

	        if ( strpos( $attach_id, 'http:' ) !== false ) { // Mockup image hosted on our server
	        	$img_size = '600x600';
	        	if ( $img_size == 'masonry' ) $img_size = '600x9999';
	        	$image_url = str_replace( '.jpg', '-' . $img_size . '.jpg', $attach_id );
	        	$image_url = str_replace( '.jpeg', '-' . $img_size . '.jpeg', $attach_id );
	        	$image_url = str_replace( '.png', '-' . $img_size . '.png', $image_url );
	        	$thumbnail = '<img class="vc_single_image-img" src="' . $image_url . '" />';
	        	$big_image = $attach_id;
	        } else { // original attachment

	        	if ( $img_size == 'custom' ) {
	        		$post_thumbnail = wpb_getImageBySize(array( 'attach_id' => $attach_id, 'thumb_size' => $img_size_custom ));
	        		$thumbnail = $post_thumbnail['thumbnail'];
	        	} else {
	        		if ( $img_size == 'masonry' ) {

	        			if ( class_exists( 'Engage_Demo' ) ) {
	        				$img_resize = engage_img_resize( $attach_id, null, 600, 9999, false );
	        			}

	        			$img = wp_get_attachment_image_src( $attach_id, 'engage-masonry-auto' );
	        			$thumbnail = '<img src="' . esc_url( $img[0] ) . '" alt>';

	        		} else {
	        			$post_thumbnail = wpb_getImageBySize(array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ));
	        			$thumbnail = $post_thumbnail['thumbnail'];
	        		}
	        	}

	        	$big_image = wp_get_attachment_image_src( $attach_id, 'full' );
	        	$big_image = $big_image[0];

                if ( $captions == 'yes' ) {

                    $image = get_post( $attach_id );

                    if ( is_object( $image ) && $image->post_excerpt != '' ) {
                       $caption = $image->post_excerpt;
                    }

                }

	        }

	        $link_start = $link_end = '';

	        if ( $onclick == 'image_lightbox' ) {

	            $link_start = '<a href="' . $big_image . '"';

                if ( $caption != false ) {
                    $link_start .= ' title="' . esc_html( $caption ) . '"';
                }

                $link_start .= '>';
	            $link_end = '</a>';

	            // Hover effect

	            if ( $hover != 'none' ) {

	            	$link_start .= '<div class="gallery-item-overlay">';

	            	if ( $hover_icon == true ) {
	            		$link_start .= '<i class="vntd-gallery-zoom-icon engage-icon-icon engage-icon-zoom-2"></i>';
	            	}

	            	$link_start .= '</div>';

	            }


	        }

	        // Gallery item output

	        $gallery_items .= '<div class="item grid-item cbp-item vntd-gallery-item' . $gallery_item_class . '">' . $link_start . $thumbnail . $link_end . '</div>';

	    }

	    echo $gallery_items; // End Loop

	    echo '</div></div>';

    	$content = ob_get_contents();
    	ob_end_clean();

    	return $content;

	}
	remove_shortcode( "vntd_image_grid" );
	add_shortcode( "vntd_image_grid", "engage_image_grid" );
}
