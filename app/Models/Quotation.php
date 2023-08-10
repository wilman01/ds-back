<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'supplier',
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

}
