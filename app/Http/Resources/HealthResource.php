<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HealthResource extends JsonResource
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
                //"create_at"=>$this->resource->created_at->diffForHumans()
                "create_at"=>$this->resource->created_at
            ],
            'links'=>[
                'self'=>url('/api/quotation/' . $this->resource->getRouteKey())
            ]
        ];

        if ($this->resource->customer){
            $health['atribute']['customer_id'] =(string) $this->resource->customer_id;
            $health['atribute']['customer_cedula'] =$this->resource->customer->cedula;
            $health['atribute']['customer_name'] =$this->resource->customer->name . " " . $this->resource->customer->last_name;
            $health['atribute']['customer_email'] =$this->resource->customer->email;
            $health['atribute']['customer_phone'] =$this->resource->customer->phone;
            $health['atribute']['customer_status'] =$this->resource->customer->status;
        }

        if ($this->resource->type){
            $health['atribute']['type_id'] = (string) $this->resource->type->id;
            $health['atribute']['type_name'] = $this->resource->type->name;
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
