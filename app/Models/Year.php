<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Year extends Model
{
    use HasFactory;

    protected $fillable = ['year'];

    public function vehi_versions(){
        return $this->belongsToMany('App\Models\Vehiversion');
    }
}
