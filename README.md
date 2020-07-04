# Base for Scalable WordPress Projects

![GitHub Actions](https://github.com/junaidbhura/wp-project-base/workflows/Coding%20Standards%20and%20Tests/badge.svg)

## Inspiration and Credits ♥

This project was inspired by the amazing work done by the following people:

https://engineering.hmn.md/how-we-work/style/

https://10up.github.io/Engineering-Best-Practices/

https://xwp.github.io/engineering-best-practices/

https://roots.io/bedrock/


## Introduction

I've made this repo to constantly evolve with new ideas and best practices. I use this as a base for new client projects.

#### Multiple Plugins

All custom functionality is written in separate, modular plugins with the following philosophy:

1. Make the code modular
1. Make the code re-usable
1. Make each plugin (module) do one thing
1. Make it easy to add and remove new features
1. Make it easy to maintain and test

## Setup

### Environment Setup

1. Clone this repository for your new project. `git clone https://github.com/junaidbhura/wp-project-base.git . && rm -rf .git`
1. Run `composer install` to install WordPress, and all plugins.
1. Run `npm install` to install Webpack, ESLint and Stylelint.
1. Run `npm run build` to build the project. `npm run dev` for development.
1. Copy `.env.sample` to `.env` and add in and generate all details.

### Unit Tests Setup

1. Create a new database for unit tests.
1. Copy `.tests/php/wp-tests-config-local-sample.php` to `.tests/php/wp-tests-config-local.php` and add your local database.
1. Run `composer run test` to execute.

### E2E Tests Setup

1. Run `npm run test:e2e-interactive -- --wordpress-base-url=https://yoursite.test/wp --wordpress-username=admin --wordpress-password=password` for an interactive session.
1. Run `npm run test:e2e -- --wordpress-base-url=https://yoursite.test/wp --wordpress-username=admin --wordpress-password=password` for a headless session.

## Thoughts?

I'd love to hear thoughts on how to improve this! So feel free to create any issues
