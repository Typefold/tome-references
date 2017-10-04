

var BiblioFormHelpers = (function(){

	function BiblioFormHelpers() {}

	BiblioFormHelpers.prototype.clearBiblioForm = function() {
		$('.biblio-form-wrapper').removeClass('active').html("")
	}

	BiblioFormHelpers.prototype.checkEmptyRepeater = function() {
		$('.fields-section').each(function(index, el) {

			$repeaterField = $(el).find('input[type="text"]')

			if ( $repeaterField.val() == "" )
				$repeaterField.prop( "disabled", true )

		});
	}

	return BiblioFormHelpers;
})();

biblioHelpers = new BiblioFormHelpers();
