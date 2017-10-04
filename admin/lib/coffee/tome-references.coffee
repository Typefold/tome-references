class TomeReferences


	# We use the same editor for creating and udpateing
	# reference so here are settings that helps us
	# distingues between those two states
	refEditorSettings = {
		editorMethod: 'create'
	}

	generateReferenceText: ( biblioID ) ->
		params = {
			action: 'generate_reference_text',
			'biblio_id': biblioID,
		}

		$.post ajaxurl, params, (reference_text) ->
			tinyMCE.get('reference_text').setContent( reference_text )


	# Retrieve text of already created referene
	getReferenceText: ( referenceID ) ->
		params = {
			action: 'get_reference_text',
			'reference_id': referenceID,
		}

		$.get ajaxurl, params, ( reference_text ) ->
			tinyMCE.get('reference_text').setContent( reference_text )


	createReference: ( biblioID )  ->

		if ( ! biblioID )
			biblioID = $('.selected-biblio-id').val()

		args = {
			action: 'create_reference'
			bibliography_id: biblioID
			reference_text: tinyMCE.get('reference_text').getContent(),
			post_parent: $('.current-post').val()
		}

		$.post ajaxurl, args, ( referenceID ) ->
			# Don't forget to add our newly created reference to the editor
			ReferencesPluginHelper.addReferenceToEditor( referenceID, biblioID )
			modalWindow.close()


	updateReference: ( referenceID ) ->

		newReferenceText = tinymce.editors['reference_text'].getContent()

		params = {
			action: 'update_reference',
			'reference_id': referenceID,
			'reference_text': newReferenceText
		}

		return $.post ajaxurl, params, ( referenceID ) ->
			$('.reference-text').trigger('update-reference', [ referenceID, newReferenceText ])
			modalWindow.close()


	getEditorMethod: ->
		return refEditorSettings.editorMethod;


	setEditorMethod: ( method ) ->
		return refEditorSettings.editorMethod = method


	setCurrentReference: ( referenceID ) ->
		this.referenceID = referenceID

	getCurrentReference: ->
		return this.referenceID
