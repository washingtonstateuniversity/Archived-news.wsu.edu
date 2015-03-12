(function($){

	$(document).ready(function() {
		
		$("img.aside").removeClass("aside").parents("figure").addClass("aside");
	
		//var opened = $(".news-section.opened").attr("data-sec");
		
		function flipLeft(indexical) {
					
			if ( indexical === undefined ) { indexical = $(".news-section.opened").attr("data-sec"); }
			var disclosure = ( $('.section[data-sec="'+indexical+'"]').hasClass("opened") ) ? "opened" : "unopened";
				
			if ( disclosure === "unopened" ) {
			
				$(".section").removeClass("opened");
				
				$(".section").each( function() {
				
					if ( ( $(this).attr("data-sec") < indexical ) && ( $(this).attr("data-sec") !== "6" ) ) {
					  //$(this).removeClass("delivered");
					  $(this).animate({left: "-1000px"}, {duration:500, queue:false});
					}
				
				});
				
				$(".section-tab").each( function() {
					if ( $(this).attr("data-sec") < indexical ) {
					  $(this).delay(300).show( "blind",{direction: "horizontal"}, 100 );
					}
				});
				
				$('.section[data-sec="'+indexical+'"]').addClass("opened");
			
			} 
			else if ( indexical !== "1" ) {
			
				flipRight(indexical-1);
			
			} 
			
		}
		
		function flipRight(indexical) {
			
			if ( indexical === undefined ) { indexical = $(".news-section.opened").attr("data-sec"); }
			//alert(indexical);
				
			$(".section").removeClass("opened");
			
			$(".section").each( function() {
			
				if ( ( $(this).attr("data-sec") >= indexical ) && ( $(this).attr("data-sec") !== "6" )  ) {
				  $(this).animate({left: "0px"}, {duration:300, queue:false});
			  	}
				if ( $(this).attr("data-sec") === indexical ) {
				  $(this).addClass("opened");
			  	}
			
			});
			
			$(".section-tab").each( function() {
				if (  $(this).attr("data-sec") >= indexical ) {
				  $(this).hide();
				}
		  	});
		  				
			$('.section[data-sec="'+indexical+'"]').addClass("opened");  
		  
		} // End flipRight
		
		flipLeft();
		
		$(window).on( "swipeleft", function() {
	
			var disclosed = $(".news-section.opened").attr("data-sec");
			flipLeft(disclosed + 1);
			
		});
		
		$(window).on( "swiperight", function() {
			
			flipRight();
					
		});
		
		$( ".section-tab" ).click(function() {
	  
		  	var indexical = $(this).attr("data-sec");
			flipRight(indexical);
				  
		});
	
		
		$( ".section-header" ).click(function() {
	  
			var indexical = $(this).parents(".section").attr("data-sec");
			flipLeft(indexical);
			
		});
		
		$( ".opened .section-header" ).click(function() {
	  
			var indexical = $(this).parents(".section").attr("data-sec");
			flipRight(indexical);
			
		});
	
	});

	setTimeout(function() {
		$("body.single #spine .spine-share ul").clone().addClass("spine-share looseleaf").prependTo(".story");
		$(".spine-share.looseleaf li a").wrapInner("<span class='channel-title'></div>");
		$(".spine-share.looseleaf").wrap("<div class=\"spine-share-position\"></div>");
	}, 500);

//var window_height $(window).height();

})(jQuery);

(function($){

	$(document).ready(function() {
	
		jQuery("#menu-item-13").addClass("active").addClass("dogeared").parents("li").addClass("active");
		
	});

})(jQuery);

jQuery("#menu-item-13").addClass("active").spine("setup_nav");