<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PolicyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $policy = [
            'type'=>'policy',
            'id'=>(string) $this->resource->getRouteKey(),
            'atribute'=>[
                "id"=> (string) $this->resource->getRouteKey(),
                "name"=>$this->resource->name,
                "amount"=> (string)$this->resource->amount,
                "coverage"=>(string)$this->resource->coverage,
                "description"=> $this->resource->description,
            ],
            'links'=>[
                'self'=>url('/api/policy/' . $this->resource->getRouteKey()),
            ]
        ];
        if($this->resource->type){
            $policy['atribute']['type'] = $this->resource->type->name;
        }

        if ($this->resource->provider){
            $policy['atribute']['provider_id'] =(string) $this->resource->provider_id;
            $policy['atribute']['provider_name'] =$this->resource->provider->name;
            $policy['links']['provider_link'] = url('/api/provider/' . $this->resource->provider_id);
        }

        return $policy;
    }
}
