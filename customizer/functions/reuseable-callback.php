<?php
/**
 * Functions for reuseable customizer settings and controls.
 *
 * @package Fascinate
 */

if ( ! function_exists( 'fascinate_add_panel' ) ) {
	/**
	 * Registers customize panel.
	 *
	 * @param string $id Panel id.
	 * @param string $title Panel title.
	 * @param string $desc Panel description.
	 * @param string $priority Panel priority.
	 */
	function fascinate_add_panel( $id, $title, $desc, $priority ) {

		global $wp_customize;

		$panel_id = 'fascinate_panel_' . $id;

		$wp_customize->add_panel(
			$panel_id,
			array(
				'title'       => $title,
				'description' => $desc,
				'priority'    => ( $priority ) ? $priority : 10,
			)
		);
	}
}


if ( ! function_exists( 'fascinate_add_section' ) ) {
	/**
	 * Registers customize section.
	 *
	 * @param string $id Section id.
	 * @param string $title Section title.
	 * @param string $desc Section description.
	 * @param string $panel Panel id.
	 * @param string $priority Section priority.
	 */
	function fascinate_add_section( $id, $title, $desc, $panel, $priority ) {

		global $wp_customize;

		$section_id = 'fascinate_section_' . $id;

		$panel_id = 'fascinate_panel_' . $panel;

		$section_args = array(
			'title'      => $title,
			'desciption' => $desc,
		);

		if ( ! empty( $panel ) ) {
			$section_args['panel'] = $panel_id;
		}

		if ( ! empty( $priority ) ) {
			$section_args['priority'] = $priority;
		}

		$wp_customize->add_section( $section_id, $section_args );
	}
}


if ( ! function_exists( 'fascinate_add_text_field' ) ) {
	/**
	 * Registers setting and control of text type.
	 *
	 * @param string $id Setting id.
	 * @param string $label Control label.
	 * @param string $desc Control description.
	 * @param string $active_callback Active callback function.
	 * @param string $section Section id.
	 */
	function fascinate_add_text_field( $id, $label, $desc, $active_callback, $section ) {

		global $wp_customize;

		$defaults = fascinate_get_default_theme_options();

		$field_id = 'fascinate_field_' . $id;

		$section_id = 'fascinate_section_' . $section;

		$control_args = array(
			'label'       => $label,
			'description' => $desc,
			'type'        => 'text',
			'section'     => $section_id,
		);

		if ( ! empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting(
			$field_id,
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => $defaults[ $id ],
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control( $field_id, $control_args );
	}
}


if ( ! function_exists( 'fascinate_add_number_field' ) ) {
	/**
	 * Registers setting and control of number type.
	 *
	 * @param string $id Setting id.
	 * @param string $label Control label.
	 * @param string $desc Control description.
	 * @param string $active_callback Active callback function.
	 * @param string $section Section id.
	 * @param string $max Max attribute value.
	 * @param string $min Min attribute value.
	 * @param string $step Step attribute value.
	 */
	function fascinate_add_number_field( $id, $label, $desc, $active_callback, $section, $max, $min, $step ) {

		global $wp_customize;

		$defaults = fascinate_get_default_theme_options();

		$field_id = 'fascinate_field_' . $id;

		$section_id = 'fascinate_section_' . $section;

		$control_args = array(
			'label'       => $label,
			'description' => $desc,
			'type'        => 'number',
			'section'     => $section_id,
		);

		if ( ! empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		if ( ! empty( $max ) && ! empty( $min ) && ! empty( $step ) ) {

			$control_args['input_attrs'] = array(
				'min'  => $min,
				'max'  => $max,
				'step' => $step,
			);

			$wp_customize->add_setting(
				$field_id,
				array(
					'default'           => $defaults[ $id ],
					'sanitize_callback' => 'fascinate_sanitize_range',
					'capability'        => 'edit_theme_options',
				)
			);

		} else {

			$wp_customize->add_setting(
				$field_id,
				array(
					'default'           => $defaults[ $id ],
					'sanitize_callback' => 'fascinate_sanitize_number',
					'capability'        => 'edit_theme_options',
				)
			);
		}

		$wp_customize->add_control( $field_id, $control_args );
	}
}


if ( ! function_exists( 'fascinate_add_url_field' ) ) {
	/**
	 * Registers setting and control of url type.
	 *
	 * @param string $id Setting id.
	 * @param string $label Control label.
	 * @param string $desc Control description.
	 * @param string $active_callback Active callback function.
	 * @param string $section Section id.
	 */
	function fascinate_add_url_field( $id, $label, $desc, $active_callback, $section ) {

		global $wp_customize;

		$defaults = fascinate_get_default_theme_options();

		$field_id = 'fascinate_field_' . $id;

		$section_id = 'fascinate_section_' . $section;

		$control_args = array(
			'label'       => $label,
			'description' => $desc,
			'type'        => 'url',
			'section'     => $section_id,
		);

		if ( ! empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting(
			$field_id,
			array(
				'sanitize_callback' => 'esc_url_raw',
				'default'           => $defaults[ $id ],
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control( $field_id, $control_args );
	}
}


if ( ! function_exists( 'fascinate_add_radio_image_field' ) ) {
	/**
	 * Registers setting and control of radio image  type.
	 *
	 * @param string $id Setting id.
	 * @param string $label Control label.
	 * @param string $desc Control description.
	 * @param array  $choices Choices.
	 * @param string $active_callback Active callback function.
	 * @param string $section Section id.
	 */
	function fascinate_add_radio_image_field( $id, $label, $desc, $choices, $active_callback, $section ) {

		global $wp_customize;

		$defaults = fascinate_get_default_theme_options();

		$field_id = 'fascinate_field_' . $id;

		$section_id = 'fascinate_section_' . $section;

		$control_args = array(
			'label'       => $label,
			'description' => $desc,
			'type'        => 'select',
			'choices'     => $choices,
			'section'     => $section_id,
		);

		if ( ! empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting(
			$field_id,
			array(
				'sanitize_callback' => 'fascinate_sanitize_select',
				'default'           => $defaults[ $id ],
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Fascinate_Customize_Radio_Image_Control(
				$wp_customize,
				$field_id,
				$control_args
			)
		);
	}
}


if ( ! function_exists( 'fascinate_add_toggle_field' ) ) {
	/**
	 * Registers setting and control of toggle type.
	 *
	 * @param string $id Setting id.
	 * @param string $label Control label.
	 * @param string $description Control description.
	 * @param string $active_callback Active callback function.
	 * @param string $section Section id.
	 */
	function fascinate_add_toggle_field( $id, $label, $description, $active_callback, $section ) {

		global $wp_customize;

		$defaults = fascinate_get_default_theme_options();

		$field_id = 'fascinate_field_' . $id;

		$section_id = 'fascinate_section_' . $section;

		$control_args = array(
			'label'       => $label,
			'description' => $description,
			'type'        => 'ios', // ios, light, flat.
			'section'     => $section_id,
		);

		if ( ! empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting(
			$field_id,
			array(
				'sanitize_callback' => 'wp_validate_boolean',
				'default'           => $defaults[ $id ],
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Fascinate_Customize_Toggle_Control(
				$wp_customize,
				$field_id,
				$control_args
			)
		);
	}
}


if ( ! function_exists( 'fascinate_add_select_field' ) ) {
	/**
	 * Registers setting and control of select  type.
	 *
	 * @param string $id Setting id.
	 * @param string $label Control label.
	 * @param string $desc Control description.
	 * @param array  $choices Choices.
	 * @param string $active_callback Active callback function.
	 * @param string $section Section id.
	 */
	function fascinate_add_select_field( $id, $label, $desc, $choices, $active_callback, $section ) {

		global $wp_customize;

		$defaults = fascinate_get_default_theme_options();

		$field_id = 'fascinate_field_' . $id;

		$section_id = 'fascinate_section_' . $section;

		$control_args = array(
			'label'       => $label,
			'description' => $desc,
			'type'        => 'select',
			'choices'     => $choices,
			'section'     => $section_id,
		);

		if ( ! empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting(
			$field_id,
			array(
				'sanitize_callback' => 'fascinate_sanitize_select',
				'default'           => $defaults[ $id ],
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control( $field_id, $control_args );
	}
}


if ( ! function_exists( 'fascinate_add_slider_field' ) ) {
	/**
	 * Registers setting and control of slider input type.
	 *
	 * @param string $id Setting id.
	 * @param string $label Control label.
	 * @param string $desc Control description.
	 * @param string $active_callback Active callback function.
	 * @param string $section Section id.
	 * @param string $min Min attribute value.
	 * @param string $max Max attribute value.
	 * @param string $step Step attribute value.
	 */
	function fascinate_add_slider_field( $id, $label, $desc, $active_callback, $section, $min, $max, $step ) {

		global $wp_customize;

		$defaults = fascinate_get_default_theme_options();

		$field_id = 'fascinate_field_' . $id;

		$section_id = 'fascinate_section_' . $section;

		$control_args = array(
			'label'       => $label,
			'description' => $desc,
			'section'     => $section_id,
			'input_attrs' => array(
				'min'  => $min,
				'max'  => $max,
				'step' => $step,
			),
		);

		if ( ! empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting(
			$field_id,
			array(
				'default'           => $defaults[ $id ],
				'sanitize_callback' => 'fascinate_sanitize_range',
			)
		);

		$wp_customize->add_control(
			new Fascinate_Customize_Slider_Control(
				$wp_customize,
				$field_id,
				$control_args
			)
		);
	}
}
