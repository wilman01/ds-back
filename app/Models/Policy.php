<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'provider_id', 'name', 'coverage', 'description'];

    public function scopeBusqueda($query, $search)
    {
        $query->when($search ?? false, function($query, $s){
            $query->where('name', 'like', "%$s%");
        });

    }

    //relacion uno a muchos

    public function groups():\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Group::class);
    }

    //relaciones uno a muchos inversa
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    //relacion muchos a muchos
    public function details()
    {
        return $this->belongsToMany(Detail::class);
    }
}
