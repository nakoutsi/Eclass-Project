'use strict';

///////////////////////////////////////
// Variables
const menuLinksBox = document.querySelector('header .menu');
const menuLinks = document.querySelectorAll('header .menu li');
const header = document.querySelector('header');
const sliderSec = document.querySelector('.slider');
const openBtn = document.querySelector('header .openBtn');
const closeBtn = document.querySelector('header .closeBtn');
const body = document.querySelector('body');
const shadeContainer = document.querySelector('.shade-container');
const mainMenu = document.querySelector('header .flex-container');

///////////////////////////////////////
// Sticky navigation
const headerHeight = header.getBoundingClientRect().height;

const stickyNav = function (entries) {
  const [entry] = entries;
  if (!entry.isIntersecting) header.classList.add('sticky');
  else header.classList.remove('sticky');
};

const topObserver = new IntersectionObserver(stickyNav, {
  root: null,
  threshold: 0,
  rootMargin: `-${headerHeight}px`,
});
topObserver.observe(sliderSec);

///////////////////////////////////////
// Toggle menu

// Open menu function
const openMenu = function (e) {
  e.preventDefault();

  openBtn.classList.add('hidden');
  mainMenu.classList.add('active');
  closeBtn.classList.add('active');
  shadeContainer.classList.add('shade');
  header.classList.remove('sticky');
};
// Close menu function
const closeMenu = function (e) {
  e.preventDefault();

  openBtn.classList.remove('hidden');
  mainMenu.classList.remove('active');
  closeBtn.classList.remove('active');
  shadeContainer.classList.remove('shade');
  header.classList.add('sticky');
};

///////////////////////////////////////
// Page navigation
menuLinksBox.addEventListener('click', function (e) {
  e.preventDefault();

  if (e.target.classList.contains('nav-link')) {
    console.log(e.target);
    const id = e.target.getAttribute('href');
    document.querySelector(id).scrollIntoView({
      behavior: 'smooth',
    });
  }
});

///////////////////////////////////////
// Slider
const slider = function () {
  const slides = document.querySelectorAll('.slide');
  const navsContainer = document.querySelector('.slider .navigation');

  let curSlide = 0;
  let maxSlide = slides.length - 1;

  // Add background to slides
  slides.forEach((s, i) => {
    s.style.backgroundImage = `url('images/img_bg_${i + 1}.jpg')`;
    s.style.backgroundSize = 'cover';
  });

  // Functions
  const createNavs = function () {
    slides.forEach((_, i) => {
      navsContainer.insertAdjacentHTML(
        'beforeend',
        `<div class="navigation-btn" data-slide="${i}"></div>`
      );
    });
  };
  const activateNavs = function (slide) {
    document
      .querySelectorAll('.slider .navigation-btn')
      .forEach((btn) => btn.classList.remove('active'));
    document
      .querySelector(`.slider .navigation-btn[data-slide='${slide}']`)
      .classList.add('active');
  };
  const goToSlide = function (slide) {
    slides.forEach((s, i) => {
      s.style.transform = `translateY(${100 * (i - slide)}%)`;
    });
  };

  // Auto player
  const autoPlay = setInterval(function () {
    if (curSlide >= maxSlide) {
      curSlide = 0;
    } else {
      curSlide++;
    }
    activateNavs(curSlide);
    goToSlide(curSlide);
  }, 3000);

  // Initialize
  const init = function () {
    createNavs();
    activateNavs(0);
    goToSlide(0);
  };
  init();
};

slider();

///////////////////////////////////////
// Revealing sections on scroll
const revealOnScroll = function () {
  const allSections = document.querySelectorAll('section');

  const revealSection = function (entries, observer) {
    const [entry] = entries;
    if (!entry.isIntersecting) return;
    entry.target.classList.remove('section--hidden');

    observer.unobserve(entry.target);
  };

  const sectionObserver = new IntersectionObserver(revealSection, {
    root: null,
    threshold: 0.15,
  });

  allSections.forEach((sec) => {
    sectionObserver.observe(sec);
    sec.classList.add('section--hidden');
  });
};
revealOnScroll();
