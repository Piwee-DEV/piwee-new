/*!

ALERT

MODIFIED BY ALEXANDRE NGUYEN

DO NOT ATTEMPT TO UPDATE IT. TY

*/

;(function($) {

    $.fn.scrollgress = function(options) {
    
    	//return if no element was bound
		//so chained events can continue
		if(!this.length) { 
			return this; 
		}

		//define default parameters
        var defaults = {
            height: '5px',
            color: '#ff0000',
            success: function() {}
        }
        
        //define plugin
        var plugin = this;

        //define settings
        plugin.settings = {}
 
        //merge defaults and options
        plugin.settings = $.extend({}, defaults, options);
        
        var s = plugin.settings;

        //define element
        var el = $(this);

    	var elOverflow = el.css('overflow');
    	var elOverflowY = el.css('overflow-y');
    
    	var hasOverflow = (elOverflow === 'auto' || elOverflow === 'scroll' || elOverflowY === 'auto' || elOverflowY === 'scroll') ? true : false;
    
    	var windowHeight = $(window).outerHeight();
    
        var heightToScroll = (hasOverflow) ? el[0].scrollHeight : el.height();
        
        var elementToScroll = (hasOverflow) ? el : $(window);
    	
    	elementToScroll.scroll(function(e) {
    	
    		var amountScrolled = (hasOverflow) ? el.scrollTop() : $(document).scrollTop();

    		// divide the amount of pixels scrolled by the total height to scroll minus the height of the window
    		// and round the result to two decimal places
    		var percentScrolled = ((amountScrolled / (heightToScroll - windowHeight)) * 100).toFixed(2);

            plugin.settings.onProgress(percentScrolled);

        });
        
        s.success.call(this);

    }

})(jQuery);