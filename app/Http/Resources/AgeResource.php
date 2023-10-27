<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type'=>'age',
            'id'=>(string) $this->resource->getRouteKey(),
            'atribute'=>[
                "id"=> (string) $this->resource->getRouteKey(),
                "group"=>$this->resource->group,
                "quantity"=>$this->resource->pivot->quantity
            ]
        ];
    }
}
