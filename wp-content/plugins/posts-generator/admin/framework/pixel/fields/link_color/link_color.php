<?php
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.0
/**
 *
 * Field Link Color
 *
 * @since 1.0 2019-03-04 16:42:21 Release
 *
 */
if( ! class_exists( 'PF_Field_link_color' ) ) {
class PF_Field_link_color extends PF_classFields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
        parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

        $args = wp_parse_args( $this->field, array(
            'color'   => true,
            'hover'   => true,
            'active'  => false,
            'visited' => false,
            'focus'   => false,
        ) );

        $default_values = array(
            'color'   => '',
            'hover'   => '',
            'active'  => '',
            'visited' => '',
            'focus'   => '',
        );

        $value = wp_parse_args( $this->value, $default_values );

        echo $this->field_before();

        foreach ( array( 'color', 'hover', 'active', 'visited', 'focus' ) as $prop ) {

            if( ! empty( $args[$prop] ) ) {

                $default_attr = ( ! empty( $this->field['default'][$prop] ) ) ? ' data-default-color="'. $this->field['default'][$prop] .'"' : '';

                echo '<div class="pf--left pf-field-color">';
                echo '<div class="pf--title">'. ucfirst( $prop ) .'</div>';
                echo '<input type="text" name="'. $this->field_name('['. $prop .']') .'" value="'. $value[$prop] .'" class="pf-color"'. $default_attr . $this->field_attributes() .'/>';
                echo '</div>';

            }

        }

        echo $this->field_after();

    }

    public function output() {

        $output    = '';
        $element   = ( is_array( $this->field['output'] ) ) ? join( ',', $this->field['output'] ) : $this->field['output'];
        $important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';

        if( isset( $this->value['color']   ) && $this->value['color']   !== '' ) { $output .= $element .'{color:'.         $this->value['color']   . $important .';}'; }
        if( isset( $this->value['hover']   ) && $this->value['hover']   !== '' ) { $output .= $element .':hover{color:'.   $this->value['hover']   . $important .';}'; }
        if( isset( $this->value['active']  ) && $this->value['active']  !== '' ) { $output .= $element .':active{color:'.  $this->value['active']  . $important .';}'; }
        if( isset( $this->value['visited'] ) && $this->value['visited'] !== '' ) { $output .= $element .':visited{color:'. $this->value['visited'] . $important .';}'; }
        if( isset( $this->value['focus']   ) && $this->value['focus']   !== '' ) { $output .= $element .':focus{color:'.   $this->value['focus']   . $important .';}'; }

        $this->parent->output_css .= $output;

        return $output;

    }

}
}
