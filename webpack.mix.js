const mix = require('laravel-mix');
var LiveReloadPlugin = require('webpack-livereload-plugin');
require('laravel-mix-bundle-analyzer');

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

mix.webpackConfig({
    plugins: [
        new LiveReloadPlugin()
    ]
}).js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps();
}

// mix.bundleAnalyzer({analyzerMode: 'static'});
