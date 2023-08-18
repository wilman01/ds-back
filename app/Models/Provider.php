<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rif',
        'contact',
        'email',
        'phone'
    ];

    public function scopeBusqueda($query, $search)
    {
        $query->when($search ?? false, function($query, $s){
            $query->where('name', 'like', "%$s%")
                ->orWhere('rif', 'like', "%$s%")
                ->orWhere('contact', 'like', "%$s%")
                ->orWhere('email', 'like', "%$s%");
        });

    }

    //relación uno a muchos
    public function policies()
    {
        $this->hasMany(Policy::class);
    }
}
