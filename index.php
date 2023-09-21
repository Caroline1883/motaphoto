<?php get_header(); ?>
<section class="hero">
<h1>Photographe Event</h1>
<?php

// Récupérer les médias attachés aux publications de type "photo"
$args = array(
    'post_type' => 'single-photo', 
    'post_status' => 'publish',
    'posts_per_page' => 1,
    'orderby' => 'rand',
);

$photo_post = new WP_Query($args);

if ($photo_post->have_posts()) {
    
    while ($photo_post->have_posts()) {
        $photo_post->the_post();
        $media = get_attached_media('image', get_the_ID());
        var_dump($media[0]);
        $image_url = wp_get_attachment_image_url($media[0]->ID, 'full');
    }


    // Afficher l'image dans la bannière "hero"
    echo '<img class="hero--img" src="' . esc_url($image_url) . '" alt="' . esc_attr(get_field('description')) . '">';

    // Réinitialiser la requête WP
    wp_reset_postdata();
}
?>


</section>

<section class="photolist">
    
    <div class="upsell_block">
        <?php echo get_template_part('template-parts/photo_block'); ?>
    </div>

    <div class="load">
        <button class="wpcf7-submit load-more">Charger plus</button>
    </div>

</section>


<?php get_footer(); ?>