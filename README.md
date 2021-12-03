
![GitHub Actions](https://github.com/junaidbhura/wp-project-base/workflows/Coding%20Standards%20and%20Tests/badge.svg)

# Project Setup

If you want to use this structure for Acme, Inc.:

1. Clone this repository
1. Find and replace all occurrences of `fooclient` to `acme`
1. Find and replace all occurrences of `Foo Client` to `Acme, Inc.`
1. Find and replace all occurrences of `foo` to `acme`
1. Find and replace all occurrences of `Foo` to `Acme`

Create a local certificate

```
cd .docker/ssl

openssl req \
    -newkey rsa:2048 \
    -x509 \
    -nodes \
    -keyout fooclient.key \
    -new \
    -out fooclient.crt \
    -subj /CN=fooclient.test \
    -reqexts SAN \
    -extensions SAN \
    -config <(cat /System/Library/OpenSSL/openssl.cnf \
        <(printf '[SAN]\nsubjectAltName=DNS:fooclient.test')) \
    -sha256 \
    -days 3650
```

## Local Setup

Make sure you have PHP 8.0 or higher, Docker, NodeJS 16 and Composer 2 or higher installed.

1. Copy the `.env.sample` file and rename it to `.env` and add / update your project details
1. Run `npm run start` to install NodeJS and Composer packages. This also automatically installs the PHP coding standards. You will be prompted for your password to trust the SSL certificate
1. Start your local environment (see below)
1. Create a local database `echo "CREATE DATABASE fooclient;" | mysql -uroot -proot -h 0.0.0.0`
1. If you don't use a Mac, go to `.docker/ssl` and trust the self-signed certificate in there. If you use a Mac, this should be done automatically
1. Add `127.0.0.1 fooclient.test` to your hosts file
1. Visit https://fooclient.test in your browser
1. To access WP Admin, visit https://fooclient.test/wp/wp-admin/
1. To access MailHog, visit http://0.0.0.0:8025

### Starting and stopping the Docker environment

To start your local Docker environment, run: `npm run local-environment:start`

To stop your local Docker environment, run: `npm run local-environment:stop`

### PHPUnit Tests Setup

1. Create a database `echo "CREATE DATABASE fooclient-tests;" | mysql -uroot -proot -h 0.0.0.0`
1. Copy the file `.tests/php/wp-tests-config-local-sample.php` to `.tests/php/wp-tests-config-local.php`
1. Run `npm run test:php` to run the tests
