(function( $, undefined ) {
		
	/*
	 * JMSlideshow object
	 */
	$.JMSlideshow 				= function( options, element ) {
		
		// the jms-slideshow
		this.$el	= $( element );
		
		this._init( options );
		
	};
	
	$.JMSlideshow.defaults 		= {
		// options for the jmpress plugin.
		// you can add much more options here. Check http://shama.github.com/jmpress.js/
		jmpressOpts	: {
			// set the viewport
			viewPort 		: {
				maxScale: 1
			},
			fullscreen		: false,
			hash			: { use : true },
			hash            : { update : false },
			mouse			: { clickSelects : false },
			keyboard		: { use : false },
			animation		: { transitionDuration : '1s' }
		},
		// slideshow on / off
		autoplay	: false,
    };
	
	$.JMSlideshow.prototype 	= {
		_init 				: function( options ) {
			
			this.options 		= $.extend( true, {}, $.JMSlideshow.defaults, options );
			
			// each one of the slides
			this.$slides		= $('#jms-slideshow').children('div');
			// total number of slides
			this.slidesCount	= this.$slides.length;
			// build the necessary structure to run jmpress
			this._layout();
			// initialize the jmpress plugin
			this._initImpress();
			// if support (function implemented in jmpress plugin)
			if( this.support ) {
	
							
			}
			
		},
		// wraps all the slides in the jms-wrapper div;
		// adds the navigation options ( arrows and dots ) if set to true
		_layout				: function() {
			
			// adds a specific class to each one of the steps
			this.$slides.each( function( i ) {
			
				$(this).addClass( 'jmstep' + ( i + 1 ) );
			
			} );
			
			// wrap the slides. This wrapper will be the element on which we will call the jmpress plugin
			this.$jmsWrapper	= this.$slides.wrapAll( '<div class="jms-wrapper"/>' ).parent();
				
		},
		// initialize the jmpress plugin
		_initImpress		: function() {
			
			var _self = this;
			
			this.$jmsWrapper.jmpress( this.options.jmpressOpts );
			// check if supported (function from jmpress.js):
			// it adds the class not-suported to the wrapper
			this.support	= !this.$jmsWrapper.hasClass( 'not-supported' );
			
			
			
		},
		

	};
	
	var logError 			= function( message ) {
		if ( this.console ) {
			console.error( message );
		}
	};
	
	$.fn.jmslideshow		= function( options ) {
	
		if ( typeof options === 'string' ) {
			
			var args = Array.prototype.slice.call( arguments, 1 );
			
			this.each(function() {
			
				var instance = $.data( this, 'jmslideshow' );
				
				if ( !instance ) {
					logError( "cannot call methods on jmslideshow prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for jmslideshow instance" );
					return;
				}
				
				instance[ options ].apply( instance, args );
			
			});
		
		} 
		else {
		
			this.each(function() {
			
				var instance = $.data( this, 'jmslideshow' );
				if ( !instance ) {
					$.data( this, 'jmslideshow', new $.JMSlideshow( options, this ) );
				}
			});
		
		}
		
		return this;
		
	};
	
	
	
})( jQuery );

