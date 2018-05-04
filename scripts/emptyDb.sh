#!/bin/bash
docker exec -i beem_db sh -c 'exec mysql -u beem -ppassword -Nse "show tables" beem_api | while read table; do mysql -u beem -ppassword -e "drop table $table" beem_api; done'
docker exec -i beem_web php artisan migrate:install
docker exec -i beem_web php artisan migrate
