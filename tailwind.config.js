/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        container: {
            padding: {
                DEFAULT: "15px",
            },
        },
        screens: {
            xs: "420px",
            sm: "576px",
            md: "768px",
            lg: "992px",
            xl: "1200px",
        },
        extend: {
            colors: {
                // jehem explore theme
                primary1: {
                    DEFAULT: "#146C94",
                },
                secondary1: {
                    DEFAULT: "#1E1E1E",
                },
                accent: {
                    DEFAULT: "#E1E1E1",
                    100: "#A8A8A8",
                },

                // jehem meadolan theme
                primary2: {
                    DEFAULT: "#948714",
                    100: "#1E1E1E",
                },
                secondary2: {
                    DEFAULT: "#ffff",
                    100: "#808080",
                    200: "#A8A8A8",
                    300: "#919191",
                },
                star1: {
                    100: "#146C94",
                    200: "#D9D9D9",
                },
                star2: {
                    100: "#FFC700",
                    200: "#948714",
                    300: "#D9D9D9",
                },
            },
            backgroundColor: {
                primary1: "#146C94",
                primary2: "#948714",
                grey: "#F3F3F3",
                'hover-primary': '#72680F'
        },
            fontFamily: {
                poppins: "Poppins",
                mont: "Montserrat Alternates",
            },
        },
    },
    plugins: [require("daisyui")],
    daisyui: {
        darkTheme: false,
    },
};
