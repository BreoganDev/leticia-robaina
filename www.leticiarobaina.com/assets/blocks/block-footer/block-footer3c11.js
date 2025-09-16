class BlockFooter
{
    static create(block)
    {
        return new BlockFooter(block);
    }

    constructor(block)
    {
        this.block = block;

        this.block.find('.social a').on('click', e => {
            _dataLayer('click_rrss', {content_type: e.currentTarget.getAttribute('aria-label')});
        });

        this.block.find('nav a').on('click', e => {
            _dataLayer('click_menu', {content_type_menu: e.currentTarget.innerText});
        });
    }
}

$(document).ready(function(e) {
	$('.block-footer').each(function(index, element) {
		BlockFooter.create($(element));
	});
});