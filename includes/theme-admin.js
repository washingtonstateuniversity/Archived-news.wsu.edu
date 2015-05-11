(function($){

	$(document).mouseup(function() {
		
	if ($('body.modal-open:not(modal-tweaked)').length) {
		// alert("hello");
		
		$('.gallery-settings select.link-to').val('none');
		$('.gallery-settings select.size').val('large');
		
		/*$('body:not(.modal-tweaked) .gallery-settings').append('<label><span class="name">Caption</span><textarea id="gallery-caption" name="style"></textarea></label>'); */
		
		
		$('body').addClass('modal-tweaked');
		
		}

	});
	
	$(document).ready(function() {
    
    	$( ".datepicker" ).datepicker();
    
    });

}(jQuery));