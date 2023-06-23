<?php
namespace App\Repositories;

use App\Models\Brand;

class BrandRepository extends BaseRepository
{
    // const RELATIONS =[
    //     ''
    // ];

    public function __construct(Brand $brand)
    {
        parent::__construct($brand);
    }

    
}