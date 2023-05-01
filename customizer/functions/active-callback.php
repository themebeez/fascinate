<?php
/**
 * Collection of active callback functions.
 *
 * @since 1.0.0
 *
 * @package Fascinate
 */

if ( ! function_exists( 'fascinate_active_top_header' ) ) {
	/**
	 * Checks if top header is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function fascinate_active_top_header( $control ) {

		return $control->manager->get_setting( 'fascinate_field_display_top_header' )->value();
	}
}


if ( ! function_exists( 'fascinate_active_carousel' ) ) {
	/**
	 * Checks if carousel is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function fascinate_active_carousel( $control ) {

		return $control->manager->get_setting( 'fascinate_field_display_carousel' )->value();
	}
}


if ( ! function_exists( 'fascinate_active_related_section' ) ) {
	/**
	 * Checks if related section is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function fascinate_active_related_section( $control ) {

		return $control->manager->get_setting( 'fascinate_field_display_related_section' )->value();
	}
}


if ( ! function_exists( 'fascinate_active_breadcrumb' ) ) {
	/**
	 * Checks if breadcrumb is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function fascinate_active_breadcrumb( $control ) {

		return $control->manager->get_setting( 'fascinate_field_display_breadcrumb' )->value();
	}
}


if ( ! function_exists( 'fascinate_not_active_global_sidebar' ) ) {
	/**
	 * Checks if global sidebar position is disabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function fascinate_not_active_global_sidebar( $control ) {

		return ! $control->manager->get_setting( 'fascinate_field_enable_global_sidebar_position' )->value();
	}
}

/**
 * Active callback function for when global sidebar position is active.
 */
if ( ! function_exists( 'fascinate_active_global_sidebar' ) ) {
	/**
	 * Checks if global sidebar position is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function fascinate_active_global_sidebar( $control ) {

		return $control->manager->get_setting( 'fascinate_field_enable_global_sidebar_position' )->value();
	}
}


if ( ! function_exists( 'fascinate_active_common_post_sidebar' ) ) {
	/**
	 * Checks if sidebar for post is common.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function fascinate_active_common_post_sidebar( $control ) {

		return ( $control->manager->get_setting( 'fascinate_field_enable_global_sidebar_position' )->value() === false && $control->manager->get_setting( 'fascinate_field_enable_common_post_sidebar_position' )->value() === true ) ? true : false;
	}
}



/**
 * Active callback function for when common page sidebar position is active.
 */
if ( ! function_exists( 'fascinate_active_common_page_sidebar' ) ) {
	/**
	 * Checks if sidebar for pages is common.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function fascinate_active_common_page_sidebar( $control ) {

		return ( $control->manager->get_setting( 'fascinate_field_enable_global_sidebar_position' )->value() === false && $control->manager->get_setting( 'fascinate_field_enable_common_page_sidebar_position' )->value() === true ) ? true : false;
	}
}


/**
 * Active callback function for when different font is active for site title.
 */
if ( ! function_exists( 'fascinate_has_site_title_different_font_enabled' ) ) {
	/**
	 * Checks if different font is enabled for site title.
	 *
	 * @since 1.0.9
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function fascinate_has_site_title_different_font_enabled( $control ) {

		return $control->manager->get_setting( 'fascinate_field_enable_different_font_for_site_title' )->value();
	}
}


/**
 * Active callback function for when different font is active for author meta.
 */
if ( ! function_exists( 'fascinate_has_author_meta_different_font_enabled' ) ) {
	/**
	 * Checks if different font is enabled for author meta.
	 *
	 * @since 1.0.9
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function fascinate_has_author_meta_different_font_enabled( $control ) {

		return $control->manager->get_setting( 'fascinate_field_enable_different_font_for_author_meta' )->value();
	}
}
