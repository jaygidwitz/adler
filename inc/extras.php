<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package The Adler
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function the_adler_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'the_adler_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function the_adler_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'adler_txtd' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'the_adler_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function the_adler_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'the_adler_render_title' );
endif;

if ( ! function_exists( 'adler_fonts_url' ) ) :

	/**
	 * Generate the Google Fonts URL
	 *
	 * Based on this article http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
	 */
	function adler_fonts_url() {
		$fonts_url = '';

		/* Translators: If there are characters in your language that are not
		* supported by Droid Serif, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$droid_serif = _x( 'on', 'Droid Serif font: on or off', 'adler_txtd' );

		/* Translators: If there are characters in your language that are not
		* supported by Permanent Marker, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$permanent_marker = _x( 'on', 'Permanent Marker font: on or off', 'adler_txtd' );

		/* Translators: If there are characters in your language that are not
		* supported by Droid Sans Mono, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$droid_sans_mono = _x( 'on', 'Droid Sans Mono font: on or off', 'adler_txtd' );


		if ( 'off' !== $droid_serif || 'off' !== $permanent_marker || 'off' !== $droid_sans_mono) {
			$font_families = array();

			if ( 'off' !== $droid_serif ) {
				$font_families[] = 'Droid Serif:400,700,400italic,700italic';
			}

			if ( 'off' !== $permanent_marker ) {
				$font_families[] = 'Permanent Marker:400';
			}

			if ( 'off' !== $droid_sans_mono ) {
				$font_families[] = 'Droid Sans Mono:400';
			}

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
endif;