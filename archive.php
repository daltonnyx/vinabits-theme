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

        <div class="mui-col-md-12 mui-xs-12">
            <div class="mui-row">
            <div class="title-bar">
			<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
			</div>
					<div class="cards-list">

						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'components/post/content', 'card-list' );

						endwhile;
						?>
					</div>
					<div class="navigation">
						<?php wp_pagenavi(); ?>
                    </div>
</div>
				</div>
			</div>
		</div>
		</div>
			<?php

		else : ?>
								
			<div class="mui-container">
				<div class="mui-row">
					<div class="mui-col-md-12 mui-xs-12 main-content">
                    <div class="title-bar">
                        <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
                    </div>

						<?php	get_template_part( 'components/post/content', 'none' ); ?>

		<?php endif; ?>

		</main>
	</div>
<?php
get_footer();
