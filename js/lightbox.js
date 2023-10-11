  /**
   * @param {string} url Img URL
   * @return {HTMLElement}
   */

  (function($) {

    let currentImageIndex = 0; 
    const lightboxlist = []; 
  

    function updateLightboxList() {
      lightboxlist.length = 0; 
  
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
  
  
    $(document).on('click', '.fullscreen-icon', function() {
      updateLightboxList(); 
      const index = $(this).data('index');
      openLightbox(index); 
    });
  

    $('.lightboxnext').on('click', function() {
      currentImageIndex++;
      if (currentImageIndex > lightboxlist.length - 1) {
        currentImageIndex = 0;
      }
      displayImage(currentImageIndex);
    });
  

    $('.lightboxprev').on('click', function() {
      currentImageIndex--;
      if (currentImageIndex < 0) {
        currentImageIndex = lightboxlist.length -1;
      }
      displayImage(currentImageIndex);
    });
  
    $('.lightboxclose').on('click', function() {
      $('.lightbox').css('display', 'none');
    });
  
  })(jQuery);
  