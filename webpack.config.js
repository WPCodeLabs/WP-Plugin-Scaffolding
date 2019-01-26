const path = require('path');
var LiveReloadPlugin = require('webpack-livereload-plugin');

module.exports = {
	entry: {
		'js/public': './src/scripts/public.js',
		'js/admin': './src/scripts/admin.js',
		'css/public': './src/styles/public.scss',
		'css/admin': './src/styles/admin.scss',
	},
	output: {
		filename: '[name].js',
		path: path.resolve(__dirname, 'assets' )
	},
	mode: "development", // enabled useful tools for development
	watch: true,
	watchOptions: {
		ignored: ['files/**/*.js', 'node_modules']
	},
	module : {
		rules : [
			{
				test: /.js$/,
				exclude: /(node_modules)/,
				use : {
					loader : 'babel-loader',
					options: {
						presets: ["@babel/preset-env", "@wordpress/babel-preset-default"]
					}
				}
			},
			{
				test: /\.scss$/,
				use: [
					{
						loader: 'file-loader',
						options: { name: 'css/[name].css' }
					},
					{
						loader: 'extract-loader',
						options: { sourceMap: 'inline' }
					},
					{
						loader: 'css-loader',
					    options: { sourceMap: true }
					},
					{
						loader: 'postcss-loader',
						options: { sourceMap: true }
					},
					{
						loader: 'sass-loader',
						options: { sourceMap: true }
					}
				]
			}
		]
	},
	plugins: [
	  new LiveReloadPlugin({appendScriptTag: false })
	]
};