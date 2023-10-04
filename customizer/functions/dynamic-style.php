<?php
/**
 * Renders dynamic CSS from customize.
 *
 * @since 1.0.0
 *
 * @package Fascinate
 */

if ( ! function_exists( 'fascinate_dynamic_style' ) ) {
	/**
	 * Function to load dynamic styles.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	function fascinate_dynamic_style() {

		$display_srcoll_top            = fascinate_get_option( 'display_scroll_top' );
		$enable_cursive_site_title     = fascinate_get_option( 'enable_cursive_site_title' );
		$site_identity_section_padding = fascinate_get_option( 'site_identity_section_padding' );
		$enable_cursive_post_meta      = fascinate_get_option( 'enable_cursive_post_meta' );
		$carousel_height               = fascinate_get_option( 'carousel_height' );

		$body_font = fascinate_get_option( 'body_font' );
		$body_font = json_decode( $body_font, true );

		$headings_font = fascinate_get_option( 'headings_font' );
		$headings_font = json_decode( $headings_font, true );

		$site_title_font = '';
		if ( fascinate_get_option( 'enable_different_font_for_site_title' ) ) {
			$site_title_font = fascinate_get_option( 'site_title_font' );
			$site_title_font = json_decode( $site_title_font, true );
		}

		$author_meta_font = '';
		if ( fascinate_get_option( 'enable_different_font_for_author_meta' ) ) {
			$author_meta_font = fascinate_get_option( 'author_meta_font' );
			$author_meta_font = json_decode( $author_meta_font, true );
		}

		$css = '<style>';

		if ( ! $display_srcoll_top ) {

			$css .= '.fascinate-to-top {';
			$css .= 'display: none !important;';
			$css .= '}';
		}

		// Dynamic CSS for body typography.
		$css .= 'body, button, input, select, textarea {';

		if (
			isset( $body_font['font_family'] ) &&
			! empty( $body_font['font_family'] )
		) {
			$css .= 'font-family: ' . esc_attr( $body_font['font_family'] ) . ';';
		}

		if (
			isset( $body_font['font_weight'] ) &&
			! empty( $body_font['font_weight'] )
		) {
			$css .= 'font-weight: ' . esc_attr( $body_font['font_weight'] ) . ';';
		}

		$css .= '}';

		// Dynamic CSS for headings typography.
		$css .= 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {';

		if (
			isset( $headings_font['font_family'] ) &&
			! empty( $headings_font['font_family'] )
		) {
			$css .= 'font-family: ' . esc_attr( $headings_font['font_family'] ) . ';';
		}

		if (
			isset( $headings_font['font_weight'] ) &&
			! empty( $headings_font['font_weight'] )
		) {
			$css .= 'font-weight: ' . esc_attr( $headings_font['font_weight'] ) . ';';
		}

		$css .= '}';

		// Dynamic CSS for site title typography.
		$css .= '.header-style-1 .site-title, .header-style-2 .site-title {';

		if (
			isset( $site_title_font['font_family'] ) &&
			! empty( $site_title_font['font_family'] )
		) {
			$css .= 'font-family: ' . esc_attr( $site_title_font['font_family'] ) . ';';
		} else {
			if (
				isset( $headings_font['font_family'] ) &&
				! empty( $headings_font['font_family'] )
			) {
				$css .= 'font-family: ' . esc_attr( $headings_font['font_family'] ) . ';';
			}
		}

		if (
			isset( $site_title_font['font_weight'] ) &&
			! empty( $site_title_font['font_weight'] )
		) {
			$css .= 'font-weight: ' . esc_attr( $site_title_font['font_weight'] ) . ';';
		} else {
			if (
				isset( $headings_font['font_weight'] ) &&
				! empty( $headings_font['font_weight'] )
			) {
				$css .= 'font-weight: ' . esc_attr( $headings_font['font_weight'] ) . ';';
			}
		}

		$css .= '}';

		// Dynamic CSS for author meta typography.
		$css .= '.entry-metas ul li.posted-by a {';

		if (
			isset( $author_meta_font['font_family'] ) &&
			! empty( $author_meta_font['font_family'] )
		) {
			$css .= 'font-family: ' . esc_attr( $author_meta_font['font_family'] ) . ';';
		} else {
			if (
				isset( $body_font['font_family'] ) &&
				! empty( $body_font['font_family'] )
			) {
				$css .= 'font-family: ' . esc_attr( $body_font['font_family'] ) . ';';
			}
		}

		if (
			isset( $author_meta_font['font_weight'] ) &&
			! empty( $author_meta_font['font_weight'] )
		) {
			$css .= 'font-weight: ' . esc_attr( $author_meta_font['font_weight'] ) . ';';
		} else {
			if (
				isset( $body_font['font_weight'] ) &&
				! empty( $body_font['font_weight'] )
			) {
				$css .= 'font-weight: ' . esc_attr( $body_font['font_weight'] ) . ';';
			}
		}

		$css .= '}';

		if ( $site_identity_section_padding ) {
			$css .= '@media (min-width: 1024px) {';

				$css .= '.header-style-1 .mid-header {';
				$css .= 'padding: ' . esc_attr( $site_identity_section_padding ) . 'px 0px;';
				$css .= '}';

			$css .= '}';
		}

		if ( $carousel_height ) {
			$css .= '@media(min-width: 992px) {';

				$css .= '.banner-style-1 .post-thumb {';
				$css .= 'height: ' . esc_attr( $carousel_height ) . 'px;';
				$css .= '}';

			$css .= '}';
		}

		$css .= '</style>';

		echo fascinate_minify_css( $css ); // phpcs:ignore
	}
}
add_action( 'wp_head', 'fascinate_dynamic_style' );


if ( ! function_exists( 'fascinate_minify_css' ) ) {
	/**
	 * Simple minification of CSS codes.
	 *
	 * @since 1.0.9
	 *
	 * @param string $css CSS codes.
	 * @return string
	 */
	function fascinate_minify_css( $css ) {

		$css = preg_replace( '/\s+/', ' ', $css );
		$css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
		$css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
		$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
		$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
		$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

		return trim( (string) $css );
	}
}
