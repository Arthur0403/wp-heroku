<?php

/* Template Name: Contact Page */

$post = $wp_query->post;
get_header();

$layout = engage_page_layout();
$general_layout = engage_general_layout( $layout );
$sidebar_width = engage_sidebar_width();
$page_width = engage_page_width();
$container_class = engage_container_class( $page_width );

// Contact Page Related

// Columns width

$col_form_width = '8';
$col_content_width = '4';
$contact_page_class = 'side';

if ( engage_option( 'contact_layout' ) == 'fullwidth' ) {
	$col_form_width = '12';
	$contact_page_class = 'fullwidth';
} elseif ( engage_option( 'contact_form_width' ) == '1_2' ) {
	$col_form_width = $col_content_width = '6';
}

// Map related

$google_map = '';

if ( engage_option( 'contact_map' ) != false && class_exists( 'Engage_Core' ) ) {

	$map_classes = $map_container = '';

	if ( engage_option( 'contact_map_width' ) != 'contain' ) {
		$map_container = '-stretch';
		$map_classes .= ' contact-map-fullwidth';
		$contact_page_class .= ' map-stretch';
	} else {
		$map_classes .= ' contact-map-contain';
	}

	if ( engage_option( 'contact_map_position' ) != 'after' ) {
		$contact_page_class .= ' map-before';
	} else {
		$contact_page_class .= ' map-after';
	}

	// Map Style

	$map_style = 'light';

	if ( engage_option( 'contact_map_style' ) != '' ) {
		$map_style = engage_option( 'contact_map_style' );
	}

	// Map Height

	$map_height = 500;
	if ( engage_option( 'contact_map_height' ) != '' ) {
		$map_height = str_replace( 'px', '', engage_option( 'contact_map_height' ) );
	}

	// Map address
	$address = engage_option( 'contact_map_address' );

	// Map output
	if ( $address == '' ) {
		esc_html_e( 'Please enter your map address in Theme Options / Contact Page', 'engage' );
	} else {

		$map_zoom = engage_option( 'contact_map_zoom' );
		if ( $map_zoom == '' || !$map_zoom ) $map_zoom = 14;

		$google_map = '<div class="contact-page-map' . esc_attr( $map_classes ) . '"><div class="container' . esc_attr( $map_container ) . '">';
		$google_map .= do_shortcode( '[vntd_gmap height="' . $map_height . '" map_style="' . esc_attr( $map_style ) . '" marker_color="' . engage_option( 'contact_marker_color' ) . '" address="' . esc_attr( $address ) . '" marker_title="' . esc_html( engage_option( 'contact_marker_title' ) ) . '" marker_text="' . esc_html( engage_option( 'contact_marker_text' ) ) . '" zoom="' . esc_attr( $map_zoom ) . '"]' );
		$google_map .= '</div></div>';

	}

}

?>

<section class="section-page <?php echo esc_attr( $general_layout ); ?> page-layout-<?php echo esc_attr( $layout ); ?> sidebar-width-<?php echo esc_attr( $sidebar_width ); ?> page-width-<?php echo esc_attr( $page_width ); ?> page-contact-<?php echo esc_attr( $contact_page_class ); ?>"<?php engage_page_content_styles(); ?>>

	<?php

	if ( $google_map != '' && engage_option( 'contact_map_position' ) != 'after' ) {
		echo '' . $google_map;
	}

	?>

	<div class="container<?php echo esc_attr( $container_class ); ?>">

		<div class="row main-row">

			<div id="page-content" class="page-content">

			<?php

			// Content column if fullwidth layout

			if ( engage_option( 'contact_layout' ) == 'fullwidth' ) {

				// Page Content Loop

				if (have_posts()) : while (have_posts()) : the_post();

					the_content();

					wp_link_pages();

				endwhile; endif;

			}

			// Contact Form

			?>

			<div id="contact-page-content" class="row">

				<div class="contact-form-column col-md-<?php echo esc_attr( $col_form_width ); ?>">

				<?php

				if ( class_exists( 'Engage_Core' ) ) {
					echo do_shortcode( '[engage_contact_form]' );
				} else {
					echo '<p class="engage-core-absence">' . esc_html__( 'Please install and activate the Engage Core plugin to use the contact form.', 'engage' ) . '</p>';
				}

				?>

			    </div>

			    <?php

			    if ( engage_option( 'contact_layout' ) != 'fullwidth' ) {

				    echo '<div class="contact-content-column col-md-' . $col_content_width . '">';

				    // Page Content Loop

				    if (have_posts()) : while (have_posts()) : the_post();

				    	the_content();

				    	wp_link_pages();

				    endwhile; endif;

				    echo '</div>';

			    }

			    ?>

		    </div>

		    </div>

			<?php

			// Page Sidebar

			if ( $layout != "no_sidebar" ) {
				get_sidebar();
			}

			?>

		</div>

	</div>

	<?php

	if ( $google_map != '' && engage_option( 'contact_map_position' ) == 'after' ) {
		echo '' . $google_map;
	}

	?>

	<?php

	if ( comments_open() ) {
		echo '<div class="page-comments post-comments"><div class="container' . esc_attr( $container_class ) . '">';
		comments_template();
		echo '</div></div>';
	}

	?>

</section>

<?php get_footer(); ?>
