const hamburger = document.querySelector(".hamburger");
const sideNav = document.querySelector(".side-nav");
const wrapper = document.querySelector(".wrapper");
const navbar = document.querySelector("#nav");
const logoDark = document.querySelector("#logo");
let currentUrl = window.location.href;

hamburger.addEventListener("click", () => {
  wrapper.classList.toggle("active");
  sideNav.classList.toggle("active");
  if (hamburger.innerHTML !== `<i class="fas fa-times"></i>`) {
    hamburger.innerHTML = `<i class="fas fa-times"></i>`;
  } else {
    hamburger.innerHTML = `<i class="fas fa-bars"></i>`;
  }
});

//jquery
// back to top button
let btn = $("#button");

$(window).scroll(function () {
  if ($(window).scrollTop() > 300) {
    btn.addClass("show");
  } else {
    btn.removeClass("show");
  }
});

btn.on("click", function (e) {
  e.preventDefault();
  $("html, body").animate({ scrollTop: 0 }, "300");
});

// fixed navbar
if (navbar) {
  window.addEventListener("scroll", fixNav);
}

function fixNav() {
  if (window.scrollY > navbar.offsetHeight + 200) {
    if (logoDark) {
      logoDark.innerHTML = `<img src="assets/img/logo2_dark.png" alt="logo">`;
    }
    navbar.classList.add("sticky");
  } else {
    if (currentUrl.includes("about")) {
      if (logoDark) {
        logoDark.innerHTML = `<img src="assets/img/logo2_light.png" alt="logo">`;
      }
    }
    navbar.classList.remove("sticky");
  }
}
