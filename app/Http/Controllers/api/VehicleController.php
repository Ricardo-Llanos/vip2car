<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vehicle\CreateVehicleRequest;
use App\Http\Requests\Vehicle\IndexVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Services\VehicleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VehicleController extends Controller
{
    public function __construct(
        protected VehicleService $vehicleService
    ){}

    /**
     * Muestra la lista completa (paginada) de los vehículos registrados en el sistema
     * 
     * @param \App\Http\Requests\User\IndexUserRequest $request
     * @return \Illuminate\Http\JsonResponse 
     */
    public function index(IndexVehicleRequest $request)
    {
        $data = $request->validated();

        $vehicles = $this->vehicleService->showAllVehicles($data);
        $vehicles->load(['client']);

        return response()->json([
            'message' => 'Vehículos obtenidos correctamente',
            'data' => VehicleResource::collection($vehicles),
            'current_page' => $vehicles->currentPage(),
            'per_page' => $vehicles->perPage(),
            'last_page' => $vehicles->lastPage(),
            'total' => $vehicles->total(),
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateVehicleRequest $request)
    {
        $data = $request->validated();

        $vehicle = $this->vehicleService->storeVehicle($data);

        return response()->json([
            'message' => 'Vehículo creado correctamente',
            'data' => new VehicleResource($vehicle),
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $user = $this->vehicleService->showVehicle($id);
        $user->load(['vehicles']);

        return response()->json([
            'message' => 'Vehículo obtenido correctamente',
            'data' => new VehicleResource($user),
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, int $id)
    {
        $data = $request->validated();

        $user = $this->vehicleService->updateVehicle($id,$data);
        
        return response()->json([
            'message' => 'Vehículo actualizado correctamente',
            'data' => new VehicleResource($user),
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->vehicleService->deleteVehicle($id);

        return response()->json([
            'message' => 'Vehículo eliminado correctamente',
        ], Response::HTTP_OK);
    }
}
