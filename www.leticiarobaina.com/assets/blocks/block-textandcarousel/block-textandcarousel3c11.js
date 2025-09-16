function _initBlockTextandcarouselCarousel(block)
{
	block = $(block);
	
	const totalImages = block.find('img').length;
	let loadedImages = 0;
	let _posNav = () => {
		if(!isMobile())
			return;
		const prev = block.find('.carousel-nav.prev');
		const next = block.find('.carousel-nav.next');
		const carousel = block.find('.block-textandcarousel-carousel');
		prev.css('top', (carousel.height() / 2) - 7);
		next.css('top', (carousel.height() / 2) - 7);
	};
	let _initCarousel = () => {
		setTimeout(() => {
			
			block.interval = 0;
			
			let _initAndResetAutoplay = function() {
				if(block.interval)
					clearInterval(block.interval);
				
				block.interval = setInterval(() => {
					block.carousel.goTo('next');
				}, 5000);
			}

			block.find('.items').removeClass('loading');
			
			block.carousel = tns({
				container: '.block[data-id="' + block.attr('data-id') + '"] .items',
				mode: 'carousel', //gallery (fade animation) or carousel (slider animation)
				items: 1,
				slideBy: 'page',
				autoplay: true,
				controls: false,
				nav: false,
				speed: 750,
				autoplay: false,
				preventActionWhenRunning: true,
			});
		
			block.find('.next').on('click', function(e) {
				e.preventDefault();
				_initAndResetAutoplay();
				block.carousel.goTo('next');
			});
			
			block.find('.prev').on('click', function(e) {
				e.preventDefault();
				_initAndResetAutoplay();
				block.carousel.goTo('prev');
			});
			
			_initAndResetAutoplay();
		}, 500);
	};
	
	block.find('img').one('load', function() {
		loadedImages++;
		
		if(loadedImages >= totalImages)
		{
			_initCarousel();
			_posNav();
		}
	}).each(function() {
		if(this.complete)
			$(this).load();
	});


}

$(document).ready(function() {
	$('.block-textandcarousel').each(function(index, element) {
		_initBlockTextandcarouselCarousel(element);
	});
	
	// Eventos
	if(_APP.builder)
	{
		_APP.events.on('builder.blocks.config.onClosed', function(data) {
			if(data.key == 'textandcarousel')	
			{
				_initBlockTextandcarouselCarousel(data.block);
			}
		});
	}
});

/*
function _initBlockTextandcarouselCarousel(block)
{
	setTimeout(() => {
		block = $(block);
		
		block.carousel = block.find('.items').owlCarousel({
		    loop: true,
		    margin: 0,
		    nav: false,
		    dots: false,
		    autoplay: true,
		    slideTransition: 'ease-in-out',
		    smartSpeed: 700,
		    //animateOut: 'fadeOut',
		    responsive: {
		        0: {
		            items: 1
		        },
		    }
		});
		
		block.find('.next').on('click', function(e) {
			e.preventDefault();
			block.carousel.trigger('stop.owl.autoplay');
			block.carousel.trigger('play.owl.autoplay');
			block.carousel.trigger('next.owl.carousel');
			
		});
		
		block.find('.prev').on('click', function(e) {
			e.preventDefault();
			block.carousel.trigger('stop.owl.autoplay');
			block.carousel.trigger('play.owl.autoplay');
			block.carousel.trigger('stop.owl.autoplay');
		});
	}, 1000);
}

$(document).ready(function() {
	$('.block-textandcarousel').each(function(index, element) {
		_initBlockTextandcarouselCarousel(element);
	});
	
	// Eventos
	if(_APP.builder)
	{
		_APP.events.on('builder.blocks.config.onClosed', function(data) {
			if(data.key == 'textandcarousel')	
			{
				_initBlockTextandcarouselCarousel(data.block);
			}
		});
	}
});
*/