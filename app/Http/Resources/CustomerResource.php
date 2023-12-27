<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type'=>'customer',
            'id'=>(string) $this->resource->getRouteKey(),
            'atribute'=>[
                "id"=> (string) $this->resource->getRouteKey(),
                "cedula"=>$this->resource->cedula,
                "name"=> $this->resource->name,
                "last_name"=>$this->resource->last_name,
                "gender"=>$this->resource->gender,
                "email"=> $this->resource->email,
                "birthdate"=>$this->resource->birthdate,
                "phone"=>$this->resource->phone,
                "status"=>$this->resource->status
            ],
            'links'=>[
                'self'=>url('/api/customer/' . $this->resource->getRouteKey())
            ]
        ];

    }
}
