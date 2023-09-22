<?php
namespace App\Repositories;

use App\Models\RelationshipVehi;
use App\Models\Vehiversion;

class RelationshipvehiRepository extends BaseRepository
{
    const RELATIONS =[
        'vehiversion',
        'year'
    ];

    public function __construct(RelationshipVehi $relationshipVehi)
    {
        parent::__construct($relationshipVehi, self::RELATIONS);
    }

    public function search($request)
    {
        $querybuilder = $this->model
                    ->with(self::RELATIONS)
                    ->when($request->vehi_model_id ?? false, function($query, $vehi_model_id){
                        $query->where('vehi_model_id', $vehi_model_id);
                            })
                    ->when($request->q ?? false, function($query, $version){
                        $query->whereExists(function($query) use ($version){
                            $query->from('vehi_versions')
                                ->whereColumn('vehi_versions.id', 'relationship_vehi.vehi_version_id')
                                ->where('vehi_versions.version', 'LIKE', "%{$version}%");
                        });
                    })
                    ->when($request->year ?? false, function($query, $year){
                        $query->whereExists(function($query) use ($year){
                            $query->from('years')
                                ->whereColumn('years.id', 'relationship_vehi.year_id')
                                ->where('years.id', $year);
                        });
                    })
                    ->paginate(10);

        return $querybuilder;
    }

}
