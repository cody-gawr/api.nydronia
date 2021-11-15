#!/bin/bash -x

/usr/bin/php /opt/artisan config:cache
/usr/bin/php /opt/artisan route:cache
/usr/bin/php /opt/artisan view:cache
/usr/bin/php /opt/artisan schedule:work --verbose --no-interaction
