<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
</p>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# NL-CTU

## How to install

### Setup Environment For Ubuntu

#### dependencies:
`` sudo apt-get remove --purge php-common ``\
`` sudo apt-get update ``\
`` sudo apt-get install php-dom php-common php-mysql php-cli ``\
`` sudo apt-get install php-curl php-gd ``

#### mbstring:
`` sudo apt-get install phpVersion-mbstring ``
- Note: example for phpVersion-mbstring is php8.1-mbstring


### Setup Environment For Arch

<a href="https://wiki.archlinux.org">wiki.archlinux.org</a>

### Setup for run project:

#### setup node and composer
- in project folder:\
`` npm install ``\
`` composer require pusher/pusher-php-server ^7.1 --ignore-platform-reqs ``\
`` sudo rm  composer.lock ``\
`` composer update ``\
`` npm run build ``\
`` composer install --ignore-platform-reqs ``

- Note: use nodejs version 18 or higher

#### setup .env:
- run shell:
`` cp .env.example .env ``
- append following lines below into .env:\
`` PUSHER_APP_ID=livepost ``\
`` PUSHER_APP_KEY=livepost_key ``\
`` PUSHER_APP_SECRET=livepost_secret ``\
`` PUSHER_HOST=127.0.0.1 #this ip can be change ``\
`` PUSHER_PORT=6001 ``\
`` PUSHER_SCHEME=http ``\
`` PUSHER_APP_CLUSTER=mt1 ``
- mail:
go to google search "`` mailtrap for laravel ``" then follow the instructions
- database:
configuration in .env fill in the blanks for following code below:\
`` DB_CONNECTION=mysql #this driver can be change ``\
`` DB_HOST=127.0.0.1 #this ip can be change ``\
`` DB_PORT=3306 ``\
`` DB_DATABASE=... ``\
`` DB_USERNAME=... ``\
`` DB_PASSWORD=... ``

#### setup websockets
- detail: https://beyondco.de/docs/laravel-websockets/getting-started/installation
- In project folder run:
`` php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config" ``

#### uncomment following in your /etc/php/version/cli/php.ini:
`` ;extension=mysqli ``\
`` ;extension=pdo_mysql ``\
`` ;extension=gd ``
- /etc/php/version/cli/php.ini for ubuntu, version can be 8.1, 7.x, ....
- /etc/php/php.ini for arch
- Note: You can use another sql not necessarily mysql.

#### migrate database:
- run:\
`` php artisan migrate:fresh --seed `` for create table and fake data.\
`` php artisan migrate:fresh `` for create table

### Run Project:

#### The first way


open 2 terminal:
- first terminal run:\
`` php artisan serve ``
- second terminal run:\
`` php artisan websockets:serve ``

#### The second way

**deploy them in nginx or apache, do it yourself**
