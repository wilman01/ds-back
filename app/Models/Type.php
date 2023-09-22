<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function scopeBusqueda($query, $search)
    {
        $query->when($search ?? false, function($query, $s){
            $query->where('name', 'like', "%$s%");
        });
    }

    //Relacion uno a muchos
    public function policies()
    {
        return $this->hasMany(Policy::class);
    }
}
