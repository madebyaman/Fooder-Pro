<?php

/**
 * The template for displaying all single product pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Fooder_Pro
 */

get_header('minimal');
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
  while (have_posts()) :
    the_post();
  ?>

  <article id = "post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
    <div class="header-wrapper">
		<?php
  if (is_singular()) :
    the_title('<h1 class="entry-title">', '</h1>');
  else :
    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
  endif;
  ?>
  <div class="product-video">
  <?php the_field('product_video_url'); ?>
  </div>
  </div>
	</header><!-- .entry-header -->

	<div class="entry-content">
    <section class="product-description">
		<?php
  the_content(sprintf(
    wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
      __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'fooder'),
      array(
        'span' => array(
          'class' => array(),
        ),
      )
    ),
    get_the_title()
  ));
  ?>
  </section>
  <section class="call-to-action">
  <?php the_field('call_to_action'); ?>
  </section>
  <section class="product-testimonial">
  <?php the_field('testimonial'); ?>
  </section>

  </div><!-- .entry-content -->
  
</article><!-- #post-<?php the_ID(); ?> -->

  <?php 
  endwhile; // End of the loop.
  ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer('minimal');
