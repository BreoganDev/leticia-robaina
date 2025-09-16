function frontendBlockCarouselItemTemplateClass(block)
{
	this.getBlockedImage = function()
	{
		var html = '<div class="block-carousel-item">'+
			'<div class="block-carousel-content-image">'+
				'<div class="block-carousel-image">'+
					'<img src="{image}">'+
				'</div>'+
				'<div class="block-carousel-content">'+
					'<h3 class="title">{title}</h3>'+
					'<div class="rtf-content">{text}</div>'+
					'<div class="actions">'+
						'<a class="btn btn-primary" href="{primaryButton_url}" target="{primaryButton_target}">{primaryButton_text}</a>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>';
		
		return html;
	}
	
	this.getInline = function()
	{
		var html = '<div class="block-carousel-item">' +
			'<img src="{image}" />' +
			'<h3 class="title">{title}</h3>' +
			'<div class="rtf-content">{text}</div>' +
			'<div class="actions">' +
				'<a class="btn btn-primary" href="{primaryButton_url}" target="{primaryButton_target}">{primaryButton_text}</a>' +
			'</div>' +
		'</div>';
		
		return html;
	}
}