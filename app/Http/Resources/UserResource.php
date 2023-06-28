<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                'type'=>'user',
                'id'=>(string) $this->resource->getRouteKey(),
                'atribute'=>[
                    "id"=> (string) $this->resource->getRouteKey(),
                    "cedula"=>$this->resource->cedula,
                    "name"=> $this->resource->name,
                    "last_name"=>$this->resource->last_name,
                    "status"=>$this->resource->status,
                    "email"=> $this->resource->email,
                ],
                'links'=>[
                    'self'=>url('/api/user/' . $this->resource->getRouteKey())
                ]
        ];
    }
}
