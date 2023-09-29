<?php
namespace App\Repositories;

use App\Models\Health;

class HealthRepository extends BaseRepository
{
    const RELATIONS =[
        'customer'
    ];
    public function __construct(Health $health)
    {
        parent::__construct($health, self::RELATIONS);
    }

}
