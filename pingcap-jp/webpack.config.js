const path = require("path");
const { DefinePlugin } = require("webpack");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
const CopyPlugin = require("copy-webpack-plugin");
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');

const devMode = process.env.NODE_ENV === "development";
const PUBLIC_PATH =
  process.env.NODE_ENV === "prod"
    ? "https://static.pingcap.co.jp/dist"
    : `/wp-content/themes/pingcap-jp/dist`;

module.exports = {
  mode: devMode ? "development" : "production",
  entry: { master: "./js/master.js", track: "./js/track.js" },
  devtool: devMode ? "source-map" : false,
  output: {
    path: path.join(__dirname, "/dist"),
    publicPath: PUBLIC_PATH + "/",
    filename: "js/[name].min.js",
    chunkFilename: "js/[name].bundle.js",
    clean: true,
  },
  optimization: {
    splitChunks: {
      cacheGroups: {
        track: {
          name: "track",
          test: /track\.js/,
          chunks: "initial",
          enforce: true,
        },
      },
    },
  },
  resolve: {
    modules: ["node_modules"],
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules\/(?!(dom7|swiper|imagebuddy)\/).*/,
        use: {
          loader: "babel-loader",
          options: {
            cacheDirectory: true,
          },
        },
      },
      {
        test: /\.scss$/,
        include: path.join(__dirname, "css"),
        type: "asset/resource",
        generator: {
          filename: "[path]/[name].min.css",
        },
        use: [
          // 'postcss-loader',
          {
            loader: "sass-loader",
            options: {
              additionalData: `$theme-url-base: "${PUBLIC_PATH}";$fonts-url-base: "${PUBLIC_PATH}";`,
              sourceMap: devMode,
            },
          },
        ],
      },
    ],
  },
  devServer: {
    proxy: {
      "/api": "https://accounts-preview.pingcap.com",
    },
  },
  plugins: [
    new CopyPlugin({
      patterns: [
        {
          from: "fonts",
          to: "fonts",
        },
        {
          from: "media",
          to: "media",
        },
        {
          from: "prism-js",
          to: "prism-js",
        },
        {
          from: "tidb-user-day",
          to: "tidb-user-day",
        },
      ],
    }),
    new DefinePlugin(
      process.env.NODE_ENV === "prod"
        ? {
            ALGOLIA_APPLICATION_ID: '"6V3WEPHYM6"',
            ALGOLIA_API_KEY: '"93bc58f555e0262e38528ce837bc1e71"',
          }
        : {
            ALGOLIA_APPLICATION_ID: '"CIDEZSADWL"',
            ALGOLIA_API_KEY: '"aa0016c928c913d8b7c27c33046c4e41"',
          }
    ),
    new WebpackManifestPlugin({
			fileName: 'manifest.json',
			generate: (seed, files) => {
				const manifest = {};
				files.forEach((file) => {
					manifest[file.name] = file.path;
				});
				return manifest;
			}
		})
  ].concat(
    devMode
      ? [
          new BrowserSyncPlugin({
            open: false,
            host: "localhost",
            port: 4000,
            logLevel: "silent",
            files: [
              "**/*.php",
              "!vendor/**/*.php",
              "!node_modules/**/*.php",
              "css/**/*.css",
              "js/**/*.js",
            ],
            proxy: "http://dev-jp.pingcap.com/",
          }),
        ]
      : []
  ),
  optimization: {
    realContentHash: true,
  },
};
