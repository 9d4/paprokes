const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './resources/**/*.blade',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {},
    },

    plugins: [require('@tailwindcss/forms')],
};
