<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuotationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $quotation = [
            'type'=>'quotation',
            'id'=>(string) $this->resource->getRouteKey(),
            'atribute'=>[
                "id"=> (string) $this->resource->getRouteKey(),
                "type_id" => $this->resource->type_id,
                "supplier"=>$this->resource->supplier,
                "policy"=> $this->resource->policy,
                //"create_at"=>$this->resource->created_at->diffForHumans()
                "create_at"=>$this->resource->created_at
            ],
            'links'=>[
                'self'=>url('/api/quotation/' . $this->resource->getRouteKey())
            ]
        ];
        if ($this->resource->customer){
            $quotation['atribute']['customer_id'] =(string) $this->resource->customer_id;
            $quotation['atribute']['customer_cedula'] =$this->resource->customer->cedula;
            $quotation['atribute']['customer_name'] =$this->resource->customer->name . " " . $this->resource->customer->last_name;
            $quotation['atribute']['customer_email'] =$this->resource->customer->email;
            $quotation['atribute']['customer_phone'] =$this->resource->customer->phone;

        }

        return $quotation;
    }
}
