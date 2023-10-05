<?php
require_once get_template_directory() . '/inc/menus.php';
add_action('wp_enqueue_scripts', 'mota_enqueue_styles');
function mota_enqueue_styles() {
        wp_enqueue_style('style', get_template_directory_uri() . '/css/style.min.css', array(), time());
        wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), time(), true);
        wp_enqueue_script('lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), time(), true);

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
        $current_index = $offset++;
        while ($query->have_posts()) {
            $query->the_post();
            $thumbnail_id = get_post_thumbnail_id();

            if ($thumbnail_id) {
                $image_info = wp_get_attachment_image_src($thumbnail_id, 'full');
                $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
            } else {
                $image_info = '<p>Aucune image</p>';
            }

            $photocat_id = get_field('photocat');
            $photocat_label = ''; 

            $photocat_term = get_term($photocat_id); 
            if (is_object($photocat_term) && property_exists($photocat_term, 'name')) {
                $photocat_label = $photocat_term->name;
            }

            $image_data = array();

            $images_data[] = $image_data;

            $image_data = array(
                'image_src' => esc_url($image_info[0]),
                'ref' => get_field('ref'),
                'cat' => esc_html($photocat_label),
                'index' => $current_index,
            );



            $photo_html = '
                <div class="photo-container">
                    <div class="photo_block">
                        <img src="' . esc_url($image_info[0]) . '" alt="' . esc_attr($alt_text) . '">
                    </div>
                    <div class="overlay">
                        <div class="icons eye-icon">
                            <a href="'. esc_url(get_permalink()).'">
                                <img src="' . esc_url(get_template_directory_uri()) . '/assets/img/Icon_eye.svg" alt="voir la photo">
                            </a>
                        </div>
                        <div class="icons fullscreen-icon"
                        data-image-src="' . esc_url($image_data['image_src']) . '"
                        data-ref="' . $image_data['ref'] . '"
                        data-cat="'. $image_data['cat'] .'"
                        data-index="' .$image_data['index'] . '"
                        >
                            <img src="' . esc_url(get_template_directory_uri()) . '/assets/img/fullscreen.svg" alt="voir la photo">
                        </div>
                    </div>
                </div>';

            $photos[] = $photo_html;
            $current_index++;
        }
    }

    $response_data = array(
        'photos' => $photos,
        'total_posts' => $total_posts,
    );
    
    wp_send_json($response_data);

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

            $photocat_id = get_field('photocat');
            $photocat_label = ''; 

            $photocat_term = get_term($photocat_id); 
            if (is_object($photocat_term) && property_exists($photocat_term, 'name')) {
                $photocat_label = $photocat_term->name;
            }

            $image_data = array(
                'image_src' => esc_url($image_info[0]),
                'ref' => get_field('ref'),
                'cat' => esc_html($photocat_label), 
            );

            $images_data[] = $image_data;

            $photo_html = '
            <div class="photo-container">
            <div class="photo_block">
                <img src="' . esc_url($image_info[0]) . '" alt="' . esc_attr($alt_text) . '">
            </div>
            <div class="overlay">
                <div class="icons eye-icon">
                    <a href="'. esc_url(get_permalink()).'">
                        <img src="' . esc_url(get_template_directory_uri()) . '/assets/img/Icon_eye.svg" alt="voir la photo">
                    </a>
                </div>
                <div class="icons fullscreen-icon"
                    data-image-src="' . esc_url($image_data['image_src']) . '"
                    data-ref="' . $image_data['ref'] . '"
                    data-cat="'. $image_data['cat'] .'"
                >
                    <img src="' . esc_url(get_template_directory_uri()) . '/assets/img/fullscreen.svg" 
                    alt="voir la photo">
                </div>
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


function filter_photos() {
    $format = $_POST['format'];
    $category = $_POST['category'];
    $order = $_POST['order'];

    $args = array(
        'post_type' => 'single-photo',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => $order,
    );

    $tax_query = array();

    if (!empty($format)) {
        $tax_query[] = array(
            'taxonomy' => 'format', 
            'field' => 'name', 
            'terms' => $format,
        );
    }

    if (!empty($category)) {
        $tax_query[] = array(
            'taxonomy' => 'photocat', 
            'field' => 'name', 
            'terms' => $category,
        );
    }

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args);

    $photos = array();

    if ($query->have_posts()) {

        while ($query->have_posts()) {
            $query->the_post();
            $thumbnail_id = get_post_thumbnail_id();
    
                if ($thumbnail_id) {
                    $image_info = wp_get_attachment_image_src($thumbnail_id, 'full');
                    $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                } else {
                    $image_info = '<p>Aucune image</p>';
                }

                $photocat_id = get_field('photocat');
                $photocat_label = ''; 
    
                $photocat_term = get_term($photocat_id); 
                if (is_object($photocat_term) && property_exists($photocat_term, 'name')) {
                    $photocat_label = $photocat_term->name;
                }
    
                $image_data = array(
                    'image_src' => esc_url($image_info[0]),
                    'ref' => get_field('ref'),
                    'cat' => esc_html($photocat_label), 
                );
    
                $images_data[] = $image_data;
    
                $photo_html = '
                <div class="photo-container">
                    <div class="photo_block">
                        <img src="' . esc_url($image_info[0]) . '" alt="' . esc_attr($alt_text) . '">
                    </div>
                    <div class="overlay">
                        <div class="icons eye-icon">
                            <a href="'. esc_url(get_permalink()).'">
                                <img src="' . esc_url(get_template_directory_uri()) . '/assets/img/Icon_eye.svg" alt="voir la photo">
                            </a>
                        </div>
                        <div class="icons fullscreen-icon"
                        data-image-src="' . esc_url($image_data['image_src']) . '"
                        data-ref="' . $image_data['ref'] . '"
                        data-cat="'. $image_data['cat'] .'"
                        >
                            <img src="' . esc_url(get_template_directory_uri()) . '/assets/img/fullscreen.svg" 
                            alt="voir la photo"
                            >
                    </div>
                </div>';
    
                $photos[] = $photo_html;
            }
    }

    wp_send_json($photos);

}

add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');

