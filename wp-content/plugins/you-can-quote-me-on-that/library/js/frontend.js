/**
 * Plugin Template frontend js.
 *
 *  @package You Can Quote Me On That/JS
 */

jQuery( document ).ready(function() {
	you_can_quote_me_on_that_set_slider_height();
	
	jQuery( '.you-can-quote-me-on-that-container .you-can-quote-me-on-that .slide .overlay button' ).click( function(e) {
		e.preventDefault();
		
		var url	   = jQuery(this).attr('rel');
		var target = jQuery(this).attr('target');
		
		if ( !url ) {
			return false;
		}
		
        if( target === '_blank' ) {
        	window.open(url);
        } else {
        	window.location.href = url;
        }
        
	});
});

jQuery(window).resize(function () {
	clearTimeout( window.you_can_quote_me_on_that_resized_finished );
	
	// Use setTimeout to stop the code from running before the window has finished resizing
	window.you_can_quote_me_on_that_resized_finished = setTimeout(function() {
		//you_can_quote_me_on_that_scale_slider_controls();
		you_can_quote_me_on_that_constrain_text_overlay_opacity();
		you_can_quote_me_on_that_set_slider_controls_visibility();
	}, 0);

}).resize();

function you_can_quote_me_on_that_set_slider_height() {
	// Set the height of the slider to the height of the first slide's image
	jQuery( '.you-can-quote-me-on-that-container' ).each( function() {
		var sliderContainer = jQuery(this);
		
		var firstSlide = sliderContainer.find('.you-can-quote-me-on-that .slide:eq(0)');
		if ( firstSlide.length > 0 ) {
			var firstSlideImage = firstSlide.find('img').first();
			
			if ( firstSlideImage.length > 0) {
				
				if ( firstSlideImage.attr('height') > 0 ) {
					
					// The height needs to be dynamically calculated with responsive in mind ie. the height of the image will obviously grow
					var firstSlideImageWidth  = firstSlideImage.attr('width');
					var firstSlideImageHeight = firstSlideImage.attr('height');
					
					var sliderWidth = sliderContainer.width();
					var widthPercentage;
					var widthRatio;
					
					widthRatio = sliderWidth / firstSlideImageWidth;
					
					if ( sliderContainer.hasClass('loading') ) {
						sliderContainer.css('height', Math.round( widthRatio * firstSlideImageHeight ) + parseInt( jQuery('.you-can-quote-me-on-that-container').css('paddingTop').replace('px', '') ) );
					}
				}
			}
		
		}
	});
}

function you_can_quote_me_on_that_scale_slider_controls() {
	jQuery( '.you-can-quote-me-on-that-container' ).each( function() {
		var sliderContainer = jQuery(this);
		
		// Slider control buttons
		var sliderControlButtons = sliderContainer.find('.prev, .next');
		var maxsliderControlButtonSize = 49;
		//var minsliderControlButtonSize = 20;
		var minsliderControlButtonSize = 26;

		// Slider control arrows
		var sliderControlArrows = sliderContainer.find('.prev .ycqmot-fa, .next .ycqmot-fa');

		var maxsliderControlArrowSize 		= 37;
		var minsliderControlArrowSize 		= 26;
		var maxsliderControlArrowLineHeight = 45;
		var minsliderControlArrowLineHeight = 18;
		var compressor 						= 2.5;
		
		sliderContainerWidth = sliderContainer.width();
		
		var sliderControlButtonHeight = Math.max(Math.min( sliderContainerWidth / (compressor*10), maxsliderControlButtonSize), minsliderControlButtonSize);
		
		sliderControlButtons.css({
			'height': sliderControlButtonHeight,
			'width': sliderControlButtonHeight
		});
		
		sliderControlArrowLineHeight = sliderControlButtonHeight * (91.8367346938776 / 100);
		
		sliderControlArrows.css({
			'font-size': Math.max(Math.min( sliderContainerWidth / (compressor*10), maxsliderControlArrowSize), minsliderControlArrowSize),
			'line-height': sliderControlArrowLineHeight + 'px'
		});

	});
}

function you_can_quote_me_on_that_set_slider_controls_visibility() {
	jQuery( '.you-can-quote-me-on-that-container' ).each( function() {
		var sliderContainer    = jQuery(this);
		var controlsContainer  = sliderContainer.find( '.controls-container' );
		var textOverlayOpacity = sliderContainer.find( '.you-can-quote-me-on-that .slide .overlay-container .overlay .opacity' );
	
		if ( !sliderContainer.hasClass('loading') && controlsContainer.length > 0 && textOverlayOpacity.length > 0 && textOverlayOpacity.css('display') != 'none' ) {
			var prevButton = sliderContainer.find( '.controls-container .controls .prev' );
			var nextButton = sliderContainer.find( '.controls-container .controls .next' );
			
			var prevButtonLeftOffset = 0;
			var nextButtonLeftOffset = 0;

			var textOverlayOpacityLeftOffset  = textOverlayOpacity.offset().left - sliderContainer.offset().left;
			var textOverlayOpacityRightOffset = controlsContainer.width() - ( textOverlayOpacityLeftOffset + textOverlayOpacity.outerWidth() );
			var textOverlayOpacityPadding 	  = Math.round( parseFloat( textOverlayOpacity.css('padding') ) );
			
			if ( prevButton.css('left').indexOf('px') > -1 ) {
				prevButtonLeftOffset = parseFloat( prevButton.css('left').replace('px', '') ); 
			} else if ( prevButton.css('left').indexOf('%') > -1 ) {
				//prevButtonLeftOffset = ( parseFloat( prevButton.css('left').replace('%', '') ) * controlsContainer.width() ) / 100;
				prevButtonLeftOffset = ( parseFloat( prevButton.css('left').replace('%', '') ) / 100 ) * controlsContainer.width();
			}
			//console.log( 'prevButton.offset().left:' + prevButton.offset().left );
			//prevButtonLeftOffset = Math.round( parseFloat( prevButton.offset().left - sliderContainer.offset().left ) );
			prevButtonLeftOffset = ( 2.5 / 100 ) * controlsContainer.width();
	
			if ( nextButton.css('right').indexOf('px') > -1 ) {
				nextButtonLeftOffset = parseFloat( nextButton.css('left').replace('px', '') ); 
			} else if ( nextButton.css('right').indexOf('%') > -1 ) {
				nextButtonLeftOffset = ( parseFloat( nextButton.css('left').replace('%', '') ) / 100 ) * controlsContainer.width();
			}
			
			// If the text overlay opacity gets too close to the slider navigation buttons then hide them
			// This needs to be added to the various button styles as a data attribute
			var textOverlayToControlsMinDistance = 0;
			
//			console.log( 'textOverlayOpacityLeftOffset: ' + textOverlayOpacityLeftOffset );
//			console.log( 'textOverlayOpacityPadding: ' + textOverlayOpacityPadding );
//			console.log( 'textOverlayOpacityLeftOffset + textOverlayOpacityPadding: ' + ( textOverlayOpacityLeftOffset + textOverlayOpacityPadding ) );
//			console.log( 'prevButtonLeftOffset: ' + prevButtonLeftOffset );
//			console.log( ( textOverlayOpacityLeftOffset + textOverlayOpacityPadding ) - ( prevButtonLeftOffset + prevButton.outerWidth() ) );
//			console.log( 'is ' + ( ( textOverlayOpacityLeftOffset + textOverlayOpacityPadding ) - ( prevButtonLeftOffset + prevButton.outerWidth() ) ) + ' smaller than ' + textOverlayToControlsMinDistance + '?' );

			if (
				( textOverlayOpacityLeftOffset + textOverlayOpacityPadding ) - ( prevButtonLeftOffset + prevButton.outerWidth() ) <= textOverlayToControlsMinDistance
				//textOverlayOpacityLeftOffset - ( prevButtonLeftOffset + prevButton.outerWidth() ) <= textOverlayToControlsMinDistance || 
				//nextButtonLeftOffset - textOverlayOpacityRightOffset <= textOverlayToControlsMinDistance
			) {
//				console.log('Yes');
				controlsContainer.css('display', 'none');
			} else {
//				console.log('No');
				controlsContainer.css('display', 'block');
			}
		}
	});
}

function you_can_quote_me_on_that_constrain_text_overlay_opacity() {
	jQuery( '.you-can-quote-me-on-that-container' ).each( function() {
		var sliderContainer = jQuery(this);
		
		sliderContainer.find('.slide').each( function() {
			var slide = jQuery(this);
				
			var sliderTextOverlay 		 = slide.find('.you-can-quote-me-on-that .slide .overlay-container .overlay');
			var sliderTextOverlayOpacity = slide.find('.you-can-quote-me-on-that .slide .overlay-container .overlay .opacity');
			
			if ( !sliderContainer.hasClass('loading') && sliderTextOverlayOpacity.length > 0 && sliderTextOverlayOpacity.outerHeight() >= sliderTextOverlay.height() ) {
				sliderTextOverlayOpacity.addClass('constrained');
			} else {
				sliderTextOverlayOpacity.removeClass('constrained');
			}
		});
	});
}
