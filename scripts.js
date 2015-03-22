(function($){
		
	function flipLeft(indexical) {
		
		var sectional = false;
		
		if ( indexical === undefined ) { indexical = $(".news-section.opened").attr("data-sec"); sectional = true; }
		
		var disclosure = ( $('.section[data-sec="'+indexical+'"]').hasClass("opened") ) ? "opened" : "unopened";
		
		jacketHeight(indexical);
		
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
				
				$("body:not(.single)").addClass("verso-"+( indexical - 1 ));
	
			}

	}
	
	function flipRight(indexical) {
		
		if ( indexical === undefined ) { indexical = $(".news-section.opened").attr("data-sec"); }
			
		$(".section").removeClass("opened");
		
		$(".section:not(.photo)").each( function() {
		
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
		
		//jacketHeight();
		
		$("body").removeClass("verso-0 verso-1 verso-2 verso-3 verso-4 verso-5");
		
		if ( indexical !== "1" ) {
			
			//alert(indexical);
			$("body:not(.single)").addClass("verso-"+( indexical - 1));
			
		}
		
	  
	} // End flipRight
	
	function jacketHeight(section) {
		
		//alert(section);
		//$('.section[data-sec="'+section+'"] .articles, .section[data-sec="'+section+'"] .section-side').removeAttr("style");
		//var opened_height = $('.section[data-sec="'+section+'"] .enclosure').height();
		//$("#jacket").css("max-height",opened_height);
		
		}
	
	function pageTop() {
		
		$('html, body').animate({
	        scrollTop: $("main").offset().top
	    }, 200);
	}

	$(document).ready( function() {
		
		jacketHeight();
	
		var xl_current_width = $(window).width();
	
		if ( xl_current_width >= 1396 ) {
			$("#jacket").addClass("size-gt-xlarge");
		} else {
			$("#jacket").addClass("size-lt-xxlarge");
		}

		
		$("img.aside").removeClass("aside").parents("figure").addClass("aside");
	
		//var opened = $(".news-section.opened").attr("data-sec");
		
			
		$(window).on( "swipeleft", function() {
	
			//var disclosed = $(".news-section.opened").attr("data-sec");
			//flipLeft(disclosed + 1);
			
		});
		
		
		
		$("body,html").on( "swiperight", function() {
			
			//flipRight();
					
		});
		
		$( ".section-tab" ).click(function() {
	  
		  	var indexical = $(this).attr("data-sec");
			flipRight(indexical);
			pageTop();
				  
		});
		
		$( "main > .sections .section-header" ).click(function() {
			
			var indexical = $(this).parents(".section").attr("data-sec");
			flipLeft(indexical);
			pageTop();
			
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
		
		$( "html,body" ).scroll(function() {
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
	

// Docs at http://simpleweatherjs.com
$(document).ready(function() {
  $.simpleWeather({
    location: 'Pullman, WA',
    woeid: '',
    unit: 'f',
    success: function(weather) {
      html = '<div><i class="icon-'+weather.code+'"></i> '+weather.temp+'&deg;'+weather.units.temp+'<span class="currently"> '+weather.currently+'</span></div>';
      //html += '<ul><li>'+weather.city+', '+weather.region+'</li>';
      //html += '<li class="currently">'+weather.currently+'</li>';
  
      $("#menu-locales li:first-of-type").append(html);
    },
    error: function(error) {
      $("#menu-locales li:first-of-type").html('<p>'+error+'</p>');
    }
  });
  
  var html;
  
  $.simpleWeather({
    location: 'Vancouver, WA',
    woeid: '',
    unit: 'f',
    success: function(weather) {
      html = '<div><i class="icon-'+weather.code+'"></i> '+weather.temp+'&deg;'+weather.units.temp+'<span class="currently"> '+weather.currently+'</span></div>';
  
      $("#menu-locales li:nth-of-type(2)").append(html);
    },
    error: function(error) {
      $("#menu-locales li:nth-of-type(2)").html('<p>'+error+'</p>');
    }
  });
  
  $.simpleWeather({
    location: 'Spokane, WA',
    woeid: '',
    unit: 'f',
    success: function(weather) {
      html = '<div><i class="icon-'+weather.code+'"></i> '+weather.temp+'&deg;'+weather.units.temp+'<span class="currently"> '+weather.currently+'</span></div>';
  
      $("#menu-locales li:nth-of-type(3)").append(html);
    },
    error: function(error) {
      $("#menu-locales li:nth-of-type(3)").html('<p>'+error+'</p>');
    }
  });
  
  $.simpleWeather({
    location: 'Tri Cities, WA',
    woeid: '',
    unit: 'f',
    success: function(weather) {
      html = '<div><i class="icon-'+weather.code+'"></i> '+weather.temp+'&deg;'+weather.units.temp+'<span class="currently"> '+weather.currently+'</span></div>';
  
      $("#menu-locales li:nth-of-type(4)").append(html);
    },
    error: function(error) {
      $("#menu-locales li:nth-of-type(4)").html('<p>'+error+'</p>');
    }
  });
  
});
	
})(jQuery);




(function($){
	if ( $('.home' ).length > 0 ) {
		$('.wsuwp-json-content' ).each(function(){
			var container = $(this);
			var source_data_obj = $(this ).data('source');
			var source_data = window[source_data_obj];

			var json_html = '<ul>';
			for ( var item in source_data ) {
				json_html += '<li><a href="' + source_data[item ].link + '">' + source_data[item].title + '</a></li>';
			}
			json_html += '</ul>';
			container.append( json_html );
		});
	} else {
		$('.wsuwp-json-content' ).each(function(){
			var container = $(this);
			var source_data_obj = $(this ).data('source');
			var source_data = window[source_data_obj];

			for ( var item in source_data ) {
				var cob_excerpt = source_data[item ].content.split('<!--more-->');
				container.append( '<div><h2><a href="' + source_data[item ].link + '">' + source_data[item].title + '</a></h2>' + cob_excerpt[0] + '</div>');
			}
		});
	}

}(jQuery));

(function($){

	$(document).ready(function() {
	
		jQuery("#menu-item-13").addClass("active").addClass("dogeared").parents("li").addClass("active");
		
	});

})(jQuery);

jQuery("#menu-item-13").addClass("active").spine("setup_nav");