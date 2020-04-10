<?php

/**
 * Gutenberg Dynamic Stylesheet
 *
 * @since 1.0
 *
 */

header( "Content-type: text/css;" );

$engage_options_accent_color = '#218fe6';
$engage_options_accent_color2 = '#f35050';
$engage_options_accent_color3 = '#222222';

if ( engage_option('accent_color') ) {
   	$engage_options_accent_color = esc_attr(engage_option('accent_color'));
}
if ( engage_option('accent_color2') ) {
	$engage_options_accent_color2 = esc_attr(engage_option('accent_color2'));
}
if ( engage_option('accent_color3') ) {
	$engage_options_accent_color3 = esc_attr(engage_option('accent_color3'));
}

if ( !function_exists('engage_print_css_rule') ) {
	function engage_print_css_rule( $css_selector, $attribute, $value, $important = false ) {

		$important_dec = '';

		if ( $important == true ) {
			$important_dec = '!important;';
		}

		if ( is_array( $css_selector ) ) {
			echo implode( ',', $css_selector);
		} else {
			echo esc_attr( $css_selector );
		}

		echo '{';
		if ( is_array( $attribute ) ) {
			foreach ( $attribute as $attr ) {
				echo esc_attr( $attr ) . ':' . esc_attr( $value ) . $important_dec . ';';
			}
		} else {
			echo esc_attr( $attribute ) . ':' . esc_attr( $value ) . $important_dec . ';';
		}
		echo '}';
	}
}

if ( !function_exists('engage_hex2rgba') ) {
	function engage_hex2rgba($color, $opacity = false) {

		$default = 'rgb(0,0,0)';

		//Return default if no color provided
		if (empty($color))
	          return $default;

		//Sanitize $color if "#" is provided
	        if ($color[0] == '#' ) {
	        	$color = substr( $color, 1 );
	        }

	        //Check if color has 6 or 3 characters and get values
	        if (strlen($color) == 6) {
	                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	        } elseif ( strlen( $color ) == 3 ) {
	                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	        } else {
	                return $default;
	        }

	        //Convert hexadec to rgb
	        $rgb =  array_map('hexdec', $hex);

	        //Check if opacity is set(rgba or rgb)
	        if ($opacity || $opacity == 0){
	        	if (abs($opacity) > 1)
	        		$opacity = 1.0;
	        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	        } else {
	        	$output = 'rgb('.implode(",",$rgb).')';
	        }

	        //Return rgb(a) color string
	        return $output;
	}
}

?>

<?php
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		General
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
?>


/* Accent Text Colors */

.block-editor div[data-block] a:hover,.block-editor div[data-block] p a,.block-editor div[data-block] table a,.block-editor div[data-block] li > a,.wp-block-freeform.block-library-rich-text__tinymce a, .vntd-accent-color, .wp-block-freeform.block-library-rich-text__tinymce a,.wp-block-freeform.block-library-rich-text__tinymce a {
	color: <?php echo esc_attr( $engage_options_accent_color ); ?>;
}

<?php

function engage_print_typography( $name, $typography_array ) {

	$rules = $fix = '';

	if ( !engage_option( $name ) ) return false;

	foreach ( $typography_array as $attr => $default ) {
		if ( $attr != 'selectors' && ( $value = engage_option( $name, $attr ) ) != $default && engage_option( $name, $attr ) != '' )  {
			if ( $attr == 'font-family' ) {
				$rules .= $attr . ':' . $value . ';';
			} else {
				$rules .= $attr . ':' . esc_html( $value ) . ';';
			}

		}
	}

	if ( $rules != '' ) {
		echo esc_attr( $fix ) . $typography_array[ 'selectors' ] . '{' . $rules . '}';
	}

	return false;

}

// Typography Headings

$heading_extras = $body_extras = '';

// Extra selectors

if ( engage_option( 'typography_navigation_font' ) != 'body' ) {
	$heading_extras = ',#main-menu > ul > li a,.main-menu > ul > li > a';
} else {
	$body_extras = ',#main-menu > ul > li a,.main-menu > ul > li > a';
}

// Array of defaults:

$typography_array = array(
	'selectors' => '.editor-writing-flow h1,.editor-writing-flow h2,.editor-writing-flow h3,.editor-writing-flow h4,.editor-writing-flow h5,.editor-writing-flow h6,.w-option-set' . $heading_extras,
	'font-family' => 'Open Sans',
	'font-weight' => '400',
	'text-transform' => 'none'
);

engage_print_typography( 'typography_primary', $typography_array );

// Typography Body

$typography_array = array(
	'selectors' => '.editor-block-list__block p,.editor-writing-flow .editor-block-list__block p,.editor-writing-flow,.wp-block-freeform.block-library-rich-text__tinymce body,.wp-block-freeform.block-library-rich-text__tinymce' . $body_extras,
	'font-family' => 'Open Sans',
	'font-weight' => '400',
	'text-transform' => 'none',
	'font-size' => '16px'
);

engage_print_typography( 'typography_body', $typography_array );

?>
