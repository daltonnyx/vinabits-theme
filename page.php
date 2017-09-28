<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package vinabits
 */

get_header();
$banner_top = get_post_meta(get_the_ID(), '_vnb_banner_top', true);
$banner_bottom = get_post_meta(get_the_ID(), '_vnb_banner_bottom', true);
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="title-bar">
				<div class="mui-container">
					<div class="mui-row">
						<div class="mui-col-md-12">
							<?php the_breadcrumb(); ?>
						</div>
						<div class="mui-col-md-12">
							<h1><?php echo get_the_title(); ?></h1>
						</div>
					</div>
				</div>
			</div>
			<?php if(!empty($banner_top)) : ?>
			<?php $banner_top_src = wp_get_attachment_url($banner_top); ?>
			<div class="top-banner">
				<img src="<?php echo $banner_top_src ?>" alt="<?php echo get_the_title(); ?>" />
			</div>
		<?php endif; ?>
			<div class="mui-container">
				<div class="mui-row">
					<div class="mui-col-md-12 mui-xs-12 main-content">
						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'components/page/content', 'page' );

						endwhile; // End of the loop.
						?>
					</div>
				</div>
			</div>
			<?php if(!empty($banner_bottom)) : ?>
			<?php $banner_bottom_src = wp_get_attachment_url($banner_bottom); ?>
			<div class="bottom-banner">
				<img src="<?php echo $banner_bottom_src ?>" alt="<?php echo get_the_title(); ?>" />
			</div>
		<?php endif; ?>
		</main>
	</div>
<?php
get_footer();
