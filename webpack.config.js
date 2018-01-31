var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // .enableVersioning(Encore.isProduction())
    .addEntry('js/global', './assets/js/global.js')
    .addStyleEntry('css/global', './assets/css/global.scss')

    .enableSassLoader(function(sassOptions) {}, {
        resolveUrlLoader: false
    })
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
