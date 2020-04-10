<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @subpackage  Field_Color_Gradient
 * @author      Luciano "WebCaos" Ubertini
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @author      Kevin Provance (kprovance) - fixing everyone else's bugs.
 * @version     3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Don't duplicate me!
if ( ! class_exists( 'ReduxFramework_multi_field' ) ) {

    /**
     * Main ReduxFramework_link_color class
     *
     * @since       1.0.0
     */
    class ReduxFramework_multi_field {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct( $field = array(), $value = '', $parent ) {
            $this->parent 	= $parent;
            $this->field  	= $field;
            $this->value  	= $value;
            $this->unit 	= 'px';

            $fields = array(
            	'color' => array(
            		'type' => 'color',
            		'label' => esc_html__( 'Text Color', 'engage' ),
            		'output' => 'color'
            	),
            	'bg_color' => array(
            		'type' => 'color',
            		'label' => esc_html__( 'Background', 'engage' ),
            		'output' => 'background-color'
            	),
            	'border_color' => array(
            		'type' => 'color',
            		'label' => esc_html__( 'Border Color', 'engage' ),
            		'output' => 'border-color'
            	),
            	'border_width' => array(
            		'type' => 'pixel',
            		'label' => esc_html__( 'Border Width', 'engage' ),
            		'output' => 'border-width'
            	),
            	'border_radius' => array(
            		'type' => 'pixel',
            		'label' => esc_html__( 'Border Radius', 'engage' ),
            		'output' => 'border-radius'
            	),
            );

            $this->fields = $fields;

            $defaults = array(
                'bg_color' => true,
                'color'   => true,
                'border_radius' => true,
                'border_color'  => true,
                'border_width'  => true
            );
            $this->field = wp_parse_args( $this->field, $defaults );

            $defaults    = array(
                'bg_color' => '',
                'color'   => '',
                'border_radius' => '',
                'border_color'  => '',
                'border_width'  => ''
            );

            $this->value = wp_parse_args( $this->value, $defaults );

            // In case user passes no default values.
            if ( isset( $this->field['default'] ) ) {
                $this->field['default'] = wp_parse_args( $this->field['default'], $defaults );
            } else {
                $this->field['default'] = $defaults;
            }
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render() {

			foreach ( $this->fields as $field_name => $field_settings ) {

				if ( $this->field[ $field_name ] === true && $this->field['default']['bg_color'] !== false ) {

					echo '<div class="param-holder param-small">';
					echo '<label>' . esc_html( $field_settings[ 'label' ] ) . '</label>';

					if ( $field_settings[ 'type' ] == 'color' ) {

					    echo '<input id="' . $this->field['id'] . '-regular" name="' . $this->field['name'] . $this->field['name_suffix'] . '[' . $field_name . ']' . '" value="' . $this->value[ $field_name ] . '" class="redux-color redux-color-regular redux-color-init ' . $this->field['class'] . '"  type="text" data-default-color="' . $this->field['default'][ $field_name ] . '" />';

					} elseif( $field_settings[ 'type' ] == 'pixel' ) { // Textfield

						echo '<div class="input-append"><input type="text" class="span2 redux-typography redux-typography-height mini typography-input ' . $this->field['class'] . '" title="' . esc_html( $field_settings[ 'label' ] ) . '" id="' . $this->field['id'] . '-height" value="' . str_replace( $this->unit, '', $this->value[ $field_name ] ) . '" data-value="' . str_replace( $this->unit, '', $this->value[ $field_name ] ) . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[' . $field_name . ']' . '"><span class="add-on">' . $this->unit . '</span></div>';
					}

					echo '</div>';
				}

			}

        }

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {
            wp_enqueue_style( 'wp-color-picker' );

            wp_enqueue_script(
                'redux-field-multi-field-js',
                ENGAGE_CORE_URI . '/theme-panel/extensions/multi_field/multi_field/field_multi_field.js',
                array( 'jquery', 'wp-color-picker', 'redux-js' ),
                time(),
                true
            );

        }

        public function output() {

            $style = array();

			foreach ( $this->fields as $field_name => $field_settings ) {
				if ( ! empty( $this->value[ $field_name ] ) && $this->field[ $field_name ] === true && $this->field['default'][ $field_name ] !== false ) {
					$unit = '';
					if ( $field_settings[ 'type' ] == 'pixel' ) $unit = $this->unit;
				    $style[] = $field_settings[ 'output' ] . ':' . $this->value[ $field_name ] . $unit . ';';
				}
			}

            if ( ! empty( $style ) ) {
                if ( ! empty( $this->field['output'] ) && is_array( $this->field['output'] ) ) {
                    $styleString = "";

                    //$sel_list = rtrim($sel_list,',');
                    $styleString .= implode( '', $this->field['output'] ) . '{';

                    foreach ( $style as $key => $value ) {
                    	$styleString .=  $value;
                    }

                    $styleString .= '}';

                    $this->parent->outputCSS .= $styleString;
                }

                if ( ! empty( $this->field['compiler'] ) && is_array( $this->field['compiler'] ) ) {
                    $styleString = "";

                    foreach ( $style as $key => $value ) {
                        if ( is_numeric( $key ) ) {
                            $styleString .= implode( ",", $this->field['compiler'] ) . "{" . $value . '}';

                        } else {
                            if ( count( $this->field['compiler'] ) == 1 ) {
                                $styleString .= $this->field['compiler'][0] . ":" . $key . "{" . $value . '}';
                            } else {
                                $blah = '';
                                foreach($this->field['compiler'] as $k => $sel) {
                                    $blah .= $sel . ':' . $key . ',';
                                }

                                $blah = substr($blah, 0, strlen($blah) - 1);
                                $styleString .= $blah . '{' . $value . '}';
                            }
                        }
                    }
                    $this->parent->compilerCSS .= $styleString;
                }
            }
        }
    }
}
