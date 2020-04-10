( function ( $ ) {
	'use strict';

	// On document ready

	jQuery(document).ready(function() {

		var $videoElement = $('.video-js');

		if ( $videoElement.length > 0 ) {
			handleVideo();
		}

	});

	// On window resize

	$(window).resize(function() {
		handleVideo();
	});

	// Handle self hosted videos


}( jQuery ));

function handleVideo() {

    jQuery('.video-js').each( function() {

    	var $videoObject = jQuery(this);
    	//handleSingleVideo( $videoObject );

    	if ( $videoObject.closest( '.blog-style-masonry' ).length > 0 && !$videoObject.closest( '.blog-style-masonry' ).hasClass( 'cbp-ready' ) ) {
    		$videoObject.closest( '.blog-style-masonry' ).on( 'initComplete.cbp', function() {
    			handleSingleVideo( $videoObject );
    		});
    	} else {
    		handleSingleVideo( $videoObject );
    	}


    });

}

function handleSingleVideo( $videoObject ) {

		//var $videoObject = $(this);

		$videoObject.css( 'height', '' );
		$videoObject.css( 'width', '' );

        var videoWidth = $videoObject.width();
        var videoHeight = videoWidth * 0.5625;
        var videoId = $videoObject.attr('id');

        $videoObject.css( 'height', videoHeight );

		if ( $videoObject.find( 'video' ).length > 0 ) {
		}

        if ( $videoObject.hasClass('full-video') ) {
            $videoObject.css('height', videoHeight);
            $videoObject.parents('header').css('height', videoHeight);
        }
        if ( $videoObject.parents('header').length ) {
           $videoObject.parents('header').css('height', videoHeight);
        }
        if ( $videoObject.data('poster') ) {
            $videoObject.find('.vjs-poster').remove();
            var currentPoster = $videoObject.data('poster');
            $videoObject.append('<div class="vjs-poster" tabindex="-1" style="background-image: url(&quot;'+ currentPoster +'&quot;);"></div>');
        }

        var myPlayer = videojs( videoId );

        var videoPlaying = false;
        if ( $videoObject.parents('header').length == 0 ) {
            jQuery('#' + videoId).on( 'click', function() {
                if (videoPlaying) {
                    myPlayer.pause();
                    videoPlaying = false;
                } else {
                    myPlayer.play();
                    videoPlaying = true;
                }
            });
        }

        $videoObject.addClass( 'vntd-ready' );

	}
