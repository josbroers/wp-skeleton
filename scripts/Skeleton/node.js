#!/usr/bin/env Node
/* eslint-disable no-console,no-unused-vars */

import { execSync } from 'child_process'
import chalk from 'chalk'

const currentPath = process.cwd()

function checkNodeVersion() {
	if (
		!execSync('node -v', { stdio: 'pipe' })
			.toString()
			.match(/v16\.\d*\.\d*/g)
	) {
		throw 'Please install Node.js ^16.0'
	}
}

function checkNpmVersion() {
	if (
		!execSync('npm -v', { stdio: 'pipe' })
			.toString()
			.match(/8\.\d*\.\d*/g)
	) {
		throw 'Please install npm ^8.0'
	}
}

async function main() {
	await checkNodeVersion()
	await checkNpmVersion()

	const args = process.argv.slice(2)

	return {
		type: args[0],
	}
}

function execute(dirs = [], command = '', infoStart = '', infoEnd = '') {
	dirs.forEach((dir, index) => {
		if (infoStart) {
			console.log(`%s - ${infoStart} ${dir}...`, chalk.cyan.bold('INFO'))
		}

		if (index !== 0) {
			process.chdir(currentPath)
		}

		if (command) {
			process.chdir(dir)
			execSync(command, { stdio: 'inherit' })
		}
	})

	if (infoEnd) {
		console.log(`%s - ${infoEnd}`, chalk.green.bold('DONE'))
	}
}

main()
	.then(function (options) {
		switch (options.type) {
			case 'install':
				execute(
					['web/app/themes/skeleton'],
					'npm ci',
					'Installing dependencies for',
					'Successfully installed the dependencies'
				)
				break
			case 'build':
				execute(
					['web/app/themes/skeleton'],
					'npm run build',
					'Building for production for',
					'Successfully build the packages'
				)
				break
			case 'watch':
				execute(
					['web/app/themes/skeleton'],
					'npm run watch',
					'Start development server and watch for changes for'
				)
				break
			case 'lint':
				execute(
					['web/app/themes/skeleton'],
					'npm run lint',
					'Testing code for',
					'Code looks fine!'
				)
				break
			default:
				throw 'Please pass one of the following options: install, build or watch'
		}
	})
	.catch(function (e) {
		console.error(`%s - ${e}`, chalk.red.bold('ERROR'))
		process.exit(1)
	})
