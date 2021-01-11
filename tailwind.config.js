module.exports = {
  purge: [],
  theme: {

    extend: {
      colors: {
        'share-green': '#3ace3a',
        'vibrant': '#cc1166',
      },
      fontSize: {
  	  'sxs': '.55rem',
      'xxs': '.60rem',
      'md': '.950rem',
    },
   }
  },
  variants: {},
  plugins: [
      require("tailwindcss-hyphens")
  ],
}      