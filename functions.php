<?php
/**
 * Vinabits functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Vinabits
 */

if ( ! function_exists( 'vinabits_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function vinabits_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'vinabits' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'vinabits', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'vinabits-featured-image', 640, 9999 );

	add_image_size( 'vinabits-thumbnail', 960, 9999 );

	add_image_size( 'post-carousel', 271, 268, array('center', 'center'));

    add_image_size( 'vinabits-news-default', 271, 151, array('center', 'center'));

    add_image_size('front-banner', 370, 245, array('center', 'center'));
    
    add_image_size('card-thumb', 363, 248, array('center', 'center'));

    add_image_size('post-card', 366, 238, array('center', 'center'));

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Top', 'vinabits' ),
	) );

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'width'      => 224,
		'height'       => 87,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'vinabits_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'vinabits_setup' );

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
    register_sidebar( array(
		'name'          => esc_html__( 'Top bar', 'vinabits' ),
		'id'            => 'top-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="top-bar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="top-bar-title">',
		'after_title'   => '</h4>',
	) );
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
        'before_title'  => '<h3 class="front-page-title">',
        'after_title'   => '</h3>',
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
}
add_action( 'widgets_init', 'vinabits_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function vinabits_scripts() {
    
    wp_enqueue_style('OpenSans-font', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700');

    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');

    wp_enqueue_style( 'animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css' );

	wp_enqueue_style('mui-css', 'https://cdnjs.cloudflare.com/ajax/libs/muicss/0.9.14/css/mui.min.css');

	wp_enqueue_style('mui-color', 'https://cdnjs.cloudflare.com/ajax/libs/muicss/0.9.14/extra/mui-colors.min.css');

	wp_enqueue_script('mui-js', 'https://cdnjs.cloudflare.com/ajax/libs/muicss/0.9.14/js/mui.min.js', array(), '0.9.14', true);

	wp_enqueue_style('owl-carousel-css','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css');

	wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js', array('jquery'), '2.2.1', true);

	wp_enqueue_style( 'vinabits-style', get_stylesheet_uri() );

    wp_enqueue_script( 'vinabits-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

    wp_enqueue_script( 'vinabits-ballons', get_template_directory_uri() . '/assets/js/ballons.js', array('jquery'),'0,1', true );

	wp_enqueue_script( 'vinabits', get_template_directory_uri() . '/assets/js/vinabits.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'vinabits-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'vinabits_scripts' );

function register_admin_script() {
    wp_enqueue_script('load-mediaupload', get_template_directory_uri(). '/assets/js/admin/load_mediaupload.js', array('jquery'), '', true);
}
add_action('admin_enqueue_scripts','register_admin_script');


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory(). '/inc/news-widget.php';

require get_template_directory(). '/inc/custom-card-widget.php';

require get_template_directory(). '/inc/shortcodes.php';

require get_template_directory(). '/inc/vinabits-extra-type.php';

require get_template_directory(). '/inc/vinabits-extra-tax.php';

require get_template_directory(). '/inc/vinabits-extra-box.php';

//Custom Excerpt Length

function my_excerpt($excerpt_length = 55, $id = false, $echo = true) {

	 $text = '';

				 if($id) {
							 $the_post = & get_post( $my_id = $id );
							 $text = ($the_post->post_excerpt) ? $the_post->post_excerpt : $the_post->post_content;
				 } else {
							 global $post;
							 $text = ($post->post_excerpt) ? $post->post_excerpt : get_the_content('');
	 }

							 $text = strip_shortcodes( $text );
							 $text = apply_filters('the_content', $text);
							 $text = str_replace(']]>', ']]>', $text);
				 $text = strip_tags($text);

							 $excerpt_more = ' ' . '...';
							 $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
							 if ( count($words) > $excerpt_length ) {
											 array_pop($words);
											 $text = implode(' ', $words);
											 $text = $text . $excerpt_more;
							 } else {
											 $text = implode(' ', $words);
							 }
			 if($echo)
 echo apply_filters('the_content', $text);
			 else
			 return $text;
}

function get_my_excerpt($excerpt_length = 55, $id = false, $echo = false) {
return my_excerpt($excerpt_length, $id, $echo);
}

//Add Breadcrumb

function the_breadcrumb() {
		echo '<ul id="breadcrumb" class="breadcrumb">';
	if (!is_home()) {
		echo '<li><a href="';
		echo get_option('home');
		echo '">';
		echo 'Home';
        echo "</a></li>";
        $link = array();
        if(is_category()) {
            $cat = get_term(get_query_var('cat'),'category');
            while($cat->parent != 0) {
                $cat = get_term($cat->parent, 'category');
                ob_start();
                echo '<li>';
                echo '<a href="'.get_category_link($cat->term_id).'">';
                echo $cat->name;
                echo '</a>';
                echo '</li>';
                array_unshift($link,ob_get_clean());
            }
            foreach($link as $li) {
                echo $li;
            }
            echo '<li>';
            echo get_cat_name(get_query_var('cat'));
            echo '</li>';
        }
		elseif (is_single()) {
			echo '<li>';
			the_category(' </li><li> ');
			if (is_single()) {
				echo "</li><li>";
				the_title();
				echo '</li>';
			}
		} elseif (is_page()) {
			echo '<li>';
			echo the_title();
			echo '</li>';
		}
	}
	elseif (is_tag()) {single_tag_title();}
	elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
	elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
	elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
	elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
	elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
	elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
	echo '</ul>';
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


VinabitsExtraType::RegisterType('promo', 'Promotion', 'Promotions');
VinabitsExtraTax::RegisterTaxonomy('promo_cat', 'promo', 'Category', 'Categories');
VinabitsExtraBox::RegisterMetabox('qua_tang', 'Quà tặng', 'promo');
