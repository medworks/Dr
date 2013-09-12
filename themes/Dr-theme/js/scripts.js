/*
* Theme Name: Dr - Responsive vCard Template
* Author: Mediateq
* Author URL: http://www.mediateq.ir
*/
jQuery(document).ready(function(){ 
    // --------------------------------------------------------------------------
	// Pages Changer ------------------------------------------------------------
	// --------------------------------------------------------------------------
	$(function() {			
		$( '#jms-slideshow' ).jmslideshow();
	});

	// Detect mobile devices. If mobile = true then animation mode = 2D mode
	if(jQuery.browser.mobile) {
		
		$.JMSlideshow.defaults 		= {
			// options for the jmpress plugin.
			// you can add much more options here. Check http://shama.github.com/jmpress.js/
			jmpressOpts	: {
				// set the viewport
				viewPort 		: {
					maxScale: 1
				},
				start: '#home',
				fullscreen		: false,
				hash			: { use : true },
				hash            : { update : false },
				mouse			: { clickSelects : false },
				keyboard		: { use : false },
				animation		: { transitionDuration : false },
			},
			// slideshow on / off
			autoplay	: false,
	    };		
	}

	// --------------------------------------------------------------------------
	// jScrollpane --------------------------------------------------------------
	// --------------------------------------------------------------------------	
	$('#jms-content').jScrollPane({ autoReinitialise: true, hijackInternalLinks: true })
	$('#jms-content2').jScrollPane({ autoReinitialise: true, hijackInternalLinks: true })
    $('#jms-content3').jScrollPane({ autoReinitialise: true, hijackInternalLinks: true })
    $('#jms-content4').jScrollPane({ autoReinitialise: true, hijackInternalLinks: true })
	$('#jms-content5').jScrollPane({ autoReinitialise: true, hijackInternalLinks: true })
	
	// --------------------------------------------------------------------------
	// Main Menu ----------------------------------------------------------------
	// --------------------------------------------------------------------------
    $('#nav li > a').click(function() {
	    $('#nav li').removeClass();
	    $(this).parent().addClass("active");
    });

});