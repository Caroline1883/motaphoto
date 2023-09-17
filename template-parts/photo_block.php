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
                <div class="icons">
                    <span class="info-icon"><i class="fa fa-eye"></i></span>
                    <span class="fullscreen-icon"><i class="fa fa-arrows-alt"></i></span>
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
