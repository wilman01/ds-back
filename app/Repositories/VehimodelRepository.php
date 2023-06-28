<?php
namespace App\Repositories;

use App\Models\Brand;
use App\Models\Vehimodel;

class VehiModelRepository extends BaseRepository
{
    // const RELATIONS =[
    //     ''
    // ];

    public function __construct(Vehimodel $vehiModel)
    {
        parent::__construct($vehiModel);
    }
    
}