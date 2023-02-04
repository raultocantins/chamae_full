# Installation

cp .env.example .env

composer install

mkdir -p storage/license

sudo chmod -R 777 storage/

sudo chown -R www-data storage/

sudo chgrp -R www-data storage/

## Key Generate

php artisan key:generate

## Redis Installation

sudo apt update

sudo apt install redis-server

sudo nano /etc/redis/redis.conf

Change **supervised no** to **supervised systemd**

*Save and exit the editor*

sudo systemctl restart redis.service

## Base URL

Set Base URL of the api server in env

e.g: http://localhost:8001

## Local Config

### In server the file will be automatically created. No need to follow the following step

In the storage/license folder add a file with a name of the host with extension(127.0.0.1.json). Inside that file create a json object with a key named accessKey and set a value for it, it should match the accessKey for that company in server. 

{"accessKey": "123456"}



Add VAPID_PUBLIC_KEY in env from API Server env file