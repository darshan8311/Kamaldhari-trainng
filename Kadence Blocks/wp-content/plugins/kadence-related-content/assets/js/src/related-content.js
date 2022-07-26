/* global tns */
/**
 * File slide-init.js.
 * Gets slide going when needed.
 */

(function() {
	'use strict';
	window.kadenceRelatedSlide = {
		/**
		 * Initiate the script to process all
		 */
		start: function( element ) {
			var slideRtl = 'ltr',
			sliderType = element.getAttribute('data-slider-type'),
			sliderSpeed = parseInt( element.getAttribute( 'data-slider-speed' ) ),
			sliderAnimationSpeed = parseInt( element.getAttribute( 'data-slider-anim-speed' ) ),
			sliderArrows = element.getAttribute( 'data-slider-arrows' ),
			sliderDots = element.getAttribute( 'data-slider-dots' ),
			sliderPause = element.getAttribute( 'data-slider-pause-hover' ),
			sliderAuto = element.getAttribute( 'data-slider-auto' ),
			xxl = parseInt( element.getAttribute( 'data-columns-xxl' ) ),
			xl = parseInt( element.getAttribute( 'data-columns-xl' ) ),
			md = parseInt( element.getAttribute( 'data-columns-md' ) ),
			sm = parseInt( element.getAttribute( 'data-columns-sm' ) ),
			xs = parseInt( element.getAttribute( 'data-columns-xs' ) ),
			ss = parseInt( element.getAttribute( 'data-columns-ss' ) ),
			gutter = parseInt( element.getAttribute( 'data-slider-gutter' ) ),
			scroll = parseInt( element.getAttribute( 'data-slider-scroll' ) ),
			slidercenter = element.getAttribute( 'data-slider-center-mode' );
			if ( document.body.classList.contains( 'rtl' ) ) {
				slideRtl = 'rtl';
			}
			if ( 1 !== scroll ) {
				scroll = 'page'
			}
			var slider = tns( {
				container: element,
				items: ss,
				slideBy: scroll,
				autoplay: ( 'true' === sliderAuto ? true : false ),
				speed: sliderAnimationSpeed,
				autoplayTimeout: sliderSpeed,
				autoplayHoverPause: ( 'true' === sliderPause ? true : false ),
				controls: ( 'false' === sliderArrows ? false : true ),
				nav: ( 'false' === sliderDots ? false : true ),
				gutter: gutter,
				textDirection: slideRtl,
				responsive: {
					543: {
						items: xs
					},
					767: {
						items: sm
					},
					991: {
						items: md
					},
					1199: {
						items: xl
					},
					1499: {
						items: xxl
					}
				}
			} );
		},
		/**
		 * Initiate the script to process all
		 */
		initAll: function( element ) {
			document.querySelectorAll( '.kt_rc_carousel_init' ).forEach(function ( element ) {
				window.kadenceRelatedSlide.start( element );
			} );
		},
		// Initiate the menus when the DOM loads.
		init: function() {
			if ( typeof tns == 'function' ) {
				window.kadenceRelatedSlide.initAll();
			} else {
				var initLoadDelay = setInterval( function(){ if ( typeof tns == 'function' ) { window.kadenceRelatedSlide.initAll(); clearInterval(initLoadDelay); } }, 200 );
			}
		}
	}
	if ( 'loading' === document.readyState ) {
		// The DOM has not yet been loaded.
		document.addEventListener( 'DOMContentLoaded', window.kadenceRelatedSlide.init );
	} else {
		// The DOM has already been loaded.
		window.kadenceRelatedSlide.init();
	}
})();
