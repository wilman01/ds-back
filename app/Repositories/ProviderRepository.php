<?php
namespace App\Repositories;

use App\Models\Provider;

class ProviderRepository extends BaseRepository
{
    const RELATIONS =[
        'policies'
    ];

    public function __construct(Provider $provider)
    {
        parent::__construct($provider, self::RELATIONS);
    }

}
