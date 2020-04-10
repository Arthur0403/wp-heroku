jQuery( function ( $ ) {
	'use strict';

	/**
	 * ---------------------------------------
	 * ------------- Events ------------------
	 * ---------------------------------------
	 */

	/**
	 * No or Single predefined demo import button click.
	 */
	$( '.js-ocdi-import-data' ).on( 'click', function () {

		// Reset response div content.
		$( '.js-ocdi-ajax-response' ).empty();

		// Prepare data for the AJAX call
		var data = new FormData();
		data.append( 'action', 'ocdi_import_demo_data' );
		data.append( 'security', ocdi.ajax_nonce );
		data.append( 'selected', $( '#ocdi__demo-import-files' ).val() );
		if ( $('#ocdi__content-file-upload').length ) {
			data.append( 'content_file', $('#ocdi__content-file-upload')[0].files[0] );
		}
		if ( $('#ocdi__widget-file-upload').length ) {
			data.append( 'widget_file', $('#ocdi__widget-file-upload')[0].files[0] );
		}
		if ( $('#ocdi__customizer-file-upload').length ) {
			data.append( 'customizer_file', $('#ocdi__customizer-file-upload')[0].files[0] );
		}
		if ( $('#ocdi__redux-file-upload').length ) {
			data.append( 'redux_file', $('#ocdi__redux-file-upload')[0].files[0] );
			data.append( 'redux_option_name', $('#ocdi__redux-option-name').val() );
		}

		// AJAX call to import everything (content, widgets, before/after setup)
		ajaxCall( data );

	});


	/**
	 * Grid Layout import button click.
	 */
	$( '.js-ocdi-gl-import-data' ).on( 'click', function () {
		var selectedImportID = $( this ).val();
		var $itemContainer   = $( this ).closest( '.js-ocdi-gl-item' );
		// If the import confirmation is enabled, then do that, else import straight away.
		if ( ocdi.import_popup ) {
			displayConfirmationPopup( selectedImportID, $itemContainer );
		} else {
			gridLayoutImport( selectedImportID, $itemContainer );
		}
	});
    
    // Veented
    // Demo Page Import button
    
    
    $( '#select-demo' ).on( 'change', function() {
        
        $( '.select-demo-page' ).hide();
        
        var selectedDemo = $( '#select-demo' ).val();
        
        $( '.select-demo-page[data-demo="' + selectedDemo + '"]' ).show();
        
        var selectedPageTitle = $( '.select-demo-page[data-demo="' + selectedDemo + '"] option:selected' ).text();
        
        $( '#page-new-title' ).val( selectedPageTitle );
        
    });
    
    $( '.select-demo-page' ).on( 'change', function() {
        
        var selectedPageTitle = $( this ).find( 'option:selected' ).text();
        
        $( '#page-new-title' ).val( selectedPageTitle );
        
    });
    
    $( '.demo-page-import-btn' ).on( 'click', function () {
        
        $( '.js-ocdi-ajax-response' ).empty(); // Clean
		var selectedDemo = $( '#select-demo' ).val();
        var selectedPage = $( '.select-demo-page[data-demo="' + selectedDemo + '"]' ).val();
        
		//var $itemContainer   = $( this ).closest( '.js-ocdi-gl-item' );
		// If the import confirmation is enabled, then do that, else import straight away.
		
        demoPageImport( selectedPage );

	});


	/**
	 * Grid Layout categories navigation.
	 */
	(function () {
		// Cache selector to all items
		var $items = $( '.js-ocdi-gl-item-container' ).find( '.js-ocdi-gl-item' ),
			fadeoutClass = 'ocdi-is-fadeout',
			fadeinClass = 'ocdi-is-fadein',
			animationDuration = 200;

		// Hide all items.
		var fadeOut = function () {
			var dfd = jQuery.Deferred();

			$items
				.addClass( fadeoutClass );

			setTimeout( function() {
				$items
					.removeClass( fadeoutClass )
					.hide();

				dfd.resolve();
			}, animationDuration );

			return dfd.promise();
		};

		var fadeIn = function ( category, dfd ) {
			var filter = category ? '[data-categories*="' + category + '"]' : 'div';

			if ( 'all' === category ) {
				filter = 'div';
			}

			$items
				.filter( filter )
				.show()
				.addClass( 'ocdi-is-fadein' );

			setTimeout( function() {
				$items
					.removeClass( fadeinClass );

				dfd.resolve();
			}, animationDuration );
		};

		var animate = function ( category ) {
			var dfd = jQuery.Deferred();

			var promise = fadeOut();

			promise.done( function () {
				fadeIn( category, dfd );
			} );

			return dfd;
		};

		$( '.js-ocdi-nav-link' ).on( 'click', function( event ) {
			event.preventDefault();

			// Remove 'active' class from the previous nav list items.
			$( this ).parent().siblings().removeClass( 'active' );

			// Add the 'active' class to this nav list item.
			$( this ).parent().addClass( 'active' );

			var category = this.hash.slice(1);

			// show/hide the right items, based on category selected
			var $container = $( '.js-ocdi-gl-item-container' );
			$container.css( 'min-width', $container.outerHeight() );

			var promise = animate( category );

			promise.done( function () {
				$container.removeAttr( 'style' );
			} );
		} );
	}());


	/**
	 * Grid Layout search functionality.
	 */
	$( '.js-ocdi-gl-search' ).on( 'keyup', function( event ) {
		if ( 0 < $(this).val().length ) {
			// Hide all items.
			$( '.js-ocdi-gl-item-container' ).find( '.js-ocdi-gl-item' ).hide();

			// Show just the ones that have a match on the import name.
			$( '.js-ocdi-gl-item-container' ).find( '.js-ocdi-gl-item[data-name*="' + $(this).val().toLowerCase() + '"]' ).show();
		}
		else {
			$( '.js-ocdi-gl-item-container' ).find( '.js-ocdi-gl-item' ).show();
		}
	} );

	/**
	 * ---------------------------------------
	 * --------Helper functions --------------
	 * ---------------------------------------
	 */

	/**
	 * Prepare grid layout import data and execute the AJAX call.
	 *
	 * @param int selectedImportID The selected import ID.
	 * @param obj $itemContainer The jQuery selected item container object.
	 */
	function gridLayoutImport( selectedImportID, $itemContainer ) {
		// Reset response div content.
		$( '.js-ocdi-ajax-response' ).empty();

		// Hide all other import items.
		$itemContainer.siblings( '.js-ocdi-gl-item' ).fadeOut( 500 );

		$itemContainer.animate({
			opacity: 0
		}, 500, 'swing', function () {
			$itemContainer.animate({
				opacity: 1
			}, 500 )
		});

		// Hide the header with category navigation and search box.
		$itemContainer.closest( '.js-ocdi-gl' ).find( '.js-ocdi-gl-header' ).fadeOut( 500 );

		// Append a title for the selected demo import.
		$itemContainer.parent().prepend( '<h3 class="engage-selected-demo">' + ocdi.texts.selected_import_title + '</h3>' );

		// Remove the import button of the selected item.
		$itemContainer.find( '.js-ocdi-gl-import-data' ).remove();

		// Prepare data for the AJAX call
		var data = new FormData();
		data.append( 'action', 'ocdi_import_demo_data' );
		data.append( 'security', ocdi.ajax_nonce );
		data.append( 'selected', selectedImportID );
		
		// Added by Veented
		
		var contentType = 'all';
		var formValue = $( 'input[name="vntd-content-type"]:checked' ).val();
		if ( formValue == 'content' || formValue == 'options' || formValue == 'widgets' ) contentType = formValue;
		
		data.append( 'vntd_content_type', contentType );

		// AJAX call to import everything (content, widgets, before/after setup)
		
		ajaxCall( data );
	}
    
    // Veented Demo Page Import helper function
    
    function demoPageImport( selectedDemo, $itemContainer ) {
        
		// Reset response div content.
        
        var $demoPageResponse = $( '#demo-page-response' );
		$demoPageResponse.empty();
        
        $demoPageResponse.append( "Starting import...\n" );

		// Prepare data for the AJAX call
        
		var data = new FormData();
        
		data.append( 'action', 'ocdi_import_demo_page' );
		data.append( 'security', ocdi.ajax_nonce );
		data.append( 'selected', selectedDemo );
        
        // Changed page title
        
        var newTitle = $( '#page-new-title' ).val();
        var selectedTitle = $( '.select-demo-page option:selected' ).text();
        
        if ( newTitle != '' && newTitle != selectedTitle ) {
        
        } else {
            newTitle = selectedTitle;
        }
        
        data.append( 'new_title', newTitle );
		
		// Added by Veented
		
		var contentType = 'all';
		var formValue = $( 'input[name="vntd-content-type"]:checked' ).val();
		
		data.append( 'extra_data', contentType );

		// AJAX call to import everything (content, widgets, before/after setup)
		
		ajaxDemoPagesCall( data );
	}

	/**
	 * Display the confirmation popup.
	 *
	 * @param int selectedImportID The selected import ID.
	 * @param obj $itemContainer The jQuery selected item container object.
	 */
	function displayConfirmationPopup( selectedImportID, $itemContainer ) {
		var $dialogContiner         = $( '#js-ocdi-modal-content' );
		var currentFilePreviewImage = ocdi.import_files[ selectedImportID ]['import_preview_image_url'] || ocdi.theme_screenshot;
		var previewImageContent     = '';
		var importNotice            = ocdi.import_files[ selectedImportID ]['import_notice'] || '';
		var importNoticeContent     = '';
		var dialogOptions           = $.extend(
			{
				'dialogClass': 'wp-dialog',
				'resizable':   false,
				'height':      'auto',
				'modal':       true
			},
			ocdi.dialog_options,
			{
				'buttons':
				[
					{
						text: ocdi.texts.dialog_no,
						class: 'button-import-cancel button-popup',
						click: function() {
							$(this).dialog('close');
						}
					},
					{
						text: ocdi.texts.dialog_yes,
						class: 'button  button-primary button-import-confirm button-popup',
						click: function() {
							$(this).dialog('close');
							gridLayoutImport( selectedImportID, $itemContainer );
						}
					}
				]
			});

		if ( '' === currentFilePreviewImage ) {
			previewImageContent = '<p>' + ocdi.texts.missing_preview_image + '</p>';
		}
		else {
			previewImageContent = '<div class="ocdi__modal-image-container"><img src="' + currentFilePreviewImage + '" alt="' + ocdi.import_files[ selectedImportID ]['import_file_name'] + '"></div>'
		}

		// Prepare notice output.
		if( '' !== importNotice ) {
			importNoticeContent = '<div class="ocdi__modal-notice  ocdi__demo-import-notice">' + importNotice + '</div>';
		}
		
		var requiredPluginsWrap = '';
		
		var plugins = ocdi.import_files[ selectedImportID ][ 'plugins' ];
		
		if ( plugins != null ) {
		
			var pluginsArr = $( '.engage-demo-wrap' ).find( '.ocdi__gl-item[data-name="' + ocdi.import_files[ selectedImportID ]['import_file_name'].toLowerCase() + '"] .required-plugins' ).text();
			
			try {
				pluginsArr = JSON.parse( pluginsArr );
			} catch(e) {
				pluginsArr = null;
			}
			
			console.log( pluginsArr );
			
			requiredPluginsWrap = '<div class="engage-modal-section modal-required-plugins"><h4>' + ocdi.texts.requires_plugins + ':</h4>';
			requiredPluginsWrap += '<ul class="modal-plugins-list">';
			
			if ( pluginsArr != null ) {
				$.each( pluginsArr, function( slug, pluginData ) {
				
					console.log( 'Plugin: ' + slug );
					
					var icon = 'check';
					var pluginClass = 'active';
					
					if ( pluginData['active'] == false ) {
						icon = 'close';
						pluginClass = 'not-active';
					}
					
					requiredPluginsWrap += '<li class="' + pluginClass + '" data-plugin-slug="' + slug + '"><i class="fa fa-' + icon + '"></i> ' + pluginData['plugin_name'];
					
					if ( pluginData['active'] == false ) {
						requiredPluginsWrap += ' <a href="' + pluginData['url'] + '" target="_blank" onclick="jQuery(\'#plugin-install-notice\').fadeIn()" title="Install and activate the plugin now">' + pluginData[ 'label' ] + ' <i class="fa fa-angle-right"></i></a>';
					}
					
					requiredPluginsWrap += '</li>';
					
				});
			}
			
			requiredPluginsWrap += '<p class="hidden" id="plugin-install-notice">' + ocdi.texts.plugins_other_tab + '</p>';
			
			requiredPluginsWrap += '</ul></div>';
			
		}
		
		//console.log( ocdi.import_files[ selectedImportID ] );
		
		// Data Type Selection
		
		var dataTypeSelection = '<div class="engage-modal-data"><div class="engage-modal-section"><h4>' + ocdi.texts.choose_data + ':</h4> ' + '<div class="form-input"><input type="radio" name="vntd-content-type" id="vntd-import-all" value="all" checked="checked"><label for="vntd-import-all">All <span>(Full demo site)</span></label></div>' + '<div class="form-input"><input type="radio" id="vntd-import-content" name="vntd-content-type" value="content"><label for="vntd-import-content">Content</label></div>' + '<div class="form-input"><input type="radio" name="vntd-content-type" value="options" id="vntd-import-options"><label for="vntd-import-options">Theme Options </label></div>' + '<div class="form-input"><input type="radio" name="vntd-content-type" value="widgets" id="vntd-import-widgets"><label for="vntd-import-widgets">Widgets</label></div></div>' + requiredPluginsWrap + '</div>';

		// Populate the dialog content.
		$dialogContiner.prop( 'title', ocdi.texts.dialog_title );
		$dialogContiner.html(
			'<p class="ocdi__modal-item-title">' + ocdi.import_files[ selectedImportID ]['import_file_name'] + '</p>' +
			previewImageContent + dataTypeSelection +
			importNoticeContent
		);

		// Display the confirmation popup.
		$dialogContiner.dialog( dialogOptions );
	}

	/**
	 * The main AJAX call, which executes the import process.
	 *
	 * @param FormData data The data to be passed to the AJAX call.
	 */
	function ajaxCall( data ) {
		//alert( 'URL: ' + ocdi.ajax_url );
		$.ajax({
			method:      'POST',
			url:         ocdi.ajax_url,
			data:        data,
			contentType: false,
			processData: false,
			beforeSend:  function() {
				$( '.js-ocdi-ajax-loader' ).show();
			}
		})
		.done( function( response ) {
			if ( 'undefined' !== typeof response.status && 'newAJAX' === response.status ) {
				ajaxCall( data );
			}
			else if ( 'undefined' !== typeof response.status && 'customizerAJAX' === response.status ) {
				// Fix for data.set and data.delete, which they are not supported in some browsers.
				var newData = new FormData();
				newData.append( 'action', 'ocdi_import_customizer_data' );
				newData.append( 'security', ocdi.ajax_nonce );

				// Set the wp_customize=on only if the plugin filter is set to true.
				if ( true === ocdi.wp_customize_on ) {
					newData.append( 'wp_customize', 'on' );
				}

				ajaxCall( newData );
			} else if ( 'undefined' !== typeof response.status && 'afterAllImportAJAX' === response.status ) {
				// Fix for data.set and data.delete, which they are not supported in some browsers.
				var newData = new FormData();
				newData.append( 'action', 'ocdi_after_import_data' );
				newData.append( 'security', ocdi.ajax_nonce );
				ajaxCall( newData );
			}
			else if ( 'undefined' !== typeof response.message ) {
				$( '.js-ocdi-ajax-response' ).append( '<p>' + response.message + '</p>' );
				$( '.js-ocdi-ajax-loader' ).hide();

				// Trigger custom event, when OCDI import is complete.
				$( document ).trigger( 'ocdiImportComplete' );
			}
			else {
				$( '.js-ocdi-ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>' + response + '</p></div>' );
				$( '.js-ocdi-ajax-loader' ).hide();
			}
		})
		.fail( function( error ) {
			$( '.js-ocdi-ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>Error: ' + error.statusText + ' (' + error.status + ')' + '</p></div>' );
			$( '.js-ocdi-ajax-loader' ).hide();
		});
	}
    
    // Veented Demo Pages Ajax Call
    
    var importedPageID = null;
    
    function ajaxDemoPagesCall( data ) {
        
		//alert( 'URL: ' + ocdi.ajax_url );
		$.ajax({
			method:      'POST',
			url:         ocdi.ajax_url,
			data:        data, // sending selectedIndex
			contentType: false,
			processData: false,
			beforeSend:  function() {
				$( '.js-ocdi-ajax-loader' ).show();
			}
		})
		.done( function( response ) {
            
			if ( 'undefined' !== typeof response.status && 'newAJAX' === response.status ) {
				ajaxDemoPagesCall( data );
			}
			else if ( 'undefined' !== typeof response.status && 'customizerAJAX' === response.status ) {
				// Fix for data.set and data.delete, which they are not supported in some browsers.
				var newData = new FormData();
				newData.append( 'action', 'ocdi_import_customizer_data' );
				newData.append( 'security', ocdi.ajax_nonce );

				// Set the wp_customize=on only if the plugin filter is set to true.
				if ( true === ocdi.wp_customize_on ) {
					newData.append( 'wp_customize', 'on' );
				}

				ajaxDemoPagesCall( newData );
			}
			else if ( 'undefined' !== typeof response.status && 'afterAllImportAJAX' === response.status ) {
				// Fix for data.set and data.delete, which they are not supported in some browsers.
				var newData = new FormData();
				newData.append( 'action', 'ocdi_after_import_data' );
				newData.append( 'security', ocdi.ajax_nonce );
				ajaxDemoPagesCall( newData );
			}
			else if ( 'undefined' !== typeof response.message ) {
                $( '.js-ocdi-ajax-response' ).empty();
                
                if ( 'undefined' !== typeof response.pages_url ) {
                    $( '.js-ocdi-ajax-response' ).append( '<div class="notice  notice-success engage-import-success"><p><strong>Woohoo, all done!</strong><br>The page has been succesfully imported. Visit <a href="' + response.pages_url + '" target="_blank">Pages</a> menu to edit/view the new page.</p></div>' );
                } else {
                    $( '.js-ocdi-ajax-response' ).append( '<div class="notice  notice-success engage-import-success"><p><strong>Woohoo, all done!</strong><br>The page has been succesfully imported. Visit "Pages" menu to edit/view the new page.</p></div>' );
                }
				
				$( '.js-ocdi-ajax-loader' ).hide();

				// Trigger custom event, when OCDI import is complete.
				$( document ).trigger( 'ocdiImportComplete' );
			}
			else {
                $( '.js-ocdi-ajax-response' ).empty();
				$( '.js-ocdi-ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>' + response + '</p></div>' );
				$( '.js-ocdi-ajax-loader' ).hide();
			}
		}).fail( function( error ) {
            $( '.js-ocdi-ajax-response' ).empty();
			$( '.js-ocdi-ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>Error: ' + error.statusText + ' (' + error.status + ')' + '</p></div>' );
			$( '.js-ocdi-ajax-loader' ).hide();
		});
	}
} );
