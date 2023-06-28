<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type'=>'brand',
            'id'=>(string) $this->resource->getRouteKey(),
            'atribute'=>[
                "id"=> (string) $this->resource->getRouteKey(),
                "brand"=>$this->resource->brand,
                "status"=> $this->resource->status
            ],
            'links'=>[
                'self'=>url('/api/brand/' . $this->resource->getRouteKey())
            ]
        ];
    }
}
