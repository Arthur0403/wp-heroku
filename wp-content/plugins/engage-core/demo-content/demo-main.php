<?php 

// Load the demo plugin core

require_once( 'demo-plugin/one-click-demo-import.php' ); 

// Define constants

define( 'ENGAGE_DEMO_PATH', trailingslashit( get_template_directory() ) . 'framework/demo-content/demos/' );
define( 'ENGAGE_DEMO_PAGES_PATH', trailingslashit( get_template_directory() ) . 'framework/demo-content/demo-pages/' );
define( 'ENGAGE_DEMO_URL', get_template_directory_uri() . '/framework/demo-content/demos/' );

if ( !function_exists( 'engage_demo_sites_list' ) ) {
    function engage_demo_sites_list() {
        $demos = array(
			'main' => array(
				'name' => esc_html__( 'Main Demo', 'engage' ),
				'categories' => array( 'Business' ),
				'preview_url' => 'http://engage.veented.com/home-1/'
			),
			'agency' => array(
				'name' => esc_html__( 'Agency', 'engage' ),
				'categories' => array( 'Business' )
			),
            'agency-creative' => array(
				'name' => esc_html__( 'Agency Creative', 'engage' ),
				'categories' => array( 'Business', 'Creative', 'Portfolio' ),
                'preview_url' => 'http://engage.veented.com/creative-agency/'
			),
			'app' => array(
				'name' => esc_html__( 'App', 'engage' ),
				'categories' => array( 'Business', 'Creative' )
			),
			'app-one-pager' => array(
				'name' => esc_html__( 'App One Pager', 'engage' ),
				'categories' => array( 'Business', 'Creative', 'One Pager' )
			),
            'architecture' => array(
				'name' => esc_html__( 'Architecture', 'engage' ),
				'categories' => array( 'Business', 'Creative' )
			),
			'bakery' => array(
				'name' => esc_html__( 'Bakery', 'engage' ),
				'categories' => array( 'Food' )
			),
			'barber' => array(
				'name' => esc_html__( 'Barber', 'engage' ),
				'categories' => array( 'Services' )
			),
            'business' => array(
				'name' => esc_html__( 'Business', 'engage' ),
				'categories' => array( 'Business' )
			),
            'business-2' => array(
				'name' => esc_html__( 'Business 2', 'engage' ),
				'categories' => array( 'Business' )
			),
			'cafe' => array(
				'name' => esc_html__( 'Cafe', 'engage' ),
				'categories' => array( 'Food' )
			),
			'church' => array(
				'name' => esc_html__( 'Church', 'engage' ),
				'categories' => array( 'Other' ),
				'plugins' => array( 'the-events-calendar' => 'The Events Calendar' )
			),
			'construction' => array(
				'name' => esc_html__( 'Construction', 'engage' ),
				'categories' => array( 'Services' ),
			),
			'fitness' => array(
				'name' => esc_html__( 'Fitness', 'engage' ),
				'categories' => array( 'Sports' ),
				'plugins' => array( 'contact-form-7' => 'Contact Form 7' )
			),
			'gym' => array(
				'name' => esc_html__( 'Gym', 'engage' ),
				'categories' => array( 'Sports' ),
				'plugins' => array( 'contact-form-7' => 'Contact Form 7' )
			),
			'medical' => array(
				'name' => esc_html__( 'Medical', 'engage' ),
				'categories' => array( 'Sports' ),
			),
			'music' => array(
				'name' => esc_html__( 'Music', 'engage' ),
				'categories' => array( 'Music' )
			),
			'photography-modern' => array(
				'name' => esc_html__( 'Photography Modern', 'engage' ),
				'categories' => array( 'Artist', 'Portfolio', 'Creative' ),
			),
			'photography' => array(
				'name' => esc_html__( 'Photography', 'engage' ),
				'categories' => array( 'Artist', 'Portfolio', 'Creative' ),
			),
			'photography-dark' => array(
				'name' => esc_html__( 'Photography Dark', 'engage' ),
				'categories' => array( 'Artist', 'Portfolio', 'Creative' ),
			),
			'photography-side' => array(
				'name' => esc_html__( 'Photography Side', 'engage' ),
				'categories' => array( 'Artist', 'Portfolio', 'Creative' ),
			),
			'portfolio-classic' => array(
				'name' => esc_html__( 'Portfolio Classic', 'engage' ),
				'categories' => array( 'Portfolio', 'Creative' ),
			),
            'portfolio-elegant' => array(
				'name' => esc_html__( 'Portfolio Elegant', 'engage' ),
				'categories' => array( 'Portfolio', 'Creative' ),
			),
			'portfolio-minimal1' => array(
				'name' => esc_html__( 'Portfolio Minimal 1', 'engage' ),
				'categories' => array( 'Portfolio', 'Creative' ),
			),
            'portfolio-minimal2' => array(
				'name' => esc_html__( 'Portfolio Minimal 2', 'engage' ),
				'categories' => array( 'Portfolio', 'Creative' ),
			),
			'shop-classic' => array(
				'name' => esc_html__( 'Shop Classic', 'engage' ),
				'categories' => array( 'Shop' ),
				'plugins' => array( 'woocommerce' => 'WooCommerce' )
			),
			'shop-elegant' => array(
				'name' => esc_html__( 'Shop Elegant', 'engage' ),
				'categories' => array( 'Shop' ),
				'plugins' => array( 'woocommerce' => 'WooCommerce' )
			),
			'shop-dark' => array(
				'name' => esc_html__( 'Shop Dark', 'engage' ),
				'categories' => array( 'Shop' ),
				'plugins' => array( 'woocommerce' => 'WooCommerce' )
			),
			'restaurant' => array(
				'name' => esc_html__( 'Restaurant', 'engage' ),
				'categories' => array( 'Food' ),
			),
			'wedding' => array(
				'name' => esc_html__( 'Wedding', 'engage' ),
				'categories' => array( 'Services' )
			),
			'wine' => array(
				'name' => esc_html__( 'Wine', 'engage' ),
				'categories' => array( 'Food' )
			),
			'yoga' => array(
				'name' => esc_html__( 'Yoga', 'engage' ),
				'categories' => array( 'Sports' )
			),
		);
        
        return $demos;
    }
}
// Demo content setup

if ( !function_exists( 'engage_demo_content' ) ) {
	
	function engage_demo_content() {
	
		$opt_name = 'engage_options';
		
		$demos = engage_demo_sites_list();
		
		$demos_array = array();
		
		// For plugin active status check
		
		foreach ( $demos as $demo_slug => $demo ) {
			
			// Preview URL
			
			if ( array_key_exists( 'preview_url', $demo ) ) {
				$preview_url = $demo[ 'preview_url' ];
			} else {
				$preview_url = 'http://engage.veented.com/' . $demo_slug . '/';
			}
			
			// Required Plugins
			
			$plugins = null;
			
			if ( array_key_exists( 'plugins', $demo ) ) {
			
				$plugins = $demo[ 'plugins' ];
			
			}
			
			// Push to final demos array
			
			$demos_array[] = array(
				'import_file_name'	=> $demo[ 'name' ],
				'categories'	=> $demo[ 'categories' ],
				'local_import_file'  => ENGAGE_DEMO_PATH . $demo_slug . '/content.xml',
				'local_import_widget_file' => ENGAGE_DEMO_PATH . $demo_slug . '/widgets.wie',
				'local_import_redux' => array(
					array(
						'file_path' => ENGAGE_DEMO_PATH . $demo_slug . '/redux.json',
						'option_name' => $opt_name,
					),
				),
				'import_preview_image_url'   => ENGAGE_DEMO_URL . $demo_slug . '/thumbnail.jpg',
				'preview_url' => $preview_url,
				'plugins' => $plugins
			);
			
		}
		
		return $demos_array;

	}
	
	add_filter( 'pt-ocdi/import_files', 'engage_demo_content' );
}


// After Import Action

if ( !function_exists( 'engage_after_import_setup' ) ) {
	function engage_after_import_setup( $selected_import ) {
	
		$front_page_id = get_page_by_title( 'Home' );
		$blog_page_id  = get_page_by_title( 'Blog' );
        $blog2_page_id = get_page_by_title( 'News' );
		
		// Main navigation		
		
		$main_menu = get_term_by( 'name', 'Site Navigation', 'nav_menu' );
		
		if ( 'Fitness' === $selected_import['import_file_name'] ) {
			
		} else if ( 'Wedding' === $selected_import['import_file_name'] || 'Cafe' === $selected_import['import_file_name'] || 'Architecture' === $selected_import['import_file_name'] ) {
			$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		} else if ( 'Main Demo' === $selected_import['import_file_name'] || 'App One Pager' === $selected_import['import_file_name'] ) {
			$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
		}
		
		if ( 'Main Demo' === $selected_import['import_file_name'] ) {
			$front_page_id = get_page_by_title( 'Home 1' );
		} else if ( 'Portfolio Minimal 1' === $selected_import['import_file_name'] && 'Portfolio Minimal 2' === $selected_import['import_file_name'] ) {
            $front_page_id = get_page_by_title( 'Work' );
        }
		
		// Set main menu
		
		if ( is_object( $main_menu ) ) {
			set_theme_mod( 'nav_menu_locations', array(
					'primary' => $main_menu->term_id,
				)
			);
		}
		
		// Set Front Page
		
		if ( is_object( $front_page_id ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
		}
		
		// Set Posts Page
		
		if ( is_object( $blog_page_id ) ) {
            update_option( 'page_for_posts', $blog_page_id->ID );
        } else if ( is_object( $blog2_page_id ) ) {
            update_option( 'page_for_posts', $blog2_page_id->ID );
        }
		
		// Remove Hello World post
		
		wp_trash_post( 1 );
	
	}
	add_action( 'pt-ocdi/after_import', 'engage_after_import_setup' );
}

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

// Do not regenerate thumbnails

add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

// Demo Importer Popup

if ( !function_exists( 'engage_demo_confirmation_dialog_options' ) ) {
	function engage_demo_confirmation_dialog_options ( $options ) {
		return array_merge( $options, array(
			'width'       => 430,
			'dialogClass' => 'wp-dialog engage-demo-popup',
			'resizable'   => false,
			'height'      => 'auto',
			'modal'       => true,
		) );
	}
	add_filter( 'pt-ocdi/confirmation_dialog_options', 'engage_demo_confirmation_dialog_options', 10, 1 );
}

// Demo Importer Menu Location

if ( !function_exists( 'engage_plugin_page_setup' ) ) {
	function engage_plugin_page_setup( $default_settings ) {
		$default_settings['parent_slug'] = 'engage-dashboard';
		$default_settings['page_title']  = esc_html__( 'Demo Sites' , 'pt-ocdi' );
		$default_settings['menu_title']  = esc_html__( 'Demo Sites' , 'pt-ocdi' );
		$default_settings['capability']  = 'import';
		$default_settings['menu_slug']   = 'engage-demo';
	
		return $default_settings;
	}
	add_filter( 'pt-ocdi/plugin_page_setup', 'engage_plugin_page_setup' );
}

// Demo Pages

if ( !function_exists( 'engage_demo_pages_list' ) ) {
	
	function engage_demo_pages_list() {
	
		$opt_name = 'engage_options';
		
		$demos = array(
			'home-1' => array(
				'title' => 'Home 1',
				'post_id' => '16',
                'demo_id' => 'agency',
                'type' => 'page'
			),
            'about-2' => array(
				'title' => 'About 2',
				'post_id' => '18',
                'demo_id' => 'app',
                'type' => 'page'
			),
		);
		
		$demo_pages_array = array();
		
		// For plugin active status check
		
		foreach ( $demos as $demo_slug => $demo ) {
			
			// Preview URL
			
			if ( array_key_exists( 'preview_url', $demo ) ) {
				$preview_url = $demo[ 'preview_url' ];
			} else {
				$preview_url = 'http://engage.veented.com/' . $demo_slug . '/';
			}
			
			// Required Plugins
			
			$plugins = null;
			
			if ( array_key_exists( 'plugins', $demo ) ) {
			
				$plugins = $demo[ 'plugins' ];
			
			}
			
			// Push to final demos array
			
			$demo_pages_array[] = array(
				'import_file_name'	=> $demo[ 'title' ],
                'title' => $demo[ 'title' ],
                'post_id' => $demo[ 'post_id' ],
                'demo_id' => $demo[ 'demo_id' ],
                'type' => 'page',
				'local_import_file'  => ENGAGE_DEMO_PAGES_PATH . $demo[ 'demo_id' ] . '/' . $demo[ 'post_id' ] . '.xml',
				'preview_url' => $preview_url
			);
			
		}
		
		return $demo_pages_array;

	}
	
	add_filter( 'pt-ocdi/import_pages', 'engage_demo_pages_list' );
}