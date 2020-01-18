const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const VueLoaderPlugin = require('vue-loader/lib/plugin')

module.exports = {
  watch: true,
  mode: "development",
  entry: {
    entry: "./resources/js/app.js"
  },

  devtool: "source-map",

  output: {
    path: path.resolve(__dirname, 'public'),
    filename: 'js/app.js'
  },

  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: "vue-loader",
      },
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: [
          {
            loader: "babel-loader",
            options: {
              presets: ['@babel/preset-env'] 
            }
          }
        ]
      },
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          "vue-style-loader",
          MiniCssExtractPlugin.loader,
          
          {
            loader: "css-loader",
            options: { sourceMap: true },
          },
          {
            loader: "sass-loader",
            options: { sourceMap: true },
          },
          {
            loader: "import-glob-loader",
					}
        ],
      },
    ]
  },
  plugins: [
    new VueLoaderPlugin(),
    new MiniCssExtractPlugin({
      filename: 'css/style.css'
    })
  ],
  resolve: {
    extensions: [".vue", ".js"],
    alias: {
      "vue$": "vue/dist/vue.esm.js"
    }
  }
}