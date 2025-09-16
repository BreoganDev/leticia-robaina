function frontendBlockMinisliderClass()
{
	var ul;
	var duracion = 3;
	var intervalo = 0;
	var actual = 0;
	var totalItems = 0;
	var paso = -25;
	var itemsVisibles;

	this.init = function(element)
	{
		ul = $(element).find('.minislider ul');
		
		totalItems = ul.find('li').length;
		
		if(totalItems == 0)
			return false;
		
		paso = parseInt(ul.find('li').css('width')) * -1;
		
		itemsVisibles = ($(window).width() <= 980 ? 2 : parseInt(element.attr('data-cols')));
		
		if(totalItems <= itemsVisibles)
			return;
		
		intervalo = setInterval(function() {
			
			ul.css('transform', 'translate3D(' + (actual * paso) + 'px, 0, 0)');
			
			actual++;
			
			if(actual > totalItems - itemsVisibles)
				actual = 0;
			
		}, duracion * 1000);
	}
	
	this.backendHelper = function(block)
	{
		block.find('[data-srcset]').each(function(index, element) {
			$(element).attr('srcset', $(element).attr('data-srcset'));
		});
	}
}

$(document).ready(function() {
	
	$('.block-minislider').each(function(i, e) {
		
		var frontendBlockMiniSlider = new frontendBlockMinisliderClass;
		
		frontendBlockMiniSlider.init($(e));

	});
});