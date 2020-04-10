<?php

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//
// 		Header related functions
//
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

//
// Site Logo, Classic Header
//

if ( !function_exists( 'engage_site_logo' ) ) {
	function engage_site_logo( $header_style = null ) {

		$logo_img = $logo_img_secondary = $inline_css = '';

		$logo_img_dark = $logo_img_white = engage_option( 'site_logo', 'url' );

		if ( engage_option( 'site_logo_white', 'url' ) ) {
			$logo_img_white = engage_option( 'site_logo_white', 'url' );
		}

		if ( ( $height = engage_option( 'logo_height' ) ) ) {
			$margin_top = 0 - ( $height / 2 );
			$inline_css .= 'height:' . esc_attr( $height ) . 'px;margin-top:' . esc_attr( $margin_top ) . 'px';
		}

		if ( $inline_css ) $inline_css = ' style="' . $inline_css . '"';

		if ( ! class_exists( 'Engage_Core' ) || $logo_img_dark == null ) {
			$logo_img_dark = get_template_directory_uri() . '/img/logos/logo-dark.png';
			$logo_img_white = get_template_directory_uri() . '/img/logos/logo-light.png';
		}

		// Optional logo link
		$logo_url = engage_logo_url();
		$extra_class = '';

		if ( $logo_url == false ) { // Logo link disabled
			$logo_url = '#';
			$extra_class = ' no-link';
		} else {
			$logo_url = esc_url( $logo_url );
		}

		echo '<a href="' . esc_html( $logo_url ) . '" class="logo-link' . $extra_class . '">';

		echo '<img src="' . esc_url( $logo_img_dark ) . '" alt="logo" class="logo-dark"' . $inline_css . '>';

		echo '<img src="' . esc_url( $logo_img_white ) . '" alt="logo" class="logo-white"' . $inline_css . '>';

		if ( engage_option( 'logo_tablet', 'url' ) ) {
			echo '<img src="' . esc_url( engage_option( 'logo_tablet', 'url' ) ) . '" alt="logo" class="logo-tablet"' . $inline_css . '>';
		}

		if ( engage_option( 'logo_mobile', 'url' ) ) {
			echo '<img src="' . esc_url( engage_option( 'logo_mobile', 'url' ) ) . '" alt="logo" class="logo-mobile"' . $inline_css . '>';
		}

		echo '</a>';


	}
}

// Header Classes

if ( !function_exists( "engage_header_classes" ) ) {
	function engage_header_classes(){

		$header_style = engage_header_style();
		$classes = array();

		$classes[] = 'site-header';

		// Header Skin

		$classes[] = 'header-' . engage_header_skin();

		// Header Scroll Skin

		$classes[] = 'header-scroll-' . engage_header_scroll_skin();

		// Topbar

		if (engage_option( 'topbar' ) || get_post_meta(get_the_ID(), 'force_topbar', true) == 'yes' ) {
			$classes[] = 'with-topbar';

			if ( engage_option( 'topbar_mobile' ) == true ) {
			    $classes[] = 'topbar-mobile';
			    if ( engage_option( 'topbar_mobile_align' ) == 'left' ) {
			        $classes[] = 'topbar-mobile-left';
                } else {
			        $classes[] = 'topbar-mobile-center';
                }
            }
		}

		if ( $header_style == 'top-center-logo' ) {
			$classes[] = 'top-logo-center';
		} elseif ( $header_style == 'top-center' ) {
			$classes[] = 'nav-logo-center';
		} elseif ( $header_style == 'classic-subtitles' ) {
			$classes[] = 'menu-subtitle';
		}

		// Logos

		if ( engage_option( 'logo_tablet', 'url' ) ) {
			$classes[] = 'has-tablet-logo';
		}

		if ( engage_option( 'logo_mobile', 'url' ) ) {
			$classes[] = 'has-mobile-logo';
		}

        // Mobile header classes

        if ( engage_option( 'mobileh_layout' ) == 'logo_center' ) {
            $classes[] = 'm-layout-center';
        }

        if ( engage_option( 'mobileh_sticky' ) == 'yes' ) {
            $classes[] = 'm-sticky';
        } else {
            $classes[] = 'm-not-sticky';
        }

        // Mobile search icon

        if ( engage_option( 'mobileh_search' ) != '' ) {
            $classes[] = 'm-search-' . esc_attr( engage_option( 'mobileh_search' ) );
        }

		// Header Styling

		if ( engage_header_position() == 'top' ) {

			if ( engage_option( 'nav_active_style' ) ) {
				$classes[] = 'active-style-' . engage_option( 'nav_active_style' );
			}

			if ( engage_option( 'header_sticky' ) == 'not-sticky' || engage_option( 'header_sticky' ) == 'sticky-appear' ) {
				$classes[] = 'header-' . engage_option( 'header_sticky' );
			} else {
				$classes[] = 'header-sticky';
			}

			// Dropdown border

			if ( engage_option( 'dropdown_separator' ) == true ) {
				$classes[] = 'dropdown-menu-separator';
			}

			// Dropdown shadow

			if ( engage_option( 'dropdown_shadow' ) == '0' ) {
				$classes[] = 'dropdown-no-shadow';
			}

			// Mega separator

			if ( engage_option( 'mega_separator' ) == '0' ) {
				$classes[] = 'mega-no-separator';
			}

			// Transparent header

			$meta_header_skin = get_post_meta( get_the_ID(), 'page_header_skin', true );

			if ( $meta_header_skin == 'transparent' ) {
				$classes[] = 'header-bg-transparent';
			}

		}

		if ( engage_option( 'dropdown_skin' ) == 'white' ) {
			$classes[] = 'dropdown-white';
		} else {
			$classes[] = 'dropdown-dark';
		}

		// Mobile behaviour

		if ( engage_option( 'mobile_dropdown' ) == 'arrow' ) {
			$classes[] = 'mobile-dropdown-arrow';
		} else {
			$classes[] = 'mobile-dropdown-parent';
		}

		// Header Separator

		// Default:
		// Box shadow for not transparent
		// Border for transparent

		$header_separator = 'shadow';

		if ( ( $separator = get_post_meta( get_the_ID(), 'page_header_separator', true ) ) != '' ) {
			$header_separator = $separator;
		} elseif ( engage_header_transparent() == true ) {
			$header_separator = engage_option( 'header_separator_transparent' );
		} elseif ( ( $value = engage_option( 'header_separator' ) ) != '' ) {
			$header_separator = $value;
		}

		$classes[] = 'header-separator-' . esc_attr( $header_separator );

		echo esc_attr( implode( ' ', $classes ) );

	}
}

// Header Sticky


if ( !function_exists( 'engage_header_sticky' ) ) {
	function engage_header_sticky() {

		$header_sticky = 'sticky';

		if ( engage_option( 'header_sticky' ) == 'sticky-appear' ) {
			return 'sticky-appear';
		} else if ( engage_option( 'header_sticky' ) == 'not-sticky' ) {
			return 'not-sticky';
		}

		return $header_sticky;

	}
}

// Header Skin

if ( !function_exists( 'engage_header_skin' ) ) {
	function engage_header_skin() {

		$header_skin = 'light';
		$meta_header_skin = get_post_meta( engage_get_ID(), 'page_header_skin', true );

		if ( $meta_header_skin == 'transparent' ) {
			$header_skin = 'dark';
		} elseif ( $meta_header_skin == 'light' || $meta_header_skin == 'dark' ) {
			$header_skin = $meta_header_skin;
		} elseif ( engage_option( 'header_skin' ) == 'dark' ) {
			$header_skin = 'dark';
		}

		return $header_skin;

	}
}

// Header Skin Color

if ( !function_exists( 'engage_header_scroll_skin' ) ) {
	function engage_header_scroll_skin() {

		$header_skin = engage_option( 'header_skin' );
		$scroll_header = engage_option( 'header_scroll_skin' );

		if ( $scroll_header == '' || $scroll_header == 'same' ) {
			return $header_skin;
		} elseif ( $scroll_header == 'dark' ) {
			return 'dark';
		} else {
			return 'light';
		}

	}
}

// Header Color

if ( !function_exists( 'engage_header_color' ) ) {
	function engage_header_color() {

		$header_color = '#fff';

		if ( engage_header_skin() == 'dark' ) {
			$header_color = '#202020';
		}

		$header_meta_color = get_post_meta( engage_get_id(), 'page_header_color', true );

		if ( $header_meta_color != '' ) {
			$header_color = $header_meta_color;
		} elseif ( engage_option( 'header_color' ) != '' ) {
			$header_color = engage_option( 'header_color' );
		}

		$header_opacity = '';

		if ( get_post_meta( engage_get_id(), 'page_header_opacity', true ) != '' ) {
			$header_opacity = get_post_meta( engage_get_id(), 'page_header_opacity', true );
		} elseif ( engage_option( 'header_opacitys' ) != '1.00' ) {
			$header_opacity = engage_option( 'header_opacitys' );
		}

		if ( $header_opacity != '' ) {
			$header_color = engage_hex2rgba( $header_color, $header_opacity );
		}

		return $header_color;

	}
}

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// 		Mobile Navigation
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( !function_exists( 'engage_mobile_nav' ) ) {
	function engage_mobile_nav($button = NULL) {

		if ($button) {
			echo '<div id="vntd-mobile-nav-toggle"><i class="fa fa-bars"></i></div>';
		} else { ?>
			<div id="mobile-navigation" class="vntd-container">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' )); ?>
			</div>
		<?php }

	}
}

if ( !function_exists( 'veented_engage_nav_wrap' ) ) {

	function veented_engage_nav_wrap( $style = null ) {


	}

}

// Extra navigation tools

if ( !function_exists( 'engage_nav_tools' ) ) {

	function engage_nav_tools() {

		$header_style = engage_header_style();

		$wrap  = '<ul class="nav-tools">';

		// Display note if no menu is assigned:

		if ( !has_nav_menu( 'primary' ) ) {
			$wrap .= '<li class="no-menu">' . esc_html__( 'Menu not found! Go to Appearance / Menus and create menu.', 'engage' ) . '</li>';
		}

		// Shopping Cart

		if ( class_exists( 'Woocommerce' ) && engage_option( 'header_woocommerce' ) != false ) {
			$wrap .= engage_woo_nav_cart();
		}

        // Language Switcher // Deprecated! Use native WPML language switcher (WPML / Settings / Menu Language Switcher)

        // if ( class_exists( 'SitePress' ) && function_exists( 'icl_get_languages' ) && sizeof( icl_get_languages( 'skip_missing=0' ) ) > 1 && engage_option( 'header_wpml' ) == 'yes' ) {
				// 	$wrap .= engage_header_langs();
				// }

		// Search

		if ( engage_option( 'header_search' ) && !engage_is_header_offcanvas() && $header_style != 'overlay-simple' ) {

			$wrap .= '<li class="search-tool"><a href="#" class="tools-btn" data-toggle-search="fullscreen"><span class="tools-btn-icon"><i class="engage-icon-icon engage-icon-zoom-2"></i></span></a></li>';

		}

		// Mobile Menu Button

		if ( engage_is_header_offcanvas() ) {

			$effect = 'push';
			$position = 'right';

			if ( $header_style == 'left-hover' || $header_style == 'left-push' ) {
				$position = 'left';
			}

			if ( $header_style == 'left-hover' || $header_style == 'right-hover' ) {
				$effect = 'hover';
			}

			$wrap .= '<li class="off-menu-btn"><div class="toggle-menu" data-toggle="aside-menu" data-effect="' . $effect . '" data-position="' . $position . '"><div class="btn-inner"><span></span></div></div></li>';

		} elseif ( $header_style == 'overlay-simple' || $header_style == 'overlay-fullscreen' ) {

			$data_toggle = 'main-menu';

			if ( $header_style == 'overlay-fullscreen' ) {
				$data_toggle = 'fullscreen-menu';
			}

			$wrap .= '<li class="off-menu-btn"><button class="toggle-menu" data-toggle="' . $data_toggle . '"><span></span></button></li>';

		} else {
			$wrap .= '<li class="mobile-menu-btn" id="mobile-menu-btn">';
			$wrap .= '<div id="mobile-menu-toggle" class="toggle-menu toggle-menu-mobile" data-toggle="mobile-menu" data-effect="hover"><div class="btn-inner"><span></span></div></div>';
			$wrap .= '</li>';

		}

		$wrap .= '</ul>';

		if ( $wrap != '<ul class="nav-tools"></ul>' ) {
			// Everything already sanitised within the variable
			echo '' . $wrap;
		}

	}

}

if ( !function_exists( 'engage_header_top_content' ) ) {
	function engage_header_top_content() {

		do_action( 'engage_header_top_content_before' );

		echo '<div class="header-extra-content">';

		if ( engage_option( 'header_top_text' ) ) {
			echo '<div class="header-extra-text">';

			echo wp_kses( engage_option( 'header_top_text' ), engage_kses() );

			echo '</div>';
		}

		if ( engage_option( 'header_top_social' ) == true ) {
			echo '<div class="header-extra-social">';
			engage_print_social_icons();
			echo '</div>';
		}

		echo '</div>';

		do_action( 'engage_header_top_content_after' );

	}
}

if ( !function_exists( 'engage_is_header_offcanvas' ) ) {
	function engage_is_header_offcanvas() {

		$header_style = engage_header_style();

		if ( $header_style == 'left-hover' || $header_style == 'left-push' || $header_style == 'right-hover' || $header_style == 'right-push' ) {
			return true;
		}

		return false;

	}
}

if ( !function_exists( 'engage_nav_menu' ) ) {
	function engage_nav_menu( $location = null, $mobile = false ) {
		global $post;

		$style = 'default';
		$menu_location = 'primary';

		if ( $location == 'split-nav' ) {

			if ( engage_option( 'header_split_nav' ) != '' ) {

				wp_nav_menu( array(
					'menu' 			=> engage_option( 'header_split_nav' ),
					'container' 	=> false,
					'menu_class' 	=> 'nav',
					'walker' 		=> new engage_Custom_Menu_Class()
				));

				return;

			} else {
				echo '<p class="vntd-no-nav">' . esc_html__( 'No secondary menu found.', 'engage' ) . '</p>';

				return;
			}

		}

		if ( is_page_template( 'template-fullpage.php' ) ) {

			add_filter( 'nav_menu_link_attributes', 'engage_custom_nav_attributes', 10, 3 );

		}

		if ( $mobile == true ) {
			$mobile = true;
		} else {
			$mobile = false;
		}

		if ( has_nav_menu( 'primary' ) ) {

			if ( get_post_meta( get_the_ID(), 'page_custom_menu', true) && get_post_meta( get_the_ID(), 'page_custom_menu', true ) != 'default' ) {

				$menu = wp_nav_menu( array(
					'menu' 			=> get_post_meta( get_the_ID(), 'page_custom_menu', true ),
					'container' 	=> false,
					'menu_class' 	=> 'nav',
					'emobile' => $mobile,
					'walker' 		=> new engage_Custom_Menu_Class(),
                    'echo'          => false
				));

			} else {

				$menu = wp_nav_menu( array(
					'theme_location'	 	=> $menu_location,
					'container' 		=> false,
					'menu_class' 		=> 'nav',
					'emobile' => $mobile,
					'walker' 			=> new engage_Custom_Menu_Class(),
          'echo'              => false
				));

			}

			if ( $location == 'mobile-split' ) { // Merge left and right menus to display all elements in the mobile nav
                wp_nav_menu( array(
                    'menu' => engage_option( 'header_split_nav' ),
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s ' . $menu . '</ul>',
                    'menu_class' => 'nav',
                    'container' => false,
										'emobile' => $mobile,
                    'walker' => new engage_Custom_Menu_Class(),
                ) );
            } else {
                echo '' . $menu;
            }

		} else {
			//echo '<span class="vntd-no-nav">No custom menu created!</span>';
		}
	}
}

if ( !function_exists( 'engage_custom_nav_attributes' ) ) {

	function engage_custom_nav_attributes ( $atts, $item, $args ) {

		$temp = $item->url;

		if (substr( $item->url, 0, 1 ) === "#" ) {
			$atts['data-getanchor'] = str_replace( "#", "", $item->url);
		}

	    return $atts;
	}

}


if ( !function_exists( 'engage_header_extra_content' ) ) {

	function engage_header_extra_content() {

		echo '<div class="nav-extra-item nav-extra-item-text">';

		if (engage_option( 'navbar_extra_type' ) == 'text' ) {

			echo do_shortcode(engage_option( 'navbar_extra' ));

		} elseif (engage_option( 'navbar_extra_type' ) == 'search' ) {

			echo '<div class="nav-extra-search">';
			get_template_part( 'searchform' );
			echo '</div>';

		} elseif (engage_option( 'navbar_extra_type' ) == 'search-product' ) {

		}



		echo '</div>';
	}
}


// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// 		Breadcrumbs
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( !function_exists( 'engage_breadcrumbs' ) ) {
function engage_breadcrumbs() {

	global $post;

	if ( !is_front_page() ) {

        echo '<div class="breadcrumbs-holder"><ul id="breadcrumbs" class="breadcrumbs">';
        echo '<li><a href="';
        echo esc_url( home_url( '/' ) );
        echo '">';
        echo engage_translate( 'home' ) . '</a></li>';

		$product = false;
		if ( class_exists( 'Woocommerce' ) ) {
			if ( is_product() ) $product = true;
		}
        if ( is_category() ){

		} elseif ( is_single() && get_post_type( $post->ID ) == 'portfolio' ) { // Portfolio post type

			$portfolio_parent_id = '';

			if ( get_post_meta( $post->ID, 'portfolio_parent', true ) == 'custom' ) {
				$portfolio_parent_id = get_post_meta( $post->ID, 'portfolio_parent_page', true );
			}

			if ( $portfolio_parent_id == '' ) {
				$portfolio_parent_id = engage_option( 'portfolio_page' );

			}

			if ( $portfolio_parent_id != '' ) {
				echo '<li><a href="' . get_permalink( $portfolio_parent_id ) . '">' . get_the_title( $portfolio_parent_id ) . '</a></li>';
			}

		}

		// WooCommerce

        if ( class_exists( 'Woocommerce' ) ) {
	        if ( is_woocommerce() || is_product() || is_shop() || is_cart() || is_checkout() || is_account_page() ) {
	            echo '<li><a href="' . get_permalink( get_option( 'woocommerce_shop_page_id' ) ) . '" title="' . get_the_title( get_option( 'woocommerce_shop_page_id' ) ) . '">' . get_the_title( get_option( 'woocommerce_shop_page_id' ) ) . '</a></li>';
	        }
            if ( is_product_category() ) {
                echo '<li>' . single_term_title( '', false ) . '</li>';
            }
	    }

	    // Events Calendar Pro

	    if ( class_exists( 'Tribe__Events__Main' ) ) {
	    	if ( tribe_is_month() && !is_tax() ) { // Month View Page
	    		echo '<li>' . esc_html__( 'Events', 'engage' ) . '</li>';
	    	} else if ( is_singular( 'tribe_events' ) ) { // Single event page
	    		$link = Tribe__Events__Main::instance()->getLink();
	    		echo '<li><a href="' . esc_url( $link ) . '">' . esc_html__( 'Events', 'engage' ) . '</a></li>';
	    	}

	    }

	    if ( is_404() ) {
	    	echo '<li>' . engage_translate( 'page-not-found' ) . '</li>';
	    }

        if ( is_single() && !$product ) {

            echo '<li>';

            if ( strlen( get_the_title() ) > 30 ) {
            	echo mb_substr( get_the_title(), 0, 30 ) . '...';
            } else {
            	echo get_the_title();
            }

            echo '</li>';
        }

        if ( is_page() ) {

        	$parent_id = $post->post_parent;

        	if ( $parent_id ) {

        		$parent_page = get_page( $post->post_parent );

        		if ( $parent_page->post_parent ) {
        			echo '<li><a href="' . get_permalink( $parent_page->post_parent ) . '" title="' . get_the_title( $parent_page->post_parent ).'">' . get_the_title( $parent_page->post_parent ) . '</a></li>';
        	     }

        	    $parent_title = get_the_title( $parent_id );

        	    if ( strlen( $parent_title ) > 30 ) {
        	    	$parent_title = mb_substr( $parent_title, 0, 30 ) . '...';
        	    }

        	    echo '<li><a href="' . get_permalink( $parent_id ) . '" title="' . esc_html( $parent_title ) . '">' . get_the_title( $parent_id ) . '</a></li>';
        	}
        	echo '<li>';

            if ( strlen( get_the_title() ) > 30 ) {
            	$page_title = mb_substr( get_the_title(), 0, 30 ) . '...';
            } else {
            	$page_title = get_the_title();
            }

            if ( has_filter( 'engage_filter_breadcrumbs_page_title' ) ) {
                $page_title = apply_filters( 'engage_filter_breadcrumbs_page_title', $page_title );
            }
            echo esc_html( $page_title );

            echo '</li>';
        }

        if ( is_tag() ) {
        	echo '<li>' . engage_translate( 'archives' ) . '</li>';
        	echo '<li>'.esc_html__( 'Posts tagged by', 'engage' ).' "';
            echo single_tag_title( '', false);
            echo '"</li>';
        } elseif ( is_category() ) {
        	echo '<li>'. engage_translate( 'archives' ) .'</li>';
        	echo '<li>'.esc_html__( 'Posts by category', 'engage' ).' "';
            echo single_cat_title( '', false);
            echo '"</li>';
        } elseif ( is_month() || is_day() ) {
        	echo '<li>'. engage_translate( 'archives' ) .'</li>';
        	echo '<li>';
        	$date = 'F Y';
            the_time( $date );
            echo '</li>';
        } elseif ( is_year() ) {
        	echo '<li>' . engage_translate( 'archives' ) . '</li>';
        	echo '<li>';
           $date = 'Y';
           the_time( $date );
            echo '"</li>';
        } elseif (is_search() ) {
            echo '<li>' . engage_translate( 'search-results-for' ) . ' <span class="search-phrase">"' . get_search_query() . '"</span></li>';
        }

        if ( is_home() ) {
            global $post;
            $page_for_posts_id = get_option( 'page_for_posts' );
            if ( $page_for_posts_id ) {
                $post = get_page($page_for_posts_id);
                setup_postdata($post);
                echo '<li>';
                the_title();
                echo '</li>';
                rewind_posts();
            }
        }

        echo '</ul></div>';
    }
}
}

if ( !function_exists( 'engage_logo_url' ) ) {
	function engage_logo_url() {

		if ( engage_option( 'logo_link' ) == 'disable' ) {
			return null;
		}

		if ( is_front_page() ) {
			return '#home';
		} else {
			return home_url();
		}

	}
}

//
// Page Title Function
//

if ( !function_exists( 'engage_get_title' ) ) {
	function engage_get_title() {

		global $post;

		$post_id = get_the_ID();

		$page_title = get_the_title( $post_id );

		if ( is_home() && is_front_page() ) {
			$page_title = engage_translate( 'blog' );
		} elseif ( is_home() ) {
			$page_title = get_the_title( get_option( 'page_for_posts' ) );
		} elseif ( is_404() ) {
			$page_title = engage_translate( 'page-not-found' );
		} elseif ( is_search() ) {
			$page_title = engage_translate( 'search-results' );
		} elseif ( is_archive() || is_tag() || is_category() || is_year() || is_month() ) {
			$page_title = engage_translate( 'archives' );
		}

		// WooCommerce

		if ( class_exists( 'Woocommerce' ) ) {

		    if ( is_product_category() ) {
            $page_title = single_term_title( '', false );
				} else if ( is_product() || is_shop() ) {
            $post_id = get_option( 'woocommerce_shop_page_id' );
		    		$page_title = get_the_title( $post_id );
		    }

		}

		// Events Calendar

		if ( class_exists( 'Tribe__Events__Main' ) ) {
			if ( tribe_is_month() && !is_tax() || is_singular( 'tribe_events' ) ) { // Month View Page
				$page_title = esc_html__( 'Events', 'engage' );
			}

		}

		// Custom Title

		if ( get_post_meta( $post_id, 'page_title_custom', true ) != '' ) {
			$page_title = get_post_meta( $post_id, 'page_title_custom', true );
		}

    if ( has_filter( 'engage_filter_page_title' ) ) {
        $page_title = apply_filters( 'engage_filter_page_title', $page_title );
    }

		return $page_title;

	}
}


//
// Top Bar
//

if ( !function_exists( 'engage_print_topbar' ) ) {
	function engage_print_topbar( $container_class = null ) {

	$topbar_skin = 'light';

	if ( engage_option( 'topbar_skin' ) == 'dark' || engage_header_skin() == 'dark' && engage_option( 'topbar_skin' ) == ''  ) {
		$topbar_skin = 'dark';
	}

	$topbar_class = 'white-pagetop';

	if ( engage_header_style() == 'style-transparent' ) {
		$topbar_class = 'transparent-pagetop';
	}

	?>

	<!-- BEGIN TOPBAR -->
	<div id="topbar" class="topbar topbar-<?php echo esc_attr( $topbar_skin ); ?>">
	  <div class="container<?php if ( $container_class ) echo esc_attr( $container_class ); ?>">
	    <div class="topbar-left">
	    	<?php engage_topbar_content( 'left' ); ?>
	    </div>
	    <div class="topbar-right">
	    	<?php engage_topbar_content( 'right' ); ?>
	    </div>
	  </div>
	</div>
	<!-- END TOPBAR -->
	<?php
	}
}

if ( !function_exists( 'engage_topbar_content' ) ) {
	function engage_topbar_content( $side ) {

		$type = engage_option( 'topbar_' . $side );

		if ( $side == 'left' ) {
            do_action( 'engage_before_top_bar_left' );
        } else {
		    do_action( 'engage_before_top_bar_right' );
        }

		$top_bar_text = '';

		$icon_style = 'font_awesome';

		if ( $icon_style != 'font_awesome' ) {
			$top_bar_text = str_replace( "[icon icon", '[icon icon_style="simple-line" icon', engage_option( 'topbar_text_' . $side ) );
		} else {
			$top_bar_text = engage_option( 'topbar_text_' . $side );
		}

		$bar_text = do_shortcode( $top_bar_text );

		// If more than 1 WPML language, display switcher

		if ( function_exists( 'icl_get_languages' ) && sizeof( icl_get_languages( 'skip_missing=0' ) ) > 1 && $side == 'right' && engage_option( 'topbar_wpml' ) ) {
			engage_topbar_langs();
		}

		// Switch content type

		if ( $type == 'social' ) {

			echo '<div class="topbar-section topbar-social">';

			engage_print_social_icons();

			echo '</div>';

		} elseif ( $type == 'menu' ) {

			echo '<div class="topbar-section topbar-menu">';

			if ( $side == 'right' ) {
                $location = 'topbar_right';
            } else {
			    $location = 'topbar';
            }

			wp_nav_menu( array( 'theme_location' => $location ) );

			echo '</div>';

		} elseif ( $type == 'textsocial' ) {

			echo '<p class="topbar-section topbar-text topbar-text-socials icons-' . $icon_style . '">' . $bar_text . '</p>';
			echo '<div class="topbar-section topbar-social">';

			engage_print_social_icons();

			echo '</div>';

		} else {
			echo '<div class="topbar-section topbar-text"><p>' . $bar_text . '</p></div>';
		}

		if ( engage_option( 'topbar_' . $side . '_account') == true ) {

	    echo '<div class="topbar-section topbar-login">';

				do_action( 'engage_before_topbar_account_area' );

        if ( ! is_user_logged_in() ) {

            echo '<a href="#"><i class="fa fa-user"></i> ' . engage_translate('login') . '</a>';

            echo '<div class="topbar-login-form">';

						do_action( 'engage_before_topbar_login_form' );

            $args = array(
                'label_username' => engage_translate('username_or_email'),
                'label_password' => engage_translate('password'),
                'label_remember' => engage_translate('remember_me'),
                'label_log_in' => engage_translate('login')
            );

            wp_login_form( apply_filters( 'engage_topbar_login_form_args', $args ) );

						do_action( 'engage_after_topbar_login_form' );

            echo '</div>';

        } else {
            $current_user = wp_get_current_user();
            echo '<a href="' . esc_url( get_edit_user_link() ) . '"><i class="fa fa-user"></i> ' . esc_html( $current_user->display_name ) . '</a>';
        }

				do_action( 'engage_after_topbar_account_area' );

	    echo '</div>';

    }

	}
}

if ( !function_exists( 'engage_print_big_search' ) ) {
function engage_print_big_search() {
	?>
	<div class="header-big-search">
		<form class="search-form relative" id="search-form" action="<?php echo esc_url(home_url( '/' )); ?>/">
			<input name="s" id="s" type="text" value="" placeholder="<?php echo engage_translate( 'search-big-placeholder' ) ?>" class="search">
			<div class="header-search-close accent-hover-color"><i class="fa fa-close"></i></div>
		</form>
	</div>
	<?php
}
}

if ( !function_exists( 'engage_header_style' ) ) {
	function engage_header_style() {
		global $post;

		$style = 'classic';

		$style = engage_option( 'header_style' );

		return $style;
	}
}

if ( !function_exists( 'engage_header_layout' ) ) {
	function engage_header_layout() {

		$style = 'classic';

		$style = engage_option( 'header_style' );

		$layout = 'top';

		if ( !is_search() && !is_archive() && !is_tag() ) {

			if (get_post_meta(engage_get_id(),'navbar_style',TRUE) && get_post_meta(engage_get_id(),'navbar_style',TRUE) != $style && get_post_meta(engage_get_id(),'navbar_style',TRUE) != 'default' ) {

				$style = get_post_meta(engage_get_id(),'navbar_style',TRUE);

			}

		} elseif (is_search() || is_archive() || is_tag() ) {
			//$style = 'classic';
		}

		$layout == 'top';

		if ( $style == 'left' || $style == 'left-hover' || $style == 'left-push' || $style == 'right' || $style == 'right-hover' || $style == 'right-push' ) {
			$layout = 'aside';
		} else {
			$layout = 'top';
		}

		return $layout;
	}
}

if ( !function_exists( 'engage_header_position' ) ) {
	function engage_header_position() {

		$position = 'top';

		if ( engage_option( 'header_position' ) == 'left' || engage_option( 'header_position' ) == 'right' ) {
			$position = 'aside';
		}

		return $position;
	}
}

if ( !function_exists( 'engage_print_fullscreen_menu' ) ) {
	function engage_print_fullscreen_menu() {

		?>

		<div id="off-fullscreen-menu">

			<button class="toggle-menu" data-toggle="fullscreen-menu">
			  <i class="engage-icon-icon engage-icon-simple-remove"></i>
			</button>

			<div class="brand">
				<img width="145" height="36" src="<?php echo esc_url( engage_option( 'site_logo_white', 'url' ) ); ?>" alt="logo">
			</div>

			<nav>
			<?php engage_nav_menu(); ?>
			</nav>

		</div>

		<?php

	}
}

if ( !function_exists( 'engage_pagetitle_meta' ) ) {
	function engage_pagetitle_meta( $field_name, $array_key = false ) {

		$post_id = get_the_ID();

		if ( is_home() ) {
			$post_id = get_option( 'page_for_posts' );
		}

		if ( class_exists( 'Woocommerce' ) ) {
			if ( is_shop() && get_option( 'woocommerce_shop_page_id' ) ) {
				$post_id = get_option( 'woocommerce_shop_page_id' );
			}
		}

		$meta_value = get_post_meta( $post_id, 'custom_' . $field_name, true );

		if ( $array_key == false ) { // Non array value

			if ( is_array( $meta_value ) ) {
				if ( array_key_exists( 'url', $meta_value) && $meta_value['url'] != '' ) {
					return $meta_value;
				}
				return engage_option( $field_name );
			}

			if ( $meta_value != '' && $meta_value != 'default' && $meta_value != engage_option( $field_name ) ) {

				return $meta_value;

			}

		} else { // We're operating with an array value

			$global_value = engage_option( $field_name ); // Get the value from the Theme Options panel

			if ( $meta_value[ $array_key ] != '' ) {
				return $meta_value[ $array_key ];
			} elseif ( $global_value[ $array_key ] != '' ) {
				return $global_value[ $array_key ];
			} else {
				return '';
			}

		}

		return engage_option( $field_name );

	}
}

// If Page Title is enabled

if ( !function_exists( 'engage_pagetitle_enabled' ) ) {
	function engage_pagetitle_enabled() {

		$post_id = engage_get_id();

		if ( get_post_meta( $post_id, 'custom_pagetitle', true ) == 'disable' || engage_option( 'header_title' ) == '0' || is_search() && engage_option('search_page_title') === 0 || is_archive() && engage_option('search_page_title') === 0 || class_exists( 'WooCommerce' ) && is_product() && engage_option( 'wc_product_page_title' ) == '0' ) {
			return false;
		}

		return true;

	}
}

// Page Title Area Size related settings

if ( !function_exists( 'engage_title_size_css' ) ) {
	function engage_title_size_css( $size = 'medium' ) {

		$title_typography = engage_option( 'pagetitle_' . $size . '_title' );
		$subtitle_typography = engage_option( 'pagetitle_' . $size . '_subtitle' );

		$height = engage_option( 'pagetitle_' . $size . '_height' );


		//return 'height: ' . esc_attr( $height ) . 'px; }';

	}
}

// Page Title Heading Inline CSS

if ( !function_exists( 'engage_pagetitle_heading_css' ) ) {
	function engage_pagetitle_heading_css() {

		$post_id = engage_get_id();

		$inline_css = array();

		// Color

		if ( ( $value = engage_pagetitle_meta( 'pagetitle_color' ) ) != '' ) {
			$inline_css[] = 'color:' . esc_attr( $value ) . ';';
		}

		// Font size

		if ( ( $value = get_post_meta( $post_id, 'custom_pagetitle_heading_size', true ) ) != '' || ( $value = engage_option( 'pagetitle_typography', 'font-size' ) ) != '' ) {
			$inline_css[] = 'font-size:' . esc_attr( str_replace( 'px', '', $value ) ) . 'px;';
		}

		// Font Weight

		if ( ( $value = engage_option( 'pagetitle_typography', 'font-weight' ) ) != '' ) {
			$inline_css[] = 'font-weight:' . esc_attr( $value ) . ';';
		}

		// Text Transform

		if ( ( $value = engage_option( 'pagetitle_typography', 'text-transform' ) ) != '' ) {
			$inline_css[] = 'text-transform:' . esc_attr( $value ) . ';';
		}

		// Letter Spacing

		if ( ( $value = engage_option( 'pagetitle_typography', 'letter-spacing' ) ) != '' ) {
			$inline_css[] = 'letter-spacing:' . esc_attr( $value ) . ';';
		}

		// Print Inline CSS

		if ( !empty( $inline_css ) ) {
			return ' style="' . implode( '', $inline_css ) . '"';
		}

		return null;

	}
}

// Page Title Subtitle Inline CSS

if ( !function_exists( 'engage_pagetitle_subtitle_css' ) ) {
	function engage_pagetitle_subtitle_css() {


		$post_id = engage_get_id();

		$inline_css = array();

		// Color

		if ( ( $value = engage_pagetitle_meta( 'pagetitle_subtitle_color' ) ) != '' ) {
			$inline_css[] = 'color:' . esc_attr( $value ) . ';';
		}

		// Font size

		if ( ( $value = get_post_meta( $post_id, 'custom_pagetitle_subtitle_size', true ) ) != '' || ( $value = engage_option( 'pagetitle_subtitle_typography', 'font-size' ) ) != '' ) {
			$inline_css[] = 'font-size:' . esc_attr( str_replace( 'px', '', $value ) ) . 'px;';
		}

		// Font Weight

		if ( ( $value = engage_option( 'pagetitle_subtitle_typography', 'font-weight' ) ) != '' ) {
			$inline_css[] = 'font-weight:' . esc_attr( $value ) . ';';
		}

		// Text Transform

		if ( ( $value = engage_option( 'pagetitle_subtitle_typography', 'text-transform' ) ) != '' ) {
			$inline_css[] = 'text-transform:' . esc_attr( $value ) . ';';
		}

		// Letter Spacing

		if ( ( $value = engage_option( 'pagetitle_subtitle_typography', 'letter-spacing' ) ) != '' ) {
			$inline_css[] = 'letter-spacing:' . esc_attr( $value ) . ';';
		}

		// Print

		if ( !empty( $inline_css ) ) {
			return ' style="' . implode( '', $inline_css ) . '"';
		}

		return null;

	}
}

if ( !function_exists( 'engage_header_transparent' ) ) {
	function engage_header_transparent() {
		$post_id = engage_get_id();
		$value = '';

		if ( ( $value = get_post_meta( $post_id, 'page_header_opacity', true ) ) != '' || ( $value = engage_option( 'header_opacity' ) ) != '' || get_post_meta( engage_get_ID(), 'page_header_skin', true ) == 'transparent' ) {
			if ( $value != '1.0' ) {
				return true;
			}
		}
		return false;

	}
}

if ( !function_exists( 'engage_header_scroll_height' ) ) {
	function engage_header_scroll_height() {

		if ( ( $header_scroll_height = engage_option( 'header_scroll_height' ) ) != '' ) {
			echo esc_attr( $header_scroll_height );
		} else {
			echo 60;
		}

	}
}

if ( !function_exists( 'engage_header_scroll_animation' ) ) {
	function engage_header_scroll_animation() {

		echo 'default';

	}
}

if ( !function_exists( 'engage_header_container' ) ) {
	function engage_header_container() {

		if ( engage_option( 'header_container' ) == 'fullwidth' ) {
			return 'fullwidth';
		}

		return false;
	}
}

// Language Top Bar Switcher

if ( !function_exists( 'engage_topbar_langs' ) ) {
	function engage_topbar_langs() {

		if(function_exists('icl_get_languages')) $langs = icl_get_languages('skip_missing=0');
		if(sizeof($langs) <= 1)  return false;

		?>
		<div class="topbar-section topbar-langs">

			<?php
			echo '<div class="current-lang">'.ICL_LANGUAGE_NAME_EN.'<i class="fa fa-angle-down"></i>';
			echo '<ul class="vntd-lang-dropdown">';
			foreach($langs as $lang) {
				$name = $lang['translated_name'];
				$current = '';
				if($name != ICL_LANGUAGE_NAME) {
					echo '<li '.$current.'><a href="'.$lang['url'].'">'.$lang['native_name'].'</a></li>';
				}


			}
			echo '</ul></div>';
			?>
		</div>

		<?php
	}
}

// Header Language switcher

if ( !function_exists( 'engage_header_langs' ) ) {
	function engage_header_langs() {

		if ( function_exists( 'icl_get_languages' ) ) $langs = icl_get_languages( 'skip_missing=0' );

		if ( sizeof( $langs ) <=  1 )  return false;

        $content = '';

		//$content_begin = '<li class="header-lang-switcher"><a class="current-lang-name">'.ICL_LANGUAGE_NAME_EN.'</a><ul class="dropdown-menu header-lang-list vntd-lang-dropdown">';

        $current_flag = '';

            $mode = 1;

            if ( $mode == 1 ) {

                foreach ( $langs as $lang ) {
                    $name = $lang[ 'translated_name' ];
                    $current = '';
                    if ( $name != ICL_LANGUAGE_NAME ) {
                        $content .= '<li><a href="' . $lang[ 'url' ] . '" title="' . $lang[ 'native_name' ] . '"><img src="' . $lang[ 'country_flag_url' ] . '"><span class="lang-name">' . $lang[ 'native_name' ] . '</span></a></li>';
                    } else {
                        $current_flag = '<img src="' . $lang[ 'country_flag_url' ] . '" class="header-current-lang-img">';
                    }


                }

            }

        $content_begin = '<li class="header-lang-switcher"><a class="current-lang-name">'. $current_flag . ICL_LANGUAGE_NAME_EN.'</a><ul class="dropdown-menu header-lang-list vntd-lang-dropdown">';

            $content = $content_begin . $content;

        $content .= '</ul></li>';

        return $content;
	}
}
