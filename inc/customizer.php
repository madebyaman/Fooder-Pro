<?php

/**
 * Fooder Pro Theme Customizer
 *
 * @package Fooder_Pro
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fooder_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	/**
	 *  Custom customizer settings
	 */
	// Add theme action color
	$wp_customize->add_setting('theme_action_color', array(
		'default' => '#FB4686',
		'transport' => 'postMessage',
		'type' => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
	));

	// Add control for theme action color
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'theme_action_color',
			array(
				'label' => __('Select a theme action color', 'fooder'),
				'section' => 'colors',
				'settings' => 'theme_action_color',
			)
		)
	);

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial('blogname', array(
			'selector' => '.site-title a',
			'render_callback' => 'fooder_customize_partial_blogname',
		));
		$wp_customize->selective_refresh->add_partial('blogdescription', array(
			'selector' => '.site-description',
			'render_callback' => 'fooder_customize_partial_blogdescription',
		));
	}
}
add_action('customize_register', 'fooder_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function fooder_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function fooder_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fooder_customize_preview_js()
{
	wp_enqueue_script('fooder-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'fooder_customize_preview_js');

if (!function_exists('fooder_header_style')) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see fooder_custom_header_setup().
 */
function fooder_header_style()
{
	$header_text_color = get_header_textcolor();
	$theme_action_color = get_theme_mod('theme_action_color');

		/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if (get_theme_support('custom-header', 'default-text-color') != $header_text_color) {

			// If we get this far, we have custom styles. Let's do this.
		?>
			<style type="text/css">
			<?php
			// Has the text been hidden?
		if (!display_header_text()) :
		?>
				.site-title,
				.site-description {
					position: absolute;
					clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
		?>
				.site-title a,
				.site-description {
					color: #<?php echo esc_attr($header_text_color); ?>;
				}
			<?php endif; ?>
			</style>
			<?php

	}
	/*
	 * Do we have a custom action color?
	 */
	if ('#FB4686' != $theme_action_color) { ?>
		<style type="text/css">

		.front-page-wrapper button, .featured-product a, .product_page-template-default .call-to-action a, .footer-links form button, button:hover, button:focus, button:active, input[type = "button"]:hover, input[type = "button"]:focus, input[type = "button"]:active,	input[type = "reset"]:hover, input[type = "reset"]:focus, input[type = "reset"]:active, input[type = "submit"]:hover, input[type = "submit"]:focus, input[type = "submit"]:active, .reply a:hover, .reply a:focus, .reply a:active, .category-sticky::before {
			background-color: <?php echo esc_attr($theme_action_color); ?>;
		}
		blockquote, .category-sticky, .comments-title {
			border-color: <?php echo esc_attr($theme_action_color); ?>;
		}
		button, input[type = "button"], input[type = "reset"], input[type = "submit"], .reply a, .main-navigation li.current-menu-item {
			color: <?php echo esc_attr($theme_action_color); ?>;
			border-color: <?php echo esc_attr($theme_action_color); ?>;
		}
		a:hover, a:focus, a:active, .entry-content a:hover, .wp-caption a a:hover, .entry-content a:focus, .wp-caption a a:focus, .entry-content a:active, .wp-caption a a:active, .comment-content a:hover, .comment-content a:focus, .comment-content a:active, .comment-metadata a:hover, .comment-metadata a:focus, .comment-metadata a:active, .continue-reading a:hover, .continue-reading a:focus, .continue-reading a:active, .continue-reading a::after, .site-title a, .main-navigation a:focus, .main-navigation a:hover {
			color: <?php echo esc_attr($theme_action_color); ?>;
		}
		.entry-content a, .wp-caption a a, .comment-content a, .comment-metadata a, .continue-reading a {
			background: linear-gradient(#fff, #fff), linear-gradient(#fff, #fff), linear-gradient(<?php echo esc_attr($theme_action_color); ?>, <?php echo esc_attr($theme_action_color); ?>);
			background-repeat: no-repeat, no-repeat, repeat-x;
    	background-position: 0 95%, 100% 95%, 0 95%;
    	background-size: .05em 1px, .05em 1px, 1px 1px;
		}
		</style>
		<?php

}
}
endif;
 