<?php

declare(strict_types=1);

namespace App\Services;

use App\Logging\ApiLogger;
use App\Models\Client;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ClientService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ApiLogger $logger 
    ){}

    /**
     * Método especializado en la búsqueda todos los clientes del sistema
     * 
     * El método implementa la paginación para así mantener el rendimiento ante consultas con muchos registros
     * 
     * @param array{per_page:int,page:int}
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator<Client>
     */
    public function showAllClients(array $data): LengthAwarePaginator
    {
        $clients = Client::query();

        return $this->paginateClients(
            data: $data, 
            model: $clients
        );
    }

    /**
     * Método especializado en la búsqueda unitaria de un cliente por medio del id (Index Seek)
     * 
     * @param int $id
     * @return App\Models\Client
     */
    public function showClient(int $id): Client
    {
        return Client::findOrFail($id);
    }

    /**
     * Método especializado en la creación de un cliente.
     * 
     * El método utiliza una transacción para asegurar la integridad de la base de datos y el sistema
     * 
     * @param array{name:string,lastname:string,dni:string,phone_code:string,phone:string} $data
     * @return App\Models\Client
     */
    public function storeClient(array $data): Client
    {
        return DB::transaction(function() use($data){
            $client = Client::create($data);

            // -- Log del sistema --
            $this->logger->info(
                message: 'Cliente creado correctamente',
                context: [
                    'client_id' => $client->id
                ]
            );

            return $client;
        });
    }

    /**
     * Método especializado en la actualización de un cliente.
     * 
     * El método utiliza una transacción para asegurar la integridad de la base de datos y el sistema
     * 
     * @param int $clientId - Identificador único del cliente
     * @param array{name:?string,lastname:?string,dni:?string,phone_code:?string,phone:?string} $data
     * @return App\Models\Client
     */
    public function udpateClient(int $clientId, array $data): Client
    {
        return DB::transaction(function() use($clientId, $data){
            $client = Client::findOrFail($clientId);
            
            $client->update($data);

            // -- Log del sistema --
            $this->logger->info(
                message: 'Cliente actualizado correctamente',
                context: [
                    'client_id' => $client->id
                ]
            );

            return $client;
        });
    }

        /**
     * Método especializado en la creación de un cliente.
     * 
     * El método utiliza una transacción para asegurar la integridad de la base de datos y el sistema
     * 
     * @param int $clientId - Identificador único del cliente
     * @return void
     */
    public function deleteClient(int $clientId): void
    {
        DB::transaction(function() use($clientId){
            $client = Client::findOrFail($clientId);

            $client->delete();

            // -- Log del sistema --
            $this->logger->info(
                message: 'Cliente eliminado correctamente',
                context: [
                    'client_name' => $client->name
                ]
            );
        });
    }
    /*================================================
        Métodos Helpers
    =================================================*/
    /**
     * Método helper especializado en la paginación de los clientes
     * 
     * @param array{per_page:int,page:int} $data
     * @param \Illuminate\Database\Eloquent\Builder $model
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function paginateClients(array $data, Builder $model){
        if (empty($data['page'])){
            $data['page'] = 1;
        }

        if (empty($data['per_page'])){
            $data['per_page'] = 20;
        }

        return $model->paginate(
            page: $data['page'],
            perPage: $data['per_page']
        );
    }
}
