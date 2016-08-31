## vue-starter Backend API (Laravel-based)

This application will serve as the companion app to another project called vue-starter. It is meant to be a small demo of a Laravel API, using Dingo and JWT for authentication.

[vue-starter Frontend App](https://github.com/artisk82/vue-starter)

## Installation

### Step 1: Clone the repo
```
git clone https://github.com/artisk82/vue-starter-laravel-api.git
```

### Step 2: Prerequisites
```
cp .env.example .env
composer install
touch database/database.sqlite
touch database/database_test.sqlite
php artisan migrate
php artisan db:seed
php artisan key:generate
php artisan vendor:publish
php artisan jwt:generate
```

### Step 3: Serve
```
php artisan serve
```

### Note about Apache
If you use Apache to serve this, you will need to add the following 2 lines to your .htaccess (or your virtualhost configuration):
```
RewriteCond %{HTTP:Authorization} ^(.*)
RewriteRule .* - [e=HTTP_AUTHORIZATION:%1]
```


