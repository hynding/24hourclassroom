#!/bin/sh
set -e

# Wait for whichever DB_HOST is configured (local container or external host).
if [ -n "$DB_HOST" ]; then
  echo "Waiting for database at ${DB_HOST}:${DB_PORT:-3306}..."
  until php -r 'exit(@fsockopen(getenv("DB_HOST"), (int) (getenv("DB_PORT") ?: 3306)) ? 0 : 1);'; do
    sleep 2
  done
fi

composer install --no-interaction
php artisan migrate --force

exec "$@"
