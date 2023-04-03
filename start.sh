#!/bin/bash
#01-04-23
#Yannis Haismann

composer install
bash ./vendor/laravel/sail/bin/sail up --build
bash ./vendor/laravel/sail/bin/sail artisan migrate
bash ./vendor/laravel/sail/bin/sail artisan migrate:fresh
bash ./vendor/laravel/sail/bin/sail artisan db:seed --class=DatabaseSeeder