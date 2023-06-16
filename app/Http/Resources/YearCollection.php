<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class YearCollection extends ResourceCollection
{
    public $collects = YearResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'links'=>[
                'self'=>route('api.year.index')
            ],
            'meta' => [
                'years_count' => $this->collection->count()  
            ]
        ];
    }
}
