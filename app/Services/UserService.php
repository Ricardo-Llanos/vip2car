<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use App\Logging\ApiLogger;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ApiLogger $logger 
    ){}

    /**
     * Método especializado en la búsqueda todos los usuarios del sistema
     * 
     * El método implementa la paginación para así mantener el rendimiento ante consultas con muchos registros
     * 
     * @param array{per_page:int,page:int}
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator<User>
     */
    public function showAllUsers(array $data): LengthAwarePaginator{
        $users = User::query();

        return $this->paginateUsers(
            data: $data, 
            model: $users
        );
    }

    /**
     * Método especializado en la búsqueda unitaria de un usuario por medio del id (Index Seek)
     * 
     * @param int $id
     * @return App\Models\User
     */
    public function showUser(int $id){
        return User::findOrFail($id);
    }

    /**
     * Método especializado en la creación de un usuario.
     * 
     * El método utiliza una transacción para asegurar la integridad de la base de datos y el sistema
     * 
     * @param array{name:string,email:string} $data
     * @return App\Models\User
     */
    public function storeUser(array $data): User
    {
        return DB::transaction(function() use($data){
            $data['password'] = Hash::make('123456');

            $user = User::create($data);

            // -- Log del sistema --
            $this->logger->info(
                message: 'Usuario creado correctamente',
                context: [
                    'user_id' => $user->id
                ]
            );

            return $user;
        });
    }

    /**
     * Método especializado en la actualización de un usuario.
     * 
     * El método utiliza una transacción para asegurar la integridad de la base de datos y el sistema
     * 
     * @param int $userId - Identificador único del usuario
     * @param array{name:?string,email:?string} $data
     * @return App\Models\User
     */
    public function udpateUser(int $userId, array $data){
        return DB::transaction(function() use($userId, $data){
            $user = User::findOrFail($userId);
            
            $user->update($data);

            // -- Log del sistema --
            $this->logger->info(
                message: 'Usuario actualizado correctamente',
                context: [
                    'user_id' => $userId
                ]
            );

            return $user;
        });
    }

    /**
     * Método especializado en la eliminación de un usuario.
     * 
     * El método utiliza una transacción para asegurar la integridad de la base de datos y el sistema
     * 
     * @param int $userId - Identificador único del usuario
     * @return void
     */
    public function deleteUser(int $userId): void
    {
        DB::transaction(function() use($userId){
            $user = User::findOrFail($userId);

            $user->delete();

            // -- Log del sistema --
            $this->logger->info(
                message: 'Usuario eliminado correctemte',
                context: [
                    'user_name' => $user->name
                ]
            );
        });
    }

    /*================================================
        Métodos Helpers
    =================================================*/
    /**
     * Método helper especializado en la paginación de los usuarios
     * 
     * @param array{per_page:int,page:int} $data
     * @param \Illuminate\Database\Eloquent\Builder $model
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function paginateUsers(array $data, Builder $model): LengthAwarePaginator
    {
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
