<?php
/**
 * Collection of sanitization callback functions.
 *
 * @since 1.0.0
 *
 * @package Fascinate
 */

/**
 * Sanitization callback function for number field with value in range.
 */
if ( ! function_exists( 'fascinate_sanitize_range' ) ) {
	/**
	 * Sanitizes slider range value.
	 *
	 * @param string $input Setting value.
	 * @param object $setting Setting object.
	 * @return string
	 */
	function fascinate_sanitize_range( $input, $setting ) {

		if ( $input <= $setting->manager->get_control( $setting->id )->input_attrs['max'] ) {

			if ( $input >= $setting->manager->get_control( $setting->id )->input_attrs['min'] ) {

				return absint( $input );
			}
		}
	}
}


if ( ! function_exists( 'fascinate_sanitize_number' ) ) {
	/**
	 * Sanitizes number value.
	 *
	 * @param string $input Setting value.
	 * @return string
	 */
	function fascinate_sanitize_number( $input ) {

		return absint( $input );
	}
}


if ( ! function_exists( 'fascinate_sanitize_select' ) ) {
	/**
	 * Sanitizes single select value.
	 *
	 * @param string $input Setting value.
	 * @param object $setting Setting object.
	 * @return string
	 */
	function fascinate_sanitize_select( $input, $setting ) {

		$input = sanitize_key( $input );

		$choices = $setting->manager->get_control( $setting->id )->choices;

		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
}
