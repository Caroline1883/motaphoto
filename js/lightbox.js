  /**
   * @param {string} url Img URL
   * @return {HTMLElement}
   */

  (function($) {

    let currentImageIndex = 0; // Variable pour suivre l'indice de l'image actuelle
    const lightboxlist = []; // Tableau pour stocker les données des images
  
    // Fonction pour remplir ou mettre à jour le tableau lightboxlist
    function updateLightboxList() {
      lightboxlist.length = 0; // Vide le tableau actuel
  
      $('.fullscreen-icon').each(function(index) {
        const image = {
          src: $(this).data('image-src'),
          cat: $(this).data('cat'),
          ref: $(this).data('ref'),
          index: index
        };
        lightboxlist.push(image);
        console.log(image);
      });
    }
  
    // Fonction pour afficher l'image actuelle dans la lightbox
    function displayImage(index) {
      const image = lightboxlist[index];
      $('#lightbox-image').attr('src', image.src);
      $('#ref').text(image.ref);
      $('#cat').text(image.cat);
      currentImageIndex = index;
    }
  
    function openLightbox(index) {
      if (lightboxlist.length === 0) {
        return;
      }
      $('.lightbox').css('display', 'block');
      displayImage(index);
    }
  
    // Gestionnaire d'événement pour l'ouverture de la lightbox
    $(document).on('click', '.fullscreen-icon', function() {
      updateLightboxList(); // Mettre à jour le tableau lightboxlist
      const index = $(this).data('index');
      openLightbox(index); // Ouvrir la lightbox avec l'image sélectionnée
    });
  
    // Gestionnaire d'événement pour le bouton "suivante"
    $('.lightboxnext').on('click', function() {
      if (currentImageIndex < lightboxlist.length - 1) {
        displayImage(currentImageIndex + 1);
      }
    });
  
    // Gestionnaire d'événement pour le bouton "précédente"
    $('.lightboxprev').on('click', function() {
      if (currentImageIndex > 0) {
        displayImage(currentImageIndex - 1);
      }
    });
  
    // Gestionnaire d'événement pour la fermeture de la lightbox
    $('.lightboxclose').on('click', function() {
      $('.lightbox').css('display', 'none');
    });
  
  })(jQuery);
  