#!/bin/bash

ENV_FILE_PATH=./src/.env

if ! [[ -f "$ENV_FILE_PATH" ]];then
    echo "Please create \"$ENV_FILE_PATH\" file" >&2
    exit 1
fi

docker-compose --env-file=./src/.env build
docker-compose --env-file=./src/.env up -d
docker-compose --env-file=./src/.env exec app composer install --ignore-platform-req=php
docker-compose --env-file=./src/.env exec app php artisan key:generate
docker-compose exec app php artisan migrate
