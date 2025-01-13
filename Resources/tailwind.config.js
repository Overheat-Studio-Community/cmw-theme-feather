/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "class",
    content: [
        '../../../Public/Themes/Feather/**/*.{php,html,js}',
    ],
    theme: {
        extend: {
            fontFamily: {
                'Lato': ['Lato'],
            },
            colors: {
                customGray: '#333333',
                sectionGray: '#878787'
            },
        },
    },
    plugins: [],

}
