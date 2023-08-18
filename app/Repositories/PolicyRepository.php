<?php
namespace App\Repositories;

use App\Models\Policy;

class PolicyRepository extends BaseRepository
{
    const RELATIONS =[
    'provider'
    ];

    public function __construct(Policy $policy)
    {
        parent::__construct($policy, self::RELATIONS);
    }

}
