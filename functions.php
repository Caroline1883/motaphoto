<?php
require_once get_template_directory() . '/menus.php';
add_action('wp_enqueue_scripts', 'mota_enqueue_styles');
function mota_enqueue_styles() {
        wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css');
        wp_enqueue_style('header', get_template_directory_uri() . '/css/header.css');
        wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array(), '1.0', false);
}


// Menu
function register_menu() {
    register_nav_menu('main-menu', __('Menu Principal', 'motaphoto'));
}
add_action('after_setup_theme', 'register_menu');

// Adds
add_theme_support( 
    'custom-logo',
    array(
    'flex-height'          => true,
    'flex-width'           => true,
    'unlink-homepage-logo' => true, 
    )
    );

/**
 * Proper ob_end_flush() for all levels
 *
 * This replaces the WordPress `wp_ob_end_flush_all()` function
 * with a replacement that doesn't cause PHP notices.
 */
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
add_action( 'shutdown', function() {
   while ( @ob_end_flush() );
} );