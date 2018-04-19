<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fooder_Pro
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (has_post_thumbnail()) { ?>
			<figure class="featured-image archive-image">
				<?php the_post_thumbnail('fooder-pinterest-index'); ?>
			</figure>
			<?php 
	} ?>
	<div class="content-wrapper">
	<header class="entry-header">
		<?php
	if (is_singular()) :
		the_title('<h1 class="entry-title">', '</h1>');
	else :
		the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
	endif;

	if ('post' === get_post_type()) :
	?>
		<?php endif; ?>
		<div class="meta-links">
			<?php fooder_entry_meta(); ?>
		</div>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->

	<div class="continue-reading">
		<a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark">
			Continue Reading
		</a>
	</div><!-- .continue-reading -->
		</div> <!-- .content-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->

