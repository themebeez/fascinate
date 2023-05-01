<?php
/**
 * Customize Toggle Switch Control.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */

/**
 * Customize Toggle Switch Control Class.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */
class Fascinate_Customize_Toggle_Control extends WP_Customize_Control {

	/**
	 * The type of control being rendered.
	 *
	 * @var $type
	 */
	public $type = 'flat'; // light, iso, or flat.

	/**
	 * Render the control's content.
	 *
	 * @version 1.0.0
	 */
	public function render_content() {
		?>
		<label>
			<div style="display:flex;flex-direction: row;justify-content: flex-start;">
				<span class="customize-control-title" style="flex: 2 0 0; vertical-align: middle;"><?php echo esc_html( $this->label ); ?></span>
				<input
					id="cb<?php echo esc_attr( $this->instance_number ); ?>"
					type="checkbox"
					class="tgl tgl-<?php echo esc_attr( $this->type ); ?>"
					value="<?php echo esc_attr( $this->value() ); ?>"
					<?php $this->link(); ?>
					<?php checked( $this->value() ); ?>
				/>
				<label for="cb<?php echo esc_attr( $this->instance_number ); ?>" class="tgl-btn"></label>
			</div>
			<?php
			if ( ! empty( $this->description ) ) {
				?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php
			}
			?>
		</label>
		<?php
	}
}
