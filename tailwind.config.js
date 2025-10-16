module.exports = {
  darkMode: 'class',
  content: [
    "./public/**/*.{php,html,js}",
    "./src/**/*.{php,html,js}",  
  ],
  theme: { extend: {} },
  plugins: [require("@tailwindcss/forms")],
};
