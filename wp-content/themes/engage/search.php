<?php 

get_header(); 

$post_id = engage_get_id();

if( is_home() ) {
	$post_id = get_option( 'page_for_posts' );
}

$layout = engage_page_layout( $post_id );
$general_layout = engage_general_layout( $layout );
$sidebar_width = engage_sidebar_width( $post_id );
$page_width = engage_page_width( $post_id );
$container_class = engage_container_class( $page_width );

// Blog Style

$blog_style = 'classic';

if( engage_option('blog_style') && engage_option('blog_style') != 'classic' ) {
    $blog_style = engage_option('blog_style');
}

?>

<section class="section-page <?php echo esc_attr( $general_layout ); ?> page-layout-<?php echo esc_attr( $layout ); ?> sidebar-width-<?php echo esc_attr( $sidebar_width ); ?> page-width-<?php echo esc_attr( $page_width ); ?> blog blog-index">
	
	<div class="container<?php echo esc_attr( $container_class ); ?>">
	
		<div class="row main-row">
		
			<div id="page-content" class="page-content posts">
			
				<?php
				
				// Page Content Loop
				
				$extra_classes = array();
				
				$extra_classes[] = 'blog-style-' . $blog_style;
				
				if( engage_option( 'blog_boxed' ) == 'boxed_no_border' ) {
					$extra_classes[] = 'blog-boxed-solid';
				} elseif ( engage_option( 'blog_boxed' ) == 'not_boxed' ) {
					$extra_classes[] = 'blog-not-boxed';
				} else {
					$extra_classes[] = 'blog-boxed-border';
				}
				
				?>
			
				<div class="posts-container <?php echo implode( ' ', $extra_classes ); ?>"<?php if( $blog_style == 'masonry' ) echo ' data-masonry-cols="' . esc_attr( $masonry_cols ) . '"'; ?>>
		
				<?php
				
				if (have_posts()) : while (have_posts()) : the_post();
				
				 	engage_blog_post( $layout, $blog_style );
				 	
				endwhile;
				
				// Archive doesn't exist:
				else :
				
				    echo '<div class="vntd-nothing-found"><h2>' . esc_html__( 'Nothing found.', 'engage' ) . '</h2>';
				    
				    echo '<p>' . esc_html__( 'Sorry, but nothing matches your search criteria. Please try again with some different keywords', 'engage' ) . '.</p>';
				    
				    get_search_form();
				    
				    echo '</div>';
				
				endif;
				
				?>
				
				</div>
				
				<?php engage_pagination(); ?>
			
			</div>
			
			<?php
			
			// Page Sidebar
		
			if( $layout != "no_sidebar" ) {
				get_sidebar();    
			}
			
			?>
		
		</div>
	
	</div>

</section>

<?php get_footer(); ?>