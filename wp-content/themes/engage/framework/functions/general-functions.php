<?php

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//
// 		General Theme Functions
//
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Wrapper Classes
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( !function_exists( "engage_wrapper_classes" ) ) {
	function engage_wrapper_classes() {

		$post_id = engage_get_id();

		$classes = array();

		if ( engage_option( 'footer_reveal' ) == true ) {
			$classes[] = 'footer-reveal';
		}

		// Header Style:

		$header_position = engage_option( 'header_position' );

		$classes[] = 'header-position-' . engage_header_position();

		if ( $header_position == 'left' || $header_position == 'right' ) { // Aside Header

			$classes[] = 'header-' . $header_position;
			$classes[] = 'aside-' . $header_position;

			$classes[] = 'header-aside-visible';
			$classes[] = 'aside-menu-open';

		} else { // Top Header

			$header_style = engage_header_style();
			$classes[] = 'header-style-' . $header_style;

			if ( $header_style != 'classic' ) {
				$classes[] = 'header-style-' . $header_style;
			} else {
				$classes[] = 'header-style-classic';
			}

			if ( $header_style == 'top-logo' || $header_style == 'top-logo-center' ) {
				$classes[] = 'header-bottom-nav';
			}

			// Header Color:

			$header_color = 'header-' . engage_option( 'header_color' );

			if ( $header_color != 'header-' ) $classes[] = $header_color;

			// Header Transparency

			if ( engage_header_transparent() == true ) {
				$classes[] = 'header-transparent';
			} else {
				$classes[] = 'header-opaque';
			}

			// Header Sticky

			if ( engage_option( 'header_sticky' ) == 'not-sticky' || engage_option( 'header_sticky' ) == 'sticky-appear' ) {
				$classes[] = 'site-header-' . engage_option( 'header_sticky' );
			} else {
				$classes[] = 'site-header-sticky';
			}

		}

        // FadeOut Page Transition Effect

        if ( engage_option( 'page_fadeout' ) == true ) {
            $classes[] = 'vntd-with-transition';
        }

		// Buttons

		if ( ( $value = engage_option( 'el_btn_border_radius' ) ) != '' ) {
			$classes[] = 'btn-radius-' . $value;
		}

		// Page Type

		if ( get_post_meta( get_the_ID(), 'page_type', true ) == 'onepager' ) {
			$classes[] = 'type-onepager';
			wp_enqueue_script( 'onepage-nav', get_template_directory_uri() . '/js/plugins/jquery.nav.js', array( 'jquery' ), '', true );
		}

		// Page Title

		if ( engage_pagetitle_enabled() == false ) {
			$classes[] = 'no-page-title';
		}

		// Theme Skin

		if ( engage_option( 'theme_skin' ) == 'dark' ) {
			$classes[] = 'skin-dark';
		} else {
			$classes[] = 'skin-light';
		}

		// Custom

		if ( get_post_meta( engage_get_id(), 'body_classes', true ) ) {
			$classes[] = esc_attr( get_post_meta( engage_get_id(), 'body_classes', true ) );
		}

		echo implode( ' ', $classes );

	}
}

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Image cropping functions
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( !function_exists( "engage_thumb" ) ) {
	function engage_thumb($w,$h = null){

		get_template_part( 'includes/aq_resizer' );

		global $post;
		$imgurl = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
		return $imgurl[0];
		return aq_resize( $imgurl[0], $w, $h, true );
	}
}

if ( !function_exists( "engage_crop" ) ) {
	function engage_crop( $id, $w, $h = null ){

		get_template_part( 'includes/aq_resizer' );

		$imgurl = wp_get_attachment_image_src($id, 'full' );

		$return = aq_resize($imgurl[0],$w,$h,true);

		if ( $return == null || $return == '' ) {
			$return = $imgurl;
		}

		return $return;

	}
}

if ( !function_exists( "engage_content_class" ) ) {
	function engage_content_class() {

		$post_id = get_the_ID();

		$return = $css_styles = '';
		$css_classes = $css_styles = array();

		$css_classes[] = "main-content";

		$header_style = 'style-default';
		if ( engage_header_style() ) $header_style = engage_header_style();

		$css_classes[] = 'header-' . $header_style;

		if (engage_option( 'topbar' ) && $header_style != 'style-boxed' && get_post_meta( get_the_ID(), 'page_header_topbar_c', true ) != 'no' || get_post_meta( get_the_ID(), 'page_header_topbar_c', true ) == 'yes' ) {
			$css_classes[] = 'page-with-topbar';
		}

		if ( engage_vc_active() ) {
			$css_classes[] = 'page-with-vc';
		} else {
			$css_classes[] = 'page-without-vc';
		}

		// Put Page Content below Title Area

		if ( engage_pagetitle_enabled() == false && engage_header_transparent() == false ) {

			$css_classes[] = 'content-below-header';

		}

		// Print Classes

		echo 'class="' . implode( " ", $css_classes ) . '"';

		// Print Inline CSS if necessary

		if ( !empty( $css_styles ) ) {
			echo 'style="' . esc_attr( implode( ' ', $css_styles ) ) . '"';
		}

	}
}




// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// 		Pagination
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


if ( !function_exists( 'engage_pagination' ) ) {
	function engage_pagination( $the_query = NULL ) {

		global $wp_query,$paged;

		$query = '';

		if ( !$the_query) {
			$query = $wp_query;
		} else {
			$query = $the_query;
		}

		$big = 999999999; // need an unlikely integer
	    $pages = paginate_links( array(
	            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	             'format' => ( ( get_option( 'permalink_structure' ) && ! $query->is_search ) || ( is_home() && get_option( 'show_on_front' ) !== 'page' && ! get_option( 'page_on_front' ) ) ) ? '?paged=%#%' : '&paged=%#%', // %#% will be replaced with page number
	            'current' => max( 1, get_query_var( 'paged' ) ),
	            'total' => $query->max_num_pages,
	            'prev_next' => false,
	            'type'  => 'array',
	            'prev_next'   => TRUE,
				'prev_text' => '<i class="fa fa-angle-left"></i>'.esc_html__( 'Prev', 'engage' ),
				'next_text' => esc_html__( 'Next', 'engage' ).'<i class="fa fa-angle-right"></i>'
	        ) );
	    if ( is_array( $pages ) ) {
	        $paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
	        echo '<div class="vntd-pagination-container posts-pagination"><ul class="vntd-pagination pagination">';
	        foreach ( $pages as $page ) {
	                echo "<li>".$page."</li>";
	        }
	       echo '</ul></div>';
	    }

	}
}

// Pretty Permalinks Fix for Custom Post Types

add_action( 'init', 'engage_custom_rewrite_basic' );
function engage_custom_rewrite_basic() {
    global $wp_post_types;
    foreach ($wp_post_types as $wp_post_type) {
        if ($wp_post_type->_builtin) continue;
        if ( !$wp_post_type->has_archive && isset($wp_post_type->rewrite) && isset($wp_post_type->rewrite['with_front']) && !$wp_post_type->rewrite['with_front']) {
            $slug = (isset($wp_post_type->rewrite['slug']) ? $wp_post_type->rewrite['slug'] : $wp_post_type->name);
            $page = engage_get_page_by_slug($slug);
            if ($page) add_rewrite_rule( '^' .$slug .'/page/([0-9]+)/?', 'index.php?page_id=' .$page->ID .'&paged=$matches[1]', 'top' );
        }
    }
}

function engage_get_page_by_slug($page_slug, $output = OBJECT, $post_type = 'page' ) {
    global $wpdb;

    $page = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type= %s AND post_status = 'publish'", esc_attr( $page_slug ), esc_attr( $post_type ) ) );

    return ($page ? get_post($page, $output) : NULL);
}

// Fix End

if ( !function_exists( 'engage_ajax_pagination' ) ) {
	function engage_ajax_pagination( $query = null, $name = null ) {

		global $wp_query;

		$script_name = 'engage-ajax-pagination';

		// Add code to index pages.

		wp_enqueue_script( 'engage-ajax-pagination' );

		if ( !$query) $query = $wp_query;

		// What page are we on? And what is the pages limit?

		$max = $query->max_num_pages;
		$paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;

		if ( $name == null ) $name = 'portfolio';

		// Add some parameters for the JS.

		wp_localize_script(
			$script_name,
			'pbd_alp_' . $name,
			array(
				'startPage' => $paged,
				'maxPages' => $max,
				'nextLink' => next_posts( $max, false ),
				'labelLoading' => esc_html__( 'Loadings posts..', 'engage' ),
				'labelLoadMore' => esc_html__( 'Load More', 'engage' ),
				'labelNoMore' => esc_html__( 'No more posts to load.', 'engage' )
			)
		);

	}
}

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Custom Excerpt Size
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

function engage_custom_excerpt_length( $length ) {
	return 50; // Increase maximum excerpt size
}
add_filter( 'excerpt_length', 'engage_custom_excerpt_length', 999 );


if ( !function_exists( 'engage_excerpt' ) ) {
	function engage_excerpt( $limit, $more = NULL ) {

		global $post;

		$excerpt = explode( ' ', get_the_excerpt( $post->ID ), $limit );;

		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$excerpt = implode( " ", $excerpt ) . '...';
		} else {
			$excerpt = implode( " ", $excerpt );
		}

		$excerpt = '<p>' . $excerpt . '</p>';
		$read_more_label = engage_translate( 'read-more' );

		if ( get_post_type( get_the_ID() ) == 'page' ) {
			$excerpt = '';
			$read_more_label = engage_translate( 'view-page' );
		}

        $final_link = false;

		if ( get_post_format( $post->ID ) == "link" ) {
            if ( get_post_meta( $post->ID, "format_link_url", TRUE ) ) {
                $final_link = get_post_meta( $post->ID, "format_link_url", TRUE );
            }
        }

        if ( $final_link != false ) {
			$excerpt .= '<a href="' . esc_url( $final_link ) . '" class="post-more">' . engage_translate( 'visit-site' ) . '</a>';
		}elseif ($more) {
			$excerpt .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="post-more">' . esc_html( $read_more_label ) . '</a>';
		}

		return $excerpt;
	}
}

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Post Gallery
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

function engage_post_gallery($type,$thumb_size) {

	global $post;

	$gallery_images = get_post_meta($post->ID, 'gallery_images', true);

	if ( !$gallery_images && has_post_thumbnail( ) ) { // No Gallery Images
		$url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $thumb_size);
		return '<img src="'.$url[0].'" alt="'.get_the_title($post->ID).'">';
	}

	echo '<div class="vntd-post-gallery vntd-post-gallery-'.$type.'">';

	if ($type == "slider") { // Slider Gallery

		wp_enqueue_script( 'vntd-flexslider', '', '', '', true);

		echo '<div class="flexslider vntd-flexslider"><ul class="slides">';

		$ids = explode( ",", $gallery_images);
		foreach($ids as $id){
			$image_url = wp_get_attachment_image_src($id, $thumb_size);
			echo '<li><img src="'.esc_url($image_url[0]).'" alt></li>';
		}

		echo '</ul></div>';

	} elseif ($type == "list" || $type == "list_lightbox") {

		$ids = explode( ",", $gallery_images);
		foreach($ids as $id){
			//global $post = $post=>$id;
			$image_url = wp_get_attachment_image_src($id, $thumb_size);
			$big_url = wp_get_attachment_image_src($id, 'fullwidth-auto' );
			echo '<div class="vntd-gallery-item">';
			if ($type == "list_lightbox") echo '<a href="'.esc_url($big_url[0]).'" class="hover-item" rel="gallery[gallery'.$post->ID.']" title="'.get_post($id)->post_excerpt.'"><span class="hover-overlay"></span><span class="hover-icon hover-icon-zoom"></span>';
			echo '<img src="'.esc_url($image_url[0]).'" alt>';
			if ($type == "list_lightbox") echo '</a>';
			echo '</div>';
		}

	} else {
		// If Lightbox Gallery
		echo '<div class="featured-image-holder"><div class="gallery clearfix">';

		$ids = explode( ",", $gallery_images);
		if ($gallery_images) $id = array_shift(array_values($ids));
		$image_url = wp_get_attachment_image_src($id, $thumb_size);
		$large_url = wp_get_attachment_image_src($id, 'large' );
		echo '<a class="hover-item" href="'.esc_url($large_url[0]).'" rel="gallery[gallery'.$post->ID.']"><img src="'.esc_url($image_url[0]).'"><span class="hover-overlay"></span><span class="hover-icon hover-icon-zoom"></span></a>';

			if ($gallery_images){

				echo '<div class="lightbox-hidden">';
				foreach(array_slice($ids,1) as $id){
					echo '<a href="'.wp_get_attachment_url($id).'" rel="gallery[gallery'. $post->ID .']"></a>';
				}
				echo '</div>';

			}

		echo '</div></div>';

	}

	echo '</div>';
}


if ( !function_exists( 'engage_gallery_metabox' ) ) {
	function engage_gallery_metabox($gallery_images) {

		$modal_update_href = esc_url( add_query_arg( array(
		     'page' => 'shiba_gallery',
		     '_wpnonce' => wp_create_nonce( 'shiba_gallery_options' ),
		 ), admin_url( 'upload.php' ) ) );
		 ?>

		 <div class="vntd-gallery-thumbs">
		 	<?php

	 		if ($gallery_images){

	 			$ids = explode( ",", $gallery_images);

	 			foreach($ids as $id){
	 				echo '<img src="'.wp_get_attachment_thumb_url($id).'" alt>';
	 			}

	 		}

		 	?>
		 </div>

		 <input type="text" class="hidden" id="gallery_images" name="gallery_images" value="<?php echo esc_textarea($gallery_images); ?>">
		 <?php if ($gallery_images) { $button_text = esc_html__( "Modify Gallery", 'engage' ); } else { $button_text = esc_html__( "Create Gallery", 'engage' ); } ?>
		 <a id="vntd-gallery-add" class="button" href="#"
		     data-update-link="<?php echo esc_attr( $modal_update_href ); ?>"
		     data-choose="<?php esc_html_e( 'Choose a Default Image', 'engage' ); ?>"
		     data-update="<?php esc_html_e( 'Set as default image', 'engage' ); ?>"><?php echo esc_textarea($button_text); ?>
		 </a>
		 <?php if ($gallery_images){ ?><span class="vntd-gallery-or">
		 <?php esc_html_e( 'or', 'engage' ) ?> </span><input type="button" id="vntd-gallery-remove" class="button" value="Remove Gallery">


		 <?php
		 }
		 // Add to the top of our data-update-link page
		 if (isset($_REQUEST['file'] ) ) {
		     check_admin_referer( "shiba_gallery_options");

		         // Process and save the image id
		     $options = get_option( 'shiba_gallery_options', TRUE);
		     $options['default_image'] = absint($_REQUEST['file']);
		     update_option( 'shiba_gallery_options', $options);

		}

	}
}

function engage_get_id() {

	global $post;

	$post_id = '';

	if ( is_object( $post ) ) {
		$post_id = $post->ID;
	}
	if ( is_home() || is_search() || is_archive() ) {
		$post_id = get_option( 'page_for_posts' );
	}

	if ( class_exists( 'Woocommerce' ) ) {
		if ( is_shop() && get_option( 'woocommerce_shop_page_id' ) ) {
			$post_id = get_option( 'woocommerce_shop_page_id' );
		}
	}

	return $post_id;
}

if ( !function_exists( 'engage_fonts' ) ) {
	function engage_fonts() {

		$font_body = 'Open Sans';
		$font_primary = 'Montserrat';
		$font_secondary = '';
		$font_weight = $nav_font_weight = '';

		// Read Font Families from Options Panel

		if (engage_option( "typography_body", "font-family") && engage_option( "typography_body", "font-family") != $font_body) {
			$font_body = engage_option( "typography_body", "font-family");
		}

		if (engage_option( "typography_primary", "font-family") && engage_option( "typography_primary", "font-family") != $font_primary) {
			$font_primary = engage_option( "typography_primary", "font-family");
		}

		if (engage_option( "typography_secondary", "font-family") && engage_option( "typography_secondary", "font-family") != $font_primary) {
			$font_secondary = engage_option( "typography_secondary", "font-family");
		}

		$std_fonts = array(
				"Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
				"'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
				"'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
				"'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
				"Courier, monospace"                                   => "Courier, monospace",
				"Garamond, serif"                                      => "Garamond, serif",
				"Georgia, serif"                                       => "Georgia, serif",
				"Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
				"'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
				"'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
				"'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
				"'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
				"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
				"Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
				"'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
				"'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
				"Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
		);

		// Heading font weight

		$font_primary_weight = ':400,700'; // Each weight is required at some point

		if ( in_array( $font_primary, $std_fonts ) ) {
			$font_primary = false;
		} else if ( $font_primary == 'Georgia, serif' ) {
			$font_primary = 'Georgia';
		}

		if ( in_array( $font_body, $std_fonts ) ) {
			$font_body = false;
		} else if ( $font_body == 'Georgia, serif' ) {
			$font_body = 'Georgia';
		}

		if ( in_array( $font_secondary, $std_fonts ) ) {
			$font_secondary = false;
		}

		// Load Fonts

		if ( $font_primary != false ) {
			wp_enqueue_style( 'vntd-google-font-primary', '//fonts.googleapis.com/css?family=' . str_replace( ' ','+',$font_primary) . $font_primary_weight );
		}

		if ( $font_body != $font_primary && $font_body != false ) { // If same font is used, there is no point to load it twice

			// Body font weight

			$font_body_weight = ':300,400,700';

			if (engage_option( "typography_body", "font-weight") && engage_option( "typography_body", "font-weight") != '400' ) {
				$font_body_weight = ':'.engage_option( "typography_body", "font-weight");
			}

			// Load body font

			wp_enqueue_style( 'vntd-google-font-body', '//fonts.googleapis.com/css?family='.str_replace( ' ','+',$font_body).$font_body_weight);
		}

		if ( $font_secondary != false && $font_secondary != '' && $font_secondary != $font_primary && $font_secondary != $font_body ) { // If same font is used, there is no point to load it twice

			// Body font weight

			$font_secondary_weight = ':100,300,400';

			// Load body font

			wp_enqueue_style( 'vntd-google-font-secondary', '//fonts.googleapis.com/css?family='.str_replace( ' ','+',$font_secondary).$font_secondary_weight);
		}

	}
	add_action( 'wp_enqueue_scripts', 'engage_fonts' );
	add_action( 'admin_enqueue_scripts', 'engage_fonts' );
}

if ( !function_exists( 'engage_enqueue_font' ) ) {
	function engage_enqueue_font( $font ) {

		if ( $font == 'additional' && engage_option( "typography_additional", "font-family" ) ) {

			$font_weight = '';

			if ( ( $font_weight = engage_option( "typography_additional", "font-weight" ) ) ) {
				$font_weight = ':' . $font_weight;
			}

			wp_enqueue_style( 'vntd-google-font-additional', '//fonts.googleapis.com/css?family='. str_replace( ' ', '+', engage_option( "typography_additional", "font-family") ) . $font_weight );
		}
	}
}

if ( !function_exists( 'engage_get_primary_font' ) ) {
	function engage_get_primary_font() {

		$font_primary = 'Raleway';

		if (engage_option( "typography_primary", "font-family") && engage_option( "typography_primary", "font-family") != $font_primary) {
			$font_primary = engage_option( "typography_primary", "font-family");
		}

		return $font_primary;
	}
}

if ( !function_exists( 'engage_print_social_icons' ) ) {
	function engage_print_social_icons( $style = null, $border = null ) {

		$target = '';

		if ( !$style ) $style = 'classic';
		if ( !$border ) $border = 'regular';

		$icon_style = 'fa fa-';

		$social_icons = engage_option( "social_profiles" );

		if ( !$social_icons ) {

			$social_icons = array(
				"facebook" 	=> "You have no icons",
				"twitter" 	=> "You have no icons",
				"dropbox" 	=> "You have no icons",
				"vimeo" 	=> "You have no icons",
				"dribbble" 	=> "You have no icons"
			);

		}

		if ( $social_icons ) {

			echo '<div class="vntd-social-icons social-icons-' . esc_attr( $style ) . ' social-icons-' . esc_attr( $border ) . ' social-icons-regular">';

			$target = ' target="_blank"';

//			foreach( $social_icons as $social_icon => $value ) {
//
//				if ( $value != "" ) {
//					echo '<a class="social social-' . strtolower( $social_icon ) . ' icon-' . strtolower( $social_icon ) . '" href="' . esc_url( $value ) . '"' . $target . '><i class="' . $icon_style . strtolower( $social_icon ) . '"></i></a>';
//				}
//
//			}
			foreach( $social_icons as $social_icon ) {

				if ( $social_icon['enabled'] == true ) {
				    if ( $social_icon == 'telegram' ) {
				        $icon_url = $social_icon['url'];
                    } else {
                        $icon_url = esc_url( $social_icon['url'] );
                    }
					echo '<a class="social social-' . esc_attr( $social_icon['id'] ) . ' icon-' . esc_attr( $social_icon['id'] ) . '" href="' . $icon_url . '"' . $target . '><i class="fa ' . esc_attr( $social_icon['icon'] ) . '"></i></a>';
				}

			}

			echo '</div>';
		}
	}
}

function engage_vc_active() { // Function to check if Visual Composer is enabled on a specific page.

	global $post;

	$found = false;

	if (is_object($post ) ) {
		$post_to_check = get_post($post->ID);
	} else {
		return $found;
	}


	// check the post content for the short code
	if ( stripos($post_to_check->post_content, '[vc_row' ) !== false ) {
	    // we have found the short code
	    $found = true;
	}

	if (is_home( ) ) {
		$found = false;
	}

	// return our final results
	return $found;

}

// Importer


if ( !function_exists( 'engage_create_dropdown' ) ) {
	function engage_create_dropdown($name,$elements,$current_value,$folds = NULL) {

		$folds_class = $selected = '';
		if ($folds) $folds_class = ' folds';
		echo '<select name="'.$name.'" class="select'.$folds_class.'">';

		if (engage_isAssoc($elements ) ) {

			foreach($elements as $title => $key) {

				if ($key == $current_value) $selected = 'selected';

				echo '<option value="'.$key.'"'.$selected.'>'.$title.'</option>';

				$selected = '';
			}

		} else {

			foreach($elements as $key) {

				if ($key == $current_value) $selected = 'selected';

				echo '<option value="'.$key.'"'.$selected.'>'.$key.'</option>';

				$selected = '';
			}

		}

		echo '</select>';

	}
}

if ( !function_exists( 'engage_pages_dropdown' ) ) {
	function engage_pages_dropdown($name,$current_value) {
		echo '<select name="'.$name.'" class="select">';
			echo '<option>Select page:</option>';
			$pages = get_pages();
			$selected = '';
			foreach ( $pages as $page ) {
				if ($page->ID == $current_value) { $selected = 'selected="selected"'; }
				echo '<option value="'.$page->ID.'" '.$selected.'>'.esc_textarea($page->post_title).'</option>';
				$selected = '';
			}

		echo '</select>';
	}
}

if ( !function_exists( 'engage_isAssoc' ) ) {
	function engage_isAssoc($arr)
	{
	    return array_keys($arr) !== range(0, count($arr) - 1);
	}
}

if ( !function_exists( 'engage_string_between' ) ) {
	function engage_string_between($string, $start, $end){
	    $string = ' ' . $string;
	    $ini = strpos($string, $start);
	    if ($ini == 0) return '';
	    $ini += strlen($start);
	    $len = strpos($string, $end, $ini) - $ini;
	    return substr($string, $ini, $len);
	}
}

if ( !function_exists( 'engage_query_pagination' ) ) {
	function engage_query_pagination() {

		$paged = '';

		if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
		elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
		else { $paged = 1; }

		return $paged;

	}
}

if ( !function_exists( 'engage_column_items' ) ) {

	function engage_column_items($cols) {

		$return = 'three-items';

		if ($cols == 1) {
			$return = 'one-item';
		} elseif ($cols == 2) {
			$return = 'two-items';
		} elseif ($cols == 4) {
			$return = 'four-items';
		} elseif ($cols == 5) {
			$return = 'five-items';
		} elseif ($cols == 6) {
			$return = 'six-items';
		}

		return $return;

	}

}

if ( !function_exists( 'engage_page_content_styles' ) ) {

	function engage_page_content_styles() {

		return null;
		if ( engage_pagetitle_enabled() == false ) return null;
		$post_id = get_the_ID();

		$css_classes = $css_styles = array();

		// Page Content Top and Bottom Padding

		$padding_meta = get_post_meta( get_the_ID(), 'page_content_padding', true );

		if ( $padding_meta && array_key_exists( 'padding-top', $padding_meta ) && $padding_meta[ 'padding-top' ] != '' ) {
			$padding = $padding_meta;
		} elseif( engage_option( 'p_content_padding' ) ) {
			$padding = engage_option( 'p_content_padding' );
		}

		if ( $padding != '' ) {

			$page_content_padding = $padding;

			// Padding Top

			if ( $page_content_padding['padding-top'] != '' ) {
				$css_styles[] = 'padding-top:' . str_replace( 'px', '', $page_content_padding['padding-top'] ) . 'px;';
			}

			// Padding Bottom

			if ( $page_content_padding['padding-bottom'] != '' ) {
				$css_styles[] = 'padding-bottom:' . str_replace( 'px', '', $page_content_padding['padding-bottom'] ) . 'px;';
			}

		}

		// Print inline CSS if necessary

		if ( !empty( $css_styles ) ) {
			echo 'style="' . esc_attr( implode( '', $css_styles ) ) . '"';
		}

	}

}

if ( !function_exists( 'engage_hex2rgba' ) ) {
	function engage_hex2rgba($color, $opacity = false) {

		$default = 'rgb(0,0,0)';

		//Return default if no color provided
		if (empty($color))
	          return $default;

		//Sanitize $color if "#" is provided
	        if ($color[0] == '#' ) {
	        	$color = substr( $color, 1 );
	        }

	        //Check if color has 6 or 3 characters and get values
	        if (strlen($color) == 6) {
	                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	        } elseif ( strlen( $color ) == 3 ) {
	                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	        } else {
	                return $default;
	        }

	        //Convert hexadec to rgb
	        $rgb =  array_map( 'hexdec', $hex);

	        //Check if opacity is set(rgba or rgb)
	        if ( $opacity || $opacity == 0 ) {
	        	if (abs($opacity) > 1)
	        		$opacity = 1.0;
	        	$output = 'rgba( '.implode( ",",$rgb).','.$opacity.' )';
	        } else {
	        	$output = 'rgb( '.implode( ",",$rgb).' )';
	        }

	        //Return rgb(a) color string
	        return $output;
	}
}

if ( !function_exists( 'engage_container_class' ) ) {
	function engage_container_class( $page_width = null ) {

		$container_class = ''; // $container_class = 'container';
		if ( !$page_width ) $page_width = engage_page_width();
		if ( !class_exists( 'Engage_Core' ) ) return '';
		if ( $page_width == "stretch_no_padding" ) {
			$container_class = '-fluid'; // $container_class = 'container-fluid'; - no padding
		} elseif ( $page_width == 'stretch' ) {
			$container_class = '-large'; // $container_class = 'container-large'; - with padding
		} elseif ( $page_width == 'narrow' ) {
			$container_class = '-narrow';
		}

		return $container_class;

	}
}

//

if ( !function_exists( 'engage_print_plain_terms' ) ) {
	function engage_print_plain_terms( $taxonomy = null ) {

		if ( !$taxonomy ) return false;

		$terms = wp_get_object_terms( get_the_ID(), $taxonomy );

//		$terms = get_terms( $taxonomy, array(
//		    'hide_empty' => false,
//		));

		if ( !empty( $terms ) ) {
			foreach( $terms as $term ) {
				echo esc_html( $term->name );

				if ( $term === end( $terms ) ) {} else {
					echo ', ';
				}
			}
		}

		return false;

	}
}

// Engage Social Profiles

if ( !function_exists( 'engage_social_profiles' ) ) {
	function engage_social_profiles( $duplicate = true, $size = null, $border = null ) {

		$social_profiles = engage_option( 'social_profiles' );

		if ( !empty( $social_profiles ) && is_array( $social_profiles ) ) {

			$classes = '';

			if ( $size == null && $border == null ) {
				$classes = 'social-icons-circle social-icons-small';
			}

			if ( $size ) {
				$classes .= ' social-icons-' . $size;
			}

			if ( $border ) {
				$classes .= ' social-icons-' . $border;
			}

			$extra_class = '';

			if ( $duplicate == true ) {
				$extra_class = ' icon-hover-slideup';
				$classes .= ' social-icons-effect-slideup';
			}

			echo '<div class="vntd-social-icons social-icons ' . esc_attr( $classes ) . '">';

			foreach ( $social_profiles as $social_profile ) {
				if ( $social_profile['enabled'] == true ) {
					$duplicated = '';
					if ( $duplicate == true ) {
						$duplicated = '<i class="fa ' . esc_attr( $social_profile['icon'] ) . ' icon-secondary"></i>';
					}
					echo '<a href="' . esc_url( $social_profile['url'] ) . '" class="social icon-' . esc_attr( $social_profile['id'] ) . $extra_class . '" target="_blank"><i class="fa ' . esc_attr( $social_profile['icon'] ) . ' icon-primary"></i>' . $duplicated. '</a>';
				}
			}

			echo '</div>';

		}

	}
}

// Engage Member Social Profiles

if ( !function_exists( 'engage_member_social_profiles' ) ) {
	function engage_member_social_profiles( $style = null ) {

		$social_profiles = get_post_meta( get_the_ID(), 'member_social_profiles', true );

		if ( is_array( $social_profiles ) && !empty( $social_profiles ) ) {

			$extra_classes = '';

			if ( $style == 'outline' ) {
				$extra_classes .= ' social-icons-outline';
			}

			echo '<div class="vntd-social-icons social-icons social-icons-circle' . esc_attr( $extra_classes ) . '">';

			foreach ( $social_profiles as $social_profile ) {
				if ( $social_profile['enabled'] == true ) {
					echo '<a href="' . esc_url( $social_profile['url'] ) . '" class="icon-' . esc_attr( $social_profile['id'] ) . '" target="_blank"><i class="fa ' . esc_attr( $social_profile['icon'] ) . ' icon-primary"></i></a>';
				}
			}

			echo '</div>';

		}

	}
}

if ( !function_exists( 'engage_person_social_profiles' ) ) {
	function engage_social_sites() {
		$social_sites = array(
			'twitter' => 'Twitter',
			'facebook' => 'Facebook',
			'linkedin' => 'LinkedIn',
			'behance' => 'Behance',
			'codepen' => 'Codepen',
			'bitbucket' => 'Bitbucket',
			'deviantart' => 'Deviant Art',
			'digg' => 'Digg',
			'dribbble' => 'Dribbble',
			'dropbox' => 'Dropbox',
			'email' => 'Email',
			'flickr' => 'Flickr',
			'git' => 'Git',
			'github' => 'Github',
			'google' => 'Google',
			'google-plus' => 'Google Plus',
			'instagram' => 'Instagram',
			'pinterest' => 'Pinterest',
			'quora' => 'Quora',
			'reddit' => 'Reddit',
			'skype' => 'Skype',
			'snapchat' => 'Snapchat',
			'soundcloud' => 'Soundcloud',
			'stack-exchange' => 'Stack Exchange',
			'stack-overflow' => 'Stack Overflow',
			'spotify' => 'Spotify',
			'steam' => 'Steam',
			'tripadvisor' => 'Trip Advisor',
			'tumblr' => 'Tumblr',
			'twitch' => 'Twitch',
			'vimeo' => 'Vimeo',
			'whatsapp' => 'Whatsapp',
			'yelp' => 'Yelp',
			'youtube' => 'YouTube'
		);

		return $social_sites;
	}
}

// Engage Page Layout

if ( !function_exists( 'engage_page_layout' ) ) {
	function engage_page_layout( $page_id = null ) {

		$layout = 'no_sidebar';

		if ( !class_exists( 'Engage_Core' ) ) return 'sidebar_right';
		if ( !$page_id ) $page_id = get_the_ID();

		$meta_value = get_post_meta( $page_id, 'page__layout', true );

		if ( $meta_value != '' && $meta_value != 'default' ) {
			$page_layout = $meta_value;
		} elseif ( is_single() && get_post_type( $page_id ) == 'post' ) {
			$page_layout = engage_option( 'blog_post_layout' );
		} elseif ( is_home() || is_archive() || is_search() ) {
			$layout = 'sidebar_right';
			$page_layout = engage_option( 'blog_page_layout' );
		} else {
			$page_layout = engage_option( 'page_layout' );
		}

		if ( class_exists( 'Woocommerce' ) ) {

			if ( is_shop() && ( $value = get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'page__layout', true ) ) ) {
				$page_layout = $value;
			}
		}

        if ( is_search() && engage_option( 'search_layout' ) ) {
            $layout = engage_option( 'search_layout' );
            if ( $layout == 'fullwidth' ) $layout = 'no_sidebar';
            $page_layout = $layout;
        }

		if ( $page_layout == 'no_sidebar' ) {
			$layout = 'no_sidebar';
		} elseif ( $page_layout == 'sidebar_right' ) {
			$layout = 'sidebar_right';
		} elseif ( $page_layout == 'sidebar_left' ) {
			$layout = 'sidebar_left';
		} elseif ( $page_layout == 'sidebar_both' ) {
			$layout = 'sidebar_both';
		}

		return $layout;

	}
}

// Engage General Layout

if ( !function_exists( 'engage_general_layout' ) ) {
	function engage_general_layout( $layout = null ) {

		$general_layout = 'no-sidebar';

		if ( !$layout ) $layout = 'no_sidebar';

		if ( $layout == 'sidebar_right' || $layout == 'sidebar_left' ) {

			$general_layout = 'one-sidebar';

		} elseif ( $layout == 'sidebar_both' || $layout == 'sidebar_both_left' ) {

			$general_layout = 'two-sidebars';

		}

		return 'page-layout-' . $general_layout;

	}
}

// Engage Page Content Width

if ( !function_exists( 'engage_page_width' ) ) {
	function engage_page_width( $page_id = null ) {

		$page_width = 'normal';

		if ( !$page_id ) $page_id = get_the_ID();

		$meta_value = get_post_meta( $page_id, 'page__width', true );

		if ( $meta_value != '' && $meta_value != 'default' ) {
			$width = $meta_value;
		} elseif ( is_single() && get_post_type( $page_id ) == 'post' ) {
			$page_width = 'narrow';
			$width = engage_option( 'blog_post_width' );
		} else {
			$width = engage_option( 'page_width' );
		}

		if ( $width == 'stretch' ) {
			$page_width = 'stretch';
		} elseif ( $width == 'stretch_no_padding' ) {
			$page_width = 'stretch_no_padding';
		} elseif ( $width == 'narrow' ) {
			$page_width = 'narrow';
		} elseif ( $width == 'normal' ) {
			$page_width = 'normal';
		}

		return $page_width;

	}
}

// Engage Sidebar Width

if ( !function_exists( 'engage_sidebar_width' ) ) {
	function engage_sidebar_width( $page_id = null ) {

		//$sidebar_width = '33';

		$sidebar_width = 'default';

		if ( !$page_id ) $page_id = get_the_ID();

		$meta_value = get_post_meta( $page_id, 'sidebar__width', true );

		if ( $meta_value != '' && $meta_value != 'default' ) {
			$width = $meta_value;
		} else {
			$width = engage_option( 'sidebar_width' );
		}

		if ( $width == '25' ) {
			$sidebar_width = '25';
		} elseif ( $width == '33' ) {
			$sidebar_width = '33';
		}

		return $sidebar_width;

	}
}

// Body Styles

if ( !function_exists( 'engage_body_styles' ) ) {
	function engage_body_styles() {

		$inline_css = array();

		if ( ( $value = get_post_meta( engage_get_id(), 'bg__color', true ) ) ) {
			$inline_css[] = 'background-color: ' . esc_attr( $value ) . ';';
		}

		if ( !empty( $inline_css ) ) {
			echo 'style="' . implode( '', $inline_css ) . '"';
		}

		return null;

	}
}

if ( !function_exists( 'engage_general_styles' ) ) {
	function engage_general_styles() {
		if ( ( $value = get_post_meta( engage_get_id(), 'bg__color', true ) ) ) {
			$custom_css = 'body,.section-page,.vc_row:not(.vc_inner){background-color: ' . esc_attr( $value ) . ';}';
			wp_add_inline_style( 'engage-styles', $custom_css );
		}
	}
	add_action( 'wp_enqueue_scripts', 'engage_general_styles' );
}

if ( !function_exists( 'engage_css_gradient' ) ) {
	function engage_css_gradient( $color_start, $color_end, $angle = -32, $full = true ) {

		$return = 'linear-gradient( ' . str_replace( 'deg', '', $angle ) . 'deg,' . esc_attr( $color_end ) . ',' . esc_attr( $color_start ) . ' )';

		if ( $full == true ) {
			return 'background:' . $color_start . ';background:' . $return . ';';
		}

		return $return;
	}
}

if ( !function_exists( 'engage_page_loader' ) ) {
	function engage_page_loader() {
		echo '<div class="loader-wrapper">
		  <div class="loader-circle"></div>
		</div>';
	}
}

if ( !function_exists( 'engage_contact_config' ) ) {
	function engage_contact_config() {
		return array(
		    'subject' => array(
		        'prefix' => '[Contact Form]'
		    ),
		    'emails' => array(
		        'to'   => 'prafgon@gmail.com',
		        'from' => 'prafgon@gmail.com'
		    ),
		    'messages' => array(
		        'error'   => 'There was an error sending, please try again later.',
		        'success' => 'Your message has been sent successfully.',
		        'validation' => array(
		            'emptyname'    => 'Name is required.',
		            'emptyemail'   => 'Email is invalid.',
		            'emptysubject' => 'Subject is required.',
		            'emptymessage' => 'Message is required.'
		        )
		    ),
		    'fields' => array(
		        'name'     => esc_html__( 'Name', 'engage' ),
		        'email'    => esc_html__( 'Email', 'engage' ),
		        'phone'    => esc_html__( 'Phone', 'engage' ),
		        'subject'  => esc_html__( 'Subject', 'engage' ),
		        'message'  => esc_html__( 'Message', 'engage' ),
		        'btn-send' => esc_html__( 'Send', 'engage' )
		    )
		);
	}
}

if ( !function_exists( 'engage_get_contact_email' ) ) {
	function engage_get_contact_email() {

		$contact_email = engage_option( 'contact_email' );

		if ( $contact_email == '' ) return false;

		$contact_email = str_replace( '@', '__xyzx__', $contact_email );

		return $contact_email;
	}
}

if ( !function_exists( 'engage_page_title_parallax' ) ) {
	function engage_page_title_parallax() {

		wp_enqueue_script( 'skrollr', '', '', '', true );

	}
}

// If Events Calendar plugin enabled

if ( class_exists( 'Tribe__Events__Main' ) ) {

  	if ( !function_exists( 'engage_ec_widget_featured_image' ) ) {
	  	function engage_ec_widget_featured_image() {
	  		global $post;
	  		echo tribe_event_featured_image( $post->ID, 'thumbnail' );
	  	}
	  	add_action( 'tribe_events_list_widget_before_the_event_title', 'engage_ec_widget_featured_image' );
	}

}

if ( !function_exists( 'engage_form_success_msg' ) ) {
    function engage_form_success_msg() {

        $msg = esc_html__( 'Your message has been sent successfully.', 'engage' );

        if ( engage_option( 'cf_success_msg' ) != '' ) {
            $msg = engage_option( 'cf_success_msg' );
        }

        return $msg;

    }
}

// Allowed HTML tags inside wp_kses() function
if ( !function_exists( 'engage_kses' ) ) {
	function engage_kses() {

		$allowed_tags = array(
			'a' => array(
				'href' => array(),
				'alt' => array(),
				'text' => array(),
        'class' => array(),
        'target' => array()
			),
			'p' => array(
				'class' => array()
			),
			'br' => array(),
			'span' => array(
				'class' => array(),
			),
			'span' => array(
				'class' => array()
      ),
			'i' => array(
				'class' => array()
      ),
			'strong' => array(),
      'br' => array(),
			'img' => array(
				'src' => array(),
				'title' => array(),
				'alt' => array(),
				'srcset' => array(),
				'target' => array()
			)
		);

		return apply_filters( 'engage_allowed_html_tags', $allowed_tags );

	}
}

// Placeholder Theme Options panel - displayed until the theme's Core plugin is active
if ( ! function_exists( 'engage_load_redux' ) ) {

	// Theme Options Placeholder
	if ( ! function_exists( 'engage_theme_options_placeholder' ) ) {

		function engage_theme_options_placeholder() {

			add_menu_page(
				esc_html__( 'Theme Options', 'engage' ),
				esc_html__( 'Theme Options', 'engage' ),
				'manage_options',
				'engage-options',
				'engage_theme_options_placeholder_content',
				'dashicons-admin-generic',
				3
	  	);

		}

		add_action( 'admin_menu', 'engage_theme_options_placeholder' );

		function engage_theme_options_placeholder_content() { ?>
			<div class="vntd-theme-options-notice notice notice-error">
				 <?php

				 $suffix_msg = '';

				 if ( class_exists( 'Engage_Core' ) ) { // An outdated version is installed
					 $msg = esc_html__( 'To activate the Theme Options panel, please update the Engage Core plugin to the latest version via', 'engage' );
					 $suffix_msg = ' ' . esc_html__( 'Your options are NOT lost.', 'engage' );
				 } else {
					 $msg = esc_html__( 'To activate the Theme Options panel, please install and activate the Engage Core plugin via', 'engage' );
				 }

				 ?>
	       <strong><p><?php echo esc_html( $msg ) . ' <a href="' . esc_url( admin_url( 'themes.php?page=install-required-plugins' ) ) . '">' . esc_html__( 'Appearance / Install Plugins', 'engage' ) . '</a>.' . esc_html( $suffix_msg ); ?></p></strong>
	    </div>
			<?php
		}
	}

	//
	// Admin upgrade notice
	//

	if ( ! function_exists( 'engage_upgrade_admin_notice' ) ) {
		function engage_upgrade_admin_notice() {
			if ( class_exists( 'Engage_Core' ) ) {
				// Check if the notice was already dismissed
				if ( get_option( 'engage_upgrade_notice_dismiss' ) == 'dismissed' ) return;
		    ?>
		    <div class="vntd-upgrade-notice notice notice-warning is-dismissible">
		       <strong><?php echo '<p>' . esc_html__( "This is a big theme update. Please update the Engage Core plugin to the latest version via", 'engage' ) . ' <a href="' . esc_url( admin_url( 'themes.php?page=install-required-plugins' ) ) .'">' . esc_html__( 'Appearance / Install Plugins', 'engage' ) . '</a>.</p><p><a href="' . esc_url( add_query_arg( 'engage-upgrade-notice-dismiss', 'true' ) ) .'">' . esc_html__( 'Dismiss this notice', 'engage' ) . '</a></p>'; ?></strong>
		    </div>
		    <?php
			}
		}
		add_action( 'admin_notices', 'engage_upgrade_admin_notice' );
	}

	// Dismiss the notice
	if ( ! function_exists( 'engage_upgrade_notice_dismiss' ) ) {
		function engage_upgrade_notice_dismiss() {
	    if ( isset( $_GET['engage-upgrade-notice-dismiss'] ) ) {
				add_option( 'engage_upgrade_notice_dismiss', 'dismissed' );
			}
		}
		add_action( 'admin_init', 'engage_upgrade_notice_dismiss' );
	}

}

// Engage Core update notice

if ( class_exists( 'Engage_Core' ) && ! function_exists( 'engage_metaboxes_blog' ) ) {

	if ( ! function_exists( 'engage_core_update_notice' ) ) {
		function engage_core_update_notice() {
			if ( class_exists( 'Engage_Core' ) ) {
				// Check if the notice was already dismissed
				if ( get_option( 'engage_core_update_notice_dismiss' ) == 'dismissed' ) return;
		    ?>
		    <div class="vntd-upgrade-notice notice notice-warning is-dismissible">
		       <strong><?php echo '<p>' . esc_html__( "Important: Please update the Engage Core plugin to the latest version via", 'engage' ) . ' <a href="' . esc_url( admin_url( 'themes.php?page=install-required-plugins' ) ) .'">' . esc_html__( 'Appearance / Install Plugins', 'engage' ) . '</a>.</p><p><a href="' . esc_url( add_query_arg( 'engage-core-update-notice-dismiss', 'true' ) ) .'">' . esc_html__( 'Dismiss this notice', 'engage' ) . '</a></p>'; ?></strong>
		    </div>
		    <?php
			}
		}
		add_action( 'admin_notices', 'engage_core_update_notice' );
	}

	// Dismiss the notice
	if ( ! function_exists( 'engage_core_update_notice_dismiss' ) ) {
		function engage_core_update_notice_dismiss() {
	    if ( isset( $_GET['engage-core-update-notice-dismiss'] ) ) {
				add_option( 'engage_core_update_notice_dismiss', 'dismissed' );
			}
		}
		add_action( 'admin_init', 'engage_core_update_notice_dismiss' );
	}

}
