#!/bin/bash
composer install
cp .env.example .env
php artisan key:generate
sed -i -e 's|DB_DATABASE=|DB_DATABASE='`pwd`'/database/database.sqlite|g' .env
echo > database/database.sqlite
php artisan migrate
php artisan db:seed