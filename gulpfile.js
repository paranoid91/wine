var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir.config.sourcemaps = false;
elixir(function(mix) {
    mix.sass(['admin/fonts.scss','admin/main.scss','admin/auth.scss','admin/product.scss','admin/chosen.scss','admin/dash.scss','admin/inspection.scss'],'public/admin/css/styles.css'); // admin styles file
    mix.sass(['frontend/slider.scss','frontend/fonts.scss','frontend/main.scss','frontend/nav.scss','frontend/footer.scss','frontend/post.scss','frontend/events.scss','frontend/companies.scss','frontend/chosen.scss','frontend/products.scss','frontend/manage.scss','frontend/responsive.scss'],'public/frontend/css/styles.css'); // front styles file
    mix.sass(['jury/main.scss','jury/products.scss'],'public/jury/css/styles.css'); // admin styles file
    mix.scripts(['admin/ajax.js','admin/custom.js'],'public/admin/js/functions.js'); // admin javascript
    mix.scripts(['frontend/ajax.js','frontend/custom.js'],'public/frontend/js/functions.js'); // admin javascript
    mix.scripts(['frontend/megamedia.jquery.js'],'public/frontend/js/megamedia.jquery.min.js'); // admin javascript
    mix.scripts(['frontend/inputmask.js'],'public/lib/inputmask/inputmask.min.js'); // front
    mix.scripts(['frontend/chosen.js'],'public/lib/bootstrap/tags/chosen.min.js'); // front
});
