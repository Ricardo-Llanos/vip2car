<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

use App\Logging\ApiLogger;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class VehicleService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ApiLogger $logger
    ){}

    /**
     * Método especializado en la búsqueda todos los vehicles del sistema
     * 
     * El método implementa la paginación para así mantener el rendimiento ante consultas con muchos registros
     * 
     * @param array{page:int,per_page:int} $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function showAllVehicles(array $data): LengthAwarePaginator
    {
        $vehicles = Vehicle::query();

        return $this->paginateVehicle(
            paginate: $data, 
            model: $vehicles
        );
    }

    /**
     * Método especializado en la búsqueda unitaria de un vehicle por medio del id (Index Seek)     * 
     * @param int $id
     * @return App\Models\Vehicle
     */
    public function showVehicle(int $id): Vehicle
    {
        return Vehicle::findOrFail($id);
    }

    /**
     * Método especializado en la creación de un vehicle.
     * 
     * El método utiliza una transacción para asegurar la integridad de la base de datos y el sistema
     * 
     * @param array{client_id:int,plate:string,brand:string,model:string,manufacturing_year:string} $data
     * @return App\Models\Vehicle
     */
    public function storeVehicle(array $data): Vehicle
    {
        return DB::transaction(function() use($data){
            $vehicle = Vehicle::create($data);

            // -- Log del sistema --
            $this->logger->info(
                message: 'Vehículo creado correctamente',
                context: [
                    'vehicle_id' => $vehicle->id
                ]
            );

            return $vehicle;
        });
    }

    /**
     * Método especializado en la actualización de un vehículo.
     * 
     * El método utiliza una transacción para asegurar la integridad de la base de datos y el sistema
     * 
     * @param int $vehicleId - Identificador único del vehículo
     * @param array{client_id:int,plate:string,brand:string,model:string,manufacturing_year:string} $data
     * @return App\Models\Vehicle
     */
    public function updateVehicle(int $vehicleId, array $data): Vehicle
    {
        return DB::transaction(function() use($vehicleId, $data){
            $vehicle = Vehicle::findOrFail($vehicleId);
            
            $vehicle->update($data);

            // -- Log del sistema --
            $this->logger->info(
                message: 'Vehículo actualizado correctamente',
                context: [
                    'vehicle_id' => $vehicleId
                ]
            );

            return $vehicle;
        });
    }

    /**
     * Método especializado en la eliminación de un vehicle.
     * 
     * El método utiliza una transacción para asegurar la integridad de la base de datos y el sistema
     * 
     * @param int $vehicleId - Identificador único del vehículo
     * @return void
     */
    public function deleteVehicle(int $vehicleId): void
    {
        DB::transaction(function() use($vehicleId){
            $vehicle = Vehicle::findOrFail($vehicleId);

            $vehicle->delete();

            // -- Log del sistema --
            $this->logger->info(
                message: 'Vehículo eliminado correctemte',
                context: [
                    'vehicle_name' => $vehicle->name
                ]
            );
        });
    }

    /*================================================
        Métodos Helpers
    =================================================*/

    /**
     * Método helper especializado en la paginación de los vehicles
     * 
     * @param array{page:int,per_page:int} $paginate
     * @param \Illuminate\Database\Eloquent\Builder $model
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateVehicle(array $paginate, Builder $model): LengthAwarePaginator
    {
        if (empty($paginate['page'])){
            $paginate['page'] = 1;
        }

        if (empty($paginate['per_page'])){
            $paginate['per_page'] = 20;
        }

        return $model->paginate(
            perPage: $paginate['per_page'],
            page: $paginate['page']
        );
    }
}
