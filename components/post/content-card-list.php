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
       <a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('card-thumb',array('class' => 'img-responsive', 'alt' => get_the_title())); ?></a>
    </div>
    <div class="mui-col-xs-12 mui-col-md-12">
        <header class="entry-header">
        <a href="<?php echo get_permalink(); ?>"><h3 class="entry-title"><?php echo get_the_title(); ?></h3></a>
        </header>
        
    </div>
</div></article><!-- #post-## -->
