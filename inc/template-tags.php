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
			if($parents = get_post_ancestors(get_the_ID())) {
				foreach ($parents as $id) {
					echo '<li>';
					echo '<a href="'.get_permalink($id).'">'.get_the_title($id).'</a>';
					echo '</li>';
				}
			}
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


function team_shortcode($atts ) {
	$members = new WP_Query( array(
		'post_type' => 'team',
		'posts_per_page' => -1
	) );
	ob_start();
	echo '<div class="team-container">';
	if( $members->have_posts() ) : while( $members->have_posts() ) : $members->the_post();
	?>
		<div class="mui-row">
			<div class="mui-col-xs-12 mui-col-md-3">
				<div class="portrait">
					<?php the_post_thumbnail('team-portait', array('class' => 'img-responsive', 'alt' => get_the_title())); ?>
				</div>
				<div class="title">
					<h4 class="member-name"><?php echo get_the_title(); ?></h4>
					<p>
						<?php echo get_post_meta(get_the_ID(), '_vnb_member_title', true); ?>
					</p>
				</div>
			</div>
			<div class="mui-col-xs-12 mui-col-md-9">
				<div class="bio">
					<?php the_content(); ?>
				</div>
				<div class="socials">
					<?php
						$facebook_link = get_post_meta(get_the_ID(), '_vnb_facebook_link', true);
						$google_link = get_post_meta(get_the_ID(), '_vnb_google_link', true);
						$skype = get_post_meta(get_the_ID(), '_vnb_skype_account', true);
					?>
					<ul>
						<li class="social-item"><a target="_blank" href="<?php echo $facebook_link; ?>"><i class="fa fa-facebook"></i></a></li>
						<li class="social-item"><a target="_blank" href="<?php echo $google_link; ?>"><i class="fa fa-google-plus"></i></a></li>
						<li class="social-item"><a target="_blank" href="<?php echo $skype; ?>"><i class="fa fa-skype"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		<hr/>
	<?php
  endwhile; endif;
	echo 	'</div>';
	return ob_get_clean();
}

add_shortcode('team_viewer', 'team_shortcode');
