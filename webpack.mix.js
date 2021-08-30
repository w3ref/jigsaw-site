const mix = require('laravel-mix');
require('laravel-mix-jigsaw');
require('laravel-mix-purgecss');

mix.disableNotifications();
mix.setPublicPath('source/assets/build');

mix.js('source/_assets/js/app.js', 'js')
    .vue()
    .less('source/_assets/less/main.less', 'css')
    .jigsaw()
    .options({
        postCss: [require('tailwindcss')],
    })
    .purgeCss({
        enabled: mix.inProduction(),
        content: 'source/**/*.{html,js,php,md,vue}',
        safelistPatterns: [/language/, /hljs/, /algolia/, /docsearch/, /ds-/],
    })
    .browserSync({
        server: 'build_local',
        files: ['build_local/**'],
    })
    .sourceMaps()
    .version();
