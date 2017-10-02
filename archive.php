<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package vinabits
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			if ( have_posts() ) : ?>
			<div class="mui-container">
			<div class="mui-row">
                <?php get_sidebar(); ?>
                <div class="mui-col-md-9 mui-col-xs-12">
                    <?php the_breadcrumb(); ?>
                    <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
					<div class="news-list">    
						<?php
                        /* Start the Loop */
                        $delay_count = 0;
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
							get_template_part( 'components/post/content', 'card-list' );
                            $delay_count = $delay_count == 2 ? 0 : ++$delay_count;
						endwhile;
						?>
					</div>
					<div class="navigation">
						<?php wp_pagenavi(); ?>
                    </div>
                </div>    
			</div>
				<?php//	get_sidebar(); ?>
			</div>
		</div>
			<?php

		else : ?>
			<div class="title-bar">
				<div class="mui-container">
					<div class="mui-row">
						<div class="mui-col-md-12">
							<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
						</div>
						<div class="mui-col-md-12 mui--text-right">
							<?php the_breadcrumb(); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="mui-container">
				<div class="mui-row">
					<?php//	get_sidebar(); ?>
					<div class="mui-col-md-12 mui-xs-12 main-content">
						<?php	get_template_part( 'components/post/content', 'none' ); ?>

		<?php endif; ?>

		</main>
	</div>
<?php
get_footer();
