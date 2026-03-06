<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use function PHPSTORM_META\map;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'dni',
        'phone_code',
        'phone'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
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
     * Establece la relación N:1 (Uno a Muchos) con la tabla vehicles.
     * 
     * Relación: Client-> "hasMany" ->Vehicles;
     */
    public function vehicles(){
        return $this->HasMany(Vehicle::class);
    }

    /*================================================
        Métodos Helpers
    =================================================*/
    
}
