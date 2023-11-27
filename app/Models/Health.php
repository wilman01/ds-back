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
        'amount_health',
        'installments',
        'attended'
    ];

    public function scopeFields($query)
    {
        $query->select('healths.id as healths_id',
                'healths.policy_id',
                'healths.customer_id',
                'healths.amount_health',
                'healths.installments',
                'healths.attended',
                'healths.created_at',
                'customers.cedula',
                'customers.name',
                'customers.last_name',
                'customers.birthdate',
                'customers.email',
                'customers.phone',
                'customers.status',
                'policies.id as policies_id',
                'policies.type_id',
                'policies.name as policies_name',
                'policies.coverage',
                'providers.id as providers_id',
                'providers.name as providers_name',
                'types.id as types_id',
                'types.name as types_name'
            );
    }
    public function scopeBusqueda($query, $search)
    {
        $query->when($search ?? false, function($query, $search){
            $query->where('customers.cedula', 'like', "%$search%")
                    ->orWhere('customers.name', 'like', "%$search%")
                    ->orWhere('customers.last_name', 'like', "%$search%")
                    ->orWhere('customers.email', 'like', "%$search%")
                    ->orWhere('customers.phone', 'like', "%$search%")
                    ->orWhere('policies.name', 'like', "%$search%")
                    ->orWhere('providers.name', 'like', "%$search%");
        });

    }

    public function scopeStatus($query, $status)
    {
        $query->when($status ?? false, function ($query, $status){
           $query->where('attended', $status);
        });
    }
    public function scopeHistory($query, $customer)
    {
        $query->when($customer ?? false, function ($query, $customer){
           $query->where('customer_id', $customer);
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
