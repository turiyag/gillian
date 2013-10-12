 /* Custom Front-End jQuery scripts */
	
jQuery(document).ready(function($) {	
		
	/* Nav Menu */
	$('#masthead nav ul > li:has(.sub-menu)').hoverIntent(showMenu,hideMenu);
	
	function showMenu() {
		$(this).addClass('sub-hover');
		$(this).find('.sub-menu').stop(false,true).fadeIn(200);
	}
	
	function hideMenu() {
		$(this).removeClass('sub-hover');
		$(this).find('.sub-menu').fadeOut(200);
	}
	
	$('.sub-menu').each(function (index, element) {
		if ($(element).children().length === 1) {
			$(element).addClass('full-width');
		}
	});
	
	$('#masthead .main-menu .menu').css('visibility', 'visible');
	

	/* Sidebar in Mobile View */
	var sidebar = $('#pageslide');
	$('.main-menu').children().clone().removeAttr('id').appendTo($(sidebar));
	$('.secondary-menu, .sidebar').children().clone().removeAttr('id').appendTo($(sidebar));
	$(sidebar).children().nextUntil().wrap('<div class="block" />');

	

	/* FlexVerticalCenter Copyright 2011, Paul Sprangers http://paulsprangers.com */
	$.fn.flexVerticalCenter = function( onAttribute ) {
		return this.each(function(){
			var $this		= $(this);
			var attribute	= onAttribute || 'top';
			var resizer = function () {
				$this.css(
					attribute, ( ( $this.parent().height() - $this.height() ) / 2 )
				);
			};
			resizer();
			$(window).resize(resizer);
		});
	};

		
	/* Posts Slider */
	if ( $().flexslider ){
		
		$(window).load(function() {
			fixFlexsliderHeight();
		});
		
		$(window).resize(function() {
			fixFlexsliderHeight();
		});
		
		function fixFlexsliderHeight() {
			$('.flexslider').each(function(){
				var sliderHeight = 0;
				$(this).find('.slides > li').each(function(){
					var slideHeight = $(this).height();
					if (sliderHeight < slideHeight) {
						sliderHeight = slideHeight;
					}
				});
				$(this).find('.flex-viewport').css({'height' : sliderHeight});
			});
		}
		
		// Widget sliders
		$('.widget .flexslider').flexslider({
			useCSS: false,
			animation: 'slide',
			controlNav: false,
			smoothHeight: true,
			nextText: '<i class="icon-chevron-left"></i>',
			prevText: '<i class="icon-chevron-right"></i>'
		});
		
		// Home page & Category sliders
		$('.posts-slider').flexslider({
			useCSS: false,
			animation: 'slide',
			controlNav: false,
			smoothHeight: true,
			nextText: '<i class="icon-chevron-left"></i>',
			prevText: '<i class="icon-chevron-right"></i>',
			start: function(slider) {
				slider.removeClass('loading');
				$('.posts-slider .entry-header').flexVerticalCenter().fadeIn(900);
			}
		});
		
	}

	
	/* Post Format gallery carousel */
	if ($('#gallery-carousel')[0]) {

		$(window).resize(function(){

			var width = $(window).width();
			var gallery = $('#gallery-carousel .carousel');
			
			var align = false;
			if (width < 800){
				align = 'center';
			} else {
				align = false;
			}
			
			$(gallery).carouFredSel({
				width: '100%',
				height: 580,
				align: align,
				auto: false,
				scroll: {
					items : 1,
					easing: 'quadratic'
				},
				items: {
					visible: 1,
					width: 'variable'
				},
				prev: '#gallery-carousel .prev',
				next: '#gallery-carousel .next',
				swipe: {
					onMouse: true,
					onTouch: true
				},
				onCreate: function() {
					$('.carousel').css('positon','static');
				}
			});
			
			if (width < 720){
				$(gallery).trigger('destroy');
			}
			
		}).resize();
		
	}

	
	/* Related posts */
	if ($('.related-posts')[0]) {
		
		var carousel = $('.related-posts .carousel');
		var n = $(carousel).find('article').length;
		if (n > 2) {

			$(carousel).carouFredSel({
				responsive: true,
				scroll: 1,
				items: {
					height: '105%',
					start: 'random',
					visible: {
						min: 1,
						max: 3
					}
				},
				align: 'left',
				auto: false,
				prev: '.related-posts .prev',
				next: '.related-posts .next',
				swipe: {
					onTouch: true
				}
			});
					
		}
		
		if (n <= 2) {
			$('.related-posts .carousel-nav').hide();	
		}
		
	}

	
	/* Authors widget */
	if ($('.widget_ti_site_authors')[0]) {
		
		$(function(){
			
			var carousel = $('[class*="sidebar"] .widget_ti_site_authors .carousel');
			var n = $(carousel).find('li').length;
			if (n > 5) {
	
				$(carousel).after('<ul id="carouselX" />').next().html($(carousel).html());
				$(carousel).find('li:odd').remove();
				$("#carouselX li:even").remove();
			
				$("#carouselX").carouFredSel({
					width: '100%',
					auto: false
				});
			}
			
			$(carousel).carouFredSel({
				width: '100%',
				auto: false,
				scroll: 1,
				items: {
					start: 'random'
				},
				synchronise: '#carouselX',
				prev: '[class*="sidebar"] .widget_ti_site_authors .prev',
				next: '[class*="sidebar"] .widget_ti_site_authors .next'
			});
			
		});

		
		$(function(){
		
			var carousel = $('#pageslide .widget_ti_site_authors .carousel');
			var n = $(carousel).find('li').length;
			if (n > 5) {
		
				$(carousel).after('<ul id="carouselXX" />').next().html($(carousel).html());
				$(carousel).find('li:odd').remove();
				$("#carouselXX li:even").remove();
			
				$("#carouselXX").carouFredSel({
					width: '100%',
					auto: false
				});
			}
			
			$(carousel).carouFredSel({
				width: '100%',
				auto: false,
				scroll: 1,
				items: {
					start: 'random'
				},
				synchronise: "#carouselXX",
				prev: '#pageslide .widget_ti_site_authors .prev',
				next: '#pageslide .widget_ti_site_authors .next'
			});
		
		});

	}
	
	
	/* Animate search field width fallback */
	if ($('.no-csstransitions')[0]) {
		$('.top-strip input#s').focus(function() {
			$(this).animate({width: 300}, 400);
		});
		
		$('.top-strip input#s').blur(function() {
			$(this).animate({width: 100}, 400);
		});
	}
	
	
	/* Masonry Layout */
	if ( $().masonry ){

		var $container = $('.masonry-layout');
		var $imgs = $('.masonry-layout img');

		$imgs.load(function() {
			if ($container.hasClass('masonry')) {
				$container.masonry('reload');
			}
		});

		$(window).on('load resize', function(){
			var width = $(window).width();
			if (width > 800) {
				
				$container.imagesLoaded( function(){
					$container.masonry({
						itemSelector : 'article'
					}); 
				});
				
			} else {
				
				if ($container.hasClass('masonry')) {
					$container.masonry( 'destroy' );
				}
			}
	
		});

	}
	
	
	/* Gallery */
	if ( $().imgLiquid ){
		$('.gallery').find('.gallery-item').imgLiquid({
			fill:true
		});
	}
		
	
	/* Knob (post rating) */
	if ( $().knob ){
		$('.knob').knob({
			min: 0,
			max: 10,
			step: 1
		});
	}
		
	
	/* Review graph */
	if ($('.score-box')[0]) {

		$('.score-box').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
			if (isInView) {
				if (visiblePartY == 'top') {
				} else {
					$(this).addClass('inview');
				}
			}
		});
	
	}
	
	
	/* Show a smooth animation when images are loaded */
	$('.entry-image').on('inview', function(event, isInView) {
		if (isInView) {
			$(this).addClass('inview');
		}
	});
	
	
	/* Show bottom single post slide dock */
	if ($('.slide-dock')[0]) {
		
		var random_post = $('.slide-dock');
		$('#footer').on('inview', function(event, isInView) {
			if (isInView) {
				random_post.addClass('slide-dock-on');
			} else {
				random_post.removeClass('slide-dock-on');
			}
		});
		
		$('.close-dock').click(function(e){
			e.preventDefault();
			$('.slide-dock').toggleClass('slide-dock-on slide-dock-off');
		});
	
	}
		
	
	/* Color Box */
	if ( $().swipebox ){
		$('.gallery a').swipebox({
			useCSS: true,
			hideBarsDelay: 3000
		});
	}
		
	
	/* Fluid Width Video */
	if ( $().fitVids ){
		$('.video-wrapper').fitVids();
	}
	
	
	/* Back to Top link */
	$('.back-top').click(function(){
		$('html, body').animate({scrollTop:0}, 'fast');
		return false;
	});


});// - document ready