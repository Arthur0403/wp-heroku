<?php
/*
 * Resize images dynamically using wp built in functions
 * Original function by Victor Teixeira
 * Updated by Joel Lisenby
 * Modified by Filip Jaszczuk (Veented)
 *
 */
 
if ( !function_exists( 'engage_img_resize') ) {
	function engage_img_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false, $proper_url = null, $removal = false ) {
		
		if ( $attach_id ) {
			$img_url = get_attached_file( $attach_id );
		}
		
		$old_img_info = pathinfo( $img_url );
		$old_img_ext = '.'. $old_img_info['extension'];
		$old_img_path = $old_img_info['dirname'] .'/'. $old_img_info['filename'];
		
		$new_img_dir = str_replace( ABSPATH, '/', $old_img_info['dirname'] );
		$new_img_path = $old_img_path .'-'. $width .'x'. $height . $old_img_ext;
		
		$img_exists = str_replace( '.jpg', '-' . $width . 'x' . $height . '.jpg', $img_url );
		$img_exists = str_replace( '.png', '-' . $width . 'x' . $height . '.png', $img_exists );
        $img_exists = str_replace( '.gif', '-' . $width . 'x' . $height . '.gif', $img_exists );

		if ( file_exists( $img_exists ) ) {
			$new_img_url = str_replace( '/wp-content', content_url(), $new_img_dir ) . '/' . $old_img_info['filename'] .'-'. $width .'x'. $height . $old_img_ext;
			return array( 'url' => $new_img_url ); // No need to resize twice, read from cache
		}
		
		$new_img = wp_get_image_editor( $img_url );

		if ( ! is_wp_error( $new_img ) ) {

            $new_img->resize( $width, $height, $crop );
            $new_img = $new_img->save( $new_img_path );

            $new_final_url = $new_img_dir . '/' . $new_img['file'];

            if ( $proper_url == true ) {
                $new_final_url = str_replace( '/wp-content', content_url(), $new_img_dir ) . '/' . $new_img['file'];
            }

            $vt_image = array (
                'file' => $new_img['file'],
                'url' => $new_final_url,
                'width' => $new_img['width'],
                'height' => $new_img['height'],
                'mime_type' => $new_img['mime-type']
            );
        } else {
            return array( 'url' => $img_url );
        }

		return $vt_image;
		
	}
}

if ( !function_exists( 'engage_img_width_correct' ) ) {
	function engage_img_size_correct( $img_url, $width, $height = null ) {
		list( $actual_width, $actual_height ) = getimagesize( $img_url );
		
		if ( is_numeric( $height ) && $actual_height > $height ) {
			return false;
		}
		
		if ( $actual_width > $width ) {
			return false;
		}
		
		return true;
	}
}

if ( !function_exists( 'engage_img_width_correct' ) ) {
	function engage_img_size_exists( $img_id, $img_size ) {
	
		$img_meta = wp_get_attachment_metadata( $img_id );
		
		if ( !is_array( $img_meta ) ) return false;

		if ( array_key_exists( 'sizes', $img_meta ) && is_array( $img_meta['sizes'] ) && array_key_exists( $img_size, $img_meta['sizes'] ) ) {

		    if ( $img_meta['sizes'][ $img_size ]['width'] == NULL ) {
                unset( $img_meta['sizes'][ $img_size ] );
                wp_update_attachment_metadata( $img_id, $img_meta );
		        return false;
            }

			return true;
			
		}
		
		return false;
	}
}

if ( !function_exists( 'engage_update_img_meta_size' ) ) {
	function engage_update_img_meta_size( $thumb_id, $img_size, $thumb ) {
		
		$img_meta = wp_get_attachment_metadata( $thumb_id );

		if ( array_key_exists( 'sizes', $img_meta ) && !array_key_exists( $img_size, $img_meta['sizes'] ) ) {

		    if ( isset( $thumb['file'] ) && isset( $thumb['width'] ) && isset( $thumb['height'] ) && isset( $thumb['mime_type'] ) )  {
                $img_meta['sizes'][ $img_size ] = array(
                    'file' => $thumb['file'],
                    'width' => $thumb['width'],
                    'height' => $thumb['height'],
                    'mime-type' => $thumb['mime_type']
                );
            }

		}
		
		wp_update_attachment_metadata( $thumb_id, $img_meta );
		
	}
}

if ( !function_exists( 'engage_get_thumb' ) ) {
	function engage_get_thumb( $thumb_id, $img_size ) {
		
		if ( !wp_attachment_is_image( $thumb_id ) ) return array( 'url' => '' );
		
		// Check if image has been resized to specific size
		// if not then crop the image on the fly
		
		if ( !engage_img_size_exists( $thumb_id, $img_size ) ) {
			list( $width, $height, $crop ) = engage_get_img_dim( $img_size );
			if ( $height == 0 ) $height = null;
			$thumb = engage_img_resize( $thumb_id, null, $width, $height, $crop, null );
			$thumb_url = $thumb[ 'url' ];
			
			// Check if wrong URL provided
			
			if ( substr( $thumb_url, 0, 11 ) === "/wp-content" ) {
				$thumb_url = str_replace( '/wp-content', content_url(), $thumb_url );
			}

			engage_update_img_meta_size( $thumb_id, $img_size, $thumb );
		} else {
			$img_url = wp_get_attachment_image_src( $thumb_id, $img_size );
			$thumb_url = $img_url[0];
		}

        //$img_meta = wp_get_attachment_metadata( $thumb_id );
		//$img_meta['sizes']['engage-sidebar-auto']['width'] = NULL;
        //$img_meta['sizes']['engage-sidebar-auto']['height'] = NULL;
		//unset( $img_meta['sizes']['engage-sidebar-auto'] );
        //wp_update_attachment_metadata( $thumb_id, $img_meta );

        //remove_image_size( $img_size );

		//echo '<pre>';
        //var_dump( wp_get_attachment_metadata( $thumb_id ) );
		//echo '</pre>';

		$thumb = array(
			'url' => $thumb_url
		);
		
		return $thumb;
		
	}
}

// Final Image


if ( !function_exists( 'engage_get_img_url' ) ) {
	function engage_get_img_url( $img, $img_size = false, $img_size_custom = false ) {
		
		// Image size
		
		if ( $img_size == 'square' ) {
			$img_size = 'engage-masonry-square';
		} elseif( $img_size == 'regular' ) {
			$img_size = 'engage-masonry-regular';
		}
		
		// Retrieve image
		
		if ( strpos( $img, 'http' ) !== false ) { // Mockup image hosted on our server
		
			$full_image_url = $image_url = $img;
			
			if ( $img_size != false && strpos( $img, 'amazon' ) === false ) {
				
				if ( strpos( $img_size, 'engage-' ) !== false ) { // predefined img size
					$img_size = engage_get_img_dim( $img_size );
					$img_size = $img_size[0] . 'x' . $img_size[1];
				} elseif ( $img_size == 'custom' && $img_size_custom != false ) {
					$img_size = $img_size_custom;
				}
				
				$image_url = str_replace( '.jpg', '-' . $img_size . '.jpg', $image_url );
				$image_url = str_replace( '.png', '-' . $img_size . '.png', $image_url );
				$image_url = str_replace( '.jpeg', '-' . $img_size . '.jpeg', $image_url );
			}
			
			return array(
				'url' => $image_url,
				'url-full' => $full_image_url
			);
			
		} else { // original attachment
		
			$width = $height = false;
			
			if ( -1 === preg_match( '~[0-9]~', $img_size ) ) {
				$img_size = engage_get_img_dim( $img_size );
				$width = $img_size[0];
				$height = $img_size[1];
			} elseif ( $img_size == 'custom' && $img_size_custom != false ) {
				$img_size = explode( 'x', $img_size_custom );
				if ( isset( $img_size[0] ) && isset( $img_size[1] ) ) {
					$width = $img_size[0];
					$height = $img_size[1];
				}
			}
			
			if ( $height != false ) { // Crop image
				$thumb = engage_img_resize( $img, null, $width, $height, true, true );
				$thumb_url = $thumb[ 'url' ];
			} else {
				$thumb = wp_get_attachment_image_src( $img, $img_size );
				$thumb_url = $thumb[0];
			}
			
			$img_full = wp_get_attachment_image_src( $img, 'full' );
			
			return array(
				'url' => $thumb_url,
				'url-full' => $img_full[0]
			);
			
		}
		
	}
}



if ( !function_exists( 'engage_get_img_dim' ) ) {
	function engage_get_img_dim( $img_size ) {
		$img_sizes = Engage_Theme::all_image_sizes();
		
		if ( array_key_exists( $img_size, $img_sizes ) ) {
			return array( $img_sizes[ $img_size ][ 'width' ], $img_sizes[ $img_size ][ 'height' ], $img_sizes[ $img_size ][ 'crop' ] );
		}
		
	}
}

// Background and column image size

if ( !function_exists( 'engage_section_bg_image' ) ) {
	function engage_section_bg_image( $css, $width, $attr = true ) {
		
		if ( !$css ) return '';
		
		preg_match( "#http?://\S+#i", $css, $matches );
		
		if ( is_array( $matches ) && isset( $matches[0] ) ) { // Found bg image
		
			$img_url = str_replace( ')', '', $matches[0] );
			
			if ( strpos( $img_url, 'veented.com' ) === false && strpos( $img_url, 'id=' ) !== false ) {
				$img_url_parts = explode( '=', $img_url );
				$img_id = $img_url_parts[1]; // Image ID
				
				$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $width ) );
				$thumbnail = $post_thumbnail[ 'thumbnail' ];
				
				$new_img_url = preg_match( "#http?://\S+#i", $thumbnail, $new_img_urls );
				
				if ( is_array( $new_img_urls ) ) {
					$inline_css = 'background-image:url(\'' . str_replace( '"', '', $new_img_urls[0] ) . '\')!important;';
					
					if ( $attr == true ) $inline_css = 'style="' . $inline_css . '"';
					return $inline_css;
				}
			}
			
		}
		
		return '';
		
	}
}