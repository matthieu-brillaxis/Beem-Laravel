#!/bin/bash
docker exec -i beem_web php artisan migrate:install
docker exec -i beem_web php artisan migrate
