function frontendBlockImageboxesClass()
{
	this.init = function(block)
	{	
		let nVisibleRows = block.attr('data-visible-rows');
		let nCols = block.find('[data-cols]').attr('data-cols');
		let containerBtnShowAll = block.find('.container-btn-show-all');
		
		if(nVisibleRows > 0)
		{
			block.find('ul.block-imageboxes-items > li').each(function(index, element) {
				
				if(window.screen.isSmall())
				{
					if(index + 1 > nVisibleRows * 2)
					{
						$(element).addClass('hidden');
					}
				}
				else
				{
					if(index + 1 > nVisibleRows * nCols)
					{
						$(element).addClass('hidden');
					}
				}
				
			});
			
			if(block.find('ul.block-imageboxes-items > li').length > nCols * nVisibleRows)
				containerBtnShowAll.removeClass('hidden');
			
			containerBtnShowAll.on('click', function(e) {
				e.preventDefault();
				
				block.find('ul.block-imageboxes-items > li.hidden').removeClass('hidden');
				
				$(this).hide();
			});
		}
	}
}

$(document).ready(function() {
	$('.block-imageboxes').each(function(index, element) {
		let frontendBlockImageboxes = new frontendBlockImageboxesClass();
		frontendBlockImageboxes.init($(element));
	});
});