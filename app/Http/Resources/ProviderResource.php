<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type'=>'provider',
            'id'=>(string) $this->resource->getRouteKey(),
            'atribute'=>[
                "id"=> (string) $this->resource->getRouteKey(),
                "name"=>$this->resource->name,
                "rif"=> $this->resource->rif,
                "contact"=>$this->resource->contact,
                "email"=> $this->resource->email,
                "phone"=>$this->resource->phone,
            ],
            'links'=>[
                'self'=>url('/api/provider/' . $this->resource->getRouteKey())
            ]
        ];
    }
}
