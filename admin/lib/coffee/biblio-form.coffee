class BiblioForm

	settings = {
		biblioForm: $('.biblio-form')
		repeaterDeleteButton: '.remove-section'
		entriesList: false
		currentBiblio: 0
	}

	constructor: ->
		$('body').on 'change', 'select[name="online_reference_type"]', this.chooseOnlineReferenceField

		this.init()

	init: ->
		initListOfEntries()
		formValidation()
		this.bindUiInteraction()


	getBiblioStyleSources: ->

		biblioStyle = $('#biblio-style').val()

		$('#type-of-source').attr('disabled', 'disabled');

		params = {
			action: 'get_biblio_style_sources',
			'biblio_style': biblioStyle
		}

		$.post ajaxurl, params, ( response ) ->
			$('#type-of-source').removeAttr('disabled').html( response );

			if biblioStyle == 'custom'
				$('#type-of-source').attr('class', 'hidden')
			else
				$('#type-of-source').removeClass('hidden')


	# loads biblioform for given bibliography
	loadEditBiblioForm: ( biblioID ) ->

		$this = this
		settings.currentBiblio = biblioID

		this.getBiblioMeta( biblioID ).then ( entryMeta ) ->
			entryMeta = $.parseJSON( entryMeta )

			biblioConfig = {
				biblio_id: biblioID
				biblio_style: entryMeta['biblio-style'][0]
				type_of_source: entryMeta['type-of-source'][0]
				chicago_system: entryMeta['chicago-system'][0]
			}

			loadForm = $this.loadBiblioForm( biblioConfig )
			values = $this.getBiblioFormValues( biblioID )

			# When we the HTML code for the form and Form values
			# are ready let's uset them
			$.when( loadForm, values ).done ( formHTML, biblioFormValues ) ->
				$this.setBiblioFormValues( biblioFormValues[0], biblioID )



	# When referencing online eg. a journal, a article etc..
	# you have to provide either URL or doi.
	chooseOnlineReferenceField: ( evt ) ->
		selectedValue = $(evt.target).val()
		$('input[name="dynamic_field"]').siblings('label').text( selectedValue )



	displayChicagoSystemOption: ->
		$('#chicago-system').attr('class', 'active')



	formValidation = ->
		$('.biblio-form').validate({
			submitHandler: (form) ->
				biblioHelpers.checkEmptyRepeater()
				saveBibliography()
				return false
		})


	serializeForm = ->
		$('.tinymce-wrapper').each ( index, element ) ->
			wrapperID = $(element).attr('id')
			tinymceValue = tinyMCE.get( wrapperID ).getContent()
			
			$(element).val( tinymceValue )

		return $('.biblio-form').serialize() 


	saveBibliography = ->
		params = {
			action: 'save_bibliography',
			'form_data': serializeForm(),
			'post_id': settings.currentBiblio
		}

		$.post ajaxurl, params, (response) ->

			response = $.parseJSON( response )

			# If updating post
			if ( params.post_id )
				item = settings.entriesList.get('entry-id', response['post_id'])
				item[0].values({
					'entry-title': response['post_title'],
					'entry-id': response['post_id'],
					'author-name': 'by: ' + response['entry_author']
				})

			else
				addEntrytoList( response )


			biblioHelpers.clearBiblioForm()
			$('.create-biblio .back-button').click()



	getBiblioConfig: ->
		return {		
			biblio_style: $('#biblio-style').val(),
			type_of_source: $('#type-of-source').val(),
			chicago_system: $('#chicago-system').val()
		}


	# On Ajax call get biblioStyle fields
	getBiblioFormHtml: ( biblioConfig ) ->

		biblioConfig['action'] = 'get_biblio_form'

		return $.get ajaxurl, biblioConfig



	# Get all post meta for provided biblio entry
	getBiblioMeta: ( biblioID ) ->
		params = {
			action: 'get_biblio_entry_meta',
			biblio_id: biblioID
		}
		
		return $.get ajaxurl, params



	getBiblioFormValues: ( biblioID ) ->
		params = {
			action: 'get_biblio_form_values'
			biblio_id: biblioID
		}

		$.get( ajaxurl, params )



	# @param formValues (JSON) - a json array of values
	# @param entryID (int) - id of biblioentry that is being edited
	setBiblioFormValues: ( formValues, entryID ) ->
		formValues = $.parseJSON( formValues )

		$('.save-bibliography').val('Update bibliographic entry')


		this.chicagoSystemToggle( formValues['biblio-style'] )


		# TODO: Q
		# Should this be broken into, two more functions
		# 1. isRepeaterValue()
		# 2. setRepeaterValue( repeaterValue )
		$.each formValues, ( fieldName, fieldValue ) ->

			# if the field is a repeater field loop throught
			# all itterations of it
			if typeof fieldValue == 'object'

				repeaterLength = fieldValue['first_name'].length
				i = 0

				while i < repeaterLength
					$.each fieldValue,  ( repeaterName, repeaterValue ) ->
						repeaterField = $('input[name="' + fieldName + '[' + repeaterName + '][]"]')[i]
						$(repeaterField).val( repeaterValue[i] )

					i++;


			# asign a value to a field
			$('*[name="'+fieldName+'"]').val( fieldValue ).parents('.input-wrapp').addClass('has-value')

			if ( entryID != 'undefined' )
				$('.save-bibliography').attr('data-entry-id', entryID)



		BiblioFormTinyMce.prototype.setValues()

		this.getBiblioStyleSources()



	deleteRepeaterField: ->
		$repeaterName = $(this).parents('.fields-section').attr('data-repeater-name')

		if ( $('.fields-section[data-repeater-name="'+$repeaterName+'"]').length != 1 )
			$(this).parents('.fields-section').remove()


	# Uses List.js plugin to create searchable list out of our
	# bibliographies
	initListOfEntries = ->

		options = {
			item: 'biblio-entry-template',
			valueNames: ['entry-title', 'author-name', { name: 'entry-id', attr: 'data-entry' } ],
			page: 8,
			plugins: [
				ListPagination()
			]
		}

		settings['entriesList'] = new List('biblio-entries', options)



	addEntrytoList = ( entryParams ) ->

		settings.entriesList.add([{
			'entry-title': entryParams['post_title'],
			'entry-id': entryParams['post_id'],
			'author-name': 'by: ' + entryParams['entry_author']
		}], (items) ->

			settings.entriesList.sort('entry-id', {order: 'desc'})

			$( settings.entriesList.items[0].elm ).find('.edit-link').attr({
				'data-source': entryParams['type_of_source']
				'data-style': entryParams['biblio_style']
			})


		)



	# remove all shortcodes of given biblioID from
	# current tinymce editor
	removeShortcodes =  ( editor, biblioID ) ->
		regex = new RegExp("\\[tome_reference id=[\"']\\d+[\"'] biblio-id=[\"']("+biblioID+")[\"'].*?\\]([^\[]*)\\[\/tome_reference\\]", "g")

		editorContent = editor.getContent()
		editorContent = editorContent.replace(regex, '$2')
		# editorContent = editorContent.replace(/\[tome_reference id=["']()["'].*?\]([^\[]*)\[\/tome_reference\]/g, '$2');
		editor.setContent( editorContent )



	# @biblioStyle  value of biblio-style selectbox
	chicagoSystemToggle: ( biblioStyle ) ->
		if biblioStyle == 'chicago'
			$('#chicago-system').attr('class', 'active') 
		else
			$('#chicago-system').removeClass('active') 




	deleteEntryPopUp: ->
		biblioID = $(this).siblings('.entry-id').attr('data-entry');

		return new ReferencesPopUp({
			message: "Are you sure, you want to delete this entry?"
			buttons:
				green:
					text: "NO"
				red:
					text: "YES"
					callback: ->
						#remove
						settings.entriesList.remove('entry-id', biblioID)

						# sends AJAX request deleting the biblio entry from DB
						BiblioForm.deleteBiblio( biblioID )
			})



	@deleteBiblio: ( biblioID ) ->
		params = {
			action: 'delete_bibliography',
			'id': biblioID
		}

		$.post ajaxurl, params, ( response ) ->
			activeEditor = tinyMCE.activeEditor
			$('.biblio-entry').trigger('delete-biblio', [ biblioID ] )

			if activeEditor != null
				removeShortcodes( activeEditor, biblioID )




	loadBiblioForm: ( biblioConfig ) -> 

		$('.biblio-form').addClass('loading')

		return biblioForm.getBiblioFormHtml( biblioConfig ).then ( formHtml ) ->

			biblioForm.appendFormFields( formHtml )




	appendFormFields: ( formFields ) ->
		$('.biblio-form-wrapper').removeClass('active').html( formFields )
		$('.biblio-form-wrapper').find('*[name="date_accessed"],*[name="date"]').datepicker()
		this.fieldsLoaded()




	fieldsLoaded: ->
		biblioTinyMce = new BiblioFormTinyMce
		biblioTinyMce.init()

		$('.biblio-form').removeClass('loading')


	duplicateSection: ->
		sectionCopy = $(this).parents('.fields-section').clone()

		sectionCopy.find('input').each (index, el) ->
			_this.incrementNameId( el )
			$(el).val('') # reset the input value

		sectionCopy.insertAfter( $(this).parents('.fields-section') )


	# Increments number in name attribute of a repeater field
	# e.g author[0][first_name] to ->  author[1][first_name]
	incrementNameId: (input) ->
		name = $(input).attr('name')

		name = name.replace /\[(\d+)\]/, (match, number) ->
			return '[' + (parseInt(number, 10) + 1) + ']'

		# change the atribute's vlaue
		$(input).attr('name', name);


	bindUiInteraction: ->
		$('#references-modal').on 'click', '.remove-section', this.deleteRepeaterField
		$('.biblio-form').on 'click', '.repeat-section', this.duplicateSection
		$('#biblio-entries').on 'click', '.delete-entry', this.deleteEntryPopUp




















