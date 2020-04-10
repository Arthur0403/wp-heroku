( function ( $ ) {
	'use strict';
	
	jQuery(document).ready(function() {
	
		// Carousel
		
		$(".vntd-carousel").each(function() {
		
			var $owl = $(this);
			
			$owl.on('initialized.owl.carousel', function(event) {
			    $owl.closest('.vntd-carousel-holder').css({'opacity':1, 'max-height':'9999px'});
			});
			
			var autoplay,animateIn,animateOut;
			
			var autoplayTimeout = 7000;
			
			autoplay = $owl.data('autoplay');
			
			autoplayTimeout = $owl.data('autoplay-timeout');
			
			var mouseDrag = true;
			animateIn = animateOut = false;
			
			// Default values
			
			var colsMobile = 1;
			var colsTablet = 2;
			var cols = 3;
			var RTL = false;
			
			if ( $owl.data( 'cols' ) ) cols = $owl.data( 'cols' );
			if ( $owl.data( 'cols-tablet' ) ) colsTablet = $owl.data( 'cols-tablet' );
			if ( $owl.data( 'cols-mobile' ) ) colsMobile = $owl.data( 'cols-mobile' );
			
			if ( $('body').hasClass( 'rtl' ) ) RTL = true;
			
			$owl.owlCarousel({
			 	items : cols,
			 	responsive : {
			 	    0 : {
			 	        items: colsMobile,
			 	    },
			 	    768 : {
			 	        items: colsTablet,
			 	    },
			 	    1000 : {
			 	        items: cols,
			 	    }
			 	},
			 	rtl : RTL,
				dots : jQuery(this).data('dots'),
				nav : jQuery(this).data('nav'),
				mouseDrag : mouseDrag,
			 	stopOnHover : true,
			 	slideSpeed : 700,
			 	paginationSpeed : 900,
			 	rewindSpeed : 1100,
			 	margin: jQuery(this).data('margin'),
			 	callbacks: true,
			 	autoplayHoverPause: true,
			 	autoplayTimeout: autoplayTimeout,
			 	autoplay: autoplay,
			 	loop: true,
			 	animateIn: animateIn,
			 	animateOut: animateOut
			 });
			 
		});
		
	
	}); // End (document).ready
	
}( jQuery ));