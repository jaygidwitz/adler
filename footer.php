<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package The Adler
 */
?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'adler_txtd' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'adler_txtd' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'adler_txtd' ), 'Adler', '<a href="http://pixelgrade.com" rel="designer">PixelGrade</a>' ); ?>
		</div><!-- .site-info -->
		<nav id="footer-navigation" class="footer-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="footer-menu" aria-expanded="false">
				<?php _e( 'Footer Menu', 'adler_txtd' ); ?>
			</button>
			<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu' ) ); ?>
		</nav><!-- #site-navigation-footer -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>