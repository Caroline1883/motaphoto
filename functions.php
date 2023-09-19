<?php
require_once get_template_directory() . '/menus.php';
add_action('wp_enqueue_scripts', 'mota_enqueue_styles');
function mota_enqueue_styles() {
        wp_enqueue_style('style', get_template_directory_uri() . '/css/style.min.css', array(), time());
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), time(), true);
        wp_localize_script('script', 'ajaxurl', admin_url('admin-ajax.php'));
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


//load buttons

function load_more_photos() {
    // Votre logique de requête WP_Query ici pour récupérer les photos supplémentaires
    // Assurez-vous de définir les arguments WP_Query appropriés pour les photos supplémentaires

    $args = array(
        'post_type' => 'single-photo',
        'posts_per_page' => 12, // Par exemple, récupérez 12 photos supplémentaires
        'offset' => $_POST['offset'], // Utilisez l'offset pour charger les photos suivantes
        // Autres arguments de requête
    );

    $query = new WP_Query($args);

    $photos = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $photos = array();

            if ($query->have_posts()) {
                while ($query->have_posts()) {
            
                    // Récupérez l'URL de l'image
                    $image_url = esc_url(get_field('file'));
            
                    // Récupérez la description de l'image
                    $image_description = esc_attr(get_field('description'));
            
                    // Construisez le HTML pour chaque photo
                    $photo_html = '
                    <div class="photo-container">
                        <div class="photo_block">
                            <img src="' . $image_url . '" alt="' . $image_description . '">
                        </div>
                        <div class="overlay">
                            <div class="icons eye-icon"><img src="' . esc_url(get_template_directory_uri()) . '/assets/img/Icon_eye.svg" alt="voir la photo"></div>
                            <div class="icons fullscreen-icon"><img src="' . esc_url(get_template_directory_uri()) . '/assets/img/fullscreen.svg" alt="voir la photo"></div>
                        </div>
                    </div>';
            
                    // Ajoutez le HTML de la photo au tableau $photos
                    $photos[] = $photo_html;
                }
            }
            
        }
    }


    // Une fois que vous avez récupéré les photos, renvoyez-les au format JSON
    wp_send_json($photos);
}

// Ajoutez des actions pour gérer la requête AJAX
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');
