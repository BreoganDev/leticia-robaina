// https://css-tricks.com/the-complete-guide-to-lazy-loading-images/

function _getElementWithLazyLoadImages(parent)
{
	return parent.querySelectorAll("picture.lazy img, picture.lazy source, .lazy, div[data-bg-image]");
}

function _lazyLoadItem(img)
{
	if(img.classList.contains('loaded'))
		return;
	
	if(img.dataset.bgImage != undefined)
	{
		img.style.backgroundImage = 'url("' + img.dataset.bgImage + '")';
		delete img.dataset.bgImage;
	}
	else
	{
		let field = (img.dataset.src != undefined ? 'src' : 'srcset');
		img[field] = img.dataset[field];
		delete img.dataset[field];
	}

	img.classList.remove('loading');
	img.classList.add('loaded');
}

function frontendSetLazyContent(parent)
{
	let lazyloadImages = _getElementWithLazyLoadImages(parent);
	let options = {
		rootMargin: '200px'
	};
	let imageObserver = new IntersectionObserver(function(entries, observer)
	{
		entries.forEach(function(entry)
		{
			if(entry.isIntersecting)
			{
				const img = entry.target;
				
				_lazyLoadItem(img)
				
				imageObserver.unobserve(img);
			}
		});
	}, options);

	lazyloadImages.forEach(function(image) {
		imageObserver.observe(image);
	});
}

document.addEventListener("DOMContentLoaded", function() {
	
	// Si estamos en un iframe de previsualización de la página cargamos las imágenes de golpe
	if(parseInt(_APP.frontend.preview) || typeof(window.parent.iframeLoaded) == 'function')
	{
		var images = _getElementWithLazyLoadImages(document.querySelector('#wrapper'));
		
		images.forEach(function(img) {
			if(img.dataset.bgImage != undefined)
	        {
	        	img.style.backgroundImage = 'url("' + img.dataset.bgImage + '")';
	        	delete img.dataset.bgImage;
	        }
	        else if(img.dataset.src || img.dataset.srcset)
	        {
	        	var field = (img.dataset.src != undefined ? 'src' : 'srcset');
	            img[field] = img.dataset[field];
	            delete img.dataset[field];
	        }

			img.classList.remove('loading');
			img.classList.add('loaded');
		});
	}
	else
	{
		frontendSetLazyContent(document);
	}
});

window.addEventListener('load', e => {
	setTimeout(function() {
		const items = _getElementWithLazyLoadImages(document);
		items.forEach(item => {
			_lazyLoadItem(item);
		});
	}, 2000);
});