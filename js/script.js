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

// Single photo navigation

document.addEventListener('DOMContentLoaded', function () {
    const prevThumbnail = document.querySelector('.photoleft');
    const nextThumbnail = document.querySelector('.photoright');
    const prevArrow = document.querySelector('.navleft');
    const nextArrow = document.querySelector('navright');
  
    // hover
    function handleHover(e) {
      prevThumbnail.style.display = 'none';
      nextThumbnail.style.display = 'none';
  
      if (e.target === prevArrow) {
        prevThumbnail.style.display = 'inline-block';
      } else if (e.target === nextArrow) {
        nextThumbnail.style.display = 'inline-block';
      }
    }
  
    // // navigation
    // function handleNavigation(e) {
    //   e.preventDefault();
  
    //   const action = e.target.getAttribute('data-action');
  
    //   // Effectuez la navigation en fonction de l'action (précédente ou suivante)
    //   if (action === 'previous') {
    //     // Code pour aller à la photo précédente
    //   } else if (action === 'next') {
    //     // Code pour aller à la photo suivante
    //   }
    // }
  
    // EventListener
    prevArrow.addEventListener('mouseenter', handleHover);
    nextArrow.addEventListener('mouseenter', handleHover);
  
    prevArrow.addEventListener('mouseleave', function () {
      prevThumbnail.style.display = 'none';
    });
    nextArrow.addEventListener('mouseleave', function () {
      nextThumbnail.style.display = 'none';
    });
  
    // prevArrow.addEventListener('click', handleNavigation);
    // nextArrow.addEventListener('click', handleNavigation);
  });
  







