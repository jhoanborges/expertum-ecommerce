const mix = require('laravel-mix');

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


 mix.styles([
    'public/css/bootstrap.css',
    'public/css/style.css',
    'public/css/fontawesome-all.min.css',
    'public/plugins/OwlCarousel2-2.2.1/owl.carousel.css',
    //'public/pllCugins/Owarousel2-2.2.1/owl.theme.default.css',
    'public/plugins/OwlCarousel2-2.2.1/animate.css',
    'public/plugins/jquery-ui-1.12.1.custom/jquery-ui.css',
    'public/styles/shop_styles.css',
    'public/styles/shop_responsive.css',
    'public/css/card.css',
    'public/css/google-icons.css',
    'public/css/settings.css',
    'public/css/themify-icons.css',
    'public/css/flaticon.css',
    'public/css/responsive.css',
    'public/css/checkbox.css',
    'public/css/toastr.css',
    'public/css/captions-original.css',
    'public/css/pmd-scrollbar.css',
    'public/css/floating-wpp.min.css',
    'public/css/custom.css'
 ], 'public/css/all.css').version();


 mix.js([
    //'public/plugins/greensock/TweenMax.min.js',
    //'public/plugins/greensock/TimelineMax.min.js',
    //'public/plugins/scrollmagic/ScrollMagic.min.js',
    //'public/plugins/greensock/animation.gsap.min.js',
    //'public/plugins/greensock/ScrollToPlugin.min.js',
    //'public/plugins/OwlCarousel2-2.2.1/owl.carousel.js',
    //'public/plugins/easing/easing.js',
    //'public/plugins/Isotope/isotope.pkgd.min.js',
    'public/plugins/jquery-ui-1.12.1.custom/jquery-ui.js',
    //'public/plugins/parallax-js-master/parallax.min.js',
    //'public/js/jquery.themepunch.revolution.min.js',
    //'public/js/jquery.themepunch.tools.min.js',
    //'public/js/jquery.themepunch.plugins.min.js',
    //'public/js/theme.js',
    //'public/js/global.js',
    //'public/js/checkbox.js',
    //'public/js/toastr.min.js',
    //'public/js/jquery-migrate-1.4.1.min.js',
    //'public/js/shop_custom.js',
    //'public/js/floating-wpp.min.js',

 ], 'public/js/all.js');



mix.js('resources/js/app.js', 'public/js');
   //.postCss('resources/css/app.css', 'public/css').version();


//mix.js('resources/js/app.js', 'public/js').react();
 //  .sass('resources/sass/app.scss', 'public/css');

 if (process.env.APP_ENV == 'production') {
    mix.version();
 }
 