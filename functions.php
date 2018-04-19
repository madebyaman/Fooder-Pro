<?php

/**
 * Fooder Pro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fooder_Pro
 */

if (!function_exists('fooder_setup')) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fooder_setup()
{
		/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Fooder Pro, use a find and replace
	 * to change 'fooder' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('fooder', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

		/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

		/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');
	add_image_size('fooder-front-image', 500, 600, true);
	add_image_size('fooder-social-proof', 300, 300, true);
	add_image_size('fooder-pinterest-single', 735, 9999, false);
	add_image_size('fooder-post-index', 500, 500, true);
	add_image_size('fooder-front-page-posts', 450, 300, true);
	add_image_size('fooder-social-proof', 300, 300, true);
	add_image_size('product-image', 400, 600, true);


		// This theme uses wp_nav_menu() in one location.
	register_nav_menus(array(
		'menu-1' => esc_html__('Header', 'fooder'),
	));
	register_nav_menus(array(
		'menu-2' => esc_html__('Footer', 'fooder'),
	));

		/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support('html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));

		// Set up the WordPress core custom background feature.
	add_theme_support('custom-background', apply_filters('fooder_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	)));

		// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support('custom-logo', array(
		'height' => 150,
		'width' => 200,
		'flex-width' => true,
		'flex-height' => true,
	));
}
endif;
add_action('after_setup_theme', 'fooder_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fooder_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('fooder_content_width', 640);
}
add_action('after_setup_theme', 'fooder_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fooder_widgets_init()
{
	register_sidebar(array(
		'name' => esc_html__('Social Icons', 'fooder'),
		'id' => 'social-icons',
		'description' => esc_html__('Add social icons here.', 'fooder'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	register_sidebar([
		'name' => esc_html__('Signup Form', 'fooder'),
		'id' => 'signup-form',
		'description' => esc_html__('Add signup form here', 'fooder'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	]);
}
add_action('widgets_init', 'fooder_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function fooder_scripts()
{
	// Enqueue Google fonts
	wp_enqueue_style('fooder-fonts', 'https://fonts.googleapis.com/css?family=Hind:300,400,600,700');

	wp_enqueue_script('font-aweosme', 'https://use.fontawesome.com/releases/v5.0.10/js/all.js', array(), '20180417', true);

	wp_enqueue_style('fooder-style', get_stylesheet_uri());

	wp_enqueue_script('fooder-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true);

	wp_localize_script('fooder-navigation', 'fooderScreenReaderText', array(
		'expand' => __('Expand child menu', 'fooder'),
		'collapse' => __('Collapse child menu', 'fooder')
	));

	wp_enqueue_script('fooder-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'fooder_scripts');

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function fooder_resource_hints($urls, $relation_type)
{
	if (wp_style_is('fooder-fonts', 'queue') && 'preconnect' === $relation_type) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter('wp_resource_hints', 'fooder_resource_hints', 10, 2);

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Customize read more link
 */

// Replaces the excerpt "Read More" text by a link
function fooder_excerpt_more($more)
{
	return '...';
}
add_filter('excerpt_more', 'fooder_excerpt_more');

function fooder_excerpt_length($length)
{
	return 60;
}
add_filter('excerpt_length', 'fooder_excerpt_length');

/**
 * Advanced Custom Fields
 */

define('ACF_LITE', true);

include_once('advanced-custom-fields/acf.php');

if (function_exists("register_field_group")) {
	register_field_group(array(
		'id' => 'acf_front-page-headlines',
		'title' => 'Front Page Headlines',
		'fields' => array(
			array(
				'key' => 'field_5ad76af79ec78',
				'label' => 'Headline',
				'name' => 'headline',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5ad72e60d34b4',
				'label' => 'Form Action',
				'name' => 'form_action',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5ad72ed4d34b5',
				'label' => 'Social Proof Image One',
				'name' => 'social_proof_image_one',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'fooder-social-proof',
				'library' => 'all',
			),
			array(
				'key' => 'field_5ad72f63d34b6',
				'label' => 'Social Proof Image Two',
				'name' => 'social_proof_image_two',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'fooder-social-proof',
				'library' => 'all',
			),
			array(
				'key' => 'field_5ad72f77d34b7',
				'label' => 'Social Proof Image Three',
				'name' => 'social_proof_image_three',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'fooder-social-proof',
				'library' => 'all',
			),
			array(
				'key' => 'field_5ad72f94d34b8',
				'label' => 'Product Headline',
				'name' => 'product_headline',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5ad72ff6d34b9',
				'label' => 'Product Description',
				'name' => 'product_description',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'html',
			),
			array(
				'key' => 'field_5ad7302cd34ba',
				'label' => 'Product Image',
				'name' => 'product_image',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'product-image',
				'library' => 'all',
			),
			array(
				'key' => 'field_5ad766f483368',
				'label' => 'Product URL',
				'name' => 'product_url',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5ad7670983369',
				'label' => 'Product Button Text',
				'name' => 'product_button_text',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_type',
					'operator' => '==',
					'value' => 'front_page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array(
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array(
				0 => 'permalink',
				1 => 'excerpt',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array(
		'id' => 'acf_product-page',
		'title' => 'Product Page',
		'fields' => array(
			array(
				'key' => 'field_5ad8453344822',
				'label' => 'Product Video URL',
				'name' => 'product_video_url',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5ad845d9a4341',
				'label' => 'Call to Action',
				'name' => 'call_to_action',
				'type' => 'wysiwyg',
				'required' => 1,
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array(
				'key' => 'field_5ad8466aa4342',
				'label' => 'Testimonial',
				'name' => 'testimonial',
				'type' => 'wysiwyg',
				'required' => 1,
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product_pages',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array(
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array(),
		),
		'menu_order' => 0,
	));
}
