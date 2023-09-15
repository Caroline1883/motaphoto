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


  
// Header + Modale

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