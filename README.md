<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Setup

PHP 8.2.x, composer, Docker needs to be installed.

Clone repostory
```bash
git clone https://github.com/ankitank25/avrillo-api
```
```bash
cd ./avrillo-api
```
Install composer packages
```bash
composer install
```
Copy .env file
```bash
cp .env.example .env
```
Generate app key
```bash
php artisan key:generate
```
Install ChromeDriver
```bash
php artisan dusk:chrome-driver
```

Install node packages
```npm
npm install
```
Open new terminal window and run
```npm
npm run dev
```
Open new terminal window and run docker container
```bash
./vendor/bin/sail up
```

To open browser:

Click:
[http://127.0.0.1/](http://127.0.0.1/)


## Testing
### Feature test

Run
```bash
php artisan test --testsuite=Feature
```
Below three tests should be pass.
 - listing page successful response
 - refresh api successful response
 - refresh api limit successful response

### Browser test

Run
```bash
php artisan dusk
```
Below three tests should be pass.
- quote listing page (Screenshot: quote-listing-page.png)
- quote listing refresh button (Screenshot: quote-listing-refresh-button.png)
- quote listing refresh (Screenshot: quote-listing-refresh-before.png, quote-listing-refresh-after.png)

Tests will generate screenshot in ``./tests/Browser/screenshots`` directory.

## License

The application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
