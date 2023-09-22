<?php
namespace App\Repositories;

use App\Models\Brand;
use App\Models\RelationshipVehi;

class BrandRepository extends BaseRepository
{
    const RELATIONS =[
        'vehimodels'
    ];

    public function __construct(Brand $brand)
    {
        parent::__construct($brand, self::RELATIONS);
    }

    public function allBrand($request)
    {
        $querybuilder = $this->model
                    ->select('brands.id','brands.brand','brands.status')
                    ->join('vehi_models', 'vehi_models.brand_id', '=', 'brands.id')
                    ->join('relationship_vehi', 'relationship_vehi.vehi_model_id', '=', 'vehi_models.id')
                    ->when($request->year_id ?? false, function($query, $year_id){
                        $query->whereExists(function($query) use ($year_id){
                            $query->where('relationship_vehi.year_id', $year_id);
                        });
                    })
                    ->when($request->q ?? false, function($query, $brand){
                        $query->where('brand', 'LIKE', "%$brand%");
                    })
                    ->groupBy('brand')
                    ->orderBy('brand')
                    ->paginate(10);
        return $querybuilder;
    }
    
}