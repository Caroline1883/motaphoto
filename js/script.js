console.log("coucou")

// Header

const menuToggle = document.querySelector('.hamburger');
const menuCross = document.querySelector('.cross');
const fullScreen = document.querySelector('.fullscreen');
const menuLis = document.querySelectorAll('li');

document.addEventListener('DOMContentLoaded', function () {
    menuToggle.addEventListener('click', toggleMenu);
    menuCross.addEventListener('click', toggleMenu);
});

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

// Modal Contact

function isMobileScreen() {
    return window.innerWidth <= 768; 
  }


document.addEventListener('DOMContentLoaded', function() {
    
const modalOverlay = document.querySelector('.popup-overlay');
const menuContact = document.querySelector('.contact');
// const modalCross = document.querySelector('.popup-close');

menuContact.onclick = function() {
    modalOverlay.style.display = "block";
}

// modalCross.onclick = function() {
//     modalOverlay.style.display = "none";
// }

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modalOverlay) {
        modalOverlay.style.display = "none";
    }
}

});


