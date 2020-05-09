let path = require('path');
let webpack = require('webpack');

const fs = require('fs');
const child_process = require('child_process');

module.exports = {
    entry: {
        'cms-shop-plugins': './resources/js/plugins.js',
    },
    output: {
        path: path.resolve(__dirname, './public/js/'),
        filename: '[name].js'
    },
    module: {
        rules: [
            {
                test: /\.(eot|woff|woff2|ttf)$/,
                loader: 'ignore-loader'
            },
            {
                test: /\.css$/,
                use: [
                    // 'vue-style-loader',
                    'style-loader',
                    'css-loader'
                ],
            },
            {
                test: /\.scss$/,
                use: [
                    // 'vue-style-loader',
                    'style-loader',
                    'css-loader',
                    'sass-loader'
                ],
            },
            {
                test: /\.sass$/,
                use: [
                    // 'vue-style-loader',
                    'style-loader',
                    'css-loader',
                    'sass-loader?indentedSyntax'
                ],
            },
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader",
                }
            },
            {
                test: /\.(png|jpe?g|gif|svg)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            publicPath: '/js/dist',
                            name: '[name].[ext]'
                        },
                    },
                ],
            },


            // {
            //     test: /\.(png|jpg)$/,
            //     loader: 'url-loader'
            // }
        ]
    },
    mode: 'development',
    devtool: 'source-map',
    // plugins: [
    //     new webpack.optimize.SplitChunksPlugin({
    //         name: "commons",
    //         filename: "commons.js",
    //     })
    // ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.js',
            jQuery: 'jquery',
        }
    },
    externals: {
        // require("jquery") is external and available
        //  on the global var jQuery
        "jquery": "jQuery"
    },
    plugins: [
        {
            apply: (compiler) => {
                compiler.hooks.afterEmit.tap('AfterEmitPlugin', (compilation) => {
                    child_process.exec('cd ../../../; php artisan vendor:publish --tag=public --force', (err, stdout, stderr) => {
                        if (stdout) process.stdout.write(stdout);
                        if (stderr) process.stderr.write(stderr);
                    });
                });
            }
        }
    ]
};
