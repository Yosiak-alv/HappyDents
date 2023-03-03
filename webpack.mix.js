const mix = require('laravel-mix');
const vuePlugin = require('laravel-mix-vue3');

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .webpackConfig({
        plugins: [vuePlugin],
    });
