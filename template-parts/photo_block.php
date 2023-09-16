<?php
/**
 * Template part created photoblock home & single-photo

 */


 $args_next = array(
    'post_type' => 'single-photo',
    'posts_per_page' => 2,
    'orderby' => 'date',
    'order' => 'ASC',
    'date_query' => array(
      'after' => get_the_date('Y-m-d H:i:s'),
    ),
  );

  $my_query = new WP_Query( array( 'post_type' => 'single-photo'));

  if($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();

  echo '<div class="photo_block"><img src="' . esc_url(get_field('file')) . '" alt="' . esc_attr(get_field('description')) . '"></div>';


endwhile;
endif;

wp_reset_postdata();



?>