# Petunjuk Instalasi dan Instruksi

clone repository git pada https://github.com/ryanasnan/backend-engineering-test

```sh
$ clone git@github.com:ryanasnan/backend-engineering-test.git
```

Terdapat dalam repo tersebut terdapat 3 branch yaitu master, sprint1 dan sprint2.
Branch master telah ada setelah proses clone.
Untuk mendapatkan branch lainnya dapat dilakukan dengan command

```sh
$ git checkout sprint1
$ git checkout sprint2
```

setelah itu kembali lagi ke branch master

```sh
$ git checkout master
```

kemudian install package

```sh
$ composer install    
```

> Jika belum terdapat composer dapat melakukan instalasi di https://getcomposer.org/download/

kemudian set file env dengan isian standard

```sh
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:/QrsOo4F6qA3U3/43YM+sEKjEPe62LIU1RSuUzQ3FZg=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=backend_engineering_test
DB_USERNAME=root
DB_PASSWORD=root

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1
```

buat database dengan nama "backend_engineering_test"

lakukan migrasi

```sh
$ php artisan migrate
```

### Sprint 1

Pindah ke branch sprint1 dan lakukan update composer untuk mendapatkan package GuzzleHttp

```sh
$ git checkout sprint1
$ composer update
```

Lakukan migrasi database dan fetching data via api rajaongkir

```sh
$ php artisan migrate
$ php artisan fetch:data
```

Untuk menjalankan endpoint pencarian data provinsi atau kota gunakan server php laravel dan gunakan aplikasi postman

```sh
$ php artisan serve
```

Pengaksesan pencarian data provinsi dapat dilakukan dengan cara memberikan url seperti berikut "127.0.0.1:8000/api/search/provinces?id=1"

![alt text](http://picture.ryanasnan.net/1.1.search-province.png "Logo Title Text 1")

![alt text](http://picture.ryanasnan.net/1.2.search-city.png "Logo Title Text 1")

### Sprint 2

Pindah ke branch sprint2 dan lakukan update composer untuk mendapatkan package passport

```sh
$ git checkout sprint2
$ composer update
```

Kemudian lakukan migrasi database dan install package passport laravel (Generate key)

```sh
$ php artisan migrate
$ php artisan passport:install
```

Buka aplikasi postman dan daftarkan akun baru

header:
| key | value |
|-----|-------|
| Content-Type |application/json |
| X-Requested-With | XMLHttpRequest |

url : "127.0.0.1:8000/api/auth/signup"

method : "post"

body :
> {
> 	"name": "digdaya",
> 	"email": "digdaya@mail.com",
> 	"password": "123123",
> 	"password_confirmation": "123123"
> }

![alt text](http://picture.ryanasnan.net/2.1.signup-header.png "Logo Title Text 1")

![alt text](http://picture.ryanasnan.net/2.2.signup-body.png "Logo Title Text 1")

![alt text](http://picture.ryanasnan.net/2.3.signup-success.png "Logo Title Text 1")

Login dengan akun tersebut

header:
| key | value |
|-----|-------|
| Content-Type |application/json |
| X-Requested-With | XMLHttpRequest |

url "127.0.0.1:8000/api/auth/login"

method : "post"

body:
> {
> 	"email": "digdaya@mail.com",
> 	"password": "123123"
> }

output:
> {
>     "access_token": "eyJ0eXAiOiJK...",
>     "token_type": "Bearer",
>     "expires_at": "2019-08-25 05:05:07"
> }

![alt text](http://picture.ryanasnan.net/3.1.login-success.png "Logo Title Text 1")

Gunakan token tersebut untuk dapat mengakses pencarian data provinsi atau kota.

| key | value |
|-----|-------|
| Authorization | bearer eyJ0eXAiOiJK... |

url : "api/search/provinces?id=1"

![alt text](http://picture.ryanasnan.net/4.1.access-auth-fail.png "Logo Title Text 1")

![alt text](http://picture.ryanasnan.net/4.2.access-auth-success.png "Logo Title Text 1")

Untuk dapat mengakses pencarian data menggunakan database atau api dapat diubah melalui konfigurasi di file .env

menggunakan database
SEARCH_DATA_METHOD=api
menggunakan database
SEARCH_DATA_METHOD=database

