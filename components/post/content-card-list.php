<?php
/**
 * Template part for displaying posts in category.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package vinabits
 */
global $delay_count;
$delay = 'delay-'. $delay_count * 100;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('main-content card-view has-animation fadeInUp py-3 '. $delay); ?>>
    <div class="col-12 col-12 thumb-container">
       <a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('full',array('class' => 'img-responsive', 'alt' => get_the_title())); ?></a>
    </div>
    <div class="col-12 col-12 post-container">
        <header class="entry-header">
        <a href="<?php echo get_permalink(); ?>"><h3 class="entry-title"><?php echo get_the_title(); ?></h3></a>
        </header>
        <div class="entry-meta">
            <div class="hcard">
                <span class="date"><i class="fa fa-calendar"></i> <?php echo get_the_date('d-m-Y') ?></span>
                <span class="author"><i class="fa fa-pencil"></i> <?php the_author() ?></span>
                <span class="category"><i class="fa fa-folder-open"></i> <?php the_category(',') ?></span>
            </div>
        </div>
        <div class="entry-desc">
            <?php echo get_my_excerpt(40); ?>
        </div>
    </div>
</article><!-- #post-## -->
