var ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
    entry: [
      './node_modules/babel-polyfill/dist/polyfill.min.js',
      './assets/js/main.js',
      './assets/stylesheets/style.scss',
      ],
    watch: true,
    output: {
        filename: './assets/js/app.bundle.js'
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: ExtractTextPlugin.extract({
                    use: ['css-loader?importLoaders=1'],
                }),
            },
            {
                test: /\.(sass|scss)$/,
                use: ExtractTextPlugin.extract({
                    use: ['css-loader?sourceMap', 'sass-loader']
                })
            },
            {
              test: /\.(png|jpeg|ttf|...)$/,
              use: [
               { loader: 'url-loader' }
               // limit => file.size =< 8192 bytes ? DataURI : File
              ]
            },
            {
              test: /\.js$/,
              exclude: /node_modules/,
              use: {
                loader: 'babel-loader',
                options: {
                  presets: ['es2015']
                }
              }
            }
        ]
    },
    plugins: [
        new ExtractTextPlugin({
            filename: './style.css',
            allChunks: true,
        }),
    ]
};
