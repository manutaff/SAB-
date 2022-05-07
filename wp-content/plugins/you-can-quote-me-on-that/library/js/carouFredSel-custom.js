/**
 * 
 *
 *  @package You Can Quote Me On That/library/js
 */

( function( $ ) {

	YouCanQuoteMeOnThat = function( selector, options ) {
	    var settings = {};
	    var defaults = {
	    		slideshow: false
	    	};
	    
	    settings = $.extend( defaults, options );
	    
	    if ( !settings['slideshow'] ) {
	    	settings['slideshowSpeed'] = false;
	    }
	    
        $( selector + ' .you-can-quote-me-on-that').carouFredSel({
            responsive: true,
            circular: true,
            infinite: false,
            //width: 1200,
            height: 'variable',
            items: {
                visible: 1,
                //width: 1200,
                height: 'variable'
            },
            onCreate: function(items) {
            	you_can_quote_me_on_that_scale_slider_controls();
    			
            	$(selector).css('height', 'auto');
            	$(selector).removeClass('loading');
            	
        		you_can_quote_me_on_that_set_slider_controls_visibility();
        		you_can_quote_me_on_that_constrain_text_overlay_opacity();
            },
            scroll: {
                fx: 'crossfade',
                duration: settings['speed'],
            },
            auto: settings['slideshowSpeed'],
            //pagination: selector + ' .you-can-quote-me-on-that-pagination',
            prev: selector + ' .prev',
            next: selector + ' .next',
            swipe: {
            	onTouch: true
            }
        });
	}

} )( jQuery );