# Laravel 8 + Bootstrap 5

[Laravel](https://laravel.com/) with [Bootstrap](https://getbootstrap.com/) project template.

## Contents

This Laravel template includes:

-   [Laravel](https://laravel.com/) version 8.x
-   [Bootsrap](https://getbootstrap.com/) version 5.x
-   Pre-compiled Sass
-   Pre-configured `webpack.mix.js` (+ versioning and [Browsersync](https://www.browsersync.io/))
-   [Laravel Homestead](https://laravel.com/docs/8.x/homestead) for local development environment

## Clone & install packages

```
git clone https://github.com/netstackappzdev/YularaTech.git
```

```
cd YularaTech/
```

```
composer install
```

## Development setup

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate


#### Compiling assets

Install npm packages:

```
npm i
```

For compiling assets such as the CSS and JS files, you can choose to `npm run dev`, `npm run prod` or `npm run serve`.

If you are about to run this project template for the first time, you need to run `npm run dev` to build assets on `public/` directory.

Compile assets.

```
npm run dev
```

Compile assets for production.

```
npm run prod
```

Using Browsersync.

```
npm run serve
```
Start the local development server

    php artisan serve
---
