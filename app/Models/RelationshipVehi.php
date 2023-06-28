<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Vehimodel;
use App\Models\Year;
use App\Models\Vehiversion;

class RelationshipVehi extends Model
{
    use HasFactory;
    
    protected $table = 'relationship_vehi';

    protected $fillable = ['vehi_model_id', 'vehi_version_id', 'year_id'];

    public function save_relation($data){
        $model = Vehimodel::where('model', $data['vehi_model'])->first();
        $version = Vehiversion::where('version', $data['vehi_version'])->first();
        $year = Year::where('year', $data['year'])->first();

        $this->vehi_model_id = $model->id;
        $this->vehi_version_id = $version->id;
        $this->year_id = $year->id;

        return self::save();
    }

    public function year()
    {
        return $this->belongsTo('App\Models\Year', 'year_id');
    }

    public function vehimodel()
    {
        return $this->belongsTo('App\Models\Vehimodel', 'vehi_model_id');
    }

    public function vehiversion()
    {
        return $this->belongsTo('App\Models\Vehiversion', 'vehi_version_id');
    }
}
