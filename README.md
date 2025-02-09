<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Setup instruction

This is a Laravel 11-based project. Follow the steps below to set up and run the application.

## Prerequisites

Ensure you have the following installed on your system:

- PHP 8.3 or later
- Composer
- Node.js & npm
- Docker & Docker Compose
- MySQL or PostgreSQL (if not using Docker)

## Installation

1. **Clone the repository**  
   ```sh
   git clone https://github.com/shahiran250890/laravel-auth-appv1.git
   cd your-repo

2. **Node install**
    ```sh
    npm install && npm run build

3. **Docker**
    ```sh
    docker-compose up --build -d

4. **Setup Env**
    ```sh
    docker exec -it php_container /bin/sh -c "cp .env.example .env"
    docker exec -it php_container /bin/sh -c "php artisan key:generate"
    docker exec -it php_container /bin/sh -c "php artisan config:cache"

5. **Composer install**
    ```sh
    docker exec -it php_container /bin/sh -c "composer install"
    
6. **Migration**
    ```sh
    docker exec -it php_container /bin/sh -c "php artisan migrate"

7. **Artisan Command**
    ```sh
    docker exec -it php_container /bin/sh -c "php artisan cache:Clear"
    docker exec -it php_container /bin/sh -c "php artisan config:cache"
    docker exec -it php_container /bin/sh -c "php artisan view:clear"
    docker exec -it php_container /bin/sh -c "php artisan route:clear"

8. **Permission Issue (optional)**
    accessing docker as root
    ```sh
    docker exec -u root -it php_container sh

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
