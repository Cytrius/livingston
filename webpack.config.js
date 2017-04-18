var path = require('path');
var merge = require('webpack-merge');

var webpack = require('webpack');
var HtmlWebpackPlugin = require('html-webpack-plugin');
var ExtractTextPlugin = require('extract-text-webpack-plugin');
var CleanWebpackPlugin = require('clean-webpack-plugin');
var CopyWebpackPlugin = require('copy-webpack-plugin');

console.log(process.env.NODE_ENV);

var common = {

  context: path.resolve(__dirname),

  devtool: 'cheap-module-eval-source-map',

  entry: {
    'polyfills': path.resolve(__dirname, 'resources/angular/polyfills.ts'),
    'vendor': path.resolve(__dirname, 'resources/angular/vendor.ts'),
    'app': path.resolve(__dirname, 'resources/angular/bootstrap.ts')
  },

  output: {
    path: path.resolve(__dirname, 'public/dist'),
    publicPath: '/app/public/dist/',
    filename: '[name].js',
    chunkFilename: '[name].chunk.js'
  },

  resolve: {
    extensions: ['.ts', '.js'],
    alias: {
      "@app" : path.resolve(__dirname, 'resources/angular')
    }
  },

  module: {
    rules: [
      {
        test: /\.ts$/,
        loaders: [ 'ts-loader', 'angular2-template-loader', 'angular2-router-loader']
      },
      { 
        test: /\.(html|css)$/, 
        loader: 'raw-loader'
      },
      {
        test: /\.scss$/,
        use: [{
          loader:'raw-loader'
        },
        {
          loader: "sass-loader",
          options: {
              includePaths: [path.resolve(__dirname, 'resources/angular/styles')]
          }
        }]
      }
    ]
  },

  plugins: [
    new webpack.EnvironmentPlugin(['NODE_ENV']),
    // Workaround for angular/angular#11580
    new webpack.ContextReplacementPlugin(
      // The (\\|\/) piece accounts for path separators in *nix and Windows
      /angular(\\|\/)core(\\|\/)(esm(\\|\/)src|src)(\\|\/)linker/,
      path.resolve(__dirname, 'packages'), // location of your src
      {} // a map of your routes
    ),

    new webpack.optimize.CommonsChunkPlugin({
      name: ['app', 'vendor', 'polyfills']
    }),

    new CleanWebpackPlugin(['public/dist'], {
      root: path.resolve(__dirname),
      verbose: true, 
      dry: false,
    }),
  ]
};

var production = {
  devtool:'cheap-module-source-map',

  output: {
    path: path.resolve(__dirname, 'public/dist'),
    publicPath: '/app/public/dist/',
    filename: '[name].[hash].js',
    chunkFilename: '[name].[hash].chunk.js'
  },

  plugins: [
    new webpack.LoaderOptionsPlugin({
      minimize: true,
      debug: false
    }),
    new webpack.optimize.UglifyJsPlugin({
      beautify: false,
      mangle: {
          screw_ie8: true,
          keep_fnames: true
      },
      compress: {
          warnings:false,
          screw_ie8: true,
          drop_console: true
      },
      output: {
          comments: false
      },
      sourceMap: true   
    })
  ]
};

if(process.env.NODE_ENV === 'develop') {
  module.exports = merge(common, {});
} else
if(process.env.NODE_ENV === 'production') {
  module.exports = merge(common, production);
} else {
  module.exports = function() { console.log('No NODE_ENV defined'); }
}
