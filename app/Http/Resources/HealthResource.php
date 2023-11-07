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
                "amount_health" => (string)$this->resource->amount_health,
                "status"=>$this->resource->attended,
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

        if ($this->resource->policy->type){
            $health['atribute']['type_id'] = (string) $this->resource->policy->type->id;
            $health['atribute']['type_name'] = $this->resource->policy->type->name;
        }

        if ($this->resource->policy){
            $health['atribute']['policy_id'] = (string) $this->resource->policy->id;
            $health['atribute']['policy_name'] = $this->resource->policy->name;
        }

        //=====================La funcionalidad de agregar familiares queda para otra version
//        if ($this->resource->ages){
//            $health['atribute']['ages'] = AgeResource::collection($this->resource->ages);
//        }

        return $health;
    }
}
