#!/usr/bin/env bash

set -e

role=${CONTAINER_ROLE:-app}
env=${APP_ENV:-production}

if [ "$env" != "local" ]; then
    echo "Caching configuration..."
    # (cd /var/www/html && php artisan config:cache && php artisan route:cache && php artisan view:cache)
fi

if [ "$role" = "app" ]; then

    echo "Running an application..."
    php-fpm

elif [ "$role" = "queue" ]; then

    echo "Running the queue..."
    # php /var/www/html/artisan queue:listen --verbose --tries=3 --timeout=90000
    php /var/www/api/artisan horizon

elif [ "$role" = "scheduler" ]; then

    echo "Running the schedule..."
    php /var/www/api/artisan schedule:work --verbose --no-interaction
fi
