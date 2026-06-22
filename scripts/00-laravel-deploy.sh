#!/usr/bin/env bash

echo "Running composer..."
composer install --no-dev --working-dir=/var/www/html

echo "Installing npm..."
npm install

echo "Building assets..."
npm run build

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Linking storage..."
php artisan storage:link

echo "Running migrations..."
php artisan migrate --force