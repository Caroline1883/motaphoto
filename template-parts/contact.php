<?php
/**
 * Template part for contact modal
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

?>

<?php
// Pour plus tard ACF
// $titre=get_field('titre', 161);
// $description=get_field('description', 161);
// $lieu=get_field('lieu', 161);
// $date=get_field('date', 161);
// $lien=get_field('lien_google_maps', 161);
?>

<div class="popup-overlay">
	<div class="popup-contact">
		<div class="popup-header">
			<img src="<?php echo get_template_directory_uri() . '/assets/img/contactheader.svg'; ?>" alt="contact contact contact">
			<span class="popup-close">&#10006</span>
		</div>
		<div class="popup-form">
		<?php
		echo do_shortcode('[contact-form-7 id="600df83" title="Contact"]');
		?>
	</div>
</div>