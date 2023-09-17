<?php
/**
 * Template part for displaying photoblock in home & single-photo
 */

 $photocat_term_id = get_field('photocat');
 var_dump($photocat_term_id);


    $args_upsell = array(
        'post_type' => 'single-photo',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'ASC',
        'tax_query' => array(
          array(
              'taxonomy' => 'photocat', 
              'field' => 'id',
              'terms' => $photocat_term_id,
          ),
      ),
    );

    $my_query = new WP_Query($args_upsell);

    if ($my_query->have_posts()) :
        while ($my_query->have_posts()) : $my_query->the_post();
?>

            <div class="photo-container">
                <div class="photo_block">
                    <img src="<?= esc_url(get_field('file')); ?>" alt="<?= esc_attr(get_field('description')); ?>">
                </div>
                <div class="overlay"></div>
                <div class="icons">
                  <div class="eye-icon"><img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/Icon_eye.svg" alt="voir la photo"></div>
                  <div class="fullscreen-icon"><img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/fullscreen.png" alt="voir la photo"></div>    
                </div>
            </div>

<?php
        endwhile;
        wp_reset_postdata();
    endif;

?>

</div>
<div class="load">
    <button class="wpcf7-submit">Toutes les photos</button>
</div>
