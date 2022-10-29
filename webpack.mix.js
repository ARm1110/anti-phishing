let mix = require("./node_modules/laravel-mix");

mix.js("src/app.js", "dist").setPublicPath("dist");
