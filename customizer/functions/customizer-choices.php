<?php
/**
 * Collection of helper functions for customize.
 *
 * @since 1.0.0
 *
 * @package Fascinate
 */

if ( ! function_exists( 'fascinate_post_category_choices' ) ) {
	/**
	 * Generates array of category terms. Value is term slug and label is the term name.
	 *
	 * @since 1.0.0
	 *
	 * @return array $category_terms
	 */
	function fascinate_post_category_choices() {

		$query_category_terms = get_terms(
			array(
				'taxonomy' => 'category',
			)
		);

		$category_terms = array();

		if ( ! empty( $query_category_terms ) ) {

			foreach ( $query_category_terms as $category_term ) {

				$category_terms[ $category_term->slug ] = $category_term->name;
			}
		}

		return $category_terms;
	}
}


if ( ! function_exists( 'fascinate_site_layout_choices' ) ) {
	/**
	 * Generates array choices for site layouts.
	 *
	 * @since 1.0.0
	 */
	function fascinate_site_layout_choices() {

		return array(
			'boxed'     => esc_html__( 'Boxed Layout', 'fascinate' ),
			'fullwidth' => esc_html__( 'Full Width Layout', 'fascinate' ),
		);
	}
}


if ( ! function_exists( 'fascinate_carousel_layout_choices' ) ) {
	/**
	 * Generates array choices for carousel layouts.
	 *
	 * @since 1.0.0
	 */
	function fascinate_carousel_layout_choices() {

		return array(
			'carousel_one' => get_template_directory_uri() . '/customizer/assets/images/carousel_one.png',
			'carousel_two' => get_template_directory_uri() . '/customizer/assets/images/carousel_two.png',
		);
	}
}


if ( ! function_exists( 'fascinate_sidebar_position_choices' ) ) {
	/**
	 * Generates array choices for sidebar positions.
	 *
	 * @since 1.0.0
	 */
	function fascinate_sidebar_position_choices() {

		return array(
			'left'  => get_template_directory_uri() . '/customizer/assets/images/sidebar_left.png',
			'right' => get_template_directory_uri() . '/customizer/assets/images/sidebar_right.png',
			'none'  => get_template_directory_uri() . '/customizer/assets/images/sidebar_none.png',
		);
	}
}

if ( ! function_exists( 'fascinate_comment_box_choices' ) ) {
	/**
	 * Generates array choices for comment box layouts.
	 *
	 * @since 1.0.0
	 */
	function fascinate_comment_box_choices() {

		return array(
			'default'       => esc_html__( 'Show Default View', 'fascinate' ),
			'toggle_canvas' => esc_html__( 'Toggleable Canvas View', 'fascinate' ),
		);
	}
}
