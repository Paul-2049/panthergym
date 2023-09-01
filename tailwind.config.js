/** @type {import('tailwindcss').Config} */
export default {
  content: [ './src/**/*.{html,scss,js}' ],
  theme: {
    screens: {
      'xs': '375px',
      'sm': '576px',
      'bm': '640px',
      'md': '768px',
      'ml': '992px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
      'xxl': '1920px',
    },
    container: {
      screens: {
        'xl': '1180px',
      },
    },
    extend: {
      colors: {
        "panther-red": {
          100: "#E10A17",
          200: "#FF0000",
        },
        "panther-white": {
          100: "#F5F4F4",
          200: "#828282",
          300: "#BCBCBC",
        },
        "panther-grey": {
          100: "#252525",
          200: "#4B4B4B",
          300: "#101010",
          400: "#131313",
          500: "rgba(17, 17, 17, 0.00)",
          600: "#0C0C0C",
          700: "#F4F4F4",
          800: "#F0F0F0",
          900: "#646464",
        },
      },
      backgroundImage: {
        'red-bg': "url('../images/main-red-bg.png')",
        'checkbox-woo': "url('../images/checkbox-woo.svg')",
        'swiper-next': "url('../images/swiper-next.svg')",
        'swiper-prev': "url('../images/swiper-prev.svg')",
        'skew-bg-red': "url('../images/skew-bg-red.png')",
        'bg-btn-secondary': "url('../images/bg-btn-secondary.png')",
        'btn-bg-primary': "url('../images/btn-bg-primary.svg')",
        'after-btn-secondary': "url('../images/after-btn-secondary.svg')",
        'checkmark-white': "url('../images/checkmark-white.svg')",
        'arrow-red': "url('../images/arrow-red.svg')",
        'arrow-white': "url('../images/arrow-white.svg')",
        'border': "url('../images/line.svg')",
        'accordion-icon': "url('../images/accordion-icon.svg')",
        'grey-gradient': "linear-gradient(180deg, #131313 0%, rgba(17, 17, 17, 0.00) 100%);",
        'grey-black-gradient': "linear-gradient(180deg, rgba(0,0,0, 0) 10%, #101010 10%)",
        'black-darkgray-gradient': "linear-gradient(180deg, #232323, rgba(0,0,0, 1))",
        'black-100-gradient': "linear-gradient(180deg, #0C0C0C 0%, rgba(17, 17, 17, 0.00) 100%)",
      },
      boxShadow: {
        'card-shadow': '0px 0px 40px 0px rgba(0, 0, 0, 0.16)',
        'item-shadow': '0px 0px 40px 0px rgba(0, 0, 0, 0.70)',
      }
    },
    fontFamily: {
      'base': 'Rajdhani, sans-serif',
      'privacy': 'Open Sans, sans-serif',
    }
  },
};
