<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fascinate
 */

?>
		</div>

		<footer class="footer dark secondary-widget-area">
			<div class="footer-inner">
				<?php
				if (
					is_active_sidebar( 'footer-left' ) ||
					is_active_sidebar( 'footer-middle' ) ||
					is_active_sidebar( 'footer-right' )
				) {
					?>
					<div class="footer-top">
						<div class="fb-container">                            
							<div class="footer-widget-area">
								<div class="row">
								   
									<div class="col-lg-4 col-md-12">
										<?php
										if ( is_active_sidebar( 'footer-left' ) ) {

											dynamic_sidebar( 'footer-left' );
										}
										?>
									</div>
									<div class="col-lg-4 col-md-12">
										<?php
										if ( is_active_sidebar( 'footer-middle' ) ) {
											dynamic_sidebar( 'footer-middle' );
										}
										?>
									</div>
									<div class="col-lg-4 col-md-12">
										<?php
										if ( is_active_sidebar( 'footer-right' ) ) {
											dynamic_sidebar( 'footer-right' );
										}
										?>
									</div>      	                            
								</div><!-- .row -->
							</div><!-- .footer-widget-area -->
						</div><!-- .fb-container -->
					</div><!-- .footer-top -->
					<?php
				}
				?>
				<div class="footer-bottom">
					<div class="fb-container">
						<div class="row">                            
							<div class="col-lg-6">
								<?php
								$copyright_text = fascinate_get_option( 'copyright_text' );

								if ( ! empty( $copyright_text ) ) {
									if ( str_contains( $copyright_text, '{copy}' ) ) {
										$copy_right_symbol = '&copy;';
										$copyright_text    = str_replace( '{copy}', $copy_right_symbol, $copyright_text );
									}

									if ( str_contains( $copyright_text, '{year}' ) ) {
										$current_year   = gmdate( 'Y' );
										$copyright_text = str_replace( '{year}', $current_year, $copyright_text );
									}

									if ( str_contains( $copyright_text, '{site_title}' ) ) {
										$site_title     = get_bloginfo( 'name' );
										$copyright_text = str_replace( '{site_title}', $site_title, $copyright_text );
									}

									if ( str_contains( $copyright_text, '{theme_author}' ) ) {
										$theme_author   = '<a href="https://themebeez.com" rel="author" target="_blank">Themebeez</a>';
										$copyright_text = str_replace( '{theme_author}', $theme_author, $copyright_text );
									}

									?>
									<div class="copyright-information">
										<p><?php echo wp_kses_post( $copyright_text ); ?></p>
									</div><!-- .copyright-information -->
									<?php
								}
								?>
							</div><!-- .col -->
							<div class="col-lg-6">
								<div class="author-credit">
									<p> 
										<?php
										printf(
											/* translators: 1: Theme name, 2: Theme author. */
											esc_html__( '%1$s Theme By %2$s', 'fascinate' ),
											'Fascinate',
											'<a href="' . esc_url( 'https://themebeez.com/' ) . '" target="_blank">Themebeez</a>'
										);
										?>
									</p>
								</div><!-- .author-credit -->
							</div><!-- .col -->
						</div><!-- .row -->
					</div><!-- .fb-container -->
				</div><!-- .footer-bottom -->
			</div><!-- .footer-inner -->
		</footer><!-- .footer.secondary-widget-area -->
	</div><!-- .page--wrap -->

	<div class="fascinate-to-top"><span><?php esc_html_e( 'Back to top', 'fascinate' ); ?></span></div>

	<div class="search-area-container hide-search">
		<div class="fb-container">
			<div class="form-container">
				<div class="form-wrapper">
					<button class="search-close">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
					</button><!-- .search-close -->
					<?php get_search_form(); ?>                    
				</div><!-- .form-wrapper -->
			</div><!-- .form-container -->
		</div><!-- .fb-container -->
	</div><!-- .search-area-container -->

<?php wp_footer(); ?>

</body>
</html>
