/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.php",
    "./includes/**/*.php",
    "./pages/**/*.php"
  ],
  theme: {
    extend: {
      colors: {
        clinicBlue: '#2563eb',    // Customize your theme colors
        clinicGray: '#f1f5f9',
      },
      fontFamily: {
        inter: ['Inter', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
