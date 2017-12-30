<?php
/**
 * Vinabits Theme Customizer
 *
 * @package Vinabits
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vinabits_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	for ($i=1; $i <= 5; $i++) {
		$wp_customize->add_setting('section-bg-'.$i, array(
			'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		 	'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
		  'transport'  => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( //Instantiate the color control class
					$wp_customize, //Pass the $wp_customize object (required)
					'section-bg-'.$i, //Set a unique ID for the control
					array(
						 'label'      => __( 'Section '.$i.' Background', 'vinabits' ), //Admin-visible name of the control
						 'settings'   => 'section-bg-'.$i, //Which setting to load and manipulate (serialized is okay)
						 'priority'   => 10, //Determines the order this control appears in for the specified section
						 'section'    => 'background_image', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
					)
			 ) );
	}

}
add_action( 'customize_register', 'vinabits_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function vinabits_customize_preview_js() {
	wp_enqueue_script( 'vinabits_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'vinabits_customize_preview_js' );
