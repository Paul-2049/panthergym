const html = document.documentElement;
const body = document.body;
const pageWrapper = document.querySelector('.page');
const header = document.querySelector('.header');
const firstScreen = document.querySelector('[data-observ]');
const burgerButton = document.querySelector('.burger-js');
const closeButton = document.querySelector('.close-js');
const menu = document.querySelector('.nav-js');
const lockPaddingElements = document.querySelectorAll('[data-lp]');

export {
  html,
  body,
  pageWrapper,
  header,
  firstScreen,
  burgerButton,
  closeButton,
  menu,
  lockPaddingElements,
};
