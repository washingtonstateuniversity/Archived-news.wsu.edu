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
					  //var section_width = $(this).width() + 33;
					  $(this).animate({"left":"-1000px"}, 500 ).addClass("lain-left");
					}
				
				});
				
				$(".section-tab").each( function() {
					if ( $(this).attr("data-sec") < indexical ) {
					  $(this).delay(300).show( "blind",{direction: "horizontal"}, 100 );
					}
				});
				
				$('.section[data-sec="'+indexical+'"]').delay(500).addClass("opened");
			  
				
			}
			
			else if ( indexical !== "1" || sectional === "true" ) {
			
				flipRight(indexical - 1);
			
			}
			
			if ( $(".main-body .sections").length ) {
			
				$("body").removeClass("verso-0 verso-1 verso-2 verso-3 verso-4 verso-5");
					
				if ( indexical !== "1" ) {
						
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
			  $(this).removeClass("lain-left").animate({left: "0px"}, {duration:300, queue:false});
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
	
	function tipIn(tip,attr) {
		
		var img_src = $(tip).attr(attr);
		if ( attr === "src" ) { img_src = img_src.replace("-198x198", ""); }
		var img_width = $(tip).first("img").clientWidth;
		var img_height = $(tip).first("img").clientHeight;
		var img_classes = $(tip).attr("classes");
		var viewport_width = $(window).width();
		var viewport_height = $(window).height();
		var img_ratio = ( img_width > img_height ) ? "img-landscape" : "img-portrait";
		var viewport_ratio = ( viewport_width > viewport_height ) ? "viewport-landscape" : "viewport-portrait";
		
		$("body").addClass(viewport_ratio);
		$("main").prepend('<div class="tipped '+img_ratio+' '+img_classes+'" style="background-image: url('+img_src+');"><div class="frame"></div><button class="fit"></button></div>');
		
		$(".tipped").addClass("in").on("click", function() {
			
			$(this).addClass("out").delay(2000).queue(function(next){
			
				$(this).remove(); next();
				$("body").removeClass("viewport-landscape viewport-portrait");

			});
		
		});
		
		$(".tipped .fit").on("click", function(e) {
			
			e.stopPropagation();
			$(this).parents(".tipped").toggleClass("fit");
			
		});
		
	}
	
	flipLeft();

	$(document).ready( function() {
		
		$('a[href$=".jpg"]').on("click", function(e) {
			
			e.preventDefault();
			var tip = $(this);
			tipIn(tip,"href");
		
		});
		
		$('.gallery-icon a[href^="http"] img').on("click", function(e) {
			
			e.preventDefault();
			var tip = $(this);
			tipIn(tip,"src");
		
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
		
		$("body").swipe( {
			
			swipeLeft:function() {
				
				var opened = $(".section.opened").attr("data-sec");
				flipLeft(opened + 1);
				//throw("left");
				
			},
			
			swipeRight:function() {
				
				var opened = $(".section.opened").attr("data-sec");
				flipRight(opened - 1);
				throw "right";
					
			}

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
	
	$(document).keyup(function(e) {
			if (e.keyCode === 13) { $('.tipped').remove(); }    // enter
			if (e.keyCode === 27) { $('.tipped').remove(); }   // esc
		});

	$(document).ready(function() {
	
		jQuery("#menu-item-13").addClass("active").addClass("dogeared").parents("li").addClass("active");
		
	});

})(jQuery);

jQuery("#menu-item-13").addClass("active").spine("setup_nav");