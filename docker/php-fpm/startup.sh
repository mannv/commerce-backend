#!/bin/bash

#start crontab
/etc/init.d/cron start
crontab -u training /opt/training

#start supervisor
#/etc/init.d/supervisor start

#start PHP-FPM
php-fpm
