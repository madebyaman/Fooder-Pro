/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {

	// Site title and description.
	wp.customize('blogname', function (value) {
		value.bind(function (to) {
			$('.site-title a').text(to);
		});
	});
	wp.customize('blogdescription', function (value) {
		value.bind(function (to) {
			$('.site-description').text(to);
		});
	});

	// Header text color.
	wp.customize('header_textcolor', function (value) {
		value.bind(function (to) {
			if ('blank' === to) {
				$('.site-title, .site-description').css({
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				});
			} else {
				$('.site-title, .site-description').css({
					'clip': 'auto',
					'position': 'relative'
				});
				$('.site-title a, .site-description').css({
					'color': to
				});
			}
		});
	});

	// Customize theme action color
	wp.customize('theme_action_color', function (value) {
		value.bind(function (to) {
			$('.front-page-wrapper button, .featured-product a, .product_page-template-default .call-to-action a, .footer-links form button,button:hover, button:focus, button:active, input[type = "button"]: hover, input[type = "button"]: focus, input[type = "button"]: active,	input[type = "reset"]: hover,	input[type = "reset"]: focus, input[type = "reset"]: active, input[type = "submit"]: hover, input[type = "submit"]: focus, input[type = "submit"]: active, .reply a:hover, .reply a:focus, .reply a:active, .category-sticky::before ').css({
				'background': to
			});
			$('blockquote, .category-sticky, .comments-title').css({
				'border-color': to
			});
			$('button, input[type = "button"], input[type = "reset"], input[type = "submit"], .reply a, .main-navigation li.current-menu-item').css({
				'color': to,
				'border-color': to
			});
			$('a:hover, a:focus, a:active, .entry-content a:hover, .wp-caption a a:hover, .entry-content a:focus, .wp-caption a a:focus, .entry-content a:active, .wp-caption a a:active, .comment-content a:hover, .comment-content a:focus, .comment-content a:active, .comment-metadata a:hover, .comment-metadata a:focus, .comment-metadata a:active, .continue-reading a:hover, .continue-reading a:focus, .continue-reading a:active, .continue-reading a::after, .site-title a, .main-navigation a:focus, .main-navigation a:hover ').css({
				'color': to
			});
			$('.entry-content a, .wp-caption a a, .comment-content a, .comment-metadata a, .continue-reading a ').css({
				'background': 'linear-gradient(#fff, #fff), linear-gradient(#fff, #fff), linear-gradient(' + to + ',' + to ')',
				'background-repeat': 'no-repeat, no-repeat, repeat-x',
				'background-position': '0 95%, 100% 95%, 0 95%',
				'background-size': '.05em 1px, .05em 1px, 1px 1px',
			});
		});
	});
})(jQuery);