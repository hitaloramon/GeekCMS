var MySlider = function( containerId, options ) {

    containerId = containerId || '';

    var animEndEventName,
        animationStarted,
        needLoadYoutubeApi,
        autoPlayTimer,
        layersTimer = [],
        ytPlayers = {};

    this.paused = false;

    /** Options */
    var sliderOptions = {
        width: 700,
        height: 300,
        autoPlay: false,
        stopAutoPlayMouseOver: true,
        effectsFromFirst: false,
        delay: 5,
        backgroundColor: 'transparent'
    };

    /** Initialize */
    this.init = function(){

        var self = this, containerEl, input, slidesCount;

        if (document.getElementById(containerId) !== null) {
            input = options;
        } else {
            input = window.msc_slider_data || {};
        }

        sliderOptions.width = input.width;
        sliderOptions.height = input.height;
        sliderOptions.autoPlay = !!input.autoPlay;
        sliderOptions.stopAutoPlayMouseOver = !!input.stopAutoPlayMouseOver;
        sliderOptions.effectsFromFirst = !!input.effectsFromFirst;
        if(input.backgroundColor){
            sliderOptions.backgroundColor = input.backgroundColor;
        }

        if (document.getElementById(containerId) !== null) {
            containerEl = document.getElementById(containerId);
            slidesCount = containerEl.querySelectorAll('.et-page').length;
            if (containerEl.querySelector('.et-page')) {
                addClass(containerEl.querySelector('.et-page'), 'et-page-current');
            }
        } else {
            slidesCount = input.data ? input.data.length : 0;
            containerId = 'MySliderContainer' + this.uniqueId() + '_' + input.id;
            generateSliderHTML(input);
            containerEl = document.getElementById(containerId);
        }

        if (slidesCount === 0) {
            return;
        }

        var firstSlideEl = containerEl.querySelector('.et-page-current');
        animEndEventName = getAnimationEndEventName();

        containerEl.style.width = input.width + 'px';
        containerEl.setAttribute('data-current', '0');
        containerEl.addEventListener('mouseenter', function (e) {
            self.onChangeMouseOver(e, true);
        });
        containerEl.addEventListener('mouseleave', self.onChangeMouseOver.bind(self));

        //Create arrows
        if (input.showArrows && slidesCount > 1) {
            this.arrowsInit();
        }

        //Create dots
        if (input.showPages && slidesCount > 1) {
            this.dotsInit(slidesCount);
        }

        //Load YouTube API
        if (needLoadYoutubeApi) {
            setTimeout(loadYoutubeApi.bind(this), 1);
        }

        setTimeout(this.autoPlayInit.bind(this), 1);

        //Animate layers on first slide
        if(sliderOptions.effectsFromFirst){
            var layers = firstSlideEl.querySelectorAll('.animated');
            Array.prototype.forEach.call(layers, function (el, i) {
                el.style.display = 'none';
            });
            animateLayers(firstSlideEl);
        }

        window.addEventListener('resize', this.onWindowResize.bind(this));
        setTimeout(this.onWindowResize.bind(this), 1);

    };

    /**
     * Generate slider HTML
     * @param options
     */
    var generateSliderHTML = function( options ){

        document.write('<div id="' + containerId + '" class="msc-container"></div>');

        var divOuter = createElement('div', {
            className: 'et-wrapper'
        }, {
            width: options.width + 'px',
            height: options.height + 'px',
            margin: '0 auto 0 auto',
            backgroundColor: sliderOptions.backgroundColor
        });

        append('#' + containerId, divOuter);

        //Create slides
        for (var i = 0; i < options.data.length; i++) {
            createSlide(divOuter, options.data[i], i);
        }

    };

    /**
     * Get animation end event name
     * @returns {string|boolean}
     */
    var getAnimationEndEventName = function() {
        var animEndEventNames = {
            'WebkitAnimation': 'webkitAnimationEnd',
            'OAnimation': 'oAnimationEnd',
            'msAnimation': 'MSAnimationEnd',
            'animation': 'animationend'
        };
        var output = false;
        var b = document.body || document.documentElement;
        var s = b.style;
        var p = 'animation';
        if(typeof s[p] == 'string')
            return animEndEventNames[p];

        // Tests for vendor specific prop
        var v = ['Moz', 'Webkit', 'Khtml', 'O', 'ms'];
        p = p.charAt(0).toUpperCase() + p.substr(1);
        for( var i=0; i<v.length; i++ ) {
            if(typeof s[v[i] + p] == 'string'){
                output = animEndEventNames[ v[i] + p ];
                break;
            }
        }
        return output;
    };

    /**
     * Initialize arrows
     */
    this.arrowsInit = function(){

        var arrowPrev = createElement('span', {
            className: 'msc-arrow msc-arrow-prev'
        });
        var arrowNext = createElement('span', {
            className: 'msc-arrow msc-arrow-next'
        });

        append('#' + containerId, arrowPrev);
        append('#' + containerId, arrowNext);

        arrowPrev.addEventListener('click', this.slidePrev.bind(this));
        arrowNext.addEventListener('click', this.slideNext.bind(this));

    };

    /**
     * Initialize dots navigation
     * @param slidesCount
     */
    this.dotsInit = function( slidesCount ){

        var dotsNav = createElement('div', {
            className: 'msc-dots-nav'
        });

        for( var i = 0; i < slidesCount; i++ ){
            var dotEl = createElement('span', {
                className: 'msc-dot' + (i == 0 ? ' active' : ''),
                textContent: i + 1
            });
            append( dotsNav, dotEl );
            dotEl.addEventListener('click', this.dotsNavAction.bind(this));
        }

        append('#' + containerId, dotsNav);

    };

    /**
     * Dots navigation action
     */
    this.dotsNavAction = function(e){

        if( animationStarted ){
            return;
        }

        var containerEl = document.getElementById( containerId );

        var current = parseInt(containerEl.getAttribute('data-current'), 10),
            nextIndex = parseInt(e.target.textContent, 10) - 1,
            step = nextIndex - current;

        if( step !== 0 ){
            this.slideAction( step );
        }

    };

    /**
     * Update dots navigation
     */
    var updateDotsNav = function(){

        var containerEl = document.getElementById( containerId ),
            dots = document.querySelectorAll( '#' + containerId + ' .msc-dot' ),
            current = parseInt(containerEl.getAttribute('data-current'), 10);

        if( dots.length > 0 ){

            Array.prototype.forEach.call(dots, function(el, i){
                if( current === i ){
                    addClass( el, 'active' );
                } else {
                    removeClass( el, 'active' );
                }
            });

        }

    };

    /**
     * Slide action
     * @param step
     */
    this.slideAction = function( step ){

        if (animationStarted) {
            return;
        }

        var self = this;

        clearTimeout(autoPlayTimer);

        var containerEl = document.getElementById(containerId),
            current = parseInt(containerEl.getAttribute('data-current'), 10),
            pages = document.querySelectorAll('#' + containerId + ' .et-page'),
            pagesCount = pages.length;

        onEndAnimation(pages[current]);

        var currentSlideEl = pages[current],
            transitionOut = currentSlideEl.getAttribute('data-et-out');

        animationStarted = true;

        //Update current index
        current += step;
        if (step > 0 && current >= pagesCount) {
            current = 0;
        } else if (step < 0 && current < 0) {
            current = pagesCount - 1;
        }
        containerEl.setAttribute('data-current', current.toString());

        var nextSlideEl = pages[current],
            transitionIn = nextSlideEl.getAttribute('data-et-in');

        var stepNext = function () {

            var animatedLayers = nextSlideEl.querySelectorAll('.animated');
            if (animatedLayers.length > 0) {
                Array.prototype.forEach.call(animatedLayers, function (el, i) {
                    el.style.display = 'none';
                });
            }

            if (transitionIn) {
                nextSlideEl.addEventListener(animEndEventName, function handleCurr() {
                    this.removeEventListener(animEndEventName, handleCurr);
                    onEndAnimation(this);
                    self.autoPlayInit();
                    animateLayers(this);
                    animationStarted = false;
                });
                addClass(nextSlideEl, 'et-page-current pt-page-' + transitionIn);
            } else {
                addClass(nextSlideEl, 'et-page-current');
                self.autoPlayInit();
                animateLayers(nextSlideEl);
                animationStarted = false;
            }

        };

        if (transitionOut) {
            currentSlideEl.addEventListener(animEndEventName, function handleCurr() {
                this.removeEventListener(animEndEventName, handleCurr);
                removeClass(currentSlideEl, 'et-page-current');
                onEndAnimation(this);
                stopVideo(this);
                stepNext();
            }, false);
            addClass(currentSlideEl, 'pt-page-' + transitionOut);
        } else {
            removeClass(currentSlideEl, 'et-page-current');
            stopVideo(currentSlideEl);
            stepNext();
        }

        //Update dots navigation
        updateDotsNav();
    };

    /**
     * Animate layers
     * @param parentEl
     */
    var animateLayers = function(parentEl){

        var animatedLayers = parentEl.querySelectorAll('.animated'),
            animatedLayersCount = animatedLayers.length;

        if (animatedLayersCount === 0) {
            return;
        }

        layersTimer = [];

        Array.prototype.forEach.call(animatedLayers, function (el, i) {

            var delay = el.hasAttribute('data-delay')
                ? parseFloat(el.getAttribute('data-delay'))
                : 0;
            var effect = el.hasAttribute('data-effect')
                ? el.getAttribute('data-effect')
                : '';

            if (effect) {

                layersTimer[i] = setTimeout(function () {

                    el.addEventListener(animEndEventName, function handleCurr() {
                        this.removeEventListener(animEndEventName, handleCurr);
                        animatedLayersCount--;
                        removeClass(el, effect);
                        if (animatedLayersCount === 0) {

                        }
                    });

                    el.style.display = 'block';
                    addClass(el, effect);

                }, delay * 1000);

            } else {
                el.style.display = 'block';
                animatedLayersCount--;
            }

        });
    };

    /**
     * Sldie previous
     */
    this.slidePrev = function(){
        this.slideAction( -1 );
    };

    /**
     * Slide next
     */
    this.slideNext = function(){
        this.slideAction( 1 );
    };

    /**
     * Auto play
     */
    this.autoPlayInit = function(){
        if (!sliderOptions.autoPlay || this.paused) {
            return;
        }
        var containerEl = document.getElementById(containerId),
            current = parseInt(containerEl.getAttribute('data-current'), 10);
        var slides = document.getElementById(containerId).querySelectorAll('.et-page');
        if (slides.length === 0) {
            return;
        }
        var delay = slides[current].hasAttribute('data-et-delay')
            ? parseInt(slides[current].getAttribute('data-et-delay'))
            : sliderOptions.delay;

        if (!delay) {
            return;
        }
        clearTimeout(autoPlayTimer);
        autoPlayTimer = setTimeout(this.slideNext.bind(this), delay * 1000);
    };

    /**
     * On end animation
     * @param el
     */
    var onEndAnimation = function( el ){

        layersTimer.forEach(function(timer, index){
            clearTimeout(timer);
        });

        var classList = el.className.split(' ');
        var newClassList = [];

        for( var i = 0; i < classList.length; i++ ){
            if( classList[i].indexOf( 'pt-page-' ) == -1 ){
                newClassList.push( classList[i] );
            }
        }

        el.className = newClassList.join(' ');

    };

    /**
     * For each object
     * @param obj
     * @param callback
     * @returns {*}
     */
    var forEachObj = function(obj, callback){
        for ( var prop in obj ) {
            if( obj.hasOwnProperty( prop ) ) {
                callback( prop, obj[prop] );
            }
        }
        return obj;
    };

    /**
     * Append child element
     * @param selector
     * @param element
     */
    var append = function( selector, element ){
        var parents = typeof selector == 'string'
            ? document.querySelectorAll( selector )
            : [ selector ];
        Object.keys(parents).forEach(function(key){
            if( typeof parents[ key ] == 'object' ) {
                parents[ key ].appendChild( element );
            }
        });
    };

    /**
     * Create element from properties object
     * @param tagName
     * @param attributes
     * @param css
     * @returns {Element}
     */
    var createElement = function( tagName, attributes, css ){
        var el = document.createElement( tagName );
        if( attributes ){
            forEachObj(attributes, function(key, val) {
                el[ key ] = val;
            });
        }
        if( css ){
            forEachObj(css, function(key, val) {
                el.style[ key ] = val;
            });
        }
        return el;
    };

    /**
     * Add class
     * @param el
     * @param className
     */
    var addClass = function(el, className){
        if( el.className.split(' ').indexOf( className ) === -1 ){
            el.className += ' ' + className;
        }
    };

    /**
     * Remove class
     * @param el
     * @param className
     */
    var removeClass = function(el, className){
        if (el.classList)
            el.classList.remove(className);
        else
            el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
    };

    /**
     * Create slide
     * @param parentEl
     * @param options
     * @param index
     */
    var createSlide = function( parentEl, options, index ){

        var slideEl = createElement('div', {
            className: 'et-page' + ( index === 0 ? ' et-page-current' : '' )
        }, {
            background: options.color && !options.image
                ? 'none ' + options.color
                : 'url(' + localStorage.getItem('SITEURL') + '/uploads/modules/slider/' + options.image + ') transparent'
        });

        append(parentEl, slideEl);

        //Create layers
        for (var i = 0; i < options.layers.length; i++) {
            createLayer(slideEl, options.layers[i], i);
        }

        //Transitions
        if (options.transitionIn) {
            slideEl.setAttribute('data-et-in', options.transitionIn);
        }
        if (options.transitionOut) {
            slideEl.setAttribute('data-et-out', options.transitionOut);
        }

        if (sliderOptions.autoPlay) {
            var delay = options.timeDelay || sliderOptions.delay;
            slideEl.setAttribute('data-et-delay', delay);
        }
    };

    /**
     * Create layer
     * @param parentEl
     * @param options
     * @param index
     */
    var createLayer = function( parentEl, options, index ){

        var tagName, tagAttributes;

        if (options.type == 'video') {
            tagName = 'div';
            tagAttributes = {
                className: 'msc-layer'
            };
        } else {
            tagName = 'a';
            tagAttributes = {
                className: 'msc-layer',
                innerHTML: escapeString(options.text).replace(/\n/g, '<br>'),
                href: options.link || 'javascript:void(0)'
            };
        }

        var layerEl = createElement(tagName, tagAttributes, {
            width: options.width + 'px',
            height: options.height + 'px',
            left: options.left + 'px',
            top: options.top + 'px',
            padding: (options.padding || 0) + 'px',
            background: options.background && !options.image
                ? 'none ' + options.background
                : (
                    options.image
                        ? 'url(' + localStorage.getItem('SITEURL') + '/uploads/modules/slider/' + options.image + ') transparent'
                        : 'transparent'
                ),
            fontSize: options.fontSize + 'px',
            fontWeight: options.bold ? 'bold' : 'normal',
            color: options.textColor,
            textAlign: options.textAlign,
            lineHeight: options.lineHeight,
            textDecoration: options.underline
                ? 'underline'
                : ( options.lineThrough ? 'line-through' : 'none' )
        });

        if (options.link && options.type != 'video') {
            addClass(layerEl, 'msc-link');
        }
        if (options.effect) {
            addClass(layerEl, 'animated');
            var timeDelay = options.timeDelay ? parseFloat(options.timeDelay) : 0;
            layerEl.setAttribute('data-delay', timeDelay.toString());
            layerEl.setAttribute('data-effect', options.effect);
        }
        if (options.type == 'icon' && options.icon) {
            append(layerEl, createElement('span', {className: options.icon}));
        }
        if (options.type == 'video' && options.link) {
            var videoId = getYoutubeVideoId(options.link),
                innerHTML = '';
            if (videoId) {
                needLoadYoutubeApi = true;
                innerHTML = '<iframe id="msc' + Math.random().toString(16).slice(2) + '" class="iframe-youtube" width="' + options.width + '" height="' + options.height + '" src="http://www.youtube.com/embed/' + videoId + '?enablejsapi=1&origin=' + getDomainUrl() + '" frameborder="0" allowfullscreen></iframe>';
            } else {
                innerHTML = '<video src="' + options.link + '" width="' + options.width + '" height="' + options.height + '" controls>';
            }
            layerEl.style.padding = '0';
            layerEl.innerHTML = innerHTML;
        }

        append(parentEl, layerEl);
    };

    /**
     * On change mouseOver
     * @param cursorOver
     */
    this.onChangeMouseOver = function( e, cursorOver ){

        if( sliderOptions.stopAutoPlayMouseOver ){
            if( cursorOver ){
                this.pause();
            } else {
                if( sliderOptions.autoPlay ){
                    this.play();
                }
            }
        }

    };

    /**
     * Pause playing slides
     */
    this.pause = function(){
        clearTimeout(autoPlayTimer);
        this.paused = true;
    };

    /**
     * Start auto play
     */
    this.play = function(){
        this.paused = false;
        sliderOptions.autoPlay = true;
        this.autoPlayInit();
    };

    /**
     * On window resize
     */
    this.onWindowResize = function(){

        var containerEl = document.getElementById( containerId ),
            containerSize = containerEl.getBoundingClientRect(),
            wrapperEl = containerEl.querySelector('.et-wrapper'),
            sizeDelta = containerSize.width / sliderOptions.width;

        wrapperEl.style.transform = 'scale(' + sizeDelta + ')';
        wrapperEl.style.transformOrigin = '0 0';
        containerEl.style.height = (sliderOptions.height * sizeDelta) + 'px';
    };

    /**
     * Generate unique ID
     * @returns {string}
     */
    this.uniqueId = function(){
        return Math.random().toString(16).slice(2);
    };

    /**
     * Stop playing video in slide
     * @param parentEl
     */
    var stopVideo = function( parentEl ){

        //Stop HTML5 video
        var videos = parentEl.querySelectorAll( 'video' );
        if( videos.length > 0 ){
            Array.prototype.forEach.call(videos, function(el, i){
                el.pause();
            });
        }

        //Stop YouTube video
        var youtubeIframes = parentEl.querySelectorAll( 'iframe.iframe-youtube' );
        Array.prototype.forEach.call(youtubeIframes, function(el, i){
            if( !ytPlayers[ el.id ] ){
                if( typeof YT != 'undefined' ){
                    ytPlayers[ el.id ] = new YT.Player(el.id, {
                        events: {
                            'onReady': function(event){
                                event.target.pauseVideo();
                            }
                        }
                    });
                }
            } else {
                ytPlayers[ el.id ].pauseVideo();
            }
        });

    };

    /**
     * Get youtube video ID
     * @param url
     * @returns {string}
     */
    var getYoutubeVideoId = function( url ){
        var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
        var match = url.match(regExp);
        if (match && match[7].length==11){
            return match[7];
        }
        return '';
    };

    /**
     * Load YouTube Api script
     */
    var loadYoutubeApi = function(){
        var tag = document.createElement('script');
        tag.src = "//www.youtube.com/player_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    };

    /**
     * Get domain url
     * @returns {string}
     */
    var getDomainUrl = function(){
        return window.location.protocol
            + '//' + window.location.hostname;
    };

    /**
     * Escape string
     * @param str
     * @returns {string}
     */
    var escapeString = function ( str ) {

        var escapeMap = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#x27;',
            '`': '&#x60;'
        };

        var escaper = function(match) {
            return escapeMap[match];
        };
        // Regexes for identifying a key that needs to be escaped
        var source = '(?:' + Object.keys(escapeMap).join('|') + ')';
        var testRegexp = new RegExp(source);
        var replaceRegexp = new RegExp(source, 'g');

        str = str == null ? '' : '' + str;
        return testRegexp.test(str) ? str.replace(replaceRegexp, escaper) : str;
    };

    this.init();

};
