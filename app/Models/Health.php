<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    use HasFactory;

    protected $table = 'healths';

    protected $fillable = [
        'policy_id',
        'customer_id',
        'attended'
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

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function policy():\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Policy::class);
    }

    public function ages():\Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Age::class)
            ->withPivot('quantity');
    }

}
