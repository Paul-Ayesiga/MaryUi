import defaultTheme from 'tailwindcss/defaultTheme';
// import forms from '@tailwindcss/forms';
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/power-components/livewire-powergrid/resources/views/**/*.php',
        './vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php',
        './vendor/wire-elements/modal/resources/views/*.blade.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/spatie/laravel-support-bubble/config/**/*.php',
        './vendor/spatie/laravel-support-bubble/resources/views/**/*.blade.php',
    ],

     theme: {
         extend: {
             screens: {
                 sm: '480px',
                 md: '768px',
                 lg: '976px',
                 xl: '1440px',
             },
             colors: {
                 "pg-primary": colors.blue,
                 primary: {
                     "50": "#eff6ff",
                     "100": "#dbeafe",
                     "200": "#bfdbfe",
                     "300": "#93c5fd",
                     "400": "#60a5fa",
                     "500": "#3b82f6",
                     "600": "#2563eb",
                     "700": "#1d4ed8",
                     "800": "#1e40af",
                     "900": "#1e3a8a",
                     "950": "#172554"
                 }
             },
         },
     },

     plugins: [
         require('daisyui'),
     ],
      daisyui: {
          themes: ["cupcake", "dark", "cmyk"],
      },
};
