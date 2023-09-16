<?php
/**
 * Template part created photoblock home & single-photo

 */

//  $terms = wp_get_post_terms(get_the_ID(), 'photocat'); // Remplacez 'votre_taxonomie' par le nom de votre taxonomie

// if ($terms) {
//     $term_ids = array();
//     foreach ($terms as $term) {
//         $term_ids[] = $term->term_id;
//     }


 $args_upsell = array(
    'post_type' => 'single-photo',
    'posts_per_page' => 2,
    'orderby' => 'date',
    'order' => 'ASC',
    'date_query' => array(
      'after' => get_the_date('Y-m-d H:i:s'),
    ),
    // 'tax_query' => array(
    //     array(
    //         'taxonomy' => 'photocat', // Remplacez 'votre_taxonomie' par le nom de votre taxonomie
    //         'field' => 'id',
    //         'terms' => $term_ids,
    //     ),
    // )
);

  $my_query = new WP_Query( $args_upsell);

  if($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
    echo '<div class="photo-container">';
    echo '<div class="photo_block"><img src="' . esc_url(get_field('file')) . '" alt="' . esc_attr(get_field('description')) . '"></div>';
    echo '
    <div class="icons">
    <span class="info-icon"><i class="fa fa-eye"></i></span>
    <span class="fullscreen-icon"><i class="fa fa-arrows-alt"></i></span>
    </div></div>';

endwhile;
endif;

wp_reset_postdata();



?>