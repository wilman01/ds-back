<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehimodelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $vehimodel=['type'=>'vehimodel',
                    'id'=>(string) $this->resource->getRouteKey(),
                    'atribute'=>[
                        "id"=> (string) $this->resource->getRouteKey(),
                        "model"=>$this->resource->model,
                        "status"=> $this->resource->status
                        ],
                        'links'=>[
                            'self'=>url('/api/brand/' . $this->resource->getRouteKey())
                        ]
                    ];
        if ($this->resource->brand){
            $vehimodel['atribute']['brand'] = $this->resource->brand->brand;
            $vehimodel['atribute']['brand_id'] = $this->resource->brand->id;
        }

        return $vehimodel;
    }
}
