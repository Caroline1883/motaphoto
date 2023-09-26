<section class="singlephoto">
  <div class="photo">
    <div class="meta">
      <div class="meta--data">
        <h1><?= the_title(); ?></h1>
        <ul>
          <li id="refer"><h4>Référence : <?= get_field('ref');?></h4></li>
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
      <?php
      $thumbnail_id = get_post_thumbnail_id();
      $photocat_term_id = get_field('photocat');
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
          $thumbnailprevious_id = get_post_thumbnail_id();
          if ($thumbnailprevious_id) {
            $imageprevious_info = wp_get_attachment_image_src($thumbnailprevious_id, 'full');
            $alt_text_previous = get_post_meta($thumbnailprevious_id, '_wp_attachment_image_alt', true);
            $previous_image_url = esc_url($imageprevious_info[0]); 
          } 

          echo '<a href="' . esc_url(get_permalink()) . '"><img src="' . $previous_image_url . '" class="photoleft inactive" alt="' .$alt_text_previous . '"></a>';
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
          $thumbnailnext_id = get_post_thumbnail_id();
          if ($thumbnailnext_id) {
            $imagenext_info = wp_get_attachment_image_src($thumbnailnext_id, 'full');
            $alt_text_next = get_post_meta($thumbnailnext_id, '_wp_attachment_image_alt', true);
            $next_image_url = esc_url($imagenext_info[0]); 
          } 

          echo '<a href="' . esc_url(get_permalink()) . '"><img src="' . $next_image_url . '" class="photoright inactive" alt="' .$alt_text_next . '"></a>';
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
    <a class="navleft" href="<?php echo esc_url($previous_post_url); ?>"><img src="<?php echo esc_url(get_template_directory_uri()) . '/assets/img/previous.svg'; ?>" alt="Navigation gauche"></a>
    <?php } else { ?>
    <a class="navleft inactive" href="#"><img src="<?php echo esc_url(get_template_directory_uri()) . '/assets/img/previous.svg'; ?>" alt="Navigation gauche"></a>
    <?php } ?>


    <?php
      $next_post = get_next_post();
      if (!empty($next_post)) {
      $next_post_url = get_permalink($next_post);
    ?>
    <a class="navright" href="<?php echo esc_url($next_post_url); ?>"><img src="<?php echo esc_url(get_template_directory_uri()) . '/assets/img/next.svg'; ?>" alt="Navigation droite"></a>
    <?php } else { ?>
    <a class="navright" href="<?php echo esc_url($next_post_url); ?>"><img src="<?php echo esc_url(get_template_directory_uri()) . '/assets/img/previous.svg'; ?>" alt="Navigation droite"></a>
    <?php } ?>
  
  </div>

    </div>   

  </div>
</section>

<section class="upsell">
  <div class="upselltitle"><h3>Vous aimerez aussi</h3></div>
  <div class="upsell_block"> <?php echo get_template_part('template-parts/photo_block'); ?></div>
  
  <div class="load">
  <button class="wpcf7-submit load-all" data-current-post-cat-id="<?php echo $photocat_term_id; ?>">Toutes les photos</button>
  </div>


</section>
