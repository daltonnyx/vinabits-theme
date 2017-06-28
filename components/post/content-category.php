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
    <div class="mui-col-xs-12 mui-col-md-12">
        <?php the_post_thumbnail('thumbnail',array('class' => 'img-responsive', 'alt' => get_the_title())); ?>
    </div>
    <div class="mui-col-xs-12 mui-col-md-12">
        <header class="entry-header">
        <h2 class="entry-title"><?php echo get_the_title(); ?></h2>
        </header>
        <div class="entry-meta">
            <span class="hcard"> <span class="date"><i class="fa fa-calendar"></i> <?php the_date('d-M-Y') ?></span></span>
        </div>
        <div class="entry-content">
            <?php echo get_my_excerpt(35); ?> 
        </div>
        <a class="b-line" href="<?php echo get_permalink(); ?>">Xem thêm</a>
    </div>
</div></article><!-- #post-## -->
