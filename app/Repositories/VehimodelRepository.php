<?php
namespace App\Repositories;

use App\Models\Brand;
use App\Models\Vehimodel;

class VehiModelRepository extends BaseRepository
{
    const RELATIONS =[
        'year'
    ];

    public function __construct(Vehimodel $vehiModel)
    {
        parent::__construct($vehiModel, self::RELATIONS);
    }

    public function allModel($request, $where)
    {
        $query = $this->model
                ->join('relationship_vehi', 'vehi_models.id', '=', 'relationship_vehi.vehi_model_id')
                ->where($where)
                ->paginate(10);
        return $query;
    }
    
}