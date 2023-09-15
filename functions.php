<?php
require_once get_template_directory() . '/menus.php';
add_action('wp_enqueue_scripts', 'mota_enqueue_styles');
function mota_enqueue_styles() {
        wp_enqueue_style('style', get_template_directory_uri() . '/css/style.min.css', array(), time());
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), time(), true);
}
//Remember to delete time() versionning

function register_menus(){
    register_nav_menus(
    array(
        'main-menu' => __('Menu Principal', 'motaphoto'),
        'footer-menu' => __( 'Menu Footer', 'motaphoto' ),
    )
    );
}
add_action( 'init', 'register_menus' );

// Adds
add_theme_support( 
    'custom-logo',
    array(
    'flex-height'          => true,
    'flex-width'           => true,
    'unlink-homepage-logo' => true,
    )
    );

add_theme_support(
    'title-tag'
);

add_theme_support(
    'html5', array('comment-form')
);

add_theme_support(
    'post-thumbnails'
);


/**
 * Proper ob_end_flush() for all levels
  * This replaces the WordPress `wp_ob_end_flush_all()` function
 * with a replacement that doesn't cause PHP notices.
 */
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
add_action( 'shutdown', function() {
   while ( @ob_end_flush() );
} );