<section class="singlephoto">
  <div class="photo">
    <div class="meta">
      <div class="meta--data">
        <h1><?= the_title(); ?></h1>
        <ul>
          <li><h4>Référence : <?= get_field('ref');?></h4></li>
          <li><h4>Format : 
            <?php
            $format_id = get_field('format');
            if ($format_id) {
              $format_term = get_term($format_id); 
              if (is_object($format_term) && property_exists($format_term, 'name')) {
                $format_label = $format_term->name;
                echo esc_html($format_label);
              } else {
                echo 'Aucune référence définie';
              }
            } else {
              echo 'Aucune référence définie'; 
            } 
            ?>
          </h4></li>
          <li><h4>Catégorie :
            <?php 
            $photocat_id = get_field('photocat');
            if ($photocat_id) {
              $photocat_term = get_term($photocat_id); 
              if (is_object($photocat_term) && property_exists($photocat_term, 'name')) {
                $photocat_label = $photocat_term->name;
                echo esc_html($photocat_label);
              } else {
                echo 'Aucune référence définie';
              }
            } else {
              echo 'Aucune référence définie'; 
            }
            ?>
          </h4></li>
          <li><h4>Type : <?= the_field('type'); ?></h4></li>
          <li><h4>Année : <?= get_the_date('Y'); ?></h4></li>
        </ul>
      </div>
    </div>
    <div class="pic">
      <img src="<?= esc_url(get_field('file')); ?>" alt="<?= esc_attr(get_field('description')); ?>">
    </div>
  </div>
  <div class="contactnav">
    <div class="contact">
      <p>Cette photo vous intéresse ?</p>
      <button class="wpcf7-submit">Contact</button>
    </div>

  <div class="photonav">
    <div class="photonav--photo">
      <?php
      // Previous photo
      $args_previous = array(
        'post_type' => 'single-photo',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
        'date_query' => array(
          'before' => get_the_date('Y-m-d H:i:s'),
        ),
      );

      $query_previous = new WP_Query($args_previous);

      if ($query_previous->have_posts()) {
        $previous_exist = true;

        while ($query_previous->have_posts()){
          $query_previous->the_post();
          $previous_image_url = esc_url(get_field('file'));
          echo '<a href="' . esc_url(get_permalink()) . '"><img src="' . $previous_image_url . '" class="photoleft" ></a>';
        }


        wp_reset_postdata();
      }

      // Next photo
      $args_next = array(
        'post_type' => 'single-photo',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'ASC',
        'date_query' => array(
          'after' => get_the_date('Y-m-d H:i:s'),
        ),
      );

      $query_next = new WP_Query($args_next);

      if ($query_next->have_posts()) {
        $next_exist = true;

        while ($query_next->have_posts()){
          $query_next->the_post();
          $next_image_url = esc_url(get_field('file'));
          echo '<a href="' . esc_url(get_permalink()) . '"><img src="' . $next_image_url . '" class="photoright" ></a>';
        }


        wp_reset_postdata();
      }
      ?>
    </div>

    <div class="photoarrows">
  
    <?php
      $previous_post = get_previous_post();
      if (!empty($previous_post)) {
      $previous_post_url = get_permalink($previous_post);
    ?>
    <a class="navleft" href="<?php echo esc_url($previous_post_url); ?>"><img src="<?php echo esc_url(get_template_directory_uri()) . '/assets/img/left.png'; ?>" alt="Navigation gauche"></a>
    <?php } ?>

    <?php
      $next_post = get_next_post();
      if (!empty($next_post)) {
      $next_post_url = get_permalink($next_post);
    ?>
    <a class="navright" href="<?php echo esc_url($next_post_url); ?>"><img src="<?php echo esc_url(get_template_directory_uri()) . '/assets/img/right.png'; ?>" alt="Navigation droite"></a>
    <?php } ?>
  
  </div>

    </div>   

  </div>
</section>

<section class="upsell">
  <h4>Vous aimerez aussi</h4>
  <div></div>
</section>
