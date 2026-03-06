<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'dni' => $this->dni,
            'phone_code' => $this->phone_code,
            'phone' => $this->phone,

            'vehicles' => $this->whenLoaded('vehicles', function(){
                return VehicleResource::collection($this->vehicles);
            }),
        ];
    }
}
