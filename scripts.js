(function($){
		
	function flipLeft(indexical) {
		
		var sectional = false;
		
		if ( indexical === undefined ) { indexical = $(".news-section.opened").attr("data-sec"); sectional = true; }
		
		var disclosure = ( $('.section[data-sec="'+indexical+'"]').hasClass("opened") ) ? "opened" : "unopened";
		
		$(".section").removeClass("opened");
		
		if ( disclosure !== "opened" || sectional === true ) {
		
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
		else if ( indexical !== "1" || sectional === "true" ) {
		
			flipRight(indexical - 1);
		
		}
		

		$("body").removeClass("verso-0 verso-1 verso-2 verso-3 verso-4 verso-5");
			
		if ( indexical !== "2" && indexical !== "1" ) {
				
				$("body").addClass("verso-"+( indexical - 1 ));
	
			}

	}
	
	function flipRight(indexical) {
		
		if ( indexical === undefined ) { indexical = $(".news-section.opened").attr("data-sec"); }
			
		$(".section").removeClass("opened");
		
		$(".section:not(.views)").each( function() {
		
			if ( ( $(this).attr("data-sec") >= indexical ) && ( $(this).attr("data-sec") !== "6" )  ) {
			  $(this).animate({left: "0px"}, {duration:300, queue:false});
		  	}
			if ( $(this).attr("data-sec") === indexical ) {
			  $(this).addClass("opened");
		  	}
/*
		  	
		  	var section_adjustment = $(this).width() + ( 40 * indexical );
				  $(this).css("width", section_adjustment);
*/
		
		});
		
		$(".section-tab").each( function() {
			if (  $(this).attr("data-sec") >= indexical ) {
			  $(this).hide();
			}
	  	});
	  				
		$('.section[data-sec="'+indexical+'"]').addClass("opened");  
		
		$("body").removeClass("verso-0 verso-1 verso-2 verso-3 verso-4 verso-5");
		
		if ( indexical !== "1" ) {
			
			//alert(indexical);
			$("body").addClass("verso-"+( indexical - 1));
			
		}
	  
	} // End flipRight	

	$(document).ready( function() {
	
		var xl_current_width = $(window).width();
	
		if(xl_current_width >= 1396) {
			$("#jacket").addClass("size-gt-xlarge");
		} else {
			$("#jacket").addClass("size-lt-xxlarge");
		}

		
		$("img.aside").removeClass("aside").parents("figure").addClass("aside");
	
		//var opened = $(".news-section.opened").attr("data-sec");
		
			
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
	
		$( ".photo figure" ).click(function(e) {
		
			var pWidth = $(this).innerWidth();
			var pOffset = $(this).offset(); 
			var x = e.pageX - pOffset.left;
			if( pWidth/2 > x ) {
			    //console.log("left");
			    $(this).next("figure").animate({left: "0px"}, {duration:500, queue:false});
			} else {
			    //console.log("right");
			    $(this).animate({left: "-2000px"}, {duration:500, queue:false});
			}
		
		});
		
		$( ".paddle" )
		
		.mouseenter( function() {
			
			var paddle = $(this).attr("role");
			$(this).addClass("focused").parents("figure").addClass("focused-"+paddle);
			
			
		})
		
		.mouseleave( function() {
			
			$(this).removeClass("focused");
			$(this).parents("figure").removeClass("focused-next focused-previous");
		
		});
		
/*
		$( ".opened .section-header" ).click(function() {
	  
			var indexical = $(this).parents(".section").attr("data-sec");
			flipRight(indexical-1);
			
		});
*/
		
		flipLeft();
	
	});

	setTimeout(function() {
		$("body.single #spine .spine-share ul").clone().addClass("spine-share looseleaf").prependTo(".story");
		$(".spine-share.looseleaf li a").wrapInner("<span class='channel-title'></div>");
		$(".spine-share.looseleaf").wrap("<div class=\"spine-share-position\"></div>");
	}, 500);

	
})(jQuery);

(function($){

	$(document).ready(function() {
	
		jQuery("#menu-item-13").addClass("active").addClass("dogeared").parents("li").addClass("active");
		
	});

})(jQuery);

jQuery("#menu-item-13").addClass("active").spine("setup_nav");