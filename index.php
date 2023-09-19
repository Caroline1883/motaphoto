<?php get_header(); ?>
<section class="hero">
<h1>Photographe Event</h1>
<?php

// Récupérer les médias attachés aux publications de type "photo"
$args = array(
    'post_type' => 'single-photo', 
    'post_status' => 'publish',
    'posts_per_page' => -1,
);

$photo_posts = new WP_Query($args);

if ($photo_posts->have_posts()) {
    // Créez un tableau pour stocker les ID des médias utilisés dans les publications "photo"
    $media_ids = array();

    while ($photo_posts->have_posts()) {
        $photo_posts->the_post();

        // Récupérer les médias attachés à chaque publication "photo"
        $media = get_attached_media('image', get_the_ID());

        // Ajouter les ID des médias au tableau
        foreach ($media as $attachment) {
            $media_ids[] = $attachment->ID;
        }
    }

    // Choisissez un ID de média au hasard parmi ceux stockés dans le tableau
    $random_media_id = $media_ids[array_rand($media_ids)];

    // Récupérer l'URL de l'image aléatoire
    $image_url = wp_get_attachment_image_url($random_media_id, 'full');

    // Afficher l'image dans la bannière "hero"
    echo '<img class="hero--img" src="' . esc_url($image_url) . '" alt="' . esc_attr(get_field('description')) . '">';

    // Réinitialiser la requête WP
    wp_reset_postdata();
}
?>


</section>
<?php get_footer(); ?>