  /**
   * @param {string} url Img URL
   * @return {HTMLElement}
   */


  (function($){


    $('.fullscreen-icon').each(function() {
      $(this).click(function() {
          console.log($(this).data('ref'));
          console.log($(this).data('cat'));

          $('.lightbox').css('display', 'block');
          $('#lightbox-image').prop('src', $(this).data('image-src')); 
          $('#ref').text($(this).data('ref')); 
          $('#cat').text($(this).data('cat'));
      });
    });

    $('.lightboxclose').each(function() {
    $(this).click(function() {
        $('.lightbox').css('display', 'none');
      });
    });

    


  })(jQuery)

