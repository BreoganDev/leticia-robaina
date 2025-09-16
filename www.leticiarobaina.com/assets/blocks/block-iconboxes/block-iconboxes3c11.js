function frontendBlockIconboxesClass()
{
	let _setItemsHeight = function(block) {
		let maxHeight = 0;
		
		block.find('.block-iconboxes-items li').each(function(index, element) {
			let height = $(element).outerHeight();
			
			if(height > maxHeight)
				maxHeight = height;
		});
		
		block.find('.block-iconboxes-items li').css('height', maxHeight);
	}
	
	this.init = function(block)
	{	
		if(!parseInt(block.attr('data-carousel')))
			return;
		
		let _resetAndPlayCarousel = function() {
			clearInterval(block.interval);
			block.interval = setInterval(function() {
				block.carousel.trigger('next.owl.carousel');
			}, 5000);
		}
		
		// Alto de los elementos
		_setItemsHeight(block);
		
		// Configuración del carrusel
		block.carousel = block.find('.block-iconboxes-items').owlCarousel({
			loop: true,
		    nav: false,
		    autoWidth: false,
		    dots: false,
		    autoplay: false,
		    margin: 25,
		    slideTransition: 'ease-in-out',
		    smartSpeed: 750,
		    responsive: {
		        0: {
		            items: 1
		        },
		        600: {
		            items: 2
		        },
		        900: {
		        	items: block.find('.block-iconboxes-items').attr('data-cols')
		        }
		    }
		});
		
		// Iniciamos el carrusel
		block.interval = 0;
		_resetAndPlayCarousel();
		
		// Eventos botones
		block.find('.carousel-nav.prev').on('click', function(e) {
			e.preventDefault();
			block.carousel.trigger('prev.owl.carousel');
			_resetAndPlayCarousel();
		});
		
		block.find('.carousel-nav.next').on('click', function(e) {
			e.preventDefault();
			block.carousel.trigger('next.owl.carousel');
			_resetAndPlayCarousel();
		});
	}
}


$(document).ready(function() {
	$('.block-iconboxes').each(function(index, element) {
		let frontendBlockIconboxes = new frontendBlockIconboxesClass();
		frontendBlockIconboxes.init($(element));
	});
	
	if(_APP.builder)
	{
		_APP.events.on('builder.blocks.config.onClosed', function(data) {
			if(data.key == 'iconboxes' && data.block.attr('data-carousel'))	
			{
				let frontendBlockIconboxes = new frontendBlockIconboxesClass();
				frontendBlockIconboxes.init(data.block);
			}
		});
	}
});