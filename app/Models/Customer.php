<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public mixed $id;
    protected $fillable = ['name', 'last_name', 'cedula', 'email', 'birthdate', 'phone', 'status'];

    public function scopeBusqueda($query, $s)
    {
        if ($s) {
            return $query->where('cedula', 'like', "%$s%")
                ->orWhere('name', 'like', "%$s%")
                ->orWhere('last_name', 'like', "%$s%")
                ->orWhere('email', 'like', "%$s%");
        }
    }
    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
}
