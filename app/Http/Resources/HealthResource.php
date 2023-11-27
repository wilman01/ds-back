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
            'id'=>(string) $this->resource->healths_id,
            'atribute'=>[
                "id"=> (string) $this->resource->healths_id,
                "amount_health" => (string)$this->resource->amount_health,
                "status"=>$this->resource->attended,
                //"create_at"=>$this->resource->created_at->diffForHumans()
                "create_at"=>$this->resource->created_at,
                "customer_id"=> (string)$this->resource->customer_id,
                "customer_cedula"=>$this->resource->cedula,
                "customer_name"=>$this->resource->name . " " . $this->resource->last_name,
                "customer_email"=>$this->resource->email,
                "customer_birthdate"=>$this->resource->birthdate,
                "customer_phone"=>$this->resource->phone,
                "customer_status"=>$this->resource->status,
                "type_id"=> (string)$this->resource->types_id,
                "type_name"=>$this->resource->types_name,
                "policy_id"=> (string)$this->resource->policies_id,
                "policy_name"=>$this->resource->policies_name,
                "providers_id"=> (string)$this->resource->providers_id,
                "providers_name"=>$this->resource->providers_name
            ],
            'links'=>[
                'self'=>url('/api/health/' . $this->resource->healths_id)
            ]
        ];

//        if ($this->resource->customer){
//            $health['atribute']['customer_id'] =(string) $this->resource->customer_id;
//            $health['atribute']['customer_cedula'] =$this->resource->customer->cedula;
//            $health['atribute']['customer_name'] =$this->resource->customer->name . " " . $this->resource->customer->last_name;
//            $health['atribute']['customer_email'] =$this->resource->customer->email;
//            $health['atribute']['customer_phone'] =$this->resource->customer->phone;
//            $health['atribute']['customer_status'] =$this->resource->customer->status;
//        }
//
//        if ($this->resource->policy->type){
//            $health['atribute']['type_id'] = (string) $this->resource->policy->type->id;
//            $health['atribute']['type_name'] = $this->resource->policy->type->name;
//        }
//
//        if ($this->resource->policy){
//            $health['atribute']['policy_id'] = (string) $this->resource->policy->id;
//            $health['atribute']['policy_name'] = $this->resource->policy->name;
//        }

        //=====================La funcionalidad de agregar familiares queda para otra version
//        if ($this->resource->ages){
//            $health['atribute']['ages'] = AgeResource::collection($this->resource->ages);
//        }

        return $health;
    }
}
