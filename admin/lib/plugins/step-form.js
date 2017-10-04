jQuery(document).ready(function($) {

	var currentSlide = 0,
	$slidesContainer = $('.slide-container'),
	$slides = $('.slide'),
	slideCount = $slides.length,
	animationTime = 300;


	function generatePagination () {
		var $pagination = $('.pagination');
		for(var i = 0; i < slideCount; i ++){
			var $indicator = $('<div>').addClass('indicator'),
			$progressBarContainer = $('<div>').addClass('progress-bar-container'),
			$progressBar = $('<div>').addClass('progress-bar'),
			indicatorTagText = $slides.eq(i).attr('data-tag'),
			$tag = $('<div>').addClass('tag').text(indicatorTagText);

			$indicator.append($tag);
			$progressBarContainer.append($progressBar);
			$pagination.append($indicator).append($progressBarContainer);
		}
		$pagination.find('.indicator').eq(0).addClass('active');
	}

	function goToNextSlide () {
		if(currentSlide >= slideCount - 1) return; 
		currentSlide++;
		setActiveSlide();
		setActiveIndicator();
		$('.progress-bar').eq(currentSlide - 1).animate({
			width: '100%'
		}, animationTime);
	}

	function setActiveSlide () {
		$('.slide.active').removeClass('active');
		activeSlide = $('.slide')[currentSlide];
		$(activeSlide).addClass('active');
	}

	function goToPreviousSlide () {
		if(currentSlide <= 0) return; 
		currentSlide--;
		setActiveSlide();
		setActiveIndicator();
		$('.progress-bar').eq(currentSlide).animate({
			width: '0%'
		}, animationTime);
	}

	function setActiveIndicator () {
		var $indicator = $('.indicator');
		$indicator.removeClass('active').removeClass('complete');
		$indicator.eq(currentSlide).addClass('active');
		for(var i = 0; i < currentSlide; i++){
			$indicator.eq(i).addClass('complete');
		}
	}

	generatePagination();
	$('.next').on('click', goToNextSlide);
	$('.previous').on('click', goToPreviousSlide);

});