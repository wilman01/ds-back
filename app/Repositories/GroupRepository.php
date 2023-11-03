<?php
namespace App\Repositories;

use App\Models\Group;

class GroupRepository extends BaseRepository
{
//    const RELATIONS =[
//    ];

    public function __construct(Group $group)
    {
        parent::__construct($group);
    }

}
