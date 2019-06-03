
#deploy script

cd ~/barnesthree.aactmad.org

php artisan down

git pull

composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Clear caches
php artisan cache:clear

# Clear and cache config
php artisan config:clear
php artisan config:cache

php artisan up
