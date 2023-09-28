<?php
namespace App\Repositories;

use App\Models\Detail;

class DetailRepository extends BaseRepository
{

    public function __construct(Detail $detail)
    {
        parent::__construct($detail);
    }

}
