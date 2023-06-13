const mix = require('laravel-mix');
mix.sourceMaps();

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('node_modules/popper.js/dist/popper.js', 'public/js').sourceMaps()
    .js('node_modules/jquery/dist/jquery.min.js', 'public/js')
    .js('node_modules/bootstrap-vue/dist/bootstrap-vue.js', 'public/js')
    .js('node_modules/sweetalert2/src/sweetalert2.js', 'public/js')

    .sass('resources/sass/app.scss', 'public/css')
    // .sass('resources/sass/sweetalert2.scss', 'public/css')
    // .sass('resources/sass/bootstrap.scss', 'public/css')

    .css('resources/css/app.css', 'public/css')
    // .css('resources/css/bootstrap-vue.css', 'public/css')


    .copy('node_modules/@fortawesome/fontawesome-free/css/all.min.css', 'public/css/fontawesome.css')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts')

    .vue();
mix.disableSuccessNotifications();