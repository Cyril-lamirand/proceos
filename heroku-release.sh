#!/usr/bin/env bash

echo "php bin/console doctrine:migrations:migrate"
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console cache:clear