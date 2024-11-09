/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,php}"],
  theme: {
    fontFamily: {
      viet: ["Be Vietnam Pro", "sans-serif"],
    },

    screens: {
      ms: "320px",
      // => @media (min-width: 320px) { ... }
      msix: "420px",
      // => @media (min-width: 500px) { ... }

      msi: "506px",
      // => @media (min-width: 500px) { ... }

      sm: "640px",
      // => @media (min-width: 640px) { ... }

      md: "768px",
      // => @media (min-width: 768px) { ... }
      mdd: "900px",

      mdi: "969px",

      lg: "1024px",
      // => @media (min-width: 1024px) { ... }

      xl: "1280px",
      // => @media (min-width: 1280px) { ... }

      xli: "1400px",
      // => @media (min-width: 1400px) { ... }

      "2xl": "1536px",
      // => @media (min-width: 1536px) { ... }

      "2xli": "1600px",
      // => @media (min-width: 1600px) { ... }

      "2xlix": "1700px",
      // => @media (min-width: 1700px) { ... }

      "2xlie": "1800px",
      // => @media (min-width: 1800px) { ... }

      "2xliex": "1920px",
      // => @media (min-width: 1800px) { ... }

      "3xl": "2000px",
      // => @media (min-width: 2100px) { ... }
    },

    extend: {
      backgroundSize: {
        auto: "auto",
        cover: "cover",
        contain: "contain",
        "50%": "50%",
        16: "4rem",
      },

      colors: {
        primary: "#101b20",
        secondary: "#E72F1A",
        accent3: "#cbcbcb",
        accent4: "#FAFAFA",
        accent5: "#1c272b",
        accent6: "#cccccc",
      },
    },
  },
  plugins: [],
}
