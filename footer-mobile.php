
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vinabits
 */

?>

	</div>
    <div class="off-canvas">
        <div class="mobile-logo">
        <?php vinabits_the_custom_logo(); ?>
        </div>
        <div class="mobile-navigation">
            <?php dynamic_sidebar('top-1'); ?>
            <?php get_template_part( 'components/navigation/navigation', 'mobile' ); ?>
        </div>
    </div>
</div>
<?php wp_footer(); ?>

</body>
</html>
