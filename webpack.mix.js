const { mix } = require('laravel-mix');

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
mix.copy('node_modules/vue-multiselect/dist/vue-multiselect.min.css', 'public/css/vue-multiselect.min.css');
mix.js('resources/assets/js/app.js','public/js/')
	.js('resources/assets/js/clientes.js','public/js/')
	.js('resources/assets/js/articulos.js','public/js/')
	.js('resources/assets/js/pedidos.js','public/js/')
	.sass('resources/assets/sass/app.scss', 'public/css');

if (mix.config.inProduction) {
	    mix.version();
	}
