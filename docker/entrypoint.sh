#!/bin/sh

set -e

#chmod -R 777 /var/www/html/public/uploads
#chmod -Rf 777 /var/www/html/storage

php artisan config:clear
php artisan storage:link

chmod -R 777 storage
php artisan cache:clear
chown -R www-data:www-data storage/logs/

#crontab -r
#crontab -l | { cat; echo "* * * * * cd /var/www/html && php artisan schedule:run >> /var/www/html/storage/logs/cron.log 2>&1"; } | crontab -
#service cron start
#/etc/init.d/cron start

. /etc/apache2/envvars
exec apache2 -DNO_DETACH < /dev/null
