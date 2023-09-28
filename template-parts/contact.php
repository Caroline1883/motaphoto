<?php
/**
 * Template part for contact modal
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

?>



<div class="popup-overlay inactive">
	<div class="popup-contact">
		<div class="popup-header">
			<img src="<?php echo get_template_directory_uri() . '/assets/img/contactheader.svg'; ?>" alt="contact contact contact">
		</div>
		<div class="popup-form">
		<?php
		echo do_shortcode('[contact-form-7 id="600df83" title="Contact"]');
		?>
	</div>
</div>