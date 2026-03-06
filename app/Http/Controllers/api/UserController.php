<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Response;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\SearchUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ){}

    /**
     * Muestra la lista completa (paginada) de los usuarios registrados en el sistema
     * 
     * @param \App\Http\Requests\User\IndexUserRequest $request
     * @return \Illuminate\Http\JsonResponse 
     */
    public function index(IndexUserRequest $request)
    {
        $data = $request->validated();

        $users = $this->userService->showAllUsers($data);

        return response()->json([
            'message' => 'Usuarios obtenidos correctamente',
            'data' => UserResource::collection($users),
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage(),
            'last_page' => $users->lastPage(),
            'total' => $users->total(),
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();

        $user = $this->userService->storeUser($data);

        return response()->json([
            'message' => 'Usuario creado correctamente',
            'data' => new UserResource($user),
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $user = $this->userService->showUser($id);

        return response()->json([
            'message' => 'Usuario obtenido correctamente',
            'data' => new UserResource($user),
        ], Response::HTTP_OK);
    }

    public function search(SearchUserRequest $request){
        $data = $request->validated();

        $users = $this->userService->searchUser($data);

        return response()->json([
            'message' => 'Búsqueda de usuarios realizada correctamente',
            'data' => UserResource::collection($users),
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage(),
            'last_page' => $users->lastPage(),
            'total' => $users->total(),
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $data = $request->validated();

        $user = $this->userService->udpateUser($id,$data);
        
        return response()->json([
            'message' => 'Cliente actualizado correctamente',
            'data' => new UserResource($user),
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->userService->deleteUser($id);

        return response()->json([
            'message' => 'Usuario eliminado correctamente',
        ], Response::HTTP_OK);
    }
}
