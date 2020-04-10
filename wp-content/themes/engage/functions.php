<?php

//
// Engage Theme
//
// Author: Veented
// URL: http://themeforest.net/user/Veented/
//

load_theme_textdomain( 'engage', get_template_directory() . '/lang' );

if ( ! class_exists( 'Engage_Theme' ) ) {

	class Engage_Theme {

		function __construct() {

			// Load theme framework

			$this->load_framework();

			// Theme activation

			add_action( 'after_switch_theme', array( $this, 'after_switch_theme' ) );

			// Localization

			add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ), 10 );

      // Theme Options - Redux Framework

      add_action( 'after_setup_theme', array( $this, 'redux_init' ), 20 );

			// Theme scripts and styles

			$this->load_scripts_styles();

			// Navigation

			add_action( 'init', array( $this, 'init_nav' ) );
			add_filter( 'walker_nav_menu_start_el', array( $this, 'filter_walk_nav_menu_items' ), 10, 4);

			// Image Sizes

			add_action( 'after_setup_theme', array( $this, 'init_theme_images' ) );
			add_filter( 'image_size_names_choose', array( $this, 'filter_image_size_names' ) );

			// Theme Support

			add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'quote', 'link' ) );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'woocommerce' );
			add_theme_support( 'title-tag' );

			// WooCommerce

			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			// Filters

			add_filter( 'template_redirect', array( $this, 'filter_template_redirect' ) );
			add_filter( 'widget_tag_cloud_args', array( $this, 'tag_cloud' ), 90 );

			// Comments

			add_action( 'wp_enqueue_scripts', array( $this, 'theme_comments' ) );

			// Sidebars

			add_action( 'widgets_init', array( $this, 'register_sidebars' ) );

			// Gutenberg styling
			add_action( 'enqueue_block_editor_assets', array( $this, 'gutenberg_styles' ) );

			// Admin related

			$this->init_admin();
		}

		/**
		 * load_framework - Load all framework related files.
		 *
		 * @since       1.0
		 */

		function load_framework() {

			require_once( get_template_directory() . '/framework/plugins/plugins-config.php' ); 	 // Plugins Manager
			require_once( get_template_directory() . '/framework/functions/general-functions.php' ); // General functions
			require_once( get_template_directory() . '/framework/blog/blog-functions.php' ); // Blog related functions
			require_once( get_template_directory() . '/framework/header/header-functions.php' ); // Header related functions
			require_once( get_template_directory() . '/framework/functions/footer-functions.php' ); 	// Footer related functions
			require_once( get_template_directory() . '/framework/helpers/image-resize.php' );
			require_once( get_template_directory() . '/framework/translate/translate.php' ); // Easy translation

			// Wizard

			require_once( get_template_directory() . '/framework/setup-wizard/envato_setup.php' );

			// Theme Dashboard

			require_once( get_template_directory() . '/framework/admin/theme-dashboard.php' );

			// Automatic Theme Updates

			require_once( get_template_directory() . '/framework/admin/theme-updates/theme-updates.php' );

			// Add Options

			add_option( 'engage_misc', '', '', 'yes' );

		}

		/**
		 * redux_init - Load the Redux Framework config.
		 *
		 * @since       1.0
		 */

		function redux_init() {

			if ( class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/framework/theme-panel/engage/engage-config.php' ) ) {
			   require_once( get_template_directory() . '/framework/theme-panel/engage/engage-config.php' );
			}

		}

		/**
		 * after_switch_theme - Actions taken after the theme switch.
		 *
		 * @since       1.0
		 */

		function after_switch_theme() {

        global $pagenow;
        if ( "themes.php" == $pagenow && is_admin() && isset( $_GET['activated'] ) ) {
            wp_redirect( admin_url( 'admin.php?page=engage-dashboard' ) );
        }

		}

		/**
		 * after_setup_theme - Actions taken after the theme setup.
		 *
		 * @since       1.0
		 */

		function after_setup_theme() {

			load_theme_textdomain( 'engage', get_template_directory() . '/lang' );
			add_editor_style( array( '/css/editor.css' ) );

			global $wp_version;

			if ( version_compare( $wp_version, '3.4', '>=' ) ) {
			    add_theme_support( "custom-header" );
			    add_theme_support( "custom-background" );
			}

			// Remove old Team Members

      remove_action( 'init', 'engage_team_register' );

		}

		/**
		 * load_scripts_styles - Register and enqueue scripts and styles.
		 *
		 * @since       1.0
		 */

		function load_scripts_styles() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );

			// Dynamic CSS related
			add_action( 'wp_ajax_engage_dynamic_css', array( $this, 'dynamic_css' ) );
			add_action( 'wp_ajax_nopriv_engage_dynamic_css', array( $this, 'dynamic_css' ) );

			// Dynamic admin CSS
			add_action( 'wp_ajax_vntd_gutenberg_dynamic_css', array( $this, 'engage_dynamic_gutenberg_css' ) );
			add_action( 'wp_ajax_nopriv_vntd_gutenberg_dynamic_css', array( $this, 'engage_dynamic_gutenberg_css' ) );
		}

		/**
		 * add_action_after_switch_theme - Actions taken after the theme switch.
		 *
		 * @since       1.0
		 */

		function enqueue_scripts_styles() {
			if ( !is_admin() ) {

				// Load JS scripts

				wp_register_script( 'superfish', get_template_directory_uri() . '/js/plugins/superfish/superfish.min.js', array( 'jquery' ), '', true );
				wp_enqueue_script( 'engage-main', get_template_directory_uri() . '/js/engage.main.js', array( 'jquery', 'appear' ), '1.0.8', true );

				wp_enqueue_script( 'engage-navigation', get_template_directory_uri() . '/js/engage.navigation.js', array( 'jquery', 'superfish' ), '1.0.14', true);
				wp_register_script( 'engage-masonry', get_template_directory_uri() . '/js/engage.masonry.js', array( 'jquery' ), '1.0.4', true);
				wp_register_script( 'engage-grid', get_template_directory_uri() . '/js/engage.grid.js', array( 'jquery', 'cube-portfolio' ), '1.0.11' );
				wp_register_script( 'engage-carousels', get_template_directory_uri() . '/js/engage.carousels.js', array( 'jquery', 'owl-carousel' ) );
				wp_register_script( 'engage-sliders', get_template_directory_uri() . '/js/engage.sliders.js', array( 'jquery', 'swiper' ), '1.0.13', true );
				wp_register_script( 'engage-videos', get_template_directory_uri() . '/js/engage.videos.js', array( 'jquery', 'video-js' ), '1.0.4', true );
				wp_register_script( 'engage-appear', get_template_directory_uri() . '/js/engage.appear.js', array( 'jquery', 'appear' ) );
				wp_register_script( 'engage-ajax-pagination', get_template_directory_uri() . '/js/engage.ajax-pagination.js', array( 'jquery' ), '1.0.48', true );

				wp_register_script( 'jribbble', get_template_directory_uri() . '/js/plugins/jribbble.min.js', array('jquery') );
				wp_register_script( 'appear', get_template_directory_uri() . '/js/plugins/appear/jquery.appear.js', array( 'jquery' ), '1.0.1' );
				wp_register_script( 'skrollr', get_template_directory_uri() . '/js/plugins/skrollr/skrollr.min.js', array('jquery'), '1.0.1' );
				wp_register_script( 'swiper', get_template_directory_uri() . '/js/plugins/swiper.jquery.min.js', array('jquery') );
				wp_register_script( 'video-js', get_template_directory_uri() . '/js/plugins/video.js', array('jquery') );
				wp_register_script( 'owl-carousel', get_template_directory_uri() . '/js/plugins/owl-carousel/owl.carousel.min.js', array('jquery') );
				wp_register_script( 'vide', get_template_directory_uri() . '/js/plugins/vide/jquery.vide.min.js', array('jquery') );
				wp_register_script( 'YTPlayer', get_template_directory_uri() . '/js/plugins/YTPlayer/jquery.mb.YTPlayer.min.js', array('jquery'), '1.0.1' );
				wp_register_script( 'magnific-popup', get_template_directory_uri() . '/js/plugins/magnific-popup/jquery.magnific-popup.min.js', array('jquery') );
				wp_register_script( 'cube-portfolio', get_template_directory_uri() . '/js/plugins/cubeportfolio/jquery.cubeportfolio.min.js', array( 'jquery' ), '4.2.0', true );

				// Google Maps

				$api_key = '';

				if ( engage_option( 'google_maps_api' ) ) {
					$api_key = esc_attr( engage_option( 'google_maps_api' ) );
					wp_register_script( 'google-map-sensor', '//maps.google.com/maps/api/js?key=' . esc_attr( $api_key ) , array( 'jquery' ) );
					wp_register_script( 'google-map-label', get_template_directory_uri() . '/js/plugins/map/markerwithlabel.js', array( 'google-map-sensor' ) );
				}

				// Load stylesheets

				wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );

				wp_enqueue_style( 'engage-icons', get_template_directory_uri() . '/css/engage-icons/css/style.css' );
				wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/scripts/animate.min.css' );
				wp_dequeue_style( 'font-awesome' ); // Dequeue plugin version
				wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css', false, '5.7.1' );

				wp_enqueue_style( 'engage-ui', get_template_directory_uri() . '/css/ui.css', '', '1.0.3' );
				wp_enqueue_style( 'engage-styles', get_template_directory_uri() . '/style.css', array( 'bootstrap', 'font-awesome', 'animate' ), '1.0.63' ); // MAIN STYLESHEET

				// RTL

				wp_style_add_data( 'engage-styles', 'rtl', 'replace' );

				// Responsive

				wp_enqueue_style( 'engage-responsive', get_template_directory_uri() . '/css/responsive.css', array(), '1.0.5' );	// Load responsive stylesheet

				wp_register_style( 'swiper', get_template_directory_uri() . '/css/plugins/swiper.min.css' );
				wp_register_style( 'video-js', get_template_directory_uri() . '/css/plugins/video-js.min.css' );
				wp_register_style( 'YTPlayer', get_template_directory_uri() . '/css/plugins/mb.YTPlayer.min.css' );
				wp_register_style( 'magnific-popup', get_template_directory_uri() . '/css/plugins/magnific-popup.css' );
				wp_register_style( 'cube-portfolio', get_template_directory_uri() . '/css/plugins/cubeportfolio.min.css', false, '1.0.1' );
				wp_register_style( 'owl-carousel', get_template_directory_uri() . '/css/plugins/owl.carousel.css' );

				if ( engage_option( 'theme_skin' ) == 'dark' ) {
					wp_enqueue_style( 'engage-dark', get_template_directory_uri() . '/css/theme-skins/dark.css', array( 'engage-styles' ), '1.0.39' );
				}

				// Dynamic CSS
				wp_enqueue_style( 'engage-dynamic-css', admin_url( 'admin-ajax.php' ) . '?action=engage_dynamic_css' );

			}

		}

		/**
		 * dynamic_css - Dynamic theme stylesheet.
		 *
		 * @since       1.0
		 */

		function dynamic_css() {
			require( get_template_directory() . '/css/dynamic.css.php' );
			exit;
		}

		// Dynamic Gutenberg Styling

		function engage_dynamic_gutenberg_css() {
			require( get_template_directory() . '/css/admin/gutenberg.css.php' );
			exit;
		}

		// Gutenberg Styling

		public function gutenberg_styles() {
			 wp_enqueue_style( 'vntd-gutenberg', get_theme_file_uri( '/css/gutenberg.css' ), false, '', 'all' );
			 if ( ! has_filter( 'engage-remove-gutenberg-dynamic-css' ) ) {
		     wp_enqueue_style( 'vntd-gutenberg-dynamic', admin_url( 'admin-ajax.php' ) . '?action=vntd_gutenberg_dynamic_css', array( 'vntd-gutenberg' ) );
		   }
		}

		/**
		 * register_sidebars - Register sidebars.
		 *
		 * @since       1.0
		 */

		function register_sidebars() {

			register_sidebar( array(
		        'name' => esc_html__('Default Sidebar','engage'),
		        'id' => 'default_sidebar',
		        'description'   => esc_html__('Default theme sidebar.','engage'),
		        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		        'after_widget' => '</div>',
		        'before_title' => '<h5 class="widget-title">',
		        'after_title' => '</h5>',
		    ));
		    register_sidebar(array(
		        'name' => esc_html__('Secondary Sidebar','engage'),
		        'id' => 'sidebar_secondary',
		        'description'   => esc_html__( 'Secondary theme sidebar. Used by default in two sidebar page layouts.', 'engage' ),
		        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		        'after_widget' => '</div>',
		        'before_title' => '<h5 class="widget-title">',
		        'after_title' => '</h5>',
		    ));
			register_sidebar(array(
		        'name' => esc_html__('Archives/Search Sidebar','engage'),
		        'id' => 'archives',
		        'description'   => esc_html__('Sidebar for posts archive and search results.','engage'),
		        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		        'after_widget' => '</div>',
		        'before_title' => '<h5 class="widget-title">',
		        'after_title' => '</h5>',
		    ));

		    register_sidebar(array(
		        'name' => esc_html__('Footer Column 1','engage'),
		        'id' => 'footer1',
		        'description'   => esc_html__('Widgets for the first footer column.','engage'),
		        'before_widget' => '<div class="widget footer-widget footer-widget-col-1 %2$s">',
		        'after_widget' => '</div>',
		        'before_title' => '<h4 class="widget-title">',
		        'after_title' => '</h4>',
		    ));
		    register_sidebar(array(
		        'name' => esc_html__('Footer Column 2','engage'),
		        'id' => 'footer2',
		        'description'   => esc_html__('Widgets for the second footer column.','engage'),
		        'before_widget' => '<div class="widget footer-widget footer-widget-col-2 %2$s">',
		        'after_widget' => '</div>',
		        'before_title' => '<h4 class="widget-title">',
		        'after_title' => '</h4>',
		    ));
		    register_sidebar(array(
		        'name' => esc_html__('Footer Column 3','engage'),
		        'id' => 'footer3',
		        'description'   => esc_html__('Widgets for the third footer column.','engage'),
		        'before_widget' => '<div class="widget footer-widget footer-widget-col-3 %2$s">',
		        'after_widget' => '</div>',
		        'before_title' => '<h4 class="widget-title">',
		        'after_title' => '</h4>',
		    ));
		    register_sidebar(array(
		        'name' => esc_html__('Footer Column 4','engage'),
		        'id' => 'footer4',
		        'description'   => esc_html__('Widgets for the fourth footer column.','engage'),
		        'before_widget' => '<div class="widget footer-widget footer-widget-col-4 %2$s">',
		        'after_widget' => '</div>',
		        'before_title' => '<h4 class="widget-title">',
		        'after_title' => '</h4>',
		    ));
		    register_sidebar(array(
		        'name' => esc_html__('Footer Column 5','engage'),
		        'id' => 'footer5',
		        'description'   => esc_html__('Widgets for the fifth footer column. Make sure to enable a specific footer layout in Theme Options / Footer to display this column.','engage'),
		        'before_widget' => '<div class="widget footer-widget footer-widget-col-5 %2$s">',
		        'after_widget' => '</div>',
		        'before_title' => '<h4 class="widget-title">',
		        'after_title' => '</h4>',
		    ));
		    if ( class_exists( 'Woocommerce' ) ) { // If WooCommerce is enabled, activate related sidebars

		    	register_sidebar( array(
		    	    'name' => esc_html__('WooCommerce Shop Page', 'engage' ),
		    	    'id'	=> 'woocommerce_shop',
		    	    'description'   => esc_html__('WooCommerce shop page sidebar.','engage'),
		    	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
		    	    'after_widget' => '</div>',
		    	    'before_title' => '<h5 class="widget-title">',
		    	    'after_title' => '</h5>',
		    	));

		    }

		}

		/**
		 * init_nav - Register nav menus.
		 *
		 * @since       1.0
		 */

		function init_nav() {

			register_nav_menu( 'primary', esc_html__( 'Primary Navigation', 'engage' ) );
			register_nav_menu( 'topbar', esc_html__( 'Top Bar Left Navigation', 'engage' ) );
            register_nav_menu( 'topbar_right', esc_html__( 'Top Bar Right Navigation', 'engage' ) );

		}

		/**
		 * filter_walk_nav_menu_items - Replace shortcode in nav elements href attribute.
		 *
		 * @since       1.0
		 */

		function filter_walk_nav_menu_items( $output, $item, $depth, $args ) {

			global $post;
			$front_id = get_option( 'page_on_front' );



			if( is_object( $post ) ) {
				if ( strpos( $output, 'http://frontpage_url/') !== false ) {
				    $output = str_replace( 'http://frontpage_url/', get_permalink( $front_id ), $output );
				    $output = str_replace( get_permalink( $post->ID ) . '#', '#', $output );
				} elseif ( strpos( $output, 'http://current_page_url/') !== false ) {
					$output = str_replace( 'http://current_page_url/', get_permalink( $post->ID ), $output );
					$output = str_replace( get_permalink( $post->ID ) . '#', '#', $output );
				}
			}

		    return $output;
		}

		 function get_image_sizes() {
		 	global $_wp_additional_image_sizes;

		 	$sizes = array();

		 	foreach ( get_intermediate_image_sizes() as $_size ) {
		 		if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
		 			$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
		 			$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
		 			$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
		 		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
		 			$sizes[ $_size ] = array(
		 				'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
		 				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
		 				'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
		 			);
		 		}
		 	}

		 	return $sizes;
		 }

		 /**
		  * image_sizes - Declaration of theme specific image sizes
		  *
		  * @since       1.0
		  */

		 public static function image_sizes() {
		 	$img_sizes = array(
		 		'engage-sidebar-wide' => array(
		 			'name' => esc_html__( 'Engage Sidebar Wide', 'engage' ),
		 			'width' => 900,
		 			'height' => 470,
		 			'crop' => true
		 		),
		 		'engage-masonry-square' => array(
		 			'name' => esc_html__( 'Engage Grid Square', 'engage' ),
		 			'width' => 600,
		 			'height' => 600,
		 			'crop' => true
		 		),
		 		'engage-masonry-regular' => array(
		 			'name' => esc_html__( 'Engage Grid', 'engage' ),
		 			'width' => 600,
		 			'height' => 420,
		 			'crop' => true
		 		),
		 		'engage-masonry-auto' => array(
		 			'name' => esc_html__( 'Engage Masonry', 'engage' ),
		 			'width' => 600,
		 			'height' => 0,
		 			'crop' => false
		 		),
		 	);
		 	return $img_sizes;
		}

		/**
		 * all_image_sizes - Array of all image sizes: base ones that are applied with add_image_size and other ones used across the theme for dynamic cropping.
		 *
		 * @since       1.0
		 */

		public static function all_image_sizes() {

			$base_sizes = Engage_Theme::image_sizes();

			$other_img_sizes = array(
				'engage-sidebar-auto' => array(
					'width' => 900,
					'height' => null,
					'crop' => false
				),
				'engage-fullwidth-crop' => array(
					'width' => 1210,
					'height' => 600,
					'crop' => true
				),
				'engage-fullwidth-auto' => array(
					'width' => 1210,
					'height' => null,
					'crop' => false
				)
			);

			return array_merge( $base_sizes, $other_img_sizes );

		}

		/**
		 * init_theme_images - Add image sizes
		 *
		 * @since       1.0
		 */

		function init_theme_images() {

				// Image Sizes

				add_theme_support( 'post-thumbnails' );
				set_post_thumbnail_size( 150, 150, true );

				$img_sizes = Engage_Theme::image_sizes();

				// Register theme image sizes, only the most used ones

				foreach ( $img_sizes as $img_size_id => $img ) {
					add_image_size( $img_size_id, $img[ 'width' ], $img[ 'height' ], $img[ 'crop' ] );
				}


		}

		/**
		 * image_size_names_choose - Localize image size names.
		 *
		 * @since       1.0
		 */

		function filter_image_size_names( $sizes ) {

			$custom_sizes = array();

			foreach( Engage_Theme::image_sizes() as $img_size_id => $img_size ) {
				$custom_sizes[ $img_size_id ] = $img_size[ 'name' ];
			}

		    return array_merge( $sizes, $custom_sizes );

		}

		/**
		 * init_admin - All admin dashboard related actions and functions.
		 *
		 * @since       1.0
		 */

		function init_admin() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts_styles' ) );
		}

		/**
		 * admin_scripts_styles - Admin related scripts and styles.
		 *
		 * @since       1.0
		 */

		function admin_scripts_styles() {

			// Scripts
			wp_enqueue_media();
			wp_register_script( 'dashboard-jquery', get_template_directory_uri() . '/js/admin/engage.admin.js', array(), '1.1' );
			wp_register_script( 'media-uploader', get_template_directory_uri() . '/js/admin/media-uploader.js', array( 'jquery' ), true );
			wp_enqueue_script( 'dashboard-jquery', '', '', '', true );
			wp_enqueue_script( 'thickbox', '', '', '', true );

			$updates_url = admin_url( 'themes.php?page=install-required-plugins' );

			wp_localize_script( 'dashboard-jquery', 'VNTDWP',
				array(
					'themeurl' => get_template_directory_uri(),
					'updateInfo' => esc_html__( 'Theme: To get instant access to an update, please visit our', 'engage' ) . ' <a href="https://plugins.veented.com/" target="_blank">Veented Plugins</a> ' . esc_html__( 'service.', 'engage' ),
					'updateInfoAvailable' => sprintf( esc_html__( 'Theme: There seem to be plugin updates available for you in', 'engage' ) . ' <a href="%s">' . esc_html__( 'Appearance / Install Plugins', 'engage' ) . '</a> ' . esc_html__( 'menu. If this particular plugin update is not available there, please visit', 'engage' ) . ' <a href="https://plugins.veented.com/" target="_blank">Veented Plugins</a> ' . esc_html__( 'service.', 'engage' ), $updates_url ),
					'updateLayerSlider' => esc_html__( 'Note: If you have issues updating the Layer Slider plugin, please deactivate the plugin first and then try again. You may also try removing the plugin completely and installing it all over again (none of your settings/sliders will be gone).', 'engage' ),
					'classicEditorInfo' => esc_html__( 'Classic Editor enables the previous Classic Editor (Pre-Gutenberg) and the old-style Edit Post screen with TinyMCE, Meta Boxes, etc.', 'engage' ),
					't_addTemplate' => esc_html__( 'Add Template', 'engage' ),
					't_jumpTo' => esc_html__( 'Jump to', 'engage' ),
				)
			);

			// Styles
			wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css' );
			wp_enqueue_style( 'engage-admin', get_template_directory_uri() . '/css/admin/admin.css', array(), '1.0.5' );
			wp_enqueue_style( 'engage-icons', get_template_directory_uri() . '/css/engage-icons/css/style.css' );

			if ( is_rtl() ) {
				wp_enqueue_style( 'engage-admin-rtl', get_template_directory_uri() . '/css/admin/admin-rtl.css', array( 'engage-admin' ), '1.0.0' );
			}

		}

		/**
		 * tag_cloud - tag cloud widget configuration.
		 *
		 * @since       1.0
		 */

		function tag_cloud( $args = array() ) {
		   $args[ 'smallest' ] = 14;
		   $args[ 'largest' ] = 14;
		   $args[ 'unit' ] = 'px';
		   return $args;
		}

		/**
		 * theme_comments - comments section related.
		 *
		 * @since       1.0
		 */

		function theme_comments() {
			if( is_singular() || is_page() ) {
				wp_enqueue_script( 'comment-reply', '', '', '', true);
			}
		}

		/**
		 * filter_template_redirect - set a default content width.
		 *
		 * @since       1.0
		 */

		function filter_template_redirect( $embed_size ) {
			global $content_width;
			$content_width = 1170;
		}

		/**
		 * color_array - returns a default theme color array.
		 *
		 * @since       1.0
		 */

		public static function color_array( $custom = false ) {

			$color_array = array(
				'white' => esc_html__( 'White', 'engage' ),
				'accent' => esc_html__( 'Accent', 'engage' ),
				'dark' => esc_html__( 'Dark', 'engage' ),
			);

			if( $custom == true ) {
				$color_array[ 'custom' ] = esc_html__( 'Custom', 'engage' );
			}

			return $color_array;

		}

		/**
		 * hover_color_array - returns a default theme hover color array.
		 *
		 * @since       1.0
		 */

		public static function hover_color_array() {

			$color_array = array(
				'white' => esc_html__( 'White', 'engage' ),
				'dark' => esc_html__( 'Dark', 'engage' ),
				'accent' => esc_html__( 'Accent', 'engage' )
			);

			return $color_array;

		}

		public static $default_address = 'Canal St, New York, NY 10013, USA';
		public static $default_address_ll = '40.7179907,-74.0001119';

	}

	// Create a new object of the main theme class
	$engage_theme = new Engage_Theme();

}

//
// Get Theme Options Value
//

if ( !function_exists( 'engage_option' ) ) {
	function engage_option( $option_name, $option_name_value = null ) {

		global $engage_options;

		if ( $engage_options == null ) {
			$engage_options = get_option( 'engage_options' );
		}

		if ( is_array( $engage_options ) ) {

			if ( $option_name_value == null) {

				if ( array_key_exists( $option_name, $engage_options ) ) {
					return $engage_options[ $option_name ];
				} else {
					return null;
				}

			} else {

				if ( array_key_exists( $option_name, $engage_options ) && is_array( $engage_options[ $option_name ] ) ) {

					if ( array_key_exists( $option_name_value, $engage_options[ $option_name ] ) ) {
						return $engage_options[ $option_name ][ $option_name_value ];
					}

				} else {
					return null;
				}

			}

		}

		return '';

	}
}

if ( !function_exists( 'engage_option_true' ) ) {
	function engage_option_true( $option_name = null, $post_id = null ) {

		if ( ! $option_name ) return false;
		if ( ! $post_id ) $post_id = get_the_ID();

        if ( get_post_meta( $post_id, $option_name, true ) == 'default' || !get_post_meta( $post_id, $option_name, true ) ) {
            if ( engage_option( 'g_' . $option_name ) === false ) {
                return false;
            } else {
                return true;
            }
        }

		if ( get_post_meta( $post_id, $option_name, true ) == 'yes' || get_post_meta( $post_id, $option_name, true ) != 'no' && engage_option( 'g_' . $option_name ) == true ) {
			return true;
		}

		return false;
	}
}

//
// Visual Composer related
//

if ( class_exists( 'Vc_Manager' ) ) {

	function engage_extend_composer() {
		require_once get_template_directory() . '/wpbakery/vc-extend.php';
	}

	$list = array(
	    'page',
	    'post',
	    'portfolio'
	);

	vc_set_default_editor_post_types( $list );

	add_action( 'init', 'engage_extend_composer', 20 );

    add_action( 'vc_before_init', 'engage_vcSetAsTheme' );

    function engage_vcSetAsTheme() {
        vc_set_as_theme();
    }
}



//
// Custom Menus
//

class engage_Custom_Menu_Class extends Walker_Nav_Menu {

	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

		global $wp_query;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$mega_menu_class = '';
		if( $depth == 0 && get_post_meta( $item->ID, '_menu_item_vntd_mega_menu', true ) == 'checked' && strpos( $class_names, 'mega_menu' ) === false ) {
			$mega_menu_class = 'mega-menu ';
		}
		$class_names = ' class="' . $mega_menu_class . esc_attr( $class_names ) . '"';

		$id_prefix = '';

		if ( is_object( $args ) && property_exists( $args, 'emobile' ) && $args->emobile == true ) {
			$id_prefix = 'mobile-';
		}

		$output .= $indent . '<li id="' . $id_prefix . 'menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'><span>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

		if( $item->description && engage_header_style() == 'classic-subtitles' ) {

			$item_output .= '<span class="sub">' . $item->description . '</span>';

		}

		$item_output .= '</span></a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// Remove custom post type parent element

function engage_remove_parent_classes( $class )
{
	return ($class == 'current_page_item' || $class == 'current_page_parent' || $class == 'current_page_ancestor'  || $class == 'current-menu-item') ? FALSE : TRUE;
}

function engage_add_class_to_wp_nav_menu( $classes )
{

	$classes = array_filter($classes, "engage_remove_parent_classes");

	return $classes;
}

//
// Woocommerce
//

if ( class_exists( 'Woocommerce' ) && ! has_filter( 'engage_disable_woocommerce_config' ) ) {
	require_once( get_template_directory() . '/woocommerce/config.php' );
}

if ( !function_exists('engage_sim_styles') ) {

	function engage_sim_styles() {
		wp_enqueue_style('cubePortfolio');
		wp_enqueue_style('magnific-popup');
		wp_enqueue_style('owl-carousel');
	}
	add_action('wp_enqueue_scripts', 'engage_sim_styles');
}

//
// Media View Settings
//

if ( !function_exists( 'engage_media_view_settings' ) ) {
	function engage_media_view_settings( $settings, $post ) {
	    if (!is_object($post)) return $settings;
	    $shortcode = '[gallery ';
	    $ids = get_post_meta($post->ID, 'gallery_images', TRUE);
	    $ids = explode(",", $ids);

	    if ( is_array( $ids ) )
	        $shortcode .= 'ids = "' . implode(',',$ids) . '"]';
	    else
	        $shortcode .= "id = \"{$post->ID}\"]";
	    $settings['shibaMlib'] = array('shortcode' => $shortcode);
	    return $settings;

	}
	add_filter( 'media_view_settings', 'engage_media_view_settings', 10, 2 );
}
