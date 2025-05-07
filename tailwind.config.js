// tailwind.config.js
module.exports = {
    content: [
      './resources/views/**/*.blade.php',
      './resources/js/**/*.js',
      './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
      extend: {
        // aquí tus customizaciones
      },
    },
    plugins: [
      // ejemplo: require('@tailwindcss/forms'),
    ],
  }
  