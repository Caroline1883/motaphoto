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

