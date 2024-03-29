<?php
/**
 * Pro Customize Section Class.
 *
 * Adds a custom "Pro" section for the WordPress customizer.
 *
 * @author    WPTRT <themes@wordpress.org>
 * @copyright 2019 WPTRT
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/WPTRT/wptrt-customize-pro
 *
 * @package Fascinate
 */

if ( ! class_exists( 'Fascinate_Customize_Upsell' ) ) {
	/**
	 * Customize Upsell.
	 *
	 * @since 1.0.0
	 *
	 * @see WP_Customize_Control
	 */
	class Fascinate_Customize_Upsell extends WP_Customize_Section {

		/**
		 * The type of customize section being rendered.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $type = 'wptrt-customize-pro';

		/**
		 * Custom button text to output.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $button_text = '';

		/**
		 * Custom pro button URL.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $button_url = '';

		/**
		 * Default priority of the section.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $priority = 999;

		/**
		 * Add custom parameters to pass to the JS via JSON.
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function json() {

			$json = parent::json();

			$theme = wp_get_theme();

			$json['button_text'] = esc_html(
				$this->button_text
				? $this->button_text
				: $theme->get( 'Name' )
			);

			$json['button_url'] = esc_url(
				$this->button_url
				? $this->button_url
				: $theme->get( 'ThemeURI' )
			);

			return $json;
		}

		/**
		 * Outputs the Underscore.js template.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		protected function render_template() {
			?>
			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
				<h3 class="accordion-section-title">
					{{ data.title }}
					<# if ( data.button_text && data.button_url ) { #>
						<a href="{{ data.button_url }}" class="button button-secondary alignright" target="_blank">{{ data.button_text }}</a>
					<# } #>
				</h3>
			</li>
			<?php
		}
	}
}
