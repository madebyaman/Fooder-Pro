/* global fooderScreenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

(function ($) {
	var masthead, menuToggle, siteNavContain, siteNavigation;

	function initMainNavigation(container) {


		container.find('.menu-item-has-children').click(function (e) {
			var _this = $(this);

			_this.toggleClass('toggled-on');
			_this.children('.sub-menu').toggleClass('toggled-on');

			_this.attr('aria-expanded', _this.attr('aria-expanded') === 'false' ? 'true' : 'false');
		});
	}

	initMainNavigation($('.main-navigation'));

	masthead = $('#masthead');
	menuToggle = masthead.find('.menu-toggle');
	siteNavContain = masthead.find('.main-navigation');
	siteNavigation = masthead.find('.main-navigation > div > ul');

	// Enable menuToggle.
	(function () {

		// Return early if menuToggle is missing.
		if (!menuToggle.length) {
			return;
		}

		// Add an initial value for the attribute.
		menuToggle.attr('aria-expanded', 'false');

		menuToggle.on('click.fooder', function () {
			siteNavContain.toggleClass('toggled-on');

			$(this).attr('aria-expanded', siteNavContain.hasClass('toggled-on'));
		});
	})();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	(function () {
		if (!siteNavigation.length || !siteNavigation.children().length) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ('none' === $('.menu-toggle').css('display')) {

				$(document.body).on('touchstart.fooder', function (e) {
					if (!$(e.target).closest('.main-navigation li').length) {
						$('.main-navigation li').removeClass('focus');
					}
				});

				siteNavigation.find('.menu-item-has-children > a, .page_item_has_children > a')
					.on('touchstart.fooder', function (e) {
						var el = $(this).parent('li');

						if (!el.hasClass('focus')) {
							e.preventDefault();
							el.toggleClass('focus');
							el.siblings('.focus').removeClass('focus');
						}
					});

			} else {
				siteNavigation.find('.menu-item-has-children > a, .page_item_has_children > a').unbind('touchstart.fooder');
			}
		}

		if ('ontouchstart' in window) {
			$(window).on('resize.fooder', toggleFocusClassTouchScreen);
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find('a').on('focus.fooder blur.fooder', function () {
			$(this).parents('.menu-item, .page_item').toggleClass('focus');
		});
	})();
})(jQuery);