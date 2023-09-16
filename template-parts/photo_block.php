<?php
/**
 * Template part for displaying photoblock in home & single-photo
 */

// Obtenir les termes de la taxonomie 'photocat' associés à l'article actuel
$terms = wp_get_post_terms(get_the_ID(), 'photocat');

if (!empty($terms)) {
    // Initialiser un tableau pour stocker les IDs des termes
    $term_ids = array();

    // Parcourir les termes et extraire leurs IDs
    foreach ($terms as $term) {
        $term_ids[] = $term->term_id;
    }

    // Args de la requête pour récupérer les articles avec les termes de la taxonomie 'photocat'
    $args_upsell = array(
        'post_type' => 'single-photo',
        'posts_per_page' => 2,
        'orderby' => 'date',
        'order' => 'ASC',
        // 'tax_query' => array(
        //     array(
        //         'taxonomy' => 'photocat', // Remplacez par le nom de votre taxonomie
        //         'field' => 'id',
        //         'terms' => $term_ids,
        //     ),
        // ),
    );

    // Créer la requête personnalisée
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
} else {
    echo 'Aucun terme trouvé dans la taxonomie "photocat".';
}
?>

</div>
<div class="load">
    <button class="wpcf7-submit">Toutes les photos</button>
</div>
