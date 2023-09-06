<?php
require_once get_template_directory() . '/menus.php';
add_action('wp_enqueue_scripts', 'mota_enqueue_styles');
function mota_enqueue_styles() {
        wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css');
        wp_enqueue_style('header', get_template_directory_uri() . '/css/header.css');
        wp_enqueue_style('footer', get_template_directory_uri() . '/css/footer.css');
        wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array(), '1.0', true);
}


function register_menus(){
    register_nav_menus(
    array(
        'main-menu' => __('Menu Principal', 'motaphoto'),
        'footer-menu' => __( 'Menu Footer', 'motaphoto' ),
    )
    );
}
add_action( 'init', 'register_menus' );

add_filter( 'wp_nav_menu_items', 'add_contact_to_main_menu', 10, 2);
function add_contact_to_main_menu( $items, $args ) {
if ($args->theme_location==='main-menu') {
        $items_array[] = $items;
        array_splice($items_array, 1, 0, '<li id="contact" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home"><a class="contact" href="#" itemprop="url"><div itemprop="name" class="menu-item">Contact</div></a></li>'); 
        $items = implode('', $items_array);
}   
return $items;
}

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