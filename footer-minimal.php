<?php

/**
 * The template for displaying minimal footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fooder_Pro
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
				<div class="site-info">
					<ul>
						<li>&copy; <?php echo date('Y'); ?> <?php bloginfo('name') ?> </li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
				</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
