(function ($) {
	'use strict';

	/* Table of contents */
	/*
		# Headers
		# Bar
		# Navigation
		# Footer
		# Shortcodes
			## Accordion box
			## Banner box
			## Chart box
			## Counter box
			## Contact form
			## Countdown box
			## Cover box
			## Gallery
			## Google maps
			## Onepage
			## Parallax
			## Progress bar
			## Pricing table
			## Social bar
			## Split box
			## Sliders
			## Split screen
			## Tab box
			## Video Background
		# Portfolio
			## Portfolio gallery
			## Scroll content
		# Lazy load
		# Other
	*/

	window.Nor = {
		init: function(){
			// Header
			this.header = $('#masthead');
			this.headerIsFifth = Nor.header.hasClass('header-5');
			this.headerIsSixth = Nor.header.hasClass('header-6');

			this.headerFixed = {
				initialOffset: parseInt( this.header.attr('data-fixed-initial-offset') ) || 150,

				enabled: $('[data-header-fixed]').length,
				value: false,

				mobileEnabled: $('[data-mobile-header-fixed]').length,
				mobileValue: false
			};

			this.headerSearch = $('.header-search');

			this.subheader = $('.subheader');

			// Logos
			this.siteBranding = this.header.find('.site-branding');
			this.siteTitle = this.header.find('.site-title');
			this.logo = this.header.find('.logo');
			this.fixedLogo = this.header.find('.fixed-logo');
			this.mobileLogo = this.header.find('.mobile-logo');
			this.fixedMobileLogo = this.header.find('.fixed-mobile-logo');

			this.logoForOnepage = this.header.find('.for-onepage');
			this.logoForOnepageDark = this.logoForOnepage.find('.dark');
			this.logoForOnepageLight = this.logoForOnepage.find('.light');

			// Menus
			this.megaMenu = this.header.find('#mega-menu-wrap');

			// Page
			this.page = $('#page');

			this.adminBar = $('#wpadminbar');

			this.resize();
		},

		resize: function(){
			this.isMobile = $(window).width() <= 768;
			this.isPad = $(window).width() <= 1024;
		}
	};


	/* # Headers */

	function handleHeaders(){

		// Search open
		$('[data-nav-search]').on('click', function(e) {
			e.preventDefault();
			Nor.headerSearch.addClass('opened');

			setTimeout(function(){
				Nor.headerSearch.find('form input').trigger('focus');
			}, 100);
		});

		// Search close
		Nor.headerSearch.on('click', function(e) {
			Nor.headerSearch.removeClass('opened');
		});
		// Remove close from form
		Nor.headerSearch.find('form').on('click', function(e) {
			e.stopPropagation();
		});

		if( Nor.headerIsFifth ){
			handleHeaderFifth();

			// Show logo after first calculate
			Nor.siteTitle.css( 'opacity', '1' );

			// If menu hidden or empty then set logo relative
			if( $('.main-nav.hidden').length == 0 ){
				Nor.siteTitle.css( 'position', 'relative' );
			}
		}

		handleMobileHeader();
		handleHeaderSize();
		handleFixedHeader();
	}

	function handleMobileHeader() {
		if( Nor.header && Nor.header.length ){

			if( Nor.isMobile ){ //$(window).width() <= 768;
				Nor.header.addClass('mobile-header');
			} else {
				Nor.header.removeClass('mobile-header');
			}
		}
	}

	function handleHeaderSize(){
		if( Nor.headerIsFifth ){
			handleHeaderFifth();
		}

		handleFixedHeader();

		if( !Nor.headerIsSixth ){
			Nor.header.css( 'width', Nor.page.outerWidth() + 'px' );
		}

		// Reset mega menu css properties for mobile phone
		if( Nor.isMobile ){
			Nor.megaMenu.find( 'ul' ).css({
				'left': '',
				'width': '',
				'max-width': '',
				'min-width': ''
			});
		}
	}

	function handleFixedHeader() {
		var fixed = Nor.headerFixed;

		if( $(document).scrollTop() > fixed.initialOffset ){

			if( (!Nor.isMobile && fixed.enabled && !fixed.value) ||
				(Nor.isMobile && fixed.mobileEnabled && !fixed.mobileValue) ){

				if( Nor.isMobile ){
					fixed.mobileValue = true;
				} else {
					fixed.value = true;
				}

				Nor.header.addClass( 'header-fixed no-transition' )
					.css({
						'width': Nor.page.outerWidth() + 'px'
					});

				// Hide non fixed logos
				Nor.logo.css( 'display', 'none' );
				Nor.mobileLogo.css( 'display', 'none' );

				// Show fixed logo
				if( Nor.isMobile && Nor.fixedMobileLogo.length ) {
					Nor.fixedMobileLogo.css( 'display', 'inline' );
				} else {
					Nor.fixedLogo.css( 'display', 'inline' );
				}
			}

		} else if( fixed.value || fixed.mobileValue ) {

			fixed.value = false;
			fixed.mobileValue = false;

			Nor.header.removeClass( 'header-fixed' );
			Nor.header.css({
				'transition-duration': '.2s',
				'top': '',
				'width': '',
				'margin-top': '',
			});

			// Hide fixed logos
			Nor.fixedLogo.css( 'display', '' );
			Nor.fixedMobileLogo.css( 'display', '' );

			// Show non fixed logo
			if( Nor.isMobile && Nor.mobileLogo.length ) {
				Nor.logo.css( 'display', 'none' );
				Nor.mobileLogo.css( 'display', 'inline' );
			} else {
				Nor.logo.css( 'display', 'inline' );
				Nor.mobileLogo.css( 'display', 'none' );
			}

		}

		// Effect appearance
		if ( $(document).scrollTop() > fixed.initialOffset + 50 ) {
			Nor.header.removeClass('no-transition').addClass('showed');
		} else {
			Nor.header.removeClass('showed').addClass('no-transition');
		}
	}

	// Five header cetered logo
	function handleHeaderFifth(){
		var nav = Nor.megaMenu.find('> ul > li');

		Nor.megaMenu.css( 'margin-left', '' );

		if( !Nor.isPad ){

			// If navigation hidden or empty then set logo on center
			if( $('.main-nav.hidden').length ){
				Nor.siteTitle.css( 'left', '' );

				var containerCenter = Nor.page.outerWidth()/2 + Nor.page.offset().left,
					siteTitleCenter = containerCenter - Nor.siteTitle.offset().left - (Nor.siteTitle.outerWidth() / 2);

				Nor.siteTitle.css( 'left', siteTitleCenter + 'px' );

			} else {

				// Hidden logo for repeat calculate
				Nor.siteTitle.css( 'display', 'none' );
				// Insert logo in center
				if ( Nor.megaMenu.length ) {
					var centerMenu = $('#primary-menu').width() / 2;
					var centerLi = 0, countWidth = 0;

					centerLi = nav.length / 2;

					if(centerLi % 2 !== 0) {
						centerLi = Math.round(centerLi);
						centerLi = centerLi - 1;
					}

					if ( nav.length > 4 ) {
						// Remove devider from center li
						$(nav[centerLi]).addClass( 'without-divider' );
						// Append logo after center li
						Nor.siteTitle.insertAfter( $(nav[centerLi]) );
					} else {
						// Remove devider from center li
						$(nav[centerLi - 1]).addClass( 'without-divider' );
						// Append logo after center li
						Nor.siteTitle.insertBefore( $(nav[centerLi]) );
					}
					
				} else {
					Nor.megaMenu.append( Nor.siteTitle );
				}

				// Restore hidden logo
				Nor.siteTitle.css( 'display', 'block' );

				// Centered menu
				var containerLeft = Nor.page.offset().left,
					containerWidth = Nor.page.outerWidth(),
					logoLeft = Nor.siteTitle.offset().left,
					logoWidth = Nor.siteTitle.outerWidth();

				var left = (containerLeft + containerWidth / 2) - logoLeft - (logoWidth / 2);

				Nor.megaMenu.css( 'margin-left', (left * 2) + 'px' );
			}
		} else {
			Nor.siteTitle.css( 'left', '0' );
		}
	}

	function handleHeaderTitle() {
		// Ttitle Parallax
		if ( $('.header-title .page-title').hasClass('no-transition') ){
			if ( $('.header-title h1').length ) {
				var scroll = $(document).scrollTop() / 3;
				if ( scroll > 200 ) {
					scroll = 200;
				} else {
					scroll = scroll;
				}
				$('.header-title h1, .header-title p.subtitle, .header-title .tags').css({
					'transform': 'translate3d(0,' + (scroll) + 'px, 0)',
					'opacity': 1 - ( scroll / 200)
				});
			}
		}
	}

	function showHeaderTitle(){
		$('.header-title').addClass('show');

		setTimeout(function(){
			$('.header-title .page-title, .header-title .subtitle, .header-title .tags').addClass('no-transition');
		}, 1000);
	}

	/* # Bar */

	function handleBarScroll(){
		var bar = $('.bar');

		if( bar.length ){
			var hamburger = $('.bar-hamburger .hamburger');

			if ( $(document).scrollTop() > 100 ) {
				hamburger.css('margin-top', '25px');
			} else {
				hamburger.css('margin-top', '');
			}
		}
	}

	/* # Navigation */

	window.openFullscreenMenu = function(){
		$('#fullscreen-mega-menu').addClass( 'open' ).find('#secondary-menu > li').each(function(i){
			var link = $(this);
			setTimeout(function(){
				link.addClass('showed');
			}, 150 + i * 40);
		});
	};

	function handleNavigations() {

		// Mobile menu
		var menuNow = 0;

		$('#hamburger-menu').on('click', function(){
			$('#site-navigation').addClass( 'active' );
			$('.close-menu').css( 'right', '0' );

			$(this).addClass('hidden');
			$('#masthead .search').addClass('visible');
		});

		$('#site-navigation .close, .close-menu, .mobile-header #site-navigation a[href^="#"]').on('click', function(){
			if ( menuNow != 0 ) {
				$('#mega-menu-sub-' + menuNow).removeClass( 'active' );
				$('#mega-menu-sub-' + menuNow).removeAttr( 'id' );
				menuNow--;
			} else {
				$('#site-navigation').removeClass( 'active' );
				$('.close-menu').css( 'right', '-100%' );
				$('#hamburger-menu').removeClass('hidden');
				$('#masthead .search').removeClass('visible');
			}
		});
		$('a.menu-link').on('click', function(){
			if( $(this).attr('href')[0] == '#' ){
				menuNow = 0;
				$('[id^="mega-menu-sub-"]').removeClass( 'active' );
				$('[id^="mega-menu-sub-"]').removeAttr( 'id' );
				$('#site-navigation').removeClass( 'active' );
				$('.close-menu').css( 'right', '-100%' );
				$('#hamburger-menu').removeClass('hidden');
				$('#masthead .search').removeClass('visible');
			}
		});

		$('.has-submenu > a').on( 'click touchstart', function(e) {
			if ( Nor.isPad ){ //Nor.isMobile

				var subNav = $(this).parent().find('> .sub-nav, > .sub-sub-nav');
				var menu = $(this).parent().find('.sub-nav > ul.sub-menu, > .sub-sub-nav > ul.sub-sub-menu, .submenu');
				menuNow++;
				menu.addClass('active').attr('id', 'mega-menu-sub-' + menuNow);
				subNav.addClass('open');

				return false;
			} else {
				if ( $(this).attr('target') == '_blank' ) {
					window.open($(this).attr('href'),'_blank');
				} else {
					window.location.href = $(this).attr('href');
				}
			}
		});
		if ( $('#masthead nav > .mobile-wpml-select').length ) {
			$('#masthead nav > .mobile-wpml-select').insertAfter( $('#mega-menu-wrap > ul > li').last() );
		}

		// Mega Menu
		if ( $('#mega-menu-wrap').length ) {
			$('#mega-menu-wrap').accessibleMegaMenu({
				uuidPrefix: 'accessible-megamenu',
				menuClass: 'menu',
				topNavItemClass: 'nav-item',
				panelClass: 'sub-nav',
				panelGroupClass: 'sub-sub-menu',
				hoverClass: 'hover',
				focusClass: 'focus',
				openClass: 'open'
			}).on( 'megamenu:open', function(e, el) {
				var $menu = $(this),
					$el = $(el),
					$subNav;

				if( Nor.isMobile ){
					return false;
				}

				if ( $el.is( '.main-menu-link.open' ) && $el.siblings( 'div.sub-nav' ).length>0) {
					$subNav = $el.siblings( 'div.sub-nav' );
				} else if ( $el.is( 'div.sub-nav' ) ) {
					$subNav = $el;
					$el = $subNav.siblings( '.main-menu-link' );
				} else {
					return true;
				}

				//$subNav.removeAttr( 'style' ).removeClass( 'sub-nav-onecol' );

				var ul = $subNav.find('ul.sub-menu-wide');
				ul.each( function() {
					var $ul = $(this);
					var total_width = 1;

					$ul.find('> .sub-nav-item').each( function() {
						total_width += $(this).outerWidth();
					});

					$ul.innerWidth( total_width );
				});

				var headerLeft = 0;
				if ( $('#masthead.header-3').length )  {
					var headerWrap = $('#masthead.header-3 .header-wrap');
					headerLeft = $(window).width() - headerWrap.outerWidth() - headerWrap.offset().left;
				}
				var windowWidth = $(window).width();

				var subNavWidth = $subNav.find('> ul').width();
				var subNavMargin = 0;

				$subNav.css({'max-width': windowWidth});

				if ( subNavWidth > windowWidth) {
					$subNav.addClass( 'sub-nav-onecol' );

					subNavWidth = $subNav.width();
				}
				var elWidth = $el.outerWidth();
				var elOffsetLeft = $el.offset().left;
				var elOffsetRight = windowWidth - $el.offset().left - elWidth;

				if ( elOffsetLeft < 0 )  {
					subNavMargin = -(elOffsetLeft -subNavWidth/2 + elWidth/2) - headerLeft;
				}
				if ( elOffsetRight < ( subNavWidth - elWidth) )  {
					subNavMargin = -( subNavWidth - elWidth - elOffsetRight) - headerLeft;
				}

				if ( ul.outerWidth() >= windowWidth ){
					$subNav.css('left', '');
					ul.innerWidth( windowWidth );
					subNavMargin = -$subNav.offset().left;
				}

				$subNav.css( 'left', subNavMargin );
			});

			$('#mega-menu-wrap .sub-sub-nav').each( function(){
				if ( $(this).offset().left + $(this).outerWidth() > $(window).width() ) {
					$(this).addClass('menu-left');
				}
			});
		}

		// Fullscreen Mega Menu
		$('#hamburger-fullscreen-menu').on( 'click', function(){
			openFullscreenMenu();
		});

		var fullscreenMenu = $('#fullscreen-mega-menu-wrap');
		if ( fullscreenMenu.length ) {

			var closeMenu = function(){
				$('#fullscreen-mega-menu').removeClass( 'open' ).find('#secondary-menu > li').each(function(i){
					$(this).removeClass('showed');
				});
			};

			$('#fullscreen-menu-close, #fullscreen-mega-menu-wrap a[href^="#"], #fullscreen-mega-menu-wrap a[href^="' + window.location.href + '"]').on( 'click', closeMenu );

			fullscreenMenu.accessibleMegaMenu({
				uuidPrefix: 'accessible-megamenu',
				menuClass: 'menu',
				topNavItemClass: 'nav-item',
				panelClass: 'sub-nav',
				panelGroupClass: 'sub-sub-menu',
				hoverClass: 'hover',
				focusClass: 'focus',
				openClass: 'open'
			}).on( 'megamenu:open', function(e, el) {
				$(this).find('.sub-nav:not(.open) > ul > li, .sub-nav .mega-menu-item:not(:hover) > .sub-sub-nav > .sub-sub-menu > li').removeClass('showed');
				$(this).find('.sub-nav.open > ul > li, .sub-nav .mega-menu-item:hover > .sub-sub-nav > .sub-sub-menu > li').each(function(i){
					var self = $(this);
					setTimeout(function(){
						if(self.parent().parent().parent().is(':hover')){
							self.addClass('showed');
						}
					}, i * 40);
				});
			});


			$('#fullscreen-mega-menu-wrap .sub-nav').on('mouseleave', function(){
				$(this).find('li').removeClass('showed');
			});
		}
	}

	/* # Footer */

	function handleFooter() {
		// Sticky
		var stickyFooter = $('.site-footer.sticky');
		if( stickyFooter.length && !Nor.isMobile ) {
			$('.site-content').css({
				'margin-bottom': stickyFooter.outerHeight() + 'px',
				'position': 'relative',
				'z-index': '3'
			});
			stickyFooter.addClass('visible');
		}
	};

	function handleFooterSize() {
		var stickyFooter = $('.site-footer.sticky');
		if( stickyFooter.length ){
			if( !Nor.isPad ){
				stickyFooter.css({
					'width': stickyFooter.parent().outerWidth() + 'px',
					'left': stickyFooter.parent().offset().left + 'px',
				});
				$('.site-content').css({
					'margin-bottom': stickyFooter.outerHeight() + 'px',
					'position': 'relative',
					'z-index': '3'
				});

				if ( $('.norebro-with-panel').length ) {
					stickyFooter.css({
						'width': stickyFooter.parent().outerWidth() - 75 + 'px',
						'left': stickyFooter.parent().offset().left + 'px',
					});
				}
			} else {
				$('.site-content').css({
					'margin-bottom': '',
					'position': '',
					'z-index': ''
				});
				stickyFooter.css({
					'width': '',
					'left': '',
				});
			}
		}
	}

	/* # Shortcodes */

	/* ## Accordion box */

	function handleAccordionBox(){
		$('[data-norebro-accordion]').each(function(){
			var accordion = $(this);
			var titles = $(this).find('div.title');
			var items = $(this).find('.item');
			var contents = $(this).find('.content');
			var iconOpened = 'ion-minus', iconClosed = 'ion-plus';
			var isOutline = $(this).hasClass('outline');

			var toggle = function( num ){
				var opened = accordion.find('.open');
				var content = contents.eq( num );

				// If not active
				if( !items.eq( num ).hasClass('active') ){
					// Activate this item
					items.removeClass('active');
					items.eq( num ).addClass('active');

					setTimeout(function(){
						content.css('height', '').addClass('no-transition open'); 			// Open new content
						var height = content.outerHeight() + 'px'; 							   // Save heights
						content.removeClass('no-transition open').css( 'height', (isOutline) ? '0px' : '6px' ); // Close new content

						setTimeout(function(){
							opened.removeClass('open no-transition').css( 'height', (isOutline) ? '0px' : '6px' ); // Close old content
							content.addClass('open').css( 'height', height );				// Open new content

							// Change titles
							titles.find('.control span').removeClass( iconOpened ).addClass( iconClosed );
							titles.eq(num).find('.control span').removeClass( iconClosed ).addClass( iconOpened );
						}, 30);
					}, 30);
				}
				else  {
					items.removeClass('active');
					opened.removeClass('open no-transition').css( 'height', (isOutline) ? '0px' : '6px' );
					titles.find('.control span').removeClass( iconOpened ).addClass( iconClosed );
				};
			};

			titles.each(function(i){
				$(this).on('click', function(){
					toggle( i );
				});
			});

			toggle( $(this).attr('data-norebro-accordion') || 0 );

			this.accordionToggle = toggle;
		});
	};
	function handleAccordionBoxSize(){
		$('[data-norebro-accordion]').each(function(){
			var content = $(this).find('.content.open');
			var wrap = content.find('.wrap');

			content.css('height', wrap.outerHeight() + 'px');

		});
	};

	/* ## Banner box */

	function handleBannerBox(){
		$('.banner-box.overlay-title.hover').each(function(){
			$(this).on('hover', function(){
				var self = $(this);
				var content = $(this).find('.title-wrap');
				var description = $(this).find('.description-wrap');

				description.css('margin-top', -content.outerHeight() + 'px');
			},
			function(){
				var self = $(this), newHeight = 0, oldHeight = 0;
				self.find('.description-wrap').css('margin-top', '');
			});
		});
	}
	function handleBannerBoxSize(){
		$('.banner-box.overlay-title.hover').each(function(){
			var newHeight = 0,
				 titles = $(this).find('.title-wrap');

			$(this).css('height', '');
			$(this).css('height', ($(this).outerHeight() - titles.outerHeight()) + 'px');
		});
	}

	/* ## Clients logo */

	function handleClientsLogo(){
		$('.clients-logo .overlay').each(function(){
			$(this).css('top', '-' + $(this).find('h4').outerHeight() + 'px');
		});
	};

	/* ## Chart box */

	function handleChartBox(){
		var scrollTop = $(document).scrollTop() + $(window).height();

		var settings = {
			size: 128,
			trackColor: "#e0e0e0",
			scaleColor: false,
			lineWidth: 4,
			trackWidth: 4,
			lineCap: "square",
			onStep: function(from, to, percent){
				if( $(this.el).length ){
					$(this.el).parent().find(".percent").html( Math.round(percent) );
				}
			}
		};

		$("[data-chart-box]").each(function(){
			if( scrollTop > $(this).offset().top + $(this).height() ){
				var color = $(this).attr("data-color")
				settings.barColor = color;

				$(this).easyPieChart( settings );
			}
		});
	};

	/* ## Counter box */

	function handleCounterBox(){
		$('[data-counter]').each(function(){
			var counter = $(this);
			var scrollTop = $(document).scrollTop() + $(window).height();

			if( scrollTop > counter.offset().top + counter.height() ){
				var countTimeRaw = counter.attr('data-counter');
				var countEnd = (countTimeRaw) ? parseInt( countTimeRaw.replace(/\s/g, '') ) : 0;

				counter.removeAttr('data-counter');

				for(var j = 0; j <= 20; j++){
					(function(count){

						setTimeout(function(){
							var number = Math.round((countEnd / 20) * count);

							counter.find('.count').html(number);
						}, 50 * count);

					})(j);
				}
			}
		});
	};

	/* ## Contact form */

	function handleContactForm(){
		// Button
		$('.contact-form').each(function(){
			var submit = $(this).find('[type="submit"]');
			var button = $(this).find('[data-contact-btn] button');

			if( submit.length ){
				button.find('.text').html( submit.val() );
				submit.replaceWith( button );
				$(this).find('.ajax-loader').remove();
			}

			// For focus
			if( $(this).hasClass('without-label-offset') ){
				$(this).find('.wpcf7-form-control-wrap').after('<div class="focus"></div>');

				$(this).find('input, textarea, select').on('focus', function(){
					$(this).parent().parent().find('.focus').addClass('active');
				}).on('blur', function(){
					$(this).parent().parent().find('.focus').removeClass('active');
				});
			}
		});

		// Loader
		$('.contact-form form').on('submit', function(){
			$(this).find('.btn-load').css({
				'width': '21px',
				'margin-right': '6px'
			});
		});

		$('.wpcf7').on('wpcf7invalid wpcf7spam  wpcf7mailsent wpcf7mailfailed', function(e){
			var form = e.target;
			$(form).find('.btn-load').css({
				'width': '0px',
				'margin-right': '0px'
			});
		});
	}

	/* ## Countdown box */

	function handleCountdownBox(){
		$("[data-countdown-box]").each(function(){
			$(this).html(''); // clean up before handle

			var countdownBox = $(this);
			var labels = countdownBox.attr('data-countdown-labels').split(','),
				parser = /([0-9]{2})/gi;

			// Return the time components that diffs
			var diff = function(obj1, obj2) {
				var diff = [];
				labels.forEach(function(key) {
					if (obj1[key] !== obj2[key]) {
						diff.push(key);
					}
				});
				return diff;
			}
			// Parse countdown string to an object
			var strfobj = function(str) {
				var parsed = str.match(parser),
					obj = {};
				labels.forEach(function(label, i) {
					obj[label] = parsed[i]
				});
				return obj;
			}

			var templateSource = $("#"+countdownBox.attr("data-countdown-box")).html();
			if (!templateSource) { templateSource = ''; }

			var template = _.template(templateSource),
				currentDate = '00:00:00:00:00',
				nextDate = '00:00:00:00:00';
			// Build the layout
			var initData = strfobj(currentDate);
			labels.forEach(function(label, i) {
				countdownBox.append(template({
					current: initData[label],
					next: initData[label],
					label: label
				}));
			});
			// Starts the countdown
			countdownBox.countdown(new Date($(this).attr("data-countdown-time")), function(event) {
				window.c = event;
				var newDate = event.strftime('%m:%n:%H:%M:%S'), data;
				if (newDate !== nextDate) {
					currentDate = nextDate;
					nextDate = newDate;
					// Setup the data
					data = {
						'current': strfobj(currentDate),
						'next': strfobj(nextDate)
					};
					// Apply the new values to each node that changed
					diff(data.current, data.next).forEach(function(label) {
						var selector = '.%s'.replace(/%s/, label),
							node = countdownBox.find(selector);
						// Update the node
						node.removeClass('flip');
						node.find('.box-current .number').text(data.current[label]);
						node.find('.box-next .number').text(data.next[label]);
						// Wait for a repaint to then flip
						_.delay(function(node) {
							node.addClass('flip');
						}, 50, node);
					});
				}
			});
		});
	}

	/* ## Cover box */

	function handleCoverBox(){
		$('[data-norebro-cover-box]').each(function(){
			var box = $(this),
				items = $(this).find('[data-item]'),
				triggers = $(this).find('[data-trigger]');

			var selected = -1;

			var openItem = function(num){
				var item = items.eq(num);

				if( selected != num && !Nor.isMobile ){
					selected = num;

					item.addClass('no-transition');
					item.css('width', '');

					var width = item.outerWidth();
					item.css('width', '0');

					setTimeout(function(){
						item.removeClass('no-transition');
						items.css('width', '0');
						item.css('width', (width - 2) + 'px');
					}, 30);
				}
			};

			triggers.on('mouseenter', function(){
				openItem( triggers.index( $(this) ) );
			});

			openItem(0);
		});
	}
	function handleCoverBoxSize(){
		$('[data-norebro-cover-box]').each(function(){
			var box = $(this);

			box.find('[data-item]').each(function(i){
				if( !Nor.isMobile ){
					$(this).css('height', box.find('[data-trigger]').eq(i).outerHeight() + 'px');
					$(this).find(' > * ').css('width', box.find('[data-trigger]').eq(i).outerWidth() + 'px');
				} else {
					$(this).css({
						'height': '',
						'width': ''
					});
				}
			});
		});
	}

	/* ## Gallery */

	function handleGallery(){
		$('[data-gallery]').each(function(){
			var gallery = $(this);

			// Move galleries popup to footer
			var oldPopup = $('#' + $(this).attr('data-gallery'));
			var popup = oldPopup.clone();
			$('body').append( popup );
			oldPopup.remove();

			var popup = popup[0];

			popup.options = JSON.parse( $(popup).attr('data-options') );
			popup.expanded = false;
			popup.opened = false;
			popup.currentItem = 0;

			var expand = function(){
				if( popup.expanded ){
					document.webkitCancelFullScreen();
					$(this).find('span').addClass('ion-android-expand').removeClass('ion-android-contract');
					popup.expanded = false;
				} else {
					popup.expanded = true;
					popup.webkitRequestFullscreen();
					$(this).find('span').removeClass('ion-android-expand').addClass('ion-android-contract');
				}
			};

			var close = function(){
				if( popup.opened ){
					popup.opened = false;
					$(popup).removeClass('open');

					var oldImage = $(popup).find('img.gimg').eq( popup.currentItem );
					var img = oldImage.clone().addClass('gallery-tmpimage active').css({
						'margin-left': '-' + oldImage.width()/2 + 'px',
						'height': oldImage.height() + 'px',
						'top': (oldImage.offset().top - $(popup).offset().top) + 'px'
					});

					$(document.body).append(img);

					setTimeout(function(){
						var newImage = gallery.find('img.gimg').eq( popup.currentItem );
						img.css({
							'left': newImage.offset().left + 'px',
							'margin-left': '',
							'height': newImage.height() + 'px',
							'top': newImage.offset().top - $(window).scrollTop() + 'px',
						});
					}, 50);

					setTimeout(function(){
						$(popup).find('.slider').remove();
						img.remove();
					}, 400);

					if( popup.expanded ){
						expand.call( $(popup).find('.expand') );
					}
				}
			};

			$(popup).find('.expand').on('click', expand);
			$(popup).find('.close').on('click', close);

			$(window).on('keydown', function(e){
				var key = e.which || e.keyCode || e.keyChar;
				if( key == 27 ){
					close();
				}
				if( key == 37 ){
					$(popup).find('.slider').trigger('prev.owl.carousel');
				}
				if( key == 39 ){
					$(popup).find('.slider').trigger('next.owl.carousel');
				}
			});
		});

		// Open popup
		$('body').on('click', '[data-gallery-item]', function(){
			var gallery = $(this).closest('[data-gallery]'),
				popup = $('#' + gallery.attr('data-gallery') ),
				images = gallery.find('.gallery-image'),
				options = popup[0].options;

			var _this = $(this);
			var image = $(this).find('img.gimg').eq(0);

			// Create slider
			var slider = $(document.createElement('div')).addClass('slider');
			popup[0].currentItem = 0;
			popup.append(slider);

			// Clone image for move
			var cloneImg = image.clone().css({
				'height': image.outerHeight()+'px',
				'top': image.offset().top - $(window).scrollTop(),
				'left': image.offset().left,
			}).addClass('gallery-tmpimage');
			$(document.body).append(cloneImg);

			popup[0].opened = true;
			popup.addClass('open');


			// Generated slider
			images.each(function(){
				var div = $(document.createElement('div'));
				div.append( $(document.createElement('div')).addClass('image-wrap').append($(this).find('img.gimg').eq(0).clone()) );

				if($(this).find('.gallery-description').length){
					var description = $(this).find('.gallery-description').clone();
					div.append( description ).addClass('with-description');

					if( $(window).width() > 787 ){
						setTimeout(function(){
							div.find('.image-wrap').css('height', 'calc(100% - ' + (description.outerHeight() - 5) + 'px)')
						}, 10);
					}
				}

				slider.append(div);
			});

			slider.owlCarousel({
				items: 		1,
				autoHeight: true,
				slideBy: 	1,
				nav: 		true,
				navText:    [ '<span class="ion-ios-arrow-thin-left"></span>', '<span class="ion-ios-arrow-thin-right"></span>' ],
				navContainerClass: 'owl-nav slider-nav',
				navClass:   ['owl-prev ' + options.navClass, 'owl-next ' + options.navClass],
				dots: 		false,
				loop: 		false,
				autoplay: 	false,
				navSpeed: 	600,
			}).on('changed.owl.carousel', function(event) {
				popup[0].currentItem = event.item.index;
				slider.find('.thumbs img').removeClass('active');
				slider.find('.thumbs img').eq( popup[0].currentItem ).addClass('active');
			});

			slider.trigger('to.owl.carousel', [parseInt($(this).attr('data-gallery-item')), 50, true]);


			// Generate thumbnails
			slider.find('.owl-nav').after('<div class="thumbs"></div>');
			var thumbnails = slider.find('.thumbs');

			images.each(function(index){
				thumbnails.append($(this).find('img.gimg').eq(0).clone().on('click', function(){
					$(this).parent().find('img').removeClass('active');
					$(this).addClass('active');
					slider.trigger('to.owl.carousel', [index, 300, true]);
				}));
			});

			slider.find('.thumbs img').eq(parseInt($(this).attr('data-gallery-item'))).addClass('active');


			// Move tmp image
			setTimeout(function(){
				var sliderImg = slider.find('img.gimg').eq(parseInt(_this.attr('data-gallery-item')));
				cloneImg.css({
					'height': sliderImg.outerHeight() + 'px',
					'top': (sliderImg.offset().top - popup.offset().top) + 'px',
					'left': '',
					'margin-left': '-' + (sliderImg.outerWidth() / 2) + 'px'
				}).addClass('active');

				// Open slider, remove tmp image
				setTimeout(function(){
					slider.css('visibility', 'visible');
					slider.find('.thumbs img').each(function(i){
						var img = $(this);
						setTimeout(function(){ img.addClass('showed'); }, 50 * i );
					});
					setTimeout(function(){
						cloneImg.remove();
					}, 250);
				}, 300);
			}, 50);
		});
	}

	/* ## Onepage */

	function handleOnepage(){
		$.fn.norebroOnepage = function(options){
			var onepage = $(this),
				stage = onepage.find(' > .onepage-stage'),
				items = $(this).find('.onepage-section'),
				isHorizontal = onepage.hasClass('horizontal'),
				anchors = null, // Dots
				itemNow = 0,
				scrollEnabled = true, // For pause during animation
				speed = options.speed || 500,
				disableOnMobile = onepage.hasClass('disable-on-mobile');

			stage.css('transition', 'transform ' + (speed/1000) + 's ease-in-out');
			items.eq(0).addClass('active');

			var divNav = $('#mega-menu-wrap ul li, #masthead .menu-other > li > a');

			// Transitions to section
			var moveTo = function(i){

				if( Nor.isMobile && disableOnMobile ){
					return false;
				}

				itemNow = i;
				if( i < 0 ){
					itemNow = 0;
				}
				if( i > items.length - 1 ){
					itemNow = items.length - 1;
				}

				if( anchors ){
					anchors.removeClass('active');
					anchors.eq(itemNow).addClass('active');
				}

				var isPrev = items.eq(itemNow).hasClass('prev');

				items.removeClass('active active-prev prev');
				items.eq(itemNow).addClass('active');
				items.eq(itemNow-1).addClass('prev');

				if( isPrev ){
					items.eq(itemNow).addClass('active-prev');
				}

				scrollEnabled = false;

				if( options.vertical ){
					stage.css('transform', 'translate3d(-' + (onepage.outerWidth() * itemNow) + 'px, 0, 0)');
				} else {
					stage.css('transform', 'translate3d(0, -' + (onepage.outerHeight() * itemNow) + 'px, 0)');
				}

				var paginationColor = items.eq( itemNow ).attr('data-pagination-color');
				var menuColor = items.eq( itemNow ).attr('data-header-nav-color');
				var logoType = items.eq( itemNow ).attr('data-header-logo-type');

				var top = onepage.offset().top - ( $(window).height() - onepage.outerHeight() ) / 2;
				var scrollTop = $(document).scrollTop();

				if( top != 0 ) {
					var correctPosition = ( top + top > scrollTop && top - top * 2 < scrollTop );
				} else {
					var correctPosition = ( top + 10 > scrollTop && top - 10 < scrollTop );
				}

				onepage.find('.onepage-dots li').css( 'color', ( paginationColor ) ? paginationColor : '' );

				if( correctPosition ){
					divNav.css( 'color', menuColor ? menuColor : '' );

					Nor.logoForOnepageLight.addClass('hidden');
					Nor.logoForOnepageDark.addClass('hidden');

					if( logoType ){
						$([Nor.logo[0], Nor.fixedLogo[0]]).css({
							'position': 'absolute',
							'width': '0px',
							'height': '0px',
							'overflow': 'hidden'
						});

						if( logoType == 'dark' ){
							Nor.logoForOnepageDark.removeClass('hidden');
						}
						if( logoType == 'light' ){
							Nor.logoForOnepageLight.removeClass('hidden');
						}
					} else {
						$([Nor.logo[0], Nor.fixedLogo[0]]).css({
							'position': '',
							'width': '',
							'height': '',
							'overflow': ''
						});
					}
				}

				setTimeout(function(){
					scrollEnabled = true;
				}, 1000);
			};
			var moveUp = function(){
				moveTo( itemNow - 1 );
			}
			var moveDown = function(){
				moveTo( itemNow + 1 );
			}
			// Transition by y
			var move = function(y, e){
				if( !( Nor.isMobile && disableOnMobile ) ){
					var top = onepage.offset().top - ( $(window).height() - onepage.outerHeight() ) / 2;
					var scrollTop = $(document).scrollTop();
					var correctPosition = ( top + 100 > scrollTop && top - 100 < scrollTop );

					if( ( y > 0 && itemNow < items.length - 1) || (y < 0 && itemNow > 0) ){
						if( !correctPosition ){
							setTimeout(function(){
								$('html, body').animate({
									scrollTop: top
								}, 400);
							}, 100);

							var menuColor = items.eq( itemNow ).attr('data-header-nav-color');
							divNav.css( 'color', menuColor ? menuColor : '' );
						}
					}

					if( y > 0 && itemNow < items.length - 1 ){
						if( scrollEnabled && correctPosition )	moveDown();
						e.preventDefault();
					}
					else if( y < 0 && itemNow > 0 ){
						if( scrollEnabled && correctPosition ) moveUp();
						e.preventDefault();
					}
					else if( !scrollEnabled || (y < 1 && y > -1) ){
						e.preventDefault();
					}
					else {
						$('html, body').stop(true, true).finish();
						divNav.css('color', '');
						$([Nor.logo[0], Nor.fixedLogo[0]]).css({
							'position': '',
							'width': '',
							'height': '',
							'overflow': ''
						});
						Nor.logoForOnepageLight.addClass('hidden');
						Nor.logoForOnepageDark.addClass('hidden');
					}
					if( window.AOS ){
						setTimeout( AOS.refresh, 400 );
					}
				}

				handleScrollEffects();
			};

			// Mouse events
			
			if( options.mousewheel ){
				onepage.on('wheel mousewheel', function(e){
					var y = e.originalEvent.deltaY;
					move( y, e );
				});
			}
			// Keyboard events
			onepage.on('keydown', function(e){
				var key = e.which || e.keyCode;
				if( key == 38 ){
					move( -1, e );
				}
				else if( key == 40 ){
					move( 1, e );
				}
			});
			// Tach events
			if (Nor.isPad && options.mousewheel) {
				var oldTachY = 0;
				onepage.on('touchstart', function(e){
					var y = e.originalEvent.touches[0].clientY,
						x = e.originalEvent.touches[0].clientX;

					if( isHorizontal ){
						oldTachY = x;
					} else {
						oldTachY = y;
					}
				});
				onepage.on('touchmove', function(e){
					var y = e.originalEvent.touches[0].clientY,
						x = e.originalEvent.touches[0].clientX;

					var moveS;
					if( isHorizontal ){
						moveS = oldTachY - x;
						oldTachY = x;
					} else {
						moveS = oldTachY - y;
						oldTachY = y;
					}
					move( moveS, e );
				});
			}

			onepage[0].resize = function(){
				if( Nor.isMobile && disableOnMobile ){
					items.css({
						'width': '',
						'height': ''
					});
					stage.css('transform', 'none');
				} else {
					items.each(function(){
						if( options.vertical ){
							$(this).css('width', onepage.outerWidth() + 'px');

							if ( $(this).offset().top != 0 ) {
								$(this).css('height', onepage.outerHeight() - $(this).offset().top + 1 + 'px').addClass('not-full');
							} else {
								$(this).css('height', onepage.outerHeight() + 'px');
							}
						} else {
							$(this).css('height', onepage.outerHeight() + 'px');
						}

						
					});

				}
				moveTo( itemNow );
			};

			/*# Create navigations #*/

			// Append dots
			if( options.dots ){
				var ul = $(document.createElement('ul')).addClass('onepage-dots');

				if( options.dotsClass ){
					ul.addClass( options.dotsClass );
				}

				items.each(function(i){
					var li = $(document.createElement('li'));

					if( options.dotClass ){
						li.addClass( options.dotClass );
					}

					li.on('click', function(){
						moveTo( i );
					});
					ul.append( li );

					$(this).css('height', onepage.outerHeight() + 'px');
				});

				onepage.append( ul );
				anchors = ul.find('li');
				anchors.eq(0).addClass('active');
			}

			// Append nav button
			if( options.nav ){
				var nav = $(document.createElement('div')).addClass('onepage-nav');

				if( options.navContainerClass ){
					nav.addClass( options.navContainerClass );
				}

				var up = $(document.createElement('div')).addClass('move-up');
				var down = $(document.createElement('div')).addClass('move-down');
				var icon = $(document.createElement('span'));

				if( options.navClass ){
					up.addClass( options.navClass[0] );
					down.addClass( options.navClass[1] );
				}

				up.append( icon.clone().addClass( (options.navIcons) ? options.navIcons[0] : 'ion-ios-arrow-thin-up' ) );
				down.append( icon.clone().addClass( (options.navIcons) ? options.navIcons[1] : 'ion-ios-arrow-thin-down' ) );

				up.on('click', function(){ moveUp(); });
				down.on('click', function(){ moveDown(); });

				nav.append( up, down );
				onepage.append( nav );
			}

			var countSlides = items.length;
			if( countSlides < 10 ){
				countSlides = '0' + countSlides;
			}
			onepage.find('[data-onepage-counter]').each(function(i){
				var num = i + 1;
				if( num < 10 ) {
					num = '0' + num;
				}

				$(this).html( num +'/' + countSlides );
			});
		};

		$('[data-norebro-onepage]').each(function(){
			var data = $(this).attr('data-options');
			var options = ( data ) ? JSON.parse( data ) : {};
			$(this).norebroOnepage( options );
		});
	}
	function handleOnepageSize(){
		$('[data-norebro-onepage]').each(function(){
			this.resize();
		});
	}

	/* ## Parallax */

	function initParallax(){
		$('[data-parallax-bg]').each( function(){
			var bg = $(this).find('.parallax-bg');
			var speed = $(this).attr( 'data-parallax-speed' );

			if( $(this).attr('data-parallax-bg') == 'vertical' ){
				$(this).find('.parallax-bg').css( {
					height: ( $(this).outerHeight() + speed * 200 ) + 'px'
				});
			} else {
				$(this).find('.parallax-bg').css( {
					width: ( $(this).outerWidth() + speed * 200 ) + 'px'
				});
			}
			bg.addClass( ( $(this).attr('data-parallax-bg') == 'vertical' ) ? '' : 'horizontal' );
		});
	};
	function handleParallax() {
		var contentScroll = $(document).scrollTop();
		var wndHeight = $(window).height();

		$('[data-parallax-bg]').each( function(){
			var parallaxTop = $(this).offset().top;
			var parallaxHeight = $(this).outerHeight();
			var parallaxWidth = $(this).outerWidth();

			// If parallax block on screen
			if( parallaxTop <= contentScroll + wndHeight && parallaxTop + parallaxHeight >= contentScroll ){

				var speed = parseFloat( $(this).attr( 'data-parallax-speed' ) ) * 100;
				var bg = $(this).find('.parallax-bg');

				var percent = (-parallaxTop + contentScroll + wndHeight) / (parallaxHeight + wndHeight);
				var offset = -(percent * 2) * speed;

				if( $(this).attr('data-parallax-bg') == 'vertical' ){
					bg.css( 'transform', 'translate3d(0, ' + offset + 'px, 0)' );
				} else {
					bg.css( 'transform', 'translate3d(' + offset + 'px, 0, 0)' );
				}
			}
		});
	};

	/* ## Progress bar */

	function handleProgressBar(){
		$("[data-norebro-progress-bar]:not([data-processed])").each(function(){
			var percent,
				bar = $(this),
				line = bar.find('.line'),
				progressEnd = parseInt( bar.attr("data-norebro-progress-bar") ),
				withTooltip = bar.find('[data-tooltip]').length;

			var scrollTop = $(document).scrollTop() + $(window).height();

			if( line.length == 0 && bar.hasClass('split') ){
				var div = $(document.createElement('div')).addClass('line-split');

				div.append( $(document.createElement('div')).addClass('line brand-bg-color') );

				for( var i = 0; i < 8; i++ ){
					var div = div.clone();

					bar.find('.line-wrap').append( div );

					div.find('.line').css({
						'left': -(div.offset().left - bar.offset().left) + 'px'
					});
				}

				if( withTooltip ) {
					bar.find('.line-wrap').append('<div class="line"><h4 class="line-percent"><span class="percent">0</span>%</h4></div>');
				}

				line = bar.find('.line');
			}

			percent = bar.find('.percent');

			if(scrollTop > bar.offset().top + bar.height()){
				bar.attr("data-processed", "true");
				if( bar.hasClass('inner') ) {
					line.css("width", (bar.outerWidth() * (progressEnd / 100) - 8) + "px");
				} else {
					line.css("width", (bar.outerWidth() * (progressEnd / 100)) + "px");
				}

				for(var j = 0; j <= 40; j++){
					(function(count){
						setTimeout(function(){
							percent.html( Math.round((progressEnd / 40) * count) );
						}, 30 * count);
					})(j);
				}
			}
		});
	}
	function handleProgressBarSize(){
		$("[data-norebro-progress-bar][data-processed]").each(function(){
			var bar = $(this);
			var line = bar.find('.line');
			var progressEnd = parseInt( bar.attr("data-norebro-progress-bar") );

			if( bar.hasClass('inner') ) {
				line.css("width", (bar.outerWidth() * (progressEnd / 100) - 8) + "px");
			} else {
				line.css("width", (bar.outerWidth() * (progressEnd / 100)) + "px");
			}

			bar.find('.line-split').each(function(){
				$(this).find('.line').css({
					'left': -($(this).offset().left - bar.offset().left) + 'px'
				});
			});
		});
	}

	/* ## Price table */

	function handlePriceTable(){
		if ( !Nor.isMobile ){
			$('.pricing-table.features').each(function(){
				var row = $(this).parents('.vc_row').eq(0);
				var table = row.find('.pricing-table').eq(1);

				// Calculate position
				$(this).css({
					'padding-top': (table.find('.list-box').eq(0).offset().top - table.offset().top - $(this).find('h3').outerHeight() - 15) + 'px',
					'min-height': table.outerHeight() + 'px'
				});


				// Calculate sizes
				$(this).find('li').each(function(i){
					var max = 0;
					row.find('.pricing-table').each(function(){
						var h = $(this).find('li').eq(i).outerHeight();
						if ( h > max ) {
							max = h;
						}
					});
					row.find('.pricing-table').each(function(){
						$(this).find('li').eq(i).css({
							'height': max + 'px',
						});
					});
				});
			});
		} else {
			$('.pricing-table.features').each(function(){
				$(this).css({
					'padding-top': '',
					'min-height': ''
				});
			});
		}
	};

	/* ## Social bar */

	function handleSocialBar(){
		$(".socialbar:not(.new-tab-links) a").on("click", function(e){
			e.preventDefault();
			window.open(this.href, '', 'width=800,height=300,resizable=yes,toolbar=0,status=0');
		});
	};

	/* ## Split box */

	function handleSplitboxParallax() {
		var process = function(side, num){
			if ( $(this).attr( 'data-parallax-' + side ) ) {
				$(this).find('.split-box-wrap').eq(num).attr({
					'data-parallax-bg': $(this).attr( 'data-parallax-' + side ),
					'data-parallax-speed': $(this).attr( 'data-parallax-speed-' + side )
				});
			} else {
				$(this).find('.split-box-wrap').eq(num).find('.parallax-bg').css({
					'height': '100%',
					'width': '100%'
				});
			}

			//Script for IE 11
			var isIE11 = !!navigator.userAgent.match(/Trident.*rv\:11\./);

			if( isIE11 ) {
				if( $('.split-box').hasClass('full-vh') ) {
					$(this).find('.split-box-wrap').eq(num).find('.parallax-bg').css({
						'height': '100vh',
						'width': '100%'
					});
				} else {
					var boxWrap = $('.split-box-wrap');
					var boxHeight = boxWrap.height();

					boxWrap.eq(num).find('.parallax-bg').css({
						'height': boxHeight + 'px',
						'width': '100%'
					});
				}
			}
		};

		$('.split-box').each( function(){
			process.call(this, 'left', 0);
			process.call(this, 'right', 1);
		});

	}

	/* ## Sliders */

	function handleSliders() {
		$('[data-norebro-slider]').each( function(){

			var carousel = $(this);
			var options = $(this).attr('data-norebro-slider');
			options = (options) ? JSON.parse( options ) : {};

			options.autoHeight = ( options.autoHeight == undefined ) ? true : options.autoHeight;
			options.dotsSpeed = ( options.dotsSpeed == undefined ) ? 500 : options.dotsSpeed;
			options.keyControl = ( options.keyControl == undefined ) ? false : options.keyControl;

			if( options.autoplay ){
				options.autoplaySpeed = ( options.autoplaySpeed == undefined ) ? 500 : options.autoplaySpeed;
				options.autoplayTimeout = ( options.autoplaySpeed == undefined ) ? 500 : options.autoplayTimeout * 1000;
			}

			options.responsive = {
				979: {
					items: options.itemsDesktop || 5,
					nav: options.nav
				},
				768: {
					items: options.itemsTablet || 3,
					nav: options.nav
				},
				0: {
					items: options.itemsMobile || 1,
					nav: options.nav
				}
			};

			if( options.dots ) {
				$(this).addClass('with-dots');
				options.dotClass = 'owl-dot ' + (( options.dotClass ) ? options.dotClass : '');
				options.dotsClass = 'owl-dots ' + (( options.dotsClass ) ? options.dotsClass : '');
			}


			options.navText = [ '', '' ];
			if( options.nav ){
				options.navSpeed = ( options.navSpeed == undefined ) ? 600 : options.navSpeed;
				options.navText = [ '<span class="ion-ios-arrow-thin-left"></span>', '<span class="ion-ios-arrow-thin-right"></span>' ];
				options.navContainerClass = ( options.navContainerClass ) ? 'owl-nav ' + options.navContainerClass : 'owl-nav';

				if( options.navClass ){
					options.navClass = ['owl-prev ' + options.navClass[0], 'owl-next ' + options.navClass[1]];
				} else {
					options.navClass = ['owl-prev', 'owl-next'];
				}
			}


			// Nav buttons for slider offset
			var calculatePositionNavButtons = function(){
				if( carousel.hasClass('slider-offset') ){
					var itemWidth = carousel.find('.owl-item').outerWidth();
					var next = carousel.find('.owl-next'), prev = carousel.find('.owl-prev');

					if( !Nor.isMobile ){
						prev.css('margin-left', (-itemWidth/2 - prev.outerWidth()/2) + 'px');
						next.css('margin-left', (itemWidth/2 - next.outerWidth()/2) + 'px');
					} else {
						prev.css('margin-left', '');
						next.css('margin-left', '');
					}
				}
			};

			carousel.on('initialized.owl.carousel refreshed.owl.carousel changed.owl.carousel resized.owl.carousel', function(){
				calculatePositionNavButtons();
				if( $(this).hasClass('slider-offset') ){
					var self = $(this);
					setTimeout( function(){
						self.find('.owl-item.active').removeClass('offset-active').eq(2).addClass('offset-active');
					}, 10);
				}
			});

			// Slider in slider
			options.onInitialized = function(){
				carousel.find('.owl-stage-outer').addClass('no-transition');
				carousel.find('.slider, .norebro-slider').trigger('refresh.owl.carousel');

				setTimeout(function(){
					carousel.trigger('refresh.owl.carousel');

					setTimeout(function(){
						carousel.find('.owl-stage-outer').removeClass('no-transition');
					}, 10);
				}, 10);
			};

			carousel.owlCarousel( options );

			calculatePositionNavButtons();

			if ( options.mousewheel ) {
				var mouseUpEnabled = true;
				var mouseDownEnabled = true;

				carousel.on('changed.owl.carousel', function(e){
					setTimeout(function(){
						if( e.item.index == 0 ){
							mouseUpEnabled = true;
						} else {
							mouseUpEnabled = false;
						}
						if( e.item.index + e.page.size == e.item.count ) {
							mouseDownEnabled = true;
						} else {
							mouseDownEnabled = false;
						}
					}, 300);
				});


				var test = true;

				carousel.on('wheel mousewheel', '.owl-stage', function(e) {
					var y = e.originalEvent.deltaY;

					if ( test && ( (y > 0 && !mouseDownEnabled) || (y < 0 && !mouseUpEnabled) ) ) {
						$('html, body').animate({
							scrollTop: carousel.offset().top - ( $(window).height() - carousel.outerHeight() ) / 2
						}, 400);
						carousel.trigger( (( y > 0 ) ? 'next.owl' : 'prev.owl'), options.navSpeed || 350 );
						test = false;
						setTimeout(function(){
							test = true;
						}, 350 );
					}

					if( !options.loop && (y > 0 && !mouseDownEnabled) || (y < 0 && !mouseUpEnabled) ) {
						e.preventDefault();
						return false;
					}
				});

			}

			if( options.keyControl ){
				$(window).on('keydown', function(e) {
					var key = e.which || e.keyCode;

					if( key == 37 ){
						carousel.trigger('prev.owl', options.navSpeed || 350 );
					}
					if( key == 39 ){
						carousel.trigger('next.owl', options.navSpeed || 350 );
					}
				});
			}
		});

		$('[data-norebro-slider-simple]').each( function(){
			$(this).owlCarousel({
				items: 1,
				nav: true,
				navRewind: true,
				navText: [ '<span class="ion-ios-arrow-thin-left"></span>', '<span class="ion-ios-arrow-thin-right"></span>' ],
				dots: true,
				loop: true,
				autoHeight: true,
			});
		});
	}

	/* ## Split screen */

	function handleSplitScreens(){
		$('[data-norebro-splitscreen]').each(function(){

			if( !Nor.isMobile ){
				
				if ( $(window).height() <= 450 ) {
					return;
				}

				var splitscreen = $(this),
					key = $(this).attr('data-norebro-splitscreen'),
					options = JSON.parse( $(this).attr('data-options') );
					// console.log(options);
					scrollToSlide(key);
   
				var anchors = [],
					itemsCount = 0,
					menu = null;

				if( options.dots ){
					menu = $(document.createElement('ul')).addClass('splitscreen-dots');

					if( options.dotsClass ){
						menu.addClass( options.dotsClass );
					}

					$(this).find('.ms-left .ms-section').each(function(i){
						var li = $(document.createElement('li')).attr('data-menuanchor', key + i);
						var link = $(document.createElement('a')).attr('href', '#' + key + i);
						li.append(link);

						if( options.dotClass ) {
							li.addClass( options.dotClass );
						}

						anchors.push( key + i );

						if( i == 0 ){
							li.addClass('active');
						}

						menu.append( li );

						itemsCount++;
					});

					splitscreen.append( menu );
				}

				var enableScroll = {
					down: false,
					up: false,
					nextIndex: -1,
					focuse: false,
				};

				$(this).multiscroll({
					verticalCentered: true,
					scrollingSpeed: 600,
					sectionsColor: [],
					navigation: true,
					navigationPosition: 'right',
					navigationColor: '#000',
					navigationTooltips: [],
					loopBottom: false,
					loopTop: false,
					css3: true,
					paddingTop: 0,
					paddingBottom: 0,
					normalScrollElements: null,
					keyboardScrolling: true,
					touchSensitivity: 5,

					// Custom selectors
					sectionSelector: '.ms-section',
					leftSelector: '.ms-left',
					rightSelector: '.ms-right',

					anchors: anchors,
					menu: menu,

					//events
					onLeave: function(index, nextIndex, direction){
						enableScroll.up = false;
						enableScroll.down = false;
						enableScroll.nextIndex = nextIndex;

						if( nextIndex == 1 ){
							setTimeout(function(){
								if( enableScroll.nextIndex == 1 ){
									enableScroll.up = true;
								}
							}, 600);
						} else if( nextIndex == itemsCount ){
							setTimeout(function(){
								if( enableScroll.nextIndex == itemsCount ){
									enableScroll.down = true;
								}
							}, 600);
						}

						var activeSection = splitscreen.find('.ms-section').eq( nextIndex-1 );
						var activeIsPrev = activeSection.hasClass('prev');

						splitscreen.find('.ms-section').removeClass('prev active-prev');
						splitscreen.find('.ms-section').eq( nextIndex-2 ).addClass( 'prev' );

						if( activeIsPrev ){
							activeSection.addClass('active-prev');
						}
					},
					afterLoad: function(anchorLink, index){},
					afterRender: function(){},
					afterResize: function(){},
				});
				$(this).multiscroll.setMouseWheelScrolling( false );
				if (options.mousewheel) {
					$(this).on('mouseenter mousemove', function(){
						enableScroll.auto = true;
						$(this).multiscroll.setMouseWheelScrolling( true );
					});

					$(this).on('mouseleave', function(){
						enableScroll.auto = true;
						$(this).multiscroll.setMouseWheelScrolling( false );
					});

					var animEnabled = false;

					$(this).on('wheel mousewheel', function(e){
						var y = e.originalEvent.deltaY;
						var top = (splitscreen.offset().top + (splitscreen.outerHeight() - $(window).height()) / 2);
						var scrollTop = $(document).scrollTop();

						if( (y > 0 && !enableScroll.down) || (y < 0 && !enableScroll.up) ) {
							e.preventDefault();
							if( enableScroll.auto && !animEnabled ) {
								animEnabled = true;

								setTimeout( function(){
									$('html, body').animate({
										scrollTop: top
									}, 500, function(){
										animEnabled = false;
									});
								}, 100);
							}

							if( (top + 10 < scrollTop || top - 10 > scrollTop) && top > 10 ){
								$(this).multiscroll.setMouseWheelScrolling( false );
							} else {
								$(this).multiscroll.setMouseWheelScrolling( true );
							}
						} else {
							$('html, body').stop(true, true).finish();
						}
						if( window.AOS ){
							setTimeout( AOS.refresh, 400 );
						}
					});
				}


				if( options.nav ){
					var nav = $(document.createElement('div')).addClass('splitscreen-nav');

					if( options.navContainerClass ){
						nav.addClass( options.navContainerClass );
					}

					var up = $(document.createElement('div')).addClass('move-up');
					var down = $(document.createElement('div')).addClass('move-down');
					var icon = $(document.createElement('span'));

					if( options.navClass ){
						up.addClass( options.navClass[0] );
						down.addClass( options.navClass[1] );
					}

					up.append( icon.clone().addClass( (options.navIcons) ? options.navIcons[0] : 'ion-ios-arrow-thin-up' ) );
					down.append( icon.clone().addClass( (options.navIcons) ? options.navIcons[1] : 'ion-ios-arrow-thin-down' ) );

					up.on('click', function(){ splitscreen.multiscroll.moveSectionUp(); });
					down.on('click', function(){ splitscreen.multiscroll.moveSectionDown(); });

					nav.append( up, down );
					splitscreen.append( nav );
				}

				setTimeout(function(){
					$('html, body').css({
						'overflow': '',
						'height': ''
					});
				}, 50);
			}
			// SplitScreen on mobile
			else {
				var leftSections = $(this).find('.ms-left .ms-section');

				$(this).find('.ms-right .ms-section').each(function(i){
					$(this).insertAfter( leftSections.eq(i) );
				});
			}
		});
	}


	function scrollToSlide(key){

		var url = window.location.href;
		var hasUrl = url.indexOf('#norebro-custom')!== -1;

		if ( hasUrl ) {
			var slide_number = url.slice(-1);
			var link = url.slice(0, url.indexOf('#norebro-custom'));

			link = link + '#' + key + slide_number;

			location.href = link;
		}	
	};

	/* ## Tab box  */

	function handleTabBox(){
		$('[data-norebro-tab-box]').each(function(){
			var box = $(this);
			var buttons = $(this).find('.buttons .button');
			var buttonsWrap = $(this).find('.buttons');
			var line = $(this).find('.buttons .line');
			var items = $(this).find('.item');
			var options = (box.attr('data-options')) ? JSON.parse( box.attr('data-options') ) : {};

			// Initializtion
			if( buttons.length == 0 ){
				items.each(function(){
					var title = $(this).attr('data-title');
					box.find('.buttons').append( $(document.createElement('h4')).addClass('button ' + options.tabClass).html(title) );
				});
				buttons = $(this).find('.button');
				buttons.eq(0).addClass('active ' + options.tabActiveClass);
			}
			items.eq(0).addClass('active');

			items.addClass(options.itemClass);


			// Process
			var refresh = function(){
				// Height
				var activeItem = box.find('.item.active');
				if( box.hasClass('vertical') && buttonsWrap.outerHeight() > activeItem.outerHeight() ) {
					box.find('.items').css('height', buttonsWrap.outerHeight() + 'px');
				} else {
					box.find('.items').css('height', activeItem.outerHeight() + 'px');
				}

				// Line
				var active = box.find('.buttons .active');
				if( box.hasClass('vertical') ){
					line.css({
						'height': active.outerHeight() + 'px',
						'transform': 'translateY(' + (active.offset().top - buttonsWrap.offset().top) + 'px)'
					});
				} else {
					line.css({
						'width': active.outerWidth() + 'px',
						'transform': 'translateX(' + (active.offset().left - buttonsWrap.offset().left + buttonsWrap.scrollLeft()) + 'px)'
					});
				}
			};

			buttons.on('click', function(){
				buttons.removeClass('active ' + options.tabActiveClass).addClass(options.tabClass);
				items.removeClass('active');

				$(this).addClass('active ' + options.tabActiveClass);
				items.eq($(this).index()-1).addClass('active');

				refresh();
			});


			refresh();
		});
	};
	function handleTabBoxSize(){
		$('[data-norebro-tab-box]').each(function(){
			var box = $(this);
			var activeItem = box.find('.item.active');
			var buttonsWrap = box.find('.buttons');

			if( box.hasClass('vertical') && buttonsWrap.outerHeight() > activeItem.outerHeight() ) {
				box.find('.items').css('height', buttonsWrap.outerHeight() + 'px');
			} else {
				box.find('.items').css('height', activeItem.outerHeight() + 'px');
			}
		});
	};


	/* Temporary shortcode features */
	/* ## Video Background */

	function handleVideoBackground(){
		$('[data-arg-video-bg]').each(function(){
			var videoLink = $(this).attr('data-arg-video-bg');
			var iframe = $(document.createElement('iframe'));

			iframe.addClass('arg-video-bg').attr('src', videoLink);
			$(this).append( iframe );
		});
	}

	/* ## Video popup */

	function handleVideoPopup(){
		$('body').on( 'click', '[data-video-module]', function() {
			var popup = $(document.createElement('div')).addClass('video-module-popup');
			var popupVideo = $(document.createElement('div')).addClass('video');

			// Create popup close button
			var popupClose = $(document.createElement('div')).addClass('close').on('click', function(){
				var popup = $(this).parent();
				popup.removeClass('open');
				setTimeout(function(){
					popup.remove();
				}, 400);
			}).html('<span class="ion-ios-close-empty"></span>');

			// Append video
			popupVideo.append( $(document.createElement("iframe")).attr({
				'src': $(this).attr('data-video-module') + "?autoplay=1",
				'allowfullscreen': 'true',
				'frameborder': '0'
			}) );

			// Append popup
			$(document.body).append( popup.append( popupClose ).append( popupVideo ) );

			// Activate popup
			setTimeout(function(){
				popup.addClass('open');
			}, 30);
		});
	};


	/* # Portfolio */

	function handlePortfolio() {
		// Filter
		$('[data-norebro-portfolio-grid]').each(function(){
			var isotopeGrid = $(this).find('[data-isotope-grid]');
			var filterbar = $(this).find('[data-filter="portfolio"]');

			if( isotopeGrid.isotope ){
				isotopeGrid.isotope({
					percentPosition: true,
					masonry: {
						columnWidth: '.grid-item'
					}
				});
			}

			// Generate category numbers
			filterbar.find('a').each(function(){
				var category = $(this).attr('data-isotope-filter');

				var number = ( category == '*' ) ? isotopeGrid.find('> div').length : isotopeGrid.find(category).length;

				if( number < 10 ){
					number = '0' + number;
				}

				$(this).find('.num').html( number );
			});

			filterbar.find('a').on('click', function(){
				filterbar.find('.active').removeClass('active');
				$(this).addClass('active');

				if( isotopeGrid.isotope ){
					isotopeGrid.isotope({
						filter: $(this).attr('data-isotope-filter')
					});
				}

				setTimeout(function(){
					if( window.AOS ) {
						AOS.refresh();
					}
					if( window.vc_waypoints ){
						window.vc_waypoints();
					}
				}, 600);

				return false;
			});

			if( window.location.hash ) {
				filterbar.find('a[href="' + window.location.hash + '"]').trigger('click');
			}
		});

		// Portfolio fullscreen toggle

		var toggleContent = $('.portfolio-page.fullscreen .portfolio-content');
		if( toggleContent.length ){
			var btn = toggleContent.find('.toggle-btn'),
				icon = btn.find('i'),
				titleContent = toggleContent.find('.title-content'),
				hiddenContent = toggleContent.find('.hidden-content');

			var iconClosed = btn.attr('data-closed'), iconOpened = btn.attr('data-opened');
			var opened = true;

			var toggle = function(){
				if( opened ){
					opened = false;
					icon.removeClass( iconOpened ).addClass( iconClosed );

					titleContent.removeClass('hidden');
					hiddenContent.addClass('hidden');

					toggleContent.addClass('closed');
				} else {
					opened = true;
					icon.removeClass( iconClosed ).addClass( iconOpened );

					titleContent.addClass('hidden');
					hiddenContent.removeClass('hidden');

					toggleContent.removeClass('closed');
				}
			};

			btn.on('click', function(e){
				var oldSize = {}, newSize = {};

				toggleContent.addClass('no-transition');
				toggleContent.css({ 'width': '', 'height': '' });

				setTimeout(function(){
					oldSize = {
						'width': (toggleContent.outerWidth() + 1) + 'px',
						'height': toggleContent.outerHeight() + 'px',
					};

					toggle();

					newSize = {
						'width': (toggleContent.outerWidth() + 1) + 'px',
						'height': toggleContent.outerHeight() + 'px',
					};

					toggle();

					toggleContent.css( oldSize );

					setTimeout(function(){
						toggleContent.removeClass('no-transition');
						toggle();
						toggleContent.css( newSize );
					}, 40);

				}, 40);

			});
		}

		// Header title 100% show animation
		$('.portfolio-page.header-full, .portfolio-page.portfolio-header-title').addClass('show');
	}

	/* ## Portfolio gallery */

	function handlePortfolioGallery(){
		$('[data-portfolio-popup]').each(function(){
			if( $(this).attr('data-used') ) {
				return true;
			} else {
				$(this).attr('data-used', 'true');
			}

			var gallery = $('#' + $(this).attr('data-portfolio-popup'));
			var slider = gallery.find('.slider');
			var images = gallery.find('.slider div');
			var numberImages = images.length;
			var offsetItem = $(this).offset().top;
			var windowHeight = $(window).height();
			var scrollOffset = offsetItem - (windowHeight / 2) + ($(this).height() / 2);

			if( numberImages > 1) {

				slider.owlCarousel({
					items: 1,
					nav: false,
					navRewind: true,
					navText: [ '<span class="ion-ios-arrow-thin-left"></span>', '<span class="ion-ios-arrow-thin-right"></span>' ],
					navSpeed: 350,
					dotsSpeed: 500,
					dots: (images.length == 1) ? false : true,
					loop: true,
					autoHeight: false,
					mouseDrag: (images.length == 1) ? false : true,
					autoplay: slider.attr('data-autoplay'),
					autoplayTimeout: parseFloat( slider.attr('data-autoplay') ) * 1000,
					autoplayHoverPause: false
				});


				slider.find('.owl-stage-outer').addClass('no-transition');
				slider.find('.slider, .norebro-slider').trigger('refresh.owl.carousel');

				setTimeout(function(){
					slider.trigger('refresh.owl.carousel');

					setTimeout(function(){
						slider.find('.owl-stage-outer').removeClass('no-transition');
					}, 10);
				}, 10);


				if ( slider.hasClass('mousewheel-true') ) {
					var mouseUpEnabled = true;
					var mouseDownEnabled = true;

					slider.on('changed.owl.carousel', function(e){
						setTimeout(function(){
							if( e.item.index == 0 ){
								mouseUpEnabled = true;
							} else {
								mouseUpEnabled = false;
							}
							if( e.item.index + e.page.size == e.item.count * 3 ) {
								mouseDownEnabled = true;
							} else {
								mouseDownEnabled = false;
							}
						}, 300);
					});


					if (slider.hasClass('mousewheel-true')) {
						var test = true;

						slider.on('wheel mousewheel', '.owl-stage', function(e) {
							var y = e.originalEvent.deltaY;

							if ( test && ( (y > 0 && !mouseDownEnabled) || (y < 0 && !mouseUpEnabled) ) ) {
								$('html, body').animate({
									scrollTop: slider.offset().top - ( $(window).height() - slider.outerHeight() ) / 2
								}, 400);
								slider.trigger( (( y > 0 ) ? 'next.owl' : 'prev.owl'), 350 );
								test = false;
								setTimeout(function(){
									test = true;
								}, 350 );
							}

							if( (y > 0 && !mouseDownEnabled) || (y < 0 && !mouseUpEnabled) ) {
								e.preventDefault();
								return false;
							}
						});
					}
				}

				slider.trigger('stop.owl.autoplay');

			}


			var close = function(){
				gallery.removeClass('open');
				$("html").removeClass('scroll-hidden');
				//$("#page").show();
				//$("html").scrollTop(scrollOffset);
			};

			gallery.find('.gallery-close').on('click', close);
			$(window).on('keydown', function(e){
				var key = e.which || e.keyChar || e.keyCode;
				if( key == 27 ){
					close();
				}
				if( key == 37 ){
					slider.trigger( 'prev.owl.carousel');
				}
				if( key == 39 ){
					slider.trigger('next.owl.carousel');
				}
			});
		});

		$('body').on('click', '[data-portfolio-popup]', function(e){
			e.preventDefault();
			var gallery = $('#' + $(this).attr('data-portfolio-popup'));
			gallery.addClass('open');
			$("html").addClass('scroll-hidden');

			if ( $(window).width() <= 768 ) {
				//$("#page").hide();
			}


			var autoplay = gallery.find('.slider').attr('data-autoplay');

			if( autoplay ){
				gallery.find('.slider').trigger('play.owl.autoplay');
			}
			return false;
		});
	}

	/* ## Scroll content */
	function handleScrollContent(){
		$('[data-norebro-content-scroll]').each(function(){
			var content = $(this),
				parent = $( $(this).attr('data-norebro-content-scroll') ),
				timeout = null, startTop = 0,
				contentLeft = 0,
				minWidth = 768,
				header = $('#masthead.fixed'),
				subheader = $('.subheader'),
				wpadminbar = $('#wpadminbar');

			var refresh = function(){
				var scrollTop = $(window).scrollTop();

				if( header.length ){
					scrollTop += header.outerHeight();

					if( subheader.length ){
						scrollTop += subheader.outerHeight();
					}
				}

				if( $('#wpadminbar').length ){
					scrollTop += $('#wpadminbar').outerHeight();
				}

				if( $(window).width() >= minWidth && content.outerHeight() < parent.outerHeight() ){
					// scroll start
					if( scrollTop > startTop ){
						var headerTop = 0;
						if( header.length ){
							headerTop += header.outerHeight();

							if( subheader.length ){
								headerTop += subheader.outerHeight();
							}
						}
						if( $('#wpadminbar').length ){
							headerTop += $('#wpadminbar').outerHeight();
						}
						content.css({
							'max-width': (content.outerWidth()) + 'px',
							'position': 'fixed',
							'top': headerTop + 'px',
							'left': contentLeft + 'px'
						});
					} else {
						content.css({
							'max-width': 'none',
							'position': 'relative',
							'top': '0px',
							'left': '0px'
						});
					}
					// scroll end
					if( scrollTop + content.outerHeight() > parent.offset().top + parent.outerHeight() ){
						var top = parent.outerHeight() - content.outerHeight();

						content.css({
							'max-width': 'none',
							'position': 'relative',
							'top': (top) + 'px',
							'left': '0' + 'px'
						});
					}
				} else {
					content.css({
						'max-width': 'none',
						'position': 'relative',
						'top': '0px',
						'left': '0px'
					});
				}
			};

			var resize = function(){
				content.css( 'position', 'static' );

				contentLeft = content.offset().left;
				startTop = content.offset().top;

				clearTimeout( timeout );
				timeout = setTimeout(function(){
					content.css({
						'position': 'absolute',
						'top': (content.offset().top - parent.offset().top) + 'px',
						'left': (content.offset().left - parent.offset().left) + 'px'
					});
					refresh();
				}, 30);
			};

			setTimeout( function(){ resize(); }, 100);
			$(window).on('scroll', refresh ).on( 'resize', resize );
		});
	}

	/* # Lazy load */

	function lazyLoad( elem ){
		if ( elem.data( 'lazy-load-loading' ) ) {
			return;
		}

		elem.data( 'lazy-load-loading', 'true' ).addClass( 'active' );

		let currentPage = elem.data( 'lazy-page' ) ? parseInt( elem.data( 'lazy-page' ) ) : 1;
		currentPage += 1;

		elem.data( 'lazy-page', currentPage );

		let urlPattern = elem.data( 'lazy-load-url-pattern' );
		if (urlPattern) {
			urlPattern = urlPattern.replace( '{{page}}', currentPage );
		} else {
			urlPattern = 'page/' + currentPage;
		}

		let scopeSlug = elem.data('lazy-load-scope');

		// Get page content
		$.ajax({
			url: urlPattern,
			success: function( content ) {
				var dom = $( new DOMParser().parseFromString( content, 'text/html' ) ),
					items = dom.find('[data-lazy-item][data-lazy-scope="' + scopeSlug + '"]');

				var container = elem.parent().find('[data-lazy-container="' + scopeSlug + '"]');
				if( container.length == 0 ) {
					container = $('[data-lazy-container="' + scopeSlug + '"]')
				}
				items.parent().find('[data-aos]').attr('data-aos-offset', '20000000');
				items.addClass('hidden');

				container.append( items );
				$(document.body).append( dom.find('[data-lazy-to-footer]') );

				// Check images is loaded
				var metroImages = [];
				items.find('[data-norebro-bg-image]').each(function(){
					var img = document.createElement('img');
					img.src = $(this).attr('data-norebro-bg-image');
					metroImages.push( img );
				});
				var checkImages = function(){
					var result = true, result2 = true;

					items.find('img').each(function(){
						if( !this.complete ){
							result = false;
							$(this).on( 'load', checkImages );
							return false;
						}
					});

					if ( result ) {
						for( var i = 0; i < metroImages.length; i++ ){
							if( !metroImages[i].complete ){
								result2 = false;
								metroImages[i].onload = checkImages;
								return false;
							}
						}
					}

					if( result && result2 ){
						items.removeClass('hidden');
						handlePortfolioGallery();

						if( container.isotope && container.attr('data-isotope-grid') ){
							container.isotope()
								.isotope( 'appended', items )
								.isotope('layout');
						}

						if( container.hasClass('norebro-masonry') ){
							container.masonry( 'appended', items, false );
						}

						items.parent().find('[data-aos]').attr('data-aos-offset', '');

						if( window.AOS ){
							// For mobile phones
							AOS.init();
							AOS.refresh();
						}

						$('[data-norebro-bg-image]').each(function(){
							$(this).css('background-image', 'url(' + $(this).attr('data-norebro-bg-image') + ')' );
						});

						if( currentPage >= parseInt( elem.attr( 'data-lazy-pages-count' ) ) ){
							elem.remove();
						} else {
							// Wait height animation
							elem.removeClass('active');
							if( elem.attr('data-lazy-load') == 'scroll' ) {
								setTimeout(function(){
									elem.removeData( 'lazy-load-loading' );
									handleLazyLoadScroll();
								}, 500);
							} else {
								elem.removeData( 'lazy-load-loading' );
							}
						}

					}
				};
				checkImages();
			}
		});
	}

	function handleLazyLoadScroll(){
		$('[data-lazy-load="scroll"]').each(function(){
			if( $(document).scrollTop() + $(window).height() > $(this).offset().top ){
				lazyLoad( $(this) );
			}
		});
	}
	function handleLazyLoadClick(){
		$('[data-lazy-load="click"]').on('click', function(){
			lazyLoad( $(this) );
		});
	}

	/* # Other */

	function handleSelect(){
		$('[data-select]').each(function(){
			var select = $(this).find('select'),
				menu = $(this).find('.select-menu'),
				title = $(this).find('.select-title span')

			if( select.length ){
				select.find('option').each(function(){
					var href = $(this).attr('data-select-href');
					menu.append(
						'<li><a' + ((href) ? ' href="' + href + '"' : '') + ' data-value="' + this.value + '">' + this.innerHTML + '</a></li>'
					);
				});
				$(this).find('ul a').on('click', function(){
					select[0].value = $(this).attr('data-value');
					title.html( $(this).html() );
				});

				var selected = select.find('option[selected]');
				var title = $(this).find('.select-title span');
				if( selected.length ){
					title.html( selected.html() );
				} else {
					title.html( select.find('option').eq(0).html() );
				}
			}
		});
	}
	function handleSelectClick(e){
		var link = $(e.target).closest('.select');

		$('[data-select]').each(function(){
			if( link.length > 0 && link[0] == this && !$(this).hasClass('active') ){
				$(this).addClass('active').css('z-index', '49');

				var menu = $(this).find('.select-menu');
				menu.css('left', '');

				// Align
				var difference = $(window).width() - (menu.offset().left + menu.outerWidth());
				if( difference < 0 ){
					menu.css('left', difference + 'px');
				}
			} else {
				$(this).removeClass('active').css('z-index', '');
			}
		});
	};

	function handleAOS(){
		if ( typeof(AOS) != 'undefined' ) {
			setTimeout(function(){
				AOS.init({
					disable: 'mobile',
				});
			}, 600);
		}
	}

	function handleStretchContent(){
		$('[data-vc-stretch-content="true"], [data-vc-full-width="true"], [data-norebro-stretch-content="true"], .alignfull').each(function(){
			$(this).css('left', '0');

			if ( !$(this).parents('.with-right-sidebar').length || !$(this).parents('.with-right-sidebar').length ) {
				$(this).css({
					'width': $('#page').width() + 'px',
					'left': ($('#page').offset().left - $(this).offset().left) + 'px'
				});
			}
		});

		$('[data-vc-full-width="true"]').not('[data-vc-stretch-content="true"]').each(function(){
			var padding = ($('#page').outerWidth() - $(this).closest('.page-container').outerWidth()) / 2;

			$(this).css({
				'padding-left': padding + 'px',
				'padding-right': padding + 'px',
			});
		});

		$('.rev_slider_wrapper.fullwidthbanner-container, .rev_slider_wrapper.fullscreen-container').each(function(){
			$(this).css('padding-left', $('#page').offset().left + 'px');
		});

		setTimeout(function(){
			var revSliders = $('.rev_slider');
			if( revSliders.revredraw ){
				revSliders.revredraw();
			}
		}, 30);
	}

	window.norebroRowRefresh = handleStretchContent;

	function handleScrollEffects(){
		$('[data-norebro-scroll-anim]').each(function(){
			var anim = $(this).attr('data-norebro-scroll-anim');

			if( $(this).offset().top < ($(window).scrollTop() + $(window).height() - 50) ){
				$(this).removeClass( anim ).removeAttr('data-norebro-scroll-anim');
			}
			else if ($(this).parents('.onepage-section.active').length) {
				$(this).removeClass( anim ).removeAttr('data-norebro-scroll-anim');
			}
		});
	}

	function handleNorebroHeight(){
		var windowHeight = $(window).height();
		var footerHeight = $('.site-footer').outerHeight();
		var headerCapHeight = ( $('.header-cap').length ) ? $('.header-cap').outerHeight() : 0;
		var wpAdminHeight = ( $('#wpadminbar').length ) ? $('#wpadminbar').outerHeight() : 0;
		var headerTitleHeight = ( $('.header-title').length ) ? $('.header-title').outerHeight() : 0;

		$('[data-norebro-full-height]').each(function(){
			var height = windowHeight - footerHeight - headerCapHeight - wpAdminHeight - headerTitleHeight;

			$(this).css('height', (height) + 'px');
		});
	}

	function handleAlignContentInStretchRow(){
		var containerWidth = $('#content').outerWidth();
		// var containerOffset = $('#content').offset().left;
		var halfContainer = containerWidth/2 - $('#content .page-container').width()/2;

		// Align content column in wrapper container
		var align = function( self, isSplitbox, isParallax, isRight ){
			var column = self.find( '> .wpb_column > .vc_column-inner, .woo-single-summary-wrap' );

			if( isSplitbox ){
				column = self.find( '> .split-box-wrap' );
			}

			if( isParallax ){
				column = self.find( '> .parallax-content' );
			}
			column = ( isRight ) ? column.last() : column.eq(0);

			if( !Nor.isMobile ){
				column.css( 'padding-' + ( isRight ? 'right' : 'left' ), ( halfContainer ) + 'px' );
			} else {
				column.css({
					'padding-left': '25px !important',
					'padding-right': '25px !important'
				});
			}
		};

		// Stretch column
		var stretch = function( self, isSplitbox, isRight ){
			var column = self.find( isSplitbox ? '> .split-box-wrap' : '> .wpb_column > .vc_column-inner > .wpb_wrapper' );
			column = ( isRight ) ? column.last() : column.eq(0);
			column.css({ 'position': '', 'left': '', 'width': '' });

			if( column.length ){
				if( isRight ){
					column.css( 'width', (containerWidth - column.offset().left ) + 'px');
				} else {
					column.css({
						'position': 'relative',
						'left': -( column.offset().left) + 'px',
						'width': ( column.offset().left + column.outerWidth() ) + 'px'
					});
				}
				if( Nor.isMobile ){
					column.css({
						'width': '',
						'left': ''
					});
				}
			}
		};


		$('.norebro-content-wrap-left').each(function(){
			align( $(this), $(this).hasClass('split-box'), $(this).hasClass('parallax'), false );
		});
		$('.norebro-content-wrap-right').each(function(){
			align( $(this), $(this).hasClass('split-box'), $(this).hasClass('parallax'), true );
		});

		$('.norebro-stretch-column-left').each(function(){
			stretch( $(this), $(this).hasClass('split-box'), false );
		});
		$('.norebro-stretch-column-right').each(function(){
			stretch( $(this), $(this).hasClass('split-box'), true );
		});
	}

	function registrationFormTabRefresh() {
		var loginForm = $('.myaccount-login-form');
		var registrationbBtn = loginForm.find('.woocommerce-Button[name="register"]');
		var url = window.location.href;
		
		if (url.lastIndexOf('#registration-tab') != -1) {
			var items = loginForm.find('.items .item');
			items.removeClass('active');

			items.each(function(){
				if ( $(this).attr('data-title') == 'Registration' ) {
					$(this).addClass('active');
				} else {
					$(this).removeClass('active');
				}
			});

			var btnWrap = loginForm.find('.buttons-wrap');
			var line = loginForm.find('.line');
			line.css({'transform': 'translateX(' + btnWrap.width() / 2 + 'px)'});
			document.location.hash = '';
		} else {
			registrationbBtn.on('click', function(){
				window.location.hash = '#registration-tab';
			});	
		}
	}

	window.norebroRefreshFrontEnd = function(){
		handleAccordionBox();
		handleBannerBox();
		handleBannerBoxSize();
		handleClientsLogo();
		handleChartBox();
		handleCounterBox();
		handleCountdownBox();
		handleContactForm();
		handleCoverBox();
		handleCoverBoxSize();
		handleGallery();
		handleSocialBar();
		handleSplitboxParallax();
		handleProgressBar();
		handleProgressBarSize();
		initParallax();
		handleParallax();
		handlePriceTable();
		handleOnepage();
		handleOnepageSize();
		handleTabBox();
		registrationFormTabRefresh();
		handleVideoBackground();
		handleVideoPopup();
		if( $.fn.multiscroll ) {
			handleSplitScreens();
		}
		handleScrollEffects();
		handleSliders();
		if( Nor.headerIsFifth ){
			handleHeaderFifth();	
		}
	};

	$(window).on('load', function(){

		Nor.init();
		handleNorebroHeight();

		// Navigation
		handleNavigations();
		// Header
		handleHeaders();
		showHeaderTitle();
		handleHeaderTitle();

		handleStretchContent();
		handleAlignContentInStretchRow();

		// Shortcodes
		handleAccordionBox();
		handleBannerBox();
		handleBannerBoxSize();
		handleClientsLogo();
		handleChartBox();
		handleCounterBox();
		handleCountdownBox();
		handleContactForm();
		handleCoverBox();
		handleCoverBoxSize();
		handleGallery();
		handleSocialBar();
		handleSplitboxParallax();
		handleProgressBar();
		handleProgressBarSize();
		initParallax();
		handleParallax();
		handlePriceTable();
		handleOnepage();
		handleOnepageSize();
		handleTabBox();
		registrationFormTabRefresh();
		handleVideoBackground();
		handleVideoPopup();
		if( $.fn.multiscroll ) {
			handleSplitScreens();
		}
		// Portfolio
		handlePortfolio();
		handlePortfolioGallery();

		if ( !Nor.isMobile ) {
			handleScrollContent();
		}
		

		handleScrollEffects();

		handleSelect();

		handleSliders();

		handleLazyLoadClick();

		handleLazyLoadScroll();

		// Footer
		handleFooter();
		handleFooterSize();

        // ## Shop products filter

        $('.woocommerce-ordering li a').on('click', function (event) {
            if ($(this).closest('form').length > 0) {
                $(this).closest('form').find('select').val($(this).attr('data-value')).on('change');
            } else {
                window.location.href = $(this).attr('rel');
            }
        });


		// Scroll top button
		$('.scroll-top').on('click', function(){
			$('html, body').animate({ scrollTop: 0 }, 500);
			return false;
		});

		// Tooltips
		$('.tooltip').each( function(){
			if( $(this).find('.tooltip-top, .tooltip-bottom').length ){
				var content = $(this).find('.tooltip-text');
				content.css('left', ($(this).outerWidth()/2 - content.outerWidth()/2) + 'px');
			}
		});

		// Message boxes
		$('body').on('click', '.message-box .close', function(){
			$(this).parent().slideUp({ duration: 300, queue: false }).fadeOut(300);
			var self = $(this);
			setTimeout(function(){
				self.remove();
			}, 350);
		});

		// Masonry && AOS
		if( $('.norebro-masonry').length ){
			setTimeout(function(){
				$('.norebro-masonry').each(function(){
					var columnWidth = '.grid-item';
					if( $(this).find('.grid-item').length == 0 ){
						columnWidth = '.masonry-block';
					}
					$(this).masonry({
						itemSelector: '.masonry-block',
						columnWidth: columnWidth,
						horizontalOrder: true,
						isAnimated: false,
						hiddenStyle: {
							opacity: 0,
							transform: ''
						}
					});
				});

				setTimeout(function(){
					handleAOS();
				}, 50);
			}, 50);
		} else {
			handleAOS();
		}

		// Norebro attrs
		$('[data-norebro-bg-image]').each(function(){
			$(this).css('background-image', 'url(' + $(this).attr('data-norebro-bg-image') + ')' );
		});

		// Blog share
		$('[data-blog-share]').each(function(){
			var socialLinks = $(this).find('.socialbar a');

			$(this).on('click', function(){
				if( socialLinks.eq(0).hasClass('active') ){
					socialLinks.each(function(i){
						var link = $(this);
						setTimeout( function(){
							link.removeClass('active');
						}, 50 * i );
					});
				} else {
					socialLinks.each(function(i){
						var link = $(this);
						setTimeout( function(){
							link.addClass('active');
						}, 50 * i );
					});
				}
			});
		});

		// Fixed google maps equal height in percent
		$('.wpb_wrapper').each(function(){
			var divs = $(this).find('> div');

			if( divs.length == 1 && divs.eq(0).hasClass('google-maps') ){
				$(this).css('height', '100%');
			}
		});


		$('div[data-dynamic-text="true"]').each( function() {
			var options = JSON.parse( $(this).attr('data-dynamic-text-options') );
			var typed = new Typed( '#' + $(this).attr('id') + ' .dynamic', options );
		});

		if ( jQuery('body').hasClass('norebro-anchor-onepage') ) {
			jQuery('body').on( 'click', 'a[href^="#"]', function( event ) {
				if( !$(this).parent().attr('data-menuanchor') ){
					event.preventDefault();
					var href = jQuery.attr(this, 'href');
					if ( jQuery( href ).length ) {
						jQuery('html, body').animate({
							scrollTop: ( jQuery( href ).offset().top )
						}, 500, function (){
							window.location.hash = href;
						});
					}
					// die, die, die
					return false;
				}
			});

			if ( window.location.hash.substring(0, 1) == '#' ) {
				if( jQuery( window.location.hash ).length ){
					jQuery('html, body').animate({
						scrollTop: ( jQuery( window.location.hash ).offset().top )
					}, 500);
				}
			}
		}

		// Refresh composter waypoints after magic
		if( window.vc_waypoints ){
			setTimeout(function(){
				window.vc_waypoints();
			}, 600);
		}

		// Mobile share button
		$('.mobile-social').on('click', function(e){
			e.stopPropagation();

			if( $(this).hasClass('active') ){
				$(this).find('.social').css('height', '0px');
				$(this).removeClass('active');
			} else {
				var social = $(this).find('.social');
				var self = $(this);

				social.css('height', '');

				social.addClass('no-transition');

				$(this).addClass('active');
				var height = social.outerHeight();
				$(this).removeClass('active');

				setTimeout(function(){
					social.css('height', height + 'px');
					social.removeClass('no-transition');
					self.addClass('active');
				}, 50);

			}
		});
		$('body').on('click', function(){
			$('.mobile-social .social').css('height', '0px');
			$('.mobile-social').removeClass('active');
		});

		$(window).on( 'scroll', function(){

			var handleAnim = function(){
				handleMobileHeader();
				handleFixedHeader();
				handleHeaderTitle();

				handleBarScroll();
				handleChartBox();
				handleCounterBox();
				handleProgressBar();
				handleParallax();

				handleScrollEffects();

				handleLazyLoadScroll();
			};

			if( window.requestAnimationFrame ) {
				window.requestAnimationFrame(function(){
					handleAnim();
				});
			} else {
				handleAnim();
			}


			// Scroll top button
			if ( $(window).scrollTop() > 800 ) {
				$('#page-scroll-top, #purchase-link').fadeIn(600);
			} else {
				$('#page-scroll-top, #purchase-link').fadeOut(600);
			}
		});


		$(window).on('click', function(e){
			handleSelectClick(e);
		});

		$(window).on( 'resize', function(){
			Nor.resize();

			handleNorebroHeight();
			handleHeaderSize();
			handleHeaderTitle();

			handleFooterSize();

			handleStretchContent();
			handleAlignContentInStretchRow();

			handleOnepageSize();
			handleAccordionBoxSize();
			handleBannerBoxSize();
			handleClientsLogo();
			handleCounterBox();
			handleCoverBoxSize();
			handleParallax();
			handleProgressBarSize();
			handlePriceTable();
			handleTabBoxSize();
			registrationFormTabRefresh();
			handleProgressBar();

			handleScrollEffects();

			handleLazyLoadScroll();

			if( Nor.headerIsFifth ){
				handleHeaderFifth();	
			}


			if( window.AOS ){
				setTimeout(function(){ AOS.refresh(); }, 10);
				// Isotope animation
				setTimeout(function(){
					AOS.refresh();

					if( window.vc_waypoints ){
						window.vc_waypoints();
					}
				}, 600);
			}
		});

		$('#page-preloader').addClass( 'closed' );

	});

	//Back arrow in Sub-Menu
	$(function(){
		var subMenu = $('ul.sub-menu');
		var closeBtn = $('.close > i')


		function checkForChanges()
		{
			if (subMenu.hasClass('active')){
				closeBtn.removeClass('ion-android-close');
				closeBtn.addClass('ion-ios-arrow-back');
			}
			else{
				closeBtn.removeClass('ion-ios-arrow-back');
				closeBtn.addClass('ion-android-close');
			}
			setTimeout(checkForChanges, 500);
		}

		checkForChanges();
	});

	//Toggle post
	$(function(){
		var toggle = $('.toggle .toggle-post');

		toggle.each(function(){
			var toggleWidth = toggle.width();
			var elWidth = toggleWidth - 230;

			toggle.find(".content").css("max-width", elWidth);
		});
	});

	$(document).on('click', '.woocommerce-ordering ul a', function () {
		$(this).closest('form').submit();
    })


})(jQuery);