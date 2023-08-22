<?php
namespace App\Repositories;

use App\Models\Type;
use Illuminate\Pagination\LengthAwarePaginator;

class TypeRepository extends BaseRepository
{
    const RELATIONS =[
        'policies'
    ];

    public function __construct(Type $type)
    {
        parent::__construct($type, self::RELATIONS);
    }

}
