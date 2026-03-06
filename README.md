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
El proyecto trabajó sobre la base de 3 funcionalidades
    - Users (Acceso al sistema)
    - Clients (A registrar en el sistema)
    - Vehicles (A registrar en el sistema)

Para todos estos se partió del principio de responsabilidad única, por lo cuales cumplen con los siguientes apartados:
    - Migration
    - Model
    - Factory
    - Seeder
    - Request
    - Controller
    - Service
    - Resource

A su vez, para asegurar la integridad de los datos, se cuenta con un Helper y Trait para formatear la información antes de validar su ingreso en los Request:
    - Helper: DataFormatter (formato para todos los datos)
    - Trait: PrepareData (prepareForValidation usado como trait para no repetir el código)

Por su parte, también se trató de asegurar la correcta auditoría de la información, para lo cual se cuenta con un Logger especializado
    - Loggin/ApiLogger - Guarda los logs del sistema por niveles, agregando información especial en el contexto (id del usuario), y usando un canal personalizado (app_api).

## Requisitos de entorno (Stack Tecnológico)
```
    PHP 8.2+
    Composer 2.8.5+
    Laravel 12+
    PostgreSQL 16+
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
    # 3. Crear la base de datos vip2car en un entorno PostgreSQL
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


Las credenciales por defecto son las siguiente:
    - email: test@example.com
    - password: 123456

Todos los usuarios comparten la misma contraseña (dentro del seeder se muestran) 

## POSTMAN
Se cuenta a su vez con un archivo .json: Vip2Car.postman_collection.json
en el cual se especifican todos los endpoints de la API, de manera que puedan importarse y probar el resultado del desarrollo.

```
    # 1. Configurar las variables globales
    En el apartado de Vip2Car/Variables se encuentran 2 variables de entorno:
        - base_url: #completar con la ruta de la api (php artisan serve)
        - api: #asignar => /api/
```


```
    # 2. Logearse y copiar el token
    - Existe el endpoint Auth/login, dentro de este deberemos ejecutar la solicitud y copiar el token de seguridad

    # 3. Pegar la autorización
    - Una vez copiado el token, nos dirigimos a Vip2Car/Authorization.
        - Escogemos la opción de BearerToken
        - Pegamos el token
```

Y listo, todos los endpoints estarán operativos para ser usados

# ACTIVIDAD 1
Se incluye el diagrama de base de datos Entidad-Relación tanto en formato pdf, como jpg, así como el script de base de datos hecho en transacSQL en la carpeta: BBDD.