#!/usr/bin/env Node

/* eslint-disable no-console,no-unused-vars */

import { execSync } from 'child_process'
import chalk from 'chalk'

/**
 * Check for correct versions of Node.js and npm
 */
function checkForNode() {
	// Check version for Node.js
	try {
		if (
			!execSync('node -v', { stdio: 'pipe' })
				.toString()
				.match(/v16\.\d*\.\d*/g)
		) {
			throw new Error('Please install Node.js ^16.0')
		}
	} catch (error) {
		console.error(`%s - ${error}`, chalk.red.bold('ERROR'))
		process.exit(1)
	}

	// Check version for npm
	try {
		if (
			!execSync('npm -v', { stdio: 'pipe' })
				.toString()
				.match(/8\.\d*\.\d*/g)
		) {
			throw 'Please install npm ^8.0'
		}
	} catch (error) {
		console.error(`%s - ${error}`, chalk.red.bold('ERROR'))
		process.exit(1)
	}
}

/**
 * Pass arguments into CLI options
 *
 * @param {unknown} rawArgs
 */
function parseArgumentsIntoOptions(rawArgs) {
	const args = process.argv.slice(2)

	return {
		type: args[0],
	}
}

/**
 * Execute npm commands
 *
 * @param {Array<string>} dirs
 * @param {string}        command
 * @param {string}        infoStart
 * @param {string}        infoEnd
 */
function execute(dirs = [], command = '', infoStart = '', infoEnd = '') {
	if (infoStart) {
		console.log(`%s - ${infoStart}`, chalk.cyan.bold('INFO'))
	}

	dirs.forEach((dir, index) => {
		if (index !== 0) {
			process.chdir('../../../../')
		}

		if (command) {
			try {
				process.chdir(dir)
				execSync(command)
			} catch (error) {
				console.error(`%s - ${error}`)
				process.exit(1)
			}
		}
	})

	if (infoEnd) {
		console.log(`%s - ${infoEnd}`, chalk.green.bold('DONE'))
	}
}

/**
 * Execute CLI
 *
 * @param {unknown} args
 */
function cli(args) {
	checkForNode()

	const options = parseArgumentsIntoOptions(args)

	switch (options.type) {
		case 'install':
			execute(
				['./web/app/themes/skeleton'],
				'npm ci',
				'Installing dependencies...',
				'Successfully installed the dependencies'
			)
			break
		case 'build':
			execute(
				['./web/app/themes/skeleton'],
				'npm run build',
				'Building for production...',
				'Successfully build the packages'
			)
			break
		case 'dev':
			execute(['./web/app/themes/skeleton'], 'npm run dev', 'Start dev server...')
			break
		case 'preview':
			execute(
				['./web/app/themes/skeleton'],
				'npm run preview',
				'Locally preview production build'
			)
			break
		default:
			console.error(
				'%s - Please pass one of the following options: install, build, dev or preview',
				chalk.red.bold('ERROR')
			)
			process.exit(1)
	}
}

cli(process.argv)
