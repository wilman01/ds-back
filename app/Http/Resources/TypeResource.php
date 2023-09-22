<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'type',
            'id' => (string) $this->resource->getRouteKey(),
            'atributes' => [
                'id' => (string) $this->resource->getRouteKey(),
                'name'=> $this->resource->name
            ],
            'links'=> [
                'self'=>route('api.type.show', $this->resource->getRouteKey())
            ]
        ];
    }
}
