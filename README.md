<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Descripción
Este proyecto es un sistema de Gestión desarrollado para la Empresa VIP2CAR. La aplicación está pensada hacia una arquitectura desacoplada, con una API RESTful robusta en el backend y una Single-Page Application (SPA) dinámica en el frontend (trabajo futuro).

El objetivo es centralizar la gestión de los usuarios, los clientes y los vehículos..


## Funcionalidades Implementadas


## Requisitos de entorno (Stack Tecnológico)
```
PHP 8.2+

Composer 2.8.5+

Laravel 12+

PostgreSQL / MySQL

Laravel Sanctum (para autenticación de API)
```

## Instalación
Para ejecutar este proyecto en un entorno de desarrollo local, necesitarás tener instalado PHP, Composer y un gestor de base de datos (PostgreSQL o MySQL).

```bash
    # 1. Instala las dependencias de PHP
    composer install
```

```bash
    # 2. Copia el archivo de variables de entorno
    # Linux:
        cp .env.example .env

    # Windows:
        copy .env.example .env
```

```bash
    # 3. Crear la base de datos vip2car
    CREATE DATABASE vip2car
```

```php
    # 4.  Rellenar las variables de entorno con las credenciales de la BD  a utilizar
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=vip2car
    DB_USERNAME= #completar
    DB_PASSWORD= #completar
```

```bash
    # 5. Genera la clave de la aplicación
    php artisan key:generate
```

```bash
    # 6. Correr las migraciones y seeders
    php artisan migrate:refresh --seed
```

# ▶️ Ejecutando la Aplicación

**- Para trabajar en el proyecto, necesitarás tener 1 terminal abierta.**

## BACKEND
```bash
    # Terminal 1: Iniciar el servidor del Backend

    php artisan serve

    # La API estará disponible en http://127.0.0.1:8000.
```
