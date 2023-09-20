<?php
/**
 * Template part for displaying photoblock in home & single-photo
 */

 $photocat_term_id = get_field('photocat');

 if($photocat_term_id){

    $args_upsell = array(
        'post_type' => 'single-photo',
        'posts_per_page' => 2,
        'orderby' => 'rand',
        'order' => 'ASC',
        'post__not_in' => array(get_the_ID()),
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
            <div class="overlay">
                <div class="icons eye-icon"><img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/Icon_eye.svg" alt="voir la photo"></div>
                <div class="icons fullscreen-icon"><img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/fullscreen.svg" alt="voir la photo"></div>    
            </div>
        </div>
        <?php
        endwhile;
        wp_reset_postdata();
    else:
        // Affichez un message si aucune publication n'est trouvée
        echo 'Aucune publication trouvée';
    endif;

} else {
    $args_upsell = array(
        'post_type' => 'single-photo',
        'posts_per_page' => 12,
        'orderby' => 'date',
        'order' => 'ASC',
        );

    $my_query = new WP_Query($args_upsell);

    if ($my_query->have_posts()) :
        while ($my_query->have_posts()) : $my_query->the_post();
        ?>
        <div class="photo-container">
            <div class="photo_block">
                <img src="<?= esc_url(get_field('file')); ?>" alt="<?= esc_attr(get_field('description')); ?>">
            </div>
            <div class="overlay">
                <div class="icons eye-icon"><img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/Icon_eye.svg" alt="voir la photo"></div>
                <div class="icons fullscreen-icon"><img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/fullscreen.svg" alt="voir la photo"></div>    
            </div>
        </div>
        <?php
        endwhile;
        wp_reset_postdata();
    else:
        echo 'Aucune publication trouvée';
    endif;
}
            ?>





