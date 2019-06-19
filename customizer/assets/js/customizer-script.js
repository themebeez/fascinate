(function( $ ) {

	const { __, _x, _n, _nx } = wp.i18n;

	wp.customize.bind( 'ready', function() {

		function customizer_label( id, title ) {

			if ( id === 'custom_logo' || id === 'site_icon' || id === 'background_image' || id === 'background_color' ) {
				$( '#customize-control-'+ id ).prepend('<p class="option-group-title customize-control"><strong>'+ title +'</strong></p>');
			} else {
				$( '#customize-control-'+ id ).prepend('<p class="option-group-title customize-control"><strong>'+ title +'</strong></p>');
			}
		}

		// Site Identity
		customizer_label( 'custom_logo', __( 'Logo Setup', 'fascinate' ) );
		customizer_label( 'site_icon', __( 'Favicon', 'fascinate' ) );

		customizer_label( 'background_color', __( 'Body Background', 'fascinate' ) );

		customizer_label( 'header_image', __( 'Background Image', 'fascinate' ) );

		customizer_label( 'fascinate_field_carousel_category', __( 'Carousel Content', 'fascinate' ) );
		customizer_label( 'fascinate_field_carousel_layout', __( 'Carousel Layout', 'fascinate' ) );

		customizer_label( 'fascinate_field_header_facebook_link', __( 'Social Links', 'fascinate' ) );

		customizer_label( 'fascinate_field_display_post_cats', __( 'Post Content', 'fascinate' ) );
		customizer_label( 'fascinate_field_display_author_section', __( 'Author Section', 'fascinate' ) );
		customizer_label( 'fascinate_field_display_related_section', __( 'Related Posts Section', 'fascinate' ) );

		customizer_label( 'fascinate_field_enable_common_post_sidebar_position', __( 'Sidebar', 'fascinate' ) );
		customizer_label( 'fascinate_field_enable_common_page_sidebar_position', __( 'Sidebar', 'fascinate' ) );

		

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
		$('.slider-custom-control').each(function(){
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
				change: function(e,ui){
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
			if(resetValue < sliderMinValue) {
				resetValue = sliderMinValue;
				$(this).val(resetValue);
			}
			if(resetValue > sliderMaxValue) {
				resetValue = sliderMaxValue;
				$(this).val(resetValue);
			}
			$(this).parent().find('.slider').slider('value', resetValue);
		});
		
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