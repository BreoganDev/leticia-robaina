(function($) {
    $.fn.pty_modal = function(opts) {
        
        return this.each(function() {

            if(!this._pty_layer)
                this._pty_layer = new PtyLayer($(this));

            if(opts == undefined)
                return;

            if(opts == 'show')
            {
                this._pty_layer.show();
            }
            if(opts == 'update_position')
            {
                this._pty_layer._setPosition();
            }
            else if(opts == 'hide')
            {
                this._pty_layer.hide();
            }
            else if(opts.onShown != undefined)
            {
                this._pty_layer.onShown(opts.onShown);
            }
        });
    };
})(jQuery);

class PtyLayer
{
    constructor(element) {
        this.id = parseInt(Math.random() * 100000);
        this.item = $(element);
        this.item.attr('data-pty-id', this.id);
        this.backdrop = $('<div class="pty-layer pty-layer-backdrop" data-pty-layer-id="' + this.id + '"></div>');
        this.settings = {
            dismissible: !(this.item.attr('data-dismissible') == 'false')
        };
        this._resizeObserver = null;

        // If modal is dismissible
        if(this.settings.dismissible)
        {
            // Close button + event listener
            const close = $('<a href="#" class="close-button"><i class="ti-close"></i></a>');

            close.on('click', e => {
                e.preventDefault();
                this.hide();
            });

            this.item.append(close);

            // Search for dismissable button
            this.item.find('[data-pty-layer="dismiss"]').on('click', e => {
                e.preventDefault();
                this.hide();
            });

            // Backdrop event listener
            this.backdrop.on('click', e => {
                e.preventDefault();
                this.hide();
            });

            // Drag event handler to close
            this._addDragEventHandler();
        }

        // Add backdrop to body
        $('body').append(this.backdrop);

        // Window resize event
        $(window).on('resize', e => {
            if(this.isVisible())
            {
                this._setPosition();
            }
        });

        // Dismiss event listener inside item
        this.item.find('[data-dismiss="true"]').on('click', e => {
            e.preventDefault();
            this.hide();
        });

        // Events
        this._onShownEvent = null;
    }

    isVisible() {
        return this.item.hasClass('visible');
    }

    show() {
        this._setPosition();

        ptyLayersManager.show(this.item, this.backdrop);
        
        this.item.addClass('visible');
        this.backdrop.addClass('visible');

        if(typeof this._onShownEvent == 'function')
        {
            this._onShownEvent();
        }

        this._addResizeEventHandler();
    }

    hide() {
        let self = this;

        ptyLayersManager.hide();
        this.item.removeClass('visible').css('bottom', '');
        this.backdrop.removeClass('visible');
        
        setTimeout(function() {
            self._unsetPosition();
            self._removeResizeEventHandler();
        }, 305);
    }

    onShown(callback) {
        this._onShownEvent = callback;
    }

    _addDragEventHandler() {
        if(!isMobile())
            return;
        
        let startY = 0;
        
        this.item.on('touchstart', (event) => {
            startY = event.originalEvent.touches[0].clientY;
        });

        this.item.on('touchmove', (event) => {
            const currentY = event.originalEvent.touches[0].clientY;
            const distance = currentY - startY;

            if(distance > 250)
            {
                this.hide();
            }
            else if(distance > 50)
            {
                this.item.css('bottom', distance * -1);
            }
        });

        this.item.on('touchend', (event) => {
            startY = 0;
            this.item.css('bottom', '');
        });
    }

    _setPosition()
    {
        if($(window).width() <= 1024)
        {
            this.item.css({
                top: 'unset',
                left: 'unset',
            });
            return;
        }
        
        this.item.css({
            top: ($(window).height() - this.item.outerHeight()) / 2,
            left: ($(window).width() - this.item.outerWidth()) / 2,
        });
    }

    _unsetPosition()
    {
        this.item.css({
            top: '',
            left: '',
        });
    }

    _addResizeEventHandler() {
        let self = this;

        this._resizeObserver = new ResizeObserver(entries => {
            self._setPosition();
        });

        this._resizeObserver.observe(this.item.get(0));
    }

    _removeResizeEventHandler() {
        this._resizeObserver.disconnect();
    }
}

class PtyLayersManager
{  
    constructor() {
        this.zIndex = 100;
        this.items = 0;
    }
    
    show(item, backdrop) {
        const zIndex = (item.attr('data-z-index') ? parseInt(item.attr('data-z-index')) : this.items + this.zIndex);

        item.css('z-index', zIndex + 1);
        backdrop.css('z-index', zIndex);
        
        this.items++;

        Pty.frontend.disableScroll();
    }

    hide() {
        this.items--;

        if(this.items <= 0)
        {
            this.items = 0;
            Pty.frontend.enableScroll();
        }
    }
}

var ptyLayersManager = new PtyLayersManager();