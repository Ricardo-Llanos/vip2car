<?php

declare(strict_types=1);

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CreateClientRequest;
use App\Http\Requests\Client\IndexClientRequest;
use App\Http\Requests\Client\SearchClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    public function __construct(
        protected ClientService $clientService
    ){}

    /**
     * Muestra la lista completa (paginada) de los clientes registrados en el sistema
     * 
     * @param \App\Http\Requests\Client\IndexClientRequest $request
     * @return \Illuminate\Http\JsonResponse 
     */
    public function index(IndexClientRequest $request)
    {
        $data = $request->validated();

        $clients = $this->clientService->showAllClients($data);
        $clients->load(['vehicles']);

        return response()->json([
            'message' => 'Clientes obtenidos correctamente',
            'data' => ClientResource::collection($clients),
            'current_page' => $clients->currentPage(),
            'per_page' => $clients->perPage(),
            'last_page' => $clients->lastPage(),
            'total' => $clients->total(),
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateClientRequest $request)
    {
        $data = $request->validated();

        $client = $this->clientService->storeClient($data);

        return response()->json([
            'message' => 'Cliente creado correctamente',
            'data' => new ClientResource($client),
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $client = $this->clientService->showClient($id);
        $client->load(['vehicles']);

        return response()->json([
            'message' => 'Cliente obtenido correctamente',
            'data' => new ClientResource($client),
        ], Response::HTTP_OK);
    }

    public function search(SearchClientRequest $request){
        $data = $request->validated();

        $clients = $this->clientService->searchClient($data);
        $clients->load(['vehicles']);

        return response()->json([
            'message' => 'Búsqueda de usuarios realizada correctamente',
            'data' => ClientResource::collection($clients),
            'current_page' => $clients->currentPage(),
            'per_page' => $clients->perPage(),
            'last_page' => $clients->lastPage(),
            'total' => $clients->total(),
        ], Response::HTTP_OK);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, int $id)
    {
        $data = $request->validated();

        $client = $this->clientService->udpateClient($id,$data);
        
        return response()->json([
            'message' => 'Cliente actualizado correctamente',
            'data' => new ClientResource($client),
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->clientService->deleteClient($id);

        return response()->json([
            'message' => 'Cliente eliminado correctamente',
        ], Response::HTTP_OK);
    }
}
