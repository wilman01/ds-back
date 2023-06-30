<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehimodel extends Model
{
    use HasFactory;

    protected $table = 'vehi_models';
    protected $fillable = ['brand_id','model','status'];

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function version()
    {
        return $this->hasMany('App\Models\RelationshipVehi', 'vehi_model_id');
    }
}
