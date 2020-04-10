<?php

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Contact Block
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

require_once ENGAGE_CORE_PATH . '/shortcodes/lib/contact-form/vendor/Helpers/Config.class.php';
require_once ENGAGE_CORE_PATH . '/shortcodes/lib/contact-form/vendor/SimpleMail/SimpleMail.class.php';

function engage_contact_form( $atts, $content = null ) {

	extract(shortcode_atts(array(
		"id" => '',
		"color_scheme" => '',
		"btn_align" => 'left',
		"css" => ''
	), $atts));

	// WPBakery Page Builder Check
	if ( ! function_exists( 'vc_shortcode_custom_css_class' ) ) {
		return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
	}

	$config = new Engage_Mail_Config;

	$config_data = engage_contact_config();

	$config->load_config( $config_data );

	// Btn CSS

	$btn_css = '';
	if ( $btn_align == 'center' ) $btn_css = ' btn-center';

	// If the form is submitted

	ob_start();

	wp_enqueue_script( 'engage-contact', '', '', '', true );

	$el_css = vc_shortcode_custom_css_class( $css );

	?>

	<div class="contact-form-holder <?php echo esc_attr( $el_css ); ?>">

		<form enctype="application/x-www-form-urlencoded;" id="engage-contact-form" class="form-horizontal vntd-contact-form contact-form-modern" role="form" method="post" data-path="<?php echo ENGAGE_CORE_URI . 'shortcodes/lib/contact-form/process.php'; ?>">

	    	<div class="form-row">
	    		<div class="row">
		        	<div class="col-md-6">
		        		<span class="form-input-holder">
		        			<input type="text" name="form-name" value="" size="40" id="form-name" class="form-control" placeholder="<?php echo engage_translate( 'name' ); ?>" required>
		        		</span>
		        	</div>
		        	<div class="col-md-6">
		        		<span class="form-input-holder">
			        		<input type="email" name="form-email" id="form-email" value="" size="40" class="form-control" placeholder="<?php echo engage_translate( 'email' ); ?>" required>
		        		</span>
		        	</div>
		        </div>
	    	</div>

	    	<div class="form-group" id="subject-field">
	    		<span class="form-input-holder">
	    			<input type="text" id="form-subject" name="form-subject" value="" size="40" class="form-control" placeholder="<?php echo engage_translate( 'subject' ); ?>" required>
	    		</span>
	    	</div>

	    	<div class="form-row">
	    		<span class="form-input-holder">
	    			<textarea cols="40" rows="10" class="form-control" id="form-message" name="form-message" placeholder="<?php echo engage_translate( 'message' ); ?>" required></textarea>
	    		</span>
	    	</div>
            <?php
            if ( engage_option( 'cf_consent_ask' ) != false ) {

                ?>
                <div class="form-row">
	    		<span class="form-input-holder">
	    			<input type="checkbox" id="engage-gdpr-consent" name="engage-gdpr-consent"
                           class="engage-form-checkbox" required>
                    <label for="engage-gdpr-consent"><?php echo engage_translate('consent-ask'); ?>*</label>
	    		</span>
                </div>
                <?php
            }
            ?>

	        <div class="form-row">
	        	<input type="hidden" class="hidden" name="destination_email" id="destination_email" value="<?php echo engage_get_contact_email(); ?>">
                <div id="vntd-success-msg" class="hidden" style="display:none;"><?php echo esc_html( engage_form_success_msg() ); ?></div>
	            <button type="submit" class="btn btn-accent<?php if( $btn_css != '' ) echo esc_attr( $btn_css ); ?>"><?php echo engage_translate( 'send' ); ?></button>
	        </div>

	    </form>

    </div>

	<?php

	$content = ob_get_contents();
	ob_end_clean();

	return $content;

}
remove_shortcode( 'engage_contact_form' );
add_shortcode( 'engage_contact_form', 'engage_contact_form' );
