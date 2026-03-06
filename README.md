<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Menú de instalación

```bash
    # 2. Instala las dependencias de PHP
    composer install
```

```bash
    # 3. Copia el archivo de variables de entorno
    cp .env.example .env
```

```bash
    # 5. Genera la clave de la aplicación
    php artisan key:generate
```


1. Crear la base de datos vip2car
```bash
    CREATE DATABASE vip2car
```

2. Rellenar las variables de entorno con las credenciales de la BD  a utilizar
```php 
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=vip2car
    DB_USERNAME= #completar
    DB_PASSWORD= #completar
```

3. Correr las migraciones y seeders
```bash 
    php artisan migrate:refresh --seed
```
