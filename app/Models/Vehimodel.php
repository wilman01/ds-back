<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehimodel extends Model
{
    use HasFactory;

    protected $table = 'vehi_models';
    protected $fillable = ['model', 'status'];
}
