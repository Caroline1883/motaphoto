<?php
/**
 * Template part for displaying photoblock in home & single-photo
 */

 $photocat_term_id = get_field('photocat');

 if($photocat_term_id){

    $args_upsell = array(
        'post_type' => 'single-photo',
        'posts_per_page' => 2,
        'orderby' => 'date',
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
                <?php
                    $thumbnail_id = get_post_thumbnail_id();
                    if ($thumbnail_id) {
                        $image_info = wp_get_attachment_image_src($thumbnail_id, 'full');
                        $file_name = basename($image_info[0]);
                        $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                        echo '<img src="' . esc_url($image_info[0]) . '" alt="' . esc_attr($alt_text) . '" />';
                    } else {
                        echo '<p>Aucune image</p>';
                    }
                ?>
            </div>
            <div class="overlay">
                <div class="icons eye-icon">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/Icon_eye.svg" alt="voir la photo">
                    </a>
                </div>
                <div class="icons fullscreen-icon">
                    <a href="#">
                        <img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/fullscreen.svg" alt="voir la photo">
                    </a>
                </div>    
            </div>
        </div>
        <?php
        endwhile;
        wp_reset_postdata();
    else:
        echo '<p>Aucune publication trouvée</p>';
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
            <?php
                    $thumbnail_id = get_post_thumbnail_id();
                    if ($thumbnail_id) {
                        $image_info = wp_get_attachment_image_src($thumbnail_id, 'full');
                        $file_name = basename($image_info[0]);
                        $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                        echo '<img src="' . esc_url($image_info[0]) . '" alt="' . esc_attr($alt_text) . '" />';
                    } else {
                        echo '<p>Aucune image</p>';
                    }
                ?>
            </div>
            <div class="overlay">
                <div class="icons eye-icon">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/Icon_eye.svg" alt="voir la photo">
                    </a>
                </div>
                <div class="icons fullscreen-icon">
                    <a class="lighthousescreen">
                    <img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/fullscreen.svg" alt="voir la photo">
                    </a>
                </div>    
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





