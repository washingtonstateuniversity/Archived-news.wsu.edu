(function($){
		
	function flipLeft(indexical) {
		
		if ( $('.size-gt-small').length ) {
		
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
			
			if ( $(".main-body .sections").length ) {
			
				$("body").removeClass("verso-0 verso-1 verso-2 verso-3 verso-4 verso-5");
					
				if ( indexical !== "2" && indexical !== "1" ) {
						
						$("body:not(.single)").addClass("verso-"+( indexical - 1 ));
			
				}
			
			}
		
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
				
		if ( $(".main-body .sections").length ) {
		
			$("body").removeClass("verso-0 verso-1 verso-2 verso-3 verso-4 verso-5");
			
			if ( indexical !== "1" ) {
				
				//alert(indexical);
				$("body:not(.single)").addClass("verso-"+( indexical - 1));
				
			}
		
		}
		
	  
	} // End flipRight
	
	function pageTop() {
		
		$('html, body').animate({
	        scrollTop: $("main").offset().top
	    }, 200);
	}
	
	function imageWrap() {
		
		$("article img").each( function() {
			
			var img_classes = $(this).attr("class");
			var img_src = $(this).attr("src");
			
			if ( !$(this).parent().is("figure") && !$(this).parent().is("a")  ) {
				
				$(this).unwrap("p").wrap('<figure class="figure-auto figure-back '+img_classes+'" style="background-image: url(\''+img_src+'\')"></figure>');
				
			} else {
				
				$(this).parent("figure").removeAttr("style").addClass("figure-norm figure-back").addClass(img_classes).css("background-image","url('"+img_src+"')");
				
			}
		
		});
	
	}
	
	function plates(plated) {
		
		//$(plated).addClass("plated").parents("figure").wrap("<div class=\"rim\">").wrap("<div class=\"charger\">");
		
		var src = $(plated).attr("href");
		$("main").prepend('<div class="plate" style="background-image: url('+src+');"><div class="frame"></div></div>');
		
		
		//alert("hello");
		$(".plate").on("click", function() {
			
			
			$(this).remove();
		
		});
		
	}

	$(document).ready( function() {
		
		$('a[href$=".jpg"]').on("click", function(e) {
			
			e.preventDefault();
			var plated = $(this);
			
			plates(plated);
		});
		
		$(function() {      
      $("#test").swipe( {
        //Generic swipe handler for all directions
        swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
          $(this).text("You swiped " + direction );  
        }
      });
    });
		
		// Wrap Images with figure
		if ( $("body.single").length || $("body.page").length ) {
		
			imageWrap();
		
		}
		
		$("img.aside").removeClass("aside").parents("figure").addClass("aside");
		
		
		// Expand binder size for xxlarge widths
		var xl_current_width = $(window).width();
	
		if ( xl_current_width >= 1396 ) {
			$("#jacket").addClass("size-gt-xlarge");
		} else {
			$("#jacket").addClass("size-lt-xxlarge");
		}

		
		
		//var opened = $(".news-section.opened").attr("data-sec");
		
			
		$("html").on("swipeleft", function() {
	
			var disclosed = $(".section.opened").attr("data-sec");
			flipLeft(disclosed + 1);
			throw("left");

		});
		
		$("html").on("swiperight", function() {
			
			var disclosed = $(".section.opened").attr("data-sec");
			flipRight(disclosed);
			throw("right");
					
		});
		
		$( ".section-tab" ).click(function() {
	  
		  	var indexical = $(this).attr("data-sec");
			flipRight(indexical);
			pageTop();
				  
		});
		
		$( ".main-body .sections .section-header" ).click(function() {
			
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
			    $(this).next("figure").removeClass("lain-left").addClass("lain-right").animate({left: "0px"}, {duration:500, queue:false});
			} else {
			    //console.log("right");
			    $(this).not(":first-of-type").removeClass("lain-right").addClass("lain-left").animate({left: "-2000px"}, {duration:500, queue:false}).prev("figure").addClass("lain-right");
			}
		
		});
		
		$( ".photo figure:last-of-type .next" ).click(function() {
		
			$("section.photo").addClass("lain");
		
		});
		
		$( ".photo figure:nth-last-of-type(2) .previous" ).click(function() {
		
			$("section.photo").removeClass("lain");
		
		});
				
		flipLeft();
			
	});

	setTimeout(function() {
		
		
		// Tablepress
		if ( $('.dataTables_wrapper input[type="search"]').length ) {
			
			var search_input = $('.dataTables_wrapper input[type="search"]').detach();
			$('.dataTables_wrapper .dataTables_filter').prepend(search_input);
			$('.dataTables_wrapper .dataTables_filter input[type="search"]').attr("placeholder","Filter");
			
		}
		
		if ( $('table.tablepress').length ) {
			
			$('.column-2').each( function() {
				
				if ( $(this).is(":empty") && $(this).siblings(".column-3").is(":empty") ) {
					
					$(this).parents("tr").addClass("table-section-header");
					
				}
				
			});
			
		}		
		
		// Sharing
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
  
      $("#menu-local li:first-of-type").append(html);
    },
    error: function(error) {
      $("#menu-local li:first-of-type").html('<p>'+error+'</p>');
    }
  });
  
  var html;
  
  $.simpleWeather({
    location: 'Vancouver, WA',
    woeid: '',
    unit: 'f',
    success: function(weather) {
      html = '<div><i class="icon-'+weather.code+'"></i> '+weather.temp+'&deg;'+weather.units.temp+'<span class="currently"> '+weather.currently+'</span></div>';
  
      $("#menu-local li:nth-of-type(2)").append(html);
    },
    error: function(error) {
      $("#menu-local li:nth-of-type(2)").html('<p>'+error+'</p>');
    }
  });
  
  $.simpleWeather({
    location: 'Spokane, WA',
    woeid: '',
    unit: 'f',
    success: function(weather) {
      html = '<div><i class="icon-'+weather.code+'"></i> '+weather.temp+'&deg;'+weather.units.temp+'<span class="currently"> '+weather.currently+'</span></div>';
  
      $("#menu-local li:nth-of-type(3)").append(html);
    },
    error: function(error) {
      $("#menu-local li:nth-of-type(3)").html('<p>'+error+'</p>');
    }
  });
  
  $.simpleWeather({
    location: 'Tri Cities, WA',
    woeid: '',
    unit: 'f',
    success: function(weather) {
      html = '<div><i class="icon-'+weather.code+'"></i> '+weather.temp+'&deg;'+weather.units.temp+'<span class="currently"> '+weather.currently+'</span></div>';
  
      $("#menu-local li:nth-of-type(4)").append(html);
    },
    error: function(error) {
      $("#menu-local li:nth-of-type(4)").html('<p>'+error+'</p>');
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