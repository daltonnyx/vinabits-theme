<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Vinabits
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php

		if ( 'post' === get_post_type() ) : ?>
		<?php //get_template_part( 'components/post/content', 'meta' ); ?>
		<?php
		endif; ?>
	</header>
	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'vinabits' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) ); ?>
			<?php $brands = get_post_meta(get_the_ID(), '_vnb_brand_group', true); ?>
			<?php if(!empty($brands)) : ?>
				<h3 class="brand-title">Nhà sản xuất</h3>
				<div class="brands">
					<?php foreach ($brands as $brand) { ?>
						<div class="brand">
							<a target="_blank" href="<?php echo $brand['link'] ?>">
								<img src="<?php echo wp_get_attachment_url($brand['image']) ?>" />
							</a>
						</div>
					<?php } ?>
				</div>
				<style media="screen">
					.brands {
						display: flex;
						flex-flow: row wrap;
						justify-content: space-between;
					}
					.brand-title {
						font-size: 18px;
						color: #fff;
						background: #58585a;
						padding: 5px 0px 5px 25px;
						text-transform: uppercase;
					}
				</style>
			<?php endif; ?>
			<?php wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'vinabits' ),
				'after'  => '</div>',
			) );
		?>
	</div>
</article><!-- #post-## -->
