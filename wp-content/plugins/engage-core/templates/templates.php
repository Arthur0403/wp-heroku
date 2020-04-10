<?php

// Engage Templates - Templatera extension

add_action( 'init', 'engage_templates_init', 9 );

function engage_templates_init() {

  // The category
  add_filter( 'vc_get_all_templates', 'engage_filter_vc_get_all_templates' );

  // Add templates
  add_filter( 'vc_templates_render_category', 'engage_filter_vc_templates_render_category', 11, 2 );

  // JavaScript
  add_action( 'admin_print_scripts-post.php', 'engage_templates_scripts' );

}

// Scripts
function engage_templates_scripts() {

  wp_register_script( 'engage_vc_plugin_templates', ENGAGE_CORE_URI . '/templates/assets/js/engage-templates.js', array(), time(), true );
  wp_enqueue_script( 'engage_vc_plugin_templates' );

}

// Category
function engage_filter_vc_get_all_templates( $data ) {

	$templatera_arr = array();

  $data[] = array(
		'templates' => $templatera_arr,
		'category' => 'engage_templates',
		'category_name' => esc_html__( 'Engage Templates', 'js_composer' ),
		'category_description' => esc_html__( 'Append previously saved template to the current layout', 'js_composer' ),
		'category_weight' => 10,
	);

  return $data;

}

// Category
function engage_filter_vc_templates_render_category( $category ) {

  if ( 'engage_templates' === $category['category'] ) {

    // Engage Templates
    $category['output'] = '<div class="vc_column vc_col-sm-12 vc_column_engage" data-vc-hide-on-search="true">';

				$templates = array(
				'img_text_1_right' => array(
					'title' => esc_html__( 'Image + Text 1', 'engage' ),
					'desc' => esc_html__( 'Content section with image and text.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1493822260304{padding-top: 90px !important;padding-bottom: 90px !important;}"][vc_column width="1/2" col_padding="2" col_padding_side="right"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-5.jpg" img_size="700x600" css_animation="none" css=".vc_custom_1493822366452{margin-bottom: 0px !important;}"][/vc_column][vc_column width="1/2" col_padding="2" col_padding_side="left"][vc_column_text font_size="medium"]
					<h3>Learn about us</h3>
					We have been operating for over 30 years and are Members of The Federation of Master Builders. We work on projects big and small from small residential extensions to full house and commercial builds and we are registered NHBC house builders.[/vc_column_text][vntd_separator][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row]',
				),
				'img_text_btn_right' => array(
					'title' => esc_html__( 'Image + Text + Btn', 'engage' ),
					'desc' => esc_html__( 'Content section with image, text and button.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1493822260304{padding-top: 90px !important;padding-bottom: 90px !important;}"][vc_column width="1/2" col_padding="2" col_padding_side="right"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-5.jpg" img_size="700x600" css_animation="none" css=".vc_custom_1493822366452{margin-bottom: 0px !important;}"][/vc_column][vc_column width="1/2" col_padding="2" col_padding_side="left"][vc_column_text]
					<h3>Learn about us</h2>
					We have been operating for over 30 years and are Members of The Federation of Master Builders. We work on projects big and small from small residential extensions to full house and commercial builds and we are registered NHBC house builders.[/vc_column_text][vntd_button label="Learn More" icon_enabled="yes" icon_fontawesome="fa fa-long-arrow-right" icon_style="right_side_hover" url="#"][/vc_column][/vc_row]',
				),
				'img_text_1_left' => array(
					'title' => esc_html__( 'Text + Image 1', 'engage' ),
					'desc' => esc_html__( 'Content section with image and text.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1493822310034{padding-top: 90px !important;padding-bottom: 90px !important;}"][vc_column width="1/2" col_padding="2" col_padding_side="right"][vc_column_text font_size="medium"]
					<h3>Learn about us</h2>
					We have been operating for over 30 years and are Members of The Federation of Master Builders. We work on projects big and small from small residential extensions to full house and commercial builds and we are registered NHBC house builders.[/vc_column_text][vntd_separator][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/2" col_padding="2" col_padding_side="left"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-5.jpg" img_size="700x600" css_animation="none" css=".vc_custom_1493822376054{margin-bottom: 0px !important;}"][/vc_column][/vc_row]',
				),
				'img_text_btn_left' => array(
					'title' => esc_html__( 'Text + Btn + Image', 'engage' ),
					'desc' => esc_html__( 'Content section with image, text and button.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1493822260304{padding-top: 90px !important;padding-bottom: 90px !important;}"][vc_column width="1/2" col_padding="2" col_padding_side="right"][vc_column_text]
					<h3>Learn about us</h2>
					We have been operating for over 30 years and are Members of The Federation of Master Builders. We work on projects big and small from small residential extensions to full house and commercial builds and we are registered NHBC house builders.[/vc_column_text][vntd_button label="Learn More" icon_enabled="yes" icon_fontawesome="fa fa-long-arrow-right" icon_style="right_side_hover" url="#"][/vc_column][vc_column width="1/2" col_padding="2" col_padding_side="left"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-5.jpg" img_size="700x600" css_animation="none" css=".vc_custom_1493822366452{margin-bottom: 0px !important;}"][/vc_column][/vc_row]',
				),
				'img_text_fullwidth' => array(
					'title' => esc_html__( 'Image + Text Fullwidth', 'engage' ),
					'desc' => esc_html__( 'Fullwidth content section with image and text.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row full_width="stretch_row_content_no_spaces" equal_height="yes" content_placement="middle" css=".vc_custom_1493830181567{padding-top: 0px !important;padding-bottom: 0px !important;}"][vc_column width="1/2" col_padding="7" css=".vc_custom_1493831432964{padding-top: 20px !important;padding-bottom: 20px !important;}"][vc_column_text font_size="medium"]
					<h3>Learn about us</h2>
					We have been operating for over 30 years and are Members of The Federation of Master Builders. We work on projects big and small from small residential extensions to full house and commercial builds and we are registered NHBC house builders.[/vc_column_text][vntd_separator][vc_column_text css=".vc_custom_1493830901966{margin-bottom: 0px !important;}"]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/2" col_padding_side="left" css=".vc_custom_1493831622616{background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-10-1600x1200.jpg) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces" equal_height="yes" content_placement="middle" css=".vc_custom_1493830181567{padding-top: 0px !important;padding-bottom: 0px !important;}"][vc_column width="1/2" css=".vc_custom_1493831227322{background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-9-1600x1200.jpg) !important;}"][/vc_column][vc_column width="1/2" col_padding="7" css=".vc_custom_1493831485949{padding-top: 20px !important;padding-bottom: 20px !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column_text font_size="medium"]<h3>Learn about us</h2>We have been operating for over 30 years and are Members of The Federation of Master Builders. We work on projects big and small from small residential extensions to full house and commercial builds and we are registered NHBC house builders.[/vc_column_text][vntd_separator][vc_column_text css=".vc_custom_1493830901966{margin-bottom: 0px !important;}"]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row]',
				),
				'img_text_btn_fullwidth' => array(
					'title' => esc_html__( 'Image, Text Fullwidth 2', 'engage' ),
					'desc' => esc_html__( 'Fullwidth content section with image and text.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row full_width="stretch_row_content_no_spaces" equal_height="yes" content_placement="middle" css=".vc_custom_1493830181567{padding-top: 0px !important;padding-bottom: 0px !important;}"][vc_column width="1/2" col_padding="7" css=".vc_custom_1493831472285{padding-top: 20px !important;padding-bottom: 20px !important;}"][vc_column_text]
					<h3>Learn about us</h2>
					[/vc_column_text][vc_column_text]We have been operating for over 30 years and are Members of The Federation of Master Builders. We work on projects big and small from small residential extensions to full house and commercial builds and we are registered NHBC house builders.[/vc_column_text][vntd_button label="Learn More" icon_enabled="yes" icon_fontawesome="fa fa-long-arrow-right" icon_style="right_side_hover" url="#"][/vc_column][vc_column width="1/2" col_padding_side="left" css=".vc_custom_1493831129794{background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-9-1600x1200.jpg) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces" equal_height="yes" content_placement="middle" css=".vc_custom_1493830181567{padding-top: 0px !important;padding-bottom: 0px !important;}"][vc_column width="1/2" css=".vc_custom_1493831638175{background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-10-1600x1200.jpg) !important;}"][/vc_column][vc_column width="1/2" col_padding="7" css=".vc_custom_1493831479492{padding-top: 20px !important;padding-bottom: 20px !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column_text]<h3>Learn about us</h2>[/vc_column_text][vc_column_text]We have been operating for over 30 years and are Members of The Federation of Master Builders. We work on projects big and small from small residential extensions to full house and commercial builds and we are registered NHBC house builders.[/vc_column_text][vntd_button label="Learn More" icon_enabled="yes" icon_fontawesome="fa fa-long-arrow-right" icon_style="right_side_hover" url="#"][/vc_column][/vc_row]',
				),
				'img_text_img_iso' => array(
					'title' => esc_html__( 'Text + Isolated Image', 'engage' ),
					'desc' => esc_html__( 'Text with an isolated image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1494859213358{padding-top: 90px !important;}"][vc_column width="1/2" col_padding="2" col_padding_side="right"][vc_column_text font_size="medium"]
					<h3>Learn about us</h2>
					We have been operating for over 30 years and are Members of The Federation of Master Builders. We work on projects big and small from small residential extensions to full house and commercial builds and we are registered NHBC house builders.[/vc_column_text][vntd_separator][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/2" col_padding="2" col_padding_side="left"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/isolated-happy-man.jpg" css_animation="none" css=".vc_custom_1494859204969{margin-bottom: 0px !important;}"][/vc_column][/vc_row]',
				),
				'img_text_right_img_iso' => array(
					'title' => esc_html__( 'Isolated Image', 'engage' ),
					'desc' => esc_html__( 'Isolated image with a text.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1494859213358{padding-top: 90px !important;}"][vc_column width="1/2" col_padding="2" col_padding_side="right"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/isolated-happy-man2.jpg" css_animation="none" css=".vc_custom_1494859417064{margin-bottom: 0px !important;}"][/vc_column][vc_column width="1/2" col_padding="2" col_padding_side="left"][vc_column_text font_size="medium"]
					<h3>Learn about us</h2>
					We have been operating for over 30 years and are Members of The Federation of Master Builders. We work on projects big and small from small residential extensions to full house and commercial builds and we are registered NHBC house builders.[/vc_column_text][vntd_button label="Learn More" icon_enabled="yes" icon_fontawesome="fa fa-long-arrow-right" icon_style="right_side_hover" url="#"][/vc_column][/vc_row]',
				),
				'img_text_right_list' => array(
					'title' => esc_html__( 'Image with Text and List', 'engage' ),
					'desc' => esc_html__( 'Image with text and a list.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" bg_color_pre="bg-color-1" css=".vc_custom_1494860929308{padding-top: 90px !important;padding-bottom: 60px !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column width="1/2" col_padding="2" col_padding_side="right" css=".vc_custom_1494861025506{padding-top: 0px !important;}"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-6.jpg" img_size="700x660"][/vc_column][vc_column width="1/2" col_padding="2" col_padding_side="left" css=".vc_custom_1494861039724{padding-top: 20px !important;}"][vc_column_text css=".vc_custom_1487872588606{margin-bottom: 25px !important;}"]
					<h3>Who we are?</h2>
					We have been operating for over 30 years and are Members of The Federation of Master Builders. We work on projects big and small from small residential extensions to full house. We are so happy with this theme. Everyday it make our lives better.[/vc_column_text][vntd_icon_list icons_color="accent" elements="%5B%7B%22icon_fontawesome%22%3A%22fa%20fa-envira%22%2C%22text%22%3A%22We%20care%20about%20environment.%22%7D%2C%7B%22icon_fontawesome%22%3A%22fa%20fa-users%22%2C%22text%22%3A%22We are%20trusted%20by%20hundreds%20of%20clients.%22%7D%2C%7B%22icon_fontawesome%22%3A%22fa%20fa-heart%22%2C%22text%22%3A%22Social%20media%20loves%20us!%22%7D%2C%7B%22icon_fontawesome%22%3A%22fa%20fa-check%22%2C%22text%22%3A%22This%20list%20is%20super%20easy%20to%20create.%22%7D%5D" size="large" border="off"][/vc_column][/vc_row]',
				),
				'img_text_list' => array(
					'title' => esc_html__( 'Text with a list and image', 'engage' ),
					'desc' => esc_html__( 'Text with a list and image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" parallax="content-moving" parallax_speed_bg="1.3" css=".vc_custom_1494860920894{padding-top: 90px !important;padding-bottom: 90px !important;background-position: center;background-repeat: no-repeat;background-size: cover !important;}"][vc_column width="1/2" col_padding="2" col_padding_side="right" css=".vc_custom_1494861044583{padding-top: 20px !important;}"][vc_column_text]
					<h3>Great Results.</h2>
					We have been operating for over 30 years and are Members of The Federation of Master Builders. We work on projects big and small from small residential extensions to full house. We are so happy with this theme. Everyday it make our lives better.[/vc_column_text][vntd_list items="Aliquam fermentum lorem quis posuere mattis.,Sed mollis sapien erat id pellentesque libero.,Pellentesque nisl id semper bibendum." icon="fa fa-thumbs-o-up"][/vc_column][vc_column width="1/2" col_padding="2" col_padding_side="left"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-5.jpg" img_size="700x600" css=".vc_custom_1494861073284{margin-bottom: 0px !important;}"][/vc_column][/vc_row]',
				),
				'img_text_btn_icon' => array(
					'title' => esc_html__( 'Aligned text with image', 'engage' ),
					'desc' => esc_html__( 'Text block with an image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1494844972270{padding-top: 90px !important;padding-bottom: 90px !important;}"][vc_column width="7/12" col_padding="2" col_padding_side="right"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-12.jpg" img_size="800x660" css_animation="none" css=".vc_custom_1494844610700{margin-bottom: 0px !important;}"][/vc_column][vc_column width="5/12" col_padding="2" col_padding_side="left"][vc_icon type="linecons" icon_linecons="vc_li vc_li-paperplane" css=".vc_custom_1494845054727{margin-bottom: 15px !important;margin-left: -13px !important;}"][vc_custom_heading text="We rock at optimisation." google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal"][vc_column_text font_size="medium"]Nunc id ante quis tellus faucibus dictum in eget metus. Duis suscipit elit sem, sed mattis tellus accumsan eget. Quisque consequat venenatis rutrum. Quisque posuere enim augue, in rhoncus diam dictum non.[/vc_column_text][vntd_button label="Learn More" style="solid" color="blue" icon_enabled="yes" icon_fontawesome="fa fa-angle-right" icon_style="right_side_hover" url="#"][/vc_column][/vc_row]',
				),
				'img_text_center_icon' => array(
					'title' => esc_html__( 'Centered text with image', 'engage' ),
					'desc' => esc_html__( 'Centered text block with an image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1494845225544{padding-top: 90px !important;padding-bottom: 90px !important;}"][vc_column width="1/2" col_padding="1" col_padding_side="right"][vc_icon type="linecons" icon_linecons="vc_li vc_li-paperplane" align="center" css=".vc_custom_1494845317040{margin-bottom: 15px !important;}"][vc_custom_heading text="We rock at optimisation." font_container="tag:h3|font_size:28px|text_align:center" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal"][vc_column_text]
					<p style="text-align: center;">Nunc id ante quis tellus faucibus dictum in eget metus. Duis suscipit elit sem, sed mattis tellus accumsan eget. Quisque consequat venenatis rutrum. Quisque posuere enim augue, in rhoncus diam dictum non.</p>
					[/vc_column_text][vntd_button label="Learn More" style="solid" color="blue" align="center" icon_enabled="yes" icon_fontawesome="fa fa-angle-right" icon_style="right_side_hover" url="#"][/vc_column][vc_column width="1/2" col_padding="1" col_padding_side="left"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-6.jpg" img_size="700x600" css_animation="none" css=".vc_custom_1494845385184{margin-bottom: 0px !important;}"][/vc_column][/vc_row]',
				),
				'img_mockup_text' => array(
					'title' => esc_html__( 'Text block + Mockup Image', 'engage' ),
					'desc' => esc_html__( 'Text block with buttons and mockup image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ), esc_html__( 'Hero Section', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" color_scheme="white" css=".vc_custom_1494846045404{padding-top: 100px !important;padding-bottom: 70px !important;background-color: #2196f3 !important;}"][vc_column width="5/12" col_padding="1" col_padding_side="right"][vc_custom_heading text="Hello! We are the best company in the area." font_container="tag:h2|font_size:36px|text_align:left|line_height:1.44em" use_theme_fonts="yes" css=".vc_custom_1494846002664{margin-bottom: 20px !important;}"][vc_column_text font_size="medium"]
					<p style="text-align: left;">Nunc id ante quis tellus faucibus dictum in eget metus. Duis suscipit elit sem, sed mattis tellus accumsan eget. Quisque consequat venenatis rutrum.</p>
					[/vc_column_text][vntd_button label="Learn More" style="solid" color="white" color_hover="accent" display="inline" icon_fontawesome="fa fa-angle-right" url="#"][vntd_button style="outline" color="white" color_hover="white" display="inline"][/vc_column][vc_column width="7/12" col_padding="1" col_padding_side="left"][vc_single_image image="https://s3.us-east-2.amazonaws.com/veented.com/laptop-floating.png" css_animation="none" css=".vc_custom_1494845485998{margin-bottom: 0px !important;}"][/vc_column][/vc_row]',
				),
				'img_text_btn_icon' => array(
					'title' => esc_html__( 'Aligned text with image', 'engage' ),
					'desc' => esc_html__( 'Text block with an image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1494844972270{padding-top: 90px !important;padding-bottom: 90px !important;}"][vc_column width="7/12" col_padding="2" col_padding_side="right"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-12.jpg" img_size="800x660" css_animation="none" css=".vc_custom_1494844610700{margin-bottom: 0px !important;}"][/vc_column][vc_column width="5/12" col_padding="2" col_padding_side="left"][vc_icon type="linecons" icon_linecons="vc_li vc_li-paperplane" css=".vc_custom_1494845054727{margin-bottom: 15px !important;margin-left: -13px !important;}"][vc_custom_heading text="We rock at optimisation." google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal"][vc_column_text font_size="medium"]Nunc id ante quis tellus faucibus dictum in eget metus. Duis suscipit elit sem, sed mattis tellus accumsan eget. Quisque consequat venenatis rutrum. Quisque posuere enim augue, in rhoncus diam dictum non.[/vc_column_text][vntd_button label="Learn More" style="solid" color="blue" icon_enabled="yes" icon_fontawesome="fa fa-angle-right" icon_style="right_side_hover" url="#"][/vc_column][/vc_row]',
				),
				'heading_img_center' => array(
					'title' => esc_html__( 'Centered Image', 'engage' ),
					'desc' => esc_html__( 'Heading with a big, centered image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1493981930868{padding-top: 80px !important;padding-bottom: 70px !important;}"][vc_column][special_heading title="Big Image" subtitle="This is an example of a big, centered image and a heading. Perfect for showcasing something outstanding and awesome!" c_margin_bottom="60px" font_size="28px" subtitle_fa="16px"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/full-5.jpg" img_size="960x500" alignment="center" style="vc_box_rounded" css_animation="fadeIn"][/vc_column][/vc_row]',
				),
				'text_img_icon_boxes' => array(
					'title' => esc_html__( 'Text, Image, Icon Boxes', 'engage' ),
					'desc' => esc_html__( 'Multiple text content.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ), esc_html__( 'Icon Boxes', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1494849446355{padding-top: 80px !important;padding-bottom: 45px !important;}"][vc_column][vc_row_inner equal_height="yes" content_placement="middle"][vc_column_inner width="1/2" css=".vc_custom_1494849276341{padding-right: 1% !important;}"][vc_column_text css=".vc_custom_1494848815057{margin-bottom: 15px !important;}"]
					<h3>Our incredible features.</h2>
					[/vc_column_text][vc_column_text font_size="large"]Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo leo velit sit amet velit. Aliquam fermentum, lorem quis posuere mattis, est justo porttitor magna.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_single_image image="https://s3.us-east-2.amazonaws.com/veented.com/ipad.png" alignment="center" css=".vc_custom_1494849416688{margin-bottom: 0px !important;}"][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1494849123858{margin-top: 40px !important;}"][vc_column_inner width="1/4"][icon_box title="Powerful Options" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-params"][/vc_column_inner][vc_column_inner width="1/4"][icon_box title="Responsive Design" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-display"][/vc_column_inner][vc_column_inner width="1/4"][icon_box title="Satisfied Clients" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-heart"][/vc_column_inner][vc_column_inner width="1/4"][icon_box title="Premium Support" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-study"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'text_slider_icon_boxes' => array(
					'title' => esc_html__( 'Image Slider, Text, Icon Boxes', 'engage' ),
					'desc' => esc_html__( 'Text with icon boxes and image slider.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ), esc_html__( 'Icon Boxes', 'engage' ), 'Slider' ),
					'sc' => '[vc_row css=".vc_custom_1494849953524{padding-top: 90px !important;padding-bottom: 50px !important;}"][vc_column][vc_row_inner equal_height="yes" content_placement="middle" css=".vc_custom_1494851068829{margin-bottom: 40px !important;}"][vc_column_inner width="7/12" css=".vc_custom_1494849698699{padding-right: 5% !important;}"][engage_image_slider images="http://media.veented.com/wp-content/uploads/2017/08/full-8.jpeg,http://media.veented.com/wp-content/uploads/2017/09/full-16.jpg" img_size="700x420"][/vc_column_inner][vc_column_inner width="5/12" css=".vc_custom_1494849694618{padding-left: 5% !important;}"][vc_column_text css=".vc_custom_1494851089676{margin-bottom: 16px !important;}"]
					<h3>Incredible Office.</h2>
					[/vc_column_text][vc_column_text]Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo leo velit sit amet velit. Aliquam fermentum, lorem quis posuere mattis, est justo porttitor magna. Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/3"][icon_box title="Powerful Options" text="Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan erat quis risus rhoncus, laoreet lobortis diam tincidunt. Aenean vehicula, dolor eget posuere luctus." style="centered-circle" icon_align="left" icon_size="sm" icon_type="linecons" link_label="Learn More" icon_linecons="vc_li vc_li-params" url="#"][/vc_column_inner][vc_column_inner width="1/3"][icon_box title="Responsive Design" text="Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan erat quis risus rhoncus, laoreet lobortis diam tincidunt. Aenean vehicula, dolor eget posuere luctus." style="centered-circle" icon_align="left" icon_size="sm" icon_type="linecons" link_label="Learn More" icon_linecons="vc_li vc_li-display" url="#"][/vc_column_inner][vc_column_inner width="1/3"][icon_box title="Page Builder" text="Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan erat quis risus rhoncus, laoreet lobortis diam tincidunt. Aenean vehicula, dolor eget posuere luctus." style="centered-circle" icon_align="left" icon_size="sm" icon_type="linecons" link_label="Learn More" icon_linecons="vc_li vc_li-pen" url="#"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'text_multi_image' => array(
					'title' => esc_html__( 'Text Multi and Image', 'engage' ),
					'desc' => esc_html__( 'Text with icon boxes and image slider.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ), esc_html__( 'Icon Boxes', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1494851871081{padding-top: 90px !important;padding-bottom: 90px !important;}"][vc_column width="7/12" col_padding="2" col_padding_side="right"][vc_column_text css=".vc_custom_1494851946125{margin-bottom: 18px !important;}"]
					<h3>What is our goal?</h2>
					[/vc_column_text][vc_column_text font_size="medium"]
					<p class="p1">Aliquam imperdiet egestas nisi ultrices tristique. Maecenas vestibulum rutrum luctus. Quisque at viverra felis. Aliquam pharetra lacus non sem ullamcorper tempus. Donec quis commodo ligula, eu aliquet elit.</p>
					[/vc_column_text][vc_row_inner css=".vc_custom_1494852056203{padding-top: 20px !important;}"][vc_column_inner width="1/2"][vc_column_text css=".vc_custom_1494852050796{margin-bottom: 12px !important;}"]
					<h5>Premium Support</h5>
					[/vc_column_text][vc_column_text]
					<p class="p1">Curabitur in ante odio. Quisque facilisis elementum ipsum id tincidunt. Cras auctor consectetur pharetra.</p>
					[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text css=".vc_custom_1494852136754{margin-bottom: 12px !important;}"]
					<h5>Powerful Features</h5>
					[/vc_column_text][vc_column_text]
					<p class="p1">Curabitur in ante odio. Quisque facilisis elementum ipsum id tincidunt. Cras auctor consectetur pharetra.</p>
					[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1494852056203{padding-top: 20px !important;}"][vc_column_inner width="1/2"][vc_column_text css=".vc_custom_1494852172479{margin-bottom: 12px !important;}"]
					<h5>Satisfied Clients</h5>
					[/vc_column_text][vc_column_text]
					<p class="p1">Curabitur in ante odio. Quisque facilisis elementum ipsum id tincidunt. Cras auctor consectetur pharetra.</p>
					[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text css=".vc_custom_1494852189991{margin-bottom: 12px !important;}"]
					<h5>Flexible Options</h5>
					[/vc_column_text][vc_column_text]
					<p class="p1">Curabitur in ante odio. Quisque facilisis elementum ipsum id tincidunt. Cras auctor consectetur pharetra.</p>
					[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="5/12" col_padding="1" col_padding_side="left"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-12.jpg" img_size="700x760" css=".vc_custom_1494852267097{margin-bottom: 0px !important;}"][/vc_column][/vc_row]',
				),
				'img_text_mockup' => array(
					'title' => esc_html__( 'Mockup image + Text', 'engage' ),
					'desc' => esc_html__( 'Mockup image with text.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" bg_color_pre="bg-color-1" css=".vc_custom_1494852565780{padding-top: 90px !important;padding-bottom: 90px !important;}"][vc_column width="1/2" col_padding="2" col_padding_side="right"][vc_single_image image="https://s3.us-east-2.amazonaws.com/veented.com/ipad-with-cover-2.png" css=".vc_custom_1494852495509{margin-bottom: 0px !important;}"][/vc_column][vc_column width="1/2" col_padding="2" col_padding_side="left"][vc_column_text font_size="medium"]
					<h3>Learn about us</h2>
					We have been operating for over 30 years and are Members of The Federation of Master Builders. We work on projects big and small from small residential extensions to full house and commercial builds and we are registered NHBC house builders.[/vc_column_text][vntd_separator][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row]',
				),
				'img_bg_text' => array(
					'title' => esc_html__( 'Background Image with Text', 'engage' ),
					'desc' => esc_html__( 'Aligned text with bg image.', 'engage' ),
					'cat' => array( esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ), esc_html__( 'Hero Section', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" bg_overlay="dark30" color_scheme="white" css=".vc_custom_1494836841979{padding-top: 0px !important;background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-19.jpg) !important;}"][vc_column width="1/2" col_padding="2" col_padding_side="right" css=".vc_custom_1494836926761{padding-top: 155px !important;padding-bottom: 140px !important;}"][vc_column_text font_size="medium"]
					<h1>Hello there.</h1>
					<p class="p1">Donec quis rhoncus augue. In fermentum eget neque tristique scelerisque. Morbi at elementum nisi. Quisque pellentesque at enim vitae bibendum. Aliquam imperdiet egestas nisi. Aliquam pharetra lacus non sem ullamcorper tempus.</p>
					[/vc_column_text][vntd_button label="Learn More" style="outline" color="white" color_hover="white" icon_enabled="yes" icon_fontawesome="fa fa-long-arrow-right" icon_style="right_side_hover" url="#"][/vc_column][vc_column width="1/2" col_padding="2" col_padding_side="left"][/vc_column][/vc_row]',
				),
				'img_text_mockup_gd' => array(
					'title' => esc_html__( 'Mockup image + Text', 'engage' ),
					'desc' => esc_html__( 'Mockup image with text over gradient.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" color_scheme="white" bg_gradient1="#b06ab3" bg_gradient2="#4568dc" css=".vc_custom_1494852488594{padding-top: 90px !important;padding-bottom: 90px !important;}"][vc_column width="1/2" col_padding="2" col_padding_side="right"][vc_column_text font_size="medium"]
					<h3>Learn about us</h2>
					We have been operating for over 30 years and are Members of The Federation of Master Builders. We work on projects big and small from small residential extensions to full house and commercial builds and we are registered NHBC house builders.[/vc_column_text][vntd_separator][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/2" col_padding="2" col_padding_side="left"][vc_single_image image="https://s3.us-east-2.amazonaws.com/veented.com/ipad-with-cover-2.png" css=".vc_custom_1494852495509{margin-bottom: 0px !important;}"][/vc_column][/vc_row]',
				),
				'hero_img_1' => array(
					'title' => esc_html__( 'Hero Section Bg Img 1', 'engage' ),
					'desc' => esc_html__( 'Hero Section with a background image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Hero Section', 'engage' ) ),
					'sc' => '[vc_row bg_overlay="dark40" parallax="content-moving" css=".vc_custom_1494853158030{padding-top: 220px !important;padding-bottom: 220px !important;background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-16.jpg) !important;}"][vc_column][vc_custom_heading text="Smaller Text" font_container="tag:h5|font_size:18px|text_align:center|color:rgba(255%2C255%2C255%2C0.8)" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:600%20bold%20regular%3A600%3Anormal" css=".vc_custom_1494853239264{margin-bottom: 16px !important;}"][vc_custom_heading text="WELCOME TO BING" font_container="tag:h1|font_size:66px|text_align:center|color:%23ffffff" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:700%20bold%20regular%3A700%3Anormal"][vntd_button label="Learn More" style="solid" color="accent" color_hover="white" border_radius="circle" align="center"][/vc_column][/vc_row]',
				),
				'hero_img_2' => array(
					'title' => esc_html__( 'Hero Section Bg Img 2', 'engage' ),
					'desc' => esc_html__( 'Hero Section with a background image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Hero Section', 'engage' ) ),
					'sc' => '[vc_row bg_overlay="dark40" parallax="content-moving" css=".vc_custom_1494853541940{padding-top: 220px !important;padding-bottom: 220px !important;background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-20.jpg) !important;}"][vc_column][vc_custom_heading text="INCREDIBLE TALENTS." font_container="tag:h5|font_size:18px|text_align:center|color:rgba(255%2C255%2C255%2C0.8)" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal" css=".vc_custom_1494853571240{margin-bottom: 20px !important;}"][vc_custom_heading text="We are the largest design agency in Los Angeles." font_container="tag:h1|font_size:66px|text_align:center|color:%23ffffff" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal" css=".vc_custom_1494853549887{padding-right: 10% !important;padding-left: 10% !important;}"][vntd_button label="View our Work" style="outline" color="white" color_hover="white" align="center" url="#" margin_top="16px"][/vc_column][/vc_row]',
				),
				'hero_img_3' => array(
					'title' => esc_html__( 'Hero Section Bg Img 3', 'engage' ),
					'desc' => esc_html__( 'Hero Section with a background image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Hero Section', 'engage' ) ),
					'sc' => '[vc_row parallax="content-moving" color_scheme="white" bg_overlay="dark30" css=".vc_custom_1494854239991{padding-top: 190px !important;padding-bottom: 190px !important;background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-15.jpg) !important;}"][vc_column][special_heading title="Incredible Section" subtitle="Some simple description of the section." c_margin_bottom="0px" font_size="52px" font_weight="300" text_transform="none" subtitle_fs="20px"][/vc_column][/vc_row]',
				),
				'hero_img_4' => array(
					'title' => esc_html__( 'Hero Section Bg Img 4', 'engage' ),
					'desc' => esc_html__( 'Hero Section with a background image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Hero Section', 'engage' ) ),
					'sc' => '[vc_row][vc_column][vntd_hero_section scroll_btn="true" images="http://media.veented.com/wp-content/uploads/2017/09/full-16.jpg" bg_overlay="dark40" height="custom" height_custom="800px" content_width="narrow" parallax="no"][/vc_column][/vc_row]',
				),
				'hero_video_1' => array(
					'title' => esc_html__( 'Hero Video Background', 'engage' ),
					'desc' => esc_html__( 'Fullscreen Hero Section with a background image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Hero Section', 'engage' ) ),
					'sc' => '[vc_row][vc_column][vntd_hero_section scroll_btn="true" media_type="youtube" youtube_id="https://www.youtube.com/watch?v=2QKQX7fbjnA" video_img="http://media.veented.com/wp-content/uploads/2017/09/full-14.jpg" bg_overlay="dark40" content_width="narrow" parallax="no"][/vc_column][/vc_row]',
				),
				'hero_ximg_1' => array(
					'title' => esc_html__( 'Hero with Image 1', 'engage' ),
					'desc' => esc_html__( 'Fullscreen Hero Section with an extra image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Hero Section', 'engage' ) ),
					'sc' => '[vc_row full_height="yes" equal_height="yes" content_placement="middle" parallax="content-moving-fade" color_scheme="white" bg_gradient1="#eecda3" bg_gradient2="#ef629f"][vc_column width="7/12" col_padding="3" col_padding_side="right"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-5.jpg" img_size="700x700" alignment="right" style="vc_box_rounded" css=".vc_custom_1494346325598{margin-bottom: 0px !important;}"][/vc_column][vc_column width="5/12" col_padding="3" col_padding_side="left"][vc_custom_heading text="Hello there" font_container="tag:h2|font_size:56px|text_align:left" use_theme_fonts="yes" css=".vc_custom_1494343480109{margin-bottom: 10px !important;}"][vc_column_text font_size="large"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donecore ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbinus mattis, turpis.[/vc_column_text][vntd_icon_list icons_color="transparent-white" elements="%5B%7B%22icon_fontawesome%22%3A%22fa%20fa-heart%22%2C%22text%22%3A%22Created%20with%20pure%20love.%22%7D%2C%7B%22icon_fontawesome%22%3A%22fa%20fa-envira%22%2C%22text%22%3A%22Perfect%20responsive%20design.%22%7D%2C%7B%22icon_fontawesome%22%3A%22fa%20fa-flag%22%2C%22text%22%3A%22Fully%20retina%20ready.%22%7D%5D" size="medium" border="off"][vntd_button color="white" color_hover="accent" style="solid" display="inline"][vntd_button color="white" color_hover="accent" style="outline" display="inline"][/vc_column][/vc_row]',
				),
				'hero_ximg_2' => array(
					'title' => esc_html__( 'Hero with Image 2', 'engage' ),
					'desc' => esc_html__( 'Fullscreen Hero Section with a mockup image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Hero Section', 'engage' ) ),
					'sc' => '[vc_row full_height="yes" equal_height="yes" content_placement="middle" color_scheme="white" bg_gradient1="#b06ab3" bg_gradient2="#4568dc"][vc_column width="1/2" col_padding="3" col_padding_side="right"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/iphone-white.png" img_size="320x654" alignment="right"][/vc_column][vc_column width="1/2" col_padding="3" col_padding_side="left"][vc_custom_heading text="Hello there" font_container="tag:h2|font_size:56px|text_align:left" use_theme_fonts="yes" css=".vc_custom_1494343480109{margin-bottom: 10px !important;}"][vc_column_text font_size="large"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donecore ultrices nisl diam, vitae consequat massa wlacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbinus mattis, turpis.[/vc_column_text][vntd_button style="solid" color="white" color_hover="accent" display="inline"][vntd_button style="outline" color="white" color_hover="accent" display="inline"][/vc_column][/vc_row]',
				),
				'hero_ximg_3' => array(
					'title' => esc_html__( 'Hero with Image 3', 'engage' ),
					'desc' => esc_html__( 'Fullscreen Hero Section with a mockup image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Hero Section', 'engage' ) ),
					'sc' => '[vc_row full_height="yes" equal_height="yes" content_placement="middle" color_scheme="white" bg_gradient1="#eecda3" bg_gradient2="#ef629f"][vc_column width="1/2" col_padding="3" col_padding_side="right"][vc_single_image image="https://s3.us-east-2.amazonaws.com/veented.com/iphone-white.png" img_size="397x800" alignment="right" css=".vc_custom_1494344656778{margin-bottom: 0px !important;}"][/vc_column][vc_column width="1/2" col_padding="3" col_padding_side="left"][vc_custom_heading text="Hello there" font_container="tag:h2|font_size:56px|text_align:left" use_theme_fonts="yes" css=".vc_custom_1494343480109{margin-bottom: 10px !important;}"][vc_column_text font_size="large"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donecore ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbinus mattis, turpis.[/vc_column_text][vntd_icon_list icons_color="transparent-white" elements="%5B%7B%22icon_fontawesome%22%3A%22fa%20fa-heart%22%2C%22text%22%3A%22Created%20with%20pure%20love.%22%7D%2C%7B%22icon_fontawesome%22%3A%22fa%20fa-envira%22%2C%22text%22%3A%22Perfect%20responsive%20design.%22%7D%2C%7B%22icon_fontawesome%22%3A%22fa%20fa-flag%22%2C%22text%22%3A%22Fully%20retina%20ready.%22%7D%5D" size="medium" border="off"][vntd_button style="solid" color="white" color_hover="accent" display="inline"][vntd_button style="outline" color="white" color_hover="accent" display="inline"][/vc_column][/vc_row]',
				),
				'hero_ximg_4' => array(
					'title' => esc_html__( 'Hero with Image 4', 'engage' ),
					'desc' => esc_html__( 'Fullscreen Hero Section with a mockup image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Hero Section', 'engage' ) ),
					'sc' => '[vc_row full_height="yes" equal_height="yes" content_placement="middle" color_scheme="white" bg_overlay="dark30" css=".vc_custom_1494343711653{background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-23.jpg) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column width="1/2" col_padding="3" col_padding_side="right"][vc_custom_heading text="Hello there" font_container="tag:h2|font_size:64px|text_align:left" use_theme_fonts="yes" css=".vc_custom_1494343644235{margin-bottom: 10px !important;}"][vc_column_text font_size="large"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donecore ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbinus mattis, turpis.[/vc_column_text][vntd_button color="white" color_hover="accent" style="solid" display="inline"][vntd_button color="white" color_hover="accent" style="outline" display="inline"][/vc_column][vc_column width="1/2" col_padding="3" col_padding_side="left"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/iphone-black.png" img_size="320x654" alignment="center" css=".vc_custom_1494344651524{margin-bottom: 0px !important;}"][/vc_column][/vc_row]',
				),
				'hero_ximg_5' => array(
					'title' => esc_html__( 'Hero with Image 5', 'engage' ),
					'desc' => esc_html__( 'Hero Section with an aligned image, dark text.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Hero Section', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1494346144583{padding-top: 110px !important;padding-bottom: 110px !important;background-color: #e6e6e6 !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column width="1/2" col_padding="3" col_padding_side="right"][vc_custom_heading text="Hello there" font_container="tag:h2|font_size:50px|text_align:left" use_theme_fonts="yes" css=".vc_custom_1494345504182{margin-bottom: 20px !important;}"][vc_column_text font_size="large"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donecore ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbinus mattis, turpis.[/vc_column_text][vc_column_text css=".vc_custom_1494345103487{margin-bottom: 35px !important;}"]Donecore ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo.[/vc_column_text][vntd_button color="accent" color_hover="white" style="solid" display="inline"][vntd_button color="white" color_hover="accent" display="inline"][/vc_column][vc_column width="1/2" col_padding="3" col_padding_side="left"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-12.jpg" img_size="700x700" style="vc_box_rounded" css=".vc_custom_1494345532027{margin-bottom: 0px !important;}"][/vc_column][/vc_row]',
				),
				'hero_ximg_6' => array(
					'title' => esc_html__( 'Hero with Image 6', 'engage' ),
					'desc' => esc_html__( 'Hero Section with image, dark text.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Hero Section', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" bg_gradient1="#ffafbd" bg_gradient2="#ffc3a0" css=".vc_custom_1494346089964{padding-top: 110px !important;padding-bottom: 110px !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column width="1/2" col_padding="3" col_padding_side="right"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-12.jpg" img_size="700x700" style="vc_box_rounded" css=".vc_custom_1494345532027{margin-bottom: 0px !important;}"][/vc_column][vc_column width="1/2" col_padding="3" col_padding_side="left"][vc_custom_heading text="Hello there" font_container="tag:h2|font_size:50px|text_align:left" use_theme_fonts="yes" css=".vc_custom_1494345504182{margin-bottom: 20px !important;}"][vc_column_text font_size="large"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donecore ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbinus mattis, turpis.[/vc_column_text][vc_column_text css=".vc_custom_1494346129847{margin-bottom: 35px !important;}"]Donecore ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo.[/vc_column_text][vntd_button color="dark" color_hover="white" style="solid" display="inline"][vntd_button color="dark" color_hover="dark" style="outline" display="inline"][/vc_column][/vc_row]',
				),
				'hero_xvid_1' => array(
					'title' => esc_html__( 'Hero with Video 1', 'engage' ),
					'desc' => esc_html__( 'Hero Section with extra video.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Hero Section', 'engage' ), esc_html__( 'Video', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" color_scheme="white" bg_gradient1="#ac75d6" bg_gradient2="#7d9cdb" css=".vc_custom_1494347111388{padding-top: 120px !important;padding-bottom: 120px !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column width="1/2" col_padding="3" col_padding_side="right"][video_lightbox style="img" link="https://www.youtube.com/watch?v=ty0SGNZi81U" img="http://media.veented.com/wp-content/uploads/2017/09/square-12.jpg" border="round"][/vc_column][vc_column width="1/2" col_padding="3" col_padding_side="left"][vc_custom_heading text="Hello there" font_container="tag:h2|font_size:50px|text_align:left" use_theme_fonts="yes" css=".vc_custom_1494345504182{margin-bottom: 20px !important;}"][vc_column_text font_size="large"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donecore ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbinus mattis, turpis.[/vc_column_text][vntd_button color="white" color_hover="white" style="solid" display="inline"][vntd_button color="white" style="outline" display="inline"][/vc_column][/vc_row]',
				),
				'hero_xvid_2' => array(
					'title' => esc_html__( 'Hero with Video 2', 'engage' ),
					'desc' => esc_html__( 'Hero Section with extra video, dark text.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Hero Section', 'engage' ), esc_html__( 'Video', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1494347177433{padding-top: 120px !important;padding-bottom: 120px !important;background-color: #f7f7f7 !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column width="1/2" col_padding="3" col_padding_side="right"][video_lightbox style="img" link="https://www.youtube.com/watch?v=ty0SGNZi81U" img="http://media.veented.com/wp-content/uploads/2017/09/full-12.jpg" border="round"][/vc_column][vc_column width="1/2" col_padding="3" col_padding_side="left"][vc_custom_heading text="Hello there" font_container="tag:h2|font_size:50px|text_align:left" use_theme_fonts="yes" css=".vc_custom_1494345504182{margin-bottom: 20px !important;}"][vc_column_text font_size="large"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donecore ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbinus mattis, turpis.[/vc_column_text][vntd_button color="dark" color_hover="white" style="solid" display="inline"][/vc_column][/vc_row]',
				),
				'hero_text_center' => array(
					'title' => esc_html__( 'Hero Gradient Background', 'engage' ),
					'desc' => esc_html__( 'Hero Section with centered text, gradient.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Hero Section', 'engage' ), esc_html__( 'Plain Text', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" parallax="content-moving-fade" color_scheme="white" bg_gradient1="#eecda3" bg_gradient2="#ef629f" css=".vc_custom_1494346688168{padding-top: 160px !important;padding-bottom: 160px !important;}"][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_custom_heading text="Hello there!" font_container="tag:h2|font_size:56px|text_align:center" use_theme_fonts="yes" css=".vc_custom_1494346737499{margin-bottom: 20px !important;}"][vc_column_text font_size="large" css=".vc_custom_1494346719422{margin-bottom: 40px !important;}"]
					<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donecore ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia.</p>
					[/vc_column_text][vntd_button color="white" style="solid" align="center"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]',
				),
				'hero_slider_img' => array(
					'title' => esc_html__( 'Hero Slider Image', 'engage' ),
					'desc' => esc_html__( 'Hero Slider with two image slides.', 'engage' ),
					'cat' => array( esc_html__( 'Hero Section', 'engage' ), 'Slider' ),
					'sc' => '[vc_row][vc_column][vntd_hero_slider slides="%5B%7B%22image%22%3A%22http://media.veented.com/wp-content/uploads/2017/09/full-23.jpg%22%2C%22heading%22%3A%22Welcome%2C%20Stranger!%22%2C%22text%22%3A%22This%20is%20an%20example%20slide%20text%20content%2C%20feel%20free%20to%20change%20it.%22%2C%22btn_label%22%3A%22Learn%20More%22%2C%22btn_url%22%3A%22%23%22%2C%22align%22%3A%22center%22%2C%22color%22%3A%22white%22%2C%22bg_overlay%22%3A%22dark30%22%7D%2C%7B%22image%22%3A%22http://media.veented.com/wp-content/uploads/2017/09/full-21b.jpg%22%2C%22heading%22%3A%22Aligned%20Heading%22%2C%22text%22%3A%22This%20is%20another%20example%20slide%20text%20content%2C%20feel%20free%20to%20change%20it.%22%2C%22btn_label%22%3A%22Learn%20More%22%2C%22btn_url%22%3A%22%23%22%2C%22align%22%3A%22left%22%2C%22color%22%3A%22white%22%2C%22bg_overlay%22%3A%22dark20%22%7D%5D"][/vc_column][/vc_row]',
				),
				'hero_slider_img_align' => array(
					'title' => esc_html__( 'Hero Slider Image 2', 'engage' ),
					'desc' => esc_html__( 'Hero Slider with 2 image slides.', 'engage' ),
					'cat' => array( esc_html__( 'Hero Section', 'engage' ), 'Slider' ),
					'sc' => '[vc_row][vc_column][vntd_hero_slider slides="%5B%7B%22image%22%3A%22http://media.veented.com/wp-content/uploads/2017/09/full-17.jpg%22%2C%22heading%22%3A%22Aligned%20Heading%22%2C%22text%22%3A%22This%20is%20another%20example%20slide%20text%20content%2C%20feel%20free%20to%20change%20it.%22%2C%22btn_label%22%3A%22Learn%20More%22%2C%22btn_url%22%3A%22%23%22%2C%22align%22%3A%22left%22%2C%22color%22%3A%22white%22%2C%22bg_overlay%22%3A%22dark20%22%2C%22bg_color%22%3A%22%2356ccf2%22%2C%22bg_color2%22%3A%22%232f80ed%22%7D%2C%7B%22image%22%3A%222003%22%2C%22heading%22%3A%22Slide%20Heading%22%2C%22text%22%3A%22This%20is%20an%20example%20slide%20text%20content%2C%20feel%20free%20to%20change%20it.%22%2C%22btn_label%22%3A%22Learn%20More%22%2C%22btn_url%22%3A%22%23%22%2C%22align%22%3A%22center%22%2C%22color%22%3A%22white%22%2C%22bg_overlay%22%3A%22dark30%22%7D%5D"][/vc_column][/vc_row]',
				),
				'hero_slider_gd' => array(
					'title' => esc_html__( 'Hero Slider Gradient', 'engage' ),
					'desc' => esc_html__( 'Hero Slider with two gradient slides.', 'engage' ),
					'cat' => array( esc_html__( 'Hero Section', 'engage' ), 'Slider' ),
					'sc' => '[vc_row][vc_column][vntd_hero_slider slides="%5B%7B%22heading%22%3A%22Slide%20Heading%22%2C%22text%22%3A%22This%20is%20an%20example%20slide%20text%20content%2C%20feel%20free%20to%20change%20it.%22%2C%22btn_label%22%3A%22Learn%20More%22%2C%22btn_url%22%3A%22%23%22%2C%22align%22%3A%22center%22%2C%22color%22%3A%22white%22%2C%22bg_overlay%22%3A%22none%22%2C%22bg_color%22%3A%22%23b06ab3%22%2C%22bg_color2%22%3A%22%234568dc%22%7D%2C%7B%22heading%22%3A%22Second%20Heading%22%2C%22text%22%3A%22This%20is%20another%20example%20slide%20text%20content%2C%20feel%20free%20to%20change%20it.%22%2C%22btn_label%22%3A%22Learn%20More%22%2C%22btn_url%22%3A%22%23%22%2C%22align%22%3A%22left%22%2C%22color%22%3A%22white%22%2C%22bg_overlay%22%3A%22none%22%2C%22bg_color%22%3A%22%2356ccf2%22%2C%22bg_color2%22%3A%22%232f80ed%22%7D%5D"][/vc_column][/vc_row]',
				),
				'features1' => array(
					'title' => esc_html__( 'Features 1', 'engage' ),
					'desc' => esc_html__( 'Image surrounded by outline icon boxes.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Icon Boxes', 'engage' ), esc_html__( 'With Image', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1487784847412{padding-top: 75px !important;padding-bottom: 70px !important;}"][vc_column][special_heading title="Discover Core Features" subtitle="We are a fairly small, flexible design studio that designs for print and web. Whether you need to create a brand from scratch, including marketing materials." c_margin_bottom="45px"][vc_row_inner css=".vc_custom_1493912815556{padding-top: 20px !important;}"][vc_column_inner width="1/3" css=".vc_custom_1493912933501{padding-top: 125px !important;padding-right: 20px !important;}"][icon_box title="Responsive Design" text="Engage is a fully responsive theme that scales well to all mobile devices." style="aligned-right-outline" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-display"][icon_box title="Page Builder" text="Build any layout you can think of with the most powerful page builder." style="aligned-right-outline" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-pen"][icon_box title="Styling Options" text="Adjust the looks of your theme with the extensive Styling panel." style="aligned-right-outline" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-diamond"][icon_box title="Demo Content" text="All presented demo pages are available with a mouse click." style="aligned-right-outline" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-megaphone"][/vc_column_inner][vc_column_inner width="1/3"][vc_single_image image="2065" alignment="center"][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1493912928631{padding-top: 125px !important;padding-left: 20px !important;}"][icon_box title="Powerful Options" text="Take a full control over all aspects of your theme with our truly extensive." style="aligned-left-outline" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-params"][icon_box title="Google Fonts" text="You may choose any font from the extensive Google Fonts library." style="aligned-left-outline" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-star"][icon_box title="Free Support" text="Our top-notch support team will be happy to answer any of your questions." style="aligned-left-outline" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-bubble"][icon_box title="Documentation" text="Everything you need to know about the theme is in the theme docs." style="aligned-left-outline" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-news"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'features2' => array(
					'title' => esc_html__( 'Features 2', 'engage' ),
					'desc' => esc_html__( 'Image surrounded by icon boxes.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Icon Boxes', 'engage' ), esc_html__( 'With Image', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1487784847412{padding-top: 75px !important;padding-bottom: 70px !important;}"][vc_column][special_heading title="Discover Core Features" subtitle="We are a fairly small, flexible design studio that designs for print and web. Whether you need to create a brand from scratch, including marketing materials." c_margin_bottom="45px"][vc_row_inner css=".vc_custom_1493912815556{padding-top: 20px !important;}"][vc_column_inner width="1/3" css=".vc_custom_1493912933501{padding-top: 125px !important;padding-right: 20px !important;}"][icon_box title="Responsive Design" text="Engage is a fully responsive theme that scales well to all mobile devices." style="aligned-right-circle" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-display"][icon_box title="Page Builder" text="Build any layout you can think of with the most powerful page builder." style="aligned-right-circle" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-pen"][icon_box title="Styling Options" text="Adjust the looks of your theme with the extensive Styling panel." style="aligned-right-circle" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-diamond"][icon_box title="Demo Content" text="All presented demo pages are available with a mouse click." style="aligned-right-circle" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-megaphone"][/vc_column_inner][vc_column_inner width="1/3"][vc_single_image image="2065" alignment="center"][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1493912928631{padding-top: 125px !important;padding-left: 20px !important;}"][icon_box title="Powerful Options" text="Take a full control over all aspects of your theme with our truly extensive." style="aligned-left-circle" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-params"][icon_box title="Google Fonts" text="You may choose any font from the extensive Google Fonts library." style="aligned-left-circle" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-star"][icon_box title="Free Support" text="Our top-notch support team will be happy to answer any of your questions." style="aligned-left-circle" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-bubble"][icon_box title="Documentation" text="Everything you need to know about the theme is in the theme docs." style="aligned-left-circle" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-news"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'features3' => array(
					'title' => esc_html__( 'Features 3', 'engage' ),
					'desc' => esc_html__( 'Image surrounded by small icon boxes.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Icon Boxes', 'engage' ), esc_html__( 'With Image', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1493915354445{padding-top: 78px !important;padding-bottom: 90px !important;}"][vc_column][special_heading title="Discover Core Features" subtitle="We are a fairly small, flexible design studio that designs for print and web. Whether you need to create a brand from scratch, including marketing materials." c_margin_bottom="45px"][vc_row_inner equal_height="yes" content_placement="middle" css=".vc_custom_1493915392084{padding-top: 20px !important;}"][vc_column_inner width="1/3" css=".vc_custom_1493915482883{padding-top: 35px !important;padding-right: 25px !important;}"][icon_box title="Responsive Design" text="Engage is a fully responsive theme that scales well to all mobile devices." style="aligned-right-basic" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-display"][icon_box title="Page Builder" text="Build any layout you can think of with the most powerful page builder." style="aligned-right-basic" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-pen"][icon_box title="Styling Options" text="Adjust the looks of your theme with the extensive Styling panel." style="aligned-right-basic" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-diamond"][/vc_column_inner][vc_column_inner width="1/3"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-12.jpg" img_size="380x600" alignment="center" style="vc_box_rounded" css=".vc_custom_1493915302309{margin-bottom: 0px !important;}"][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1493915478474{padding-top: 35px !important;padding-left: 25px !important;}"][icon_box title="Powerful Options" text="Take a full control over all aspects of your theme with our truly extensive." style="aligned-left-basic" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-params"][icon_box title="Google Fonts" text="You may choose any font from the extensive Google Fonts library." style="aligned-left-basic" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-star"][icon_box title="Free Support" text="Our top-notch support team will be happy to answer any of your questions." style="aligned-left-basic" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-bubble"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'features_img_3cols_1' => array(
					'title' => esc_html__( 'Features with images 1', 'engage' ),
					'desc' => esc_html__( 'Row of boxed features, gray bg.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'With Image', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row bg_color_pre="bg-color-1" css=".vc_custom_1494842959159{padding-top: 70px !important;padding-bottom: 60px !important;}"][vc_column][special_heading title="Our Features" c_margin_bottom="55px" subtitle_fs="20px"][vc_row_inner][vc_column_inner width="1/3"][vntd_content_box img="http://media.veented.com/wp-content/uploads/2017/09/square-12.jpg" caption_style="boxed_no_border" text="Monec quis rhoncus augue. In fermentum eget neque tristique scelerisque. Morbi at elemen nisi. Quisque pellentesque at enim vitae."][/vc_column_inner][vc_column_inner width="1/3"][vntd_content_box img="2003" title="Cool Ideas" caption_style="boxed_no_border" text="Monec quis rhoncus augue. In fermentum eget neque tristique scelerisque. Morbi at elemen nisi. Quisque pellentesque at enim vitae."][/vc_column_inner][vc_column_inner width="1/3"][vntd_content_box img="2037" title="Premium Support" caption_style="boxed_no_border" text="Monec quis rhoncus augue. In fermentum eget neque tristique scelerisque. Morbi at elemen nisi. Quisque pellentesque at enim vitae."][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'features_img_3cols_2' => array(
					'title' => esc_html__( 'Features with images 2', 'engage' ),
					'desc' => esc_html__( 'Row of features with images.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'With Image', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1494842669698{padding-top: 70px !important;padding-bottom: 70px !important;}"][vc_column][special_heading title="Our Features" c_margin_bottom="55px" subtitle_fs="20px"][vc_row_inner][vc_column_inner width="1/3"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-5.jpg" img_size="600x400"][vc_column_text css=".vc_custom_1494838670605{margin-bottom: 14px !important;}"]
					<h5>First Feature</h5>
					[/vc_column_text][vc_column_text css=".vc_custom_1494839845723{margin-bottom: 18px !important;}"]
					<p class="p1">Donec quis rhoncus augue. In fermentum eget neque tristique scelerisque. Morbi at elementum nisi. Quisque pellentesque at enim vitae bibendum.</p>
					[/vc_column_text][vntd_button label="Learn More" style="text-btn" icon_enabled="yes" icon_fontawesome="fa fa-angle-right" icon_style="right_side" url="#"][/vc_column_inner][vc_column_inner width="1/3"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/08/blake-parkinson-31143.jpg" img_size="600x400"][vc_column_text css=".vc_custom_1494838710775{margin-bottom: 14px !important;}"]
					<h5>Responsive Design</h5>
					[/vc_column_text][vc_column_text css=".vc_custom_1494842395611{margin-bottom: 18px !important;}"]
					<p class="p1">Donec quis rhoncus augue. In fermentum eget neque tristique scelerisque. Morbi at elementum nisi. Quisque pellentesque at enim vitae bibendum.</p>
					[/vc_column_text][vntd_button label="Learn More" style="text-btn" icon_enabled="yes" icon_fontawesome="fa fa-angle-right" icon_style="right_side" url="#"][/vc_column_inner][vc_column_inner width="1/3"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-6.jpg" img_size="600x400"][vc_column_text css=".vc_custom_1494838726908{margin-bottom: 14px !important;}"]
					<h5>Premium Support</h5>
					[/vc_column_text][vc_column_text css=".vc_custom_1494842404611{margin-bottom: 18px !important;}"]
					<p class="p1">Donec quis rhoncus augue. In fermentum eget neque tristique scelerisque. Morbi at elementum nisi. Quisque pellentesque at enim vitae bibendum.</p>
					[/vc_column_text][vntd_button label="Learn More" style="text-btn" icon_enabled="yes" icon_fontawesome="fa fa-angle-right" icon_style="right_side" url="#"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'features_img_3cols_3' => array(
					'title' => esc_html__( 'Features with images 3', 'engage' ),
					'desc' => esc_html__( 'Row of image and descriptions, centered.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'With Image', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1494854759706{padding-top: 70px !important;padding-bottom: 50px !important;}"][vc_column][special_heading title="Incredible features." subtitle="Learn more about them. We have worked truly hard to make them perfect for every use." c_margin_bottom="60px"][vc_row_inner][vc_column_inner width="1/3" css=".vc_custom_1494854641565{padding-right: 20px !important;}"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-12.jpg" img_size="600x500"][vc_column_text css=".vc_custom_1494854714076{margin-bottom: 15px !important;}"]
					<h4 style="text-align: center;">Premium Support</h4>
					[/vc_column_text][vc_column_text]
					<p class="p1" style="text-align: center;">Proin interdum, ante ut sollicitudin commodo, tellus quam sagittis libero, at semper mauris velit a velit. Phasellus commodo turpis et lacinia posuere.</p>
					[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1494854662963{padding-right: 20px !important;padding-left: 20px !important;}"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-6.jpg" img_size="600x500"][vc_column_text css=".vc_custom_1494854727910{margin-bottom: 15px !important;}"]
					<h4 style="text-align: center;">Satisfied Clients</h4>
					[/vc_column_text][vc_column_text]
					<p class="p1" style="text-align: center;">Proin interdum, ante ut sollicitudin commodo, tellus quam sagittis libero, at semper mauris velit a velit. Phasellus commodo turpis et lacinia posuere.</p>
					[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1494854666876{padding-left: 20px !important;}"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-5.jpg" img_size="600x500"][vc_column_text css=".vc_custom_1494854731936{margin-bottom: 15px !important;}"]
					<h4 style="text-align: center;">Free Updates</h4>
					[/vc_column_text][vc_column_text]
					<p class="p1" style="text-align: center;">Proin interdum, ante ut sollicitudin commodo, tellus quam sagittis libero, at semper mauris velit a velit. Phasellus commodo turpis et lacinia posuere.</p>
					[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'img_icons_1' => array(
					'title' => esc_html__( 'Image with Icons 2', 'engage' ),
					'desc' => esc_html__( 'Icon boxes with image, fullwidth.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Icon Boxes', 'engage' ), esc_html__( 'With Image', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row full_width="stretch_row_content_no_spaces" equal_height="yes" content_placement="middle" css=".vc_custom_1493916312513{padding-top: 0px !important;padding-bottom: 0px !important;background-color: #f8f8f8 !important;}"][vc_column width="1/2" col_padding="6" css=".vc_custom_1493916541916{padding-top: 65px !important;padding-bottom: 20px !important;}"][vc_row_inner][vc_column_inner width="1/2"][icon_box title="Responsive Design" text="Engage is a fully responsive theme that scales well to all mobile devices." style="aligned-left-basic" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-display"][/vc_column_inner][vc_column_inner width="1/2"][icon_box title="Page Builder" text="Build any layout you can think of with the most powerful page builder." style="aligned-left-basic" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-pen"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/2"][icon_box title="Powerful Options" text="Take a full control over all aspects of your theme with our truly extensive." style="aligned-left-basic" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-params"][/vc_column_inner][vc_column_inner width="1/2"][icon_box title="Free Support" text="Our top-notch support team will be happy to answer any of your questions." style="aligned-left-basic" icon_type="linecons" c_margin_bottom="45px" icon_linecons="vc_li vc_li-bubble"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/2" col_padding_side="left" css=".vc_custom_1493916270663{background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-10-1600x1200.jpg) !important;}"][/vc_column][/vc_row]',
				),
				'icon_boxes_2x4_c_a' => array(
					'title' => esc_html__( 'Services 1', 'engage' ),
					'desc' => esc_html__( 'Headig with two rows of icon boxes.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Icon Boxes', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1493821714807{padding-top: 75px !important;padding-bottom: 20px !important;}"][vc_column][special_heading title="Our Services" subtitle="Learn more about our great services." align="center" c_margin_bottom="60px" add_icon="true" icon_type="linecons" icon_linecons="vc_li vc_li-star"][vc_row_inner css=".vc_custom_1493821700763{padding-top: 10px !important;padding-bottom: 30px !important;}"][vc_column_inner width="1/4"][icon_box title="Powerful Options" text="Take a full control over all aspects of your theme with our truly extensive Options Panel." style="centered-circle" icon_type="linecons" icon_linecons="vc_li vc_li-params"][/vc_column_inner][vc_column_inner width="1/4"][icon_box title="Responsive Design" text="Engage is a fully responsive and retina ready theme that scales well to all mobile devices." style="centered-circle" icon_type="linecons" icon_linecons="vc_li vc_li-display"][/vc_column_inner][vc_column_inner width="1/4"][icon_box title="Page Builder" text="Build any layout you can think of with the most powerful page builder Visual Composer." style="centered-circle" icon_type="linecons" icon_linecons="vc_li vc_li-pen"][/vc_column_inner][vc_column_inner width="1/4"][icon_box title="Styling Options" text="Adjust the looks of your theme with the extensive Styling panel. Possibilities are endless." style="centered-circle" icon_type="linecons" icon_linecons="vc_li vc_li-diamond"][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1493821710484{padding-top: 10px !important;padding-bottom: 30px !important;}"][vc_column_inner width="1/4"][icon_box title="Demo Content" text="All of presented layouts and theme demo pages are available with a single mouse click." style="centered-circle" icon_type="linecons" icon_linecons="vc_li vc_li-megaphone"][/vc_column_inner][vc_column_inner width="1/4"][icon_box title="Free Support" text="Our top-notch support team will be more than happy to answer any of your questions." style="centered-circle" icon_type="linecons" icon_linecons="vc_li vc_li-bubble"][/vc_column_inner][vc_column_inner width="1/4"][icon_box title="Documentation" text="Everything you need to know about the theme is located in the extensive documentation." style="centered-circle" icon_type="linecons" icon_linecons="vc_li vc_li-news"][/vc_column_inner][vc_column_inner width="1/4"][icon_box title="Premium Sliders" text="Engage comes with two most powerful sliders out there: Revolution Slider and Layer Slider." style="centered-circle" icon_type="linecons" icon_linecons="vc_li vc_li-camera"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'icon_boxes_3x3_a' => array(
					'title' => esc_html__( 'Services 2', 'engage' ),
					'desc' => esc_html__( 'Three rows of aligned icon boxes.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Icon Boxes', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row bg_color_pre="bg-color-1" css=".vc_custom_1494858169779{padding-top: 70px !important;padding-bottom: 10px !important;}"][vc_column][special_heading title="Our Features" subtitle="You are going to love those." c_margin_bottom="60px"][vc_row_inner css=".vc_custom_1494858130762{margin-bottom: 40px !important;}"][vc_column_inner width="1/3"][icon_box title="Powerful Options" text="Take a full control over all aspects of your theme with our truly extensive Options Panel." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-params"][/vc_column_inner][vc_column_inner width="1/3"][icon_box title="Responsive Design" text="Engage is a fully responsive and retina ready theme that scales well to all mobile devices." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-display"][/vc_column_inner][vc_column_inner width="1/3"][icon_box title="Satisfied Clients" text="Build any layout you can think of with the most powerful page builder Visual Composer." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-pen"][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1494858134698{margin-bottom: 40px !important;}"][vc_column_inner width="1/3"][icon_box title="Demo Content" text="All of presented layouts and theme demo pages are available with a single mouse click." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-megaphone"][/vc_column_inner][vc_column_inner width="1/3"][icon_box title="Free Support" text="Our top-notch support team will be more than happy to answer any of your questions." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-bubble"][/vc_column_inner][vc_column_inner width="1/3"][icon_box title="Documentation" text="Everything you need to know about the theme is located in the extensive documentation." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-news"][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1494858145826{margin-bottom: 40px !important;}"][vc_column_inner width="1/3"][icon_box title="Google Fonts" text="You may choose any font from the extensive Google Fonts library with a single mouse click." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-star"][/vc_column_inner][vc_column_inner width="1/3"][icon_box title="Premium Sliders" text="Engage comes with two most powerful sliders out there: Revolution Slider and Layer Slider." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-photo"][/vc_column_inner][vc_column_inner width="1/3"][icon_box title="Styling Options" text="Adjust the looks of your theme with the extensive Styling panel. Possibilities are endless." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-diamond"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'icon_boxes_2x3_bg_img' => array(
					'title' => esc_html__( 'Services 3', 'engage' ),
					'desc' => esc_html__( 'Icon boxes over image background.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Icon Boxes', 'engage' ), esc_html__( 'With Image', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row parallax="content-moving" parallax_speed_bg="1.4" color_scheme="white" bg_overlay="dark40" css=".vc_custom_1494851803586{padding-top: 70px !important;padding-bottom: 60px !important;background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-23.jpg) !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][special_heading title="System Features" c_margin_bottom="65px"][vc_row_inner css=".vc_custom_1494851314158{margin-bottom: 30px !important;}"][vc_column_inner width="1/3"][icon_box title="Powerful Options" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-params"][/vc_column_inner][vc_column_inner width="1/3"][icon_box title="Responsive Design" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-display"][/vc_column_inner][vc_column_inner width="1/3"][icon_box title="Satisfied Clients" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-heart"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/3"][icon_box title="Premium Support" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-news"][/vc_column_inner][vc_column_inner width="1/3"][icon_box title="Extensive Documentation" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-study"][/vc_column_inner][vc_column_inner width="1/3"][icon_box title="Free Updates" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-paperplane"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'icon_boxes_1x4_bg' => array(
					'title' => esc_html__( 'Services 4', 'engage' ),
					'desc' => esc_html__( 'Icon boxes with colored bg.', 'engage' ),
					'cat' => array( esc_html__( 'Icon Boxes', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row color_scheme="white" css=".vc_custom_1494837848610{padding-top: 70px !important;padding-bottom: 50px !important;background-color: #2196f3 !important;}"][vc_column][special_heading title="Our Features" c_margin_bottom="55px" subtitle_fs="20px"][vc_row_inner][vc_column_inner width="1/4"][icon_box title="Powerful Options" text="" style="centered-basic" icon_type="linecons" icon_linecons="vc_li vc_li-params"][/vc_column_inner][vc_column_inner width="1/4"][icon_box title="Responsive Design" text="" style="centered-basic" icon_type="linecons" icon_linecons="vc_li vc_li-display"][/vc_column_inner][vc_column_inner width="1/4"][icon_box title="Page Builder" text="" style="centered-basic" icon_type="linecons" icon_linecons="vc_li vc_li-pen"][/vc_column_inner][vc_column_inner width="1/4"][icon_box title="Satisfied Clients" text="" style="centered-basic" icon_type="linecons" icon_linecons="vc_li vc_li-heart"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'services_plain_2x3' => array(
					'title' => esc_html__( 'Services Text 1', 'engage' ),
					'desc' => esc_html__( 'A list of services, plain text', 'engage' ),
					'cat' => array( esc_html__( 'Features/Services', 'engage' ), esc_html__( 'Plain Text', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1495542037394{padding-top: 60px !important;padding-bottom: 30px !important;}"][vc_column][special_heading title="Our Services" subtitle="What we are great at." c_margin_bottom="60px" add_icon="true" icon_fontawesome="fa fa-flag-o"][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/3"][vc_column_text]<h5>Facilities</h5>Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae aliquet consequat. Aliquam ullamcorper.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]<h5>Best Equipment</h5>Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae aliquet consequat. Aliquam ullamcorper.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]<h5>Incredible Location</h5>Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae aliquet consequat. Aliquam ullamcorper.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/3"][vc_column_text]<h5>Premium Support</h5>Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae aliquet consequat. Aliquam ullamcorper.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]<h5>Incredible Team</h5>Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae aliquet consequat. Aliquam ullamcorper.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]<h5>Incredible Location</h5>Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae aliquet consequat. Aliquam ullamcorper.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'services_plain_2x2' => array(
					'title' => esc_html__( 'Services Text 2', 'engage' ),
					'desc' => esc_html__( 'A list of services, plain text', 'engage' ),
					'cat' => array( esc_html__( 'Features/Services', 'engage' ), esc_html__( 'Plain Text', 'engage' ) ),
					'sc' => '[vc_row bg_color_pre="bg-color-1" css=".vc_custom_1495542047594{padding-top: 70px !important;padding-bottom: 35px !important;}"][vc_column][special_heading title="Our Services" subtitle="What we are great at." c_margin_bottom="60px"][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/2"][vc_column_text]<h4>Facilities</h4><p class="p1">Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo leo velit sit amet velit. Aliquam fermentum, lorem quis posuere mattis, est justo porttitor magna, in commodo risus justo vitae nibh. Sed mollis sapien erat, id pellentesque libero interdum at. Vivamus finibus laoreet tristique. Quisque pharetra, urna nec consequat pretium, est nisl maximus sem.</p>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]<h4>Best Equipment</h4>Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo leo velit sit amet velit. Aliquam fermentum, lorem quis posuere mattis, est justo porttitor magna, in commodo risus justo vitae nibh. Sed mollis sapien erat, id pellentesque libero interdum at. Vivamus finibus laoreet tristique. Quisque pharetra, urna nec consequat pretium, est nisl maximus sem.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/2"][vc_column_text]<h4>Fantastic Location</h4><p class="p1">Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo leo velit sit amet velit. Aliquam fermentum, lorem quis posuere mattis, est justo porttitor magna, in commodo risus justo vitae nibh. Sed mollis sapien erat, id pellentesque libero interdum at. Vivamus finibus laoreet tristique. Quisque pharetra, urna nec consequat pretium, est nisl maximus sem.</p>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]<h4>Best Equipment</h4>Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo leo velit sit amet velit. Aliquam fermentum, lorem quis posuere mattis, est justo porttitor magna, in commodo risus justo vitae nibh. Sed mollis sapien erat, id pellentesque libero interdum at. Vivamus finibus laoreet tristique. Quisque pharetra, urna nec consequat pretium, est nisl maximus sem.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'services_plain_2n3' => array(
					'title' => esc_html__( 'Services Text 3', 'engage' ),
					'desc' => esc_html__( 'A step list of services, plain text', 'engage' ),
					'cat' => array( esc_html__( 'Features/Services', 'engage' ), esc_html__( 'Plain Text', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1495542072137{padding-top: 70px !important;padding-bottom: 35px !important;}"][vc_column][special_heading title="Our Services" subtitle="Duis eget quam tincidunt, blandit massa quis, dapibus diam. Integer ut interdum ex. Nullam vitae elit turpis." c_margin_bottom="60px"][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/2"][vc_column_text font_size="medium"]<h4>Facilities</h4><p class="p1">Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo leo velit sit amet velit. Aliquam fermentum, lorem quis posuere mattis, est justo porttitor magna, in commodo risus justo vitae nibh. Sed mollis sapien erat, id pellentesque libero.</p>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text font_size="medium"]<h4>Best Equipment</h4>Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo leo velit sit amet velit. Aliquam fermentum, lorem quis posuere mattis, est justo porttitor magna, in commodo risus justo vitae nibh. Sed mollis sapien erat, id pellentesque libero.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/3"][vc_column_text]<h5>Location</h5><p class="p1">Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan erat quis risus rhoncus, laoreet lobortis diam tincidunt.</p>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]<h5>Premium Support</h5>Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan erat quis risus rhoncus, laoreet lobortis diam tincidunt.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]<h5>Awesome Team</h5>Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan erat quis risus rhoncus, laoreet lobortis diam tincidunt.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'services_plain_2x2_img' => array(
					'title' => esc_html__( 'Services with Image', 'engage' ),
					'desc' => esc_html__( 'List of services with an image.', 'engage' ),
					'cat' => array( esc_html__( 'Features/Services', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" parallax="content-moving" parallax_speed_bg="1.3" css=".vc_custom_1494860920894{padding-top: 90px !important;padding-bottom: 90px !important;background-position: center;background-repeat: no-repeat;background-size:cover !important;}"][vc_column width="7/12" col_padding="2" col_padding_side="right" css=".vc_custom_1495542874381{padding-top: 35px !important;}"][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/2"][vc_column_text]<h5>Location</h5><p class="p1">Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan erat quis risus.</p>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]<h5>Advanced Features</h5>Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan erat quis risus.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1495542907558{padding-bottom: 0px !important;}"][vc_column_inner width="1/2"][vc_column_text]<h5>Premium Support</h5><p class="p1">Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan erat quis risus.</p>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]<h5>Responsive Design</h5>Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan erat quis risus.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="5/12" col_padding="2" col_padding_side="left"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/square-5.jpg" img_size="700x600" css=".vc_custom_1495543110874{margin-bottom: 0px !important;}"][/vc_column][/vc_row]',
				),
				'services_plain_3x2_img' => array(
					'title' => esc_html__( 'Services with Image 2', 'engage' ),
					'desc' => esc_html__( 'List of services with vertical image.', 'engage' ),
					'cat' => array( esc_html__( 'Features/Services', 'engage' ), esc_html__( 'Text + Image', 'engage' ), esc_html__( 'With Image', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" parallax="content-moving" parallax_speed_bg="1.3" css=".vc_custom_1495543442812{padding-top: 90px !important;padding-bottom: 80px !important;}"][vc_column width="1/3" col_padding="2" col_padding_side="right" css=".vc_custom_1495543020396{padding-top: 0px !important;}"][vc_single_image image="http://media.veented.com/wp-content/uploads/2017/09/full-5.jpg" img_size="700x1100" css=".vc_custom_1495543326257{margin-bottom: 0px !important;}"][/vc_column][vc_column width="2/3" col_padding="2" col_padding_side="left" css=".vc_custom_1495543400531{padding-top: 55px !important;}"][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/2"][vc_column_text]<h5>Premium Support</h5><p class="p1">Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan.</p>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]<h5>Great Team</h5>Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/2"][vc_column_text]<h5>Premium Support</h5><p class="p1">Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan.</p>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]<h5>Great Team</h5>
					Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/2"][vc_column_text]<h5>Premium Support</h5><p class="p1">Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan.</p>
					[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]<h5>Great Team</h5>Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'services_plain_2x2_side' => array(
					'title' => esc_html__( 'Services with Side Heading', 'engage' ),
					'desc' => esc_html__( 'List of services with side heading.', 'engage' ),
					'cat' => array( esc_html__( 'Features/Services', 'engage' ), esc_html__( 'Plain Text', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="top" parallax="content-moving" parallax_speed_bg="1.3" css=".vc_custom_1495543097611{padding-top: 95px !important;padding-bottom: 30px !important;background-position: 0 0;background-repeat: no-repeat !important;}"][vc_column width="1/4" col_padding="2" col_padding_side="right" css=".vc_custom_1495543020396{padding-top: 0px !important;}"][vc_column_text]<h3>Our Services</h3>[/vc_column_text][/vc_column][vc_column width="3/4" col_padding="2" col_padding_side="left"][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/2"][vc_column_text]<h5>Premium Support</h5><p class="p1">Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan erat quis risus rhoncus, laoreet lobortis diam tincidunt.</p>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]<h5>Great Team</h5>Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan erat quis risus rhoncus, laoreet lobortis diam tincidunt.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/2"][vc_column_text]<h5>Location</h5><p class="p1">Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan erat quis risus rhoncus, laoreet lobortis diam tincidunt.</p>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]<h5>Responsive Design</h5>Cras auctor consectetur pharetra. Phasellus sollicitudin diam purus, at sagittis diam elementum venenatis. Phasellus accumsan erat quis risus rhoncus, laoreet lobortis diam tincidunt.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'icon_boxes_1x4_c' => array(
					'title' => esc_html__( 'Icon Boxes Outline', 'engage' ),
					'desc' => esc_html__( 'A row of centered, outline icon boxes.', 'engage' ),
					'cat' => array( esc_html__( 'Icon Boxes', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1493725837900{padding-top: 85px !important;padding-bottom: 45px !important;}"][vc_column width="1/4"][icon_box title="Powerful Options" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." icon_type="linecons" icon_linecons="vc_li vc_li-params"][/vc_column][vc_column width="1/4"][icon_box title="Responsive Design" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." icon_type="linecons" icon_linecons="vc_li vc_li-display"][/vc_column][vc_column width="1/4"][icon_box title="Page Builder" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." icon_type="linecons" icon_linecons="vc_li vc_li-pen"][/vc_column][vc_column width="1/4"][icon_box title="Satisfied Clients" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." icon_type="linecons" icon_linecons="vc_li vc_li-heart"][/vc_column][/vc_row]',
				),
				'icon_boxes_1x4_c_accent' => array(
					'title' => esc_html__( '1x4 Icon Boxes Accent', 'engage' ),
					'desc' => esc_html__( 'A row of centered icon boxes.', 'engage' ),
					'cat' => array( esc_html__( 'Icon Boxes', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1493725830541{padding-top: 85px !important;padding-bottom: 45px !important;}"][vc_column width="1/4"][icon_box title="Powerful Options" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="centered-circle" icon_type="linecons" icon_linecons="vc_li vc_li-params"][/vc_column][vc_column width="1/4"][icon_box title="Responsive Design" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="centered-circle" icon_type="linecons" icon_linecons="vc_li vc_li-display"][/vc_column][vc_column width="1/4"][icon_box title="Page Builder" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="centered-circle" icon_type="linecons" icon_linecons="vc_li vc_li-pen"][/vc_column][vc_column width="1/4"][icon_box title="Satisfied Clients" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="centered-circle" icon_type="linecons" icon_linecons="vc_li vc_li-heart"][/vc_column][/vc_row]',
				),
				'icon_boxes_1x4_basic' => array(
					'title' => esc_html__( '1x4 Icon Boxes Basic', 'engage' ),
					'desc' => esc_html__( 'A row of basic centered icon boxes.', 'engage' ),
					'cat' => array( esc_html__( 'Icon Boxes', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1493726240893{padding-top: 80px !important;padding-bottom: 45px !important;}"][vc_column width="1/4"][icon_box title="Powerful Options" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="centered-basic" icon_type="linecons" icon_linecons="vc_li vc_li-params"][/vc_column][vc_column width="1/4"][icon_box title="Responsive Design" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="centered-basic" icon_type="linecons" icon_linecons="vc_li vc_li-display"][/vc_column][vc_column width="1/4"][icon_box title="Page Builder" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="centered-basic" icon_type="linecons" icon_linecons="vc_li vc_li-pen"][/vc_column][vc_column width="1/4"][icon_box title="Satisfied Clients" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="centered-basic" icon_type="linecons" icon_linecons="vc_li vc_li-heart"][/vc_column][/vc_row]',
				),
				'icon_boxes_1x4_boxed' => array(
					'title' => esc_html__( '1x4 Icon Boxes Boxed', 'engage' ),
					'desc' => esc_html__( 'A row of basic centered icon boxes.', 'engage' ),
					'cat' => array( esc_html__( 'Icon Boxes', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1493725837900{padding-top: 85px !important;padding-bottom: 45px !important;}"][vc_column width="1/4"][icon_box title="Powerful Options" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="centered-boxed" icon_type="linecons" icon_linecons="vc_li vc_li-params"][/vc_column][vc_column width="1/4"][icon_box title="Responsive Design" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="centered-boxed" icon_type="linecons" icon_linecons="vc_li vc_li-display"][/vc_column][vc_column width="1/4"][icon_box title="Page Builder" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="centered-boxed" icon_type="linecons" icon_linecons="vc_li vc_li-pen"][/vc_column][vc_column width="1/4"][icon_box title="Satisfied Clients" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="centered-boxed" icon_type="linecons" icon_linecons="vc_li vc_li-heart"][/vc_column][/vc_row]',
				),
				'icon_boxes_1x4_aligned' => array(
					'title' => esc_html__( '1x3 Icon Boxes Aligned', 'engage' ),
					'desc' => esc_html__( 'A row of 3 aligned icon boxes.', 'engage' ),
					'cat' => array( esc_html__( 'Icon Boxes', 'engage' ), esc_html__( 'Features/Services', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1493725837900{padding-top: 85px !important;padding-bottom: 45px !important;}"][vc_column width="1/3"][icon_box title="Powerful Options" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-params"][/vc_column][vc_column width="1/3"][icon_box title="Responsive Design" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-display"][/vc_column][vc_column width="1/3"][icon_box title="Satisfied Clients" text="Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo." style="aligned-left-basic" icon_type="linecons" icon_linecons="vc_li vc_li-heart"][/vc_column][/vc_row]',
				),
				'counters_gradient' => array(
					'title' => esc_html__( 'Counters Gradient', 'engage' ),
					'desc' => esc_html__( 'Counters on a gradient background.', 'engage' ),
					'cat' => array( esc_html__( 'Counters', 'engage' ) ),
					'sc' => '[vc_row parallax="content-moving" bg_overlay="dark20" bg_gradient1="#b06ab3" bg_gradient2="#4568dc" css=".vc_custom_1493833267010{padding-top: 95px !important;padding-bottom: 60px !important;background-color: #b06ab3 !important;}"][vc_column width="1/4"][counter title="Page Likes" number="1430" color="white" icon_type="linecons" icon_linecons="vc_li vc_li-like"][/vc_column][vc_column width="1/4"][counter title="Locations" number="64" color="white" icon_type="linecons" icon_linecons="vc_li vc_li-shop"][/vc_column][vc_column width="1/4"][counter title="Great Ideas" number="960" color="white" icon_type="linecons" icon_linecons="vc_li vc_li-bulb"][/vc_column][vc_column width="1/4"][counter title="Comments" number="420" color="white" icon_type="linecons" icon_linecons="vc_li vc_li-bubble"][/vc_column][/vc_row]',
				),
				'counters_accent' => array(
					'title' => esc_html__( 'Counters Accent', 'engage' ),
					'desc' => esc_html__( 'Counters on an accent background.', 'engage' ),
					'cat' => array( esc_html__( 'Counters', 'engage' ) ),
					'sc' => '[vc_row parallax="content-moving" bg_color_pre="bg-color-accent" css=".vc_custom_1493833319536{padding-top: 95px !important;padding-bottom: 60px !important;}"][vc_column width="1/4"][counter title="Page Likes" number="1430" color="white" icon_type="linecons" icon_linecons="vc_li vc_li-like"][/vc_column][vc_column width="1/4"][counter title="Locations" number="64" color="white" icon_type="linecons" icon_linecons="vc_li vc_li-shop"][/vc_column][vc_column width="1/4"][counter title="Great Ideas" number="960" color="white" icon_type="linecons" icon_linecons="vc_li vc_li-bulb"][/vc_column][vc_column width="1/4"][counter title="Comments" number="420" color="white" icon_type="linecons" icon_linecons="vc_li vc_li-bubble"][/vc_column][/vc_row]',
				),
				esc_html__( 'Counters', 'engage' ) => array(
					'title' => esc_html__( 'Counters Light', 'engage' ),
					'desc' => esc_html__( 'Counters on a light background.', 'engage' ),
					'cat' => array( esc_html__( 'Counters', 'engage' ) ),
					'sc' => '[vc_row parallax="content-moving" css=".vc_custom_1493833438333{padding-top: 95px !important;padding-bottom: 60px !important;}"][vc_column width="1/4"][counter title="Page Likes" number="1430" icon_type="linecons" icon_linecons="vc_li vc_li-like"][/vc_column][vc_column width="1/4"][counter title="Locations" number="64" icon_type="linecons" icon_linecons="vc_li vc_li-shop"][/vc_column][vc_column width="1/4"][counter title="Great Ideas" number="960" icon_type="linecons" icon_linecons="vc_li vc_li-bulb"][/vc_column][vc_column width="1/4"][counter title="Comments" number="420" icon_type="linecons" icon_linecons="vc_li vc_li-bubble"][/vc_column][/vc_row]',
				),
				'pie_charts' => array(
					'title' => esc_html__( 'Pie Charts', 'engage' ),
					'desc' => esc_html__( 'A row of pie charts.', 'engage' ),
					'cat' => array( esc_html__( 'Charts and Progress', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1494858964069{padding-top: 90px !important;padding-bottom: 55px !important;}"][vc_column width="1/4"][vc_pie value="60" color="vista-blue" title="Features" units="%"][/vc_column][vc_column width="1/4"][vc_pie value="74" color="vista-blue" title="Design" units="%"][/vc_column][vc_column width="1/4"][vc_pie value="86" color="vista-blue" title="Development" units="%"][/vc_column][vc_column width="1/4"][vc_pie value="94" color="vista-blue" title="JavaScript" units="%"][/vc_column][/vc_row]',
				),
				'pie_charts_c' => array(
					'title' => esc_html__( 'Pie Charts Color', 'engage' ),
					'desc' => esc_html__( 'A row of pie charts on a blue bg.', 'engage' ),
					'cat' => array( esc_html__( 'Charts and Progress', 'engage' ) ),
					'sc' => '[vc_row color_scheme="white" css=".vc_custom_1494859004879{padding-top: 90px !important;padding-bottom: 50px !important;background-color: #3f51b5 !important;}"][vc_column width="1/4"][vc_pie value="60" color="white" title="Features" units="%"][/vc_column][vc_column width="1/4"][vc_pie value="74" color="white" title="Design" units="%"][/vc_column][vc_column width="1/4"][vc_pie value="86" color="white" title="Development" units="%"][/vc_column][vc_column width="1/4"][vc_pie value="94" color="white" title="JavaScript" units="%"][/vc_column][/vc_row]',
				),
				'progress_bars' => array(
					'title' => esc_html__( 'Progress Bars + Text', 'engage' ),
					'desc' => esc_html__( 'A row of pie charts on a blue bg.', 'engage' ),
					'cat' => array( esc_html__( 'Charts and Progress', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1494857494829{padding-top: 80px !important;padding-bottom: 55px !important;}"][vc_column width="1/2" col_padding="2" col_padding_side="right"][vc_column_text css=".vc_custom_1494857472580{margin-bottom: 18px !important;}"]
					<h3>Our Skills</h2>[/vc_column_text][vc_column_text]Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo leo velit sit amet velit. Aliquam fermentum, lorem quis posuere mattis, est justo porttitor magna, in commodo risus justo vitae nibh. Sed mollis sapien erat, id pellentesque libero interdum at. Mauris sodales felis luctus purus hendreri. Vivamus baram sapien era.[/vc_column_text][/vc_column][vc_column width="1/2" col_padding="2" col_padding_side="left"][vc_progress_bar values="%5B%7B%22label%22%3A%22Development%22%2C%22value%22%3A%2294%22%7D%2C%7B%22label%22%3A%22Design%22%2C%22value%22%3A%2286%22%7D%2C%7B%22label%22%3A%22Marketing%22%2C%22value%22%3A%2278%22%7D%2C%7B%22label%22%3A%22Webdev%22%2C%22value%22%3A%2272%22%7D%5D" bgcolor="accent" units="%"][/vc_column][/vc_row]',
				),
				'progress_bars_text_right' => array(
					'title' => esc_html__( 'Progress Bars + Text 2', 'engage' ),
					'desc' => esc_html__( 'A row of pie charts on a blue bg.', 'engage' ),
					'cat' => array( esc_html__( 'Charts and Progress', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1494857613169{padding-top: 80px !important;padding-bottom: 55px !important;}"][vc_column width="1/2" col_padding="2" col_padding_side="right"][vc_progress_bar values="%5B%7B%22label%22%3A%22Development%22%2C%22value%22%3A%2294%22%7D%2C%7B%22label%22%3A%22Design%22%2C%22value%22%3A%2286%22%7D%2C%7B%22label%22%3A%22Marketing%22%2C%22value%22%3A%2278%22%7D%2C%7B%22label%22%3A%22Webdev%22%2C%22value%22%3A%2272%22%7D%5D" bgcolor="accent" units="%"][/vc_column][vc_column width="1/2" col_padding="2" col_padding_side="left"][vc_column_text css=".vc_custom_1494857472580{margin-bottom: 18px !important;}"]
					<h3>Our Skills</h2>[/vc_column_text][vc_column_text]Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo leo velit sit amet velit. Aliquam fermentum, lorem quis posuere mattis, est justo porttitor magna, in commodo risus justo vitae nibh. Sed mollis sapien erat, id pellentesque libero interdum at. Mauris sodales felis luctus purus hendreri. Vivamus baram sapien era.[/vc_column_text][/vc_column][/vc_row]',
				),
				'sheading_1' => array(
					'title' => esc_html__( 'Heading 1', 'engage' ),
					'desc' => esc_html__( 'Centered heading with subtitle.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Headings', 'engage' ) ),
					'sc' => '[vc_row][vc_column][special_heading title="Section Title" subtitle="And here goes a super fancy description of the section."][/vc_column][/vc_row]',
				),
				'sheading_highlight' => array(
					'title' => esc_html__( 'Heading Highlights', 'engage' ),
					'desc' => esc_html__( 'Centered heading with highlighted words.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Headings', 'engage' ) ),
					'sc' => '[vc_row][vc_column][special_heading title="Section Title" subtitle="And here goes a super fancy description with a (b)highlighted(/b) word to make it even more cool and to (b)make(/b) some words standout more."][/vc_column][/vc_row]',
				),
				'sheading_border' => array(
					'title' => esc_html__( 'Heading with Border', 'engage' ),
					'desc' => esc_html__( 'Centered heading with a border below.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Headings', 'engage' ) ),
					'sc' => '[vc_row][vc_column][special_heading title="Section Title" subtitle="And here goes a super fancy description of the section." border="below"][/vc_column][/vc_row]',
				),
				'sheading_icon' => array(
					'title' => esc_html__( 'Heading with Icon', 'engage' ),
					'desc' => esc_html__( 'Centered heading with an icon.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Headings', 'engage' ) ),
					'sc' => '[vc_row][vc_column][special_heading title="Section Title" subtitle="And here goes a super fancy description of the section." add_icon="true" icon_fontawesome="fa fa-heart-o"][/vc_column][/vc_row]',
				),
				'sheading_icon_border' => array(
					'title' => esc_html__( 'Heading with Icon 2', 'engage' ),
					'desc' => esc_html__( 'Centered heading with an icon and border.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Headings', 'engage' ) ),
					'sc' => '[vc_row][vc_column][special_heading title="Section Title" subtitle="And here goes a super fancy description of the section." border="below" add_icon="true" icon_fontawesome="fa fa-heart-o"][/vc_column][/vc_row]',
				),
				'sheading_left' => array(
					'title' => esc_html__( 'Heading Aligned', 'engage' ),
					'desc' => esc_html__( 'Heading with subtitle aligned left.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Headings', 'engage' ) ),
					'sc' => '[vc_row][vc_column][special_heading title="Section Title" subtitle="And here goes a super fancy description of the section." align="left"][/vc_column][/vc_row]',
				),
				'video_embed' => array(
					'title' => esc_html__( 'Video Embedded', 'engage' ),
					'desc' => esc_html__( 'Embedded video for Vimeo, Youtube and more.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Video', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1494860257444{padding-top: 80px !important;padding-bottom: 70px !important;}"][vc_column][special_heading title="Embedded Video" subtitle="This section has an embedded Vimeo video." c_margin_bottom="60px"][vc_video css=".vc_custom_1494860195254{padding-right: 10% !important;padding-left: 10% !important;}"][/vc_column][/vc_row]
					',
				),
				'video_lightbox_img_light' => array(
					'title' => esc_html__( 'Video Lightbox Img', 'engage' ),
					'desc' => esc_html__( 'Video lightbox with a placeholder image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Video', 'engage' ) ),
					'sc' => '[vc_row parallax="content-moving" css=".vc_custom_1493989844972{padding-top: 100px !important;padding-bottom: 120px !important;background-color: #f7f7f7 !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][special_heading title="Our Video" subtitle="Learn more about us from this video." c_margin_bottom="50px"][video_lightbox style="img" img="http://media.veented.com/wp-content/uploads/2017/09/full-14-1400x900.jpg" border="round" link="https://www.youtube.com/watch?v=ty0SGNZi81U"][/vc_column][/vc_row]',
				),
				'video_lightbox_img_gd' => array(
					'title' => esc_html__( 'Video Lightbox Img 2', 'engage' ),
					'desc' => esc_html__( 'Video lightbox with a placeholder image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Video', 'engage' ) ),
					'sc' => '[vc_row parallax="content-moving" color_scheme="white" bg_gradient1="#b06ab3" bg_gradient2="#4568dc" css=".vc_custom_1493989477376{padding-top: 100px !important;padding-bottom: 120px !important;background-color: #b06ab3 !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][special_heading title="Our Video" subtitle="Learn more about us from this video." c_margin_bottom="50px"][video_lightbox style="img" img="http://media.veented.com/wp-content/uploads/2017/09/full-14-1400x900.jpg" border="round" link="https://www.youtube.com/watch?v=ty0SGNZi81U"][/vc_column][/vc_row]',
				),
				'video_lightbox_img' => array(
					'title' => esc_html__( 'Video Lightbox', 'engage' ),
					'desc' => esc_html__( 'Video lightbox with a background image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Video', 'engage' ) ),
					'sc' => '[vc_row parallax="content-moving" bg_overlay="dark40" css=".vc_custom_1493982898825{padding-top: 130px !important;padding-bottom: 110px !important;background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-14.jpg) !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][video_lightbox title="Our Video" description="Learn a bit more about our awesome company from this short clip we recorded together this summer!" link="https://www.youtube.com/watch?v=ty0SGNZi81U"][/vc_column][/vc_row]',
				),
				'video_lightbox_accent' => array(
					'title' => esc_html__( 'Video Lightbox Accent', 'engage' ),
					'desc' => esc_html__( 'Video lightbox with an accent overlay.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Video', 'engage' ) ),
					'sc' => '[vc_row parallax="content-moving" bg_overlay="accent" css=".vc_custom_1493982884769{padding-top: 130px !important;padding-bottom: 110px !important;background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-14.jpg) !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][video_lightbox title="Our Video" description="Learn a bit more about our awesome company from this short clip we recorded together this summer!" link="https://www.youtube.com/watch?v=ty0SGNZi81U"][/vc_column][/vc_row]',
				),
				'video_lightbox_gd' => array(
					'title' => esc_html__( 'Video Lightbox Gradient', 'engage' ),
					'desc' => esc_html__( 'Video lightbox with a gradient background.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Video', 'engage' ) ),
					'sc' => '[vc_row parallax="content-moving" bg_gradient1="#b06ab3" bg_gradient2="#4568dc" css=".vc_custom_1493983022628{padding-top: 130px !important;padding-bottom: 110px !important;background-color: #b06ab3 !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][video_lightbox title="Our Video" description="Learn a bit more about our awesome company from this short clip we recorded together this summer!" link="https://www.youtube.com/watch?v=ty0SGNZi81U"][/vc_column][/vc_row]',
				),
				'text_two_cols_h' => array(
					'title' => esc_html__( 'Two columns of text.', 'engage' ),
					'desc' => esc_html__( 'Plain text in two columns with a heading.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Plain Text', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1494837258934{padding-top: 75px !important;padding-bottom: 50px !important;}"][vc_column][vc_custom_heading text="We are truly unique. Wanna know why?" font_container="tag:h2|font_size:34px|text_align:center" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal" css=".vc_custom_1494837196348{margin-bottom: 45px !important;}"][vc_row_inner][vc_column_inner width="1/2" css=".vc_custom_1494837242649{padding-right: 25px !important;}"][vc_column_text]
					<p class="p1">Morbi pellentesque, nisl id semper bibendum, nibh sem fermentum magna, eget commodo leo velit sit amet velit. Aliquam fermentum, lorem quis posuere mattis, est justo porttitor magna, in commodo risus justo vitae nibh. Sed mollis sapien erat, id pellentesque libero interdum at.Mauris sodales felis luctus purus hendreri. Vivamus finibus laoreet tristique. Quisque pharetra, urna.</p>
					[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2" css=".vc_custom_1494837238398{padding-left: 25px !important;}"][vc_column_text]
					<p class="p1">Nunc id ante quis tellus faucibus dictum in eget metus. Duis suscipit elit sem, sed mattis tellus accumsan eget. Quisque consequat venenatis rutrum. Quisque posuere enim augue, in rhoncus diam dictum non. Etiam mollis pulvinar nisl, sed pharetra nunc elementum non. Mauris sodales felis luctus purus hendrerit, vel cursus odio pulvinar. In ullamcorper ultrices purus.</p>
					[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'text_video_bg_row' => array(
					'title' => esc_html__( 'Section with video background.', 'engage' ),
					'desc' => esc_html__( 'Plain text over a video background.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Video', 'engage' ), esc_html__( 'Plain Text', 'engage' ) ),
					'sc' => '[vc_row video_bg="yes" video_bg_url="https://www.youtube.com/watch?v=2QKQX7fbjnA" color_scheme="white" bg_overlay="dark40" css=".vc_custom_1494859962917{padding-top: 100px !important;padding-bottom: 80px !important;}"][vc_column][vc_row_inner css=".vc_custom_1494859640521{padding-right: 14% !important;padding-left: 14% !important;}"][vc_column_inner][special_heading title="Video Background" subtitle="This section has a video background." border="below" c_margin_bottom="40px"][vc_column_text font_size="large"]
					<p class="p1" style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id risus a orci rutrum scelerisque id ut nibh. Proin interdum, ante ut sollicitudin commodo, tellus quam sagittis libero, at semper mauris velit a velit. Phasellus commodo turpis et lacinia posuere.</p>
					[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'text_bg_color' => array(
					'title' => esc_html__( 'Centered text.', 'engage' ),
					'desc' => esc_html__( 'Centered plain text with a blue background.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Plain Text', 'engage' ) ),
					'sc' => '[vc_row video_bg="yes" video_bg_url="" color_scheme="white" bg_overlay="dark40" css=".vc_custom_1494860444039{padding-top: 100px !important;padding-bottom: 80px !important;background-color: #3949ab !important;}"][vc_column][vc_row_inner css=".vc_custom_1494859640521{padding-right: 14% !important;padding-left: 14% !important;}"][vc_column_inner][special_heading title="Text Section" subtitle="Section with some big plain text." border="below" c_margin_bottom="40px"][vc_column_text font_size="large"]
					<p class="p1" style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id risus a orci rutrum scelerisque id ut nibh. Proin interdum, ante ut sollicitudin commodo, tellus quam sagittis libero, at semper mauris velit a velit. Phasellus commodo turpis et lacinia posuere.</p>
					[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'text_bg_accent' => array(
					'title' => esc_html__( 'Centered text, accent.', 'engage' ),
					'desc' => esc_html__( 'Centered plain text with an accent background.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Plain Text', 'engage' ) ),
					'sc' => '[vc_row video_bg="yes" video_bg_url="" color_scheme="white" bg_color_pre="bg-color-accent" css=".vc_custom_1494862211517{padding-top: 90px !important;padding-bottom: 60px !important;}"][vc_column width="1/4"][/vc_column][vc_column width="2/4"][vc_column_text css=".vc_custom_1494860711961{margin-bottom: 25px !important;}"]
					<h2 style="text-align: center;">The best part?</h2>
					[/vc_column_text][vc_column_text font_size="large"]
					<p style="text-align: center;">We have been operating for over 30 years and are Members of The Federation of Master Builders. We work on projects big and small from small residential extensions to full house. We are so happy with this theme. Everyday it make our lives better.</p>
					[/vc_column_text][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]',
				),
				'logos' => array(
					'title' => esc_html__( 'Logos Carousel', 'engage' ),
					'desc' => esc_html__( 'Simple client logos carousel.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Carousel', 'engage' ), esc_html__( 'Clients', 'engage' ) ),
					'sc' => '[vc_row bg_color_pre="bg-color-1" css=".vc_custom_1493990837872{padding-top: 30px !important;padding-bottom: 5px !important;}"][vc_column][client_logos images="603,601,602,599,600,598" cols="5" dots="false"][/vc_column][/vc_row]',
				),
				'cta_light' => array(
					'title' => esc_html__( 'Call to Action Light', 'engage' ),
					'desc' => esc_html__( 'Call to action section, light.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Call to Action', 'engage' ) ),
					'sc' => '[vc_row full_width="stretch_row_content_no_spaces" bg_color_pre="bg-color-1" css=".vc_custom_1494250676237{padding-top: 25px !important;padding-bottom: 20px !important;}"][vc_column][cta heading="Feeling convinced?" subheading="I am a subtitle, feel free to change me!" container="contain" align="center" text_color="dark" button1_color="accent" button1_style="solid" el_bg="none"][/vc_column][/vc_row]',
				),
				'cta_accent' => array(
					'title' => esc_html__( 'Call to Action Accent', 'engage' ),
					'desc' => esc_html__( 'Call to action section, accent bg.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Call to Action', 'engage' ) ),
					'sc' => '[vc_row full_width="stretch_row_content_no_spaces" bg_color_pre="bg-color-accent" css=".vc_custom_1494250403646{padding-top: 0px !important;}"][vc_column][cta heading="Feeling convinced?" subheading="I am a subtitle, feel free to change me!" container="contain" align="center" button1_color="white" el_bg="none"][/vc_column][/vc_row]',
				),
				'cta_gd' => array(
					'title' => esc_html__( 'Call to Action Gradient', 'engage' ),
					'desc' => esc_html__( 'Call to action section, gradient bg.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Call to Action', 'engage' ) ),
					'sc' => '[vc_row full_width="stretch_row_content_no_spaces" bg_gradient1="#b06ab3" bg_gradient2="#4568dc" css=".vc_custom_1494250711563{padding-top: 45px !important;padding-bottom: 40px !important;}"][vc_column][cta heading="Feeling convinced?" subheading="I am a subtitle, feel free to change me!" container="contain" align="center" button1_color="white" el_bg="none"][/vc_column][/vc_row]',
				),
				'cta_img' => array(
					'title' => esc_html__( 'Call to Action Image', 'engage' ),
					'desc' => esc_html__( 'Call to action section, image bg.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Call to Action', 'engage' ) ),
					'sc' => '[vc_row full_width="stretch_row_content_no_spaces" bg_color_pre="bg-color-accent" bg_overlay="dark30" css=".vc_custom_1494250497331{padding-top: 45px !important;padding-bottom: 40px !important;background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-14.jpg) !important;}"][vc_column][cta heading="Feeling convinced?" subheading="I am a subtitle, feel free to change me!" container="contain" align="center" button1_color="white" el_bg="none"][/vc_column][/vc_row]',
				),
				'cta_align_light' => array(
					'title' => esc_html__( 'Call to Action Aligned', 'engage' ),
					'desc' => esc_html__( 'Call to action, aligned, light.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Call to Action', 'engage' ) ),
					'sc' => '[vc_row full_width="stretch_row_content_no_spaces" bg_color_pre="bg-color-1" css=".vc_custom_1494250779120{padding-top: 0px !important;}"][vc_column][cta heading="Feeling convinced?" subheading="I am a subtitle, feel free to change me!" container="contain" text_color="dark" button1_color="accent" button1_style="solid" el_bg="none"][/vc_column][/vc_row]',
				),
				'cta_align_accent' => array(
					'title' => esc_html__( 'Call to Action Aligned 2', 'engage' ),
					'desc' => esc_html__( 'Call to action, aligned, accent bg.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Call to Action', 'engage' ) ),
					'sc' => '[vc_row full_width="stretch_row_content_no_spaces" css=".vc_custom_1494250266432{padding-top: 0px !important;}"][vc_column][cta heading="Feeling convinced?" subheading="I am a subtitle, feel free to change me!" container="contain" button1_color="white"][/vc_column][/vc_row]',
				),
				'cta_align_gd' => array(
					'title' => esc_html__( 'Call to Action Aligned 3', 'engage' ),
					'desc' => esc_html__( 'Call to action, aligned, gradient bg.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Call to Action', 'engage' ) ),
					'sc' => '[vc_row full_width="stretch_row_content_no_spaces" css=".vc_custom_1494250266432{padding-top: 0px !important;}"][vc_column][cta heading="Feeling convinced?" subheading="I am a subtitle, feel free to change me!" container="contain" button1_color="white" el_bg="custom" bg_color_custom="#b06ab3" bg_color_custom2="#4568dc"][/vc_column][/vc_row]',
				),
				'tabs_left' => array(
					'title' => esc_html__( 'Tabs Aligned', 'engage' ),
					'desc' => esc_html__( 'Tabs aligned left.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Switchable', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1493993344324{padding-top: 60px !important;padding-bottom: 20px !important;background-color: #ffffff !important;}"][vc_column col_padding_side="right" css=".vc_custom_1493057150253{padding-bottom: 15px !important;}"][vc_tta_tabs style="engage_outline" active_section="1" css=".vc_custom_1493993473265{padding-top: 30px !important;}"][vc_tta_section title="Our Goal" tab_id="1493993190218-196a605e-727b"][vc_row_inner][vc_column_inner width="1/2"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo.agittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis. Maecenas tincidunt nibh a velit dapibus gravida. Aliquam nisi enim, viverra eu nulla sed, fermentum volutpat dui. Nulla sollicitudin lorem quis.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis. Maecenas tincidunt nibh a velit dapibus gravida. Aliquam nisi enim, viverra eu nulla sed, fermentum volutpat dui. Nulla sollicitudin lorem quis.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_tta_section][vc_tta_section title="Our Methods" tab_id="1493993190806-9d610dc4-3b3c"][vc_row_inner][vc_column_inner width="1/2"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis. Maecenas tincidunt nibh a velit dapibus gravida. Aliquam nisi enim, viverra eu nulla sed, fermentum volutpat dui. Nulla sollicitudin lorem quis.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]Phasellus mattis efficitur sollicitudin. Aliquam nisi enim, viverra eu nulla sed, fermentum volutpat dui. Proin nec dui congue neque cursus ullamcorper. Sed ipsum risus, ultrices a posuere ac, molestie sed tortor. Aenean gravida enim velit, ut auctor eros porttitor in. Phasellus consectetur a est dictum aliquet. Nulla et neque efficitur, auctor purus vel, ornare tellus. Aenean non tellus elementum purus feugiat ullamcorper a ut urna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam fermentum tristique ante.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_tta_section][vc_tta_section title="Our Results" tab_id="1493993191420-fb42ce34-d873"][vc_row_inner][vc_column_inner width="1/3"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row]',
				),
				'tabs_minimal' => array(
					'title' => esc_html__( 'Tabs Centered 1', 'engage' ),
					'desc' => esc_html__( 'Minimalistic centered tabs.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Switchable', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1493993344324{padding-top: 60px !important;padding-bottom: 20px !important;background-color: #ffffff !important;}"][vc_column col_padding_side="right" css=".vc_custom_1493057150253{padding-bottom: 15px !important;}"][vc_tta_tabs style="engage_minimal" alignment="center" active_section="1" css=".vc_custom_1493993515857{padding-top: 30px !important;}"][vc_tta_section title="Our Goal" tab_id="1493993485970-ad7afcba-6bee"][vc_row_inner][vc_column_inner width="1/2"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis. Maecenas tincidunt nibh a velit dapibus gravida. Aliquam nisi enim, viverra eu nulla sed, fermentum volutpat dui. Nulla sollicitudin lorem quis.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis. Maecenas tincidunt nibh a velit dapibus gravida. Aliquam nisi enim, viverra eu nulla sed, fermentum volutpat dui. Nulla sollicitudin lorem quis.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_tta_section][vc_tta_section title="Our Methods" tab_id="1493993486815-2e178a9e-da9a"][vc_row_inner][vc_column_inner width="1/2"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis. Maecenas tincidunt nibh a velit dapibus gravida. Aliquam nisi enim, viverra eu nulla sed, fermentum volutpat dui. Nulla sollicitudin lorem quis.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]Phasellus mattis efficitur sollicitudin. Aliquam nisi enim, viverra eu nulla sed, fermentum volutpat dui. Proin nec dui congue neque cursus ullamcorper. Sed ipsum risus, ultrices a posuere ac, molestie sed tortor. Aenean gravida enim velit, ut auctor eros porttitor in. Phasellus consectetur a est dictum aliquet. Nulla et neque efficitur, auctor purus vel, ornare tellus. Aenean non tellus elementum purus feugiat ullamcorper a ut urna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam fermentum tristique ante.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_tta_section][vc_tta_section title="Our Results" tab_id="1493993487697-16414874-0af5"][vc_row_inner][vc_column_inner width="1/3"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row]',
				),
				'tabs_boxed' => array(
					'title' => esc_html__( 'Tabs Centered 2', 'engage' ),
					'desc' => esc_html__( 'Boxed centered tabs.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Switchable', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1493993344324{padding-top: 60px !important;padding-bottom: 20px !important;background-color: #ffffff !important;}"][vc_column col_padding_side="right" css=".vc_custom_1493057150253{padding-bottom: 15px !important;}"][vc_tta_tabs style="engage_boxed" alignment="center" active_section="1" css=".vc_custom_1493993219194{padding-top: 30px !important;}"][vc_tta_section title="Our Goal" tab_id="1493993374428-f20ac2e4-09e0"][vc_row_inner][vc_column_inner width="1/2"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis. Maecenas tincidunt nibh a velit dapibus gravida. Aliquam nisi enim, viverra eu nulla sed, fermentum volutpat dui. Nulla sollicitudin lorem quis.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis. Maecenas tincidunt nibh a velit dapibus gravida. Aliquam nisi enim, viverra eu nulla sed, fermentum volutpat dui. Nulla sollicitudin lorem quis.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_tta_section][vc_tta_section title="Our Methods" tab_id="1493993375240-ab8ae6ec-c461"][vc_row_inner][vc_column_inner width="1/2"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis. Maecenas tincidunt nibh a velit dapibus gravida. Aliquam nisi enim, viverra eu nulla sed, fermentum volutpat dui. Nulla sollicitudin lorem quis.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]Phasellus mattis efficitur sollicitudin. Aliquam nisi enim, viverra eu nulla sed, fermentum volutpat dui. Proin nec dui congue neque cursus ullamcorper. Sed ipsum risus, ultrices a posuere ac, molestie sed tortor. Aenean gravida enim velit, ut auctor eros porttitor in. Phasellus consectetur a est dictum aliquet. Nulla et neque efficitur, auctor purus vel, ornare tellus. Aenean non tellus elementum purus feugiat ullamcorper a ut urna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam fermentum tristique ante.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_tta_section][vc_tta_section title="Our Results" tab_id="1493993376107-58a3deec-2171"][vc_row_inner][vc_column_inner width="1/3"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices nisl diam, vitae consequat massa lacinia consequat. Nullam cursus risus a sem pretium lacinia. Etiam facilisis laoreet justo. Morbi mattis, turpis quis volutpat fermentum, lacus ante sagittis eros, vitae imperdiet leo felis ut ligula. Nulla sollicitudin lorem quis tempor mattis.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row]',
				),
				'contact_text_map' => array(
					'title' => esc_html__( 'Contact Details + Map', 'engage' ),
					'desc' => esc_html__( 'Contact details with a map.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Contact', 'engage' ) ),
					'sc' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1493997533098{padding-top: 85px !important;padding-bottom: 85px !important;}"][vc_column width="1/2" col_padding="2" col_padding_side="right" css=".vc_custom_1493997470153{padding-top: 20px !important;}"][vc_column_text]
					<h3>Contact Information</h3>
					I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_column_text css=".vc_custom_1493997380291{margin-bottom: 18px !important;}"]Our contact details:[/vc_column_text][engage_contact_form][/vc_column][/vc_row]',
				),
				'contact_text_map_f' => array(
					'title' => esc_html__( 'Contact Details + Map', 'engage' ),
					'desc' => esc_html__( 'Contact details with a map, fullwidth.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Contact', 'engage' ) ),
					'sc' => '[vc_row full_width="stretch_row_content_no_spaces" equal_height="yes" content_placement="middle" css=".vc_custom_1493997595807{padding-top: 0px !important;padding-bottom: 0px !important;}"][vc_column width="1/2" col_padding="7" css=".vc_custom_1493997669608{padding-top: 30px !important;}"][vc_column_text]
					<h3>Contact Information</h3>
					I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_column_text css=".vc_custom_1493997380291{margin-bottom: 18px !important;}"]Our contact details:[/vc_column_text][engage_contact_form][/vc_column][vc_column width="1/2" col_padding="2" col_padding_side="left"][vntd_gmap height="720" map_style="light" markers="%5B%7B%22title%22%3A%22Map%20Marker%22%2C%22text%22%3A%22This%20is%20an%20example%20marker%20description.%22%2C%22color%22%3A%22indigo%22%2C%22location%22%3A%22center%22%2C%22location_custom%22%3A%2240.7302327%2C-74.0100041%22%7D%5D"][/vc_column][/vc_row]',
				),
				'contact_form_text' => array(
					'title' => esc_html__( 'Contact Form + Details', 'engage' ),
					'desc' => esc_html__( 'Contact form with text details.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Contact', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1493998472841{padding-top: 75px !important;padding-bottom: 40px !important;}"][vc_column width="2/3" col_padding="2" col_padding_side="right"][vc_column_text css=".vc_custom_1493998522496{margin-bottom: 35px !important;}"]
					<h3>Contact Form</h3>
					[/vc_column_text][engage_contact_form][/vc_column][vc_column width="1/3" col_padding="2" col_padding_side="left"][vc_column_text]
					<h3>Contact Information</h3>
					I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_column_text css=".vc_custom_1493997380291{margin-bottom: 18px !important;}"]Our contact details:[/vc_column_text][vntd_icon_list icons_color="accent" elements="%5B%7B%22icon_fontawesome%22%3A%22fa%20fa-map-o%22%2C%22text%22%3A%22Manchester%20St%20123-78B%2C%20Random%20713%2C%20UK%22%7D%2C%7B%22icon_fontawesome%22%3A%22fa%20fa-phone%22%2C%22text%22%3A%22%2B46%20123%20456%20789%22%7D%2C%7B%22icon_fontawesome%22%3A%22fa%20fa-headphones%22%2C%22text%22%3A%22%2B37%20431%20456%20789%22%7D%2C%7B%22icon_fontawesome%22%3A%22fa%20fa-envelope-o%22%2C%22text%22%3A%22hello%40sitename.com%22%7D%5D" border="off"][/vc_column][/vc_row]',
				),
				'contact_form_c' => array(
					'title' => esc_html__( 'Contact Form Centered', 'engage' ),
					'desc' => esc_html__( 'Centered contact form.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Contact', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1493998472841{padding-top: 75px !important;padding-bottom: 40px !important;}"][vc_column width="1/6"][/vc_column][vc_column width="2/3" col_padding="2" col_padding_side="left"][special_heading title="Contact us" subtitle="Drop us an e-mail using the form below." add_icon="true" icon_type="linecons" icon_linecons="vc_li vc_li-paperplane"][engage_contact_form btn_align="center"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]',
				),
				'map_f_light' => array(
					'title' => esc_html__( 'Map Fullwidth Light', 'engage' ),
					'desc' => esc_html__( 'Fullwidth Google Map, light.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Contact', 'engage' ) ),
					'sc' => '[vc_row full_width="stretch_row_content_no_spaces"][vc_column][vntd_gmap height="540" map_style="light" markers="%5B%7B%22title%22%3A%22Map%20Marker%22%2C%22text%22%3A%22This%20is%20an%20example%20marker%20description.%22%2C%22color%22%3A%22indigo%22%2C%22location%22%3A%22center%22%2C%22location_custom%22%3A%2241.863774%2C-87.721328%22%7D%5D" marker1_color="teal" marker2_title="Secondary Marker"][/vc_column][/vc_row]',
				),
				'map_f_dark' => array(
					'title' => esc_html__( 'Map Fullwidth Dark', 'engage' ),
					'desc' => esc_html__( 'Fullwidth Google Map, dark.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Contact', 'engage' ) ),
					'sc' => '[vc_row full_width="stretch_row_content_no_spaces"][vc_column][vntd_gmap height="540" map_style="dark" markers="%5B%7B%22title%22%3A%22Map%20Marker%22%2C%22text%22%3A%22This%20is%20an%20example%20marker%20description.%22%2C%22color%22%3A%22orange%22%2C%22location%22%3A%22center%22%2C%22location_custom%22%3A%2241.863774%2C-87.721328%22%7D%5D" marker1_color="teal" marker2_title="Secondary Marker"][/vc_column][/vc_row]',
				),
				'prices_gray_3' => array(
					'title' => esc_html__( 'Prices Gray 3 Cols', 'engage' ),
					'desc' => esc_html__( 'Three columns of pricing boxes.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Prices', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1494253443261{padding-top: 80px !important;padding-bottom: 62px !important;}"][vc_column][special_heading title="Our Prices" subtitle="And here goes a super fancy description of the section." c_margin_bottom="55px"][vc_row_inner css=".vc_custom_1494253419308{padding-top: 10px !important;}"][vc_column_inner width="1/3"][pricing_box title="Simple" price="$39" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!" style="minimal"][/vc_column_inner][vc_column_inner width="1/3"][pricing_box title="Classic" price="$49" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!" featured="yes"][/vc_column_inner][vc_column_inner width="1/3"][pricing_box title="Premium" price="$69" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!" style="minimal"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'prices_gray_4' => array(
					'title' => esc_html__( 'Prices Gray 4 Cols', 'engage' ),
					'desc' => esc_html__( 'Four columns of pricing boxes.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Prices', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1494253443261{padding-top: 80px !important;padding-bottom: 62px !important;}"][vc_column][special_heading title="Our Prices" subtitle="And here goes a super fancy description of the section." c_margin_bottom="55px"][vc_row_inner css=".vc_custom_1494253419308{padding-top: 10px !important;}"][vc_column_inner width="1/4"][pricing_box title="Minimal" price="$29" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!"][/vc_column_inner][vc_column_inner width="1/4"][pricing_box title="Simple" price="$44" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!"][/vc_column_inner][vc_column_inner width="1/4"][pricing_box title="Classic" price="$49" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!" featured="yes"][/vc_column_inner][vc_column_inner width="1/4"][pricing_box title="Premium" price="$69" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!" style="minimal"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'prices_3' => array(
					'title' => esc_html__( 'Prices Light 3 Cols', 'engage' ),
					'desc' => esc_html__( 'Three columns of white pricing boxes.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Prices', 'engage' ) ),
					'sc' => '[vc_row bg_color_pre="bg-color-1" css=".vc_custom_1494257863978{padding-top: 80px !important;padding-bottom: 62px !important;}"][vc_column][special_heading title="Our Prices" subtitle="And here goes a super fancy description of the section." c_margin_bottom="55px"][vc_row_inner css=".vc_custom_1494253419308{padding-top: 10px !important;}"][vc_column_inner width="1/3"][pricing_box title="Simple" price="$39" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!" add_icon="true" icon_fontawesome="fa fa-angle-right" bg="white"][/vc_column_inner][vc_column_inner width="1/3"][pricing_box title="Classic" price="$49" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!" add_icon="true" icon_fontawesome="fa fa-angle-right" featured="yes" bg="white"][/vc_column_inner][vc_column_inner width="1/3"][pricing_box title="Premium" price="$69" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!" add_icon="true" icon_fontawesome="fa fa-angle-right" bg="white"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'prices_3_img' => array(
					'title' => esc_html__( 'Prices 3 Cols Image', 'engage' ),
					'desc' => esc_html__( 'Pricing boxes on image background.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Prices', 'engage' ) ),
					'sc' => '[vc_row parallax="content-moving" color_scheme="white" bg_overlay="dark30" css=".vc_custom_1494257847327{padding-top: 90px !important;padding-bottom: 72px !important;background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-14.jpg) !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][special_heading title="Our Prices" subtitle="And here goes a super fancy description of the section." c_margin_bottom="55px"][vc_row_inner css=".vc_custom_1494253419308{padding-top: 10px !important;}"][vc_column_inner width="1/3"][pricing_box title="Simple" price="$39" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!" add_icon="true" icon_fontawesome="fa fa-angle-right" bg="transparent_dark"][/vc_column_inner][vc_column_inner width="1/3"][pricing_box title="Classic" price="$49" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!" add_icon="true" icon_fontawesome="fa fa-angle-right" featured="yes" bg="transparent_dark"][/vc_column_inner][vc_column_inner width="1/3"][pricing_box title="Premium" price="$69" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!" add_icon="true" icon_fontawesome="fa fa-angle-right" bg="transparent_dark"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'prices_gd' => array(
					'title' => esc_html__( 'Prices 3 Cols Gradient', 'engage' ),
					'desc' => esc_html__( 'Pricing boxes on gradient background.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Prices', 'engage' ) ),
					'sc' => '[vc_row parallax="content-moving" color_scheme="white" bg_gradient1="#b06ab3" bg_gradient2="#4568dc" css=".vc_custom_1494257955511{padding-top: 90px !important;padding-bottom: 72px !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][special_heading title="Our Prices" subtitle="And here goes a super fancy description of the section." c_margin_bottom="55px"][vc_row_inner css=".vc_custom_1494253419308{padding-top: 10px !important;}"][vc_column_inner width="1/3"][pricing_box title="Simple" price="$39" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!" add_icon="true" icon_fontawesome="fa fa-angle-right" bg="transparent_light"][/vc_column_inner][vc_column_inner width="1/3"][pricing_box title="Classic" price="$49" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!" add_icon="true" icon_fontawesome="fa fa-angle-right" featured="yes" bg="transparent_light"][/vc_column_inner][vc_column_inner width="1/3"][pricing_box title="Premium" price="$69" features="Awesome feature.,Incredible support.,Another stuff.,Free bonus!" add_icon="true" icon_fontawesome="fa fa-angle-right" bg="transparent_light"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'prices_3x3_border' => array(
					'title' => esc_html__( 'Prices Plain 1', 'engage' ),
					'desc' => esc_html__( 'Simple price grid.', 'engage' ),
					'cat' => array( esc_html__( 'Prices', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1495542037394{padding-top: 60px !important;padding-bottom: 30px !important;}"][vc_column][special_heading title="Our Prices" subtitle="List of our great services along with prices." c_margin_bottom="60px"][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/3"][price_heading title="Great Service" label="$15" border="yes"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="Beef Delicious" label="$12" border="yes"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="Short Cut" label="$24" border="yes" label_fw="normal"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/3"][price_heading title="Quick Dig" label="$13" border="yes"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="King Size" label="$29" border="yes"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="Enormous Bite" label="$32" border="yes" label_fw="normal" label_color="dark-grey"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/3"][price_heading title="Short Stuff" label="$9" border="yes"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="Premium Type" label="$36" border="yes"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="Luxurious Offer" label="$52" border="yes" label_fw="normal" label_color="dark-grey"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'prices_3x3_accent' => array(
					'title' => esc_html__( 'Prices Plain Accent', 'engage' ),
					'desc' => esc_html__( 'Simple price grid, accent label.', 'engage' ),
					'cat' => array( esc_html__( 'Prices', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1495542037394{padding-top: 60px !important;padding-bottom: 30px !important;}"][vc_column][special_heading title="Our Prices" subtitle="List of our great services along with prices." c_margin_bottom="60px"][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/3"][price_heading title="Great Service" label="$15" border="yes" label_color="accent"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="Beef Delicious" label="$12" border="yes" label_color="accent"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="Short Cut" label="$24" border="yes" label_fw="normal" label_color="accent"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/3"][price_heading title="Quick Dig" label="$13" border="yes" label_color="accent"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="King Size" label="$29" border="yes" label_color="accent"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="Enormous Bite" label="$32" border="yes" label_fw="normal" label_color="accent"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/3"][price_heading title="Short Stuff" label="$9" border="yes" label_color="accent"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="Premium Type" label="$36" border="yes" label_color="accent"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="Luxurious Offer" label="$52" border="yes" label_fw="normal" label_color="accent"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'prices_3x3' => array(
					'title' => esc_html__( 'Prices Plain No Border', 'engage' ),
					'desc' => esc_html__( 'Simple price grid, no border.', 'engage' ),
					'cat' => array( esc_html__( 'Prices', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1495542037394{padding-top: 60px !important;padding-bottom: 30px !important;}"][vc_column][special_heading title="Our Services" subtitle="List of our great services along with prices." c_margin_bottom="60px"][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/3"][price_heading title="Great Service" label="$15"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scale.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="Beef Delicious" label="$12"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scale.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="Short Cut" label="$24" label_fw="normal"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scale.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/3"][price_heading title="Quick Dig" label="$13"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scale.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="King Size" label="$29"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scale.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="Enormous Bite" label="$32" label_fw="normal"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scale.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1493381079225{padding-bottom: 30px !important;}"][vc_column_inner width="1/3"][price_heading title="Short Stuff" label="$9"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scale.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="Premium Type" label="$36"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scale.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][price_heading title="Luxurious Offer" label="$52" label_fw="normal"][vc_column_text]Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scale.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'testimo_center_light' => array(
					'title' => esc_html__( 'Testimonials Center Light', 'engage' ),
					'desc' => esc_html__( 'Centered testimonials, light version.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Clients', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1494262026330{padding-top: 100px !important;padding-bottom: 75px !important;}"][vc_column][vc_icon type="linecons" icon_linecons="vc_li vc_li-bubble" color="vista_blue" size="lg" align="center"][vntd_testimonials posts_nr="5" bullet_nav="" arrow_nav="true"][/vc_column][/vc_row]',
				),
				'testimo_center_accent' => array(
					'title' => esc_html__( 'Testimonials Center Accent', 'engage' ),
					'desc' => esc_html__( 'Centered testimonials, accent background.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Clients', 'engage' ) ),
					'sc' => '[vc_row color_scheme="white" bg_color_pre="bg-color-accent" css=".vc_custom_1494262034487{padding-top: 100px !important;padding-bottom: 75px !important;}"][vc_column][vc_icon type="linecons" icon_linecons="vc_li vc_li-bubble" color="white" size="lg" align="center"][vntd_testimonials posts_nr="5" bullet_nav="" arrow_nav="true"][/vc_column][/vc_row]',
				),
				'testimo_center_accent' => array(
					'title' => esc_html__( 'Testimonials Center Accent', 'engage' ),
					'desc' => esc_html__( 'Centered testimonials, accent background.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Clients', 'engage' ) ),
					'sc' => '[vc_row color_scheme="white" bg_color_pre="bg-color-accent" css=".vc_custom_1494262034487{padding-top: 100px !important;padding-bottom: 75px !important;}"][vc_column][vc_icon type="linecons" icon_linecons="vc_li vc_li-bubble" color="white" size="lg" align="center"][vntd_testimonials posts_nr="5" bullet_nav="" arrow_nav="true"][/vc_column][/vc_row]',
				),
				'testimo_center_img' => array(
					'title' => esc_html__( 'Testimonials Center Image', 'engage' ),
					'desc' => esc_html__( 'Centered testimonials, image background.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Clients', 'engage' ) ),
					'sc' => '[vc_row parallax="content-moving" color_scheme="white" bg_overlay="dark30" css=".vc_custom_1494262415344{padding-top: 100px !important;padding-bottom: 75px !important;background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-18.jpg) !important;}"][vc_column][vc_icon type="linecons" icon_linecons="vc_li vc_li-bubble" color="white" size="lg" align="center"][vntd_testimonials posts_nr="5" bullet_nav="" arrow_nav="true"][/vc_column][/vc_row]',
				),
				'testimo_light' => array(
					'title' => esc_html__( 'Testimonials Light', 'engage' ),
					'desc' => esc_html__( 'Testimonials, light version.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Clients', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1494262501239{padding-top: 80px !important;padding-bottom: 75px !important;}"][vc_column][special_heading title="Testimonials" subtitle="What our awesome clients say about us." c_margin_bottom="55px"][vntd_testimonials style="simple" cols="3" posts_nr="5"][/vc_column][/vc_row]',
				),
				'testimo_accent_img' => array(
					'title' => esc_html__( 'Testimonials Accent Image', 'engage' ),
					'desc' => esc_html__( 'Testimonials, accent image background.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Clients', 'engage' ) ),
					'sc' => '[vc_row color_scheme="white" bg_overlay="accent" css=".vc_custom_1494262668971{padding-top: 90px !important;padding-bottom: 75px !important;background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-18.jpg) !important;}"][vc_column][special_heading title="Testimonials" subtitle="What our awesome clients say about us." c_margin_bottom="55px"][vntd_testimonials style="simple" bg="white" cols="3" posts_nr="5"][/vc_column][/vc_row]',
				),
				'testimo_img' => array(
					'title' => esc_html__( 'Testimonials Image', 'engage' ),
					'desc' => esc_html__( 'Testimonials, image background.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Clients', 'engage' ) ),
					//'info' => 'This sections uses custom post types. Make sure that you have some testimonials created under <a href="#" target="_blank">Testimonials</a> menu.',
					'sc' => '[vc_row color_scheme="white" bg_color_pre="bg-color-accent" bg_overlay="dark40" css=".vc_custom_1494262647231{padding-top: 90px !important;padding-bottom: 75px !important;background-image: url(http://media.veented.com/wp-content/uploads/2017/09/full-14.jpg) !important;}"][vc_column][special_heading title="Testimonials" subtitle="What our awesome clients say about us." c_margin_bottom="55px"][vntd_testimonials style="simple" bg="transparent" cols="2" posts_nr="5"][/vc_column][/vc_row]',
				),
				'team_boxed_desc' => array(
					'title' => esc_html__( 'Team Members Description', 'engage' ),
					'desc' => esc_html__( 'Team Members with a description.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), 'Team Members' ),
					'sc' => '[vc_row bg_color_pre="bg-color-1" css=".vc_custom_1495446959270{padding-top: 75px !important;padding-bottom: 60px !important;}"][vc_column][special_heading title="Our Team" subtitle="Learn more about our fantastic team!" c_margin_bottom="60px"][vc_row_inner][vc_column_inner width="1/3"][vntd_person name="John Doe" position="Web Designer" img="https://s3.us-east-2.amazonaws.com/engage.veented.com/img/team/man-5.jpg" bio="Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae aliquet consequat. Aliquam ullamcorper accumsan lectus, a tempor turpis interdum sed. Donec ac faucibus nunc." style="classic" boxed="boxed-border" twitter="#" facebook="#"][/vc_column_inner][vc_column_inner width="1/3"][vntd_person name="Alice Doen" position="Web Developer" img="https://s3.us-east-2.amazonaws.com/engage.veented.com/img/team/woman-4.jpg" bio="Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae aliquet consequat. Aliquam ullamcorper accumsan lectus, a tempor turpis interdum sed. Donec ac faucibus nunc." style="classic" boxed="boxed-border" twitter="#" facebook="#"][/vc_column_inner][vc_column_inner width="1/3"][vntd_person name="Katie Holmes" position="Designer" img="https://s3.us-east-2.amazonaws.com/engage.veented.com/img/team/woman-5.jpg" bio="Ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies nisi at scelerisque pellentesque. Nunc feugiat felis vitae aliquet consequat. Aliquam ullamcorper accumsan lectus, a tempor turpis interdum sed. Donec ac faucibus nunc." style="classic" boxed="boxed-border" twitter="#" facebook="#"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'team_boxed' => array(
					'title' => esc_html__( 'Team Members Boxed', 'engage' ),
					'desc' => esc_html__( 'Team Members boxed version.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), 'Team Members' ),
					'sc' => '[vc_row bg_color_pre="bg-color-1" css=".vc_custom_1495447264274{padding-top: 75px !important;padding-bottom: 40px !important;}"][vc_column][special_heading title="Our Team" subtitle="Learn more about our fantastic team!" c_margin_bottom="60px"][vc_row_inner css=".vc_custom_1495447259772{padding-bottom: 20px !important;}"][vc_column_inner width="1/4"][vntd_person name="John Doe" position="Web Designer" img="https://s3.us-east-2.amazonaws.com/engage.veented.com/img/team/man-5.jpg" boxed="boxed-solid" twitter="#" facebook="#"][/vc_column_inner][vc_column_inner width="1/4"][vntd_person name="Alice Doen" position="Web Developer" img="https://s3.us-east-2.amazonaws.com/engage.veented.com/img/team/woman-4.jpg" boxed="boxed-solid" twitter="#" facebook="#"][/vc_column_inner][vc_column_inner width="1/4"][vntd_person name="Bernard Smith" position="Designer" img="https://s3.us-east-2.amazonaws.com/engage.veented.com/img/team/man-4.jpg" boxed="boxed-solid" twitter="#" facebook="#"][/vc_column_inner][vc_column_inner width="1/4"][vntd_person name="Katie Holmes" position="Designer" img="https://s3.us-east-2.amazonaws.com/engage.veented.com/img/team/woman-5.jpg" boxed="boxed-solid" twitter="#" facebook="#"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'team_min' => array(
					'title' => esc_html__( 'Team Members Minimal', 'engage' ),
					'desc' => esc_html__( 'Team Members boxed minimal version.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), 'Team Members' ),
					'sc' => '[vc_row css=".vc_custom_1495446935969{padding-top: 75px !important;padding-bottom: 30px !important;}"][vc_column][special_heading title="Our Team" subtitle="Learn more about our fantastic team!" c_margin_bottom="60px"][vc_row_inner][vc_column_inner width="1/3"][vntd_person name="John Doe" position="Web Designer" img="https://s3.us-east-2.amazonaws.com/engage.veented.com/img/team/man-5.jpg" twitter="#" facebook="#"][/vc_column_inner][vc_column_inner width="1/3"][vntd_person name="Alice Doen" position="Web Developer" img="https://s3.us-east-2.amazonaws.com/engage.veented.com/img/team/woman-4.jpg" twitter="#" facebook="#"][/vc_column_inner][vc_column_inner width="1/3"][vntd_person name="Katie Holmes" position="Designer" img="https://s3.us-east-2.amazonaws.com/engage.veented.com/img/team/woman-5.jpg" twitter="#" facebook="#"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'team_1x4_min' => array(
					'title' => esc_html__( 'Team Members Minimal 2', 'engage' ),
					'desc' => esc_html__( 'Team Members minimal version.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), 'Team Members' ),
					'sc' => '[vc_row bg_color_pre="bg-color-1" css=".vc_custom_1495447264274{padding-top: 75px !important;padding-bottom: 40px !important;}"][vc_column][special_heading title="Our Team" subtitle="Learn more about our fantastic team!" c_margin_bottom="60px"][vc_row_inner css=".vc_custom_1495447259772{padding-bottom: 20px !important;}"][vc_column_inner width="1/4"][vntd_person name="John Doe" position="Web Designer" img="https://s3.us-east-2.amazonaws.com/engage.veented.com/img/team/man-5.jpg" boxed="boxed-solid" twitter="#" facebook="#"][/vc_column_inner][vc_column_inner width="1/4"][vntd_person name="Alice Doen" position="Web Developer" img="https://s3.us-east-2.amazonaws.com/engage.veented.com/img/team/woman-4.jpg" boxed="boxed-solid" twitter="#" facebook="#"][/vc_column_inner][vc_column_inner width="1/4"][vntd_person name="Bernard Smith" position="Designer" img="https://s3.us-east-2.amazonaws.com/engage.veented.com/img/team/man-4.jpg" boxed="boxed-solid" twitter="#" facebook="#"][/vc_column_inner][vc_column_inner width="1/4"][vntd_person name="Katie Holmes" position="Designer" img="https://s3.us-east-2.amazonaws.com/engage.veented.com/img/team/woman-5.jpg" boxed="boxed-solid" twitter="#" facebook="#"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
				),
				'blog_border' => array(
					'title' => esc_html__( 'Blog Carousel 1', 'engage' ),
					'desc' => esc_html__( 'Blog carousel with dots navigation.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Carousel', 'engage' ) ),
					'sc' => '[vc_row css=".vc_custom_1494328488142{padding-top: 65px !important;padding-bottom: 70px !important;}"][vc_column][special_heading title="Latest News" c_margin_bottom="60px"][blog_carousel][/vc_column][/vc_row]',
				),
				'blog_btn' => array(
					'title' => esc_html__( 'Blog Carousel 2', 'engage' ),
					'desc' => esc_html__( 'Blog carousel with a button.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Carousel', 'engage' ) ),
					'sc' => '[vc_row bg_color_pre="bg-color-1" css=".vc_custom_1494328557833{padding-top: 65px !important;padding-bottom: 70px !important;}"][vc_column][special_heading title="Latest News" c_margin_bottom="55px"][blog_carousel style="boxed_solid" bullet_nav="" autoplay_timeout="8000"][vntd_button label="Visit our Blog" align="center" icon_enabled="yes" icon_fontawesome="fa fa-long-arrow-right" icon_style="right_side" margin_top="55px"][/vc_column][/vc_row]',
				),
				'blog_no_img' => array(
					'title' => esc_html__( 'Blog Carousel 3', 'engage' ),
					'desc' => esc_html__( 'Blog carousel without image.', 'engage' ),
					'cat' => array( esc_html__( 'Content', 'engage' ), esc_html__( 'Carousel', 'engage' ) ),
					'sc' => '[vc_row bg_color_pre="bg-color-1" css=".vc_custom_1494328557833{padding-top: 65px !important;padding-bottom: 70px !important;}"][vc_column][special_heading title="Latest News" c_margin_bottom="55px"][blog_carousel style="boxed_solid" thumb="disable" bullet_nav="" autoplay_timeout="8000"][vntd_button label="Visit our Blog" align="center" icon_enabled="yes" icon_fontawesome="fa fa-long-arrow-right" icon_style="right_side" margin_top="55px"][/vc_column][/vc_row]',
				),
			);

			$templates_output = '';
			$lib_path = 'assets/img/';
			$categories = array();
			$templates_count = 0;

			foreach( $templates as $template_id => $template ) {

				$img_path = plugins_url( $lib_path . $template_id . '_t.jpg', __FILE__ );
				$img_preview_path = plugins_url( 'assets/img-full/' . $template_id . '.jpg', __FILE__ );

				$cats = '';

				foreach ( $template['cat'] as $cat ) {
					if ( $cat == esc_html__( 'Content', 'engage' ) ) continue;
					$slug = strtolower( str_replace( '/', '_', str_replace( '+', '_', str_replace( ' ', '', $cat ) ) ) );
					$cats .= ' cat-' . $slug;
					if ( array_key_exists( $cat, $categories ) ) {
						$categories[ $cat ][ 'count' ] = $categories[ $cat ][ 'count' ] = $categories[ $cat ][ 'count' ] + 1;
					} else { // New cat
						$categories[ $cat ] = array(
							'slug' => $slug,
							'count' => 1
						);
					}

				}

				$templates_output .= '<li class="vntd-template' . esc_html( $cats ) . '" id="' . esc_attr( $template_id ) . '"><div class="vntd-template-inner">';
				$templates_output .= '<div class="vntd-template-img" data-preview-img="' . $img_preview_path . '"><img src="" data-img-src="' . $img_path . '" alt><span class="template-preview-btn"><i class="fa fa-search"></i></span></div>';
				$templates_output .= '<div class="vntd-template-text"><h5>' . esc_html( $template['title'] ) . '</h5>';
				if ( array_key_exists( 'desc', $template ) ) $templates_output .= '<p class="template-desc">' . esc_html( $template['desc'] ) . '</p>';
				if ( array_key_exists( 'info', $template ) ) $templates_output .= '<p class="template-info">' . $template['info'] . '</p>';
				$templates_output .= '<button class="vntd-load-template">' . esc_html__( 'Load template', 'engage' ) . '</button></div><span class="hidden vntd-template-sc">' . $template['sc'] . '</span></div></li>';
				$templates_count++;
			}

			$category['output'] .= '<div id="vntd-templates" class="vntd-templates"><div id="vntd-templates-main"><div class="vntd-templates-main-header"><h3>' . esc_html__( 'Engage Templates', 'engage' ) . '</h3><p>' . esc_html__( 'Save your time with Engage Templates! This is where you may load predefined, perfectly styled sections directly to your page.', 'engage' ) . '</p></div>';

			// Filtering menu

			$filtering_menu = '<div id="vntd-templates-filter" class="vntd-templates-filter"><ul>';


			$filtering_menu .= '<li class="show-all vntd-active"><button data-filter="all">' . esc_html__( 'Show All', 'engage' ) . ' <span>' . esc_html( $templates_count ) . '</span></button></li>';

			$filters = array( esc_html__( 'Content', 'engage' ), esc_html__( 'Icon Boxes', 'engage' ) );

			foreach ( $categories as $name => $cat ) {
				$filtering_menu .= '<li><button data-filter="' . esc_html( $cat[ 'slug' ] ) . '">' . esc_html( $name ) . '<span>' . esc_html( $cat[ 'count' ] ) . '</span></a></li>';
			}

			$filtering_menu .= '</ul></div>';

			$category['output'] .= $filtering_menu;

			$category['output'] .= '<div class="vntd-templates-list-holder"><ul class="vntd-templates-list">';

			$category['output'] .= $templates_output;

			$category['output'] .= '</ul><div class="clear"></div></div></div>'; // End #vntd-templates-main

			// Preview

			$template_preview = '<div id="vntd-template-preview" class="vntd-template-preview" data-template-id=""><div class="vntd-preview-header"><span class="vntd-preview-back"><i class="fa fa-long-arrow-left"></i> ' . esc_html__( 'Back to templates', 'engage' ) . '</span><span class="vntd-template-close"><i class="fa fa-close"></i></span>';

			$template_preview .= '<div class="vntd-templates-nav"><div class="vntd-template-prev"><i class="fa fa-angle-left"></i></div><div class="vntd-template-next"><i class="fa fa-angle-right"></i></div></div>';

			$template_preview .= '</div>';

			$template_preview .= '<div class="vntd-preview-content"><h3 id="template-preview-title">' . esc_html__( 'Template Preview', 'engage' ) . '</h3><p id="template-preview-desc">' . esc_html__( 'Description', 'engage' ) . '</p><p id="template-preview-info"><strong>' . esc_html__( 'Note:', 'engage' ) . '</strong> <span></span></p><div class="template-preview-img"><img src="" id="template-preview-img"></div><button id="template-preview-load" class="load-from-preview">' . esc_html__( 'Load template', 'engage' ) . '</button>';

			$template_preview .= '</div>';

			$template_preview .= '</div>';

			$category['output'] .= $template_preview;

			$category['output'] .= '</div></div>';

  }

  return $category;
}
