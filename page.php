<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package vinabits
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<div class="mui-container">
                <div class="mui-row">
                    <?php get_sidebar(); ?>
                    <div class="mui-col-md-9 mui-xs-12 main-content">
                        <?php the_breadcrumb(); ?>
                        <h1 class="entry-title"><?php echo get_the_title(); ?></h1>
						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'components/page/content', 'page' );

						endwhile; // End of the loop.
						?>
					</div>
				</div>
			</div>
		</main>
	</div>
<?php
get_footer();
