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

document.addEventListener('DOMContentLoaded', function() {
    
const modalOverlay = document.querySelector('.popup-overlay');
const menuContact = document.querySelectorAll('.contact');
const fullScreen = document.querySelector('.fullscreen');
const menuCross = document.querySelector('.cross');
const menuToggle = document.querySelector('.hamburger');
menuContact.forEach(item => {
    item.onclick = function() {
        modalOverlay.style.display = "block";
        fullScreen.classList.add('inactive');
        menuCross.classList.add('inactive');
        menuToggle.classList.remove('inactive');
        
    }
})
console.log(menuContact);

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modalOverlay) {
        modalOverlay.style.display = "none";
    }
}

});


