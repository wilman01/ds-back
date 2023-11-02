<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $health = [
            'type'=>'health',
            'id'=>(string) $this->resource->getRouteKey(),
            'atribute'=>[
                "id"=> (string) $this->resource->getRouteKey(),
                "create_at"=>$this->resource->created_at
            ],
            'links'=>[
                'self'=>url('/api/quotation/' . $this->resource->getRouteKey())
            ]
        ];

        if ($this->resource->policy->type){
            $health['atribute']['type_id'] = (string) $this->resource->policy->type->id;
            $health['atribute']['type_name'] = $this->resource->policy->type->name;
        }

        if ($this->resource->policy){
            $health['atribute']['policy_id'] = (string) $this->resource->policy->id;
            $health['atribute']['policy_name'] = $this->resource->policy->name;
        }

        if ($this->resource->ages){
            $health['atribute']['ages'] = AgeResource::collection($this->resource->ages);
        }

        return $health;
    }
}
