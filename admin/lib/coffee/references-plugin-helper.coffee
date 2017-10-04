ReferencesPluginHelper = {

	init: ( ed, url ) ->
		this.registerReferencesButton( ed, url )

		ed.addCommand 'reference', =>
			window.activeEditor = ed
			console.log( window.activeEditor );
			selectedText = ed.selection.getContent()
			selectedNode = $( ed.selection.getNode() )
			self = this

			if ( selectedText == "" )
				return new ReferencesPopUp({
					message: "You have to select atleast one word.",
					singleChoice: true,
					confirmText: "ok"
				})

			if ( selectedNode.hasClass('tome-reference') || selectedNode.parent().hasClass('tome-reference') )
				return new ReferencesPopUp({
					message: "Do you want to edit or remove this reference.",
					onConfirm: this.editReferenceAction
					onDismis: this.removeReferenceAction
					confirmText: "edit"
					dismisText: "remove"
				})

			modalWindow.open()



	addReferenceToEditor: ( referenceID, biblioID ) ->
		selection = window.activeEditor.selection.getContent({format: 'code'})

		return_text = '[tome_reference id="'+referenceID+'" biblio-id="'+biblioID+'"]' + selection + '[/tome_reference]'
		window.activeEditor.selection.setContent( return_text )


	editReferenceAction: ->
		referencePlaceholder = $( window.activeEditor.selection.getNode() )
		referenceID = referencePlaceholder.attr('data-ref-id')

		window.referenceEdit = true
		modalWindow.open()
		ModalWindow.goToSection('reference-form')
		tomeReferences.setEditorMethod('update')
		tomeReferences.setCurrentReference( referenceID )
		tomeReferences.getReferenceText( referenceID )


	removeReferenceAction: ->
		elm = window.activeEditor.selection.getNode()
		tinyMCE.execCommand('mceRemoveNode', false, elm)



	registerReferencesButton: ( ed, url ) ->
		ed.addButton 'reference', {
			title : 'Reference',
			cmd : 'reference',
			image : url + '/reference.png',
			onPostRender: ->

				_this = this   # reference to the button itself
				ed.on 'NodeChange', ->
					# activate the button if this parent has this class
					is_active = jQuery( ed.selection.getNode() ).hasClass('tome-reference')
					_this.active( is_active )
		}

}

tinymce.create 'tinymce.plugins.TomeReferencesPlugin', ReferencesPluginHelper
tinymce.PluginManager.add('tomeReferencesPlugin', tinymce.plugins.TomeReferencesPlugin)








