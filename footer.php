<?php

/**
 * The template for displaying the footer
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
		<div class="foot-wrap">
			<div class="footer-links">
			<?php if (is_active_sidebar('signup-form')) : ?>
			<div class="footer-signup">
					<?php dynamic_sidebar('signup-form'); ?>
			</div>
			<?php endif; ?>
			<?php if (is_active_sidebar('social-icons')) : ?>
			<div class="social-menu">
					<?php dynamic_sidebar('social-icons'); ?>
			</div>
			<?php endif; ?>
			</div>
			<hr>
			<div class="footer-info">
				<div class="footer-menu">
					<?php
				wp_nav_menu(array(
					'theme_location' => 'menu-2',
					'menu_id' => 'footer-menu',
				));
				?>
				</div>
				<div class="site-info">
					<ul>
						<li>&copy; <?php echo date('Y'); ?> <?php bloginfo('name') ?> </li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
				</div><!-- .site-info -->
			</div><!-- .footer-info -->
		</div><!-- .foot-wrap -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
