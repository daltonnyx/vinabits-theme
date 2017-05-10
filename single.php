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

            <div class="mui-col-md-12 mui-xs-12 main-content">
                <div class="mui-row">
                <div class="title-bar">
			        <h1><?php echo get_the_title(); ?></h1>
			    </div>

						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'components/post/content', '' );



						endwhile; // End of the loop.
						?>
					</div>
                </div>
              </div>
			</div>
		</main>
	</div>
<?php
get_footer();
