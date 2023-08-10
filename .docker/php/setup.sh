#!/bin/sh
# cd /var/www

export COMPOSER_ALLOW_SUPERUSER=1

composer --no-interaction install

cp .env.example .env

php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

php artisan migrate
php artisan db:seed

php artisan telescope:install

# npm install
# npm run prod
