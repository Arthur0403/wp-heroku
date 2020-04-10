<?php 
$post = $wp_query->post;
$post_id = $post->ID;
get_header(); 

$layout = 'no_sidebar';
$general_layout = 'page-layout-no-sidebar';
$page_width = 'default';
$container_class = engage_container_class();
$page_content_class = 'col-md-12';

$css_classes = array();

$css_classes[] = $general_layout;
$css_classes[] = 'page-layout-' . esc_attr( $layout );

// Define page width

if( get_post_meta( get_the_ID(), "page_width", true ) ) {
	$page_width = get_post_meta( get_the_ID(), "page_width", true );
}

$css_classes[] = 'page-width-' . esc_attr( $page_width );

// Portfolio Post Layout (Fullwidth or Side)

$post_layout = 'side';

if( ( $value = get_post_meta( get_the_ID(), "portfolio_layout", true ) ) != '' || ( $value = engage_option( 'portfolio_layout' ) ) == 'fullwidth' ) {
	$post_layout = $value;
}

if ( engage_option_true( 'portfolio_media_display' ) == true ) {
	$css_classes[] = 'portfolio-with-media';
} else {
	$css_classes[] = 'portfolio-no-media';
}

if ( engage_option_true( 'portfolio_details_display' ) == true ) {
	$css_classes[] = 'portfolio-with-details';
} else {
	$css_classes[] = 'portfolio-no-details';
}

$css_classes[] = 'portfolio-layout-' . $post_layout;

if ( engage_option( 'portfolio_details_display' ) != 'no' && engage_option( 'portfolio_details_display' ) == true ) {
	// Properly checked
}

?>

<section class="section-page portfolio-post <?php echo implode( ' ', $css_classes ); ?>"<?php engage_page_content_styles(); ?>>
	
	<div class="container<?php echo esc_attr( $container_class ); ?>">
	
		<div class="row main-row">
		
			<div id="page-content" class="page-content portfolio-holder">
				
				<?php
				
				// Portfolio Post Media
				
				if ( engage_option_true( 'portfolio_media_display' ) == true && function_exists( 'engage_portfolio_media' ) ) { 
				
					engage_portfolio_media( $post_id, $post_layout );
					
				} // End Portfolio Post Media
				
				?>
			
				<div class="portfolio-content">
				
					<div class="portfolio-content-inner">
					
					<?php
					
					// Post Content
					
					if( engage_option_true( 'portfolio_project_heading' ) == true ) {
						echo '<h4 class="project-content-heading">' . engage_translate( 'about-project' ) . '</h4>';
					}
					
					if( ( $value = get_post_meta( $post_id, 'portfolio_info', true ) ) ) {
					
						$value = apply_filters( 'the_content', $value );
						echo '' . $value; // Use the metabox value
						
					} else {
						
						if ( have_posts() ) : while (have_posts()) : the_post(); 
						   
							the_content(); // Use the post content
						          
						endwhile; endif; 
						
					}
					
					?>
					
					</div>
				
					<?php
					
					//
					// Project Details
					//
					
					if ( engage_option_true( 'portfolio_details_display' ) == true ) { ?>
						
						<div class="project-details">
						
							<?php
							
							if ( engage_option_true( 'portfolio_details_heading' ) == true ) {
								echo '<h5 class="project-details-heading">' . engage_translate( 'project-details' ) . '</h5>';
							} ?>
							
							<ul class="project-details-list">
							
							<?php
							
							// Categories
							
							if( engage_option_true( 'portfolio_display_categories' ) == true ) {
								echo '<li><span class="detail-label">' . engage_translate( 'categories' ) . ':</span>';
								echo '<span class="detail-value">';
								
								engage_print_plain_terms( 'portfolio-category' );
								
								echo '</span></li>';
							}
							
							// Skills
							
							if( engage_option_true( 'portfolio_display_skills' ) == true ) {
								echo '<li><span class="detail-label">' . engage_translate( 'skills' ) . ':</span>';
								echo '<span class="detail-value">';
								
								engage_print_plain_terms( 'portfolio-skills' );
								
								echo '</span></li>';
							}
							
							// Demo URL
							
							if ( get_post_meta( $post_id, 'portfolio_link', true ) ) {
								echo '<li><span class="detail-label">' . engage_translate( 'project-url' ) . ':</span>';
								echo '<span class="detail-value"><a href="' . esc_url( get_post_meta( $post_id, 'portfolio_link', true ) ) . '" target="_blank">' . esc_url( get_post_meta( $post_id, 'portfolio_link', true ) ) . '</a></span></li>';
							}
							
							// Client
							
							if ( get_post_meta( $post_id, 'portfolio_client', true ) ) {
								$client = esc_html( get_post_meta( $post_id, 'portfolio_client', true ) );
								if( get_post_meta( $post_id, 'portfolio_client_url', true ) ) {
									$client = '<a href="' . esc_url( get_post_meta( $post_id, 'portfolio_client_url', true ) ) . '" target="_blank">' . $client . '</a>';
								}
								echo '<li><span class="detail-label">' . engage_translate( 'client' ) . ':</span>';
								echo '<span class="detail-value">' . $client . '</span></li>';
							}
							
							// Date
							
							if( get_post_meta( $post_id, 'portfolio_date', true ) ) {
								echo '<li><span class="detail-label">' . engage_translate( 'pdate' ) . ':</span>';
								echo '<span class="detail-value">' . esc_html( get_post_meta( $post_id, 'portfolio_date', true ) ) . '</span></li>';
							}
							
							// Budget
							
							if( get_post_meta( $post_id, 'portfolio_budget', true ) ) {
								echo '<li><span class="detail-label">' . engage_translate( 'budget' ) . ':</span>';
								echo '<span class="detail-value">' . esc_html( get_post_meta( $post_id, 'portfolio_budget', true ) ) . '</span></li>';
							}
							
							// Extra field 1
							
							if( ( $value = get_post_meta( $post_id, 'portfolio_extra1', true ) ) ) {
								echo '<li><span class="detail-label">' . esc_html( $value ) . ':</span>';
								echo '<span class="detail-value">' . esc_html( get_post_meta( $post_id, 'portfolio_extra1_value', true ) ) . '</span></li>';
							}
							
							?>
							
							</ul>
						
						</div>
						
						<?php
						
					}
					
					?>
								
				</div>
			
			</div>
		
		</div>
	
	</div>
	
	<?php
	
	// Post Nav
	
	if ( function_exists( 'engage_portfolio_post_nav' ) && engage_option_true( 'portfolio_navigation' ) == true ) {
		engage_portfolio_post_nav( $container_class );
	}
	
	?>

</section>

<?php get_footer(); ?>