module.exports = {
  darkMode: "class",
  content: [
    "./public/**/*.{php,html,js}",
    "./src/**/*.{php,html,js}",
    "./node_modules/flowbite/**/*.js",
  ],
  theme: { extend: {} },
  plugins: [
    require("@tailwindcss/forms"),
    require("daisyui"),
    require("flowbite/plugin"),
  ],
};
