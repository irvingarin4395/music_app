# Music App (Laravel and Vue)

Music App Created from Laravel as backend and Vue For Frontend.

## Installation

Clone the main repo.

## Database

on the root folder

```bash
  docker compose up -d
```

## Laravel-App

```bash
  cd music-laravel
  composer install
```

Migrate tables and dummy data

```
php artisan migrate
php artisan db:seed
```

.env for Laravel

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=music_laravel
DB_USERNAME=root
DB_PASSWORD=music
```

Run Laravel-App

```
php artisan serve
```

## Vue-App

```
npm install
npm run dev
```
