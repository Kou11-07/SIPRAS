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
                // Ganti font default sans dengan Montserrat
                'sans': ['Montserrat', 'system-ui', 'sans-serif'],

                // Atau buat custom font family
                'montserrat': ['Montserrat', 'sans-serif'],
            },
        },
    },
    plugins: [],
}