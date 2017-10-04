
biblioID = 0
referenceID = 0
referenceEdit = false

tomeReferences = new TomeReferences()
biblioForm = new BiblioForm()
modalWindow = new ModalWindow()

biblioForm.getBiblioStyleSources()


jQuery(document).ready ($) ->
	if $('.biblio-entries-table').length > 0
		biblioAdminPage = new BiblioAdminPage()


$('#generate-form').click ->

	if ( $('#type-of-source').val() == "" )
		return alert( 'You have to select type of source' )

	# just an object with neccesary information to build form {biblio-style, type-of-source, chicago-system}
	biblioConfig = biblioForm.getBiblioConfig()

	biblioForm.loadBiblioForm( biblioConfig )


$('#biblio-style').on 'change', ->
	biblioStyle = $(this).val()

	# toggles visibility of the chicago-system selectbox
	biblioForm.chicagoSystemToggle( biblioStyle )

	if ( biblioStyle == 'custom'  )
		$('#type-of-source').attr('class', 'hidden')
	else
		$('#type-of-source').removeClass('hidden')

	biblioForm.getBiblioStyleSources()


$('.add-reference').click ->
	if tomeReferences.getEditorMethod() == 'create'
		tomeReferences.createReference( biblioID )
	else
		referenceID = tomeReferences.getCurrentReference()
		tomeReferences.updateReference( referenceID )


$('body').on 'click', '.edit-link', ->
	biblioID = $(this).siblings('.entry-id').attr('data-entry')

	ModalWindow.goToSection('create-biblio')


 	# TODO:
 	# sharing data between promisses. Here I would want to share
	# variable "biblioConfig" with the second promisse "loadBiblioForm"
	# but currently i don't know about any elegant solution
	biblioForm.getBiblioMeta( biblioID ).then ( entryMeta ) ->
		entryMeta = $.parseJSON( entryMeta )

		biblioConfig = {
			biblio_id: biblioID
			biblio_style: entryMeta['biblio-style'][0]
			type_of_source: entryMeta['type-of-source'][0]
			chicago_system: entryMeta['chicago-system'][0]
		}


		$('#biblio-style').trigger('change')

		biblioForm.loadBiblioForm( biblioConfig )
			.then ->
				biblioForm.getBiblioFormValues( biblioID ).then ( biblioFormValues ) ->
						biblioForm.setBiblioFormValues( biblioFormValues, biblioID )


$('.first-biblio').click ->
	ModalWindow.goToSection('create-biblio')


$('body').on 'click', '.entry-title', ->
	biblioID = $(this).siblings('.entry-id').data('entry')
	ModalWindow.goToSection('reference-form')
	tomeReferences.generateReferenceText( biblioID )






