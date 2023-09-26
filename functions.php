<?php
require_once get_template_directory() . '/menus.php';
add_action('wp_enqueue_scripts', 'mota_enqueue_styles');
function mota_enqueue_styles() {
        wp_enqueue_style('style', get_template_directory_uri() . '/css/style.min.css', array(), time());
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), time(), true);

    // Les données que vous souhaitez transmettre à votre script
    $ajax_data = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    );

    // Ajoutez ces données en ligne dans le script 'script'
    wp_add_inline_script('script', 'var ajax_data = ' . wp_json_encode($ajax_data) . ';', 'before');

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
    $offset = $_POST['offset']; 

    $args = array(
        'post_type' => 'single-photo',
        'posts_per_page' => 12,
        'orderby' => 'date',
        'order' => 'ASC',
        'offset' => $offset,
    );

    $query = new WP_Query($args);
    $total_posts = $query->found_posts;

    $photos = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $thumbnail_id = get_post_thumbnail_id();

            if ($thumbnail_id) {
                $image_info = wp_get_attachment_image_src($thumbnail_id, 'full');
                $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
            }

            $photo_html = '
                <div class="photo-container">
                    <div class="photo_block">
                        <img src="' . esc_url($image_info[0]) . '" alt="' . esc_attr($alt_text) . '">
                    </div>
                    <div class="overlay">
                        <div class="icons eye-icon"><img src="' . esc_url(get_template_directory_uri()) . '/assets/img/Icon_eye.svg" alt="voir la photo"></div>
                        <div class="icons fullscreen-icon"><img src="' . esc_url(get_template_directory_uri()) . '/assets/img/fullscreen.svg" alt="voir la photo"></div>
                    </div>
                </div>';

            $photos[] = $photo_html;
        }
    }

    wp_send_json($photos);
    wp_send_json($total_posts);
}

add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

function load_all_photos() {
    $offset = $_POST['offset'];
    $currentPostCatID = $_POST['currentPostCatID'];

    $args = array(
        'post_type' => 'single-photo',
        'orderby' => 'date',
        'order' => 'ASC',
        'offset' => $offset,
        'tax_query' => array(
            array(
                'taxonomy' => 'photocat',
                'field' => 'id',
                'terms' => $currentPostCatID,
            ),
        ));
    

    $query = new WP_Query($args);
    $total_posts = $query->found_posts;

    $photos = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $thumbnail_id = get_post_thumbnail_id();

            if ($thumbnail_id) {
                $image_info = wp_get_attachment_image_src($thumbnail_id, 'full');
                $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
            }

            $photo_html = '
                <div class="photo-container">
                    <div class="photo_block">
                        <img src="' . esc_url($image_info[0]) . '" alt="' . esc_attr($alt_text) . '">
                    </div>
                    <div class="overlay">
                        <div class="icons eye-icon"><img src="' . esc_url(get_template_directory_uri()) . '/assets/img/Icon_eye.svg" alt="voir la photo"></div>
                        <div class="icons fullscreen-icon"><img src="' . esc_url(get_template_directory_uri()) . '/assets/img/fullscreen.svg" alt="voir la photo"></div>
                    </div>
                </div>';

            $photos[] = $photo_html;
        }
    }

    wp_send_json($photos);
    wp_send_json($total_posts);
}

add_action('wp_ajax_load_all_photos', 'load_all_photos');
add_action('wp_ajax_nopriv_load_all_photos', 'load_all_photos');


// Filters & orders

function get_photo_formats() {
    $formats = get_terms('format', array('taxonomy' => 'format', 'fields' => 'names'));

    if (!empty($formats)) {
        $output = '<option value="">Formats</option>';
        foreach ($formats as $format) {
            $output .= '<option value="' . $format . '">' . $format . '</option>';
        }
        echo $output;
    }

    die();
}

function get_photo_cats() {
    $photocats = get_terms('photocat', array('taxonomy' => 'photocat', 'fields' => 'names'));

    if (!empty($photocats)) {
        $output = '<option value="">Catégories</option>';
        foreach ($photocats as $photocat) {
            $output .= '<option value="' . $photocat . '">' . $photocat . '</option>';
        }
        echo $output;
    }

    die();
}

add_action('wp_ajax_get_photo_formats', 'get_photo_formats');
add_action('wp_ajax_nopriv_get_photo_formats', 'get_photo_formats');
add_action('wp_ajax_get_photo_cats', 'get_photo_cats');
add_action('wp_ajax_nopriv_get_photo_cats', 'get_photo_cats');

function filter_photos() {
    $format = $_POST['format'];
    $category = $_POST['category'];

    $args = array(
        'post_type' => 'single-photo',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'ASC',
    );

    if (!empty($format)) {
        // Ajoutez une condition pour filtrer par format
        // par exemple : $args['meta_key'] = 'format'; $args['meta_value'] = $format;
    }

    if (!empty($category)) {
        // Ajoutez une condition pour filtrer par catégorie
        // par exemple : $args['tax_query'] = array(array('taxonomy' => 'photocat', 'field' => 'id', 'terms' => $category));
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            // Affichez vos photos ici comme vous le faites déjà
            // Utilisez la même structure que dans votre boucle actuelle
        }
        $output = ob_get_clean();
        wp_reset_postdata();
        echo $output;
    } else {
        echo 'Aucune photo trouvée';
    }

    die();
}

add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');
