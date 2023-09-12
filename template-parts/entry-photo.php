
   <section class="photo">
    <div class="meta">
      <h1><?= the_title('<h1>', '</h1>'); ?></h1>
      <ul>
         <li><h4>Référence : <?= the_field('ref'); ?></h4></li>
         <li><h4>Format : <?= the_field('format'); ?></h4></li>
         <li><h4>Catégorie : <?= the_field('cat'); ?></h4></li>
         <li><h4>Type : <?= the_field('type'); ?></h4></li>
         <li><h4>Année : <?= the_date('Y'); ?></h4></li>
      </ul>
    </div>
    <div class="pic">
      <img src="<?= the_field('file'); ?>" alt="<?= the_field('file'); ?>">
    </div>
    <div class="contact">
      <span>Cette photo vous intéresse ?</span>
      <button>Contact</button>
    </div>
    <div><p>navigation</p></div>

    <section class="upsell">
      <h4>Vous aimerez aussi</h4>
      <div></div>
    </section>
   
