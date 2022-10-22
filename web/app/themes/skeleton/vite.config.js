import { defineConfig } from 'vite'
import { viteStaticCopy } from 'vite-plugin-static-copy'
import { resolve } from 'path'
import autoprefixer from 'autoprefixer'
import viteImagemin from 'vite-plugin-imagemin'

export default defineConfig(({ mode }) => {
	let watch
	let compress

	if (mode === 'production') {
		compress = viteImagemin({
			gifsicle: {
				interlaced: true,
			},
			optipng: {
				optimizationLevel: 5,
			},
			jpegtran: {
				quality: 100,
				progressive: true,
			},
			svgo: {
				plugins: [
					{
						name: 'preset-default',
						params: {
							overrides: {
								removeUnknownsAndDefaults: false,
								removeViewBox: false,
							},
						},
					},
				],
			},
		})
	}

	if (mode === 'development') {
		watch = {
			watch: {
				include: '(templates|components|app|resources)/**/*.(ts|scss)',
			},
		}
	}

	return {
		publicDir: resolve(__dirname, 'dist'),
		root: resolve(__dirname, 'resources'),
		build: {
			outDir: resolve(__dirname, 'dist'),
			emptyOutDir: true,
			manifest: true,
			minify: mode === 'production',
			sourcemap: mode === 'development' ? 'inline' : false,
			rollupOptions: {
				input: {
					main: resolve(__dirname, 'resources/ts/main.ts'),
					css: resolve(__dirname, 'resources/scss/main.scss'),
				},
			},
			...watch,
		},
		css: {
			postcss: {
				plugins: [autoprefixer],
			},
			devSourcemap: true,
		},
		preview: false,
		plugins: [
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
			compress,
		],
	}
})
