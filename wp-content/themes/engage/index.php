<?php 

get_header(); 

$post_id = get_the_ID();

if ( is_home() ) {
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
				
				$masonry_cols = 4;
				
				if ( $blog_style == 'masonry' ) {
					
					engage_blog_masonry_activate();
					
					if ( engage_option( 'blog_masonry_cols' ) ) {
						$masonry_cols = engage_option( 'blog_masonry_cols' );
					}
					$extra_classes[] = 'blog-grid';
					$extra_classes[] = 'grid';
					$extra_classes[] = 'grid-' . $masonry_cols;
				}
				
				if ( engage_option( 'blog_boxed' ) == 'boxed_no_border' ) {
					$extra_classes[] = 'blog-boxed-solid';
				} elseif ( engage_option( 'blog_boxed' ) == 'not_boxed' ) {
					$extra_classes[] = 'blog-not-boxed';
				} else {
					$extra_classes[] = 'blog-boxed-border';
				}
				
				?>
			
				<div class="posts-container <?php echo implode( ' ', $extra_classes ); ?>"<?php if( $blog_style == 'masonry' ) echo ' data-cols="' . esc_attr( $masonry_cols ) . '" data-item-gap="25"'; ?>>
		
				<?php
				
				if ( have_posts() ) : while ( have_posts() ) : the_post(); 
				        
					engage_blog_post( $layout, $blog_style );
				          
				endwhile; endif;
				
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