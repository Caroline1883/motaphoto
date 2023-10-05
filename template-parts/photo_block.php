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
                        echo '<img class="test" src="' . esc_url($image_info[0]) . '" alt="' . esc_attr($alt_text) . '" />';
                    } else {
                        echo '<p>Aucune image</p>';
                    }

                    $photocat_id = get_field('photocat');
                    $photocat_label = ''; 
    
                    if ($photocat_id) {
                        $photocat_term = get_term($photocat_id); 
                        if (is_object($photocat_term) && property_exists($photocat_term, 'name')) {
                            $photocat_label = $photocat_term->name;
                        }
                    }

                    $image_data = array(
                        'image_src' => esc_url($image_info[0]),
                        'ref' => get_field('ref'),
                        'cat' => esc_html($photocat_label), 
                    );

                    $images_data[] = $image_data;
                ?>
            </div>
            <div class="overlay">
                <div class="icons eye-icon">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/Icon_eye.svg" alt="voir la photo">
                    </a>
                </div>
                <div class="icons fullscreen-icon"
                data-image-src="<?= esc_url($image_data['image_src']) ?>"
                data-ref="<?= $image_data['ref'];?>"
                data-cat="<?= $image_data['cat']; ?>"
                data-index="<?= count($images_data) - 1; ?>"
                >
                    <img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/fullscreen.svg" alt="voir la photo">
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

                ?>
            </div>

            <div class="overlay">
                <div class="icons eye-icon">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/Icon_eye.svg" alt="voir la photo">
                    </a>
                </div>
                <div class="icons fullscreen-icon"
                data-image-src="<?= esc_url($image_data['image_src']) ?>"
                data-ref="<?= $image_data['ref'];?>"
                data-cat="<?= $image_data['cat']; ?>"
                data-index="<?= count($images_data) - 1; ?>"
                >
                    <img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/fullscreen.svg" alt="voir la photo">
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





