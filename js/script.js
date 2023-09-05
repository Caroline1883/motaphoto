console.log("coucou")

// Header

const menuToggle = document.querySelector('.hamburger');
const fullScreen = document.querySelector('.fullscreen');
const menuLis = document.querySelectorAll('li');

document.addEventListener('DOMContentLoaded', function () {
    menuToggle.addEventListener('click', toggleMenu);
});

function toggleMenu() {
    fullScreen.classList.toggle('active');
    menuToggle.classList.toggle('active');
}

function menuLiF() {
    fullScreen.classList.toggle('active');
    menuToggle.classList.toggle('active');
}

menuLis.forEach(menuLi => {
    menuLi.addEventListener('click', menuLiF);
});