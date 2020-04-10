<?php
/**
 * The plugin page view - the "settings" page of the plugin.
 *
 * @package ocdi
 */

namespace OCDI;

?>

<div class="ocdi  wrap  engage-wrap engage-demo-wrap">

	<?php ob_start(); ?>
		<h1 class="ocdi__title  engage-page-title"><?php esc_html_e( 'Import Demo Sites', 'pt-ocdi' ); ?></h1>
		<p class="engage-page-desc"><?php echo esc_html__( 'Importing pre-built Demo Sites is the easiest way to setup your theme. It will allow you to quickly edit everything instead of creating content from scratch.', 'engage' ); ?></p>
	<?php

	// Display warrning if PHP safe mode is enabled, since we wont be able to change the max_execution_time.
	if ( ini_get( 'safe_mode' ) ) {
		printf(
			esc_html__( '%sWarning: your server is using %sPHP safe mode%s. This means that you might experience server timeout errors.%s', 'pt-ocdi' ),
			'<div class="notice  notice-warning  is-dismissible"><p>',
			'<strong>',
			'</strong>',
			'</p></div>'
		);
	}

	// Start output buffer for displaying the plugin intro text.
	ob_start();
	
	global $engage_dashboard;
	
	if ( is_object( $engage_dashboard ) ) {
		$engage_dashboard->dashboard_nav( 'engage-demo' );
	}
	
	?>
	
	<div class="engage-grid-container engage-grid-bg">
		<div class="engage-grid-row">
	    	<div class="engage-grid-col col-12">
	    		<h4><i class="fa fa-info-circle"></i> <?php esc_html_e( 'Demo Content Information', 'engage' ); ?></h4>
	    		<p><?php esc_html_e( 'When you import the data, the following things might happen', 'engage' ); ?>:</p>
	    		<ul class="engage-list-stylized">
	    			<li><i class="fa fa-check"></i> <?php esc_html_e( 'No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.', 'pt-ocdi' ); ?></li>
	    			<li><i class="fa fa-check"></i> <?php esc_html_e( 'Posts, pages, images, widgets, menus and other theme settings will get imported.', 'pt-ocdi' ); ?></li>
	    			<li><i class="fa fa-check"></i> <?php esc_html_e( 'Please click on the Import button only once and wait, it can take a little while.', 'pt-ocdi' ); ?></li>
	    		</ul>
	    	</div>
		</div>
	</div>

	<?php
	
	//$plugin_intro_text = ob_get_clean();

	// Display the plugin intro text (can be replaced with custom text through the filter below).
	//echo wp_kses_post( apply_filters( 'pt-ocdi/plugin_intro_text', $plugin_intro_text ) );
	?>


	<?php if ( empty( $this->import_files ) ) : ?>

		<div class="notice  notice-info  is-dismissible">
			<p><?php esc_html_e( 'There are no predefined import files available in this theme. Please upload the import files manually!', 'pt-ocdi' ); ?></p>
		</div>

		<div class="ocdi__file-upload-container">
			<h2><?php esc_html_e( 'Manual demo files upload', 'pt-ocdi' ); ?></h2>

			<div class="ocdi__file-upload">
				<h3><label for="content-file-upload"><?php esc_html_e( 'Choose a XML file for content import:', 'pt-ocdi' ); ?></label></h3>
				<input id="ocdi__content-file-upload" type="file" name="content-file-upload">
			</div>

			<div class="ocdi__file-upload">
				<h3><label for="widget-file-upload"><?php esc_html_e( 'Choose a WIE or JSON file for widget import:', 'pt-ocdi' ); ?></label></h3>
				<input id="ocdi__widget-file-upload" type="file" name="widget-file-upload">
			</div>

			<div class="ocdi__file-upload">
				<h3><label for="customizer-file-upload"><?php esc_html_e( 'Choose a DAT file for customizer import:', 'pt-ocdi' ); ?></label></h3>
				<input id="ocdi__customizer-file-upload" type="file" name="customizer-file-upload">
			</div>

			<?php if ( class_exists( 'ReduxFramework' ) ) : ?>
			<div class="ocdi__file-upload">
				<h3><label for="redux-file-upload"><?php esc_html_e( 'Choose a JSON file for Redux import:', 'pt-ocdi' ); ?></label></h3>
				<input id="ocdi__redux-file-upload" type="file" name="redux-file-upload">
				<div>
					<label for="redux-option-name" class="ocdi__redux-option-name-label"><?php esc_html_e( 'Enter the Redux option name:', 'pt-ocdi' ); ?></label>
					<input id="ocdi__redux-option-name" type="text" name="redux-option-name">
				</div>
			</div>
			<?php endif; ?>
		</div>

		<p class="ocdi__button-container">
			<button class="ocdi__button  button  button-hero  button-primary  js-ocdi-import-data"><?php esc_html_e( 'Import Demo Data', 'pt-ocdi' ); ?></button>
		</p>

	<?php elseif ( 1 === count( $this->import_files ) ) : ?>

		<div class="ocdi__demo-import-notice  js-ocdi-demo-import-notice"><?php
			if ( is_array( $this->import_files ) && ! empty( $this->import_files[0]['import_notice'] ) ) {
				echo wp_kses_post( $this->import_files[0]['import_notice'] );
			}
		?></div>

		<p class="ocdi__button-container">
			<button class="ocdi__button  button  button-hero  button-primary  js-ocdi-import-data"><?php esc_html_e( 'Import Demo Data', 'pt-ocdi' ); ?></button>
		</p>

	<?php else : ?>

		<!-- OCDI grid layout -->
		<div class="ocdi__gl  js-ocdi-gl engage-demos-list engage-demo-wrap">
		<?php
			
			// Prepare navigation data.
			$categories = Helpers::get_all_demo_import_categories( $this->import_files );
			
		?>
			<?php if ( ! empty( $categories ) ) : ?>
				<div class="ocdi__gl-header  js-ocdi-gl-header">
					<nav class="ocdi__gl-navigation">
						<ul>
							<li class="active"><a href="#all" class="ocdi__gl-navigation-link  js-ocdi-nav-link"><?php esc_html_e( 'All', 'pt-ocdi' ); ?></a></li>
							<?php foreach ( $categories as $key => $name ) : ?>
								<li><a href="#<?php echo esc_attr( $key ); ?>" class="ocdi__gl-navigation-link  js-ocdi-nav-link"><?php echo esc_html( $name ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</nav>
					<div clas="ocdi__gl-search">
						<input type="search" class="ocdi__gl-search-input  js-ocdi-gl-search" name="ocdi-gl-search" value="" placeholder="<?php esc_html_e( 'Search demos...', 'pt-ocdi' ); ?>">
					</div>
				</div>
			<?php endif; ?>
			<div class="ocdi__gl-item-container  wp-clearfix  js-ocdi-gl-item-container">
				<?php foreach ( $this->import_files as $index => $import_file ) : ?>
					<?php
						// Prepare import item display data.
						$img_src = isset( $import_file['import_preview_image_url'] ) ? $import_file['import_preview_image_url'] : '';
						// Default to the theme screenshot, if a custom preview image is not defined.
						if ( empty( $img_src ) ) {
							$theme = wp_get_theme();
							$img_src = $theme->get_screenshot();
						}
						
					?>
					<div class="ocdi__gl-item js-ocdi-gl-item" data-categories="<?php echo esc_attr( Helpers::get_demo_import_item_categories( $import_file ) ); ?>" data-name="<?php echo esc_attr( strtolower( $import_file['import_file_name'] ) ); ?>">
						<div class="ocdi__gl-item-image-container">
							<?php if ( ! empty( $img_src ) ) : ?>
								<img class="ocdi__gl-item-image" src="<?php echo esc_url( $img_src ) ?>">
							<?php else : ?>
								<div class="ocdi__gl-item-image  ocdi__gl-item-image--no-image"><?php esc_html_e( 'No preview image.', 'pt-ocdi' ); ?></div>
							<?php endif; ?>
						</div>
						<div class="ocdi__gl-item-footer<?php echo ! empty( $import_file['preview_url'] ) ? '  ocdi__gl-item-footer--with-preview' : ''; ?>">
							<h4 class="ocdi__gl-item-title" title="<?php echo esc_attr( $import_file['import_file_name'] ); ?>"><?php echo esc_html( $import_file['import_file_name'] ); ?></h4>
							<button class="ocdi__gl-item-button  button  button-primary  js-ocdi-gl-import-data" value="<?php echo esc_attr( $index ); ?>"><?php esc_html_e( 'Import', 'pt-ocdi' ); ?></button>
							<?php if ( ! empty( $import_file['preview_url'] ) ) : ?>
								<a class="ocdi__gl-item-button  button" href="<?php echo esc_url( $import_file['preview_url'] ); ?>" target="_blank"><?php esc_html_e( 'Preview', 'pt-ocdi' ); ?></a>
							<?php endif; ?>
						</div>
						<?php
						
						// Veented
						
						// Required Plugins

						if ( isset( $import_file['plugins'] ) && $import_file['plugins'] != null ) {
						
							$plugins = array();
							
							// Get TGMPA instance
							
							$tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
							
							// Loop plugins
							
							foreach ( $import_file['plugins'] as $plugin_slug => $plugin_name ) {
								
								$active = false;
								$url = null;
								$action = null;
								$button_label = null;
								
								// Check if plugin to be installed or activated
								
								if ( ! $tgmpa_instance->is_plugin_installed( $plugin_slug ) ) {
									$button_label = esc_html__( 'Install now', 'engage' );
									$action = 'install';
								} elseif ( ! $tgmpa_instance->is_plugin_active( $plugin_slug ) ) {
									$button_label = esc_html__( 'Activate', 'engage' );
									$action = 'activate';
								} else {
									$active = true;
								}
								
								// Get nonce URL
								
								if ( $action != null ) {
									$url = wp_nonce_url(
										add_query_arg(
											array(
												'plugin' => urlencode( $plugin_slug ),
												'tgmpa-' . $action => $action . '-plugin',
											),
											$tgmpa_instance->get_tgmpa_url()
										),
										'tgmpa-' . $action,
										'tgmpa-nonce'
									);
								}
								
								// Add element to array
								
								$plugins[ $plugin_slug ] = array(
									'plugin_name' => $plugin_name,
									'plugin_slug' => $plugin_slug,
									'active' => $active,
									'url' => esc_url( $url ),
									'label' => $button_label
								);
							}
							
							//var_dump( $plugins );
							
							echo '<div style="display:none;" class="hidden required-plugins">' . json_encode( $plugins ) . '</div>';
						}
						
						?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<div id="js-ocdi-modal-content"></div>

	<?php endif; ?>

	<p class="ocdi__ajax-loader  js-ocdi-ajax-loader">
		<span class="spinner"></span> <?php esc_html_e( 'Importing, please wait!', 'pt-ocdi' ); ?>
	</p>

	<div class="ocdi__response  js-ocdi-ajax-response"></div>
</div>
