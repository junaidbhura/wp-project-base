# Base for Scalable WordPress Projects


## Inspiration and Credits ♥

This project was inspired by the amazing work done by the following people:

https://engineering.hmn.md/how-we-work/style/

https://10up.github.io/Engineering-Best-Practices/

https://xwp.github.io/engineering-best-practices/

https://roots.io/bedrock/

https://www.cedaro.com/blog/structuring-wordpress-plugins/


## Introduction

I've made this repo to constantly evolve with new ideas and best practices. I use this as a base for new client projects.


## MU Plugin architecture

I've used [HumanMade's plugin loader](https://github.com/humanmade/hm-base) and MU plugin architecture.

#### Multiple Plugins

All custom functionality is written in separate, modular plugins with the following philosophy:

1. Make the code modular
1. Make the code re-usable
1. Make each plugin (module) do one thing
1. Make it easy to add and remove new features
1. Make it easy to maintain and test

## Composer and Git Submodules

Since Composer can also use Git repos, it makes more sense to just use Composer for dependancy management.

## Setup

### Environment Setup

1. Clone this repository for your new project. `git clone https://github.com/junaidbhura/wp-project-base.git . && rm -rf .git`
1. Run `composer install` to install WordPress, and all plugins.
1. Run `vendor/bin/phpcs --config-set installed_paths vendor/wp-coding-standards/wpcs` to set WordPress coding standards for PHPCS.
1. Run `npm install` to install Gulp, ESLint, JSHint and JSCS.
1. Run `npm run build` to build the CSS. `npm run dev` for development.
1. Copy `.env.sample` to `.env` and add in and generate all details.

### Unit Tests Setup

1. Create a new database for unit tests.
1. Copy `.tests/wp-tests-config-local-sample.php` to `.tests/wp-tests-config-local.php` and add your local database.
1. Run `vendor/bin/phpunit` to execute.


## Thoughts?

I'd love to hear thoughts on how to improve this! So feel free to create any issues
