class BiblioAdminPage

	constructor: ->
		this.bindUiInteraction()

		options = {
			valueNames: ['biblio-title', 'reference-text']
		}
		userList = new List('biblio-entries-list', options);


	editReference: ->
		modalWindow.open()
		biblioID = $(this).parent().data('biblio-id')
		referenceID = $(this).parent().data('reference-id')
		
		ModalWindow.goToSection('reference-form')
		tomeReferences.getReferenceText( referenceID )
		tomeReferences.setEditorMethod('update')
		tomeReferences.setCurrentReference( referenceID )


	editBibliography: ->
		modalWindow.open()
		ModalWindow.goToSection('create-biblio')
		biblioID = $(this).parents('tr').data('biblio-id')

		biblioForm.loadEditBiblioForm( biblioID )


	deleteBiblio: ( biblioID ) ->
		params = {
			action: 'delete_bibliography'
			id: biblioID
		}
		$.post ajaxurl, params, ( response ) ->
			$('tr[data-biblio-id="'+biblioID+'"]').remove()
			console.log(response)


	showBiblioReferences: ->
		$(this).parent().next().toggleClass('active')
		# $(this).parents('.biblio-entry').find('.column').css('display','none')


	openDeletePopUp: ->
		element = this  # reference to the clicked element that triggered this function

		new ReferencesPopUp({
			message: "Do you want to delete this entry? <br> This will cause deleting all associated references."
			onConfirm: -> 
				biblioID = $(element).parents('tr').attr('data-biblio-id')

				BiblioAdminPage.prototype.deleteBiblio( biblioID )
		})


	bindUiInteraction: ->
		$('.reference-text').click this.editReference
		$('.biblio-title, .edit-biblio').click this.editBibliography
		$('.references-count').click this.showBiblioReferences
		$('.biblio-reference').on 'update-reference', ( event, referenceID, referenceText ) ->

			if ( $(this).data('reference-id') == parseInt( referenceID ) )
				$(this).find('.reference-text').html( referenceText )



		# after 'delete-biblio' event is fired remove
		# the biblio from the list
		$('.biblio-entry').on 'delete-biblio', ( event, biblioID ) ->
			$('tr[data-biblio-id="'+biblioID+'"]').remove()

		$('.remove-biblio').click this.openDeletePopUp
