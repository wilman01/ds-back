<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'provider_id', 'name', 'amount', 'coverage', 'detail'];

    public function scopeBusqueda($query, $search)
    {
        $query->when($search ?? false, function($query, $s){
            $query->where('name', 'like', "%$s%");
        });

    }

    //relación uno a muchos inversa
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
