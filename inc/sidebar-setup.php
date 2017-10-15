<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vinabits_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'vinabits' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    // register_sidebar( array(
	//     'name'          => esc_html__( 'Top bar', 'vinabits' ),
	//     'id'            => 'top-1',
	//     'description'   => '',
	//     'before_widget' => '<div id="%1$s" class="top-bar %2$s">',
	//     'after_widget'  => '</div>',
	//     'before_title'  => '<h4 class="top-bar-title">',
	//     'after_title'   => '</h4>',
	// ) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front 1', 'vinabits' ),
		'id'            => 'front-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="front-section %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="front-page-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front 2', 'vinabits' ),
		'id'            => 'front-2',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="front-section %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="front-title"><h2 class="front-page-title">',
		'after_title'   => '</h2></div>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Front 3', 'vinabits' ),
        'id'            => 'front-3',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="front-section %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="front-page-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Front 4', 'vinabits' ),
        'id'            => 'front-4',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="front-section %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="front-page-title">',
        'after_title'   => '</h3>',
    ) );
		register_sidebar( array(
        'name'          => esc_html__( 'Front 5', 'vinabits' ),
        'id'            => 'front-5',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="front-section %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="front-page-title">',
        'after_title'   => '</h3>',
    ) );
		register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'vinabits' ),
		'id'            => 'footer',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="footer-section %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-widget-title">',
		'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
		'name'          => esc_html__( 'Mobile', 'vinabits' ),
		'id'            => 'mobile',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="mobile-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer-widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'vinabits_widgets_init' );

