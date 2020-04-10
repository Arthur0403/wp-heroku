<?php

define( 'engage_SHORTCODES', plugin_dir_path( __FILE__ ) );

// Load complex shortcodes from the /lib/ folder

if ( ! defined( 'WPB_VC_VERSION' ) ) {

  foreach ( scandir( dirname(__FILE__) . '/lib/' ) as $filename ) {
      $path = dirname(__FILE__) . '/lib/' . $filename;
      if ( is_file( $path ) && preg_match( '%\.php$%', $filename ) ) {
          include_once $path;
      }
  }

}

// Add TinyMCE Button

add_action('init', 'veented_add_tinymce_button');

function veented_add_tinymce_button() {
	//if(strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') || strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php')) {
			add_filter('mce_external_plugins', 'veented_add_tinymce_plugin');
			add_filter('mce_buttons', 'veented_register_tinymce_button');
	//}
}

function veented_register_tinymce_button($buttons) {
   array_push($buttons, 'separator', "veented_shortcodes_button");
   //array_push($buttons, "waxom_visual_button");
   return $buttons;
}

function veented_add_tinymce_plugin($plugin_array) {
   $plugin_array['veented_shortcodes_button'] = plugins_url() . '/engage-core/shortcodes/tinymce/tinymce-quick-shortcodes.js';
   return $plugin_array;
}

// - - -
// Function removing extra br and p tags
// - - -

function engage_do_shortcode($content) {
    $array = array('<p>[' => '[','<br />[' => '[', '<br>[' => '[', ']</p>' => ']', ']<br />' => ']', ']<br>' => ']');
    $content = strtr($content, $array);
    return do_shortcode($content);
}

// - - - - - - - - - -
// Separator
// - - - - - - - - - -

function engage_separator($atts, $content=null){
	extract(shortcode_atts(array(
		"type" => '',
		"style" => 'default',
		"label" => '',
		"align" => 'center',
		"space_height" => ''
	), $atts));

	$separator_class = $separator_label = '';

	if($type != "space") {
		if($style != "default") {
			$separator_class .= ' separator-shadow';
		}
		if($type == "fullwidth") {
			$separator_class .= ' separator-fullwidth';
		}
		if($label) {
			$separator_label = '<div>'.$label.'</div>';
			$separator_class .= ' separator-text-align-'.$align;
		}
		$output = '<div class="separator'.esc_attr($separator_class).'">'.esc_html($separator_label).'</div>';
	} else {
		if($space_height != 40) {
			$space_style = 'style="height:'.esc_attr($space_height).'px;"';
		}
		$output = '<div class="white-space"'.esc_attr($space_style).'></div>';
	}


	return $output;

}
remove_shortcode('separator');
add_shortcode('separator', 'engage_separator');

function engage_spacer($atts, $content=null){
	extract(shortcode_atts(array(
		"height" => '40'
	), $atts));

	if($height != 40) {
		$height_style = 'style="height:'.esc_attr($height).'px;"';
	}

	return '<div class="spacer"'.esc_attr($height_style).'></div>';

}
remove_shortcode('spacer');
add_shortcode('spacer', 'engage_spacer');


// - - - - - - - - - -
// Typography
// - - - - - - - - - -

function engage_headsding($atts, $content=null) {
	extract(shortcode_atts(array(
		"title" => 'Main Heading Text',
		"subtitle" => 'This is a subtitle, feel free to change it!',
		"uptitle" => '',
		"animated" => 'no',
		"heading_margin_bottom" => '35',
		"separator"		=> 'yes',
		"font"			=> 'primary', // Primary, secondary, Georgia
		"font_size"		=> '30',
		"font_weight"	=> 'default',
		"text_transform" => 'uppercase', // Uppercase
		"text_align"	=> 'center',
		"italic"		=> 'no',
		"el_class"		=> ''
	), $atts));

	$animation_class = $animation_data = $margin_style = $font_class = '';

	if($animated != 'no') {
		$animation_class = Engage_Core::get_animated_class();
		$animation_data = ' data-animation="fadeIn" data-animation-delay="100"';
	}
	$margin_bottom = str_replace('px','',$heading_margin_bottom);
	if($margin_bottom != 30 && $margin_bottom != '') {
		$margin_style = ' style="margin-bottom:'.esc_attr($margin_bottom).'px;"';
	}

	$font_class = ' font-primary';

	if($font == 'secondary') {
		$font_class = ' font-secondary';
	} elseif($font == 'georgia') {
		$font_class = ' georgia';
	}

	$text_transform_class = ' uppercase';

	if($text_transform != 'uppercase') $text_transform_class = '';

	$font_weight_class = ' font-weight-default';

	if($font_weight != 'default') $font_weight_class = ' font-weight-' . esc_attr($font_weight);

	$separator_class = ' heading-separator';
	if($separator == 'bottom') {
		$separator_class = ' heading-separator-bottom';
	} elseif($separator == 'no') {
		$separator_class = ' heading-no-separator';
	}

	$font_size_class = '';
	if($font_size != 'default') $font_size_class = ' font-size-' . esc_attr($font_size);

	// Detect highlights

	$title = esc_textarea($title);
	$title = str_replace("(b)",'<span class="colored">', $title);
	$title = htmlspecialchars_decode(str_replace("(/b)",'</span>', $title));

	$extra_class = '';

	if($italic == 'yes') $extra_class = ' special-heading-italic';

	if($el_class != '') $extra_class .= ' ' . esc_attr( $el_class );

	$return = '<div class="vntd-special-heading special-heading-align-'.esc_attr($text_align) . $separator_class . $extra_class . '"'.$margin_style.'>';

	if($uptitle != '') {
		$return .= '<h4 class="header-first ' . esc_attr($font_class) . '">' . esc_textarea($uptitle) . '</h4>';
	}

	$return .= '<h1 class="header '.esc_attr($font_class).esc_attr($animation_class) . $text_transform_class . $font_size_class . $font_class . $font_weight_class . '" '.$animation_data.'>'.$title.'</h1>';


	if($subtitle) {
		$return .= '<p class="subtitle light '.esc_attr($animation_class).'" '.$animation_data.'>'.esc_textarea($subtitle).'</p>';
	}
	$return .= '</div>';
	return $return;

}

function engage_callout_box($atts, $content=null) {
	extract(shortcode_atts(array(
		"title" => '',
		"subtitle" => ''
	), $atts));

	$return = '<div class="vntd-callout-box bs-callout bs-callout-north"><h2 class="colored uppercase font-primary">'.$title.'</h2><p>'.$subtitle.'</p></div>';

	return $return;

}


function engage_highlight( $atts, $content=null ) {
	extract( shortcode_atts( array( "color" => '', "bgcolor" => 'accent' ), $atts ) );

	$color_css = '';

	if ( $color || $bgcolor ) {
		if ( strpos( $bgcolor, '#' ) !== false ) {
			$color_css .= 'background-color:' . esc_attr( $bgcolor ) . ';';
			$bgcolor = 'custom';
		}
		if ( strpos( $color, '#' ) !== false ) {
			$color_css .= 'color:' . esc_attr( $color ) . ';';
		}
		if ( $color_css != '' ) $color_css = 'style="' . $color_css . '"';
	}

	return '<span class="vntd-highlight bg-color-' . esc_attr( $bgcolor ) . '"' . $color_css . '>' . $content . '</span>';
}

function engage_alternative($atts, $content=null) {

	return '<div class="vntd-alternative-section">'.$content.'</div>';
}

function engage_dropcap1( $atts, $content=null ) {
	extract( shortcode_atts( array( "color" => '', "style" => '1', "size" => 'normal' ), $atts ) );

	$color_css = '';

	if ( $color && $color != 'accent' ) {

		if ( $style == '1' ) {
			$color_css = 'style="color:' . esc_attr( $color ) . '"';
		} else if ( $style == 'circle' ) {
			$color_css = 'style="background-color:' . esc_attr( $color ) . '"';
		}
		$color = 'custom';
	}

	return '<span class="dropcap vntd-dropcap dropcap-' . esc_attr( $style ) . ' dropcap-' . esc_attr( $color ) . ' dropcap-' . esc_attr( $size ) . '"' . $color_css . '>' . $content . '</span>';
}

function engage_quote($atts, $content=null) {
	extract(shortcode_atts(array("style" => 'style1', 'author' => ''), $atts));

	return '<blockquote class="blockquote-'.esc_attr($style).' vntd-custom-blockquote"><div class="blockquote-content">'.$content.'</div><div class="blockquote-author">'.$author.'</div></blockquote>';
}

function engage_tooltip($atts, $content=null) {
	extract(shortcode_atts(array("style" => 'style1', "label" => 'Your text'), $atts));

	$length = strlen($label)*8;
	$lengthHalf = $length/2;
	return '<span class="vntd-tooltip tooltip-'.esc_attr($style).'">'.$content.'<span class="vntd-tooltip-label" style="width:'.$length.'px;margin-left:-'.$lengthHalf.'px;">'.$label.'</span></span>';
}

function engage_text($atts, $content=null) {
	extract(shortcode_atts(array("size" => '20'), $atts));

	return '<p class="vntd-text" style="font-size:'.str_replace('px','',esc_attr($size)).'px;">'.$content.'</p>';
}

remove_shortcode('tooltip');
remove_shortcode('highlight');
remove_shortcode('alternative');
remove_shortcode('dropcap');
remove_shortcode('quote');
remove_shortcode('callout_box');
remove_shortcode('text');

add_shortcode('tooltip', 'engage_tooltip');
add_shortcode('dropcap', 'engage_dropcap1');
add_shortcode('alternative', 'engage_alternative');
add_shortcode('highlight', 'engage_highlight');
add_shortcode('quote', 'engage_quote');
add_shortcode('tooltip', 'engage_tooltip');
add_shortcode('callout_box', 'engage_callout_box');
add_shortcode('text', 'engage_text');
