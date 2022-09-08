#!/usr/bin/env Node

import { execSync } from "child_process";
import chalk        from "chalk";

/**
 * Check for correct versions of Node.js and npm.
 */
function checkForNode() {
	// Check version for Node.js
	try {
		if ( !execSync( "node -v", { stdio: "pipe" } ).toString().match( /v16\.\d*\.\d*/g ) ) {
			throw( "Please install Node.js ^16.0" );
		}
	} catch ( error ) {
		console.error( `%s - ${error}`, chalk.red.bold( "ERROR" ) );
		process.exit( 1 );
	}

	// Check version for npm
	try {
		if ( !execSync( "npm -v", { stdio: "pipe" } ).toString().match( /8\.\d*\.\d*/g ) ) {
			throw( "Please install npm ^8.0" );
		}
	} catch ( error ) {
		console.error( `%s - ${error}`, chalk.red.bold( "ERROR" ) );
		process.exit( 1 );
	}
}

/**
 * Pass arguments into CLI options.
 *
 * @param {*} rawArgs
 * @returns
 */
function parseArgumentsIntoOptions( rawArgs ) {
	const args = process.argv.slice( 2 );

	return {
		type: args[ 0 ],
	};
}

/**
 * Execute npm commands.
 *
 * @param dirs
 * @param command
 * @param stdio
 * @param infoStart
 * @param infoEnd
 */
function execute( dirs = [], command = "", stdio = "pipe", infoStart = "", infoEnd = "" ) {
	if ( infoStart ) {
		console.log( `%s - ${infoStart}`, chalk.cyan.bold( "INFO" ) );
	}

	dirs.forEach( ( dir, index ) => {
		if ( index !== 0 ) {
			process.chdir( "../../../../" );
		}

		if ( command ) {
			try {
				process.chdir( dir );
				execSync( command, { stdio: stdio } );
			} catch ( error ) {
				console.error( `%s - ${error}` );
				process.exit( 1 );
			}
		}
	} );

	if ( infoEnd ) {
		console.log( `%s - ${infoEnd}`, chalk.green.bold( "DONE" ) );
	}
}

/**
 * Execute CLI.
 *
 * @param args
 */
function cli( args ) {
	checkForNode();

	const options = parseArgumentsIntoOptions( args );

	switch ( options.type ) {
		case "install":
			execute(
				[ "./web/app/themes/jobrodo" ],
				"npm ci",
				"pipe",
				"Installing dependencies...",
				"Successfully installed the dependencies"
			);
			break;
		case "build":
			execute(
				[ "./web/app/themes/jobrodo" ],
				"npm run build",
				"pipe",
				"Building the packages",
				"Successfully build the packages"
			);
			break;
		case "watch":
			execute(
				[ "./web/app/themes/jobrodo" ],
				"npm run watch",
				"inherit",
				"Watching the theme"
			);
			break;
		case "lint":
			execute( [
					"./web/app/themes/jobrodo" ],
				"npm run lint",
				"inherit",
				"Linting the files"
			);
			break;
		default:
			console.error( "%s - Please pass one of the following options: install, build or watch", chalk.red.bold( "ERROR" ) );
			process.exit( 1 );
	}
}

cli( process.argv );
