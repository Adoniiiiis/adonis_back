#!/bin/bash
#01-04-23
#Yannis Haismann

composer install
sudo bash ./vendor/laravel/sail/bin/sail down --volumes
sudo bash ./vendor/laravel/sail/bin/sail up --build -d
sleep 20s
sudo bash ./vendor/laravel/sail/bin/sail artisan migrate
sudo bash ./vendor/laravel/sail/bin/sail artisan db:seed --class=DatabaseSeeder