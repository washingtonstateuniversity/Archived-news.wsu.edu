(function($){

	// Docs at http://simpleweatherjs.com
	$(document).ready(function() {
		
		//throw "hello";
		var html;
		
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