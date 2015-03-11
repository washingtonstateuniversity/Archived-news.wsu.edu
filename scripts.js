(function($){

$(document).ready(function() {
	
	$("img.aside").removeClass("aside").parents("figure").addClass("aside");

	
	$( ".section.current" ).click(function() {
		
		});
	
	$(window).on( "swipeleft", function() { 
						
		if ( $("#jacket").not(".size-lt-large") ) {
		
			var disclosed = $(".news-section.opened").attr("data-sec");
			
			$(".section").removeClass("opened");
  
			$(".section").each( function() {
			
				if ( $(this).attr("data-sec") < disclosed + 1 ) {
				  $(this).animate({left: "-1000px"}, {duration:500, queue:false});
				}
			
			});
		
			$(".section-tab").each( function() {
				if ( $(this).attr("data-sec") < disclosed ) {
				  $(this).delay(300).show( "blind",{direction: "horizontal"}, 100 );
				}
			});
		
		}
		
	});

	
	$( ".section-header, .section-photo:not(.opened) figure" ).click(function() {
  
	var section = $(this).parents(".section").attr("data-sec");
	var disclosure = ( $(this).parents(".section").hasClass("opened") ) ? "opened" : "unopened";
	//var medium = ( $("#jacket").hasClass("size-medium") ) ? true : false;
		
	if ( disclosure === "unopened" && !( $("#jacket").hasClass("size-lt-large") ) ) {
		
		$(".section").removeClass("opened");
  
		$(".section").each( function() {
		
			if ( $(this).attr("data-sec") < section ) {
			  $(this).animate({left: "-1000px"}, {duration:500, queue:false});
			}
		
		});
		
		$(".section-tab").each( function() {
			if ( $(this).attr("data-sec") < section ) {
			  $(this).delay(300).show( "blind",{direction: "horizontal"}, 100 );
			}
		});
		
	$(this).parents(".section").addClass("opened");
			
	} else if ( section !== "1" ) {
		
		$(".section").removeClass("opened");
		$('.sections [data-sec="'+(section-1)+'"]').animate({left: "0px"}, {duration:500, queue:false}).addClass("opened");
		$('.section-tabs [data-sec="'+(section-1)+'"]').delay(300).hide( "blind",{direction: "horizontal"}, 100 );
		
	} 

  $("body").spine("equalize");
  
  // Lefthand Sections
  $( ".section-tab" ).click(function() {
  
	  $("main .section").removeClass("opened");
	  var section = $(this).attr("data-sec");
	  
	  $("main .news-section:not(.photo)").each( function() {
		  if ( ( $(this).attr("data-sec") >= section ) && ( section !== "6" )  ) {
			  $(this).animate({left: "0px"}, {duration:300, queue:false});
		  }
		  if ( $(this).attr("data-sec") === section ) {
			  $(this).addClass("opened");
		  }
	
	  });
	  
	  $(".section-tab").each( function() {
		  if (  $(this).attr("data-sec") >= section  ) {
			  $(this).hide();
		  }
	  });
	  
	  $(this).parents(".section").addClass("opened");
	  $("body").spine("equalize");
	  
	});
  
  
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