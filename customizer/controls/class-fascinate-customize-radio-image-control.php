<?php
/**
 * Customize Radio Image Control.
 *
 * @since 1.0.0
 *
 * @package Fascinate
 */

if ( ! class_exists( 'Fascinate_Customize_Radio_Image_Control' ) ) {
	/**
	 * Customize Radio Image Control Class.
	 *
	 * @since 1.0.0
	 *
	 * @see WP_Customize_Control
	 */
	class Fascinate_Customize_Radio_Image_Control extends WP_Customize_Control {

		/**
		 * The type of control being rendered.
		 *
		 * @var $type
		 */
		public $type = 'radio-image';

		/**
		 * Renders the control wrapper and calls $this->render_content() for the internals.
		 *
		 * @since 1.0.0
		 */
		public function render_content() {

			$name = '_customize-radio-' . $this->id;
			?>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>
			<div id="input_<?php echo esc_attr( $this->id ); ?>" class="image">
				<?php
				foreach ( $this->choices as $value => $label ) {
					?>
					<label for="<?php echo esc_attr( $this->id ) . esc_attr( $value ); ?>">
						<input
							class="image-select"
							type="radio"
							value="<?php echo esc_attr( $value ); ?>"
							name="<?php echo esc_attr( $name ); ?>"
							id="<?php echo esc_attr( $this->id ) . esc_attr( $value ); ?>"
							<?php $this->link(); ?>
							<?php checked( $this->value(), $value ); ?>
						>
						<img src="<?php echo esc_url( $label ); ?>"/>
					</label>
					<?php
				}
				?>
			</div>
			<?php
		}
	}
}
