// jQuery functions

(function($){

    // menu + modale

    $('.hamburger').on('click', function() {
        $("nav").css('display', 'flex');
        $('.hamburger').css('display', 'none');
        $('.cross').css('display', 'block');
    });

    $('.cross').on('click', function() {
        $("nav").css('display', 'none');
        $('.hamburger').css('display', 'block');
        $('.cross').css('display', 'none');
    });

    $('.contact').each(function() {
        $(this).click(function() {
            $('.popup-overlay').css('display', 'block');
            console.log(window.innerWidth);
            if (window.innerWidth <= 768) {
                $("nav").css('display', 'none');
                $('.cross').css('display', 'none');
                $('.hamburger').css('display', 'block');
            }
        });
    });
    
    $(window).click(function(event) {
        if (event.target == $('.popup-overlay')[0]) {
            $('.popup-overlay').css('display', 'none');
        }
        });

    if (window.innerWidth <= 768) {
        $('li').each(function(){
            $(this).click(function(){
                $("nav").css('display', 'none');
                $('.hamburger').css('display', 'block');
                $('.cross').css('display', 'none');
            });
        });
    }

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
                $('.load-more').css('cursor','wait');
            },
            success: function(response) {
                if (response && response.total_posts) {
                    response.photos.forEach(function(photo) {
                        $('.photolist .upsell_block').append(photo);
                    });
                    offsetHome += 12;
                    console.log(offsetHome);
                    console.log(response.total_posts);
                    if (offsetHome >= response.total_posts){
                        $('.load-more').hide();
                    }  
                } else {
                    $('.load-more').hide();
                }
            },
            complete: function(){
                $('#loader').hide();
                $('.load-more').css('cursor','auto');
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
