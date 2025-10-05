supervisord -c /etc/supervisord.conf
service cron start
exec php-fpm
