import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'med-light': '#D6F3F4',
                'med-blue': '#74B3CE',
                'med-green': '#004346',
                'med-teal': '#508991',
                'med-dark': '#172A3A',
            },
        },
    },

    plugins: [forms],
};

