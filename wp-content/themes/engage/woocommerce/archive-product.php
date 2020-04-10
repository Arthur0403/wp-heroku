<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

$layout = engage_page_layout();

$shop_cols = 4;
if ( engage_option( 'shop_cols' ) ) $shop_cols = engage_option('shop_cols');

$general_layout = engage_general_layout( $layout );
$sidebar_width = engage_sidebar_width();
$page_width = engage_page_width();
$container_class = engage_container_class( $page_width );

if ( isset($_GET['layout'])) {
	switch($_GET['layout']) {
		case 'fullwidth4' :
			$shop_cols = 4;
			$general_layout = 'page-layout-no-sidebar';
			$layout = 'no_sidebar';
		break;
		case 'fullwidth3' :
			$shop_cols = 3;
			$general_layout = 'page-layout-no-sidebar';
			$layout = 'no_sidebar';
		break;
		case 'sidebar3' :
			$shop_cols = 3;
			$layout = 'sidebar_right';
		break;
		case 'sidebar2' :
			$shop_cols = 2;
			$layout = 'sidebar_right';
		break;
	}
}

$shop_style = 'classic';
if ( engage_option( 'shop_style' ) ) $shop_style = engage_option('shop_style');

?>

<section class="section-page <?php echo esc_attr( $general_layout ); ?> page-layout-<?php echo esc_attr( $layout ); ?> sidebar-width-<?php echo esc_attr( $sidebar_width ); ?> page-width-<?php echo esc_attr( $page_width ); ?> woocommerce-shop-page woocommerce-shop-cols-<?php echo esc_attr($shop_cols); ?> woocommerce-style-<?php echo esc_attr( $shop_style ); ?>"<?php engage_page_content_styles(); ?>>


	<div class="container<?php echo esc_attr( $container_class ); ?>">

		<div class="row main-row">

			<div id="page-content" class="page-content">

			<?php

				/**
				 * woocommerce_before_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */
				do_action( 'woocommerce_before_main_content' );
			?>

				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

					<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

				<?php endif; ?>

				<?php do_action( 'woocommerce_archive_description' ); ?>

				<?php if ( have_posts() ) : ?>

					<?php
						/**
						 * woocommerce_before_shop_loop hook
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						do_action( 'woocommerce_before_shop_loop' );
					?>

					<?php woocommerce_product_loop_start(); ?>

						<?php woocommerce_product_subcategories(); ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>

					<?php woocommerce_product_loop_end(); ?>

					<?php
						/**
						 * woocommerce_after_shop_loop hook
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
					?>

				<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

					<?php wc_get_template( 'loop/no-products-found.php' ); ?>

				<?php endif; ?>

			<?php
				/**
				 * woocommerce_after_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );
			?>

			<?php
				/**
				 * woocommerce_sidebar hook
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */

			?>

			</div>

			<?php

			if ( $layout != "no_sidebar" ) {

				get_sidebar();
			}

			?>

		</div>

	</div>

</section>

<?php

get_footer( 'shop' ); ?>
