<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Fascinate
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function fascinate_body_classes( $classes ) {

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$sidebar_position = fascinate_sidebar_position();

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar' ) || 'none' === $sidebar_position ) {

		$classes[] = 'no-sidebar';
	}

	// Adds a class of boxed when site layout is boxed.
	$site_layout = fascinate_get_option( 'site_layout' );

	if ( 'boxed' === $site_layout ) {

		$classes[] = 'boxed';
	}

	// Adds a class when preloader is enabled.
	$is_preloader_enabled = fascinate_get_option( 'enable_preloader' );

	if ( $is_preloader_enabled ) {

		$classes[] = 'preloader-active';
	}

	return $classes;
}
add_filter( 'body_class', 'fascinate_body_classes' );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 *
 * @since 1.0.0
 */
function fascinate_pingback_header() {

	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'fascinate_pingback_header' );


if ( ! function_exists( 'fascinate_main_container_class' ) ) {
	/**
	 * Add custom class for main container containing posts.
	 *
	 * @since 1.0.0
	 */
	function fascinate_main_container_class() {

		$container_class = '';

		$sidebar_position = fascinate_sidebar_position();

		$sticky_enabled = fascinate_sticky_sidebar_enabled();

		if ( 'none' === $sidebar_position || ! is_active_sidebar( 'sidebar' ) ) {

			if ( is_singular() || is_404() ) {

				$container_class = 'col-12';
			} else {

				$container_class = 'col-lg-8 col-md-12 aligncenter';
			}
		} elseif ( 'left' === $sidebar_position ) {
			$container_class = 'col-lg-8 col-md-12 order-last';
		} else {

			$container_class = 'col-lg-8 col-md-12';
		}

		if (
			( $sticky_enabled ) &&
			'none' !== $sidebar_position
		) {

			$container_class .= ' sticky-portion';
		}

		echo esc_attr( $container_class );
	}
}



if ( ! function_exists( 'fascinate_sidebar_class' ) ) {
	/**
	 * Add custom class for sidebar.
	 *
	 * @since 1.0.0
	 */
	function fascinate_sidebar_class() {

		$sidebar_class = 'col-lg-4 col-md-12';

		$sticky_enabled = fascinate_sticky_sidebar_enabled();

		if ( $sticky_enabled ) {

			$sidebar_class .= ' sticky-portion';
		}

		$sidebar_position = fascinate_sidebar_position();

		if ( 'left' === $sidebar_position ) {

			$sidebar_class .= ' order-first';
		}

		$enable_for_small_devices = fascinate_get_option( 'enable_sidebar_small_devices' );

		if ( ! $enable_for_small_devices ) {

			$sidebar_class .= ' hide-medium';
		}

		echo esc_attr( $sidebar_class );
	}
}


if ( ! function_exists( 'fascinate_thumbnail_class' ) ) {
	/**
	 * Add custom class for post thumbnail container.
	 *
	 * @since 1.0.0
	 */
	function fascinate_thumbnail_class() {

		$thumbnail_container_class = '';

		$sidebar_position = fascinate_sidebar_position();

		if ( 'none' === $sidebar_position || ! is_active_sidebar( 'sidebar' ) ) {

			$thumbnail_container_class = 'center-align';

			echo esc_attr( $thumbnail_container_class );
		}
	}
}


if ( ! function_exists( 'fascinate_dropcap_class' ) ) {
	/**
	 * Add custom class for excerpt container.
	 *
	 * @since 1.0.0
	 */
	function fascinate_dropcap_class() {

		if ( is_home() ) {

			$enable_dropcap = fascinate_get_option( 'blog_enable_dropcap' );

			if ( $enable_dropcap ) {

				$dropcap_class = 'dropcap';

				echo esc_attr( $dropcap_class );
			}
		}

		if ( is_archive() ) {

			$enable_dropcap = fascinate_get_option( 'archive_enable_dropcap' );

			if ( $enable_dropcap ) {

				$dropcap_class = 'dropcap';

				echo esc_attr( $dropcap_class );
			}
		}

		if ( is_search() ) {

			$enable_dropcap = fascinate_get_option( 'search_enable_dropcap' );

			if ( $enable_dropcap ) {

				$dropcap_class = 'dropcap';

				echo esc_attr( $dropcap_class );
			}
		}
	}
}


if ( ! function_exists( 'fascinate_single_layout_class' ) ) {
	/**
	 * Add custom class for single layout.
	 *
	 * @since 1.0.0
	 */
	function fascinate_single_layout_class() {

		$single_layout = fascinate_single_layout();

		$single_layout_class = 'single-page-style-1';

		if ( is_front_page() ) {

			$single_layout_class = 'single-page-style-1';
		} elseif ( 'layout_two' === $single_layout ) {
			$single_layout_class = 'single-page-style-2';
		} else {

				$single_layout_class = 'single-page-style-1';
		}

		echo esc_attr( $single_layout_class );
	}
}


if ( ! function_exists( 'fascinate_banner' ) ) {
	/**
	 * Function that defines template for banner/slider.
	 *
	 * @since 1.0.0
	 */
	function fascinate_banner() {

		$show_carousel = fascinate_get_option( 'display_carousel' );

		if ( $show_carousel ) {

			$carousel_layout = fascinate_get_option( 'carousel_layout' );

			if ( 'carousel_one' === $carousel_layout ) {

				get_template_part( 'template-parts/banner/banner', 'one' );
			} else {

				get_template_part( 'template-parts/banner/banner', 'two' );
			}
		} else {

			return;
		}
	}
}


if ( ! function_exists( 'fascinate_breadcrumb' ) ) {
	/**
	 * Breadcrumb declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function fascinate_breadcrumb() {

		$display_breadcrumb = fascinate_get_option( 'display_breadcrumb' );

		if ( $display_breadcrumb ) {
			?>
			<div class="fb-breadcrumb">
				<?php
				$breadcrumb_args = array(
					'show_browse' => false,
				);
				fascinate_breadcrumb_trail( $breadcrumb_args );
				?>
			</div><!-- .fb-breadcrumb -->
			<?php
		}
	}
}




if ( ! function_exists( 'fascinate_breadcrumb_wrapper' ) ) {
	/**
	 * Breadcrumb wrapper declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function fascinate_breadcrumb_wrapper() {

		if ( has_header_image() ) {
			?>
			<div class="fb-breadcrumb-wrap" style="background-image: url( <?php header_image(); ?> );">
			<?php
		} else {
			?>
			<div class="fb-breadcrumb-wrap">
			<?php
		}
		?>
			<div class="fb-container">
				<div class="the-title">
					<?php
					if ( is_404() ) {
						?>
						<h1 class="page-title"><?php esc_html_e( '404 - Page Not Found', 'fascinate' ); ?></h1>
						<?php
					}

					if ( is_archive() ) {
						the_archive_title( '<h1 class="page-title">', '</h1>' );
					}

					if ( is_search() ) {
						?>
						<h1 class="page-title">
							<?php
							/* translators: %s: search query. */
							printf( esc_html__( 'Search Results for: %s', 'fascinate' ), '<span>' . get_search_query() . '</span>' );
							?>
						</h1>
						<?php
					}

					if ( is_singular() ) {
						while ( have_posts() ) {

							the_post();
							?>
							<div class="the-title">
								<h1 class="page-title"><?php the_title(); ?></h1>
							</div><!-- .the-title -->
							<?php
						}
					}
					?>
				</div><!-- .the-title -->
				<?php fascinate_breadcrumb(); ?>
			</div><!-- .fb-container -->
			<div class="mask"></div><!-- .mask -->
		</div><!-- .fb-breadcrumb-wrap -->
		<?php
	}
}


if ( ! function_exists( 'fascinate_single_breadcrumb_wrapper' ) ) {
	/**
	 * Breadcrumb wrapper declaration for single post or page of the theme.
	 *
	 * @since 1.0.0
	 */
	function fascinate_single_breadcrumb_wrapper() {

		if ( is_front_page() ) {
			return;
		}

		$single_layout = fascinate_single_layout();

		if ( 'layout_two' === $single_layout ) {
			?>
			<div class="<?php fascinate_single_layout_class(); ?>">
				<?php

				$post_thumbnail_url = '';

				while ( have_posts() ) {

					the_post();

					if ( has_post_thumbnail() ) {
						$post_thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
					}
				}

				if ( ! empty( $post_thumbnail_url ) ) {
					?>
					<div class="fb-breadcrumb-wrap" style="background-image: url( <?php echo esc_url( $post_thumbnail_url ); ?> );">
					<?php
				} elseif ( has_header_image() ) {
					?>
					<div class="fb-breadcrumb-wrap" style="background-image: url( <?php header_image(); ?> );">
					<?php
				} else {
					?>
					<div class="fb-breadcrumb-wrap">
					<?php
				}
				?>
					<div class="fb-container">
						<?php
						while ( have_posts() ) {

							the_post();

							if ( get_post_type() === 'post' ) {

								$display_cats = fascinate_get_option( 'display_post_cats' );
								fascinate_categories_meta( $display_cats );
							}
							?>
							<div class="the-title">
								<h1 class="page-title"><?php the_title(); ?></h1>
							</div><!-- .the-title -->
							<?php
							if ( get_post_type() === 'post' ) {
								$display_date   = fascinate_get_option( 'display_post_date' );
								$display_author = fascinate_get_option( 'display_post_author' );
								if (
									( true === $display_author || 1 === $display_author ) ||
									( true === $display_date || 1 === $display_date )
								) {
									?>
									<div class="entry-metas">
										<ul>
											<?php fascinate_posted_on( $display_date ); ?>
											<?php fascinate_posted_by( $display_author ); ?>
										</ul>
									</div><!-- .entry-metas -->
									<?php
								}
							}
						}

						fascinate_breadcrumb();
						?>
					</div><!-- .fb-container -->
					<div class="mask"></div><!-- .mask -->
				</div><!-- .fb-breadcrumb-wrap -->
			</div>
			<?php
		} else {

			fascinate_breadcrumb_wrapper();
		}
	}
}



if ( ! function_exists( 'fascinate_pagination' ) ) {
	/**
	 * Function that defines posts pagination.
	 */
	function fascinate_pagination() {
		?>
		<div class="fb-patigation fb-patigation-style-1">
			<div class="pagination-entry">
				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 0,
						'prev_text' => esc_html__( 'Prev', 'fascinate' ),
						'next_text' => esc_html__( 'Next', 'fascinate' ),
					)
				);
				?>
			</div><!-- .pagination-entry -->
		</div><!-- .fb-patigation-style-1 -->
		<?php
	}
}


if ( ! function_exists( 'fascinate_post_navigation' ) ) {
	/**
	 * Function that defines post navigation.
	 */
	function fascinate_post_navigation() {

		$next_post = get_next_post();

		$previous_post = get_previous_post();

		$navigation_args = array();

		if ( ! empty( $next_post ) ) {

			$navigation_args['next_text'] = '';

			$navigation_args['next_text'] = '<div class="post-nav-title"><span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next Post', 'fascinate' ) . '</span><div class="nav-title"><span>' . esc_html( $next_post->post_title ) . '</span></div></div>';

			if ( get_the_post_thumbnail( $next_post->ID, 'thumbnail' ) ) {

				$navigation_args['next_text'] .= '<div class="post-nav-img">' . get_the_post_thumbnail( $next_post->ID, 'thumbnail' ) . '</div>';
			}
		}

		if ( ! empty( $previous_post ) ) {

			$navigation_args['prev_text'] = '';

			if ( get_the_post_thumbnail( $previous_post->ID, 'thumbnail' ) ) {

				$navigation_args['prev_text'] = '<div class="post-nav-img">' . get_the_post_thumbnail( $previous_post->ID, 'thumbnail' ) . '</div>';
			}

			$navigation_args['prev_text'] .= '<div class="post-nav-title"><span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous Post', 'fascinate' ) . '</span><div class="nav-title"><span>' . esc_html( $previous_post->post_title ) . '</span></div></div>';
		}

		the_post_navigation( $navigation_args );
	}
}
