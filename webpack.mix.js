const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const autoprefixer = require('autoprefixer');
const path = require('path');


mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        postCss: [
            require('postcss-import'),
            tailwindcss('./postcss.config.js'),
            autoprefixer,
        ]
    });

module.exports = {
    // ... other config
    module: {
        rules: [{
                test: /\.vue$/,
                loader: 'vue-loader',
            },
            {
                test: /\.(png|jpe?g|gif|svg)$/i,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: '[name].[ext]',
                        outputPath: 'images/',
                        publicPath: '/images/',
                    },
                }],
            }
        ],

    },
};
