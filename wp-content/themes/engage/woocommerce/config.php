<?php

if ( ! function_exists( 'engage_woocommerce_init_settings' ) ) {
	function engage_woocommerce_init_settings() {
		$catalog = array(
			'width' 	=> '400',	// px
			'height'	=> '400',	// px
			'crop'		=> 1 		// true
		);

		$single = array(
			'width' 	=> '600',	// px
			'height'	=> '',	// px
			'crop'		=> 0 		// true
		);

		$thumbnail = array(
			'width' 	=> '120',	// px
			'height'	=> '120',	// px
			'crop'		=> 1 		// false
		);

		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs

	}

	add_action('init', 'engage_woocommerce_init_settings', 1);
}

if ( ! function_exists( 'engage_wc_scripts' ) ) {
	// WC scripts and styles
	function engage_wc_scripts() {
		wp_register_script( 'vntd-woo-js', get_template_directory_uri() . '/woocommerce/assets/woocommerce-scripts.js', array('jquery'));
		wp_enqueue_script( 'vntd-woo-js', '', '', '', true);
		wp_register_style( 'vntd-woocommerce-custom', get_template_directory_uri() . '/woocommerce/assets/woocommerce-styling.css', array( 'woocommerce-general', 'woocommerce-layout' ), '1.0.27' );
		wp_enqueue_style('vntd-woocommerce-custom');
	}

	add_action( 'wp_enqueue_scripts', 'engage_wc_scripts' );
}

if (!function_exists('engage_loop_columns')) {
	add_filter('loop_shop_columns', 'engage_loop_columns');
	function engage_loop_columns() {
		return 999; // 3 products per row
	}
}

if ( ! has_filter( 'engage_enable_woocommerce_basic_actions' ) ) {
	remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
	remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10);
}

if ( ! function_exists( 'engage_woocommerce_loop_thumbnail' ) ) {

    add_action( 'woocommerce_before_shop_loop_item_title', 'engage_woocommerce_loop_thumbnail', 10 );

    function engage_woocommerce_loop_thumbnail() {
        echo '<div class="product-thumbnail-wrap vntd-accent-bg-color">';
        woocommerce_template_loop_product_thumbnail();
        echo '<div class="overlay-rating">';
            woocommerce_template_loop_rating();
        echo '</div>';
        echo '<div class="product-overlay">';
        echo '<div class="product-overlay-inner">';

        echo engage_translate( 'view-details' );

        echo '</div></div></div>';

        echo '<div class="product-details-wrap"><div class="product-category">' . engage_product_categories() . '</div>';
    }
}

if ( ! function_exists( 'engage_product_categories' ) ) {
	function engage_product_categories() {
		global $post;

		$categories = '';

		$terms = wp_get_object_terms($post->ID, "product_cat");
		foreach ( $terms as $term ) {
			$categories .= $term->name;
			if(end($terms) !== $term){
				$categories .= ", ";
			}
		}

		return $categories;
	}
}

if ( ! function_exists( 'engage_woocommerce_product_details' ) ) {
	add_action('woocommerce_after_shop_loop_item_title', 'engage_woocommerce_product_details', 10);

	function engage_woocommerce_product_details() {
		echo '<div class="vntd-product-details btn btn-style-default btn-dark btn-icon accent-hover-bg"><i class="fa fa-file-text-o"></i>' . engage_translate( 'view-details' ) . '</div>';

		echo '<div class="vntd-product-price">';
			woocommerce_template_loop_price();
			echo '<div class="vntd-product-rating">';
				woocommerce_template_loop_rating();
			echo '</div>';

		echo '</div>';


		echo '</div>'; // End details
	}
}

add_action('woocommerce_shop_loop_item_title', 'engage_woocommerce_shop_loop_item_title');

if(!function_exists('engage_woocommerce_shop_loop_item_title')) {
	function engage_woocommerce_shop_loop_item_title() {
		echo '<h3 class="vntd-product-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
	}
}


//
// Nav Cart
//

if ( !function_exists( 'engage_woo_nav_cart' ) ) {
	function engage_woo_nav_cart() {
		global $woocommerce;

		$inactive = 'nav-cart-empty';
		$cart_count = $woocommerce->cart->get_cart_contents_count();
		if ( $cart_count > 0 ) $inactive = ' nav-cart-active';

		$cart_url = wc_get_cart_url();

		return '<li id="woo-nav-cart" class="crt-tool nav-cart ' . esc_attr( $inactive ) . '"><a href="' . esc_url( $cart_url ) . '" class="tools-btn"><span class="tools-btn-icon"><i class="engage-icon-icon engage-icon-bag-09"></i></span><span id="woo-cart-count" class="woo-cart-count">' . esc_attr( $cart_count ) . '</span></a><ul class="dropdown-menu pull-right clearfix nav-cart-products">
			<div class="widget_shopping_cart"><div class="widget_shopping_cart_content"></div></div>
		</ul></li>';


	}
}

// Related Products

if(!function_exists('woo_related_products_limit')) {
	function woo_related_products_limit() {
	  global $product;

		$args['posts_per_page'] = 6;
		return $args;
	}
}

if(!function_exists('engage_jk_related_products_args')) {
	add_filter( 'woocommerce_output_related_products_args', 'engage_jk_related_products_args' );
	function engage_jk_related_products_args( $args ) {

		$args['posts_per_page'] = 4; // 4 related products
		$args['columns'] = 4; // arranged in 2 columns
		return $args;
	}
}

if(!function_exists('engage_loop_shop_per_page')) {
	add_filter( 'loop_shop_per_page', 'engage_loop_shop_per_page', 20 );

	function engage_loop_shop_per_page() {
		return 12;
	}
}

//
// Advanced Filters
//

// Remove default filters:

if ( ! has_filter( 'engage_enable_woocommerce_catalog_ordering' ) ) {
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
}

// Add custom ones:

if(!function_exists('engage_woocommerce_filters')) {
	add_action('woocommerce_before_shop_loop', 'engage_woocommerce_filters', 10);
	function engage_woocommerce_filters() {


		$orderby = $order = null;

		if(isset($_GET['product_orderby'])) {
			$orderby = $_GET['product_orderby'];
		}
		if(isset($_GET['product_order'])) {
			$order = $_GET['product_order'];
		}

		if(!$orderby) $orderby = engage_translate( 'default-order' );
		//

		$output = '<div id="vntd-woocommerce-heading">';

		$output .= '<ul id="vntd-woocommerce-filters" class="vntd-woocommerce-filters product-filters"><li class="product-orderby"><span>'. engage_translate( 'sort-by' ) .' <strong>'.ucfirst($orderby).'</strong><i class="fa fa-angle-down"></i></span><ul>';

		// OrderBy

		$orderby_list = array('default' => engage_translate( 'default-order' ),'title' => engage_translate( 'name' ),'price' => engage_translate( 'price' ),'date' => engage_translate( 'date' ),'popularity' => engage_translate( 'popularity' ) );

		foreach($orderby_list as $single_order) {

			$params_orderby = array_merge($_GET, array("product_orderby" => array_search($single_order,$orderby_list)));
			$params_orderby_url = http_build_query($params_orderby);

			$output .= '<li><a href="?'.$params_orderby_url.'">'.engage_translate( 'sort-by' ).' '.$single_order.'</a></li>';
		}

		$output .= '</ul></li>';

		// Order

		if(!$order || $order == 'asc') {
			$order_opposite = 'desc';
			$arrow_direction = 'down';
		} else {
			$order_opposite = 'asc';
			$arrow_direction = 'up';
		}

		$params_order = array_merge($_GET, array("product_order" => $order_opposite));
		$params_order_url = http_build_query($params_order);

		$output .= '<li class="product-order"><a href="?'.$params_order_url.'"><i class="fa fa-angle-'.$arrow_direction.'"></i></a></li>';

		// Product Count

		if(isset($_GET['product_count'])) {
			$current_count = $_GET['product_count'];
		} else {
			$current_count = 0;
		}
		$products_count = get_option('posts_per_page');
		$products_count = 12;

		if(!$current_count) $current_count = $products_count;

		$output .= '<li class="product-count"><span>' . engage_translate( 'show' ) . ' <strong>'.$current_count.' '. engage_translate( 'products' ) .'</strong><i class="fa fa-angle-down"></i></span><ul>';

		$count_array = array($products_count,$products_count*2,$products_count*3,$products_count*4);

		foreach ($count_array as $count) {
			$params_count = array_merge($_GET, array("product_count" => $count));
			$output .= '<li><a href="?'.http_build_query($params_count).'">'. engage_translate( 'show' ) .' <span>'.$count.' '. engage_translate( 'products' ) .'</span></a></li>';
		}

		$output .= '</ul></li></ul>';

		$output .= '</div>';

		echo '' . $output;
	}
}

//
// Ordering
//

if(!function_exists('engage_woocommerce_ordering')) {
	add_action('woocommerce_get_catalog_ordering_args', 'engage_woocommerce_ordering', 20);
	function engage_woocommerce_ordering($args) {

		$orderby = $order = null;

		if(isset($_GET['product_orderby'])) {
			$orderby = $_GET['product_orderby'];
		}
		if(isset($_GET['product_order'])) {
			$order = $_GET['product_order'];
		}

		if($order) $args['order'] = $order;
		if($orderby && $orderby != 'price' && $orderby != 'popularity') $args['orderby'] = $orderby;

		if($orderby == 'price') {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = '_price';
		}elseif($orderby == 'popularity'){
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = 'total_sales';
		}

		return $args;

	}
}

//
// Product Count
//

if(isset($_GET['product_count'])) {
	$product_count = $_GET['product_count'];
} else {
	$product_count = false;
}

if ( $product_count ) {
	add_filter( 'loop_shop_per_page', 'engage_custom_loop_shop_per_page', 20 );
	function engage_custom_loop_shop_per_page() {
		if ( isset ( $_GET['product_count'] ) ) {
			return esc_html( $_GET['product_count'] );
		} else {
			return 12;
		}
	}
}
