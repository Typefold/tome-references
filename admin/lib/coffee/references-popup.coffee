$ = jQuery

class ReferencesPopUp

	self = this

	defaults = {
		message: "Message of your popup",
		singleChoice: false,
		onConfirm: -> $('.tome-popup, .tome-popup-bg').remove()
		confirmText: "Yes",
		dismisText: "No"
	}

	buttonClasses = ['green','red']

	constructor: ( options ) ->
		this.s = $.extend({}, defaults, options || {})
		this.init()


	init: ->
		s = this.s
		this.open()
		this.bindButtonActions()
	


	makeButtons: ->
		$buttons = ""
		$buttons += '<span class="popup-choice green confirm half">'+this.s.confirmText+'</span>'

		if this.s.singleChoice != true
			$buttons += '<span class="popup-choice red close half">'+this.s.dismisText+'</span>'

		return $buttons



	bindButtonActions: ->
		$('.popup-choice.confirm').click (->
			this.s.onConfirm()
			this.close()

			).bind(this)

		$('.popup-choice.close').click (->
			this.s.onDismis() if this.s.onDismis != 'undefined'
			this.close()

			).bind(this)



	close: ->
		$('.tome-popup, .tome-popup-bg').remove()


	# Additional plugin methods go here
	open: ->
		$popup = '<div class="tome-popup-bg"></div>
		<div class="tome-popup">
		<p>' + this.s.message + '</p>' +
			'<div class="choices-wrapper">' +
				this.makeButtons() +
			'</div>' +
		'</div>'

		$('body').append $popup


