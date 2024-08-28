/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                bodoni: ['"Bodoni Moda SC"', "serif"],
                poppins: ["Poppins", "sans-serif"],
            },
        },
    },
    plugins: [],
};
