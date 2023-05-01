( function( $ ) {

	wp.customize.bind( 'ready', function() {

		function customizer_label( id, title ) {

			if ( id === 'custom_logo' || id === 'site_icon' || id === 'background_image' || id === 'background_color' ) {
				$( '#customize-control-'+ id ).prepend('<p class="option-group-title customize-control"><strong>'+ title +'</strong></p>');
			} else {
				$( '#customize-control-'+ id ).prepend('<p class="option-group-title customize-control"><strong>'+ title +'</strong></p>');
			}
		}

		// Site Identity
		customizer_label( 'custom_logo', customizer_titles.logo_title );
		customizer_label( 'site_icon', customizer_titles.favicon_title );

		customizer_label( 'background_color', customizer_titles.body_bg_title );

		customizer_label( 'header_image', customizer_titles.header_bg_title );

		customizer_label( 'fascinate_field_carousel_category', customizer_titles.carousel_content_title );
		customizer_label( 'fascinate_field_carousel_layout', customizer_titles.carousel_layout_title );

		customizer_label( 'fascinate_field_header_facebook_link', customizer_titles.social_links_title );

		customizer_label( 'fascinate_field_display_post_cats', customizer_titles.post_content_title );
		customizer_label( 'fascinate_field_display_author_section', customizer_titles.author_section_title );
		customizer_label( 'fascinate_field_display_related_section', customizer_titles.related_section_title );

		customizer_label( 'fascinate_field_enable_common_post_sidebar_position', customizer_titles.sidebar_title );
		customizer_label( 'fascinate_field_enable_common_page_sidebar_position', customizer_titles.sidebar_title );

		

		/**
		 *	Toogle Custom Control's Script
		 */

		var customize = this; // Customize object alias.
		// Array with the control names
		// TODO: Replace #CONTROLNAME01#, #CONTROLNAME02# etc with the real control names.
		var toggleControls = [
			'#CONTROLNAME01#',
			'#CONTROLNAME02#'
		];
		$.each( toggleControls, function( index, control_name ) {

			customize( control_name, function( value ) {

				var controlTitle = customize.control( control_name ).container.find( '.customize-control-title' ); // Get control  title.
				// 1. On loading.
				controlTitle.toggleClass( 'disabled-control-title', !value.get() );
				// 2. Binding to value change.
				value.bind( function( to ) {
					controlTitle.toggleClass( 'disabled-control-title', !value.get() );
				} );
			} );
		} );


		/**
		 * Slider Custom Control's Script
		 */
		// Set our slider defaults and initialise the slider
		$('.slider-custom-control').each(function() {
			var sliderValue = $(this).find('.customize-control-slider-value').val();
			var newSlider = $(this).find('.slider');
			var sliderMinValue = parseInt(newSlider.attr('slider-min-value'));
			var sliderMaxValue = parseInt(newSlider.attr('slider-max-value'));
			var sliderStepValue = parseInt(newSlider.attr('slider-step-value'));

			newSlider.slider({
				value: sliderValue,
				min: sliderMinValue,
				max: sliderMaxValue,
				step: sliderStepValue,
				change: function(e,ui) {
					// Important! When slider stops moving make sure to trigger change event so Customizer knows it has to save the field
					$(this).parent().find('.customize-control-slider-value').trigger('change');
		      }
			});
		});

		// Change the value of the input field as the slider is moved
		$('.slider').on('slide', function(event, ui) {
			$(this).parent().find('.customize-control-slider-value').val(ui.value);
		});

		// Reset slider and input field back to the default value
		$('.slider-reset').on('click', function() {
			var resetValue = $(this).attr('slider-reset-value');
			$(this).parent().find('.customize-control-slider-value').val(resetValue);
			$(this).parent().find('.slider').slider('value', resetValue);
		});

		// Update slider if the input field loses focus as it's most likely changed
		$('.customize-control-slider-value').blur(function() {
			var resetValue = $(this).val();
			var slider = $(this).parent().find('.slider');
			var sliderMinValue = parseInt(slider.attr('slider-min-value'));
			var sliderMaxValue = parseInt(slider.attr('slider-max-value'));

			// Make sure our manual input value doesn't exceed the minimum & maxmium values
			if (resetValue < sliderMinValue) {
				resetValue = sliderMinValue;
				$(this).val(resetValue);
			}
			if (resetValue > sliderMaxValue) {
				resetValue = sliderMaxValue;
				$(this).val(resetValue);
			}
			$(this).parent().find('.slider').slider('value', resetValue);
		});
		
	});

	let customizeBody = jQuery('body');

	function responsiveSwitcher() {

		// Responsive switchers
		customizeBody.on('click', '.responsive-switchers button', function (event) {

			// Set up variables				var ,
			var $device = jQuery(this).data('device'),
				$body = jQuery('.wp-full-overlay'),
				$footer_devices = jQuery('.wp-full-overlay-footer .devices');
			var $devices = jQuery('.responsive-switchers');
			// Button class

			if ($device == 'desktop') {
				jQuery(this).parents(".responsive-switchers").toggleClass("responsive-switchers-open");

				jQuery(this).parents('li').siblings('.has-switchers').find('.responsive-switchers').toggleClass('responsive-switchers-open');
			}

			$devices.find('button').removeClass('active');
			$devices.find('button.preview-' + $device).addClass('active');

			var controls = jQuery('.responsive-control-wrap');
			controls.each(function () {
				if ($device != 'normal') {
					if (jQuery(this).hasClass($device)) {
						jQuery(this).addClass('active');
					} else {
						jQuery(this).removeClass('active');
					}
				}
			});

			// Wrapper class
			$body.removeClass('preview-desktop preview-tablet preview-mobile').addClass('preview-' + $device);

			// Panel footer buttons
			$footer_devices.find('button').removeClass('active').attr('aria-pressed', false);
			$footer_devices.find('button.preview-' + $device).addClass('active').attr('aria-pressed', true);

		});

		jQuery('#customize-footer-actions .devices button').on('click', function (event) {
			event.preventDefault();
			let device = jQuery(this).data('device');
			let queries = jQuery('.devices-wrapper');
			let body = jQuery('.wp-full-overlay');
			let responsiveSwitchers = jQuery('.responsive-switchers');

			// Button class
			if (device == 'desktop') {
				if (queries.hasClass('responsive-switchers-open')) {
					queries.removeClass('responsive-switchers-open');
				} else {
					queries.addClass('responsive-switchers-open')
				}
			} else {
				if (!queries.hasClass('responsive-switchers-open')) {
					queries.addClass('responsive-switchers-open');
				}
			}

			queries.find('button').removeClass('active');
			queries.find('button.preview-' + device).addClass('active');

			responsiveSwitchers.find('button').removeClass('active');
			responsiveSwitchers.find('button.preview-' + device).addClass('active');

			var controls = jQuery('.responsive-control-wrap');
			controls.each(function () {
				if (device != 'normal') {
					if (jQuery(this).hasClass(device)) {
						jQuery(this).addClass('active');
					} else {
						jQuery(this).removeClass('active');
					}
				}
			});

			body.removeClass('preview-desktop preview-tablet preview-mobile').addClass('preview-' + device);
		});
	}

	responsiveSwitcher();

	var footerWidgetAreaSectionLinks = jQuery('.customize-section-link');
	footerWidgetAreaSectionLinks.each(function (i, o) {
		jQuery(this).on('click', function (event) {
			event.preventDefault();
			var sectionID = jQuery(this).attr('data-attr');
			wp.customize.section('sidebar-widgets-' + sectionID).focus();
		})
	});

	// @since 1.0.9
	customizeBody.on('click', '.unit-dropdown-toggle-button', function (event) {
		event.preventDefault();
		let thisButton = jQuery(this);
		let isUnitChangeable = thisButton.data('changeable');
		if (isUnitChangeable !== 'no') {
			thisButton.next('.fascinate-unit-dropdown').toggleClass('dropdown-open');
		}
	});

	// @since 1.0.9
	customizeBody.on('click', '.fascinate-control-toggle-button', function (event) {
		event.preventDefault();
		let thisButton = jQuery(this);
		let associatedControlModal = thisButton.parent().parent().find('.fascinate-control-modal');
		let allControlModal = jQuery('.fascinate-control-modal');
		allControlModal.each(function () {
			let thisControlModal = jQuery(this);
			if (thisControlModal.hasClass('modal-open') && thisButton.data('control') !== thisControlModal.data('control')) {
				thisControlModal.removeClass('modal-open');
			}
		});
		thisButton.parent().parent().find('.fascinate-control-modal').toggleClass('modal-open');
	});

	// @since 1.0.9
	customizeBody.on('click', '.fascinate-unit-button', function (event) {
		event.preventDefault();
		let thisButton = jQuery(this);
		let thisButtonVal = thisButton.val();
		let unitButton = thisButton.parent().prev('.fascinate-unit-button');
		// Change the unit toggle button's text.
		unitButton.find('span').html(thisButtonVal);
		// Update the unit input field's value.
		unitButton.find('.fascinate-unit-input').val(thisButtonVal).trigger('change');
		// Remove 'dropdown-open' classname from unit dropdown element.
		thisButton.parent().removeClass('dropdown-open');
	});

	// @since 1.0.9
	customizeBody.on('click', '.fascinate-typography-font-style-button, .fascinate-typography-text-transform-button', function (event) {
		event.preventDefault();
		let thisButton = jQuery(this);
		// Remove classname 'active' from sibling buttons.
		thisButton.siblings().removeClass('active');
		// Add classname 'active' to current button;
		thisButton.addClass('active');
		// Update the input field's value.
		thisButton.parent().prev('input').val(thisButton.val()).trigger('change');
	});

	wp.customize.sectionConstructor['wptrt-customize-pro'] = wp.customize.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );
}) ( jQuery );