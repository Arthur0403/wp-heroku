(function( $ ) {
	'use strict';

	$(function() {

		// Grab the wrapper for the Navigation Tabs
		var navTabs = $( '#authors-commentary-navigation').children( '.nav-tab-wrapper' ),
			tabIndex = null;

		/* Whenever each of the navigation tabs is clicked, check to see if it has the 'nav-tab-active'
		 * class name. If not, then mark it as active; otherwise, don't do anything (as it's already
		 * marked as active.
		 *
		 * Next, when a new tab is marked as active, the corresponding child view needs to be marked
		 * as visible. We do this by toggling the 'hidden' class attribute of the corresponding variables.
		 */
		navTabs.children().each(function() {

			$( this ).on( 'click', function( evt ) {

				evt.preventDefault();

				// If this tab is not active...
				if ( ! $( this ).hasClass( 'nav-tab-active' ) ) {

					// Unmark the current tab and mark the new one as active
					$( this ).siblings( '.nav-tab-active' ).removeClass( 'nav-tab-active' );
					$( this ).addClass( 'nav-tab-active' );

					// Save the index of the tab that's just been marked as active. It will be 0 - 3.
					tabIndex = $( this ).index();

					// Hide the old active content
					$( '#authors-commentary-navigation' )
						.children( 'div:not( .inside.hidden )' )
						.addClass( 'hidden' );

					$( '#authors-commentary-navigation' )
						.children( 'div:nth-child(' + ( tabIndex ) + ')' )
						.addClass( 'hidden' );

					// And display the new content
					$( '#authors-commentary-navigation' )
						.children( 'div:nth-child( ' + ( tabIndex + 2 ) + ')' )
						.removeClass( 'hidden' );

				}

			});
		});

		// Ready

		$(document).ready( function() {

			// Extra "Install Plugins" notices

			if ( $('.tgmpa.wrap > h1').length > 0 ) {
				$('.tgmpa.wrap td.plugin > strong').each( function(e) {
					if ( $(this).text() == 'Layer Slider' ) {
						$(this).closest( 'tr' ).after( '<tr class="plugin-update-tr"><td colspan="6" class="plugin-update colspanchange"><div class="update-message" style="padding-left: ">' +  VNTDWP.updateLayerSlider + '</div></td></tr>' );
					} else if ( $(this).text() == 'Classic Editor' ) {
						$(this).closest( 'tr' ).after( '<tr class="plugin-update-tr"><td colspan="6" class="plugin-update colspanchange"><div class="update-message">' +  VNTDWP.classicEditorInfo + '</div></td></tr>' );
					}
				});
			}

			// Check plugins

			if ( $('.wp-list-table.plugins').length > 0 ) {

				var plugins = [
					'js_composer/js_composer.php',
					'templatera/templatera.php',
					'LayerSlider/layerslider.php',
					'essential-grid/essential-grid.php',
					'revslider/revslider.php'
				];

				var infoText = VNTDWP.updateInfo;

				// Check if any updates available from within the theme
				var updatesAvailable = false;
				if ( $('#adminmenu a[href="themes.php?page=install-required-plugins"]').length > 0 ) {
					updatesAvailable = true;
					infoText = VNTDWP.updateInfoAvailable;
				}

				// Loop plugins
				for ( var i = 0; i < plugins.length; i++ ) {

					if ( $('.plugin-update-tr[data-plugin="' + plugins[ i ] + '"]').length > 0 ) {

						var $pluginTr = $('.plugin-update-tr[data-plugin="' + plugins[ i ] + '"]').prev( 'tr' );

						if ( plugins[ i ] != 'LayerSlider/layerslider.php' || $pluginTr.find( '.row-actions .update').length > 0 ) {
							var $el = $('.plugin-update-tr[data-plugin="' + plugins[ i ] + '"]');
							$el.find( '.update-message p' ).append( '<br><br>' + infoText );
						}

					} else if ( $( 'table.plugins tr[data-plugin="' + plugins[ i ] + '"] .row-actions span.update').length > 0 ) {
						var activeClass = '';
						if ( $( 'table.plugins tr[data-plugin="' + plugins[ i ] + '"]' ).hasClass( 'active' ) ) {
							activeClass = ' active';
						}
						$( 'table.plugins tr[data-plugin="' + plugins[ i ] + '"]').after( '<tr class="plugin-update-tr' + activeClass + '"><td colspan="3" class="plugin-update colspanchange"><div class="update-message notice inline notice-warning notice-alt"><p>' + infoText + '</p></div></td></tr>');
					}

				}

				// Extra Rev Slider checks
				if ( $( 'table.plugins tr[data-plugin="revslider/revslider.php"] + .plugin-update-tr + .plugin-update-tr').length > 0 ) {
					$( 'table.plugins tr[data-plugin="revslider/revslider.php"] + .plugin-update-tr + .plugin-update-tr .update-message').append( '<br><br>' + infoText );
				}

			}

		});

		$(window).load( function() {

			// Gutenberg default
			var selectedPostFormat = jQuery('.post-type-post #post-format-selector-0 option:selected').val();
			jQuery("[id^='redux-engage_options-metabox-blog_post_format_']");
			jQuery( '#redux-engage_options-metabox-blog_post_format_' + selectedPostFormat ).addClass('engage-metabox-active');

			// Gutenberg switch (now a dropdown...)
			jQuery('.post-type-post #post-format-selector-0').on( 'change', function(){
				jQuery("[id^='redux-engage_options-metabox-blog_post_format_']").removeClass('engage-metabox-active');
				var selectedFormat = jQuery('.post-type-post #post-format-selector-0 option:selected').val();
				//console.log( 'Selected:', selectedFormat );
				jQuery( '#redux-engage_options-metabox-blog_post_format_' + selectedFormat ).addClass('engage-metabox-active');

			});

		});

		$(document).ready( function() {

			// Default
			var post_format = jQuery('input[type=radio]:checked', '#formatdiv').val();

			//jQuery( "[id^='redux-engage_options-metabox-blog_post_format_']").hide();
			jQuery( '#redux-engage_options-metabox-blog_post_format_' + post_format ).addClass('engage-metabox-active');

			jQuery( '#formatdiv input[name=post_format]').change(function(){
				jQuery( "[id^='redux-engage_options-metabox-blog_post_format_']").removeClass('engage-metabox-active');
				jQuery( '#redux-engage_options-metabox-blog_post_format_' + jQuery('input[type=radio]:checked', '#formatdiv').val() ).addClass('engage-metabox-active');
			});



		});

		//
		// Pixel fields
		//

		jQuery( '.regular-text.pixel-field' ).after( '<span class="pixel-field-label">px</span>' );

		var currentTab;
		var reduxFooter = $( '#redux-footer' );

		//
		// Redux Quick Nav
		//

		$( '.redux-group-tab-link-a' ).on( 'click', function() {
			addReduxQuickNav( $(this) );
		});

		// On tab open

		if ( $( '.redux-group-tab-link-li.active' ).length > 0 ) {
			addReduxQuickNav( $( '.redux-group-tab-link-li.active' ).children( 'a' ) );
		}

		function addReduxQuickNav( $navElement ) {

			$( '#redux-quick-nav' ).remove();

			var $this = $navElement;
			var $parent = $this.closest( 'li' );
			var tabID = $this.data( 'key' );
			var sections = [];

			// Check if clicked menu parent nav element has subsections

			if ( $parent.hasClass( 'hasSubSections' ) ) {
				tabID++;
			}

			currentTab = tabID;

			// If has then need to add

			var tabSelector = '#' + tabID + '_section_group';
			var $content = $( tabSelector );

			if ( $content.find( '.redux-section-indent-start' ).length > 0 ) { // has subsections

				// Check if main section has any content, if yes then include it in nav

				sections[ $content.attr( 'id' ) ] = $content.children( 'h2' ).text();

				$content.find( '.redux-section-indent-start' ).each( function() { // Add other subsections
					if ( $(this).attr( 'id' ) ) {
						sections[ $(this).attr( 'id' ) ] = $(this).children( 'h3' ).text();
					}
				});

				// Get titles

				var $reduxNav = '<ul id="redux-quick-nav"><li><span>' + VNTDWP.t_addTemplate + ':</span></li>';

				for ( var key in sections ) {
					$reduxNav += '<li><a href="#' + key + '">' + sections[key] + '</a></li>';
				}

				reduxFooter.prepend( $reduxNav );

			}

		}

		// Redux quick nav smooth scroll

		$( '#redux-footer').delegate( '#redux-quick-nav a', 'click', function( event ) {

			jQuery('html,body').stop().animate({
				scrollTop: jQuery( $(this).attr('href') ).offset().top - 32 + "px"
			}, 400);

			event.preventDefault();

		});

		//

		$(document).on( "vc-full-width-row", function( event ) {

		});

		var $addTemplateBtn = $( '<div id="vntd-vc-add-template"><i class="vc-composer-icon vc-c-icon-add_template"></i> ' + VNTDWP.t_addTemplate + '</div>' );
		var $vcAdd = $( '#vc_not-empty-add-element' );
		$vcAdd.after( $addTemplateBtn );
		$vcAdd.append( $vcAdd.attr( 'title' ) );

		$( '.vc_welcome-visible-ne' ).delegate( '#vntd-vc-add-template', 'click', function ( e ) {
			e && e.preventDefault && e.preventDefault();
			vc.templates_panel_view.render().show(); // make sure we show our window :)
		});

	});

})( jQuery );
