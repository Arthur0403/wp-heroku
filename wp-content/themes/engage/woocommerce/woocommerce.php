<?php 
$post = $wp_query->post;
get_header(); 
$layout = "fullwidth";
$page_width = "content";
$page_links = '';

if(is_shop()) {
	$layout = get_post_meta(get_option('woocommerce_shop_page_id'), 'page_layout', true);
}
$shop_cols = 4;
if(engage_option('shop_grid_cols')) $shop_cols = engage_option('shop_grid_cols');

?>

<div class="page-holder page-layout-<?php echo esc_attr($layout); ?> woocommerce-shop-page woocommerce-shop-cols-<?php echo esc_attr($shop_cols); ?>">
		
	<?php 		
	
	
	
	// If Visual Composer is not enabled for the page
	if(!engage_vc_active() || $layout == 'sidebar_right' || $layout == 'sidebar_left') echo '<div class="inner">';		
	
	if($layout != "fullwidth" || $layout == 'fullwidth' && !engage_vc_active()) {
		echo '<div class="page_inner">';
	}
	
	if (have_posts()) : while (have_posts()) : the_post(); 
	        
		woocommerce_content();
	          
	endwhile; endif; 	     
	
	if($layout != "fullwidth" || $layout == 'fullwidth' && !engage_vc_active()) {
		echo '</div>';		
	}
	
	if($layout != "fullwidth") {
		get_sidebar();    
	}
	
	if(!engage_vc_active() || $layout == 'sidebar_right' || $layout == 'sidebar_left') echo '</div>';
	
	if($page_links == 'yes') {
		wp_link_pages();
	}
	
	?>

</div>

<?php get_footer(); ?>