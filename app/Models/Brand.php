<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['brand', 'status'];

    public function vehimodels()
    {
        return $this->HasMany('App\Models\Vehimodel');
    }

}
