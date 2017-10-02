<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Vinabits
 */

if ( ! function_exists( 'vinabits_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function vinabits_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'vinabits' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'vinabits' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'vinabits_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function vinabits_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'vinabits' ) );
		if ( $categories_list && vinabits_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'vinabits' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'vinabits' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'vinabits' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'vinabits' ), esc_html__( '1 Comment', 'vinabits' ), esc_html__( '% Comments', 'vinabits' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'vinabits' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function vinabits_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'vinabits_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'vinabits_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so vinabits_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so vinabits_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in vinabits_categorized_blog.
 */
function vinabits_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'vinabits_categories' );
}
add_action( 'edit_category', 'vinabits_category_transient_flusher' );
add_action( 'save_post',     'vinabits_category_transient_flusher' );



function get_hot_product() {
	$wc_query = new WP_Query(array(
		'posts_per_page' => 15,
		'post_type' => 'product',
		'meta_query' => array(
			array(
				'key' => '_sale_price',
				'value' => '0',
				'compare' => '>'
			)
		)
	));
	echo '<div class="owl-carousel hot-products">';
	if ($wc_query->have_posts()) : while($wc_query->have_posts()) : $wc_query->the_post();
		render_product();
	endwhile; endif;
	echo '</div>';
}

function render_product() {
	?>
	 <article class="product-section">
	 	<a href="<?php echo get_permalink(); ?>" class="product-link">
		 	<?php echo get_the_post_thumbnail(get_the_ID(),'product-thumb',array(
		 		'class' => 'img-responsive product-thumbnail',
		 		'alt' => get_the_title()
		 	)); ?>
	 	</a>
	 	<a href="<?php echo get_permalink(); ?>" class="product-link"><h3 class="product-title"><?php echo get_the_title(); ?></h3></a>
	 	<div class="price-meta">
<?php 
    global $product;
    if( $sale_price = $product->get_price() ) :
        $regular_price = $product->get_regular_price();
?>
        <?php if($sale_price != $regular_price) : ?> 
                        <p class="regular-price"><?php echo wc_price($regular_price); ?></p>
        <?php endif; ?>
                        <p class="sale-price"><?php echo wc_price($sale_price); ?></p>
<?php else : ?>
        <p class="no-price"><span><?php echo __('Giá: Liên hệ'); ?></span></p>        
<?php endif; ?>
		</div>
		<!--<div class="add-to-cart fluid-container">
			<a href="<?php //echo get_permalink(); ?>" class="mui-btn btn-add-to-cart"><?php //echo __('Mua ngay','matthan'); ?></a>
		</div>-->
	 </article>
	<?php
}

function render_product_archive() {
	?>
     <article class="product-section">
        <div class="product-image-container">
	 	<a href="<?php echo get_permalink(); ?>" class="product-link">
		 	<?php echo get_the_post_thumbnail(get_the_ID(),'product_thumbnail',array(
		 		'class' => 'img-responsive product-thumbnail',
		 		'alt' => get_the_title()
		 	)); ?>
        </a>
        </div>
        <div class="product-info-container">
        <a href="<?php echo get_permalink(); ?>" class="product-link"><h3 class="product-title"><?php echo get_the_title(); ?></h3></a>
        <div class="product-desc">  
            <?php echo get_my_excerpt(50); ?>
        </div>
        </div>
        <div class="product-price-container">
	 	<div class="price-meta">
<?php 
    global $product;
    if( $sale_price = $product->get_price() ) :
        $regular_price = $product->get_regular_price();
?>
        <?php if($sale_price != $regular_price) : ?> 
                        <p class="regular-price"><?php echo wc_price($regular_price); ?></p>
        <?php endif; ?>
                        <p class="sale-price"><?php echo wc_price($sale_price); ?></p>
        
<?php endif; ?>
		</div>
		<div class="add-to-cart fluid-container">
			<a href="<?php echo get_permalink(); ?>" class="mui-btn btn-add-to-cart"><?php echo __('Mua ngay','matthan'); ?></a>
        </div>
        </div>
	 </article>
	<?php
}
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
