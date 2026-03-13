// webpack.config.js
const Encore = require('@symfony/webpack-encore');

// Configuration manuelle si l'environnement n'est pas encore configuré
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // Répertoire où les assets compilés seront stockés
    .setOutputPath('public/build/')
    // Chemin public pour accéder aux fichiers compilés
    .setPublicPath('/build')
    //.setManifestKeyPrefix('build/') // utile pour les CDN ou sous-répertoires

    /*
     * ENTRÉES
     * Chaque entrée crée un fichier JS et un fichier CSS si le JS importe du CSS
     */
    .addEntry('app', './assets/app.js')

    // Optimisation : découpe en plusieurs fichiers pour mieux gérer le cache
    .splitEntryChunks()

    // Runtime séparé pour éviter les conflits
    .enableSingleRuntimeChunk()

    // Nettoyer le répertoire build avant compilation
    .cleanupOutputBeforeBuild()

    // Activer la compilation PostCSS (nécessaire pour Tailwind)
    .enablePostCssLoader()

    // Affiche les sourcemaps en dev
    .enableSourceMaps(!Encore.isProduction())

    // Versioning (hash dans le nom du fichier) en prod
    .enableVersioning(Encore.isProduction())

    // Configuration Babel pour compatibilité JS moderne
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.38';
    })

// Sass/SCSS si nécessaire
//.enableSassLoader()

// TypeScript si nécessaire
//.enableTypeScriptLoader()

// React si nécessaire
//.enableReactPreset()

// Intégrité des fichiers (intégrité subresource) si besoin
//.enableIntegrityHashes(Encore.isProduction())

// jQuery automatique si nécessaire
//.autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
