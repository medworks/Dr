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

    // --------------------------------------------------------------------------
	// building select nav for mobile width only --------------------------------
	// --------------------------------------------------------------------------
    $('#dd_menu').change(function() {
        window.location = $(this).val();
    });
	
    // --------------------------------------------------------------------------
	// Location Update --------------------------------
	// --------------------------------------------------------------------------
    $(document).ready(function(){
        if(document.location.hash){
              window.location = "";
        }
    });

    // --------------------------------------------------------------------------
	// Portfolio ----------------------------------------------------------------
	// --------------------------------------------------------------------------
	// Clone portfolio items to get a second collection for Quicksand plugin
	var $portfolioClone = $(".portfolio").clone();
	
	// Attempt to call Quicksand on every click event handler
	$(".filter a").click(function(e){
		
		$(".filter li").removeClass("current");	
		
		// Get the class attribute value of the clicked link
		var $filterClass = $(this).parent().attr("class");

		if ( $filterClass == "all" ) {
			var $filteredPortfolio = $portfolioClone.find("li");
		} else {
			var $filteredPortfolio = $portfolioClone.find("li[data-type~=" + $filterClass + "]");
		}
		
		// Call quicksand
		$(".portfolio").quicksand( $filteredPortfolio, { 
			duration: 800, 
			easing: 'easeInOutQuad' 
		}, function(){
			
			// Blur newly cloned portfolio items on mouse over and apply prettyPhoto
			$(".portfolio a").hover( function(){ 
				$(this).children("img").animate({ opacity: 0.75 }, "fast"); 
			}, function(){ 
				$(this).children("img").animate({ opacity: 1.0 }, "slow"); 
			}); 
			
			$(".portfolio a[data-rel^='prettyPhoto']").prettyPhoto({
		        social_tools:'',
		        deeplinking:false,
		        theme: 'light_square'
			});
		});


		$(this).parent().addClass("current");

		// Prevent the browser jump to the link anchor
		e.preventDefault();
	})

	// --------------------------------------------------------------------------
	// prettyPhoto --------------------------------------------------------------
	// --------------------------------------------------------------------------	
	$("a.prettyPhoto").prettyPhoto({
		social_tools:'',
		deeplinking:false,
		theme: 'light_square'
	});
	
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto(); 

});