(function($) {
    $.fn.ktWidgetdock = function( options ){     
        var defaults = {    
            slidein: 'delay',
            slideindelay: '2000',
            slidescroll: 500,
            cookieslug: 'kt_widget_dock',
            container: this,
            useCookie: 'true',
            cookieExpires: 30,
            cookieUnit: 'days',
            manageCookieLoad:true  
        };
        var opts = $.extend( defaults, options );
        // if using cookies and using JavaScript to load css
        if (opts.useCookie === 'true' && opts.manageCookieLoad) {
            // check if css is set in cookie
            var isCookie = readCookie(opts.cookieslug);
            if(isCookie){
                opts.slidein = 'false';
            } 
        }
        // if using slidein
        if(opts.slidein === 'delay'){
             $(opts.container).delay(opts.slideindelay).queue(function(next){
                    next();
                    $(opts.container).addClass('kt-active-box');
                });
        } else if(opts.slidein === 'scroll'){
            $(window).scroll(function() {
            	var scroll = $(window).scrollTop();
                if ( scroll >= opts.slidescroll ) {
                    $(opts.container).addClass('kt-active-box');
                }
            });
        } else if (opts.slidein === 'after') {
            var afterlength = $(".kt-load-after-post").length;
            if( afterlength > 0 ) {
                var scrolllength  = $(".kt-load-after-post").offset().top - 500;
                $(window).scroll(function() {   
                var scroll = $(window).scrollTop();
                    if (scroll >= scrolllength) {
                        $(opts.container).addClass('kt-active-box');
                    }
                });
            }
        }
        
        $(opts.container).find(".kt-widget-dock-close").click(function () {
                $(opts.container).addClass('kt-dismiss-box');
                $(opts.container).removeClass('kt-active-box');
                if ( opts.useCookie ) {
                    createCookie( opts.cookieslug,'1',opts.cookieExpires, opts.cookieUnit )
                }
            }
        );
        
    };
    function createCookie( name, value, length, unit ) {
        if ( length ) {
            var date = new Date();
            if ( 'minutes' == unit ) {
            	date.setTime(date.getTime() + ( length * 60 * 1000 ) );
            } else if ( 'hours' == unit ) {
            	date.setTime(date.getTime() + ( length * 60* 60 * 1000 ) );
            } else {
            	date.setTime(date.getTime()+(length*24*60*60*1000));
            }
            var expires = "; expires="+date.toGMTString();
        } else {
            var expires = "";
        }

        document.cookie = name+"="+value+expires+"; path=/";
    }  
    function readCookie(name) {
    	 var b = document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)');
    	return b ? b.pop() : null;
    }   
})(jQuery);

jQuery(document).ready(function($) {
    var $container = $("#kt-widget-dock");
    if($container.length){
        var $slidein = $container.attr('data-slidein'),
            $slidein_delay = $container.attr('data-slidein-delay'),
            $slidein_scroll = $container.attr('data-slidein-scroll'),
            $usecookie = $container.attr('data-usecookie'),
            $cookie_slug = $container.attr('data-cookie-slug');
			$cookie_length = $container.attr('data-cookie-length');
			$cookie_unit = $container.attr('data-cookie-length-unit');

        $container.ktWidgetdock({
            useCookie:$usecookie,
            cookieslug: $cookie_slug,
            cookieExpires: $cookie_length,
            cookieUnit: $cookie_unit,
            slidein:$slidein,
            slideindelay:$slidein_delay,
            slidescroll:$slidein_scroll,
        });
    }
});