const mix = require('laravel-mix');

// Configuração básica e eficiente
mix.js('resources/js/app.js', 'public/js')
   .sass('public/default/css/custom.scss', 'public/default/css/custom.css')
   .sourceMaps(true, 'source-map') // Ativa source maps de alta qualidade
   .options({
     processCssUrls: false // Importante para evitar problemas com caminhos
   });