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
	<div class="popup-salon">
		<div class="popup-header">
			<h3>coucou</h3>
			<span class="popup-close"><i class="fa fa-times"></i></span>
		</div>
		
		<div class="popup-details">
			<div class="popup-address">
				<p><b>Le lieu</b></p>
				<a class="popup-link" href="#" target="_blank">Voir sur Google Maps</a>
			</div>
			<div class="popup-address">
				<p><b>La date</b></p>
			</div>
		</div>
		<p class="popup-informations">Vous souhaitez plus d'informations concernant cet événement ?</p>
		<?php
		// On insère le formulaire de demandes de renseignements
		// echo do_shortcode('[contact-form-7 id="910" title="Formulaire salon New York"]');
		?>
	</div>
</div>