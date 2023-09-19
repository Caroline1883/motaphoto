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

document.addEventListener('DOMContentLoaded', function() {
    const navRight = document.querySelector('.navright');
    const navLeft = document.querySelector('.navleft');
    const photoRight = document.querySelector('.photoright');
    const photoLeft = document.querySelector('.photoleft');

    navRight.addEventListener('mouseenter', function() {
    photoRight.classList.toggle('inactive');
    });

    navRight.addEventListener('mouseleave', function() {
    photoRight.classList.toggle('inactive');
    });

    navLeft.addEventListener('mouseenter', function() {
    photoLeft.classList.toggle('inactive');
    });
    
    navLeft.addEventListener('mouseleave', function() {
    photoLeft.classList.toggle('inactive');
    });

});

// Ref recuperation

jQuery(document).ready(function() {
    var acfValue = jQuery('#refer h4').text().trim(); 
    jQuery('#ref-photo').val(acfValue).change(); 
});

// Boutons chargements

jQuery(document).ready(function($) {
    var offset = 12; // A variabiliser pour la photo

    $('.load').on('click', function() {
        
        $.ajax({
            type: 'POST',
            url: ajaxurl, 
            data: {
                action: 'load_more_photos',
                offset: offset,
            },
            success: function(response) {
                console.log(response);

                if (response.length > 0) {
                    response.forEach(function(photo) {
                        // Créez et ajoutez les éléments HTML pour chaque photo
                    });

                    offset += 12; // For next request
                } else {
                    // If no photo
                    $('.load').hide();
                }
            },
        });
    });
});


