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
                // Diamond blue palette (white + diamond blue)
                diamond: {
                    50: '#F3F8FF',
                    100: '#E6F0FF',
                    200: '#BFDEFF',
                    300: '#99CCFF',
                    400: '#4DAAFF',
                    500: '#0B66FF', // main diamond-blue
                    600: '#0959E6',
                    700: '#084BCB',
                    800: '#0639B3',
                    900: '#042A91',
                },
            },
        },
    },

    plugins: [forms],
};
