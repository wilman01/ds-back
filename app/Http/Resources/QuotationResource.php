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
                "type_name" => $this->resource->type->name,
                "policy"=> $this->resource->policy,
                //"create_at"=>$this->resource->created_at->diffForHumans()
                "create_at"=>$this->resource->created_at
            ],
            'links'=>[
                'self'=>url('/api/quotation/' . $this->resource->getRouteKey())
            ]
        ];

        if ($this->resource->customer){
            $quotation['atribute']['customer'] = CustomerResource::make($this->resource->customer);
        }

        if ($this->resource->provider){
            $quotation['atribute']['provider'] = ProviderResource::make($this->resource->provider);
        }

        return $quotation;
    }
}
