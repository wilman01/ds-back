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
                ->select('vehi_models.id', 'vehi_models.model', 'vehi_models.status')
                ->join('relationship_vehi', 'vehi_models.id', '=', 'relationship_vehi.vehi_model_id')
                ->where($where)
                ->orderBy('vehi_models.model')
                ->groupBy('vehi_models.model')
                ->paginate(10);
        return $query;
    }

}
