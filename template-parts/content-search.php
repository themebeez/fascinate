<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fascinate
 */

$display_featured_image = fascinate_get_option( 'search_display_feat_img' );
$display_date           = fascinate_get_option( 'search_display_date' );
$display_categories     = fascinate_get_option( 'search_display_cats' );
$display_author         = fascinate_get_option( 'search_display_author' );
$display_comments_no    = fascinate_get_option( 'search_display_comments_no' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="top-wrap">
		<?php fascinate_categories_meta( $display_categories ); ?>
		<div class="post-title">
			<h3>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>
		</div><!-- .post-title -->
		<div class="entry-metas">
			<ul>
				<?php fascinate_posted_on( $display_date ); ?>
				<?php fascinate_posted_by( $display_author ); ?>
			</ul>
		</div><!-- .entry-metas -->
	</div><!-- .top-wrap -->
	<?php fascinate_post_format_content( $display_featured_image ); ?>
	<div class="bottom-wrap">
		<div class="the-content <?php fascinate_dropcap_class(); ?>">
			<?php the_excerpt(); ?>
		</div><!-- .the-content -->
		<?php
		if ( 'post' === get_post_type() ) {
			?>
			<div class="post-content-link">
				<a href="<?php the_permalink(); ?>" class="post-link-btn"><?php esc_html_e( 'Continue Reading', 'fascinate' ); ?></a>
			</div><!-- .post-content-link -->
			<?php
		}
		?>
	</div><!-- .bottom-wrap -->
</article><!-- #post-<?php the_ID(); ?> -->
