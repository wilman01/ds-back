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
                "email"=> $this->resource->email,
                "phone"=>$this->resource->phone,
            ],
            'links'=>[
                'self'=>url('/api/customer/' . $this->resource->getRouteKey())
            ]
    ];
    }
}
