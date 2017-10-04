(function( $ ) {
	'use strict';

	$(function() {

		/*=======================================================
		=            Reference tooltip functionality            =
		=======================================================*/
		$('.tome-tooltip').tooltipster({
		    content: (function() {}),
		    interactive: true,
		    contentAsHTML: true,
		    functionPosition: function(instance, helper, position){
		    	position.coord.top -= 30;
		    	return position;
		    },
		    functionBefore: function(instance, helper) {

		    	var $origin = $(helper.origin);
		    	var tooltipContent = $origin.find('.reference-popup-content').val();

		    	instance.content( tooltipContent );
		    }
		    // 'instance' is basically the tooltip. More details in the "Object-oriented Tooltipster" section.
		    // functionBefore: function(instance, helper) {
		        
		    //     var $origin = $(helper.origin);

		    //     // we set a variable so the data is only loaded once via Ajax, not every time the tooltip opens
		    //     if ($origin.data('loaded') !== true) {


		    //     	var params = {
		    //     		action: 'reference_tooltip',
		    //     		reference_id: $origin.attr('data-reference'),
		    //     		biblio_id: $origin.attr('data-biblio'),
		    //     	};

		    //         $.get(frontendajax.ajaxurl, params, function(data) {

		    //             // call the 'content' method to update the content of our tooltip with the returned data
		    //             instance.content( $(data) );

		    //             // to remember that the data has been loaded
		    //             $origin.data('loaded', true);

		    //         });
		    //     }
		    // }
		});


		/* Focus biblio entry on 'View' link click in reference tooltip */
		$('body').on('click', '.view-biblio', function(event) {
			event.preventDefault();

			$('.biblio-entry').removeClass('active');

			var biblioID = $(this).attr('data-biblio');
			var $focusedEntry = $('.biblio-entry[data-biblio="'+biblioID+'"]');

			$focusedEntry.addClass('active');

			$('html, body').animate({
				scrollTop: $focusedEntry.offset().top - '80'
			}, 'fast');

		});


	});

})( jQuery );
