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
		<h1 class="ocdi__title  engage-page-title"><?php esc_html_e( 'Import Demo Pages', 'pt-ocdi' ); ?></h1>
		<p class="engage-page-desc"><?php echo esc_html__( 'Here, you may import singular pages from all available demos individually. If you like a certain layout in other demo than the one your imported - you may get it here!', 'engage' ); ?></p>
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
		$engage_dashboard->dashboard_nav( 'engage-demo-pages' );
	}
	
	?>
    
    <div class="engage-grid-container engage-grid-bg">
		<div class="engage-grid-row">

	    	<div class="engage-grid-col col-4 demo-pages-col">
                
                <div class="demo-pages-wrap">
                
                    <h3><?php esc_html_e( 'Demo Page Importer', 'engage' ); ?></h3>
                    
                    <p><?php esc_html_e( 'Note: only the page content will be imported without any styling. For a full demo visit', 'engage' ); ?> <a href="<?php echo admin_url( 'admin.php?page=engage-demo' ); ?>"><?php esc_html_e( 'Demo Sites', 'engage' ); ?></a>.</p>

                    <hr>
                    
                    <div class="engage-form">
                        
                        <div class="ocdi__response js-ocdi-ajax-response"></div>

                        <div class="engage-form-el">
                            <h5><?php esc_html_e( 'Demo Site', 'engage' ); ?>:
                                <span class="engage-tooltip">
                                    <i class="fa fa-question-circle"></i>
                                    <p class="engage-tooltip-text"><?php esc_html_e( 'Choose a Demo Site with a page you like.', 'engage' ); ?></p>
                                </span>
                            </h5>
                            <select id="select-demo">
                                <?php
                                
                                $demos = engage_demo_sites_list();
                                
                                foreach( $demos as $demo_slug => $demo ) {
                                    echo '<option value="' . esc_attr( $demo_slug ) . '">' . esc_html( $demo['name'] ) .'</option>';
                                }
                                
                                ?>
                            </select>
                        </div>

                        <div class="engage-form-el">
                            <h5><?php esc_html_e( 'Page', 'engage' ); ?>:
                                <span class="engage-tooltip">
                                    <i class="fa fa-question-circle"></i>
                                    <p class="engage-tooltip-text"><?php esc_html_e( 'Choose a page you would like to import.', 'engage' ); ?></p>
                                </span>
                            </h5>
                            <?php
                            
                            // How to handle this one?
                            
                            $path = get_template_directory() . '/framework/demo-content/demo-pages-array.php';
	                        
                            $first_page = '';
                            
                            if ( is_file( $path ) ) {

                                $element_array = include $path;
                                
                                $iterator = 0;
                                $demo_sites = array();
                                $demo_pages = array();
                                
                                foreach ( $element_array as $demo_name => $demo_pages ) {
                                    
                                    $display = 'style="display:none;"';
                                    if ( $iterator == 0 ) $display = '';
                                    echo '<select class="select-demo-page" data-demo="' . esc_attr( $demo_name ) . '"' . $display . '>';
                                    
                                    foreach ( $demo_pages as $page_id => $page_data ) {
                                        
                                        if ( $iterator == 0 ) $first_page = $page_data[ 'title' ];
                                        $value = $demo_name . '_' . $page_id;
                                        echo '<option value="' . $value . '">' . esc_html( $page_data[ 'title' ] ) . '</option>';
                                        
                                        $iterator++;
                                    }
                                    
                                    echo '</select>';
                                    
                                }

                            }
                            
                            ?>
                        </div>
                        
                        <div class="engage-form-el" style="display:none;">
                            <h5><?php esc_html_e( 'Page Title', 'engage' ); ?>:
                                <span class="engage-tooltip">
                                    <i class="fa fa-question-circle"></i>
                                    <p class="engage-tooltip-text"><?php esc_html_e( 'If you wish, you can change title of the imported page so it doesn\'t conflict with your other pages.', 'engage' ); ?></p>
                                </span>
                            </h5>
                            <input type="text" id="page-new-title" placeholder="<?php esc_html_e( 'Optional custom page title.', 'engage' ); ?>" value="<?php echo esc_html( $first_page ); ?>">
                        </div>

                        <button class="ocdi__gl-item-button button button-primary demo-page-import-btn engage-button-primary"><?php esc_html_e( 'Import Page', 'engage' ); ?></button>
                        
                        <div id="demo-import-response" class="engage-notice"></div>

                    </div>
                    
                </div>
	    	</div>

		</div>
	</div>

	<div id="js-ocdi-modal-content"></div>

	<p class="ocdi__ajax-loader  js-ocdi-ajax-loader">
		<span class="spinner"></span> <?php esc_html_e( 'Importing, please wait!', 'pt-ocdi' ); ?>
	</p>
</div>
