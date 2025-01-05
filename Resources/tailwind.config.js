/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "class",
    content: [
        '../../../Public/Themes/Feather/**/*.{php,html,js}',
    ],
    theme: {
        extend: {
            fontFamily: {
                'lato': ['lato'],
            },
        },
    },
    plugins: [],
}
