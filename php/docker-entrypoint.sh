#!/bin/bash

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

composer install
php artisan migrate:refresh --seed

rm -rf /var/www/html/public/storage
php artisan storage:link

chmod 777 -R /var/www/html/public/
chown www-data -R /var/www/html/public/
chown www-data -R /var/www/html/storage/

exec php-fpm
#exec "$@"