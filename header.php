<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fascinate
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
	<div class="page--wrap">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fascinate' ); ?></a>

		<?php
		$fascinate_is_preloader_enabled = fascinate_get_option( 'display_preloader' );
		if ( $fascinate_is_preloader_enabled ) {
			?>
			<div class="preLoader" id="preLoader">
				<div class="fl fl-spinner spinner1">
					<div class="double-bounce1"></div>
					<div class="double-bounce2"></div>
				</div>
			</div>
			<?php
		}
		?>
		<header class="fb-general-header header-style-1">
			<div class="header-inner">
				<?php

				$fascinate_display_top_header = fascinate_get_option( 'display_top_header' );

				if ( $fascinate_display_top_header ) {
					?>
					<div class="header-top">
						<div class="fb-container">
							<div class="row">
								<div class="col-lg-7 col-md-6 col-sm-12">
									<?php
									if ( has_nav_menu( 'menu-2' ) ) {
										?>
										<div class="secondary-navigation">
											<?php
											wp_nav_menu(
												array(
													'theme_location' => 'menu-2',
													'container'      => '',
													'depth'          => 1,
												)
											);
											?>
										</div><!-- .secondary-navigation -->
										<?php
									}
									?>
								</div><!-- .col -->
								<div class="col-lg-5 col-md-6 col-sm-12">
									<div class="social-icons">
										<ul class="social-icons-list">
											<?php
											$facebook_link = fascinate_get_option( 'header_facebook_link' );
											if ( ! empty( $facebook_link ) ) {
												?>
												<li>
													<a href="<?php echo esc_url( $facebook_link ); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
												</li>
												<?php
											}

											$twitter_link = fascinate_get_option( 'header_twitter_link' );
											if ( ! empty( $twitter_link ) ) {
												?>
												<li>
													<a href="<?php echo esc_url( $twitter_link ); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
												</li>
												<?php
											}

											$instagram_link = fascinate_get_option( 'header_instagram_link' );
											if ( ! empty( $instagram_link ) ) {
												?>
												<li>
													<a href="<?php echo esc_url( $instagram_link ); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
												</li>
												<?php
											}

											$pinterest_link = fascinate_get_option( 'header_pinterest_link' );
											if ( ! empty( $pinterest_link ) ) {
												?>
												<li>
													<a href="<?php echo esc_url( $pinterest_link ); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
												</li>
												<?php
											}

											$youtube_link = fascinate_get_option( 'header_youtube_link' );
											if ( ! empty( $youtube_link ) ) {
												?>
												<li>
													<a href="<?php echo esc_url( $youtube_link ); ?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
												</li>
												<?php
											}

											$linkedin_link = fascinate_get_option( 'header_linkedin_link' );
											if ( ! empty( $linkedin_link ) ) {
												?>
												<li>
													<a href="<?php echo esc_url( $linkedin_link ); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
												</li>
												<?php
											}

											$vk_link = fascinate_get_option( 'header_vk_link' );
											if ( ! empty( $vk_link ) ) {
												?>
												<li>
													<a href="<?php echo esc_url( $vk_link ); ?>"><i class="fa fa-vk" aria-hidden="true"></i></a>
												</li>
												<?php
											}
											?>
										</ul><!-- .social-icons-list -->
									</div><!-- .social-icons -->
								</div><!-- .col -->
							</div><!-- .row -->
						</div><!-- .fb-container -->
					</div><!-- .header-top -->
					<?php
				}
				?>
				<div class="mid-header">
					<div class="fb-container">
						<div class="site-branding">
							<?php
							if ( has_custom_logo() ) {
								if ( is_home() || is_front_page() ) {
									?>
									<h1 class="site-logo">
									<?php
								}
								the_custom_logo();
								if ( is_home() ) {
									?>
									</h1>
									<?php
								}
							} else {
								if ( is_home() || is_front_page() ) {
									?>
									<h1 class="site-title">
									<?php
								} else {
									?>
									<span class="site-title">
									<?php
								}
								?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
								<?php
								if ( is_home() ) {
									?>
									</h1>
									<?php
								} else {
									?>
									</span>
									<?php
								}

								$fascinate_description = get_bloginfo( 'description', 'display' );
								if ( $fascinate_description || is_customize_preview() ) {
									?>
									<p class="site-description"><?php echo esc_html( $fascinate_description ); // phpcs:ignore ?></p><!-- .site-description -->
									<?php
								}
							}
							?>
						</div><!-- .site-branding -->
					</div><!-- .fb-container -->
				</div><!-- .mid-header -->
				<div class="header-bottom">
					<div class="main-menu-wrapper">
						<div class="fb-container">
							<div id="menu-toggle-search-container">
								<div class="menu-toggle">
									<span class="hamburger-bar"></span>
									<span class="hamburger-bar"></span>
									<span class="hamburger-bar"></span>
								</div><!-- .menu-toggle -->
								<button class="fb-search">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
								</button>
							</div>
							
							<nav id="site-navigation" class="site-navigation">
								<?php
								$menu_args = array(
									'theme_location' => 'menu-1',
									'container'      => '',
									'menu_class'     => 'primary-menu',
									'menu_id'        => '',
									'fallback_cb'    => 'fascinate_navigation_fallback',
								);
								wp_nav_menu( $menu_args );
								?>
							</nav><!-- #site-navigation.site-navigation -->
							
						</div><!-- .fb-container -->
					</div><!-- .main-menu-wrapper -->
				</div><!-- .header-bottom -->
			</div><!-- .header-inner -->
		</header><!-- .fb-general-header.header-style-1 -->

		<div id="content" class="site-content">
