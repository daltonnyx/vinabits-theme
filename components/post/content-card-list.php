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

<article id="post-<?php the_ID(); ?>" <?php post_class('main-content card-view has-animation fadeInUp '. $delay); ?>>
    <div class="mui-col-xs-12 mui-col-md-12 thumb-container">
       <a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('full',array('class' => 'img-responsive', 'alt' => get_the_title())); ?></a>
    </div>
    <div class="mui-col-xs-12 mui-col-md-12 post-container">
        <header class="entry-header">
        <a href="<?php echo get_permalink(); ?>"><h3 class="entry-title"><?php echo get_the_title(); ?></h3></a>
        </header>
        <div class="entry-desc">
            <?php echo get_my_excerpt(40); ?>
        </div>
    </div>
</article><!-- #post-## -->
