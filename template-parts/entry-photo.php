
   <section class="singlephoto">
      <div class="photo">
      <div class="meta">
          <div class="meta--data">
          <?= the_title('<h1>', '</h1>'); ?>
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
            <li><h4>Année : <?= the_date('Y'); ?></h4></li>
          </ul>
        </div>
      </div>
      <div class="pic">
        <img src="<?= the_field('file'); ?>" alt="<?= the_field('description'); ?>">
      </div>
    </div>
    <div class="contactnav">
      <div class="contact">
      <p>Cette photo vous intéresse ?</p>
      <button class="wpcf7-submit">Contact</button>
      </div>
      <?php

      //Previous photo
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
      echo '<div class="photonav">';
      $previous_exist = true;

      while ($query_previous->have_posts()){
        $query_previous->the_post();
        $previous_image_url = get_field('file');
        echo '<a href="' . get_permalink() . '"><img src="' . $previous_image_url . '" class="navigation-photos" ></a>';

      }
      echo '</div>';

      wp_reset_postdata();
      }

      //Next photo
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
      echo '<div class="photonav">';
      $next_exist = true;

    while ($query_next->have_posts()){
      $query_next->the_post();
      $next_image_url = get_field('file');
      echo '<a href="' . get_permalink() . '"><img src="' . $next_image_url . '" class="navigation-photos" ></a>';

    }
    echo '</div>';

    wp_reset_postdata();

    }
      ;
      ?>
    
        
      <div class="photoarrows">

          <?php if (isset($next_exist)){?>
            <img class="navright" src="<?php echo get_template_directory_uri() . '/assets/img/right.png'; ?>" alt="Navigation droite">
          <?php }?>


          <?php if (isset($previous_exist)){?>
            <img class="navleft" src="<?php echo get_template_directory_uri() . '/assets/img/left.png'; ?>" alt="Navigation gauche">
          <?php }?>  
          
        </div>
      </div>
    </div>
  </section>  

    <section class="upsell">
      <h4>Vous aimerez aussi</h4>
      <div></div>
    </section>
   