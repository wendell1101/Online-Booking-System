const hamburger = document.querySelector('.hamburger');
const sideNav = document.querySelector('.side-nav');
const wrapper = document.querySelector('.wrapper');
const navbar = document.querySelector('.main-nav')


hamburger.addEventListener('click', () => {
    wrapper.classList.toggle('active');
    sideNav.classList.toggle('active');
    if (hamburger.innerHTML !== `<i class="fas fa-times"></i>`) {
        hamburger.innerHTML = `<i class="fas fa-times"></i>`;
    } else {
        hamburger.innerHTML = `<i class="fas fa-bars"></i>`;
    }
})

//jquery
// back to top button
let btn = $('#button');

$(window).scroll(function() {
    if ($(window).scrollTop() > 300) {
        btn.addClass('show');
    } else {
        btn.removeClass('show');
    }
});

btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({ scrollTop: 0 }, '300');
});


