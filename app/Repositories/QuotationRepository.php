<?php
namespace App\Repositories;

use App\Models\Quotation;

class QuotationRepository extends BaseRepository
{

    // const RELATIONS =[
    // ];

    public function __construct(Quotation $quotation)
    {
        parent::__construct($quotation);
    }
}
