#!/bin/bash

cd /opt;
composer install --ignore-platform-reqs;
/usr/sbin/php-fpm8 -F -O;
