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


if ( ! function_exists( 'fascinate_sanitize_font' ) ) {
	/**
	 * Sanitizes font control value.
	 *
	 * @param string $value Setting value.
	 * @param object $setting Setting object.
	 * @return string
	 */
	function fascinate_sanitize_font( $value, $setting ) {

		$value = json_decode( $value, true );

		$sanitized_value = array();

		if (
			! isset( $value['source'] ) ||
			(
				'google' !== $value['source'] &&
				'websafe' !== $value['source']
			)
		) {
			return $setting->default;
		} else {
			$sanitized_value['source'] = sanitize_text_field( $value['source'] );
		}

		if ( ! isset( $value['font_family'] ) ) {
			return $setting->value;
		} else {
			$sanitized_value['font_family'] = sanitize_text_field( $value['font_family'] );
		}

		if ( ! isset( $value['font_variants'] ) ) {
			return $setting->value;
		} else {
			$sanitized_value['font_variants'] = sanitize_text_field( $value['font_variants'] );
		}

		if ( ! isset( $value['font_url'] ) ) {
			return $setting->value;
		} else {
			$sanitized_value['font_url'] = sanitize_text_field( $value['font_url'] );
		}

		if ( ! isset( $value['font_weight'] ) ) {
			return $setting->value;
		} else {
			$sanitized_value['font_weight'] = sanitize_text_field( $value['font_weight'] );
		}

		if ( isset( $value['font_sizes'] ) && ! empty( $value['font_sizes'] ) ) {

			foreach ( $value['font_sizes'] as $device => $device_value ) {

				if (
					'em' === $value['font_sizes'][ $device ]['unit'] ||
					'rem' === $value['font_sizes'][ $device ]['unit']
				) {
					$sanitized_value['font_sizes'][ $device ]['value'] = (float) $value['font_sizes'][ $device ]['value'];
				} else {
					$sanitized_value['font_sizes'][ $device ]['value'] = (int) $value['font_sizes'][ $device ]['value'];
				}

				$sanitized_value['font_sizes'][ $device ]['unit'] = sanitize_text_field( $value['font_sizes'][ $device ]['unit'] );
			}
		}

		if ( isset( $value['font_size'] ) ) {

			if (
				'em' === $value['font_size']['unit'] ||
				'rem' === $value['font_size']['unit']
			) {
				$sanitized_value['font_size']['value'] = (float) $value['font_size']['value'];
			} else {
				$sanitized_value['font_size']['value'] = (int) $value['font_size']['value'];
			}

			$sanitized_value['font_size']['unit'] = sanitize_text_field( $value['font_size']['unit'] );
		}

		if ( isset( $value['line_heights'] ) && ! empty( $value['line_heights'] ) ) {
			foreach ( $value['line_heights'] as $device => $device_value ) {
				$sanitized_value['line_heights'][ $device ] = (float) $value['line_heights'][ $device ];
			}
		}

		if ( isset( $value['line_height'] ) ) {
			$sanitized_value['line_height'] = (float) $value['line_height'];
		}

		if ( isset( $value['letter_spacings'] ) && ! empty( $value['letter_spacings'] ) ) {

			foreach ( $value['letter_spacings'] as $device => $device_value ) {

				if (
					'em' === $value['font_sizes'][ $device ]['unit'] ||
					'rem' === $value['font_sizes'][ $device ]['unit']
				) {
					$sanitized_value['letter_spacings'][ $device ]['value'] = (float) $value['letter_spacings'][ $device ]['value'];
				} else {
					$sanitized_value['letter_spacings'][ $device ]['value'] = (int) $value['letter_spacings'][ $device ]['value'];
				}

				$sanitized_value['letter_spacings'][ $device ]['unit'] = sanitize_text_field( $value['letter_spacings'][ $device ]['unit'] );
			}
		}

		if ( isset( $value['letter_spacing'] ) ) {
			if (
				'em' === $value['font_size']['unit'] ||
				'rem' === $value['font_size']['unit']
			) {
				$sanitized_value['letter_spacing']['value'] = (float) $value['letter_spacing']['value'];
			} else {
				$sanitized_value['letter_spacing']['value'] = (int) $value['letter_spacing']['value'];
			}

			$sanitized_value['letter_spacing']['unit'] = sanitize_text_field( $value['letter_spacing']['unit'] );
		}

		return ( ! empty( $sanitized_value ) ) ? wp_json_encode( $sanitized_value ) : $setting->value;
	}
}
