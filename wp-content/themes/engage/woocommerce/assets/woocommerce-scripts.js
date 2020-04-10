/*
 * ---------------------------------------------------------------- 
 *  
 *  WooCommerce custom javascripts
 *  
 * ----------------------------------------------------------------  
 */


jQuery(document).ready(function($) {

	vntd_add_to_cart_action();
	vntd_add_to_cart_data();
    
    if(jQuery('#vntd-woocommerce-layout-switcher').length !== 0) {
    	jQuery(this).find('li').on('click', function(){
    		if(!jQuery(this).hasClass('active-item')) {
	    		jQuery(this).closest('ul').find('li').removeClass('active-item');
	    		jQuery(this).addClass('active-item');
	    		
	    		var layout = jQuery(this).data('layout');
	    		
	    		if(layout == "grid") {
	    			jQuery('.woocommerce-shop-page').removeClass('woocommerce-layout-list').addClass('woocommerce-layout-'+layout);
	    		} else {
	    			jQuery('.woocommerce-shop-page').removeClass('woocommerce-layout-grid').addClass('woocommerce-layout-'+layout);
	    		}
	    		
	    	}
    	});
    }
	
});

var currentItem = '';
var count;
function vntd_add_to_cart_action() {
	
	jQuery('body').bind('added_to_cart', function()
	{

		jQuery('#woo-nav-cart').removeClass('nav-cart-empty').addClass('nav-cart-active');
		
		var num = parseInt(jQuery('.woo-cart-count').html());
		jQuery('.woo-cart-count').html(++num)

	});
	
}

var newWooProduct = {};
function vntd_add_to_cart_data()
{
	jQuery('body').on('click','.add_to_cart_button', function()
	{	

		var productContainer	= jQuery(this).parents('.product').eq(0), product = {};
			product.name		= productContainer.find('h3').text();
			product.img		 	= productContainer.find('.product-thumbnail img.wp-post-imag');
			product.price	 	= productContainer.find('.price .amount').last().text().replace(/[^0-9\.]+/g, '');
			
			newWooProduct = product;

	});
}