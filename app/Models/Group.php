<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_id',
        'group',
        'min_age',
        'max_age',
        'amount',
        'deductible'
    ];

}
