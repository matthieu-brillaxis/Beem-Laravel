#!/bin/bash
docker exec -i beem_db sh -c 'exec mysql -u beem -ppassword -Nse "show tables" beem_api | while read table; do mysql -u beem -ppassword -e "SET FOREIGN_KEY_CHECKS=0; drop table $table; SET FOREIGN_KEY_CHECKS=1;" beem_api; done'
docker exec -i beem_web php artisan migrate:install
docker exec -i beem_web php artisan migrate

docker exec -i beem_web php artisan db:seed
