<?php

/**
 * Front Page Template
 *
 * @package Fooder_Pro
 */
get_header();
?>
  <div id="primary" class="content-area">
		<main id="main" class="site-main">
    <?php
    if (have_posts()) :
      while (have_posts()) :
      the_post();
    ?>
        <article id="front-page post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section class="front-page-hero">
        <div class="front-page-wrapper">
        <h1 class="entry-title"><?php the_field('headline'); ?></h1>
        <?php the_content(sprintf(
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
        )); ?>
        <div class="signup-form">
        <form action="<?php the_field('form_action'); ?>" method="post">
          <input type="email" id="user_email" placeholder="Enter your email address">
          <button type="submit">Signup</button>
        </form>
        </div>
        </div>
        <figure><?php the_post_thumbnail('fooder-front-image'); ?></figure>
        </section>
        <section class="featured-images">
          <img src="<?php the_field('social_proof_image_one'); ?>" />
          <img src="<?php the_field('social_proof_image_two'); ?>" />
          <img src="<?php the_field('social_proof_image_three'); ?>" />
        </section>
      </article>
    </main>
  </div> <!-- .content-area -->
</div><!-- .site-content -->

<section class="featured-product">
  <div class="product-content-wrapper">
    <div class="product-content">
      <h2><?php the_field('product_headline'); ?></h2>
      <p><?php the_field('product_description'); ?></p>
      <a href="<?php the_field('product_url'); ?>"><?php the_field('product_button_text'); ?></a>
    </div>
    <img class="product-image" src="<?php the_field('product_image'); ?>" />
  </div>
</section>

<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <article id="front-page post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <section class="recent-posts">
          <h2>Recent Posts</h2>

          <div class="front-page-posts">

          <?php
          // Define our WP Query Parameters 
          $query_options = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
          );
          $the_query = new WP_Query($query_options);

          while ($the_query->have_posts()) : $the_query->the_post();
          ?>

          <article class="single-post">

          <figure class="featured-image"><?php the_post_thumbnail('fooder-front-page-posts'); ?></figure>

          <div class="meta-links"><?php fooder_entry_meta(); ?></div>  
           
          <?php the_title('<h3 class="front-page-post-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h3>'); ?>
          
          </article>
          
          <?php 
          endwhile;
          wp_reset_postdata();
          ?>
          </div>
        </section>


      <?php endwhile;
      else :
        get_template_part('template-parts/content', 'none');

      endif;
      ?>
    </main>
    </div>

<?php 
get_footer();  