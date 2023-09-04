<?php
require_once get_template_directory() . '/menus.php';
function mota_enqueue_styles() {
    // Styles
        // wp_enqueue_style('x', get_stylesheet_directory_uri() . '/x.css');
    // Scripts
        // wp_enqueue_script('x', get_stylesheet_directory_uri() . '/x.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'mota_enqueue_styles');

// Menu
function register_menu() {
    register_nav_menu('main-menu', __('Menu Principal', 'motaphoto'));
}
add_action('after_setup_theme', 'register_menu');
