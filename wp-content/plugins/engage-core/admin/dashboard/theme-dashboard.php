<?php

// Admin Dashboard / Core

if ( !class_exists( 'Engage_Dashboard' ) ) {

	class Engage_Dashboard {

		function __construct() {

	    	// Load dashboard

	    	add_action( 'admin_menu', array( $this, 'dashboard_init' ) );

	    	// Admin Bar

	    	add_action( 'admin_bar_menu', array( $this, 'dashboard_admin_bar' ), 50 );
	    }

	    function dashboard_admin_bar() {

            if ( !current_user_can( 'manage_options' ) ) return;

	    	global $wp_admin_bar;

	    	$title = '<span class="ab-icon engage-icon-icon engage-icon-engage-icon2"></span>Engage';

	    	$nodeargs = array(
	    	    'id'    => 'engage-dashboard-node',
	    	    'title' => $title,
	    	    'href'  => admin_url( 'admin.php?page=engage-dashboard' ),
	    	    'meta'  => array()
	    	);

	    	$wp_admin_bar->add_node( $nodeargs );

	    	// Child

	    	$childs = array(
	    		'adminbar-e-dashboard' => array(
	    			'title' => 'Dashboard',
	    			'href' => 'engage-dashboard',
	    		),
	    		'adminbar-e-options' => array(
	    			'title' => esc_html__( 'Theme Options', 'engage' ),
	    			'href' => 'engage-options',
	    		),
	    		'adminbar-e-plugins' => array(
	    			'title' => esc_html__( 'Plugins', 'engage' ),
	    			'href' => 'engage-plugins',
	    		),
	    		'adminbar-e-support' => array(
	    			'title' => esc_html__( 'Support', 'engage' ),
	    			'href' => 'engage-support',
	    		),
	    		'adminbar-e-demo-sites' => array(
	    			'title' => esc_html__( 'Demo Sites', 'engage' ),
	    			'href' => 'engage-demo',
	    		),
                'adminbar-e-demo-pages' => array(
	    			'title' => esc_html__( 'Demo Pages', 'engage' ),
	    			'href' => 'engage-demo-pages',
	    		),
	    	);

            foreach( $childs as $child_id => $child ) {

        		$subnodeargs = array(
                    'id'     => $child_id,
                    'title'  => $child['title'],
                    'parent' => 'engage-dashboard-node',
                    'href'   => admin_url( 'admin.php?page=' . $child['href'] ),
                );

                $wp_admin_bar->add_node( $subnodeargs );

        	}

	    }

	    function dashboard_init() {

	    	call_user_func(
	    		'add_menu_page',
	    		esc_html__( 'Engage Theme Dashboard', 'engage' ),
	    		'Engage',
	    		'manage_options',
	    		'engage-dashboard',
	    		array( $this, 'dashboard_page_main' ),
	    		'dashicons-admin-engage',
	    		3
	    	);

	    	// Dashboard

	    	call_user_func( 'add_submenu_page',
	    		'engage-dashboard',
	    		esc_html__( 'Dashboard', 'engage' ),
	    		esc_html__( 'Dashboard', 'engage' ),
	    		'manage_options',
	    		'engage-dashboard',
	    		array( $this, 'dashboard_page_main' )
	    	);

	    	// Plugins

	    	call_user_func( 'add_submenu_page',
	    		'engage-dashboard',
	    		esc_html__( 'Plugins', 'engage' ),
	    		esc_html__( 'Plugins', 'engage' ),
	    		'manage_options',
	    		'engage-plugins',
	    		array( $this, 'dashboard_page_plugins' )
	    	);

	    	// Support

	    	call_user_func( 'add_submenu_page',
	    		'engage-dashboard',
	    		esc_html__( 'Support', 'engage' ),
	    		esc_html__( 'Support', 'engage' ),
	    		'manage_options',
	    		'engage-support',
	    		array( $this, 'dashboard_page_support' )
	    	);

	    	call_user_func( 'add_submenu_page',
	    		'engage-dashboard',
	    		esc_html__( 'Hire us', 'engage' ),
	    		esc_html__( 'Hire us', 'engage' ),
	    		'manage_options',
	    		'engage-customization',
	    		array( $this, 'dashboard_page_customization' )
	    	);

	    	if ( ! class_exists( 'Engage_Core' ) ) {

	  			call_user_func( 'add_submenu_page',
	  				'engage-dashboard',
	  				esc_html__( 'Demo Sites', 'engage' ),
	  				esc_html__( 'Demo Sites', 'engage' ),
	  				'manage_options',
	  				'engage-demo',
	  				array( $this, 'dashboard_page_demo' )
	  			);

	  		}

	    }

	    function dashboard_nav( $active_item ) {

	    	$engage_demo_slug = 'engage-demo';

	    	$nav = array(
	    		'engage-dashboard' => esc_html__( 'Theme Dashboard', 'engage' ),
	    		'engage-options' => esc_html__( 'Theme Options', 'engage' ),
	    		'engage-plugins' => esc_html__( 'Plugins', 'engage' ),
	    		$engage_demo_slug => esc_html__( 'Demo Sites', 'engage' ),
          'engage-demo-pages' => esc_html__( 'Demo Pages', 'engage' ),
	    		'engage-support' => esc_html__( 'Support', 'engage' ),
	    		'engage-customization' => esc_html__( 'Hire us', 'engage' ),
	    	);

	    	$output = '<h2 class="nav-tab-wrapper">';

	    	foreach ( $nav as $id => $label ) {
	    		$active_class = '';
	    		if ( $active_item == $id ) $active_class = ' nav-tab-active';
	    		$output .= '<a href="?page=' . $id . '" class="nav-tab' . $active_class . '">' . $label . '</a>';
	    	}

	    	$output .= '</h2>';

	    	// Everything already sanitised within the variable
	    	echo $output;

	    }

	    function dashboard_page_main() {

		    $this->dashboard_page_header( 'dashboard-page-main' );

		    ?>

	    	<h1 class="engage-page-title"><?php echo esc_html__( 'Engage Theme', 'engage' ); ?></h1>
	     	<p class="engage-page-desc"><?php echo esc_html__( 'Hello there! This is the main theme dashboard where you can find general theme information and quick links to various locations like our Support Center. We hope you enjoy using our theme. Thank you!', 'engage' ); ?></p>

	     	<?php $this->dashboard_nav( 'engage-dashboard' ); ?>

		    <div class="engage-grid-container engage-grid-bg">

		    	<div class="engage-grid-row">
                    <div class="engage-grid-col col-6">

                        <?php

                        $form_submitted = $form_api_key = $error_msg = $token_ok = false;

                        $name_api_key = 'vntd-envato-api-token';

                        // Form submission

                        if ( isset( $_POST[ $name_api_key ] ) ) {

                            $value_api_key = $_POST[ $name_api_key ];

                            if ( engage_verify_envato_api_token( $_POST[ $name_api_key ] ) == true ) {

                                if ( !get_option( $name_api_key ) && get_option( $name_api_key ) != '' ) {
                                    add_option( $name_api_key, $value_api_key );
                                } else {
                                    update_option( $name_api_key, $value_api_key );
                                }

                            } else {
                                $error_msg = true;
                            }

                        }

                        if ( get_option( $name_api_key ) ) {
                            $token_ok = true; // Adding the option manually will not allow you to go through the second verification upon the theme update release so we advise against replacing this bit.
                        }

                        // Verify the API Key:

                        if ( !isset( $global_status_class ) ) {
                            if ( get_option( $name_api_key ) ) {
                                $global_status_class = 'engage-status-correct';
                                $global_status_label = esc_html__( 'Verified!', 'engage' );
                            } else {
                                $global_status_class = 'engage-status-problem';
                                $global_status_label = esc_html__( 'Not verified.', 'engage' );
                            }
                        }

                        ?>

                        <h4><i class="fa fa-key"></i> <?php esc_html_e( 'Purchase verification', 'engage' ); ?><span class="engage-heading-status <?php echo esc_attr( $global_status_class ); ?>"><?php echo esc_html( $global_status_label ); ?></span></h4>

                        <p><?php esc_html_e( 'Please generate and enter your API Token below to receive automatic theme updates.', 'engage' ); ?> <a href="https://veented.ticksy.com/article/12051/" target="_blank"><?php esc_html_e( 'View instructions', 'engage' ); ?></a>.</p>

                        <?php

                        if ( $error_msg != false ) {
                            echo '<p class="text-notice engage-error-notice">' . esc_html( 'The provided Token seems to be wrong. Please check instructions and try again.', 'engage' ) . '</p>';
                        }

                        ?>

                        <form method="POST" action="" class="engage-form">
                            <div class="engage-inline-input<?php if ( $token_ok ) echo ' token-correct'; ?>">
                                <div class="engage-input-left">
                                    <input type="text" name="<?php echo esc_attr( $name_api_key ); ?>" value="<?php if ( get_option( $name_api_key ) ) echo esc_attr( get_option( $name_api_key ) ); ?>">
                                </div>
                                <input type="submit" value="Submit" class="button button-primary engage-button-primary">
                            </div>
                        </form>

			    	</div>

		    		<div class="engage-grid-col col-6">
		    			<?php

		    			$output = '';

		    			$global_status = true;
		    			$global_status_class = 'engage-status-correct';
		    			$global_status_label = esc_html__( 'All okay!', 'engage' );

		    			$status_class_problem = 'engage-status-problem';
		    			$status_class_correct = 'engage-status-correct';
		    			$status_label_correct = '<i class="fa fa-check"></i>';
		    			$status_label_problem = '<i class="fa fa-close"></i>';


		    			// Engage Core plugin installed

		    			if ( class_exists( 'Engage_Core' ) ) {
		    				$status_engage_core = $status_label_correct;
		    				$status_class = $status_class_correct;
		    				$status_info = '';
		    			} else {
		    				$global_status = false;
		    				$status_engage_core = $status_label_problem;
		    				$status_class = $status_class_problem;
		    				$status_info = '<span class="engage-recommended"><a href="' . esc_url( admin_url( 'admin.php?page=engage-plugins' ) ) . '">' . esc_html__( 'Please install and activate the plugin.', 'engage' ) . '</a></span>';
		    			}

		    			$output .= '<li><label>' . esc_html__( 'Engage Core plugin', 'engage' ) . ':</label> <span class="engage-value ' . esc_attr( $status_class ) . '">' . $status_engage_core . '</span>' . $status_info . '</li>';

		    			// Visual Composer plugin installed

		    			if ( class_exists( 'Vc_Manager' ) ) {
		    				$status_vc = $status_label_correct;
		    				$status_class = $status_class_correct;
		    				$status_info = '';
		    			} else {
		    				$global_status = false;
		    				$status_vc = $status_label_problem;
		    				$status_class = $status_class_problem;
		    				$status_info = '<span class="engage-recommended"><a href="' . esc_url( admin_url( 'admin.php?page=engage-plugins' ) ) . '">' . esc_html__( 'Please install and activate the plugin.', 'engage' ) . '</a></span>';
		    			}

		    			$output .= '<li><label>' . esc_html__( 'Visual Composer plugin', 'engage' ) . ':</label> <span class="engage-value ' . esc_attr( $status_class ) . '">' . $status_vc . '</span>' . $status_info . '</li>';



		    			if ( function_exists( 'wp_is_writable' ) ) {

		    				$status_writeable = $status_label_problem;
		    				$status_class = $status_class_problem;

		    				$upload_dirs = wp_upload_dir();

		    				if ( array_key_exists( 'basedir', $upload_dirs ) ) {

		    					if ( wp_is_writable( $upload_dirs[ 'basedir' ] ) ) {
		    						$status_writeable = $status_label_correct;
		    						$status_class = $status_class_correct;
		    					} else {
		    						$global_status = false;
		    					}

		    				}

		    				$output .= '<li><label>' . esc_html__( 'Uploads folder writable', 'engage' ) . ':</label> <span class="engage-value ' . esc_attr( $status_class ) . '">' . $status_writeable . '</span></li>';

		    			?>

		    			<?php

		    			} // End status uploads folder writeable

		    			if ( $global_status == false ) {
		    				$global_status_class = 'engage-status-problem';
		    				$global_status_label = esc_html__( 'Needs improvements', 'engage' );
		    			}

		    			?>
		    			<h4>
		    				<i class="fa fa-tasks"></i> <?php esc_html_e( 'General Status', 'engage' ); ?>
		    				<span class="engage-heading-status <?php echo esc_attr( $global_status_class ); ?>"><?php echo esc_html( $global_status_label ); ?></span>
		    			</h4>
		    			<ul class="engage-system-status">
		    				<?php

		    				// Everything already sanitised within the variable
		    				echo $output;

		    				?>
		    			</ul>

		    			<?php

		    			if ( $global_status == false ) {
		    				echo '<p class="engage-status-problem">' . esc_html__( 'Looks like the theme is not ready to use yet.', 'engage' ) . '</p>';
		    			} else {
		    				echo '<p>' . esc_html__( 'Everything seems to be all right, great!', 'engage' ) . '</p>';
		    			}

		    			?>
		    		</div>
		    	</div>

                <div class="engage-grid-row">
                    <div class="engage-grid-col col-4">
                        <h4><i class="fa fa-rocket"></i> <?php esc_html_e( 'Latest Updates', 'engage' ); ?></h4>
                        <p><?php esc_html_e( 'Latest theme updates: Meeting new ThemeForest code requirements, minor bug fixes, plugin updates, Veented Plugins service, Gutenberg support and much more!', 'engage' ); ?></p>
                        <a href="<?php echo esc_url( 'https://themeforest.net/item/engage-creative-multipurpose-wp-theme/19199913#item-description__changelog' ) ?>" target="_blank" class="engage-more-link"><?php esc_html_e( 'View full changelog', 'engage' ); ?><i class="fa fa-angle-right"></i></a>
                    </div>
                    <div class="engage-grid-col col-4">
			    		<h4><i class="fa fa-star-o"></i> <?php esc_html_e( 'Rate the theme!', 'engage' ); ?></h4>
			    		<p><?php esc_html_e( 'If you\'re happy with Engage then please consider rating it! You can do that by visiting the link below and clicking on star icons on the right. Thank you!', 'engage' ); ?></p>
			    		<a href="<?php echo esc_url( 'https://themeforest.net/item/engage-creative-multipurpose-wp-theme/19199913' ) ?>" target="_blank" class="engage-more-link"><?php esc_html_e( 'Rate the theme!', 'engage' ); ?><i class="fa fa-angle-right"></i></a>
			    	</div>
			    	<div class="engage-grid-col col-4">
			    		<h4><i class="fa fa-lightbulb-o"></i> <?php esc_html_e( 'Have suggestions?', 'engage' ); ?></h4>
			    		<p><?php esc_html_e( 'If you have any ideas for new theme features, options or demo sites - please let us know! We will be more than glad to add them in next updates!', 'engage' ); ?></p>
			    		<a target="_blank" href="<?php echo esc_url( 'https://goo.gl/forms/tr7v2Rf6uqB1NCHA3' ); ?>" class="engage-more-link"><?php esc_html_e( 'Post a suggestion', 'engage' ); ?><i class="fa fa-angle-right"></i></a>
			    	</div>

		    	</div>
                <div class="engage-grid-row">

                    <div class="engage-grid-col col-4">
			    		<h4><i class="fa fa-download"></i> <?php esc_html_e( 'Demo Sites', 'engage' ); ?></h4>
			    		<p><?php esc_html_e( 'Get your site up and running in a moment with our pre-defined demo sites. Import one of the demos, change pictures and texts and you are great to go.', 'engage' ); ?></p>
			    		<a href="<?php echo esc_url( admin_url( 'admin.php?page=engage-demo' ) ); ?>" class="engage-more-link"><?php esc_html_e( 'Import the Demo Content', 'engage' ); ?><i class="fa fa-angle-right"></i></a>
			    	</div>

                    <div class="engage-grid-col col-4">
			    		<h4><i class="fa fa-support"></i> <?php esc_html_e( 'Support', 'engage' ); ?></h4>
			    		<p><?php esc_html_e( 'There are various ways of gettings support starting with an extensive Theme Documentation, through KB Articles and individual Tickets.', 'engage' ); ?></p>
			    		<a href="<?php echo esc_url( admin_url( 'admin.php?page=engage-support' ) ); ?>" class="engage-more-link"><?php esc_html_e( 'Get support', 'engage' ); ?><i class="fa fa-angle-right"></i></a>
			    	</div>
                    <div class="engage-grid-col col-4 engage-keep-in-touch">
			    		<h4><i class="fa fa-smile-o"></i> <?php esc_html_e( 'Keep in touch!', 'engage' ); ?></h4>
                        <ul>
                            <li><a class="engage-more-link" target="_blank" href="http://facebook.com/veented"><i class="fa fa-facebook engage-icon-pre"></i> <?php esc_html_e( 'Like us on Facebook', 'engage' ); ?></a></li>
                            <li><a class="engage-more-link" target="_blank" href="http://twitter.com/veented"><i class="fa fa-twitter engage-icon-pre"></i> <?php esc_html_e( 'Follow us on Twitter', 'engage' ); ?></a></li>
                            <li><a class="engage-more-link" target="_blank" href="http://eepurl.com/dbX6cH"><i class="fa fa-envelope-o engage-icon-pre"></i> <?php esc_html_e( 'Sign up for a Newsletter', 'engage' ); ?></a></li>
                        </ul>
			    	</div>
		    	</div>

		    </div>

		</div>
	    <?php
	    }

	    function dashboard_theme_options_blank() {

	    	$this->dashboard_page_header( 'engage-options' );

	    ?>

	    	<h1 class="engage-page-title"><?php echo esc_html__( 'Theme Options', 'engage' ); ?></h1>

	        <?php $this->dashboard_nav( 'Engage' ); ?>

	        <div class="engage-grid-container engage-grid-bg">
	        	<div class="engage-grid-row">
	    	    	<div class="engage-grid-col col-6">
	    	    		<h4><i class="fa fa-exclamation-triangle"></i> <?php esc_html_e( 'Engage Core plugin required.', 'engage' ); ?></h4>
	    	    		<p><?php esc_html_e( 'In order to access the Theme Options panel, please install and activate the "Engage Core" plugin.', 'engage' ); ?></p>
	    	    		<a href="<?php echo esc_url( admin_url( 'admin.php?page=engage-plugins' ) ); ?>" class="engage-more-link" target="_blank"><?php esc_html_e( 'Activate the plugin now', 'engage' ); ?><i class="fa fa-angle-right"></i></a>
	    	    	</div>
	    	    </div>
	        </div>

	    </div>

	    <?php
	    }

	    function dashboard_page_demo() {

	    $this->dashboard_page_header( 'engage-demo-blank' );

	    ?>

	    	<h1 class="engage-page-title"><?php echo esc_html__( 'Demo Sites', 'engage' ); ?></h1>

	    	<p class="engage-page-desc"><?php echo esc_html__( 'Importing pre-built Demo Sites is the easiest way to setup your theme. It will allow you to quickly edit everything instead of creating content from scratch.', 'engage' ); ?></p>

	        <?php $this->dashboard_nav( 'engage-demo' ); ?>

	        <div class="engage-grid-container engage-grid-bg">
	        	<div class="engage-grid-row">
	    	    	<div class="engage-grid-col col-6">
	    	    		<h4><i class="fa fa-exclamation-triangle"></i> <?php esc_html_e( 'Engage Core plugin required.', 'engage' ); ?></h4>
	    	    		<p><?php esc_html_e( 'In order to access Demo Sites, please install and activate the "Engage Core" plugin.', 'engage' ); ?></p>
	    	    		<a href="<?php echo esc_url( admin_url( 'admin.php?page=engage-plugins' ) ); ?>" class="engage-more-link" target="_blank"><?php esc_html_e( 'Activate the plugin now', 'engage' ); ?><i class="fa fa-angle-right"></i></a>
	    	    	</div>
	    	    </div>
	        </div>

	    </div>

	    <?php
	    }

	    function dashboard_system_status() {
	    ?>
	    <div class="wrap engage-wrap">

			<h1 class="engage-page-title"><?php echo esc_html__( 'Engage Demo Content', 'engage' ); ?></h1>

			<p class="engage-page-desc"><?php echo esc_html__( 'Get your site up and running in a moment with our pre-defined demo sites. Import one of the demos, change pictures and texts and you are great to go.', 'engage' ); ?></p>

		    <?php $this->dashboard_nav( 'engage-demo' ); ?>

		    <div class="engage-grid-container engage-grid-bg">
		    	<div class="engage-grid-row">
		    		<div class="engage-grid-col col-1">
		    			<h4>
		    				<i class="fa fa-bullhorn"></i> <?php esc_html_e( 'Important Information', 'engage' ); ?>
		    			</h4>

		    			<p>
		    				<?php esc_html_e( 'Make sure that you read these before your proceed:', 'engage' ); ?>
		    			</p>
		    			<ul>
		    				<li>Test</li>
		    				<li>Info 2</li>
		    			</ul>
		    		</div>
	        		<div class="engage-grid-col col-6">
	        			<?php

	        			$output = '';

	        			$global_status = true;
	        			$global_status_class = 'engage-status-correct';
	        			$global_status_label = esc_html__( 'All okay!', 'engage' );

	        			$status_class_problem = 'engage-status-problem';
	        			$status_class_correct = 'engage-status-correct';
	        			$status_label_correct = '<i class="fa fa-check"></i>';
	        			$status_label_problem = '<i class="fa fa-close"></i>';

	        			// Engage Core plugin installed

	        			if ( function_exists( 'wp_is_writable' ) ) {

	        				$status_writeable = $status_label_problem;
	        				$status_class = $status_class_problem;

	        				$upload_dirs = wp_upload_dir();

	        				if ( array_key_exists( 'basedir', $upload_dirs ) ) {

	        					if ( wp_is_writable( $upload_dirs[ 'basedir' ] ) ) {
	        						$status_writeable = $status_label_correct;
	        						$status_class = $status_class_correct;
	        					} else {
	        						$global_status = false;
	        					}

	        				}

	        				$output .= '<li><label>' . esc_html__( 'Uploads folder writable', 'engage' ) . ':</label> <span class="engage-value ' . esc_attr( $status_class ) . '">' . $status_writeable . '</span></li>';

	        			?>

	        			<?php

	        			} // End status uploads folder writeable

	        			if ( function_exists( 'ini_get' ) ) {

	        				$options = array(
	        					'post_max_size' => array(
	        						'label' => esc_html__( 'Post Max Size', 'engage' ),
	        						'required' => 64
	        					),
	        					'memory_limit' => array(
	        						'label' => esc_html__( 'Memory Limit', 'engage' ),
	        						'required' => 128
	        					),
	        					'max_execution_time' => array(
	        						'label' => esc_html__( 'Max Execution Time', 'engage' ),
	        						'required' => 120
	        					)
	        				);

	        				foreach ( $options as $option_id => $option_params ) {

	        					$status_class = $status_class_problem;
	        					$status_text = $status_label_problem;

	        					$recommended_label = '';

	        					$option_value = str_replace( 'M', '', ini_get( $option_id ) );

	        					if ( intval( $option_value ) >= $option_params[ 'required' ] ) {
	        						$status_class = $status_class_correct;
	        						$status_text = $status_label_correct;
	        					} else {
	        						if ( array_key_exists( 'recommended_label', $option_params ) ) {
	        							$recommended_label = $option_params[ 'recommended_label' ];
	        						} else {
	        							$recommended_label = '<span class="engage-recommended">' . esc_html__( 'Recommended', 'engage' ) . ': ' . $option_params[ 'required' ] . '</span>';
	        						}
	        						$global_status = false;

	        					}

	        					$status_value = ini_get( $option_id );

	        					$output .= '<li><label>' . esc_html( $option_params[ 'label' ] ) . ':</label> <span class="engage-value ' . esc_attr( $status_class ) . '">' .  esc_html( $status_value ) . '</span>' . $recommended_label . '</li>';

	        				}



	        			} // ini_get() exists

	        			if ( $global_status == false ) {
	        				$global_status_class = 'engage-status-problem';
	        				$global_status_label = esc_html__( 'Needs improvements', 'engage' );
	        			}

	        			?>
	        			<h4>
	        				<i class="fa fa-tasks"></i> <?php esc_html_e( 'System Status', 'engage' ); ?>
	        				<span class="engage-heading-status <?php echo esc_attr( $global_status_class ); ?>"><?php echo esc_html( $global_status_label ); ?></span>
	        			</h4>
	        			<ul class="engage-system-status">
	        				<?php

	        				// Everything already sanitised within the variable
	        				echo $output;

	        				?>
	        			</ul>

	        			<?php

	        			if ( $global_status == false ) {
	        				echo '<p class="engage-status-problem">' . esc_html__( 'It is recommended that your site meets all of the above criteria so you don\'t have any issues while importing the demo content.', 'engage' ) . '</p>';
	        				echo '<a href="" class="engage-more-link" target="_blank">' . esc_html__( 'Learn more how to increase them', 'engage' ) . '<i class="fa fa-angle-right"></i></a>';
	        			} else {
	        				echo '<p>' . esc_html__( 'Everything seems to be all right, great!', 'engage' ) . '</p>';
	        			}

	        			?>
	        		</div>
		    	</div>
		    </div>

		</div>
	    <?php
	    }

	    // Plugins

	    function dashboard_page_plugins() {

	    $this->dashboard_page_header( 'engage-plugins' );
	    ?>

	    	<h1 class="engage-page-title"><?php echo esc_html__( 'Engage Theme Plugins', 'engage' ); ?></h1>

	    	<p class="engage-page-desc"><?php echo esc_html__( "This is a place where you can easily manage all Engage theme related plugins. The theme requires only two plugins: 'Engage Core' and 'WPBakery Page Builder' (former Visual Composer). The other ones aren't mandatory.", 'engage' ); echo ' ' . esc_html__( 'If you cannot find an update for a particular bundled plugin, please visit our', 'engage' ) . ' <a href="https://plugins.veented.com/" target="_blank">Veented Plugins</a> ' . esc_html__( 'service.', 'engage' ); ?></p>

	        <?php $this->dashboard_nav( 'engage-plugins' ); ?>

	        <?php

	        $plugins = array(
	        	'engage-core' => array(
	        		'name' => 'Engage Core',
	        		'slug' => 'engage-core',
	        		'required' => true,
	        	),
	        	'visual-composer' => array(
	        		'name' => 'WPBakery Page Builder',
	        		'slug' => 'js_composer',
	        		'required' => true
	        	),
	        	'revslider' => array(
	        		'name' => 'Revolution Slider',
	        		'slug' => 'revslider',
	        	),
	        	'LayerSlider' => array(
	        		'name' => 'Layer Slider',
	        		'slug' => 'LayerSlider'
	        	),
						'templatera' => array(
	        		'name' => 'Templatera',
	        		'slug' => 'templatera'
	        	),
	        	'essential-grid' => array(
	        		'name' => 'Essential Grid',
	        		'slug' => 'essential-grid'
	        	),
	        	'contact-form-7' => array(
	        		'name' => 'Contact Form 7',
	        		'slug' => 'contact-form-7'
	        	),
	        	'woocommerce' => array(
	        		'name' => 'WooCommerce',
	        		'slug' => 'woocommerce'
	        	),
						'classic-editor' => array(
	        		'name' => 'Classic Editor',
	        		'slug' => 'classic-editor',
							'desc' => esc_html__( 'Enables the previous Classic Editor and the old-style Edit Post screen with TinyMCE, Meta Boxes, etc.', 'engage' )
	        	),
						'the-events-calendar' => array(
	        		'name' => 'The Events Calendar',
	        		'slug' => 'the-events-calendar'
	        	),

	        );

	        ?>

	        <div class="engage-grid-container engage-grid-bg">

	        	<div class="engage-plugins-grid theme-browser">
	        		<div class="themes wp-clearfix">

	        			<?php

	        			$img_path = get_template_directory_uri() . '/framework/admin/assets/logos/';

	        			foreach( $plugins as $plugin_id => $plugin ) {

	        				// Is active plugin?

	        				$button_label = esc_html__( 'Activate', 'engage' );
	        				$button_classes = '';
	        				$item_classes = 'plugin-active';

									$title = '';

									if ( isset( $plugin['desc'] ) ) {
										$title = ' title="' . $plugin['desc'] . '"';
									}

	        				// Get TGMPA class instance

	        				$tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );

									// Plugins

									$action = $button_url = $update_url = '';

									$update_available = false;

									// Check plugin status

	        				if ( ! $tgmpa_instance->is_plugin_installed( $plugin['slug'] ) ) {
	        					$button_label = esc_html__( 'Install', 'engage' );
	        					$action = 'install';
	        					$item_classes = 'plugin-inactive';
	        				} elseif ( ! $tgmpa_instance->is_plugin_active( $plugin['slug'] ) ) {
	        					$button_label = esc_html__( 'Activate', 'engage' );
	        					$button_classes = ' plugin-installed';
	        					$action = 'activate';
	        				} else {
	        					$button_label = esc_html__( 'Deactivate', 'engage' );
	        					//$button_classes = ' plugin-activated';
	        					$item_classes = 'active';
	        					$button_url = admin_url( 'plugins.php' );

	        					if ( false !== $tgmpa_instance->does_plugin_have_update( $plugin['slug'] ) && $tgmpa_instance->can_plugin_update( $plugin['slug'] ) ) {
	        						$update_available = true;

	        						$action_here = 'update';
	        						$update_url = wp_nonce_url(
	        							add_query_arg(
	        								array(
	        									'plugin' => urlencode( $plugin['slug'] ),
	        									'tgmpa-' . $action_here => $action_here . '-plugin',
	        								),
	        								$tgmpa_instance->get_tgmpa_url()
	        							),
	        							'tgmpa-' . $action_here,
	        							'tgmpa-nonce'
	        						);
	        					}
	        				}

	        				// Button action

	        				if ( $action != '' ) {
		        				$button_url = wp_nonce_url(
		        					add_query_arg(
		        						array(
		        							'plugin' => urlencode( $plugin['slug'] ),
		        							'tgmpa-' . $action => $action . '-plugin',
		        						),
		        						$tgmpa_instance->get_tgmpa_url()
		        					),
		        					'tgmpa-' . $action,
		        					'tgmpa-nonce'
		        				);
		        			}

	        				// Output

	        				echo '<div class="theme ' . esc_attr( $item_classes ) . '" data-slug="' . esc_attr( $plugin_id ) . '">';

	        				echo '<div class="theme-screenshot">';

	        				// Check if update available
	        				if ( $update_available ) {
	        					echo '<div class="plugin-label plugin-update-available">' . esc_html__( 'Update available.', 'engage' ) . '<a href="' . esc_url( $update_url ) . '" class="button button-update">' . esc_html__( 'Update now', 'engage' ) . '</a></div>';
	        				} elseif ( array_key_exists( 'required', $plugin ) ) {
	        					echo '<div class="plugin-label plugin-required">' . esc_html__( 'Required', 'engage' ) . '</div>';
	        				}

	        				echo '<img src="' . esc_url( $img_path . $plugin_id . '.png' ) . '"' . $title . '>';

	        				echo '</div>';

	        				echo '<div class="theme-id-container"><h2 class="theme-name"' . $title . '>';

	        				if ( $item_classes == 'active' ) echo '<span>' . esc_html__( 'Active', 'engage' ) . '</span> ';

	        				echo esc_html( $plugin[ 'name' ] ) . '</h2>';

	        				// Actions

	        				echo '<div class="theme-actions">';
	        					echo '<a class="button button-primary' . esc_attr( $button_classes ) . '" href="' . esc_url( $button_url ) . '">' . esc_html( $button_label ) . '</a>';
	        				echo '</div>';

	        				echo '</div></div>';
	        			}

	        			?>
	        		</div>
	        	</div>

	        </div>

	    </div>
	    <?php
	    }

	    // Support

	    function dashboard_page_support() {

	    	$this->dashboard_page_header( 'engage-support' );
	    ?>

	    	<h1 class="engage-page-title"><?php echo esc_html__( 'Engage Theme Support', 'engage' ); ?></h1>

	    	<p class="engage-page-desc"><?php echo esc_html__( 'There are various ways of gettings support starting with an extensive Theme Documentation, through KB Articles and individual Tickets.', 'engage' ); ?></p>

	        <?php $this->dashboard_nav( 'engage-support' ); ?>

	        <div class="engage-grid-container engage-grid-bg">
	        	<div class="engage-grid-row">
	    	    	<div class="engage-grid-col col-4">
	    	    		<h4><i class="fa fa-book"></i> <?php esc_html_e( 'Theme Documentation', 'engage' ); ?></h4>
	    	    		<p><?php esc_html_e( 'Get started with Engage theme by following the Theme Documentation where you can find all the necessary information.', 'engage' ); ?></p>
	    	    		<a href="http://veented.com/docs/engage/" class="engage-more-link" target="_blank"><?php esc_html_e( 'Go to Theme Documentation', 'engage' ); ?><i class="fa fa-angle-right"></i></a>
	    	    	</div>
	    	    	<div class="engage-grid-col col-4">
	    	    		<h4><i class="fa fa-file-text-o"></i> <?php esc_html_e( 'Articles', 'engage' ); ?></h4>
	    	    		<p><?php esc_html_e( 'Looking for more information? You can probably find it in our Knowledgebase of articles.', 'engage' ); ?></p>
	    	    		<a href="https://veented.ticksy.com/articles/100011018" class="engage-more-link" target="_blank"><?php esc_html_e( 'View Articles', 'engage' ); ?><i class="fa fa-angle-right"></i></a>
	    	    	</div>
	    	    	<div class="engage-grid-col col-4">
	    	    		<h4><i class="fa fa-support"></i> <?php esc_html_e( 'Support Center', 'engage' ); ?></h4>
	    	    		<p><?php esc_html_e( 'Have some other questions? Just submit a support ticket and our support staff will be more than glad to help!', 'engage' ); ?></p>
	    	    		<a href="https://veented.ticksy.com/" class="engage-more-link" target="_blank"><?php esc_html_e( 'Submit a ticket', 'engage' ); ?><i class="fa fa-angle-right"></i></a>
	    	    	</div>
	    	    </div>
	        </div>

	        <div class="engage-grid-container engage-grid-bg">
	        	<div class="engage-grid-row">
	            	<div class="engage-grid-col col-4">
	            		<h4><i class="fa fa-pencil"></i> <?php esc_html_e( 'Hire us!', 'engage' ); ?></h4>
	            		<p><?php esc_html_e( 'Are you looking for theme customization services? Look no further - get it directly from the Engage theme developers.', 'engage' ); ?></p>
	            		<a href="<?php echo esc_url( admin_url( 'admin.php?page=engage-customization' ) ); ?>" class="engage-more-link"><?php esc_html_e( 'Learn More', 'engage' ); ?><i class="fa fa-angle-right"></i></a>
	            	</div>
	            	<div class="engage-grid-col col-4 engage-keep-in-touch">
			    		<h4><i class="fa fa-smile-o"></i> <?php esc_html_e( 'Keep in touch!', 'engage' ); ?></h4>
                        <ul>
                            <li><a class="engage-more-link" target="_blank" href="http://facebook.com/veented"><i class="fa fa-facebook engage-icon-pre"></i> <?php esc_html_e( 'Like us on Facebook', 'engage' ); ?></a></li>
                            <li><a class="engage-more-link" target="_blank" href="http://twitter.com/veented"><i class="fa fa-twitter engage-icon-pre"></i> <?php esc_html_e( 'Follow us on Twitter', 'engage' ); ?></a></li>
                            <li><a class="engage-more-link" target="_blank" href="http://eepurl.com/dbX6cH"><i class="fa fa-envelope-o engage-icon-pre"></i> <?php esc_html_e( 'Sign up for a Newsletter', 'engage' ); ?></a></li>
                        </ul>
			    	</div>

	            </div>

	        </div>

	    </div>
	    <?php
	    }

	    function dashboard_page_header( $class = null ) {

	    	$theme_version = '1.0';
	    	$the_theme = wp_get_theme( get_template() );

	    	if ( is_object( $the_theme ) ) {
	    		$theme_version = $the_theme->get( 'Version' );
	    	}

	    	?>
	    	<div class="wrap engage-wrap <?php esc_attr( $class ); ?>">
	    		<div class="wp-badge engage-badge"><?php echo esc_html( $theme_version ); ?></div>
	    	<?php
	    }

	    // Customization

	    function dashboard_page_customization() {

	    	$this->dashboard_page_header( 'engage-customization' );

	    ?>

	    	<h1 class="engage-page-title"><?php echo esc_html__( 'Customization Services', 'engage' ); ?></h1>

	    	<p class="engage-page-desc"><?php echo esc_html__( 'Are you looking for a professional website customization services? Look no further - get it straight from the Engage theme developers.', 'engage' ); ?></p>

	        <?php $this->dashboard_nav( 'engage-customization' ); ?>

	        <div class="engage-grid-container engage-grid-bg">
	        	<div class="engage-grid-row">
	    	    	<div class="engage-grid-col col-4">
	    	    		<h4><i class="fa fa-pencil"></i> <?php esc_html_e( 'Site Customization', 'engage' ); ?></h4>
	    	    		<p><?php esc_html_e( 'We can do absolutely any PHP, CSS, JS or HTML related task: from small tweaks to big customization requests. We can also integrate a REST service with your website.', 'engage' ); ?></p>
	    	    		<a href="http://studio.veented.com/?ref=theme" class="engage-more-link engage-btn-primary" target="_blank"><?php esc_html_e( 'Get a Quote', 'engage' ); ?><i class="fa fa-angle-right"></i></a>
	    	    	</div>
	    	    	<div class="engage-grid-col col-4">
	    	    		<h4><i class="fa fa-file-text-o"></i> <?php esc_html_e( 'Content Management', 'engage' ); ?></h4>
	    	    		<p><?php esc_html_e( 'We can build your website\'s content with Engage theme. Either you have it in a graphical format or as a sketch in your mind, we can help!', 'engage' ); ?></p>

	    	    		<a href="http://studio.veented.com/?ref=theme" class="engage-more-link engage-btn-primary" target="_blank"><?php esc_html_e( 'Get a Quote', 'engage' ); ?><i class="fa fa-angle-right"></i></a>
	    	    	</div>
	    	    	<div class="engage-grid-col col-4">
	    	    		<h4><i class="fa fa-cog"></i> <?php esc_html_e( 'Theme Installation & Setup', 'engage' ); ?></h4>
	    	    		<p><?php esc_html_e( 'Having troubles installing the theme? We will do that for you: install required plugins, import your desired demo site and set some basic options.', 'engage' ); ?></p>
	    	    		<a href="http://studio.veented.com/?ref=theme" class="engage-more-link engage-btn-primary" target="_blank"><?php esc_html_e( 'Get a Quote', 'engage' ); ?><i class="fa fa-angle-right"></i></a>
	    	    	</div>
	    	    </div>
	        </div>

	    </div>
	    <?php
	    }

	}

	$engage_dashboard = new Engage_Dashboard();

}
