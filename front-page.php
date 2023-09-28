<?php get_header(); ?>
<section class="hero">
<h1>Photographe Event</h1>
<?php

// Random img
$args = array(
    'post_type' => 'single-photo', 
    'posts_per_page' => 1,
    'orderby' => 'rand',
);

$photo_post = new WP_Query($args);

if ($photo_post->have_posts()) {
    
    while ($photo_post->have_posts()) {
        $photo_post->the_post();
        $photo_post_id = get_post_thumbnail_id();
        if ($photo_post_id){
            $photo_post_id_info = wp_get_attachment_image_src($photo_post_id, 'full');
            $alt_text_photo_post = get_post_meta($photo_post_id_info, '_wp_attachment_image_alt', true);
            $photo_post_image_url = esc_url($photo_post_id_info[0]); 
        }
        echo '<img class="hero--img" src="' . esc_url($photo_post_image_url) . '" alt="' . $alt_text_photo_post . '">';

    }

    wp_reset_postdata();
}
?>

</section>

<section class="photolist">

    <div class="filters-order">

    <form id="photo-filters">

        <select name="category" id="category">
            <?php
                $photocats = get_terms('photocat', array('taxonomy' => 'photocat', 'fields' => 'names'));
                if (!empty($photocats)) {
                    echo '<option value="">Catégories</option>';
                    foreach ($photocats as $photocat) {
                    echo '<option value="' . $photocat . '">' . $photocat . '</option>';
                    }
                }
            ?>
        </select>

        <select name="format" id="format">
            <?php
               $formats = get_terms('format', array('taxonomy' => 'format', 'fields' => 'names'));
               if (!empty($formats)) {
                   echo '<option value="">Formats</option>';
                   foreach ($formats as $format) {
                   echo '<option value="' . $format . '">' . $format . '</option>';
                   }
               }
            ?>
        </select>

    </form>

    <form id="photo-order">

        <select name="order" id="order">
            <option value="asc">Trier par</option>
            <option value="asc">Des plus récentes aux plus anciennes </option>
            <option value="des">Des plus anciennes aux plus récentes </option>
        </select>
    </form>

    </div>
    
    <div class="upsell_block">
        <?php echo get_template_part('template-parts/photo_block'); ?>
    </div>

    <div class="load">
        <button class="wpcf7-submit load-more">Charger plus</button>
    </div>

</section>


<?php get_footer(); ?>