/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.html",
    "./*.php"
  ],
  theme: {
    extend: {
      colors: {
        AzulClaro: "#0D3559",
        NegroPrimario: '#000911',
        AzulOscuro: '#021526',
        BlancoPrimario: '#FCFFFF',
      },
      fontFamily: {
        patua: ['"Patua One"', 'cursive'],
        radio: ['"Radio Canada"', 'sans-serif'],
      },
    },
  },
  plugins: [],
}