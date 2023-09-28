<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function scopeBusqueda($query, $search)
    {
        $query->when($search ?? false, function($query, $s){
            $query->where('name', 'like', "%$s%");
        });

    }

    //relacion muchos a muchos
    public function polices()
    {
        return $this->belongsToMany(Policy::class);
    }
}
