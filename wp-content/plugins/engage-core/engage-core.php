<?php

	/*

	Plugin Name: 	Engage Core
	Plugin URI: 	http://themeforest.net/user/Veented
	Description: 	Core functionalities for Engage Theme.
	Version: 		3.2.8
	Author: 		Veented
	Author URI: 	http://themeforest.net/user/Veented
	License: 		GPL2

	*/

	// Redux Extensions

	$theme = wp_get_theme();

	if ( 'Engage' == $theme->name || 'Engage' == $theme->parent_theme ) {

			define( 'ENGAGE_CORE_PATH', dirname( __FILE__ ) );
			define( 'ENGAGE_CORE_URI' , plugin_dir_url( __FILE__ ) );

			// Theme Options Framework

			require_once( ENGAGE_CORE_PATH . '/theme-panel/theme-panel.php' );

	   	// Load Custom Post Types

	   	require_once( ENGAGE_CORE_PATH . '/custom-post-types/portfolio/portfolio-functions.php' ); 		// Portfolio Post Type
	   	require_once( ENGAGE_CORE_PATH . '/custom-post-types/team/team-functions.php' ); 					// Team Member Post Type
      require_once( ENGAGE_CORE_PATH . '/custom-post-types/testimonials/testimonials-functions.php' ); 	// Testimonial Post Type

			// Metaboxes

			require_once( ENGAGE_CORE_PATH . '/metaboxes/metaboxes-main.php' );
			require_once( ENGAGE_CORE_PATH . '/metaboxes/metaboxes-blog.php' );

			// Templates

			require_once( ENGAGE_CORE_PATH . '/templates/templates.php' );

	    // Demo Content

	    require_once( ENGAGE_CORE_PATH . '/admin/dashboard/theme-dashboard.php' );

	   	// Demo Content

	   	require_once( ENGAGE_CORE_PATH . '/demo-content/demo-main.php' );

	   	// Shortcodes

	   	require_once( ENGAGE_CORE_PATH . '/shortcodes/shortcodes-config.php' );

	   	// Engage Slider

	    require_once( ENGAGE_CORE_PATH . '/veented-slider/slider-config.php' );

	   	// Post Likes

	   	require_once( ENGAGE_CORE_PATH . '/post-likes/post-like.php' );

	    // Post Order

	    require_once( ENGAGE_CORE_PATH . '/plugins/custom-post-order/simple-custom-post-order.php' );

	    // Menu item meta fields

	    require_once( ENGAGE_CORE_PATH . '/plugins/nav-menu-custom-fields/nav-menu-custom-fields.php' );

   		// Functions and styles

   		function engage_core_scripts() {
   			wp_register_script( 'engage-contact', plugins_url( '/shortcodes/lib/contact-form/public/js/contact-form.js', __FILE__ ) );
   		}

   		add_action( 'wp_enqueue_scripts', 'engage_core_scripts' );

			// Widgets
			if ( ! function_exists( 'engage_core_widgets' ) ) {
				function engage_core_widgets() {
					require_once( ENGAGE_CORE_PATH . '/widgets/widgets.php');
				}
				engage_core_widgets();
			}

			// Translation
	    function engage_core_load_textdomain() {
	        load_plugin_textdomain( 'engage', FALSE, basename( dirname( __FILE__ ) ) . '/lang' );
	    }
	    add_action( 'plugins_loaded', 'engage_core_load_textdomain' );

	   	// Engage Core Class

	   	class Engage_Core {

	   		public static function color_array( $custom = false ) {

	   			$color_array = array(
	   				'white' => esc_html__( 'White', 'engage' ),
	   				'accent' => esc_html__( 'Accent', 'engage' ),
	   				'dark' => esc_html__( 'Dark', 'engage' ),
	   			);

	   			if( $custom == true ) {
	   				$color_array['custom'] = esc_html__( 'Custom', 'engage' );
	   			}

	   			return $color_array;

	   		}

	   		public static function hover_color_array() {

				$color_array = array(
					'white' => esc_html__( 'White', 'engage' ),
					'dark' => esc_html__( 'Dark', 'engage' ),
					'accent' => esc_html__( 'Accent', 'engage' ),
				);

				return $color_array;

			}

			public static function social_icons( $email = true ) {

				$social_icons_array = array(
					'facebook' => 'facebook',
					'twitter' => 'twitter',
					'google-plus' => 'google',
					'pinterest' => 'pinterest-o'
				);

				return $social_icons_array;

			}

			public static function get_animated_class() {
				return ' animated vntd-animated';
			}

			public static function get_portfolio_defaults( $option_name ) {

				$portfolio_defaults = array(
					"layout_type" => 'grid',
					"item_style" => 'caption',
					"item_caption_style" => 'visible',
					"item_caption_align" => 'left',
					"item_caption_content" => 'title_categories',
					"item_caption_position" => 'center',
					"item_caption_categories" => 'no',
					"caption_border" => 'on',
					"item_hover_style" => 'zoom_link',
					"image_hover_effect" => 'zoom',
					"image_hover_overlay" => 'dark',
					"thumb_space" => 'yes',
					"love" => 'yes',
					"pagination" => 'disable',
					"more_button_style" => 'normal',
					"filter" => 'yes',
					"filter_align" => 'center',
					"filter_orderby" => 'slug',
					"animation" => 'quicksand',
					"order" => 'DESC',
					"orderby" => 'date',
				);

				if ( engage_option( 'portfolio_' . $option_name ) ) {
					return engage_option( 'portfolio_' . $option_name );
				} else if ( array_key_exists( $option_name, $portfolio_defaults ) ) {
					return $portfolio_defaults[ $option_name ];
				} else {
					return false;
				}

			}

			public static function portfolio_defaults() {

				$portfolio_defaults = array(
					"layout_type" => 'grid',
					"item_style" => 'caption',
					"item_caption_style" => 'visible',
					"item_caption_align" => 'left',
					"item_caption_content" => 'title_categories',
					"item_caption_position" => 'center',
					"item_caption_categories" => 'no',
					"caption_border" => 'on',
					"item_hover_style" => 'zoom_link',
					"image_hover_effect" => 'zoom',
					"image_hover_overlay" => 'dark',
					"thumb_space" => 'yes',
					"love" => 'yes',
					"pagination" => 'disable',
					"more_button_style" => 'normal',
					"filter" => 'yes',
					"filter_align" => 'center',
					"filter_orderby" => 'slug',
					"animation" => 'quicksand',
					"order" => 'DESC',
					"orderby" => 'date',
				);

				foreach ( $portfolio_defaults as $key => $value ) {
					if ( engage_option( 'portfolio_' . $key ) ) {
						$portfolio_defaults[ $key ] = engage_option( 'portfolio_' . $key );
					}
				}

				return $portfolio_defaults;

			}

			public static function get_element_defaults( $el_name ) {

				if ( $el_name == 'button' ) {
					$prefix = 'el_btn_';
					$defaults = array(
						"color" => 'accent',
						"color_hover" => 'dark',
						"style" => 'solid',
						"border_radius" => 'round',
						"shadow" => 'no'
					);
				} else {
					return false;
				}

				foreach ( $defaults as $key => $value ) {
					if ( engage_option( $prefix . $key ) ) {
						$defaults[ $key ] = engage_option( $prefix . $key );
					}
				}

				return $defaults;

			}

	   	}


	   	if ( !function_exists( 'engage_vc_google_font' ) ) {
	   		function engage_vc_google_font( $google_font ) {

	   			$italic = '';

	   			if ( strpos( $google_font, 'italic' ) !== false ) {
	   				$italic = 'i';
	   			}

	   			$google_font = explode( '|', $google_font );

	   			$font_family = explode( ':', $google_font[0] ); $font_family = explode( '%3', $font_family[1] ); $font_family = $font_family[0];

	   			$font_style = explode( ':', $google_font[1] ); $font_style = explode( '%20', $font_style[1] );

	   			$font_style = $font_style[0];

	   			wp_enqueue_style( 'vntd_font_' . $font_family, '//fonts.googleapis.com/css?family=' . $font_family . ':' . $font_style . $italic );

	   			return array(
	   				'font-family' => str_replace( '%20', ' ', $font_family ),
	   				'font-style' => $font_style
	   			);
	   		}
	   	}

	   	if ( !function_exists( 'engage_build_link' ) ) {
   	  		function engage_build_link( $label, $link, $classes ) {

            if ( strpos( $link, 'url:') !== false) {

							if ( function_exists( 'vc_build_link' ) ) {
								$link = vc_build_link( $link );
							}

              if ( is_array( $link ) ) {
                  $url = $link['url'];
              } else {
                  $url = $link;
              }

            } else {
                $url = $link;
            }

   	  			$anchor = '<a href="' . $url . '"';

   	  			if ( is_array( $link ) ) {
   	  				if ( $link['target'] != '' ) $anchor .= ' target="' . $link['target'] . '"';
   	  				if ( $link['title'] != '' ) $anchor .= ' title="' . $link['title'] . '"';
   	  			}

   	  			$anchor .= ' class="' . esc_attr( $classes ) . '">' . esc_html( $label ) . '</a>';

   	  			return $anchor;

   	  		}
   	  	}

   	}

?>
