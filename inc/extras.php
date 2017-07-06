<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Vinabits
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function vinabits_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	// Add a class of no-sidebar when there is no sidebar present
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'vinabits_body_classes' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vinabits_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'vinabits_content_width', 640 );
}
add_action( 'after_setup_theme', 'vinabits_content_width', 0 );

/**
 * Return early if Custom Logos are not available.
 *
 * @todo Remove after WP 4.7
 */
function vinabits_the_custom_logo() {
	if ( ! function_exists( 'the_custom_logo' ) ) {
		return;
	} else {
		the_custom_logo();
	}
}

add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category()  ) {

                    $title = single_cat_title( '', false  );


    } elseif ( is_tag()  ) {

                    $title = single_tag_title( '', false  );


    } elseif ( is_author()  ) {

                    $title = '<span class="vcard">' . get_the_author() . '</span>' ;


    }

        return $title;


} );
