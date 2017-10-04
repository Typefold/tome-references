class BiblioFormTinyMce

	init: ->
		this.getTinymceWrappers()
		# this.getTinyMceHtml().then this.appendTinyMce


	getTinymceWrappers: ->
		wrappers = []

		# copy settings for tinymce from the 'content' editor
		# and edit the toolbar to only contain bold and italic
		tinymceSettings = tinymce.get('reference_text').settings
		tinymceSettings.selector = '.tinymce-wrapper'
		tinymceSettings.toolbar1 = 'bold | italic'
		delete tinymceSettings['id']

		tinymce.init( tinymceSettings )

		# $('.tinymce-wrapper').each ( index, element ) ->
		# 	wrappers.push({
		# 		'wrapper_id': $(element).attr('id')
		# 		'wrapper_value': $(element).val()
		# 		'skin': 'lightgray'
		# 	})
		# 	tinyMCE.execCommand( 'mceRemoveEditor', false, $(element).attr('id') );
		# 	tinyMCE.execCommand( 'mceAddEditor', false, $(element).attr('id') );

		return wrappers



	setValues: ->
		$('.tinymce-wrapper').each ( index, element ) ->
			editorID = $(element).attr('id')

			tinyMCE.get( editorID ).setContent( $(element).val() )


	getTinyMceHtml: ->

		params = {
			action: 'init_tinymce_fields',
			'tinymce_wrappers': this.getTinymceWrappers()
		}

		return $.get ajaxurl, params




	appendTinyMce: ( editorHtml ) ->
		$('#biblio_text').after( editorHtml )




