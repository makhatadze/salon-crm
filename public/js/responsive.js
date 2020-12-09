// php artisan serv

// show hide menu on small

const menuBtn = document.querySelector('#nav-menu-btn');
const navigationSm = document.querySelector('#navigation-sm');

menuBtn.addEventListener('click', ()=> {
    navigationSm.classList.toggle('shown')
});