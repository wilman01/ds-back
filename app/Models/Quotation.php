<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'provider_id',
        'customer_id',
        'policy',
    ];

    public function scopeBusqueda($query, $search)
    {
        $query->when($search ?? false, function($query, $search){
            $query->where('customer.name', 'like', "%$search%");
        });

    }
    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function provider():\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function type():\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return  $this->belongsTo(Type::class);
    }

}
