<?php

$sidebar_id = get_post_meta( engage_get_id(), 'page_sidebar', true );

if ( is_archive() || is_search() ) {
	$sidebar_id = 'archives';
}

if ( !$sidebar_id || !is_active_sidebar( $sidebar_id ) ) {
	$sidebar_id = 'default_sidebar';
}

if ( class_exists( 'Woocommerce' ) ) {
	if( ( is_shop() || is_product_category() || is_product_tag() ) && is_active_sidebar( 'woocommerce_shop' ) ) {
		$sidebar_id = "woocommerce_shop";
	}
}

// Sidebar classes

$sidebar_classes = '';

if ( engage_option( 'widgets_separator' ) == 'no' ) {
	$sidebar_classes .= ' widgets-no-separator';
} else {
	$sidebar_classes .= ' widgets-with-separator';
}

?>

<div id="sidebar" class="sidebar sidebar-primary<?php echo esc_attr( $sidebar_classes ); ?>">
	<div class="sidebar-wrapper">
	<?php
		if ( ! is_active_sidebar( $sidebar_id ) ) {
			esc_html_e( 'Please add widgets to your sidebar in Appearance / Widgets menu.', 'engage' );
		} else {
			if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( $sidebar_id ) );
		}
	?>
	</div>
</div>

<?php

if( engage_page_layout() == 'sidebar_both' ) {

	$sidebar2_id = 'sidebar_secondary';

	?>

	<div id="sidebar2" class="sidebar sidebar-secondary<?php echo esc_attr( $sidebar_classes ); ?>">

		<?php if ( is_active_sidebar( $sidebar2_id ) ) { ?>

		<div class="sidebar-wrapper">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $sidebar2_id ) ) ?>
		</div>

		<?php
		} else { // Secondary sidebar not active
			echo '<p class="vntd-info">' . esc_html__( 'Your Secondary Sidebar is empty. Please go to Appearance / Widgets and add new widgets to your Secondary Sidebar.', 'engage' ) . '</p>';
		}
		?>

	</div>

<?php

}

?>
