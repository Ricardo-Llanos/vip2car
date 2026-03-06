<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'plate',
        'brand',
        'model',
        'manufacturing_year',
    ];

    protected function casts(){
        return [
            'created_at' => 'datetime',
            'modified_at' => 'datetime',
        ];
    }

    /*================================================
        Definición de Relaciones con otras Tablas
    =================================================*/
    /**
     * Establece la relación N:1 (Uno a Muchos) con la tabla clients.
     * 
     * Relación: Vehicle -> "belongsTo" -> Client;
     */
    public function client(){
        return $this->belongsTo(Client::class);
    }

    /*================================================
        Métodos de Utilidad
    =================================================*/
}
