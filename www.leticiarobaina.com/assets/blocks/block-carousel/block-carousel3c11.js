function frontendBlockCarouselClass(block)
{
	let self = this;
	let itemsCollection = [];
	let carouselSelector;
	
	this.init = function()
	{
		block = frontendbuildAdvancedBblock(block);

		// Random
		block.attr('data-random', Math.floor(Math.random() * 1000));
		carouselSelector = '.block[data-id="' + block.attr('data-id') + '"][data-random="' + block.attr('data-random') + '"] .block-carousel-items';
		
		// If initialized cancel
		if(block.status.isInitialized())
			return;
			
		// Items from external data
		if(block.info.usesExternalData())
		{
			// If no items cancel
			if(itemsCollection.length == 0)
				return;
			
			// Get the template
			var itemTemplateClass = new frontendBlockCarouselItemTemplateClass();
			var itemTemplate = '';
			
			if(self.isBlockedImageCarousel())
			{
				itemTemplate = itemTemplateClass.getBlockedImage();
			}
			else
			{
				itemTemplate = itemTemplateClass.getInline();
			}
			
			// Render & append items
			for(var i in itemsCollection)
			{
				var values = itemsCollection[i];
				var item = $(replaceVarsWithValues(itemTemplate, values));
				
				if(isEmptyValue(values.title))
					item.find('.title').remove();
				
				if(isEmptyValue(values.text))
					item.find('.rtf-content').remove();
				
				if(isEmptyValue(values.primaryButton_text))
					item.find('.actions').remove();
				
				block.find('.block-carousel-items').append(item);
			}
			
			// Remove empty alert
			if(block.find('.block-carousel-items .block-carousel-item').length > 0)
			{
				block.find('.block-alert-empty').remove();
			}
		}
		
		// Start carousel
		if(self.isBlockedImageCarousel())
		{
			_initCarouselBlockedImagePlugin(block);
			
			$(window).on('resize', function(e) {
				_setContentHeight(block);
			});
		}
		else
		{
			_initCarouselPlugin(block);
		}

		// Fancybox
		block.find('[data-fancybox5]').each((index, element) => {
			Fancybox.bind('[data-fancybox5="' + element.dataset.fancybox5 + '"]', {
				groupAttr: 'data-fancybox5',
				Thumbs: false,
				Toolbar: {
					display: {
						left: [],
						right: ["close"]
					}
				},
			});
		});
	}
	
	let _setContentHeight = function(block)
	{
		setTimeout(function() {
			let maxContentHeight = 0;
		
			if(!window.screen.isSmall())
			{
				block.find('.block-carousel-content').each(function(index, element) {
					element = $(element);
					
					element.css('height', '');
					
					if(element.outerHeight() > maxContentHeight)
					{
						maxContentHeight = element.outerHeight();
					}
				});
				
				block.find('.block-carousel-content').css('height', maxContentHeight + 30);
			}
			else
			{
				block.find('.block-carousel-content').css('height', null);
			}
		}, 500);
	}
	
	let _initCarouselBlockedImagePlugin = function(block)
	{
		let _initCarousel = () => {
			setTimeout(() => {
				
				block.interval = 0;
				
				let _initAndResetAutoplay = function() {
					if(block.interval)
						clearInterval(block.interval);

					if(block.attr('data-autoplay') != '1')
						return;
					
					//block.find('.block-carousel-carousel').addClass('visible');
					
					block.interval = setInterval(() => {
						block.carousel.goTo('next');
					}, parseInt(block.attr('data-trans-duration')) * 1000);
				}
				
				_setContentHeight(block);
								
				block.carousel = tns({
					container: carouselSelector,
					mode: 'carousel', //gallery (fade animation) or carousel (slider animation)
					items: 1,
					slideBy: 1,
					autoplay: false,
					controls: false,
					nav: false,
					speed: 750,
					autoplay: false,
					mouseDrag: true,
					preventActionWhenRunning: true,
				});

				setTimeout(() => {
					addReadMoreButton(block);
				}, 1000);
			
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
		
		_initCarousel();
	}
	
	let _initCarouselPlugin = function(block)
	{
		const totalImages = block.find('img').length;
		let loadedImages = 0;
		let _initCarousel = () => {
			setTimeout(() => {
				
				block.interval = 0;
				
				let _initAndResetAutoplay = function() {
					if(block.interval)
						clearInterval(block.interval);
										
					// En el escritorio, cuando es el carrusel inline y el número de ítems es igual de columnas, debemos ocular la navegación y no hacer la transición
					if(!self.isBlockedImageCarousel()
						&& parseInt(block.attr('data-total-items')) <= parseInt(block.attr('data-cols'))
						&& !window.screen.isSmall()
						&& !self.isAutoWidthCarousel()
					)
					{
						block.find('.block-carousel-nav').hide();
					}
					else
					{
						block.find('.block-carousel-nav').show();
					}
					

					if(block.attr('data-autoplay') != '1')
						return;

					block.interval = setInterval(() => {
						block.carousel.goTo('next');
					}, parseInt(block.attr('data-trans-duration')) * 1000);
				}
				
				if(self.isAutoWidthCarousel())
				{
					const _isMobile = isMobile();

					block.carousel = tns({
						container: carouselSelector,
						mode: 'carousel',
						items: 1,
						center: true,
						controls: false,
						nav: false,
						speed: 700,
						autoplay: false,
						mouseDrag: true,
						preventActionWhenRunning: false,
						autoWidth: true,
						slideBy: 1,
						responsive: {
							900: {
								items: 1,
								center: false,
							}
						}
					});
					
					// Si estamos en el móvil, cuando se termina de arrastrar la diapositiva, reseteamos el contador para el auto-play
					if(_isMobile)
					{
						block.carousel.events.on('touchEnd', e => {
							_initAndResetAutoplay();
						});
					}
				}
				else
				{
					block.addClass('random-' + Math.random())
					block.carousel = tns({
						container: carouselSelector,
						mode: 'carousel',
						items: 1,
						slideBy: (!window.screen.isSmall() && self.isInlineCarousel() ? block.attr('data-step') : 1),
						controls: false,
						nav: false,
						speed: 700,
						autoplay: false,
						preventActionWhenRunning: true,
						mouseDrag: true,
						responsive: {
							900: {
								items: block.attr('data-cols'),
							}
						}
					});
				}

				setTimeout(() => {
					addReadMoreButton(block);
				}, 1000);
			
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

				// Colocamos los botones de navegación en la vertical de la imagen
				setTimeout(function() {
					let top = (block.find('img').height() - block.find('.block-carousel-nav').height()) / 2;
					
					top += parseInt(block.find('img').parents('.block-carousel-item').css('padding-top'));

					if(top > 0)
						block.find('.block-carousel-nav').css('top', top);
				}, 1000);
			}
		}).each(function() {
			if(this.complete)
				$(this).load();
		});
	}
	
	/****/
	
	this.addItem = function(item)
	{
		itemsCollection.push(item);
	}
	
	this.clearItems = function()
	{
		block.find('ul').html('');
	}

	/* Helpers */
	this.isBlockedImageCarousel = function() {
		return block.attr('data-type') == 'block-carousel-blocked-image';
	}

	this.isFeaturedItemCarousel = function() {
		return block.attr('data-type') == 'block-carousel-featured-item';
	}

	this.isInlineCarousel = function() {
		return block.attr('data-type') == 'block-carousel-inline';
	}

	this.isAutoWidthCarousel = function() {
		return block.attr('data-type') == 'block-carousel-auto-width';
	}
}

$(document).ready(function() {
	$('.block-carousel').each(function(index, element) {
		let carousel = new frontendBlockCarouselClass(element);
		carousel.init();
	});
	
	// Eventos
	if(_APP.builder)
	{
		_APP.events.on('builder.blocks.config.onClosed', function(data) {
			if(data.key == 'carousel')	
			{
				let carousel = new frontendBlockCarouselClass(data.block);
				carousel.init();
			}
		});
	}
});