<?php
/**
 * Template Name: Front page
 *
 * @package vinabits
 */

get_header(); ?>

    <div class="mui-container-fluid">
        <div class="mui-row slide-section">

                <?php echo do_shortcode('[wonderplugin_slider id="1"]'); ?>
            <div class="ballon-1"></div>
            <div class="ballon-2"></div>
            <div class="ballon-3"></div>
            <div class="ballon-1"></div>
            <div class="ballon-2"></div>
            <div class="ballon-3"></div>

        </div>
    </div>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <section class="section-1">
                <div class="mui-container">
                    <div class="mui-row">
                        <?php dynamic_sidebar('front-1'); ?>
                    </div>
                </div>
            </section>
            <section class="section-2">
                <div class="mui-container">
                    <div class="mui-row">
                        <?php dynamic_sidebar('front-2'); ?>
                    </div>
                </div>
            </section>
            <section class="section-3">
                <div class="mui-container">
                    <div class="mui-row">
                        <?php dynamic_sidebar('front-3'); ?>
                    </div>
                </div>
            </section>
            <section class="section-4">
                <div class="mui-container">
                    <div class="mui-row">
                        <?php dynamic_sidebar('front-4'); ?>
                    </div>
                </div>
            </section>
            <section class="section-5">
                <div class="mui-container">
                    <div class="mui-row">
                        <?php dynamic_sidebar('front-5'); ?>
                    </div>
                </div>
            </section>
		</main>
	</div>
<?php get_footer(); ?>
