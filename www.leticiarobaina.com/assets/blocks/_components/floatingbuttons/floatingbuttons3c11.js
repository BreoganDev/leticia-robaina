class FloatingButtons
{
    init(block)
    {
        this.block = block;
        this.btnLeftTop = block.find('.floating-button.pos1');
        this.btnRightTop = block.find('.floating-button.pos2');
        this.btnRightBottom = block.find('.floating-button.pos3');
        this.btnLeftBottom = block.find('.floating-button.pos4');
        this.btnRightMobile = block.find('.floating-button.mobile-pos2');
        this.btnLeftMobile = block.find('.floating-button.mobile-pos1');

        this._checkBlockFeaturedcarousel();
        this._checkAddonWitbooking();
        this._checkAddonDirectcontact();
    }

    _checkBlockFeaturedcarousel()
    {
        const buttons = [this.btnLeftTop, this.btnRightTop];
        const btnCarouselNavHeight = this.block.find('.carousel-nav.prev').outerHeight();

        if(!this.block.hasClass('block-featuredcarousel'))
            return;

        buttons.forEach(button => {
            if(!button.length)
                return;

            if(!button.find('.btn-style-rect').length)
                return;

            const top = ((button.outerHeight() + (button.outerHeight() - btnCarouselNavHeight)) / 2);

            button.css('top', 'calc(50% - ' + top + 'px)');
        });
    }

    _checkAddonWitbooking()
    {
        _APP.events.on('addons.witbooking.status.changed', (options) => {

            // Si se activa y es un formulario horizontal con estilo transparentdark, ubicamos el icono por encima
            if(options.status == 'enabled' && frontendAddonWitbooking.isHorizontalForm() && frontendAddonWitbooking.getHorizontalStyle() == 'transparentdark')
            {
                // Móvil
                if(window.screen.isSmall())
                {
                    if(this.btnLeftMobile)
                    {
                        this.btnLeftMobile.css('bottom', frontendAddonWitbooking.getOpener().outerHeight() + 25);
                    }

                    if(this.btnRightMobile)
                    {
                        this.btnRightMobile.css('bottom', frontendAddonWitbooking.getOpener().outerHeight() + 25);
                    }
                }
                // Escritorio
                else
                {
                    if(this.btnLeftBottom)
                    {
                        this.btnLeftBottom.css({
                            left: 25,
                            bottom: frontendAddonWitbooking.getAddon().outerHeight() + 25
                        }).addClass('positioned-by-witbooking');
                    }

                    if(this.btnRightBottom)
                    {
                        this.btnRightBottom.css({
                            right: 25,
                            bottom: frontendAddonWitbooking.getAddon().outerHeight() + 25
                        }).addClass('positioned-by-witbooking');
                    }
                }
            }
            else
            {
                if(this.btnLeftBottom)
                {
                    this.btnLeftBottom.css({
                        left: '',
                        bottom: ''
                    }).removeClass('positioned-by-witbooking');
                }
    
                if(this.btnRightBottom)
                {
                    this.btnRightBottom.css({
                        right: '',
                        bottom: ''
                    }).removeClass('positioned-by-witbooking');
                }
            }
        });
    }

    _checkAddonDirectcontact()
    {
        _APP.events.on('addons.directcontact.loaded', () => {

            this._resetPosition();

            // Botones de la derecha
            if(frontendAddonDirectcontact.getPosition() == 'left')
            {
                if(this.btnLeftBottom)
                {
                    const builderBarWidth = (_APP.builder ? $('#builder-menu').width() : 0);
                    const overlaped = checkOverlap(frontendAddonDirectcontact.getAddon().get(0), this.btnLeftBottom.get(0));

                    if(!this.btnLeftBottom.hasClass('positioned-by-witbooking') && overlaped)
                    {
                        this.btnLeftBottom.css({
                            bottom: (this.btnLeftBottom.find('.btn-style-rect').length ? parseInt(this.btnLeftBottom.css('bottom')) + 5 : ''),
                            left: frontendAddonDirectcontact.getAddon().outerWidth() + frontendAddonDirectcontact.getAddon().offset().left + 25 - builderBarWidth,
                        });
                    }
                }
            }
            else
            {
                if(this.btnRightBottom)
                {
                    const overlaped = checkOverlap(frontendAddonDirectcontact.getAddon().get(0), this.btnRightBottom.get(0));

                    if(!this.btnRightBottom.hasClass('positioned-by-witbooking') && overlaped)
                    {
                        this.btnRightBottom.css({
                            bottom: (this.btnRightBottom.find('.btn-style-rect').length ? parseInt(this.btnRightBottom.css('bottom')) + 5 : ''),
                            right: $(window).width() - frontendAddonDirectcontact.getAddon().offset().left + 25
                        });
                    }
                }
            }
        });
    }

    _resetPosition()
    {
        if(this.btnRightBottom)
        {
            this.btnRightBottom.css({
                bottom: '',
                right: '',
            });
        }

        if(this.btnLeftBottom)
        {
            this.btnLeftBottom.css({
                bottom: '',
                right: '',
            });
        }
    }
}