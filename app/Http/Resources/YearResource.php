<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class YearResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'year',
            'id' => (string) $this->resource->getRouteKey(),
            'atributes' => [
                'id' => (string) $this->resource->getRouteKey(),
                'year'=> $this->resource->year
            ],
            'links'=> [
                'self'=>route('api.year.show', $this->resource)
            ]
        ];
    }
}
