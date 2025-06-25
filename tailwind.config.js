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
            scale: {
                '101': '1.01',
                '102': '1.02',
            },
            transitionProperty: {
                'height': 'height',
            }
        },
    },

    plugins: [
        forms,
        require('@tailwindcss/typography'),
    ],
};
