  /**
   * @param {string} url Img URL
   * @return {HTMLElement}
   */

  //openLightbox

  (function($) {

    function openLightbox(imageSrc, ref, cat) {
      $('.lightbox').css('display', 'block');
      $('#lightbox-image').prop('src', imageSrc);
      $('#ref').text(ref);
      $('#cat').text(cat);
    }

    $(document).on('click', '.fullscreen-icon', function() {
      var imageSrc = $(this).data('image-src');
      var ref = $(this).data('ref');
      var cat = $(this).data('cat');
      openLightbox(imageSrc, ref, cat);
    });
  
    $(document).on('click', '.lightboxclose', function() {
      $('.lightbox').css('display', 'none');
    });
  
    const lightboxlist = [];
    $('.fullscreen-icon').each(function() {
      lightboxlist.push({
        src: $(this).data('image-src'),
        cat: $(this).data('cat'),
        ref: $(this).data('ref'),
        index: $(this).data('index')
      });
    });
    console.log(lightboxlist);
  })(jQuery);
  
