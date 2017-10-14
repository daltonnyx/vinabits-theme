<?php

/**
 * Enqueue scripts and styles.
 */
function vinabits_scripts() {

    //wp_enqueue_style('Open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans&amp;subset=latin-ext,vietnamese');

    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');

    wp_enqueue_style( 'animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css' );

	  wp_enqueue_style('mui-css', 'https://cdnjs.cloudflare.com/ajax/libs/muicss/0.9.14/css/mui.min.css');

	  wp_enqueue_style('mui-color', 'https://cdnjs.cloudflare.com/ajax/libs/muicss/0.9.14/extra/mui-colors.min.css');

	  wp_enqueue_script('mui-js', 'https://cdnjs.cloudflare.com/ajax/libs/muicss/0.9.14/js/mui.min.js', array(), '0.9.14', true);

	  wp_enqueue_style('owl-carousel-css','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css');

    wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js', array('jquery'), '2.2.1', true);

    //wp_enqueue_script( 'slick-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js', array('jquery'), '1.6.0', true );

    //wp_enqueue_style( 'slick-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css' );

    //wp_enqueue_style( 'slick-carousel-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css' );

	  wp_enqueue_style( 'vinabits-style', get_stylesheet_uri() );

    wp_enqueue_script( 'vinabits-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

    //wp_enqueue_script( 'vinabits-ballons', get_template_directory_uri() . '/assets/js/ballons.js', array('jquery'),'0,1', true );

	  wp_enqueue_script( 'vinabits', get_template_directory_uri() . '/assets/js/vinabits.js', array('jquery'), '20151215', true );

	  wp_enqueue_script( 'vinabits-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'vinabits_scripts' );
