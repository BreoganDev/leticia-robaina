var _SRCSET = new Array;

var Pty = {};

Pty.frontend = {
	getScrollBarWidth: function() {
		if(localStorage.getItem('scrollbar-width') == null)
		{
			let scrollBarWidth = 0;
			let inner = document.createElement('p');
			inner.style.width = "100%";
			inner.style.height = "200px";
			
			let outer = document.createElement('div');
			outer.style.position = "absolute";
			outer.style.top = "0px";
			outer.style.left = "0px";
			outer.style.visibility = "hidden";
			outer.style.width = "200px";
			outer.style.height = "150px";
			outer.style.overflow = "hidden";
			outer.appendChild (inner);
			
			document.body.appendChild (outer);
			let w1 = inner.offsetWidth;
			outer.style.overflow = 'scroll';
			let w2 = inner.offsetWidth;
			if (w1 == w2) w2 = outer.clientWidth;
			
			document.body.removeChild (outer);
		
			scrollBarWidth = (w1 - w2);

			localStorage.setItem('scrollbar-width', scrollBarWidth);
		}
			
		return localStorage.getItem('scrollbar-width');
	},
	enableScroll: function() {
		$('#builder-header').css('padding-right', 0);
		$('body').css('padding-right', 0)
			.css('overflow', 'auto');
	},
	disableScroll: function() {
		let scrollBarWidth = Pty.frontend.getScrollBarWidth();

		$('#builder-header').css('padding-right', parseInt(scrollBarWidth));
		$('body')
			.css('padding-right', parseInt(scrollBarWidth))
			.css('overflow', 'hidden');
	}
};

function getScrollBarWidth()
{
	var inner = document.createElement('p');
	inner.style.width = "100%";
	inner.style.height = "200px";
	
	var outer = document.createElement('div');
	outer.style.position = "absolute";
	outer.style.top = "0px";
	outer.style.left = "0px";
	outer.style.visibility = "hidden";
	outer.style.width = "200px";
	outer.style.height = "150px";
	outer.style.overflow = "hidden";
	outer.appendChild (inner);
	
	document.body.appendChild (outer);
	var w1 = inner.offsetWidth;
	outer.style.overflow = 'scroll';
	var w2 = inner.offsetWidth;
	if (w1 == w2) w2 = outer.clientWidth;
	
	document.body.removeChild (outer);
	
	return (w1 - w2);
}

function replaceVarsWithValues(text, arrayValues)
{
    var replaceArray = new Array;
    var rxp = /{([^}]+)}/g;
    var curMatch;

	while(curMatch = rxp.exec(text))
	{
    	replaceArray.push(curMatch[1]);
	}

	for(var i = 0; i < replaceArray.length; i++)
	{
	    text = text.replace(new RegExp('{' + replaceArray[i] + '}', 'gi'), arrayValues[replaceArray[i]]);
	}
	
	return text;
}

function isEmptyValue(value)
{
	return (value == '0' || value == undefined || !value);
}

function _isMobileBrowser()
{
  var check = false;
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od|ad)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
  return check;
}

function _onBlockFormSubmitted(block)
{
	if(typeof(gtag) == 'function')
	{
		try
		{
			gtag('event', 'AJAX form submit', {
			    'event_category': 'form_submitted',
			    'event_label': 'Form',
			    'value': block.find('form').attr('action'),
			});
		}
		catch(err)
		{
			console.err(err);
		}
	}

	_dataLayer('form_contact');
	_trackPageView(block.find('form').attr('action'));
	_connectifFormSubmitted();
	window._APP.events.fire('blocks.form.submitted', {block: block});
}

function _dataLayer(event, data)
{
	if(_APP.environment == 'development')
	{
		console.log('GTM event: ' + event, data);
	}

	if(_APP.builder || window.google_tag_manager == 'undefined' || window.dataLayer == undefined)
	{
		return false;
	}

	if(!data)
		data = {};

	data.event = event;
	window.dataLayer.push(data);
}

function _connectifFormSubmitted()
{
	if(typeof connectif == 'undefined' || localStorage.getItem('cn_last_submitted_form_id') == null)
		return false;
	
	var options = {
		onResponded: function()
		{
			localStorage.removeItem('cn_last_submitted_form_id');
		    localStorage.removeItem('cn_last_submitted_form_primary_key_field');
		    localStorage.removeItem('cn_last_submitted_form_data');
		}
	};
	
	connectif.managed.sendEvents([
        {
            type: 'form-submitted',
            formId: localStorage.getItem('cn_last_submitted_form_id'),
            primaryKeyField: localStorage.getItem('cn_last_submitted_form_primary_key_field'),
            payload: JSON.parse(localStorage.getItem('cn_last_submitted_form_data')),
        }
    ], options);
}

function _trackPageView(url)
{
	var UA = null;
	
	if(typeof(ga) == 'function')
	{
		try
		{
			UA = ga.getAll()[0].get('trackingId');
			
			// https://developers.google.com/analytics/devguides/collection/analyticsjs/pages
			ga('create', UA);
			ga('send', 'pageview', url);
		}
		catch(err)
		{
			console.err('Error: ga.send.pageview: ' + err);
		}
	}
	else if(typeof(_gat) == 'object')
	{
		try
		{
			var analyticsLegacyTexto = '_gat._getTracker("';
			var posicion1 = body.indexOf(analyticsLegacyTexto);
			var analyticsLegacyUA = body.substr(posicion1 + analyticsLegacyTexto.length, 20);
			var posicion2 = analyticsLegacyUA.indexOf('"');
			
			UA = body.substr(posicion1 + analyticsLegacyTexto.length, posicion2);
			
			pageTracker._trackPageview(url);
		}
		catch(err)
		{
			console.err('Error: pageTracker: ' + err);
		}
	}
	else if(typeof(gtag) == 'function')
	{
		try
		{
			gtag('event', 'page_view', {
			  page_title: document.title,
			  page_location: window.location.origin + url,
			  page_path: url,
			  //send_to: '<GA_MEASUREMENT_ID>'
			});

			/*
			https://developers.google.com/analytics/devguides/collection/gtagjs/pages#page_view_event
			https://developers.axeptio.eu/cookies/gtag-and-google-consent-mode
			*/
		}
		catch(err)
		{
			console.err('Error: ' + err);
		}
	}
	else
	{
		console.warn('Warning: Google Analytics Tracking not detected.');
	}
}

function setBodyScroll(enabled)
{
	var scrollBarWidth = 0;
	var body = $("body");
	var builderHeader = $('#builder-header');

	if (typeof(Storage) == "undefined"){
		scrollBarWidth = getScrollBarWidth();
	}else{
		if(localStorage.getItem('scrollbar-width') == null ){

			localStorage.setItem('scrollbar-width', getScrollBarWidth());
		}
		
		scrollBarWidth = localStorage.getItem('scrollbar-width');
	}
	
	if(enabled == false)
	{
		builderHeader.css('padding-right', parseInt(scrollBarWidth));
		body.css('padding-right', parseInt(scrollBarWidth));
		body.css('overflow', 'hidden');
	}
	else if(enabled == true)
	{
		builderHeader.css('padding-right',0);
		body.css('padding-right',0);
		body.css('overflow', 'auto');
	}
}

function frontendbuildAdvancedBblock(block, obj)
{
	block = $(block);
	
	block.status = {
		isInitialized: function()
		{
			return block.attr('data-init');
		},
		initialized: function()
		{
			block.attr('data-init', 1)
		},
	};
	
	block.info = {
		usesExternalData: function()
		{
			return block.hasClass('block-external-data');
		}
	};
	
	return block;
}

function frontendBuildAllMaps()
{
	$('.block .frontend-map').each(function(index, element) {
		
		var block = $(element).parents('.block');
		
		frontendBuildMap(block);
	});
}

function frontendBuildMap(block)
{
	if(block.length > 1)
	{
		for(var i = 0; i < block.length; i++)
		{
			if($(block[i]).hasClass('block'))
			{
				block = $(block[i]);
				break;
			}
		}
	}
	
	if(typeof(google) != 'object')
		return;
	
	var geocoder = new google.maps.Geocoder;
	var id = 'block-map-' + block.attr('data-id');
	var map = $('#' + id);
    var bounds = null;
    
    if(map.length == 0)
    	return;
    
    // Set map height
    if(map.height() == 0)
    	map.css('height', map.parent().height());
    
    // Get all coords
    var mapLocations = window['mapLocations' + block.attr('data-id')];
	var markers = [];
	
    if(mapLocations == undefined)
    	return;
    
    // Parse values from String to Float
    for(var i in mapLocations)
    {
    	mapLocations[i].lat = parseFloat(mapLocations[i].lat);
    	mapLocations[i].lng = parseFloat(mapLocations[i].lng);
    }
    	
    // Init map
    bounds = new google.maps.LatLngBounds();
    
    blockMap = new google.maps.Map(map.get(0), {
        zoom: parseInt(map.attr('data-zoom')),
        center: mapLocations[0],
        scrollwheel: false,
    });
    
    // Add markers
	if(map.attr('data-marker') == 1)
	{
		for(var i in mapLocations)
		{
		    markers[i] = new google.maps.Marker({
		        position: mapLocations[i],
		        map: blockMap,
		        title: '',
		        icon: '/assets/common/img/map-marker-icon-32x32.png',
		    });
		    
		    markers[i].__index = i;
		    
		    // extend the bounds to include each marker's position
		    bounds.extend(markers[i].position);
		}
		
		// now fit the map to the newly inclusive bounds. Only applicable when there's more than one marker
		if(mapLocations.length > 1)
		{
			blockMap.maxDefaultZoom = 15;

			google.maps.event.addListenerOnce(blockMap, "bounds_changed", function () {
				this.setZoom(Math.min(this.getZoom(), this.maxDefaultZoom));
			});
				
			blockMap.fitBounds(bounds);
		}
	}
	
	// Map style
	var mapStyle = map.attr('data-style');
	
	if(mapStyle)
    	blockMap.setOptions({styles: window[mapStyle].style});
    
    // Project locations
    if(map.attr('data-marker') == 1 && mapLocations.length > 1)
    {
    	var infoWindowArray = [];
    	
    	for(var i in mapLocations)
    	{
    		let info = mapLocations[i];
    		let html = '<b>' + info.nombre + '</b>';
    		
    		html += '<br>' + info.direccion;
    		html += '<br>' + info.ciudad;
    		
    		if(info.telefono || info.email)
    			html += '<br>';
    		
    		if(info.telefono)
    			html += '<br><i class="fa fa-phone"></i> <a href="tel:' + info.telefono + '">' + info.telefono + '</a>';
    		
    		if(info.email)
    			html += '<br><i class="fa fa-envelope"></i> <a href="mailto:' + info.email + '">' + info.email + '</a>';
    		
		    infoWindowArray[i] = new google.maps.InfoWindow({
		    	content: html
			});
			
			markers[i].addListener('click', function() {
				let index = this.__index;
		    	infoWindowArray[index].open(blockMap, markers[index]);
			});
    	}
    }
    // Automatic infor window from Google for specific locations
    else if(map.attr('data-marker') == 1)
    {
    	var infoWindowArray = [];
    	
    	for(var i in mapLocations)
    	{
			infoWindowArray[i] = new google.maps.InfoWindow({
		    	content: null
			});
			
			markers[i].addListener('click', function() {
				
				let index = this.__index;
				
				if(!infoWindowArray[index].__content)
				{
					geocoder.geocode({'location': mapLocations[index]}, function(results, status) {

			        	if(status === 'OK')
			        	{
			            	if(results[0])
			            	{
								infoWindowArray[index].setContent(results[0].formatted_address);
								infoWindowArray[index].open(blockMap, markers[index]);
								infoWindowArray[index].__content = true;
			            	}
			        	}
			    	});
				}
				else
				{
					infoWindowArray[index].open(blockMap, markers[index]);
				}
			});
    	}
	}
}

function frontendInputRange(content)
{
	content.find('input[type="range"]').each(function(index, element) {
		
		element = $(element);
		
		element.on('input change', function() {

			var control = $(this),
			  controlMin = control.attr('min'),
			  controlMax = control.attr('max'),
			  controlVal = control.val(),
			  controlThumbWidth = control.data('thumbwidth'),
			  tooltip = controlVal;
	
			if(control.data('format') != undefined)
			{
				var format = control.data('format');
				tooltip = format.replace('%VALUE%', controlVal);
			}

			var range = controlMax - controlMin;
			
			var position = ((controlVal - controlMin) / range) * 100;
			var positionOffset = Math.round(controlThumbWidth * position / 100) - (controlThumbWidth / 2);
			var output = control.next('.output');

			output
			  .css('left', 'calc(' + position + '% - ' + positionOffset + 'px)')
			  .text(tooltip);
	
		});
    
    	element.change();
	});
}

function isElementInViewport($element, margin) {
	if(!$element || !$element.length)
		return;

    const elementTop = $element.offset().top;
    const elementBottom = elementTop + $element.outerHeight();

    const viewportTop = $(window).scrollTop();
    const viewportBottom = viewportTop + $(window).height();

	if(margin == undefined) {
		margin = 0;
	}

    return elementBottom + margin > viewportTop && elementTop - margin < viewportBottom;
}

function backgroundImageParallax()
{
	$('.block-background-image-parallax').each(function (index, element) {
		element = $(element);

		const block = element.parents('.block');
		const element_height = (element.hasClass('block-background-image').length ? element.outerHeight() : element.parents('.block-background-image').outerHeight());
		const block_background_image = (element.hasClass('block-background-image').length ? element : element.parents('.block-background-image'));
		const scroll_top = $(window).scrollTop();
		let step = 0.15;
		let size = 1.4;

		if (!block || !element_height)
			return;

		if(!element.hasClass('parallax-height-fixed')) {
			element.css('height', element_height * size);
			element.addClass('parallax-height-fixed');
		}

		if (isElementInViewport(block_background_image, 20)) {

			if (element.hasClass('with-scale-effect')) {
				step = (isMobile() ? 0.1 : 0.2);
				size = 0.1;
				element.css('top', '-12%');
			}

			scrolled = scroll_top - block_background_image.offset().top;

			element.css('transform', 'translate3D(0, ' + (scrolled * step) + 'px' + ', 0)');
		}
	});
}

function bodyBackgroundImageParallax()
{
	const bgContainer = $('#body-bg');
	const bg = bgContainer.find('.bg');
	const window_height = $(window).height();

	if(!bgContainer.length)
		return;
	    
	if($(window).scrollTop() + window_height >= bgContainer.offset().top)
	{
		scrolled = $(window).scrollTop() * -0.3;

		bg.css('transform', 'translate3D(0, ' + scrolled + 'px' + ', 0)');
	}
}

function backgroundVideoFixed()
{
	$('.block-background-image-fixed').each(function(index, element) {
		
		var element = $(element);
		
		if(element.find('video').length == 0)
			return;
		
		var block = element.parents('.block');
	    var window_height = $(window).height();
	    
	    if($(window).scrollTop() + window_height >= block.offset().top)
	    {
	    	scrolled = $(window).scrollTop() - block.offset().top;
	    	scrolled = scrolled;
	    	
	    	element.css('transform', 'translate3D(0, ' + scrolled + 'px' + ', 0)');
	    }
	});
}

function backgroundImageAnimationLoadEvent()
{
	$(".block-background-image img").one("load", function() {
  		$(this).addClass('block-background-image-visible');
  		
  		var parallax = $(this).parents('.block-background-image-parallax');
  		var isSlider = $(this).parents('.block-slider').length;
  		var img = $(this);

  		if(parallax && !isSlider)
  		{
  			setBackgroundImageParallaxSize(parallax, img);
  		}
  		
	}).each(function() {
  		if(this.complete)
  		{
  			$(this).load();
  			
  		}
	});
}

function setBackgroundImageParallaxSize(parallax, img)
{
	return false;
	
	
	var plus = 250;
	
	if((parallax.height() + plus) > img.height())
	{
		img.css('width', 'auto');
		img.css('height', parallax.height() * 1.5);
		
		if(img.width() * 1.3 > parallax.width())
			img.css('margin-left', parallax.width() * -0.25);
	}
	else
	{
		//img.css('width', parallax.width() * 1.1);
		img.css('width', '100%');
		img.css('height', 'auto');
		img.css('margin-left', 0);
	}

	$('.block').css('border', '1px solid red')
}

function setAllBackgroundImagesParallaxSizes()
{
	$('.block-background-image-parallax').each(function(index, element) {
		
		setBackgroundImageParallaxSize($(element), $(element).find('img'));
		
	});
}

function initPrototypeFunctions()
{
	HTMLButtonElement.prototype.setDefaultStatus = function() {
		
		var btn = $(this);
		
		btn.removeClass('btn-second-status');
		btn.attr('data-second-status', btn.html());
		btn.html(btn.attr('data-default-status'));
	};
	
	HTMLButtonElement.prototype.setSecondStatus = function() {
		
		var btn = $(this);
		
		if(btn.hasClass('btn-second-status'))
			return;
		
		btn.addClass('btn-second-status');
		btn.attr('data-default-status', btn.html());
		btn.html(btn.attr('data-second-status'));
	};
}

function scrollToTop(setClickEvent)
{
	var s = $('#scroll-to-top');
	
	if(s.length == 0)
	{
		return;
	}
	
	if($(document).scrollTop() >= 300)
	{
		s.addClass('shown');
		_APP.events.fire('scrollToTopShown');
	}
	else
	{
		s.removeClass('shown');
		_APP.events.fire('scrollToTopHidden');
	}
	
	if(setClickEvent == true)
	{
		s.click(function() {
			$('html,body').animate({ scrollTop: 0 }, 'slow');
		});
	}
}

function setAnchorNavigationItems(selector)
{
	var block;
	
	if(selector == undefined || selector == '' || !selector)
		selector = '#wrapper .block';
	
	if(typeof selector == 'string')
	{
		block = $(selector);
	}
	else
	{
		block = selector;
	}
	
	block.find('a[href*="#"]').each(function(index, element) {
		
		var href = $(this).attr('href').split('#');
		
		href = href[1];
		
		if(href.length > 1 && $.isNumeric(href) && ($('.block[data-id="' + href + '"]').length > 0 || $('.block[data-id-cfg="' + href + '"]').length > 0))
		{
			$(element).on('click', function(e) {
				
				e.preventDefault();
					
				navigateToBlockById(href);
				
				if(blockHeader != undefined)
				{
					blockHeader.closeSlideMenu()
				}
			});
		}
	});
}

function findAnchorNavitgationItemInURL()
{
	var id = window.location.hash.substr(1);
	
	if($.isNumeric(id))
	{
		navigateToBlockById(id);
	}
}

function navigateToBlockById(id)
{
	var block = $('.block[data-id="' + id + '"]');
	var interval = 0;
	var headerHeight = 0;
	var top = 0;
	var oldWindowScrollTop = [];
	var newWindowScrollTop = 0;
	
	if(block.length == 0)
		block = $('.block[data-id-cfg="' + id + '"]');
		
	if(block.length >= 1)
	{
		var resizeObserver;
		var documentHeight1 = document.body.clientHeight;
		var header = $('.block-header .headerlg');

		var animate = function() {
			$('body, html').stop().animate({ scrollTop: block.offset().top }, 500, 'linear', function() {
				if(documentHeight1 != document.body.clientHeight)
				{
					animate();
				}
				else
				{
					if('ResizeObserver' in window)
					{
						resizeObserver.unobserve(document.body);
					}
				}
			});
		};
		
		animate();
		
		if('ResizeObserver' in window)
		{
			resizeObserver = new ResizeObserver(function(entries) {
				documentHeight1 = entries[0].target.clientHeight;
				animate();
			});
			
			resizeObserver.observe(document.body);
		}
	}
	else
	{
		console.warn('Err: block id not found');
	}
}

function initSrcSet()
{
	$('img[data-srcset]').each(function(index, element) {
		
		var element = $(element);
		var items = element.attr('data-srcset').split(',');
		
		element.attr('data-srcset-id', index);
		
		for(var i in items)
		{
			var item = $.trim(items[i]).split(' ');
			var url = item[0];
			var width = parseInt(item[1]);
			
			if(_SRCSET[index] == undefined)
				_SRCSET[index] = new Array;
				
			_SRCSET[index].push({
				url: url,
				w: width
			});
		}
		
	});
	
	buildSrcSet();
}

function buildSrcSet()
{
	for(var i in _SRCSET)
	{
		var item = _SRCSET[i];
		
		for(var j = item.length - 1; j >= 0; j--)
		{
			if(item[j].w <= $(window).width())
			{
				$('img[data-srcset-id=' + i + ']').attr('src', item[j].url);
				break;
			}
		}
	}
}

function isMobile()
{
	if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) && document.body.clientWidth <= 1020)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function isSmallScreen()
{
	return document.body.clientWidth <= 1020;
}

function mobileVideos()
{
	$('.block .block-background-image video').each(function(index, element) {
		element.play();
	});
}

function inputFileImageThumbnailsOnChange(evt, onLoadedImage)
{
	var files = evt.target.files; // FileList object

	// Loop through the FileList and render image files as thumbnails.
	for (var i = 0, f; f = files[i]; i++) {
	
	    // Only process image files.
	    if (!f.type.match('image.*')) {
	        continue;
	    }
	
	    var reader = new FileReader();
	
	    // Closure to capture the file information.
	    reader.onload = (function(theFile) {
	        return function(e) {
	            
	            if(typeof(onLoadedImage) == 'function' && e.target.result != undefined)
	            {
	            	onLoadedImage(e.target.result);
	            }
	            
	        };
	    })(f);
	
	    // Read in the image file as a data URL.
	    reader.readAsDataURL(f);
	}
}

window.screen.isSmall = function() {
	return $(window).width() <= 980;
}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  var expiration = (exdays.minutes ? (exdays.minutes*60*1000) : (exdays*24*60*60*1000));
  d.setTime(d.getTime() + expiration);
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkPreviewNotice()
{
	function _updatePosition()
	{
		var top = (notice.height() + parseInt(notice.css('padding-top')) + parseInt(notice.css('padding-bottom'))) - $(window).scrollTop();
			
		if(top < 0)
			top = 0;
		
		header.css('top', top);
	}
	
	if(_APP.frontend.preview && $('.preview-notice').is(':visible') && $('.block-header .full-header.block-header-offscreen-sticky').length > 0)
	{
		var header = $('.block-header .full-header.block-header-offscreen-sticky');
		var notice = $('.preview-notice');
		
		header.get(0).style.transition = 'background, height .2s';
		
		_updatePosition();
		
		$(window).on('scroll', function(e) {

			_updatePosition();
		});
	}
}

function _animateBlocks()
{
	let blocks = document.querySelectorAll('.layout-row');
	const delay = 200;

	const observer = new IntersectionObserver(function(entries) {
		entries.forEach(entry => {
			if(entry.intersectionRatio > 0)
			{
				var element = entry.target;
				
				if(element.tagName == 'IMG')
				{
					element.addEventListener('load', function(event) {
						element.dataset.ptaniStatus = 1;
					});
					$(element).load();
					
					if(element.complete)
						element.dataset.ptaniStatus = 1;
				}
				else
				{
					element.dataset.ptaniStatus = 1;
				}
				
				observer.unobserve(entry.target);
			}
		});
	}, { 
		root: null,
		//threshold: 1.0,
		trackVisibility: true,
		delay: 100,
	});

	if(!blocks.length)
	{
		let index = 0;
		document.querySelectorAll('[data-ptani-status="0"]').forEach(element => {
			if(!element.classList.contains('block-customizer-item'))
				element.style.transitionDelay = index * delay + 'ms';
			observer.observe(element);
			index++;
		});
	}
	else
	{
		blocks.forEach(block => {
			let index = 0;
			block.querySelectorAll('[data-ptani-status="0"]').forEach(element => {
				if(!element.classList.contains('block-customizer-item'))
					element.style.transitionDelay = index * delay + 'ms';
				observer.observe(element);
				index++;
			});
		});
	}
}

function _animateBlocks__OLD()
{
	var scrolling = false;

	var handleScrollEvent = function() {
		if(scrolling)
    		return;
    	
    	scrolling = true;
    	
    	doAnimations();
		
		setTimeout(function() {
			scrolling = false;
			doAnimations();
		}, 15);
	}
	
	var whichTransitionEvent = function(){
	  var t;
	  var el = document.createElement("fakeelement");
	
	  var transitions = {
	    "transition"      : "transitionend",
	    "OTransition"     : "oTransitionEnd",
	    "MozTransition"   : "transitionend",
	    "WebkitTransition": "webkitTransitionEnd"
	  }
	
	  for (t in transitions){
	    if (el.style[t] !== undefined){
	      return transitions[t];
	    }
	  }
	  
	  return null;
	}
	
	var transitionEvent = whichTransitionEvent();
	
	var doAnimations = function() {
	    // Calc current offset and get all animatables
	    var offset = $(window).scrollTop() + $(window).height();
		var $animatables = $('[data-ptani-status="0"]');
		var delay = 0;
		
	    // Unbind scroll handler if we have no animatables
	    if($animatables.length == 0)
	    {
			$(window).off('scroll', doAnimations);
			$(window).off('resize', doAnimations);
	    }
	    
	    if(localStorage.getItem('ptanidebug') == 1)
	    {
			$('body').addClass('ptanidebug');
	    }
	    
		$animatables.each(function(i, element) {
			var $animatable = $(this);
			
			if($animatable.offset().top - 40 < offset)
			{
				$animatable.get(0).style.webkitTransitionDelay = i * 150 + 'ms';
				$animatable.get(0).style.transitionDelay = i * 150 + 'ms';

				$animatable.attr('data-ptani', $animatable.attr('data-ptani-value')).removeAttr('data-ptani-value');
				
				$animatable.get(0).style.webkitTransitionDuration = '0.1s';
				$animatable.get(0).style.MozTransitionDuration = '0.1s';
				$animatable.get(0).style.OTransitionDuration = '0.1s';
				$animatable.get(0).style.transitionDuration = '0.1s';
				
				if($animatable.is(':visible') && $('body').hasClass('browser-safari'))
				{
					setTimeout(function() {
						$animatable.get(0).style.webkitTransitionDuration = null;
						$animatable.get(0).style.MozTransitionDuration = null;
						$animatable.get(0).style.OTransitionDuration = null;
						$animatable.get(0).style.transitionDuration = null;
				
						$animatable.attr('data-ptani-status', '1');	
					}, 200);
				}
				else if(!$animatable.is(':visible'))
				{
					$animatable.attr('data-ptani-status', '1');
				}
				else if(transitionEvent)
				{
					$animatable.on(transitionEvent, function(e) {
						$animatable.get(0).style.webkitTransitionDuration = null;
						$animatable.get(0).style.MozTransitionDuration = null;
						$animatable.get(0).style.OTransitionDuration = null;
						$animatable.get(0).style.transitionDuration = null;

						if($(window).scrollTop() < 40)
						{
							setTimeout(function() {
								$animatable.attr('data-ptani-status', '1');
							}, 100);
						}
						else
						{
							$animatable.attr('data-ptani-status', '1');
						}
					});
				}
				else
				{
					setTimeout(function() {
						$animatable.attr('data-ptani-status', '1');
					}, 800);
				}
			}
	    });
	};
  
	//$(window).on('resize', handleScrollEvent);
	$(window).on('scroll', handleScrollEvent);
	$(window).trigger('scroll');
}

function blockShare()
{
	// Share
	if(window.navigator.share != undefined)
		$('.block-share-navigator').removeClass('hidden');
		
	$('.block-share-navigator').on('click', function(e) {
		e.preventDefault();
		
		if(window.navigator.share != undefined)
		{
			window.navigator.share({
				title: document.title,
				text: $(this).attr('data-share-text'),
				url: window.location.href,
			});
		}
	});
	
	// Whatsapp
	if(window.screen.isSmall())
		$('.block-share-whatsapp').removeClass('hidden');
}

function _mutationObserver()
{
	let observer = new MutationObserver(mutationRecords => {
		_animateBlocks();
	});

	// observa todo exceptuando atributos
	observer.observe(document.getElementById('wrapper'), {
		childList: true, // observa hijos directos
		subtree: true, // y descendientes inferiores también
		characterDataOldValue: true // pasa el dato viejo al callback
	});
}

function addReadMoreButton(block)
{
	if(!block)
		block = $('body');
		
	block.find('.pt-read-more').each(function(index, element) {
		let button = $('<a href="#" class="read-more-button">' + _APP.t('leer_mas') + '</a>');
		let buttonWrapper = $('<div class="read-more-content-wrapper"></div>');
		const content = $(element);

		if(!content.prev().hasClass('read-more-content-wrapper'))
		{
			buttonWrapper.append(button);
			content.before(buttonWrapper);
			content.slideUp(0);
		}
		else
		{
			buttonWrapper = content.prev();
			button = buttonWrapper.find('.read-more-button');
		}
		
		button.off('click').on('click', (e) => {
			
			e.preventDefault();
			
			let height = 0;
			
			content.show();
			height = content.height();
			content.hide();
			
			content.animate({'height': 0}, 0);
			content.css('display', 'block');
			content.animate({'height': height}, 1000);
			buttonWrapper.slideUp(1000);
		});
	});
}

function _scrollNext()
{
	const btn = $('.com-scroll-icon > div');
	const nextBlock = $(btn.parents('.layout-row').nextAll('.layout-row').get(0));
	
	btn.on('click', (e) => {
		e.preventDefault();
		$([document.documentElement, document.body]).animate({
	        scrollTop: nextBlock.offset().top
	    }, 1000);
	});
}

function checkOverlap(element1, element2) {

	if(!element1 || !element2)
		return null;

	const rect1 = element1.getBoundingClientRect();
	const rect2 = element2.getBoundingClientRect();

	return (
		rect1.left < rect2.right &&
		rect1.right > rect2.left &&
		rect1.top < rect2.bottom &&
		rect1.bottom > rect2.top
	);
}

function accordion()
{
	$('.accordion').each((index, element) => {
		accordion = $(element);
		accordion.find('[data-toggle="accordion"]').on('click', e => {
			e.preventDefault();

			const button = (e.target.tagName == 'A' ? $(e.target) : $(e.target).parents('a'));
			const body = accordion.find(button.attr('href'));
			const item = button.parents('.accordion-item');
			const allBodys = accordion.find('.accordion-body');

			if(!item.hasClass('opened'))
				accordion.find('.opened').removeClass('opened');

			allBodys.stop().slideUp();
			body.stop().slideToggle();
			item.toggleClass('opened');
		});
	});
}

function blocksBottomCut()
{
	const blocks = $('.block:not(.block-header)');
	const totalBlocks = blocks.length + 4;
	const blocksBottomCut = BlocksBottomCutHelper.getAll();
	const blocksWithTopCut = BlocksBottomCutHelper.getBlocksWithTopCut();
	const rowsWithBlocksWithCut = BlocksBottomCutHelper.getRowsWithBlocksWithCut();

	if(!blocksBottomCut.length)
		return;

	// Reseteamos el margen de las filas que contienen bloques con recorte inferior
	rowsWithBlocksWithCut.each((index, element) => {
		$(element).css('margin-bottom', '');
	});

	// Reseteamos el padding superior de los bloques siguientes a bloques con recorte inferior
	blocksWithTopCut.each((index, element) => {
		const block = $(element);
		block.css('padding-top', '');
	});

	// Configuramos el recorte inferior de los bloques y los el padding-superior de los bloques siguientes
	blocksBottomCut.each((index, element) => {
		let block = $(element);
		let cutHeight = 75;
		let row = block.parents('.layout-row');
		let nextRow = (row.next('.layout-row').length ? row.next() : row.next().next());

		if(!block.attr('data-padding-bottom'))
			block.attr('data-padding-bottom', parseInt(block.css('padding-bottom')));

		if(!isMobile() && typeof(_blockBottomCutValues) != 'undefined')
		{
			for(let i in _blockBottomCutValues)
			{
				const cut = _blockBottomCutValues[i];
	
				if(block.hasClass(cut.class))
				{
					cutHeight = parseInt(cut.height) + 25;
					break;
				}
			}
		}
		
		block
			.css('padding-bottom', parseInt(block.attr('data-padding-bottom')) + cutHeight)
			.addClass('block-with-bottom-cutout');

		// Si la fila tiene más de una celda y estamos en el móvil,
		// aplicamos el margin-bottom negativo a los bloques en vez de la fila
		if(!row.find('[data-layout-cell="100"]').length && isMobile())
		{
			row.find('[data-layout-cell]').css('margin-bottom', cutHeight * -1);
		}
		else
		{
			row.css('margin-bottom', cutHeight * -1);
		}
		
		row.addClass('row-with-blocks-with-cut');

		_APP.events.fire('blocks.style.padding', {block: block});
		
		nextRow.find('.block').each((index2, element2) => {
			const nextBlock = $(element2);
			
			if(!nextBlock.attr('data-padding-top'))
				nextBlock.attr('data-padding-top', parseInt(nextBlock.css('padding-top')));

			nextBlock
				.css('padding-top', parseInt(nextBlock.attr('data-padding-top')) + cutHeight)
				.addClass('block-with-top-cut');

			_APP.events.fire('blocks.style.padding', {block: nextBlock});
		});
	});

	blocks.each((index, element) => {
		let block = $(element);
		block.css('z-index', totalBlocks - index);
	});
}

class BlocksBottomCutHelper
{
	static getAll()
	{
		return $('.block[class*="block-cut-"]:not(.block-cut-none)');
	}

	static hasCut(block)
	{
		return (block.hasClass('block') && !block.hasClass('block-cut-none'));
	}

	static getBlocksWithTopCut()
	{
		return $('.block.block-with-top-cut');
	}

	static getRowsWithBlocksWithCut()
	{
		return $('.row-with-blocks-with-cut');
	}
}

class SmoothScroll
{
	static _get()
	{
		return (typeof(_frontendSmoothScroll) != 'undefined' ? _frontendSmoothScroll : null);
	}

	static disable()
	{
		const smooth = SmoothScroll._get();

		if(smooth)
		{
			_frontendSmoothScroll.destroy();
		}
	}

	static enable()
	{
		const smooth = SmoothScroll._get();

		if(smooth)
		{
			_frontendSmoothScroll = new Lenis({
				autoRaf: true,
			});
		}
	}
}

function _dataLayerOnEmailClick()
{
	$('a[href*="mailto:"]').on('click', function(e) {
		_dataLayer('click_email');
	});
}

$(document).ready(function(e) {
	
	backgroundImageAnimationLoadEvent();

	backgroundImageParallax();

	bodyBackgroundImageParallax();
	
	backgroundVideoFixed();
	
	mobileVideos();
	
	initPrototypeFunctions();
	
	scrollToTop(true);
	
	setAnchorNavigationItems();
	
	initSrcSet();
	
	findAnchorNavitgationItemInURL();
	
	_animateBlocks();

	checkPreviewNotice();
	
	blockShare();
	
	$('.range-control input').each(function(index, element) {
		frontendInputRange($(element).parent());
	});
	
	_mutationObserver();
	
	setVideoBackground();
	
	addReadMoreButton();
	
	_scrollNext();

	accordion();

	blocksBottomCut();

	_dataLayerOnEmailClick();
});

function headerFixes()
{
	let previewNotice = $('.preview-notice');
	let header = $('.new-header .headerlg[data-fixed="1"]');
	
	if(!previewNotice || !header)
		return;
	
	previewNotice.css({
		position: 'sticky',
		top: 0,
	});
}

function setVideoBackground(parent)
{
	if(parent == undefined)
		parent = $('body');

	try
	{
		let createOnlineVideoBackground = (element) => {
			if($.fn.youtube_background)
			{
				if(typeof(element) == 'string')
				{
					element = $(element);
				}

				element.youtube_background({
					poster: element.attr('data-poster'),
				});

				setTimeout(() => {
					element.youtube_background({
						poster: element.attr('data-poster'),
					});
				}, 500);
			}
		};
		
		let setPoster = (element) => {
			if(element.dataset.poster)
			{
				$(element).parent().css({
					'background-image': 'url("' + element.dataset.poster + '")',
					'background-size': 'cover',
				});
			}
		};
		
		// Online videos
		parent.find('.block-background-online-video[data-vbg]').each((index, element) => {
			if(element.dataset.poster)
			{
				setPoster(element);
				setTimeout(function() {
					createOnlineVideoBackground($(element));
				}, 1000);
			}
			else
			{
				createOnlineVideoBackground($(element));
			}
		});
		
		// Uploaded videos
		parent.find('video[data-poster]').each((index, element) => {
			setPoster(element);
		});
		
	} catch(err) {
		console.error(err);
	}
}

$(window).on('scroll', function() {

	backgroundImageParallax();

	bodyBackgroundImageParallax();
	
	backgroundVideoFixed();
	
	scrollToTop();
	
	headerFixes();
});

$(window).on('resize', function() {
	
	setInterval('setAllBackgroundImagesParallaxSizes', 500);
	
	buildSrcSet();
	
	mobileVideos();

	blocksBottomCut();
});