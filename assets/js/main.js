const hamburger = document.querySelector('.hamburger');
const sideNav = document.querySelector('.side-nav');
const wrapper = document.querySelector('.wrapper');

hamburger.addEventListener('click', () => {
    wrapper.classList.toggle('active');
    sideNav.classList.toggle('active');
    if (hamburger.innerHTML !== `<i class="fas fa-times"></i>`) {
        hamburger.innerHTML = `<i class="fas fa-times"></i>`;
    } else {
        hamburger.innerHTML = `<i class="fas fa-bars"></i>`;
    }
})