#!/usr/bin/env bash
docker-compose -p syngenta down
sudo rm -rf databases/
mkdir -p databases
cp -n .env.example .env
docker-compose -p dishch up -d
docker exec -ti dishch_composer_1 sh -c "composer update"
docker exec -ti dishch_php_1 sh -c "php artisan key:generate"
docker exec -ti dishch_php_1 sh -c "php artisan migrate:refresh --seed"
docker exec -ti dishch_php_1 sh -c "php artisan l5-swagger:generate"
docker exec -ti dishch_php_1 sh -c "vendor/bin/phpunit"
