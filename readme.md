# Blog app

<div align="center">
<img src="https://laravel.com/assets/img/components/logo-laravel.svg" width=20%>
<img src="https://www.fullstackpython.com/img/logos/vuejs-wide.png" width=20%>
<img src="https://1.cms.s81c.com/sites/default/files/styles/product_page_card_not_full_width/public/2018-08/Mongo_DB.png?itok=2OSlSFBd" width=20%>
</div>

## ✅ Prerequisites

-   PHP 7
-   Composer
-   NodeJs
-   MongoDB

## 🛠 Installation

-   Clone the repository
-   Install back dependencies with `composer install`
-   Install front dependencies with `npm install`
-   Copy file `.env.example` in `.env` and add following informations:
    -   Database credentials (`DB_HOST`, `DB_PORT`, ...)
    -   Application url (`APP_URL`).
-   Generate application key with `php artisan key:generate`
-   Generate JWT key with `php artisan jwt:secret`
-   Launch migrations with `php artisan migrate --seed`.

## 🚀 Run

-   Build front with `npm run dev`
-   Launch application with `php artisan serve`

By default, application will be served at `http://127.0.0.1:8000`

## 🧪 Test

Launch PHPUnit tests with `./vendor/bin/phpunit`
