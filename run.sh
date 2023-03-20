#!/bin/sh
# Wait for the database to become available

set -e

until nc -z -v -w30 mysql 3306
do
  echo 'Waiting for database connection...'
  sleep 1
done

cd /var/www

php artisan cache:clear
php artisan config:clear
php artisan key:generate
php artisan migrate
php artisan passport:keys
php artisan passport:client --personal
exec "$@"



