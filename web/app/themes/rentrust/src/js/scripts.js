/*include /libs/jquery.core.js*/
/*include /libs/slick.js*/
/*include /libs/move.js*/


var Master = {
    onscroll : function(){
        cg_Move.scroll_slides();
    },
};


(function($) { 
	var Master = {
		onready : function(){

			//////////////// SCROLL ANIMATIONS ////////////////
			var scroll = window.requestAnimationFrame || function(callback){ window.setTimeout(callback, 1000/60)};
			var elementsToShow = document.querySelectorAll('.slide-up, .slide-up, .slide-right, .slide-left, .scale-up, .scale-down'); 
			function loop() {
				Array.prototype.forEach.call(elementsToShow, function(element){
					if (isElementInViewport(element)) {
						element.classList.add('anim-scroll');
					} else {
						element.classList.remove('anim-scroll');
					}
				});
				scroll(loop);
			}	
			loop();
			function isElementInViewport(el) {
				if (typeof jQuery === "function" && el instanceof jQuery) {
					el = el[0];
				}
				var rect = el.getBoundingClientRect();
				return (
					(rect.top <= 0&& rect.bottom >= 0)||(rect.bottom >= (window.innerHeight || document.documentElement.clientHeight) && rect.top <= (window.innerHeight || document.documentElement.clientHeight))||(rect.top >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight))
				);
			}


			/////////////////// SLIDER TESTIMONIALS ///////////////////
			(function($){
				var initializedPanels = {};
				var $firstPanel = $('.cbo-testimonials .content-panel.panel--active');
				if ($firstPanel.length) {
					$firstPanel.slick({
						arrows: true,
						dots: false,
						slidesToShow: 3,
						slidesToScroll: 1,
						infinite: false,
						autoplay: false,
						adaptiveHeight: true,
						responsive: [
							{ breakpoint: 1284, settings: { slidesToShow: 3 } },
							{ breakpoint: 1024, settings: { slidesToShow: 2 } },
							{ breakpoint: 767, settings: { slidesToShow: 1 } }
						]
					});
					initializedPanels[$firstPanel.attr('id')] = true;
				}

				$('.cbo-testimonials .filter-btn').on('click', function(e){
					e.preventDefault();
			
					var $btn = $(this);
					var tabId = $btn.data('tab');
					var $tabs = $btn.closest('.testimonials-tabs');
					var $panels = $tabs.find('.content-panel');

					$tabs.find('.filter-btn').removeClass('is-active').attr('aria-selected', 'false').attr('tabindex','-1');
					$btn.addClass('is-active').attr('aria-selected', 'true').attr('tabindex','0');

					$panels.removeClass('panel--active').hide();
					var $activePanel = $tabs.find('#panel-' + tabId);
					$activePanel.addClass('panel--active').show();

					if (!initializedPanels[$activePanel.attr('id')]) {
						$activePanel.slick({
							arrows: true,
							dots: false,
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: false,
							autoplay: false,
							adaptiveHeight: true,
							responsive: [
								{ breakpoint: 1284, settings: { slidesToShow: 3 } },
								{ breakpoint: 1024, settings: { slidesToShow: 2 } },
								{ breakpoint: 767, settings: { slidesToShow: 1 } }
							]
						});
						initializedPanels[$activePanel.attr('id')] = true;
					} else {
						setTimeout(function(){
							$activePanel.slick('setPosition');
						}, 50);
					}
				});
			})(jQuery);
			
			
			/////////////////// CTA BLOCKS EFFECT ///////////////////
			(function(){
				var cta = document.querySelector('.cbo-cta');
				if (!cta) return;

				var pics = cta.querySelectorAll('[data-scroll-picture]');
				if (!pics.length) return;

				var obs = ('IntersectionObserver' in window) ? new IntersectionObserver(function(entries){
					entries.forEach(function(e){ e.target.classList.toggle('is-active', e.isIntersecting); });
				}, { threshold: 0.1 }) : null;

				pics.forEach(function(p){ if (obs) obs.observe(p); else p.classList.add('is-active'); });

				window.addEventListener('scroll', function(){
					pics.forEach(function(p){
						if (!p.classList.contains('is-active')) return;
						var rect = p.getBoundingClientRect();
						var progress = 1 - Math.max(0, Math.min(1, rect.top / window.innerHeight));
						var dir = p.getAttribute('data-scroll-picture') === 'up' ? -40 : 40;
						p.style.transform = 'translateY(' + (progress * dir) + 'px)';
					});
				}, { passive: true });
			})();


			/////////////////// FOOTER TOGGLE ///////////////////
			$('footer .footer-col .footer-title').on('click', function(){
				$(this).closest('.footer-col').toggleClass('col--open');
			});


			/////////////////// ARTICLES FILTERS ///////////////////
			$('.cbo-filters .filters-menu').on('click', function(event){
				event.stopPropagation();
				$('.filters-list').toggleClass('list--open');
				$('.filters-menu').toggleClass('filters-menu-click');
			});

			$('.filters-inner a').filter(function(){
				return this.href === location.href;
			}).addClass('el--active');

			$(document).on('click', function(event) {
				if (!$(event.target).closest('.filters-inner').length) {
					$('.filters-list').removeClass('list--open');
					$('.filters-menu').removeClass('filters-menu-click');
				}
			});

			$('.filters-inner').on('click', function(event){
				event.stopPropagation();
			});


			/////////////////// SLIDER ARTICLES ///////////////////
			$('.cbo-relation .relation-list').slick({
				arrows: true,
				dots: false,
				slidesToShow: 4,
				slidesToScroll: 1,
				infinite: false,
				autoplay: false,
				autoplaySpeed: 3000,
				adaptiveHeight: true,
				responsive: [
					{
						breakpoint: 1284,
						settings: {
							dots: false,
							arrows: true,
							slidesToShow: 3,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 1024,
						settings: {
							dots: false,
							arrows: true,
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 767,
						settings: {
							dots: false,
							arrows: true,
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});


			/////////////////// SLIDER PROFILES ///////////////////
			$('.profiles-list').each(function(){
				var $slider = $(this);
				$slider.append($slider.html());
				$slider.slick({
					arrows: false,
					dots: false,
					infinite: true,
					slidesToShow: 12,
					slidesToScroll: 1,
					speed: 40000,
					autoplay: true,
					autoplaySpeed: 0,
					cssEase: 'linear',
					variableWidth: false,
					responsive: [
						{ breakpoint: 991, settings: { slidesToShow: 5 } },
						{ breakpoint: 767, settings: { slidesToShow: 4 } },
						{ breakpoint: 500, settings: { slidesToShow: 3 } }
					]
				});
			});
			

			/////////////////// SOCIAL SHARE ///////////////////
			var shareButton = document.getElementById('linkedin-share-button');
            if (shareButton) {
                shareButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    var pageUrl = window.location.href;
                    var pageTitle = document.title;
                    var linkedinUrl = 'https://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(pageUrl) + '&title=' + encodeURIComponent(pageTitle);
                    window.open(linkedinUrl, 'linkedin-share-dialog', 'width=800,height=600');
                    return false;
                });
            }
			

			
			///////////////////// SUMMARY ARTICLE ///////////////////
			var headers = document.querySelectorAll("h2, h3");
			var tocLists = document.getElementsByClassName("articlesummary-list");

			if (tocLists.length > 0) {
				var tocList = tocLists[0];
				headers.forEach(function(header, index) {
					if (header.closest(".cbo-relation")) {
						return; 
					}
					var id = "header-" + index;
					header.id = id;
					var li = document.createElement("li");
					var a = document.createElement("a");
					a.href = "#" + id;
					a.textContent = header.textContent;
					li.appendChild(a);
					tocList.appendChild(li);
				});
			}
			function toggleSommaireOnResize() {
				if (window.innerWidth > 1023) {
					$('.cbo-articlesummary').addClass('articlesummary--open');
					$('.cbo-articlesummary').off('click');
				} else {
					$('.cbo-articlesummary').removeClass('articlesummary--open');
					$('.cbo-articlesummary').off('click').on('click', function(e) {
						e.stopPropagation();
						$(this).toggleClass('articlesummary--open');
					});
				}
			}
			toggleSommaireOnResize();
			window.addEventListener('resize', toggleSommaireOnResize);
			
			// Smooth scroll sur le sommaire
			$('.articlesummary-list a[href^="#"]').on('click', function(e) {
				e.preventDefault();
				var target = $($(this).attr('href'));
				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top - 100
					}, 600);
				}
			});


			//////////////// FAQ SUMMARY ////////////////
			var summaryLinks = document.querySelectorAll('.summary-list a');
			for (var i = 0; i < summaryLinks.length; i++) {
				summaryLinks[i].addEventListener('click', function(e) {
					e.preventDefault();

					// Supprime la classe active sur tous les liens
					for (var j = 0; j < summaryLinks.length; j++) {
						summaryLinks[j].classList.remove('is-active');
					}

					// Ajoute la classe active sur celui cliqué
					this.classList.add('is-active');

					// Scroll vers la section
					var targetId = this.getAttribute('href');
					var target = document.querySelector(targetId);
					if (target) {
						target.scrollIntoView({
							behavior: 'smooth',
							block: 'start'
						});
					}
				});
			}


			//////////////// TABS GLOBALE / ACCESSIBILITY ////////////////
			var tabs = document.querySelectorAll('.cbo-tabs .tabs-filter .filter-list .filter-btn');
			var panes = document.querySelectorAll('.cbo-tabs .tabs-content .content-panel');

			if (tabs && tabs.length) {
				for (var i = 0; i < tabs.length; i++) {
					(function(tab){
					tab.addEventListener('click', function(e) {
						e.preventDefault();
						var targetId = tab.getAttribute('aria-controls') || tab.getAttribute('data-term') || null;
						if (targetId && tab.hasAttribute('data-term') && !document.getElementById(targetId)) {
							targetId = 'panel-' + tab.getAttribute('data-term');
						}
						if (!targetId) return;
						for (var j = 0; j < tabs.length; j++) {
							tabs[j].classList.remove('is-active');
							tabs[j].setAttribute('aria-selected', 'false');
							tabs[j].setAttribute('tabindex', '-1');
							if (tabs[j].parentElement) tabs[j].parentElement.classList.remove('panel--active');
						}
						for (var k = 0; k < panes.length; k++) {
							panes[k].classList.remove('panel--active');
						}

						tab.classList.add('is-active');
						tab.setAttribute('aria-selected', 'true');
						tab.setAttribute('tabindex', '0');
						if (tab.parentElement) tab.parentElement.classList.add('panel--active');

						var targetEl = document.getElementById(targetId);
						if (targetEl) {
						targetEl.classList.add('panel--active');
						}
					});
					})(tabs[i]);
				}
			}


			//////////////// ACCORDION ////////////////
			function initAccordion($container) {
				$container.find('.accordion-list .el-title, .accordionpicture-list .el-title').off('click').on('click', function(){
					var $btn = $(this);
					var $el = $btn.closest('.list-el');
					var $content = $('#' + $btn.attr('aria-controls'));
					var open = $btn.attr('aria-expanded') === 'true';
					var $section = $btn.closest('.cbo-accordionpicture');
					var $pictureContainer = $section.find('.accordionpicture-picture');
					var $img = $pictureContainer.find('img');

					// Fermer les autres
					$el.siblings('.list-el.el--open').each(function() {
						var $c = $(this).find('.el-content');
						$(this).removeClass('el--open').find('.el-title').attr('aria-expanded', 'false');
						$c.css('height', $c[0].scrollHeight + 'px');
						$c[0].offsetHeight;
						$c.css('height', '0');
						setTimeout(function(){ $c.attr('hidden', ''); }, 300);
					});

					// Toggle celui-ci
					if(open){
						$btn.attr('aria-expanded', 'false');
						$el.removeClass('el--open');
						$content.css('height', $content[0].scrollHeight + 'px');
						$content[0].offsetHeight;
						$content.css('height', '0');
						setTimeout(function(){ $content.attr('hidden', ''); }, 300);
					} else {
						$btn.attr('aria-expanded', 'true');
						$el.addClass('el--open');
						$content.removeAttr('hidden');
						var fullHeight = $content[0].scrollHeight + 'px';
						$content.css('height', '0');
						$content[0].offsetHeight;
						$content.css('height', fullHeight);
						setTimeout(function(){ $content.css('height', 'auto'); }, 300);

						var newSrcSmall  = $btn.data('picture-small');
						var newSrcMedium = $btn.data('picture-medium');
						var newSrcLarge  = $btn.data('picture-large');
						var newAlt       = $btn.data('alt');
						var newCover     = $btn.data('cover');

						if(newSrcMedium){
							$img.attr('src', newSrcMedium);
							$img.attr('srcset', newSrcSmall + ' 320w, ' + newSrcMedium + ' 768w, ' + newSrcLarge + ' 1024w');
							$img.attr('alt', newAlt);
							$pictureContainer.removeClass('cbo-picture-cover cbo-picture-contain').addClass('cbo-picture-' + newCover);
						}
					}
				});
			}

			$(document).ready(function(){
				initAccordion($('.panel-text'));
				initAccordion($('.cbo-accordion'));
				initAccordion($('.cbo-accordionpicture'));
			});


			//////////////// AJAX SEARCH ////////////////
			var $form = $('#search-form');
			var $input = $('#search-field');
			var $results = $('#faq-search-results');
			var $panels = $('.panel-text');
			var $accordions = $panels.find('.accordion-list, .text-content'); 
			var timer;

			// Empêche le submit du formulaire
			$form.on('submit', function(e) {
				e.preventDefault();
			});

			$input.on('input', function() {
				var query = $(this).val().trim();

				clearTimeout(timer);
				timer = setTimeout(function() {
					if (query.length === 0) {
						$results.hide().find('.accordion-list').empty();
						$accordions.show();
						return;
					}

					$accordions.hide();
					$results.show().find('.accordion-list').html('<p>Recherche en cours...</p>');

					$.ajax({
						url: faq_search.ajax_url,
						type: 'POST',
						data: {
							action: 'cbo_search_faq',
							query: query
						},
						success: function(response) {
							if (response.success) {
								$results.find('.accordion-list').html(response.data);
								initAccordion($results);
							} else {
								$results.find('.accordion-list').html('<p>Aucun résultat trouvé.</p>');
							}
						},
						error: function() {
							$results.find('.accordion-list').html('<p>Erreur lors de la recherche.</p>');
						}
					});

				}, 300);
			});


			/////////////////// ADD CHECK TO ACCEPTANCE ///////////////////
			var cbo_forms = {
				init: function () {
				this.bind_checked();
				this.check_checked();
				},
				
				bind_checked: function () {
				$(".cbo-form")
					.find('input[type="radio"], input[type="checkbox"]')
					.on("change", function () {
					cbo_forms.check_checked();
					});
				},
				
				check_checked: function () {
				$(".cbo-form")
					.find('input[type="radio"], input[type="checkbox"]')
					.each(function () {
					if ($(this).is(":checked")) {
						$(this).closest(".form-field").find(".field-inner").addClass("checked");
					} else {
						$(this).closest(".form-field").find(".field-inner").removeClass("checked");
					}
					});
				},
			};
			cbo_forms.init();
  

			/////////////////// CALCULATOR SECTION ///////////////////
			if ($('body .cbo-calculator, body .cbo-herocalculator .form-calcul').length > 0){
				var loyermens = document.getElementById('loyermens');
				var result = document.getElementsByClassName('form-results')[0];
				function updateCalc() {
					var loyer = parseFloat(loyermens.value.replace(',', '.'));
				
					if (isNaN(loyer) || loyer <= 0) {
						result.innerHTML = "";
						return;
					}

					var mensualite = loyer * 2;
					var economieAnnuelle = loyer * 12;
					result.innerHTML =
						'À partir de <strong>' + mensualite.toFixed(2) + '€</strong> par mois<br>' +
						'Économisez <strong>' + economieAnnuelle.toFixed(2) + '€</strong> par an';
				}
				loyermens.addEventListener('input', updateCalc);
			}


			//////////////// STICKY ////////////////
			$(window).scroll(function(){
				if($(window).scrollTop()>160){
					$("header").addClass('header-scroll');
				}else{
					$("header").removeClass('header-scroll');
				}
			})
			.scroll();


			/////////////////// SMARTPHONE NAVIGATION ///////////////////
			$('header .burger-menu').on('click', function(){
				$('.header-nav').toggleClass('nav--open');
				$('.burger-menu').toggleClass('burger-menu-cross');
				$('html').toggleClass('html--hidden');
			});


			///////////////////  SOUS-MENU ///////////////////
			$('header .menu-item-has-children').on('click', function (e) {
				e.stopPropagation();
				var parentLi = $(this);
				$('header .menu-item-has-children').not(parentLi).find('.sub-menu').removeClass('sub-menu_open');
				$('header .menu-item-has-children').not(parentLi).removeClass('active');
				parentLi.find('.sub-menu').toggleClass('sub-menu_open');
				parentLi.toggleClass('active');
			});


			/////////////////// Burger menu - Accessibilité ///////////////////
			var burger = document.querySelector('.burger-menu');
			var nav = document.querySelector('.header-nav');
			if (burger && nav) {
				burger.addEventListener('click', function () {
					var expanded = burger.getAttribute('aria-expanded') === 'true';
					burger.setAttribute('aria-expanded', !expanded);
					burger.classList.toggle('is-active');
					nav.classList.toggle('is-open');
				});
			}


			//////////////// LANGUAGE SWITCHER ////////////////
			$('header .languages-switcher').on('click', function(){
				$('.languages-switcher').toggleClass('active');
			});
			

			//////////////// PICTURE HERO PARALLAX ////////////////
			(function() {
				var images = Array.prototype.slice.call(document.querySelectorAll('.parallax-image'));
				if (!images.length) return;
			
				var lastScroll = window.pageYOffset || document.documentElement.scrollTop;
				var ticking = false;
				var speed = 0.2;

				function update() {
					var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

					images.forEach(function(img) {
						var container = img.parentElement;
						var containerTop = container.offsetTop;
						var containerHeight = container.offsetHeight;
						var relativeY = scrollTop - containerTop;
						var translateY = relativeY * speed;
						img.style.transform = 'translate(-0%, 0%) translateY(' + translateY + 'px)';
					});
			
					ticking = false;
				}

				function onScroll() {
					if (!ticking) {
						ticking = true;
						requestAnimationFrame(update);
					}
				}
				window.addEventListener('scroll', onScroll, { passive: true });
				window.addEventListener('resize', onScroll);
				update();
			})();

			
		},
			
		onload : function(){},
		onresize : function(){},
		onscroll : function(){},
	};
	$(document).ready( function(){
		Master.onready();
	});


	$(window).resize( function(){
		Master.onresize();
	});

	$(window).on('scroll', function(){
		Master.onscroll();
	});

})(jQuery);