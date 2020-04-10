jQuery(document).ready(function ($) {

	'use strict';

		if( $( '.blog-inner' ).length > 0 ) {
			vntd_ajax_blog();
		}

		if( $( '#portfolio-load-posts a' ).length > 0 ) {
			vntd_ajax_portfolio();
		}

		// Portfolio Ajax

		function vntd_ajax_portfolio() {

			// The number of the next page to load (/page/x/).
		    var pageNum = parseInt( pbd_alp_portfolio.startPage ) + 1;

		    // The maximum number of pages the current query can return.
		    var max = parseInt( pbd_alp_portfolio.maxPages );

		    // The link of the next page of posts.
		    var nextLink = pbd_alp_portfolio.nextLink;

		    $( '#portfolio-load-posts a' ).on( 'click', function () {

		    	if( $(this).hasClass( 'ajax-no-posts') ) return false;

		        // Are there more posts to load?
		        if ( pageNum <= max ) {
		            // Show that we're working.

	            	$(this).html( pbd_alp_portfolio.labelLoading + ' <div class="spinner-ajax"></div>' );
	            	$(this).find( '.spinner-ajax' ).css( 'opacity', 1 );

		            $.get( nextLink, function (data) {
		                pageNum++;
		                nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/' + pageNum);

		                if ( pageNum <= max ) {
		                    $( '#portfolio-load-posts a.load-more-button' ).text( pbd_alp_portfolio.labelLoadMore );
		                } else {
		                    $( '#portfolio-load-posts a.load-more-button' ).text( pbd_alp_portfolio.labelNoMore ).addClass( 'ajax-no-posts' );
		                }


		            }).done( function (data) {

		                var $newItems = $(data).find( '.portfolio-items .item' );

		                $newItems.find( 'img' ).on( "load", function () {

		                	var $holder = $( '.portfolio-items' );

		                    if( $holder.length !== 0 ) {

		                    	$( '.portfolio-items' ).cubeportfolio( 'appendItems', $newItems, function() {

		                    	});

		                    }

		                });


		            });


		        } else {

		        }

		        return false;
		    });

		}

		function gridRelayout() {

			if ( jQuery('.engage-swiper-slider').length > 0 ) {
				$( '.engage-swiper-slider:not(.vntd-ready)' ).each( function() {
					engage_init_swiper( $(this) );
				});
			}


			if ( jQuery('.video-js').length > 0 ) {
				handleVideo();
			}

		};

		function newPostsInit() {

			if ( jQuery('.engage-swiper-slider:not(.vntd-ready)').length > 0 ) {
				jQuery( '.engage-swiper-slider:not(.vntd-ready)' ).each( function() {
					engage_init_swiper( $(this) );
				});
			}

			if ( jQuery('.video-js:not(.vntd-ready)').length > 0 ) {
				jQuery( '.video-js:not(.vntd-ready)' ).each( function() {
					handleSingleVideo( $(this) );
				});
			}

		}

		// Blog Pagination

		function vntd_ajax_blog() {

			$('.blog-pagination').remove();

			// The number of the next page to load (/page/x/).
		    var pageNum = parseInt(pbd_alp_blog.startPage) + 1;

		    // The maximum number of pages the current query can return.
		    var max = parseInt(pbd_alp_blog.maxPages);

		    // The link of the next page of posts.
		    var nextLink = pbd_alp_blog.nextLink;

		    /**
		         * Load new posts when the link is clicked.
		         */
		    $( '#ajax-load-posts a' ).on( 'click', function () {

		    	var $button = $(this);

		    	var labelMore = $button.data( 'label-active' );
		    	var labelLoading = $button.data( 'label-loading' );
		    	var labelEnd = $button.data( 'label-end' );

		        // Are there more posts to load?
		        if ( pageNum <= max ) {

		            // Show that we're working.
		            $(this).html( labelLoading + ' <div class="spinner-ajax"></div>');
		            $(this).find('.spinner-ajax').css('opacity',1);

		            $.get(nextLink, function (data) {
		                pageNum++;
		                nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/' + pageNum);

		                if (pageNum <= max) {
		                    $('#ajax-load-posts a').text( labelMore );
		                } else {
		                    $('#ajax-load-posts a').text( labelEnd ).addClass('ajax-no-posts');
		                }


		            }).done(function (data) {

		                var $newItems = $(data).find('.blog .post');

		                $newItems.find('img').on( "load", function () {

		                	var $holder = $( '.posts-container' );

		                    if ( $holder.hasClass( 'blog-style-masonry' ) ) {

								$holder.cubeportfolio( 'appendItems', $newItems, function() {

								});

								$holder.on( 'pluginResize.cbp', function() {
									newPostsInit();
									$holder.cubeportfolio( 'layout', function() {
										console.log( 'relayout done' );
									});
								});

		                    } else {

								$newItems.css({'display' : 'none', 'opacity' : 1});
								$newItems.appendTo( $holder ).slideDown( 'slow' );

								setTimeout( function() {
									newPostsInit();
								}, 100 );
							}

		                });


		            });


		        } else {
		            //$('#ajax-load-posts a').append('.');
		        }

		        return false;
		    });

		}

	});
