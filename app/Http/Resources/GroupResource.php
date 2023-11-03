<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type'=>'group',
            'id'=>(string) $this->resource->getRouteKey(),
            'atribute'=>[
                "id"=> (string) $this->resource->getRouteKey(),
                "group"=>$this->resource->group,
                "amount"=>(string) $this->resource->amount,
                "deductible"=>(string) $this->resource->deductible
            ],
            'links'=>[
                'self'=>url('/api/group/' . $this->resource->getRouteKey()),
            ]
        ];
    }
}
