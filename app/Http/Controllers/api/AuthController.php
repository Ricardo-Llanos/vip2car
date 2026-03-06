<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authorization\AuthRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ){}

    /**
     * Método especializado en la orquestación del cierre de sesión del usuario.
     * 
     * Combina todos los demás métodos necesarios para llevar a cabo el inicio de sesión:
     *  - AuthRequest
     *  - AuthService
     *  - UserResource
     * 
     * @param \App\Http\Requests\Authorization\AuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthRequest $request): JsonResponse
    {
        $data = $request->validated();

        [
            'user' => $user,
            'token' => $token,
            'type' => $type
        ] = $this->authService->loginUser($data);

        return response()->json([
            'message' => 'Inicio de sesión realizado correctamente.',
            'user' => new UserResource($user),
            'token' => $token,
            'type' => $type
        ]);
    }

    /**
     * Método especializado en la orquestación del cierre de sesión del usuario.
     * 
     * Combina todos los demás métodos necesarios para llevar a cabo el inicio de sesión:
     *  - AuthRequest
     *  - AuthService
     *  - UserResource
     * 
     * @param \App\Http\Requests\Authorization\AuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(){
        $user = auth()->user();

        $this->authService->logoutUser($user);

        return response()->json([
            'message' => 'Cierre de sesión realizado correctamente.'
        ]);
    }
}
