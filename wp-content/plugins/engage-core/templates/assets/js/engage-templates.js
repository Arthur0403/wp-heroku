(function ($, vc) {

	$(document).ready(function () {

    'use strict';

    if ( ! window.vc || ! window.vc.storage ) {
			return;
		}

    var vc = window.vc;

		// VC Veented Templates

		$( '.vntd-load-template,#template-preview-load' ).click( function(e) {

			var html = '[vc_row][vc_column][vc_column_text]Something went wrong.[/vc_column_text][/vc_column][/vc_row]';

			var $parent = $(this).closest( 'li' );

			if ( $(this).hasClass( 'load-from-preview' ) ) {
				$parent = $grid.find( '#' + $( '.vntd-template-preview' ).attr( 'data-template-id' ) );
				console.log( 'ID: ' + $( '.vntd-template-preview' ).attr( 'data-template-id' ) );
			}

			if ( $parent.find( '.vntd-template-sc' ).html() != '' ) {
				html = $parent.find( '.vntd-template-sc' ).html();
			}

			var modele = vc.storage.parseContent({}, html);

			_.each(modele, function(model) {
			    vc.shortcodes.create(model)
			});

			vc.closeActivePanel();

		});

		// Preview img

		var $preview = $( '#vntd-template-preview' );
		var $grid = $( '#vntd-templates-main' );
		var $templatesList = $( '.vntd-templates-list' );

		$( '.vntd-template-img' ).on( 'click', function() {

			var $parent = $(this).closest('li');

			var title = $parent.find( 'h5' ).html();
			var imgUrl = $parent.find( '.vntd-template-img' ).data( 'preview-img' );
			var id = $parent.attr( 'id' );

			$preview.attr( 'data-template-id', id );
			$preview.find( '#template-preview-title' ).text( title );
			$preview.find( '#template-preview-desc' ).text( $parent.find( 'p.template-desc' ).html() );
			$preview.find( '#template-preview-info' ).hide();
			if ( $parent.find( 'p.template-info' ).html() ) {
				$preview.find( '#template-preview-info' ).text( $parent.find( 'p.template-info' ).html() ).show();
			}

			$preview.find( '#template-preview-img' ).attr( 'src', imgUrl );

			$grid.hide();
			$preview.fadeIn();
		});

		$( '.vntd-template-close,.vntd-preview-back' ).on( 'click', function(event) {
			event.preventDefault();
			$preview.hide();
			$grid.fadeIn();
		});

		// Filtering menu

		$( '#vntd-templates-filter li button' ).on( 'click', function(e) {

			var $activeParent = $(this).closest( 'li' );

			$( '#vntd-templates-filter li' ).removeClass( 'vntd-active' );
			$activeParent.addClass( 'vntd-active' );

			var filter = $(this).data( 'filter' );

			if ( filter == 'all' ) {
				$( '.vntd-templates-list li' ).removeClass('vntd-hidden');
			} else {
				$( '.vntd-templates-list li' ).removeClass('vntd-hidden').addClass( 'vntd-hidden' );
				$( '.vntd-templates-list li.cat-' + filter ).removeClass('vntd-hidden');
			}

		});

		function openTemplatePreview( templateID ) {

			var $template = $grid.find( '#' + templateID );

			var title = $template.find( 'h5' ).html();
			var imgUrl = $template.find( '.vntd-template-img' ).data( 'preview-img' );
			var id = $template.attr( 'id' );

			$preview.attr( 'data-template-id', id );
			$preview.find( '#template-preview-title' ).text( title );
			$preview.find( '#template-preview-desc' ).text( $template.find( 'p.template-desc' ).html() );
			$preview.find( '#template-preview-info' ).hide();
			if ( $template.find( 'p.template-info' ).html() ) {
				$preview.find( '#template-preview-info' ).text( $template.find( 'p.template-info' ).html() ).show();;
			}
			$preview.find( '#template-preview-img' ).attr( 'src', imgUrl );

		}

		// Prev / Next buttons

		$( '.vntd-template-next' ).on( 'click', function() {

			var currentID = $( '#vntd-template-preview' ).attr( 'data-template-id' );
			var nextID = $templatesList.find( '#' + currentID + ' ~ li:not(.vntd-hidden)' ).attr( 'id' );

			if ( !nextID ) {
				var nextID = $templatesList.find( 'li:not(.vntd-hidden):first' ).attr( 'id' );
			}
			openTemplatePreview( nextID );

		});

		// Prev button

		$( '.vntd-template-prev' ).on( 'click', function() {

			var currentID = $( '#vntd-template-preview' ).attr( 'data-template-id' );
			//var nextID = $templatesList.find( '#' + currentID ).prev( 'li' ).attr( 'id' );
			var nextID = $templatesList.find( '#' + currentID ).prevAll("li:not(.vntd-hidden):first").attr( 'id' );
			if ( !nextID ) {
				var nextID = $templatesList.find( 'li:not(.vntd-hidden):last' ).attr( 'id' );
			}
			openTemplatePreview( nextID );

		});

    // Images

    vc.events.on( 'shortcodes:vc_single_image:sync', function() {
			init_vntd_images();
		});

    // Load thumbnails
    vc.events.on( "app.render", function() {
      if ( typeof vc.templates_panel_view != "undefined" ) {
        window.vc.templates_panel_view.on( "render", function() {

          var $engageTemplates = $( '.vntd-templates-list' );

  				if ( $engageTemplates.length > 0 && !$engageTemplates.hasClass( 'vntd-images-loaded' ) ) {
  					$engageTemplates.find( '.vntd-template-img img' ).each( function() {
  						$(this).attr( 'src', $(this).data( 'img-src' ) );
  					});
  					$engageTemplates.addClass( 'vntd-images-loaded' );
  				}

        });
      }
    });

		function init_vntd_images() {
			if ( $( '.wpb_vc_single_image:not(.vntd-external-image)' ).length > 0 ) {

				$( '.wpb_vc_single_image:not(.vntd-external-image)' ).each( function() {

					var value = $(this).find( '.wpb_vc_param_value' ).attr( 'value' );

					if ( value.indexOf( 'unsplash' ) !== -1 ) {

						value = value.substring(0, value.lastIndexOf('/') + 1) + '150x150';

						$(this).find( '.attachment-thumbnail' ).attr( 'src', value );
						$(this).find( '.attachment-thumbnail' ).clone().attr( 'style', '' ).addClass( 'vntd-img-preview' ).insertBefore( $(this).find( '.attachment-thumbnail' ) );
						$(this).find( '.no_image_image' ).addClass( 'image-exists' );
						$(this).find( '.no_image_image' ).hide();

						$(this).addClass( 'vntd-external-image' );

					}

				});
			}
		}

		$('#vc_ui-panel-edit-element:not(.vc_active)').on( "change", function( event ){

			if ( $( '.wpb_el_type_attach_image:not(.vntd-gallery-ready)' ).length > 0 ) {

				$( '.wpb_el_type_attach_image:not(.vntd-gallery-ready)' ).each( function() {

					var $gallery = $(this);

					var value = $gallery.find( 'input.attach_image' ).attr( 'value' );

					if ( value.indexOf( 'http' ) !== -1 ) {

						// Get URL of a smaller, thumbnail version of the image

						var URL = value;

						if ( value.indexOf( 'veented.com' ) !== -1 ) {
							URL = URL.replace( '.jpg', '-150x150.jpg' );
							URL = URL.replace( '.png', '-150x150.png' );
							URL = URL.replace( '.jpeg', '-150x150.jpeg' );
						}

						var imagePreview = '<li class="added ui-sortable-handle vntd-added-image"><img src="' + URL + '"><a href="#" class="vntd-image-remove" style="position:absolute;top:0;left:0;right:0;bottom:0;color:red;text-decoration:none;"><i class="vc-composer-icon vc-c-icon-close"></i></a></li>';

						$gallery.find( '.gallery_widget_attached_images_list' ).append( imagePreview );

						$gallery.delegate( '.vntd-image-remove', 'click', function() {
							$gallery.find( '.vntd-added-image' ).remove();
							$gallery.find( 'input.attach_image' ).attr( 'value', '' );

						});

					}

					$gallery.addClass( 'vntd-gallery-ready' );
				});

			}

		});

  });

})(window.jQuery, window.vc);
