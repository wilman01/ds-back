<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiversion extends Model
{
    use HasFactory;

    protected $table = 'vehi_versions';
    protected $fillable = ['version', 'status'];

    // public function years(){
    //     return $this->belongsToMany('App\Models\Year', 'vehi_version_year', 'vehi_version_id');
    // }
    
  
    public function relationship()
    {
        return $this->hasMany('App\Models\RelationshipVehi', 'vehi_version_id');
    }
}
