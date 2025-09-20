let blockHeader = new blockHeaderClass();
let blockHeaderCatalogueIntegration = new blockHeaderCatalogueIntegrationClass();

function _fixBlocksAfterHeaderStyle() {
	let header = $('.block-header .headerlg');
	let blockExcludedFromPaddingTop = ['slider', 'textandimage'];

	$('.block').each(function (index, element) {

		let block = $(element);
		let configIcon = block.find('a.block-config');

		if (window._blocksAfterHeader) {
			if (window._blocksAfterHeader.length) {
				for (let i in window._blocksAfterHeader) {
					if (block.attr('data-id') == window._blocksAfterHeader[i].id) {
						if (parseInt(header.attr('data-floating'))) {
							let addPaddingTop = true;

							for (let j in blockExcludedFromPaddingTop) {
								if (blockExcludedFromPaddingTop[j] == block.attr('data-block')) {
									addPaddingTop = false;
									break;
								}
							}

							if (addPaddingTop) {
								block.css('padding-top', _getBlockPaddingTop(block.get(0)));
							}

							configIcon.css('top', $('.block-header .headerlg').get(0).offsetHeight + 30);
						}
						else {
							block.css('padding-top', '');

							configIcon.css('top', '');
						}
					}
				}
			}
		}
	});
}

function blockHeaderClass() {
	var _this = this;
	let slidemenu;
	let overlay;
	let btnToggleSlidemenu;
	let headerLG;
	let headerSM;
	let headers = [];

	// Colores del fondo
	let newHeaderBackground = '';

	// Header LG scroll effect
	let headerScrollEffectApplied = false;

	this.fixHeaderLGSubmenu = function () {
		headerLG.find('.submenu').each(function (index, element) {
			const submenu = $(element);
			const parentLeft = submenu.parent().offset().left;
			const isThirdLevelSubmenu = submenu.parents('.submenu').length;
			const parentSubmenuWidth = (isThirdLevelSubmenu ? submenu.parents('.submenu').width() - 5 : 0);

			if (isThirdLevelSubmenu) {
				submenu.css('top', 0);
			}

			if (submenu.width() + parentLeft + 50 + parentSubmenuWidth >= $(window).width()) {
				if (isThirdLevelSubmenu) {
					submenu.css('left', parentSubmenuWidth * -1);
				}
				else {
					submenu.css('left', ($(window).width() - parentLeft) - (submenu.width() + parentSubmenuWidth));
				}
			}
			else {
				submenu.css('left', (isThirdLevelSubmenu ? parentSubmenuWidth : 0));
			}
		});
	}

	this.hasHeaderScrollEffectEnabled = function () {
		return (headerLG.attr('data-scroll-effect') == 1);
	}

	this.hasHeaderLGFixedPositionEnabled = function () {
		return (headerLG.attr('data-fixed') == 1)
	}

	this.scrollEffect = function () {
		let mainSection = headerLG.find('.header-main-section');
		let newPT = (parseInt($('.header-main-section').css('padding-top')) > 10 ? 10 : 0);
		let newBT = (parseInt($('.header-main-section').css('padding-bottom')) > 10 ? 10 : 0);

		// Copia de seguridad de algunos datos originales
		headerLG.attr('data-backup-header-bg', headerLG.get(0).style.background);
		headerSM.attr('data-backup-header-bg', headerSM.get(0).style.background);

		// Reemplazar logo al hacer scroll solo cuando la cabecera está fija
		if (_this.hasHeaderLGFixedPositionEnabled()) {
			blockHeaderLogoReplacementOnScroll(_this, headerSM);
			blockHeaderLogoReplacementOnScroll(_this, headerLG);
		}

		// Efecto al hacer scroll
		if (_this.hasHeaderScrollEffectEnabled()) {
			for (let i in headers) {
				let header = headers[i];

				if (header.attr('data-scroll-effect-bg')) {
					newHeaderBackground = header.attr('data-scroll-effect-bg');
				}
			}

			$(window).on('scroll', function (e) {
				if ($(window).scrollTop() >= 100) {
					if (!headerScrollEffectApplied) {
						setTimeout(function () {
							_APP.events.fire('header.fixed.docked');
						}, 500);

						_APP.events.fire('header.fixed.docking');

						mainSection.css('padding-top', newPT);
						mainSection.css('padding-bottom', newBT);

						_this._updateHeaderBackgroundToScrollEffect();

						headerScrollEffectApplied = true;
					}
				} else {
					if (headerScrollEffectApplied) {
						setTimeout(function () {
							_APP.events.fire('header.fixed.undocked');
						}, 500);

						_APP.events.fire('header.fixed.undocking');
					}

					mainSection.css('padding-top', '');
					mainSection.css('padding-bottom', '');

					_this._resetHeaderBackground();

					headerScrollEffectApplied = false;
				}
			}).scroll();
		}
	};

	this.openSlideMenu = function () {
		$('.header-slidemenu').addClass('visible');
		$('.header-slidermenu-overlay').addClass('visible');
		SmoothScroll.disable();
		Pty.frontend.disableScroll();

	}

	this.closeSlideMenu = function () {
		$('.header-slidemenu').removeClass('visible');
		$('.header-slidermenu-overlay').removeClass('visible');
		SmoothScroll.enable();
		Pty.frontend.enableScroll();
	}

	this.init = function () {
		headerLG = $('header .headerlg');
		headerSM = $('header .headersm');
		headers = [headerLG, headerSM];
		btnToggleSlidemenu = $('.toggle-global-slidemenu');
		slidemenu = $('.header-slidemenu');
		overlay = $('.header-slidermenu-overlay');

		btnToggleSlidemenu.on('click', function (e) {
			e.preventDefault();

			if (slidemenu.hasClass('visible')) {
				_this.closeSlideMenu();
			}
			else {
				_this.openSlideMenu();
			}
		});

		overlay.on('click', function (e) {
			e.preventDefault();
			_this.closeSlideMenu();
		});

		slidemenu.find('nav.menu .menuitem.has-submenu a i, nav.menu .menuitem.has-submenu a[href="#"]').on('click', function (e) {
			e.preventDefault();
			e.stopPropagation();
			const parent = (e.currentTarget.tagName == 'A' ? $(this).parent() : $(this).parent().parent());
			parent.find('> .submenu').slideToggle('fast');
			parent.find('> .submenu').toggleClass('expanded');
			parent.toggleClass('opened');
		});

		this.fixHeaderLGSubmenu();

		this.scrollEffect();

		_fixBlocksAfterHeaderStyle();

		blockHeaderCatalogueIntegration.init();

		// Agregamos un índice a los elementos del slide menu
		let index = 1;
		slidemenu.find('.menu > .menuitem').each((i, element) => {
			element.classList.add('item-animation-' + (i + 1));
			index++;
		});

		if (slidemenu.find('.menulang-wrapper .submenu .item').length) {
			slidemenu.find('.menulang-wrapper').addClass('item-animation-' + index);
			index++;
		}

		if ($.trim(slidemenu.find('.info-wrapper').text()) != '') {
			slidemenu.find('.info-wrapper').addClass('item-animation-' + index);
			index++;
		}

		if (slidemenu.find('.social-wrapper .social').length) {
			slidemenu.find('.social-wrapper').addClass('item-animation-' + index);
			index++;
		}

		// Ajustamos el estilo del slidemenu en pantalla completa
		if(slidemenu.hasClass('slidemenu-full-screen')) {
			overlay.hide(); // Ocultamos el overlay en caso de que sea un slidemenu a pantalla completa
			slidemenu.css('background-color', slidemenu.css('background-color').replace(')', ', .90)'));
		}

		// Ajustamos los idiomas en el slidemenu
		if(document.body.clientWidth <= 1020)
		{
			const slideMenuLang = slidemenu.find('.com-language-menu .submenu');
			const slideMenuTopAndHeight = (slideMenuLang.length ? slideMenuLang.offset().top + slideMenuLang.outerHeight() : 0);
			if(slideMenuTopAndHeight - 25 > $(window).height())
			{
				slideMenuLang.css({
					top: (slideMenuTopAndHeight - $(window).height() + 15) * -1,
				});
			}
		}

		blocksBottomCut();
		
		$('header').find('.social a').on('click', e => {
			_dataLayer('click_rrss', {content_type: e.currentTarget.getAttribute('aria-label')});
		});

		$('header').find('nav a:not([href="#"]):not(.btn-primary)').on('click', e => {
			let menu = '';
			let submenu = '';
			let subsubmenu = '';
			const link = $(e.currentTarget);
			const parent = link.parents('.menuitem');
			const level = link.parents('.menuitem').length;

			// Nivel 1: menú ítem
			if(level == 1) {
				menu = link.text();
			}

			// Subnivel: subitems de menú
			if(level == 2) {
				menu = parent.parent().closest('.menuitem').find('> a').text();
				submenu = link.text();
			}

			// Sub-subnivel: subitems de subitems del menú
			if(level == 3) {
				menu = parent.parent().closest('.menuitem').parent().closest('.menuitem').find('> a').text();
				submenu = parent.parent().closest('.menuitem').find('> a').text();
				subsubmenu = link.text();
			}

			_dataLayer('click_menu', {
				content_type_menu: menu,
				content_type_submenu: submenu,
				content_type_submenu2: subsubmenu,
			});
		});

		$('header').find('.btn-primary').on('click', e => {
			_dataLayer('cta_contact');
		});
	}

	this.disableHeaderLGTransparencyEffect = function () {
		let color = null;

		for (let i in headers) {
			let header = headers[i];

			if (header.attr('data-scroll-effect-bg')) {
				color = header.attr('data-scroll-effect-bg');

				if (color.length == 9) {
					newHeaderBackground = color.substr(0, 7);
				}
			}
			else {
				color = header.get(0).style.background.split(',');

				if (color.length == 4) {
					newHeaderBackground = color[0] + ',' + color[1] + ',' + color[2] + ')';
				}
			}
		}

		/*
		if(headerLG.attr('data-scroll-effect-bg'))
		{
			color = headerLG.attr('data-scroll-effect-bg');
			
			if(color.length == 9)
			{
				newHeaderBackground = color.substr(0, 7);
			}
		}
		else
		{
			color = headerLG.get(0).style.background.split(',');

			if(color.length == 4)
			{
				newHeaderBackground = color[0] + ',' + color[1] + ',' + color[2] + ')';
			}
		}
			*/

		if (headerScrollEffectApplied)
			this._updateHeaderBackgroundToScrollEffect();
		else
			this._resetHeaderBackground();
	}

	// Actualizamos el fondo de la cabecera al efecto de cuando se ha hecho scroll
	this._updateHeaderBackgroundToScrollEffect = function () {
		for (let i in headers) {
			let header = headers[i];

			header.get(0).style.background = newHeaderBackground;
			header.css('backdrop-filter', 'blur(10px)');

			if (header.attr('data-scroll-effect-bg')) {
				header.removeClass('has-' + header.attr('data-bg'));
				header.addClass('has-' + header.attr('data-scroll-effect-bg-class'));
			}
		}
	}

	// Reseteamos el fondo de la cabecera
	this._resetHeaderBackground = function () {
		for (let i in headers) {
			let header = headers[i];
			header.get(0).style.background = header.attr('data-backup-header-bg');
			header.css('backdrop-filter', 'blur(0px)');

			// Cambiamos de fondo solo si hay un color configurado para ello
			if (header.attr('data-scroll-effect-bg')) {
				header.removeClass('has-' + header.attr('data-scroll-effect-bg-class'));
				header.addClass('has-' + header.attr('data-bg'));
			}
		}
	}
}

function blockHeaderLogoReplacementOnScroll(object, header) {
	let imgHeaderLogo = header.find('.logo-wrapper img');
	let imgHeaderSecondaryLogo = imgHeaderLogo.clone();
	let sizeMultiplier = 1;
	let imgHeaderLogoWidth = imgHeaderLogo.width();
	const headerSmWidth = imgHeaderLogo.parents('.logo-wrapper').width() - 20;
	let imgHeaderSecondaryLogoHeight = (parseInt(imgHeaderSecondaryLogo.attr('data-fixed-header-logo-height')) ? parseInt(imgHeaderSecondaryLogo.attr('data-fixed-header-logo-height')) : null);;
	const isMobile = ($(window).width() <= 1024);
	const jqueryAnimationDuration = 1;

	// Establcemos el ancho para poder hacer la transformación del logo principal
	if (isMobile) {
		imgHeaderLogo.css('width', imgHeaderLogoWidth);
	}

	// Obtenemos un alto calculado para el logo secundario
	if (isMobile) {
		let tmpHeaderLogoHeight = parseInt(imgHeaderLogo.css('height'));
		//imgHeaderSecondaryLogoHeight = tmpHeaderLogoHeight;
		imgHeaderSecondaryLogoHeight /= 2;

		if (tmpHeaderLogoHeight) {
			if (imgHeaderSecondaryLogoHeight < tmpHeaderLogoHeight) {
				imgHeaderSecondaryLogoHeight = tmpHeaderLogoHeight;
			}
		}
		else {
			imgHeaderSecondaryLogoHeight = 65;
		}
	}

	imgHeaderLogo.attr('data-height', imgHeaderLogo.height());
	imgHeaderLogo.attr('data-current-logo', 'default');

	// El logo secundario lo agregamos al contenedor
	imgHeaderSecondaryLogo.css({
		'position': 'absolute',
		'top': 0,
		'left': 0,
		'width': '100%',
		'height': '100%',
		'object-fit': 'contain',
		'opacity': 0,
	}).attr('src', imgHeaderLogo.attr('data-fixed-header-logo'));

	imgHeaderLogo.parent().css({
		'position': 'relative',
		'display': 'inline-block',
	}).append(imgHeaderSecondaryLogo);

	$(window).on('scroll', e => {

		// Si hemos sobrepasado los 100px haciendo scroll, ocultamos el logo principal y mostramos el secundario
		if ($(window).scrollTop() >= 100) {

			// Cuando tiene logo secundario deberemos cambiar un logo por otro y cambiar el alto si procede
			if (imgHeaderLogo.attr('data-fixed-header-logo')) {
				if (imgHeaderLogo.attr('data-current-logo') != 'fixed') {
					imgHeaderSecondaryLogo.css('opacity', 1);

					// Problema safari: forzamos el repaint con esto
					if (isMobile)
						imgHeaderSecondaryLogo.stop().animate({ opacity: 0.99999 }, jqueryAnimationDuration);

					imgHeaderLogo.css({ opacity: 0 }).attr('data-current-logo', 'fixed');

					// Problema safari: forzamos el repaint con esto
					if (isMobile)
						imgHeaderLogo.stop().animate({ opacity: 0.00001 }, jqueryAnimationDuration);

					// Establecemos las medidas del logo principal para que haya un efecto de transformación
					// En caso de que haya un alto explícito del logo secundario, tomaremos ese
					if (imgHeaderSecondaryLogoHeight) {
						imgHeaderLogo.css('height', imgHeaderSecondaryLogoHeight);

						// Si estamos en el móvil, le damos el ancho máximo de la cabecera
						if (isMobile)
							imgHeaderLogo.css('width', headerSmWidth);
					}
					// En caso contrario lo haremos automático
					// Solo aplicamos el efecto de transformación cuando esté activado el efecto scroll
					// Además, para prevenir problemas, establecemos un ancho máximo
					else if (object.hasHeaderScrollEffectEnabled() && imgHeaderSecondaryLogo.get(0).naturalHeight > 0) {
						if (imgHeaderSecondaryLogo.get(0).naturalHeight > 150) {
							sizeMultiplier = 150 / imgHeaderSecondaryLogo.get(0).naturalHeight;
						}

						imgHeaderLogo.css('height', imgHeaderSecondaryLogo.get(0).naturalHeight * sizeMultiplier);
					}
				}
			}
			// Cuando tiene efecto scroll activado cambiamos el alto del logo principal para darle efecto (en el móvil evitamos este efecto)
			else if (object.hasHeaderScrollEffectEnabled() && !isMobile) {
				imgHeaderLogo.css({
					height: parseInt(imgHeaderLogo.attr('data-height')) - 5,
				});
			}
		}
		// Si no, mostramos el principal y ocultamos el secundario
		else {
			imgHeaderLogo.css({
				opacity: 1,
				height: imgHeaderLogo.attr('data-height'),
			}).attr('data-current-logo', 'default');

			// Problema safari: forzamos el repaint con esto
			if (isMobile)
				imgHeaderLogo.stop().animate({ opacity: 1 }, jqueryAnimationDuration);

			imgHeaderSecondaryLogo.css('opacity', 0);

			// Problema safari: forzamos el repaint con esto
			if (isMobile)
				imgHeaderSecondaryLogo.stop().animate({ opacity: 0 }, jqueryAnimationDuration);

			// Reseteamos el ancho del logo principal a su ancho original
			if (isMobile)
				imgHeaderLogo.css('width', imgHeaderLogoWidth);
		}
	}).scroll();
}

function blockHeaderCatalogueIntegrationClass() {
	var _this = this;
	let modal = $('.catalogue-search-wrapper');
	let background = $('.catalogue-search-background');
	let input = modal.find('input');
	let iconSearch = modal.find('.input i');
	let timeout = 0;
	let itemsContainer = modal.find('.results');
	let ajax;

	this.showModal = function () {
		modal.addClass('visible');
		background.addClass('visible');

		setTimeout(function () {
			input.focus();
		}, 200);

		$(document).on('keyup', function (e) {
			if (e.keyCode == 27)
				_this.closeModal();
		});
	}

	this.closeModal = function () {
		modal.removeClass('visible');
		background.removeClass('visible');
		$(document).off('keyup');
	}

	this._search = function (value) {
		if (value.length <= 3)
			return;

		if (ajax)
			ajax.abort();

		ajax = $.post(modal.attr('data-catalogue-url'), {
			token: _APP.frontend.token,
			id: _APP.frontend.catalogue.id,
			lang: _APP.frontend.language,
			q: value,
			preview: (_APP.builder || _APP.frontend.preview),
			url: document.location.href,
		}, function (response) {
			iconSearch.attr('class', 'ti-search');
			try {
				response = $.parseJSON(response);

				itemsContainer.html(response.items);
			}
			catch (err) {
				alert(err)
			}
		});
	}

	this.init = function () {
		$('.open-catalogue-search').on('click', function (e) {
			_this.showModal();
		});

		modal.find('.btn-close').on('click', function (e) {
			e.preventDefault();
			_this.closeModal();
		});

		background.on('click', function (e) {
			_this.closeModal();
		});

		$(window).on('hashchange', function (e) {
			if (modal.hasClass('visible') && document.location.hash == '')
				_this.closeModal();
		});

		input.on('keyup', function (e) {

			iconSearch.attr('class', 'fa fa-spinner fa-pulse');

			clearTimeout(timeout);

			timeout = setTimeout(function () {
				_this._search(input.val());
			}, 700);

			if ($(this).val() == '') {
				iconSearch.attr('class', 'ti-search');
			}
		});
	}
}

$(document).ready(function () {
	blockHeader.init();
});