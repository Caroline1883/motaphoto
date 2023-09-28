// Header + Modale

document.addEventListener('DOMContentLoaded', function() {

    const menuToggle = document.querySelector('.hamburger');
    const menuCross = document.querySelector('.cross');
    const fullScreen = document.querySelector('.fullscreen');
    const menuLis = document.querySelectorAll('li')
    const modalOverlay = document.querySelector('.popup-overlay');
    const menuContact = document.querySelectorAll('.contact');

    menuToggle.addEventListener('click', toggleMenu);
    menuCross.addEventListener('click', toggleMenu);
       menuContact.forEach(item => {
            item.onclick = function() {
                modalOverlay.style.display = "block";
                fullScreen.classList.add('inactive');
                menuCross.classList.add('inactive');
                menuToggle.classList.remove('inactive');
               }
            });

    window.onclick = function(event) {
        if (event.target == modalOverlay) {
            modalOverlay.style.display = "none";
            }
        }
        
    function toggleMenu() {
        fullScreen.classList.toggle('inactive');
        menuCross.classList.toggle('inactive');
        menuToggle.classList.toggle('inactive');
        }
        
        function menuLiF() {
        fullScreen.classList.toggle('active');
        menuToggle.classList.toggle('active');
        }
        
        menuLis.forEach(menuLi => {
        menuLi.addEventListener('click', menuLiF);
        });

    }
);

  
// Navigation


// jQuery functions

(function($){

    // navigation
  
        if($('.navright').length){
            $('.navright').on('mouseenter', function(){
                $('.photoright').toggle('inactive');
            })
            $('.navright').on('mouseleave', function(){
                $('.photoright').toggle('inactive');
            })
        }

        if($('.navleft').length){
            $('.navleft').on('mouseenter', function(){
                $('.photoleft').toggle('inactive');
            })
            $('.navleft').on('mouseleave', function(){
                $('.photoleft').toggle('inactive');
            })
        }
    

    // reference requisition script
    $('#ref-photo').val($('#refer h4').text().trim()); 

    // Loading buttons
    // Loading button home
    let offsetHome = 12; 
    $('.load-more').on('click', function() {
        $.ajax({
            type: 'POST',
            url: ajax_data.ajaxurl, 
            data: {
                action: 'load_more_photos',
                offset: offsetHome,
            },
            beforeSend: function(){
                $('#loader').show();
            },
            success: function(response) {
                if (response.length > 0) {
                    response.forEach(function(photo) {
                        $('.photolist .upsell_block').append(photo);
                    });
                    offsetHome += 12;  
                } else {
                    $('.load-more').hide();
                }
            },
            complete: function(){
                $('#loader').hide();
            },
        });
    });

    // Loading button single photo
    let offset = 3;
    $('.load-all').on('click', function() {
        console.log($(this).data('current-post-cat-id'));

        $.ajax({
            type: 'POST',
            url: ajax_data.ajaxurl, 
            data: {
                action: 'load_all_photos',
                offset: offset,
                currentPostCatID: $(this).data('current-post-cat-id'),
            },
            success: function(response) {
                if (response.length > 0) {
                    response.forEach(function(photo) {
                        $('.upsell .upsell_block').append(photo);
                    });

                    offset += response.length;
                    var totalPhotos = response.length;

                    if (offset >= totalPhotos) {
                        $('.load-all').hide();
                    }

                } else {
                    $('.load-all').hide();
                }
            },
        });
    });

    // Filters Orders
    // $.ajax({
    //     type: 'POST',
    //     url: ajax_data.ajaxurl,
    //     data: {
    //         action: 'get_photo_formats',
    //     },
    //     success: function(response) {
    //          $('#format').append(response);
    //     },
    // });

    // $.ajax({
    //     type: 'POST',
    //     url: ajax_data.ajaxurl,
    //     data: {
    //         action: 'get_photo_cats',
    //     },
    //     success: function(response) {
    //          $('#category').append(response);
    //     },
    // });

        function filterPhotos() {
            $.ajax({
                type: 'POST',
                url: ajax_data.ajaxurl,
                data: {
                    action: 'filter_photos',
                    format: $('#format').val(),
                    category: $('#category').val(),
                    order: $('#order').val(),
                },
                success: function(response) {
                    console.log('Réponse du serveur :', response);
                    if (response.length > 0) {
                        $('.upsell_block').empty();
                        $('.load-all').hide();
                        response.forEach(function(photo) {
                            $('.upsell_block').append(photo);
                        });
                    } else {
                        $('.load-all').hide();
                    }
                },
            });
        }
        $('select').each(function(){
            $(this).on('change', function(){
            filterPhotos();
        });
        });

})(jQuery)
