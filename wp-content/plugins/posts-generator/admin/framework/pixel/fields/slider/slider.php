<?php
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.0
/**
 *
 * Class Field slider
 *
 * @since 1.0 2019-03-05  Release
 * @since 1.6 2019-12-02  New classes updated
 *
 */
if( ! class_exists( 'PF_Field_slider' ) ) {
  class PF_Field_slider extends PF_classFields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'max'  => 100,
        'min'  => 0,
        'step' => 1,
        'unit' => '',
      ) );

      $is_unit = ( ! empty( $args['unit'] ) ) ? ' pf--is-unit' : '';

      echo $this->field_before();

      echo '<div class="pf--wrap">';
      echo '<div class="pf-slider-ui"></div>';
      echo '<div class="pf--input">';
      echo '<input type="number" name="'. $this->field_name() .'" value="'. $this->value .'"'. $this->field_attributes( array( 'class' => 'pf-input-number'. $is_unit ) ) .' data-max="'. $args['max'] .'" data-min="'. $args['min'] .'" data-step="'. $args['step'] .'" />';
      echo ( ! empty( $args['unit'] ) ) ? '<span class="pf--unit">'. $args['unit'] .'</span>' : '';
      echo '</div>';
      echo '</div>';

      echo $this->field_after();

    }

    public function enqueue() {

      if( ! wp_script_is( 'jquery-ui-slider' ) ) {
        wp_enqueue_script( 'jquery-ui-slider' );
      }

    }

    public function output() {

      $output    = '';
      $elements  = ( is_array( $this->field['output'] ) ) ? $this->field['output'] : array_filter( (array) $this->field['output'] );
      $important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';
      $mode      = ( ! empty( $this->field['output_mode'] ) ) ? $this->field['output_mode'] : 'width';
      $unit      = ( ! empty( $this->field['unit'] ) ) ? $this->field['unit'] : 'px';

      if( ! empty( $elements ) && isset( $this->value ) && $this->value !== '' ) {
        foreach( $elements as $key_property => $element ) {
          if( is_numeric( $key_property ) ) {
            if( $mode ) {
              $output = implode( ',', $elements ) .'{'. $mode .':'. $this->value . $unit . $important .';}';
            }
            break;
          } else {
            $output .= $element .'{'. $key_property .':'. $this->value . $unit . $important .'}';
          }
        }
      }

      $this->parent->output_css .= $output;

      return $output;

    }

  }
}
