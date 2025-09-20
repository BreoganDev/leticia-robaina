class ConsentModeManager
{
    constructor()
    {
        this.cookies = new ConsentModeCookies();
        this.prompt = new ConsentModePrompt();
        this.config = new ConsentModeConfig();

        this.prompt.onAccept(() => {
            this.cookies.acceptAll();
        });

        this.prompt.onReject(() => {
            this.cookies.rejectAll();
        });

        this.prompt.onCustomize(() => {
            this.config.show();
        });

        this.config.onAccept(() => {
            this.cookies.acceptAll();
        });

        this.config.onReject(() => {
            this.cookies.rejectAll();
        });

        this.config.onSave(preferences => {
            this.cookies.save(preferences);
        });

        this.config.onBeforeShow(() => {
            this.config.setInputsCheckedStatus(this.cookies.getAllCookies());
        });
    }

    init()
    {
        const footerCookiesLink = document.querySelector('.cookies-consent-mode');
        const options = (document.querySelector('.consent-mode-options') && document.querySelector('.consent-mode-options').dataset) || {};

        if(footerCookiesLink)
        {
            this.config.changeCookiesUrl(footerCookiesLink.getAttribute('href'));
            footerCookiesLink.innerText = footerCookiesLink.dataset.text;
            
            footerCookiesLink.addEventListener('click', e => {
                e.preventDefault();
                this.config.show();
            });
        }
        
        if(!this.cookies.requiredCookiesIsSet() && options.notOpenByDefault != '1')
        {
            this.prompt.show();
        }
    }
}

class ConsentModeCookies
{
    constructor()
    {
        this.COOKIES_REQUIRED = 'cv_cookies_required';
        this.COOKIES_ANALYTICS = 'cv_cookies_analytics'; // analytics_storage
        this.COOKIES_ADVERTISEMENT = 'cv_cookies_advertisement'; //ad_storage, ad_user_data
        this.COOKIES_FUNCIONALITY = 'cv_cookies_funcionality'; // functionality_storage
        this.COOKIES_SECURITY = 'cv_cookies_security'; // security_storage
        this.COOKIES_PERSONALIZATION = 'cv_cookies_personalization'; // ad_personalization, personalization_storage

        this.cookies = [this.COOKIES_REQUIRED, this.COOKIES_ANALYTICS, this.COOKIES_ADVERTISEMENT, this.COOKIES_FUNCIONALITY, this.COOKIES_SECURITY, this.COOKIES_PERSONALIZATION];
    }

    requiredCookiesIsSet()
    {
        return (this._getCookie(this.COOKIES_REQUIRED) == 1);
    }

    accept(cookie)
    {
        this._setCookie(cookie, 1);
    }

    reject(cookie)
    {
        this._setCookie(cookie, 0);
    }

    acceptAll()
    {
        this.cookies.forEach(cookie => {
            this.accept(cookie);
        });

        this.accept(this.COOKIES_REQUIRED);

        this.updateGoogleConsent();
    }

    rejectAll()
    {
        this.cookies.forEach(cookie => {
            this.reject(cookie);
        });
        
        this.accept(this.COOKIES_REQUIRED);

        this.updateGoogleConsent();
    }

    getCookiesKeys()
    {
        return {
            'analytics': this.COOKIES_ANALYTICS,
            'advertisement': this.COOKIES_ADVERTISEMENT,
            'funcionality': this.COOKIES_FUNCIONALITY,
            'security': this.COOKIES_SECURITY,
            'personalization': this.COOKIES_PERSONALIZATION,
        };
    }

    getAllCookies()
    {
        const cookies = this.getCookiesKeys();
        let result = [];

        for(let i in cookies)
        {
            result.push({
                section: i,
                cookie: cookies[i],
                accepted: (this._getCookie(cookies[i]) == 1),
            });
        }

        return result;
    }

    save(preferences)
    {
        const cookies = this.getCookiesKeys();

        for(let key in cookies)
        {
            const cookie = cookies[key];

            if(preferences[key] == 1)
            {
                this.accept(cookie);
            }
            else
            {
                this.reject(cookie);
            }
        }
        
        this.accept(this.COOKIES_REQUIRED);

        this.updateGoogleConsent();
    }

    updateGoogleConsent()
    {
        if(typeof(gtag) == 'undefined')
            return;

        gtag('consent', 'update', {
            'ad_storage': this._getKeyGoogleConsent(this.COOKIES_ADVERTISEMENT),
            'ad_user_data': this._getKeyGoogleConsent(this.COOKIES_ADVERTISEMENT),
            'ad_personalization': this._getKeyGoogleConsent(this.COOKIES_PERSONALIZATION),
            'personalization_storage': this._getKeyGoogleConsent(this.COOKIES_PERSONALIZATION),
            'analytics_storage': this._getKeyGoogleConsent(this.COOKIES_ANALYTICS),
            'functionality_storage': this._getKeyGoogleConsent(this.COOKIES_FUNCIONALITY),
            'security_storage': this._getKeyGoogleConsent(this.COOKIES_SECURITY),
        });
    }

    _getCookie(cname)
    {
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

    _setCookie(cname, cvalue)
    {
        var d = new Date();
        var expiration = 365*24*60*60*1000;
        d.setTime(d.getTime() + expiration);
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    _getKeyGoogleConsent(cookie)
    {
        return (this._getCookie(cookie) == 1 ? 'granted' : 'denied')
    }
}

class ConsentModeConfig
{
    constructor()
    {
        this.config = document.getElementById('config-consent-mode');

        this.onAcceptCallback = null;
        this.onRejectCallback = null;
        this.onSaveCallback = null;
        this.onBeforeShowCallback = null;

        this.config.querySelectorAll('.cookie-heading a').forEach(node => {
            const img = `<?xml version="1.0" ?><svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg"><rect fill="none" height="256" width="256"/><polyline fill="none" points="96 48 176 128 96 208" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>`;
            node.innerHTML = img + node.innerHTML;
        });

        this.config.querySelector('[data-action="accept"]').addEventListener('click', e => {
            e.preventDefault();
            if(typeof(this.onAcceptCallback) == 'function')
            {
                this.onAcceptCallback();
            }
            this.hide();
        });

        this.config.querySelector('[data-action="reject"]').addEventListener('click', e => {
            e.preventDefault();
            if(typeof(this.onRejectCallback) == 'function')
            {
                this.onRejectCallback();
            }
            this.hide();
        });

        this.config.querySelector('[data-action="save"]').addEventListener('click', e => {
            e.preventDefault();
            if(typeof(this.onSaveCallback) == 'function')
            {
                let preferences = {};

                this.config.querySelectorAll('input[type="checkbox"]').forEach(input => {
                    preferences[input.dataset.cookie] = input.checked;
                });

                this.onSaveCallback(preferences);
            }
            this.hide();
        });

        this.config.querySelectorAll('.cookie-heading a').forEach(node => {
            node.addEventListener('click', e => {
                e.preventDefault();
                const link = e.currentTarget;
                const body = link.parentNode.parentNode.querySelector('.cookie-body');

                body.hidden = !body.hidden;

                if(link.classList.contains('opened'))
                {
                    link.classList.remove('opened');
                }
                else
                {
                    link.classList.add('opened');
                }
            });
        });
    }

    show()
    {
        if(typeof(this.onBeforeShowCallback) == 'function')
        {
            this.onBeforeShowCallback();
        }

        ConsentModeTools.disableScroll();

        this.config.hidden = false;
    }

    hide()
    {
        ConsentModeTools.enableScroll();

        this.config.hidden = true;
    }

    changeCookiesUrl(url)
    {
        this.config.querySelector('a[href="#COOKIES"]').setAttribute('href', url);
    }

    onAccept(callback)
    {
        this.onAcceptCallback = callback;
    }

    onReject(callback)
    {
        this.onRejectCallback = callback;
    }

    onSave(callback)
    {
        this.onSaveCallback = callback;
    }

    onBeforeShow(callback)
    {
        this.onBeforeShowCallback = callback;
    }

    setInputsCheckedStatus(cookies)
    {
        cookies.forEach(cookie => {
            this.config.querySelector('input[data-cookie="' + cookie.section + '"]').checked = cookie.accepted;
        });
    }

    _setInputCheckedStatus(cookie, checked)
    {
        this.config.querySelector('input[type="checkbox"][data-cookie="' + cookie + '"]').checked = checked;
    }
}

class ConsentModePrompt
{
    constructor()
    {
        this.prompt = document.getElementById('modal-consent-mode');

        this.onAcceptCallback = null;
        this.onRejectCallback = null;
        this.onCustomizeCallback = null;

        this.prompt.querySelector('[data-action="accept"]').addEventListener('click', e => {
            e.preventDefault();
            if(typeof(this.onAcceptCallback) == 'function')
            {
                this.onAcceptCallback();
            }
            this.hide();
        });

        this.prompt.querySelector('[data-action="reject"]').addEventListener('click', e => {
            e.preventDefault();
            if(typeof(this.onRejectCallback) == 'function')
            {
                this.onRejectCallback();
            }
            this.hide();
        });

        this.prompt.querySelector('[data-action="customize"]').addEventListener('click', e => {
            e.preventDefault();
            if(typeof(this.onCustomizeCallback) == 'function')
            {
                this.onCustomizeCallback();
            }
            this.hide();
        });
    }

    show()
    {
        ConsentModeTools.disableScroll();
        this.prompt.hidden = false;
    }

    hide()
    {
        ConsentModeTools.enableScroll();
        this.prompt.hidden = true;
    }

    onAccept(callback)
    {
        this.onAcceptCallback = callback;
    }

    onReject(callback)
    {
        this.onRejectCallback = callback;
    }

    onCustomize(callback)
    {
        this.onCustomizeCallback = callback;
    }
}

class ConsentModeTools
{
    static getScrollbarWidth()
    {
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
    }

    static enableScroll()
    {
        document.body.style.width = '';
        document.body.style.overflow = '';
        document.body.style.position = '';
        document.body.style.paddingRight = 0;
    }

    static disableScroll()
    {
        const scrollBarWidth = ConsentModeTools.getScrollbarWidth();

        document.body.style.width = '100%';
        document.body.style.overflow = 'hidden';
        document.body.style.position = 'fixed';
        document.body.style.paddingRight = parseInt(scrollBarWidth);
    }
}

document.addEventListener('DOMContentLoaded', e => {
    if(window.self === window.top)
    {
        window._ConsentModeManager = new ConsentModeManager();
        window._ConsentModeManager.init();
    }
});