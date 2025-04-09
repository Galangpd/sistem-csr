/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "node_modules/preline/dist/*.js",
        './node_modules/@fortawesome/fontawesome-free/**/*.{js,css}',
    ],
    theme: {
        fontFamily: {
            sans: ['Noto Sans JP', 'sans-serif'],
          },
        extend: {
            colors: {
                primary: "#003973",
                secondary: "#FFCC00",
            },
            keyframes: {
                "fade-in-right": {
                    "0%": {
                        opacity: 0,
                        transform: "translate3d(100%, 0, 0)",
                    },
                    "100%": {
                        opacity: 1,
                        transform: "translate3d(0, 0, 0)",
                    },
                },
                moveBg: {
                    "0%": { backgroundPosition: "0% 50%" },
                    "100%": { backgroundPosition: "100% 50%" },
                },
            },
            animation: {
                fadeinright: "fade-in-right 1s ease-in-out 0.25s 1",
                moveBg: "moveBg 2s linear infinite",
            },
        },
    },
    plugins: [
        require("flowbite/plugin", "tailwindcss-plugins/pagination", "preline/plugin"),
    ],
};
