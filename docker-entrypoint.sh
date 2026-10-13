#!/bin/sh
# Crea la base SQLite, ejecuta migraciones + seeders y levanta el servidor
touch database/database.sqlite
php artisan migrate:fresh --seed --force
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
