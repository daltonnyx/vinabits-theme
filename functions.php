<?php
/**
 * Vinabits functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Vinabits
 */


$inc_dir = opendir(get_template_directory() . '/inc/');

while( ( $file = readdir( $inc_dir ) ) !== false ) {
    $ext = end( explode( ".", $file  ) );
    if($ext == "php")
        require_once get_template_directory() . '/inc/' . $file;
}

function load_media_upload() {
	wp_enqueue_media();
	wp_enqueue_script('media-upload');
	wp_enqueue_script( 'media-js', get_template_directory_uri() . '/assets/js/admin/load_single_media.js' );
}

//Register Team type

VinabitsExtraType::RegisterType('testimonial', 'Cảm nhận', 'Cảm nhận khách hàng', ['menu_icon' => 'dashicons-groups']);

VinabitsExtraBox::RegisterMetabox('testimoninal_title','Tiêu đề', 'testimonial', 'text');

