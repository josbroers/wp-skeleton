import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import { viteStaticCopy } from 'vite-plugin-static-copy'

const { resolve } = require('path')

export default defineConfig({
	root: '',
	base: resolve(__dirname, 'dist'),
	build: {
		manifest: true,
		minify: process.env.NODE_ENV !== 'development',
		outDir: resolve(__dirname, 'dist'),
		emptyOutDir: true,
	},
	css: {
		devSourcemap: true,
	},
	plugins: [
		laravel({
			input: [
				resolve(__dirname, 'resources/scss/main.scss'),
				resolve(__dirname, 'resources/ts/main.ts'),
			],
			refresh: ['public/**/*', '{app,components,templates}/**/*.php', '*.php'],
		}),
		viteStaticCopy({
			targets: [
				{
					src: resolve(__dirname, 'resources/icons'),
					dest: resolve(__dirname, 'dist'),
				},
				{
					src: resolve(__dirname, 'resources/images'),
					dest: resolve(__dirname, 'dist'),
				},
			],
		}),
	],
})
