<?php
/**
 * Author Widget Class.
 *
 * @package Fascinate
 */

if ( ! class_exists( 'Fascinate_Author_Widget' ) ) {
	/**
	 * Widget class - Fascinate_Author_Widget.
	 *
	 * @since 1.0.0
	 *
	 * @package Fascinate
	 */
	class Fascinate_Author_Widget extends WP_Widget {

		/**
		 * Define id, name and description of the widget.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			parent::__construct(
				'fascinate-author-widget',
				esc_html__( 'F: Author Widget', 'fascinate' ),
				array(
					'description' => esc_html__( 'Displays brief author detail.', 'fascinate' ),
				)
			);
		}

		/**
		 * Renders widget at the frontend.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args Provides the HTML you can use to display the widget title class and widget content class.
		 * @param array $instance The settings for the instance of the widget..
		 */
		public function widget( $args, $instance ) {

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$author_name        = ! empty( $instance['author_name'] ) ? $instance['author_name'] : '';
			$author_description = ! empty( $instance['author_description'] ) ? $instance['author_description'] : '';
			$author_image       = ! empty( $instance['author_image'] ) ? $instance['author_image'] : '';
			$author_link_title  = ! empty( $instance['author_link_title'] ) ? $instance['author_link_title'] : '';
			$author_link        = ! empty( $instance['author_link'] ) ? $instance['author_link'] : '#';
			?>
			<div class="widget fb-author-widget">
				<?php
				if ( ! empty( $title ) ) {
					?>
					<div class="widget_title">
						<h3><?php echo esc_html( $title ); ?></h3>
					</div><!-- .widget_title -->
					<?php
				}
				?>
				<div class="widget-container">
					<?php
					if ( ! empty( $author_image ) ) {

						$author_image_id = attachment_url_to_postid( $author_image );

						$author_image_url = wp_get_attachment_image_src( $author_image_id, 'fascinate-thumbnail-two' );

						$author_image_url = isset( $author_image_url[0] ) ? $author_image_url[0] : '';

						if ( ! empty( $author_image_url ) ) {
							?>
							<div class="author-thumb">
								<a href="<?php echo esc_url( $author_link ); ?>">
									<img src="<?php echo esc_url( $author_image_url ); ?>" alt="<?php echo esc_attr( $author_name ); ?>">
								</a>
							</div><!-- .author-thumb -->
							<?php
						}
					}
					?>
					<div class="author-bio">
						<?php
						if ( ! empty( $author_name ) ) {
							?>
							<div class="author-title">
								<h3><?php echo esc_html( $author_name ); ?></h3>
							</div>
							<?php
						}

						if ( ! empty( $author_description ) ) {
							?>
							<p><?php echo esc_html( $author_description ); ?></p>
							<?php
						}
						?>
					</div><!-- .author-bio -->
					<?php
					if ( ! empty( $author_link_title ) && ! empty( $author_link ) ) {
						?>
						<div class="author-permalink">
							<a class="post-link-btn" href="<?php echo esc_url( $author_link ); ?>"><?php echo esc_html( $author_link_title ); ?></a>
						</div><!-- .auhtor-permalink -->
						<?php
					}
					?>
				</div><!-- .widget-container -->
			</div><!-- .widget.fb-author-widget -->
			<?php
		}

		/**
		 * Adds setting fields to the widget and renders them in the form.
		 *
		 * @since 1.0.0
		 *
		 * @param array $instance The settings for the instance of the widget..
		 */
		public function form( $instance ) {

			$defaults = array(
				'title'              => '',
				'author_name'        => '',
				'author_description' => '',
				'author_image'       => '',
				'author_link_title'  => '',
				'author_link'        => '',
			);

			$instance = wp_parse_args( (array) $instance, $defaults );

			$author_image = $instance['author_image'];
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
					<strong><?php esc_html_e( 'Title', 'fascinate' ); ?></strong>
				</label>
				<input
					class="widefat"
					id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
					type="text"
					value="<?php echo esc_attr( $instance['title'] ); ?>"
				/>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'author_name' ) ); ?>">
					<strong><?php esc_html_e( 'Author&rsquo;s Name', 'fascinate' ); ?></strong>
				</label>
				<input
					class="widefat"
					id="<?php echo esc_attr( $this->get_field_id( 'author_name' ) ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'author_name' ) ); ?>"
					type="text"
					value="<?php echo esc_attr( $instance['author_name'] ); ?>"
				/>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'author_description' ) ); ?>">
					<strong><?php esc_html_e( 'Author&rsquo;s Detail Link Title', 'fascinate' ); ?></strong>
				</label>
				<textarea
					class="widefat"
					name="<?php echo esc_attr( $this->get_field_name( 'author_description' ) ); ?>"
					id="<?php echo esc_attr( $this->get_field_id( 'author_description' ) ); ?>"
					cols="30"
					rows="10"
				><?php echo esc_html( $instance['author_description'] ); ?></textarea>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'author_image' ) ); ?>">
					<strong><?php esc_html_e( 'Author&rsquo;s Image', 'fascinate' ); ?></strong>
				</label>

				<span class="fb-image-uploader-container">
					<?php
					$upload_btn_class = 'button fb-upload-btn';
					$remove_btn_class = 'button fb-remove-btn';

					if ( empty( $author_image ) ) {

						$remove_btn_class .= ' fb-btn-hide';
						$upload_btn_class .= ' fb-btn-show';
					} else {

						$remove_btn_class .= ' fb-btn-show';
						$upload_btn_class .= ' fb-btn-hide';
					}
					?>

					<span class="fb-upload-image-holder" style="background-image: url( <?php echo esc_url( $author_image ); ?> );"></span>
					<input
						type="hidden"
						class="widefat fb-upload-image-url-holder"
						name="<?php echo esc_attr( $this->get_field_name( 'author_image' ) ); ?>"
						id="<?php echo esc_attr( $this->get_field_id( 'author_image' ) ); ?>"
						value="<?php echo esc_url( $author_image ); ?>"
					>
					<button class="<?php echo esc_attr( $upload_btn_class ); ?>" id="fb-upload-btn"><?php esc_html_e( 'Upload', 'fascinate' ); ?></button>
					<button class="<?php echo esc_attr( $remove_btn_class ); ?>" id="fb-remove-btn"><?php esc_html_e( 'Remove', 'fascinate' ); ?></button>
				</span>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'author_link_title' ) ); ?>">
					<strong><?php esc_html_e( 'Author&rsquo;s Detail Link Title', 'fascinate' ); ?></strong>
				</label>
				<input
					class="widefat"
					id="<?php echo esc_attr( $this->get_field_id( 'author_link_title' ) ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'author_link_title' ) ); ?>"
					type="text"
					value="<?php echo esc_attr( $instance['author_link_title'] ); ?>"
				/>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'author_link' ) ); ?>">
					<strong><?php esc_html_e( 'Author&rsquo;s Detail Link', 'fascinate' ); ?></strong>
				</label>
				<input
					type="text"
					class="widefat"
					id="<?php echo esc_attr( $this->get_field_id( 'author_link' ) ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'author_link' ) ); ?>"
					value="<?php echo esc_attr( $instance['author_link'] ); ?>"
				/>
			</p>
			<?php
		}

		/**
		 * Sanitizes and saves the instance of the widget.
		 *
		 * @since 1.0.0
		 *
		 * @param array $new_instance The settings for the new instance of the widget.
		 * @param array $old_instance The settings for the old instance of the widget.
		 * @return array Sanitized instance of the widget.
		 */
		public function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['title']              = isset( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
			$instance['author_name']        = isset( $new_instance['author_name'] ) ? sanitize_text_field( $new_instance['author_name'] ) : '';
			$instance['author_description'] = isset( $new_instance['author_description'] ) ? sanitize_text_field( $new_instance['author_description'] ) : '';
			$instance['author_image']       = isset( $new_instance['author_image'] ) ? esc_url_raw( $new_instance['author_image'] ) : '';
			$instance['author_link_title']  = isset( $new_instance['author_link_title'] ) ? sanitize_text_field( $new_instance['author_link_title'] ) : '';
			$instance['author_link']        = isset( $new_instance['author_link'] ) ? esc_url_raw( $new_instance['author_link'] ) : '';

			return $instance;
		}
	}
}
