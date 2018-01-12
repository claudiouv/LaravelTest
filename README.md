# LaravelTest

**Installation**

_1._ Git clone this repository in your local folder
_2._ Type "composer install" in the root folder of this folder to install the vendors
_3._ Create the .env file in the root folder and add the following:

APP_ENV=local
APP_DEBUG=true
APP_KEY=YY93NgJkaRVfDI9SE8kbkuQkgHwBM0hL

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=test
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null


_4._ Load the database located in the root folder named: test.sql in your local mysql server

_5._ Start your local server by typing php artisan serv in the project's root folder

_6._ Make a get call to:  http://localhost:8000/building/elevators/report

_7._ A copy of the result is located in /Elevator_Report_Claudio.txt
