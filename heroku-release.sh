#!/usr/bin/env bash

echo "php bin/console doctrine:migrations:migrate"
php bin/console doctrine:migrations:migrate --no-interaction
composer install
php bin/console cache:clear