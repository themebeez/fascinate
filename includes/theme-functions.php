<?php
/**
 * Collection of helper functions.
 *
 * @since 1.0.0
 *
 * @package Fascinate
 */

if ( ! function_exists( 'fascinate_navigation_fallback' ) ) {
	/**
	 * Callback function for 'fallback_cb' in argument of 'wp_nav_menu'.
	 *
	 * @since 1.0.0
	 */
	function fascinate_navigation_fallback() {
		?>
		<ul class="primary-menu">
			<?php
			if ( current_user_can( 'edit_theme_options' ) ) {
				?>
				<li><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Add Menu', 'fascinate' ); ?></a></li>
				<?php
			} else {
				wp_list_pages(
					array(
						'title_li' => '',
						'depth'    => 3,
					)
				);
			}
			?>
		</ul>
		<?php
	}
}


if ( ! function_exists( 'fascinate_search_form' ) ) {
	/**
	 * Modify and return custom search template.
	 *
	 * @since 1.0.0
	 * @return HTML markup.
	 */
	function fascinate_search_form() {

		$form = '<form role="search" method="get" class="clearfix" action="' . esc_url( home_url( '/' ) ) . '"><input type="search" name="s" placeholder="' . esc_attr_x( 'Type here to search', 'place-holder', 'fascinate' ) . '" value="' . esc_attr( get_search_query() ) . '"><button type="submit"><span class="ion-ios-search"></span></button></form>';

		return $form;
	}
}
add_filter( 'get_search_form', 'fascinate_search_form' );


if ( ! function_exists( 'fascinate_excerpt_length' ) ) {
	/**
	 * Set the length of post excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length Length of post excerpt.
	 * @return int
	 */
	function fascinate_excerpt_length( $length ) {

		if ( is_admin() ) {

			return $length;
		}

		$excerpt_length = fascinate_get_option( 'excerpt_length' );

		if ( absint( $excerpt_length ) > 0 ) {

			$excerpt_length = absint( $excerpt_length );
		}

		return $excerpt_length;
	}
}
add_filter( 'excerpt_length', 'fascinate_excerpt_length' );


if ( ! function_exists( 'fascinate_excerpt_more' ) ) {
	/**
	 * Modifies trailing text for post excerpts.
	 *
	 * @param string $more The string shown within the more link.
	 * @return string
	 */
	function fascinate_excerpt_more( $more ) {

		if ( is_admin() ) {

			return $more;
		}

		return '...';
	}
}
add_filter( 'excerpt_more', 'fascinate_excerpt_more' );


if ( ! function_exists( 'fascinate_has_google_fonts' ) ) {
	/**
	 * Checks if Google font is used.
	 *
	 * @since 1.0.9
	 */
	function fascinate_has_google_fonts() {

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

		return (
			( isset( $body_font['source'] ) && 'google' === $body_font['source'] ) ||
			( isset( $headings_font['source'] ) && 'google' === $headings_font['source'] ) ||
			( isset( $site_title_font['source'] ) && 'google' === $site_title_font['source'] ) ||
			( isset( $author_meta_font['source'] ) && 'google' === $author_meta_font['source'] )
			) ? true : false;
	}
}


if ( ! function_exists( 'fascinate_google_fonts_urls' ) ) {
	/**
	 * Returns the array of Google fonts URL.
	 *
	 * @since 1.0.9
	 *
	 * @return array $fonts_urls Fonts URLs.
	 */
	function fascinate_google_fonts_urls() {

		if ( ! fascinate_has_google_fonts() ) {
			return false;
		}

		$fonts_urls = array();

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

		if ( isset( $body_font['source'] ) && 'google' === $body_font['source'] ) {
			$fonts_urls[] = $body_font['font_url'];
		}

		if ( isset( $headings_font['source'] ) && 'google' === $headings_font['source'] ) {
			$fonts_urls[] = $headings_font['font_url'];
		}

		if ( isset( $site_title_font['source'] ) && 'google' === $site_title_font['source'] ) {
			$fonts_urls[] = $site_title_font['font_url'];
		}

		if ( isset( $author_meta_font['source'] ) && 'google' === $author_meta_font['source'] ) {
			$fonts_urls[] = $author_meta_font['font_url'];
		}

		return $fonts_urls;
	}
}


if ( ! function_exists( 'fascinate_render_google_fonts_header' ) ) {
	/**
	 * Renders <link> tags for Google fonts embedd in the <head> tag.
	 *
	 * @since 1.0.9
	 */
	function fascinate_render_google_fonts_header() {

		if ( ! fascinate_has_google_fonts() ) {
			return;
		}
		?>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
		<?php
	}

	add_action( 'wp_head', 'fascinate_render_google_fonts_header', 5 );
}


if ( ! function_exists( 'fascinate_get_google_fonts_url' ) ) {
	/**
	 * Returns the URL of Google fonts.
	 *
	 * @since 1.0.9
	 *
	 * @return string $google_fonts_url Google Fonts URL.
	 */
	function fascinate_get_google_fonts_url() {

		$google_fonts_urls = fascinate_google_fonts_urls();

		if ( empty( $google_fonts_urls ) ) {

			return false;
		}

		$google_fonts_url = add_query_arg(
			array(
				'family'  => implode( '&family=', $google_fonts_urls ),
				'display' => 'swap',
			),
			'https://fonts.googleapis.com/css2'
		);

		return esc_url( $google_fonts_url );
	}
}
