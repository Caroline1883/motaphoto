
   <section class="singlephoto">
      <div class="photo">
      <div class="meta">
          <div class="meta--data">
          <h1><?= the_title('<h1>', '</h1>'); ?></h1>
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
      <span>Cette photo vous intéresse ?</span>
      <button>Contact</button>
      </div>
      <div><p>navigation</p></div>
    </div>
    

    <section class="upsell">
      <h4>Vous aimerez aussi</h4>
      <div></div>
    </section>
   
