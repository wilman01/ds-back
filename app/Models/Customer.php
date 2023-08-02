<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public mixed $id;
    protected $fillable = ['name', 'last_name', 'cedula', 'email', 'phone'];

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
}
