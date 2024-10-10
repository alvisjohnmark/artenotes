/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                lpbgcolor: "#f5f0f1",
                lptxcolor: "#606c38",
                lptxcolorsemilight:"#7c8a4c",
                lptxcolorlight: "#a2b380",
                fmbtcolor: "#283618",
                bglightcolor: "#fefef0",
            },
            fontFamily: {
                playfair: ['Playfair Display', 'serif'],
                bebasneue: ["Bebas Neue, 'serif"]
            },
        },
    },
    plugins: [],
};
