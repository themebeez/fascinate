<?php
/**
 * Customize Slider Control.
 *
 * @since 1.0.0
 *
 * @package Fascinate
 */

if ( ! class_exists( 'Fascinate_Customize_Slider_Control' ) ) {
	/**
	 * Customize Slider Control Class.
	 *
	 * @since 1.0.0
	 *
	 * @see WP_Customize_Control
	 */
	class Fascinate_Customize_Slider_Control extends WP_Customize_Control {

		/**
		 * The type of control being rendered.
		 *
		 * @var $type
		 */
		public $type = 'slider_control';

		/**
		 * Renders the control wrapper and calls $this->render_content() for the internals.
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<div class="slider-custom-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<input
					type="number"
					id="<?php echo esc_attr( $this->id ); ?>"
					name="<?php echo esc_attr( $this->id ); ?>"
					value="<?php echo esc_attr( $this->value() ); ?>"
					class="customize-control-slider-value"
					<?php $this->link(); ?>
				/>
				<div
					class="slider"
					slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>"
					slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>"
					slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"
				></div>
				<span
					class="slider-reset dashicons dashicons-image-rotate"
					slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"
				></span>
				<?php
				if ( ! empty( $this->description ) ) {
					?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php
				}
				?>
			</div>
			<?php
		}
	}
}
