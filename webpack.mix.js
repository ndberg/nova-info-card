let mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')

mix
    .setPublicPath('dist')
    .js('resources/js/card.js', 'js')
    .vue({version: 3})
    .postCss('resources/css/card.css', 'dist/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')]
    })
