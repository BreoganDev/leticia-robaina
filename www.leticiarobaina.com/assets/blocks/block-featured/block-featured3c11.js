(function($) {
    $.fn.block_featured = function(param1, param2) {
        return this.each(function() {

            if(!this._object)
                this._object = new BlockFeaturedClass(this);
            
            if(param1 !== undefined)
            {
                if(param1 in this._object)
                {
                    this._object[param1](param2);
                }
            }
        });
    };
})(jQuery);

class BlockFeaturedClass
{
    constructor(_item)
    {
        const self = this;

        this.item = $(_item);
        this.scroll_icon = this.item.find('.com-scroll-icon');

        // Movemos el icono de scroll si se incrusta el motor de reserva con el estilo transparentdark
        _APP.events.on('addons.witbooking.horizontal.transparentdark.embedded', function() {
            self.scroll_icon_position_update(frontendAddonWitbooking.getAddon().outerHeight() + 15);
        });

        _APP.events.on('addons.witbooking.disable', function() {
            self.scroll_icon_position_update(15);
        });

        _APP.events.on('addons.witbooking.enable', function() {
            if(frontendAddonWitbooking.isHorizontalForm() && frontendAddonWitbooking.getHorizontalStyle() == 'transparentdark')
            {
                self.scroll_icon_position_update(frontendAddonWitbooking.getAddon().outerHeight() + 15);
            }
        });

        _APP.events.on('blocks.style.padding', function(data) {
            if(data.block.attr('data-id'), self.item.attr('data-id'))
            {
                self.scroll_icon_position_update(parseInt(self.item.css('padding-bottom')));
            }
        });

        // Movemos el icono de scroll si estamos en el móvil y witbooking está activado
        _APP.events.on('addons.witbooking.loaded', () => {
            if(frontendAddonWitbooking.isHorizontalForm() && window.screen.isSmall())
            {
                self.scroll_icon_position_update(frontendAddonWitbooking.getOpener().outerHeight() + 15);
            }
        });

        (new FloatingButtons()).init(this.item);

        if(BlocksBottomCutHelper.hasCut(this.item))
        {
            self.scroll_icon_position_update(parseInt(this.item.css('padding-bottom')));
        }
    }

    scroll_icon_position_update(bottom)
    {
        if(!this.scroll_icon)
            return;
        
        this.scroll_icon.css('bottom', bottom);
    }
}

$(document).ready(e => {
    $('.block-featured').block_featured();
});