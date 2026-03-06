<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

use App\Models\User;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        // TODO - Implementar el logger
        // protected ApiLogger $logger
    )
    {}

    /**
     * Método especializado para manejar el inicio de sesión del usuario
     * 
     * @param array{email:string,password:string} $data
     * @return array{user:string,token:string,type:string}
     */
    public function loginUser(array $data): array
    {
        $user = User::where('email', $data['email'])->first();

        $authorize = Hash::check($data['password'], $user->password);

        if (!$authorize){
            throw new UnauthorizedException(
                message: 'Usuario u contraseña incorrecto.'
            );
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        // -- Log del sistema --
        // $this->logger->info(
        //     message: 'Inicio de sesión exitoso'
        // );

        return [
            'user' => $user,
            'token' => $token,
            'type' => 'Bearer'
        ];
    }

    /**
     * Método especializado para manejar el cierre de sesión del usuario
     * 
     * @param App\Models\User $user
     * @return void
     */
    public function logoutUser(User $user): void
    {
        $user->currentAccessToken()->delete();

        // -- Log del sistema --
        // $this->logger->debug(
        //     message: 'Cierre de sesión exitoso'
        // );
    }

    // TODO - Future: agregar validación de ingresos (una cantidad máxima de 3)
}
