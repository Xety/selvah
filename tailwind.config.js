import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/**/*.php",
        "./config/*.php"
    ],

    theme: {
        extend: {
            fontFamily: {
                'selvah': ['Myriad Pro Regular'],
            },
        },
        container: {
            center: true
        }
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require("daisyui")
    ],

    daisyui: {
        themes: [
            {
                light: {
                    ...require("daisyui/src/theming/themes")["[data-theme=light]"],
                    primary: "#34b1c3",
                    "--rounded-box": "0.375rem",
                    "--rounded-btn": "0.25rem",
                    "--bc": "215 19% 35%",
                    "--pf": "188 59% 42%",
                    "--pc": "0 0% 100%"
                }
            }
        ],
    },

    // BYPASS TO COMPILE FULL CLASSES FOR DEV
    /*safelist: [
        {
          pattern: /./,
        }
    ],*/
};
