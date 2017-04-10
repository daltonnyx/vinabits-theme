<?php
/**
 * Template part for displaying posts in category.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package vinabits
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('main-content card-view'); ?>><div class="mui-row">
    <div class="mui-col-xs-12 mui-col-md-4">
        <?php the_post_thumbnail('thumbnail',array('class' => 'img-responsive', 'alt' => get_the_title())); ?>
    </div>
    <div class="mui-col-xs-12 mui-col-md-8">
        <header class="entry-header">
        <h2 class="entry-title"><?php echo get_the_title(); ?></h2>
        <div class="entry-meta">
          <?php
            printf( '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>',
            esc_attr( get_the_date( 'c' ) ),
                esc_html( get_the_date() ),
                esc_attr( get_the_modified_date( 'c' ) ),
                esc_html( get_the_modified_date() )
            );
          ?>
          -
          <span class="author-name url fn n" rel="author"><?php echo get_the_author(); ?></span>
        </div>
        </header>
        <div class="entry-content">
            <?php echo get_my_excerpt(25); ?>

        </div>
        <a class="mui-btn mui-btn--primary" href="<?php echo get_permalink(); ?>">Xem thêm</a>
    </div>
</div></article><!-- #post-## -->
