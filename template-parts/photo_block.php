<?php
/**
 * Template part for displaying photoblock in home & single-photo
 */

    $args_upsell = array(
        'post_type' => 'single-photo',
        'posts_per_page' => 2,
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
