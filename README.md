# WordPress Skeleton

![Packagist](https://img.shields.io/packagist/v/jobrodo/wp-skeleton)

A skeleton for WordPress bootstrapped with [Bedrock](https://roots.io/bedrock/). It has the following features:

- [ESLint](https://eslint.org/)
- [Vite](https://vitejs.dev/)
- [Prettier](https://prettier.io/)
- [Sass](https://sass-lang.com/)
- [TypeScript](https://www.typescriptlang.org/)
- [ACF](https://www.advancedcustomfields.com/)
- [Gravity Forms](https://www.gravityforms.com/)
- [Permalink Manager Pro](https://permalinkmanager.pro/)
- [WP Rocket](https://wp-rocket.me/)
- [Rank Math Pro](https://rankmath.com/)

## Table of contents

- [WordPress Skeleton](#wordpress-skeleton)
	- [Table of contents](#table-of-contents)
	- [1. Setup](#1-setup)
		- [1.1 Node.js](#11-nodejs)
		- [1.2 How to install this template](#12-how-to-install-this-template)
		- [1.3 TypeScript](#13-typescript)
	- [2. Scripts](#2-scripts)
	- [3. Styling](#4-styling)

## 1. Setup

### 1.1 Node.js

First install the Node.js higher or equal to 16.0.0. Use the JavaScript Tool Manager [Volta](https://volta.sh/) or
the [Node Version Manager](https://github.com/nvm-sh/nvm).

### 1.2 How to install this skeleton

After successfully installing Node.js you can create a project using this skeleton. We recommend creating a new project
using `composer`, which sets up everything automatically for you. To create a project, run:

```bash
composer create-project jobrodo/wp-skeleton <package_name>
```

After installing the project you need to fire the following commands to get your project up and running:

```bash
# Install packages and build the resources
npm install && npm run build

# Clone the submodules
npm run clone-submodules
```

### 1.3 TypeScript

This skeleton uses **TypeScript** out of the box. If you don't feel comfortable using it or don't need it, just rename
all the files to their JavaScript equivalent (`.js`) and uninstall TypeScript.

## 2. Scripts

- Use `npm install` to install the dependencies in all the defined directories
- Use `npm run watch` to (re)build after any changes have been made
- To test the code using ESLint and Stylelint, use `npm run lint`
- To build the application for production, use `npm run build`

## 3. Styling

There are a lot of options to style your projects. This skeleton uses a global stylesheet with [Sass](https://sass-lang.com/), [Modern Normalize](https://www.npmjs.com/package/modern-normalize/) and some unit functions inspired
by [Foundation sites](https://get.foundation/sites/docs/sass-functions.html), but use whatever works best for you.
For example:

- [Material-UI](https://mui.com/)
- [Tailwind CSS](https://tailwindcss.com/)
