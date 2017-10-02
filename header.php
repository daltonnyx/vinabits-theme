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
		<div class="mui-container">
            <div class="mui-row">
                <div class="mui-col-xs-12  mui-col-md-2 logo-container">
                    <?php vinabits_the_custom_logo(); ?>
                </div>
                <div class="mui-hidden-xs mui-col-md-9 mui-col-md-offset-1 top-bar">
                    <?php dynamic_sidebar('top-1'); ?>
                </div>
            </div>
         </div>    
    </header>
    <div class="nav main-nav">
        <div class="mui-container">
            <div class="mui-row">
                <div class="mui-col-xs-12 mui-col-md-12 nav-container">
                    <div class="mui-row mui--text-right">
                    <?php get_template_part( 'components/navigation/navigation', 'top' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="content" class="site-content">
        
