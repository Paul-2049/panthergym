/*
 !(i)
 Код попадает в итоговый файл, только когда вызвана функция, например FLSFunctions.spollers();
 Или когда импортирован весь файл, например import "files/script.js";
 Неиспользуемый (не вызванный) код в итоговый файл не попадает.

 Если мы хотим добавить модуль следует его расскоментировать
 */
import { isWebp, menuClose, menuInit } from './modules';
/* Раскомментировать для использования */
// import { MousePRLX } from './libs/parallaxMouse'
/* Раскомментировать для использования */
// import AOS from 'aos'
/* Раскомментировать для использования */
import Swiper, { Navigation, Pagination } from 'swiper'

// Включить/выключить FLS (Full Logging System) (в работе)
window['FLS'] = location.hostname === 'localhost';

/* Проверка поддержки webp, добавление класса webp или no-webp для HTML
 ! (i) необходимо для корректного отображения webp из css
 */
isWebp();
/* Добавление класса touch для HTML если браузер мобильный */
/* Раскомментировать для использования */
// addTouchClass();
/* Добавление loaded для HTML после полной загрузки страницы */
/* Раскомментировать для использования */
// addLoadedClass();
/* Модуль для работы с меню (Бургер) */
/* Раскомментировать для использования */
menuInit();
menuClose();


const swiper3 = new Swiper('.aboutSwiper', {
  slidesPerView: 3,
  breakpoints: {
    320: {
      slidesPerView: 1,
      spaceBetween: -50,
      loop: true,
    },
    675: {
      slidesPerView: 2,
      spaceBetween: -70,
      loop: false,
    },
    900: {
      slidesPerView: 3,
      spaceBetween: -70,
      loop: false,
    },
  },
});

const swiper = new Swiper('.trainerSwiper', {
  modules: [Navigation, Pagination],
  watchSlidesProgress: true,
  speed: 1000,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    320: {
      slidesPerView: 1,
      spaceBetween: -50,
      navigation: {
        enabled: false,
      },
    },
    425: {
      slidesPerView: 2,
      spaceBetween: -40,
      navigation: {
        enabled: false,
      },
    },
    767: {
      slidesPerView: 3,
      spaceBetween: -40,
      navigation: {
        enabled: true,
      },
    },
    1200: {
      slidesPerView: 4,
      spaceBetween: -70,
      navigation: {
        enabled: true,
      },
    },
  },
  autoplay: {
    delay: 5000,
  },
});

const swiper2 = new Swiper('.feedbackSwiper', {
  modules: [Navigation, Pagination],
  loop: true,
  speed: 1000,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  spaceBetween: 0,
  breakpoints: {
    320: {
      slidesPerView: 1,
      spaceBetween: 30,
      navigation: {
        enabled: false,
      },
    },
    890: {
      slidesPerView: 2,
      spaceBetween: 30,
      navigation: {
        enabled: true,
      },
    },
    1200: {
      slidesPerView: 4,
      spaceBetween: 30,
      navigation: {
        enabled: true,
      },
    },
  },
  autoplay: {
    delay: 5000,
  },
});

const bullet_product = new Swiper('.bullet-slider-product', {
  spaceBetween: 10,
  slidesPerView: 3,
  // freeMode: true,
  // watchSlidesProgress: true,
});
const mainProduct = new Swiper('.main-slider-product', {
  spaceBetween: 10,
  thumbs: {
    swiper: bullet_product,
  },
});

/* Библиотека для анимаций ===============================================================================
 *  документация: https://michalsnik.github.io/aos
 */
// AOS.init();
// =======================================================================================================

// Паралакс мышей ========================================================================================
// const mousePrlx = new MousePRLX({})
// =======================================================================================================

// Фиксированный header ==================================================================================
// headerFixed()
// =======================================================================================================

/* Открытие/закрытие модальных окон ======================================================================
 * Чтобы модальное окно открывалось и закрывалось
 * На окно повешай атрибут data-popup="<название окна>"
 * И на кнопку, которая вызывает окно так же повешай атрибут data-type="<название окна>"

 * На обертку(враппер) окна добавь класс _overlay-bg
 * На кнопку для закрытия окна добавь класс button-close
 */
/* Раскомментировать для использования */
// togglePopupWindows()
// =======================================================================================================
// accordeon =============================================================================================
var acc = document.getElementsByClassName("according-title");
var panels = document.getElementsByClassName("according-content");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function () {
    for (var j = 0; j < panels.length; j++) {
      if (panels[j] !== this.nextElementSibling) {
        panels[j].style.maxHeight = null;
        panels[j].previousElementSibling.classList.remove("active");
      }
    }

    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}

// tabs ==================================================================================================
document.addEventListener('DOMContentLoaded', () => {
  const tabsNav = document.querySelector('.tabs-nav');
  const activeTabDiv = document.querySelector('.active-tab');
  const tabs = document.querySelectorAll('[data-tab-target]');
  const tabContents = document.querySelectorAll('.tabs-content');
  if (activeTabDiv) {
    activeTabDiv.addEventListener('click', () => {
      tabsNav.classList.toggle('active');
    });
  }
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabsNav.classList.remove('active');
      const target = document.querySelector(tab.dataset.tabTarget);

      tabContents.forEach(tabContent => {
        tabContent.classList.remove('active');
      });

      tabs.forEach(tab => {
        tab.classList.remove('active');
      });

      tab.classList.add('active');
      target.classList.add('active');

      if (window.innerWidth < 1024) {
        const tabText = tab.textContent;
        activeTabDiv.textContent = tabText;
      }
    });
  });
});

// =======================================================================================================

jQuery(document).ready(function ($) {
  $('.tarif-js').on('click', function () {
    $('.tarif-options').removeClass('active');
    $(this).find('.tarif-options').toggleClass('active');
  });
  $('.sub-menu-js').on('click', function () {
    var subMenu = $(this).parent().find('.nav-sub-menu');
    var isActive = subMenu.hasClass('active');
    $('.nav-sub-menu').removeClass('active');
    if (!isActive) {
      subMenu.addClass('active');
    }
  });
  $('.search-btn-js').on('click', function (e) {
    e.preventDefault();
    $('.search-popup').addClass('active');
  });
  $('.open-filter').on('click', function (e) {
    e.preventDefault();
    $('.filter-js').addClass('active');
  });
  $('.filter-js .close').on('click', function (e) {
    e.preventDefault();
    $('.filter-js').removeClass('active');
  });
  $('.search--result-close-btn').on('click', function () {
    $('.search-popup').removeClass('active');
  });
});
// search =============================================================================================
function highlightTabsContent(searchText) {
  var tabItems = document.querySelectorAll('.tab-item');

  tabItems.forEach(function (tabItem) {
    var tabContentId = tabItem.getAttribute('data-tab-target');
    var tabContent = document.querySelector(tabContentId);

    if (tabContent) {
      var paragraphs = tabContent.querySelectorAll('p');

      paragraphs.forEach(function (paragraph) {
        var text = paragraph.textContent;
        var fragments = text.split(new RegExp('(' + searchText + ')', 'gi'));

        var fragmentElements = fragments.map(function (fragment) {
          if (fragment.toLowerCase() === searchText.toLowerCase()) {
            var span = document.createElement('span');
            span.className = 'highlighted';
            span.appendChild(document.createTextNode(fragment));
            return span;
          } else {
            return document.createTextNode(fragment);
          }
        });

        while (paragraph.firstChild) {
          paragraph.removeChild(paragraph.firstChild);
        }

        fragmentElements.forEach(function (fragmentElement) {
          paragraph.appendChild(fragmentElement);
        });
      });

      var isMatchFound = tabContent.querySelector('.highlighted');
      if (isMatchFound) {
        tabItem.classList.add('highlighted');
      } else {
        tabItem.classList.remove('highlighted');
      }
    }
  });
}
var searchInput = document.querySelector('.js-search-input');
// function handleKeyPress(event) {
//   if (event.key === 'Enter') {
//     var searchText = searchInput.value.trim();
//     highlightTabsContent(searchText);
//   }
// }
// searchInput.addEventListener('keydown', handleKeyPress);
var searchButton = document.querySelector('.js-search-btn');
if (searchButton) {
  searchButton.addEventListener('click', function () {
    var searchText = searchInput.value.trim();
    highlightTabsContent(searchText);
  });
}

// checkout page =================================================================================================
var shipToDifferentAddressCheckbox = document.getElementById('ship-to-different-address-checkbox');
var shippingAddress = document.querySelector('.shipping_address');

if (shipToDifferentAddressCheckbox) {
  shipToDifferentAddressCheckbox.addEventListener('change', function () {
    if (this.checked) {
      shippingAddress.style.display = 'block';
      shipToDifferentAddressCheckbox.parentElement.classList.add('active');
    } else {
      shippingAddress.style.display = 'none';
      shipToDifferentAddressCheckbox.parentElement.classList.remove('active');
    }
  });
}
// add to card single product ===================================================================================
const quantityInput = document.getElementById('quantityInput');
const increaseButton = document.getElementById('increaseQuantity');
const decreaseButton = document.getElementById('decreaseQuantity');

increaseButton.addEventListener('click', () => {
  let currentValue = parseInt(quantityInput.value);
  quantityInput.value = currentValue + 1;
});

decreaseButton.addEventListener('click', () => {
  let currentValue = parseInt(quantityInput.value);
  if (currentValue > 1) {  // Изменили условие на currentValue > 1
    quantityInput.value = currentValue - 1;
  }
});