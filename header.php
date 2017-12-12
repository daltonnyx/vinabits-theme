<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vinabits
 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header" role="banner">
		<div class="container">
      <div class="row align-items-center">
          <div class="col-xs-12 col-lg-3 logo-container">
              <?php vinabits_the_custom_logo(); ?>
          </div>
          <div class="col-xs-12 col-lg-8 offset-lg-1 top-bar-container">
						<div class="row">
              <?php dynamic_sidebar('top-1'); ?>
							<div class="col-12">
								<?php get_template_part( 'components/navigation/navigation', 'top' ); ?>
							</div>
						</div>
          </div>
			</div>
    </div>
	</header>
    <div id="content" class="site-content">
