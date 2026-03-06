<?php

// TODO - Terminar de implementar los controlares y services
// TODO - Terminar de implementar los resources
// TODO - Terminar de implementar los errores personalizados en el app.php (bootstrap)
// TODO - Con fe con el frontend

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ClientController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\VehicleController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Endpoints de users (Inicio de sesión)
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::get('/search-user', [UserController::class, 'search']);
    Route::post('/create-user', [UserController::class, 'store']);
    Route::put('/update-user/{id}', [UserController::class, 'update']);
    Route::delete('/delete-user/{id}', [UserController::class, 'destroy']);

    // Endpoints de clientes
    Route::get('/clients', [ClientController::class, 'index']);
    Route::get('/client/{id}', [ClientController::class, 'show']);
    Route::get('/search-client', [ClientController::class, 'search']);
    Route::post('/create-client', [ClientController::class, 'store']);
    Route::put('/update-client/{id}', [ClientController::class, 'update']);
    Route::delete('/delete-client/{id}', [ClientController::class, 'destroy']);

    // Endpoints de vehículos
    Route::get('/vehicles', [VehicleController::class, 'index']);
    Route::get('/vehicle/{id}', [VehicleController::class, 'show']);
    Route::get('/search-vehicle', [VehicleController::class, 'search']);
    Route::post('/create-vehicle', [VehicleController::class, 'store']);
    Route::put('/update-vehicle/{id}', [VehicleController::class, 'update']);
    Route::delete('/delete-vehicle/{id}', [VehicleController::class, 'destroy']);
});