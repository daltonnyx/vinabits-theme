
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
	<footer id="colophon" class="site-footer" role="contentinfo">
        <?php get_template_part( 'components/footer/site', 'info' ); ?>
	</footer>
	<div id="copyright" class="site-info">
			COPYRIGHT <?php echo date('Y'); ?> - CÔNG TY TNHH THƯƠNG MẠI DỊCH VỤ XUẤT NHẬP KHẨU VIETBIZ <img alt="Websiteplaza" src="<?php echo get_template_directory_uri(); ?>/assets/images/plaza.png">
	</div>
</div>
<?php wp_footer(); ?>

</body>
</html>
