# Handles any interatction with modal window (clicking on any element in it)
# and fires according actions of other classes which are initialized
# in main.coffee
class ModalWindow
	
	constructor: ->
		this.init()

	init: ->
		$('.close-references-modal').click =>
			this.close()


		$('.add-biblio').click =>
			ModalWindow.goToSection('create-biblio')


		$('.back-button').click =>
			ModalWindow.goToSection('biblio-list')
			biblioHelpers.clearBiblioForm()

		this.materialInputEffect()


	open: ->
		$('#references-modal').addClass("md-show")


	close: ->
		$('.md-modal').removeClass('md-show')
		ModalWindow.goToSection('biblio-list')

		biblioID = 0
		referenceID = 0
		window.activeEditor = ""
		window.referenceEdit = false



	@goToSection: ( sectionName ) ->

		sectionName = 'no-entries' if $('#biblio-entries .biblio-entry').length == 0 && sectionName == 'biblio-list'

		$('.modal-section.active').addClass('fadeOutUp').removeClass('active')
		$('.'+sectionName).removeClass('hidden fadeOutUp').addClass('fadeInUp active')



	materialInputEffect: ->
		$modalWindow = $('#references-modal')

		$modalWindow.on 'focus', '.biblio-input', ->
			$(this).parents('.input-wrapp').addClass 'focused has-value'
		
		$modalWindow.on 'focusout', '.biblio-input', ->
			$(this).parents('.input-wrapp').removeClass 'focused'

		$modalWindow.on 'blur', '.biblio-input', ->
			if ( $(this).attr('value') == "" )
				$(this).parents('.input-wrapp').removeClass 'has-value'
				$(this).parents('.input-wrapp').removeClass 'focused'


