<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vinabits
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area d-xs-none col-lg-3" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
