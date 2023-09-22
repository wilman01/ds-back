<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehiversionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $vehiversion=['type'=>'vehiversion',
                        'id'=>(string) $this->resource->vehiversion->getRouteKey(),
                        'atribute'=>[
                            "id"=> (string) $this->resource->vehiversion->getRouteKey(),
                            "version"=>$this->resource->vehiversion->version,
                            "status"=> $this->resource->vehiversion->status,
                            "model_id" => $this->resource->vehi_model_id
                            ],
                        'links'=>[
                            'self'=>url('/api/vehiversion/' . $this->resource->getRouteKey())
                            ]
                    ];
        if ($this->resource->year){

        $vehiversion['atribute']['year'] = $this->resource->year->year;
        $vehiversion['atribute']['year_id'] = $this->resource->year->id;
        }

        return $vehiversion;
    }
}
