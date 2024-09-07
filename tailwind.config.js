/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],
  theme: {
    extend: {
        margin: {
            '0-important': '0 !important',
        }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

