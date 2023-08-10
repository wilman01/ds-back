<?php
namespace App\Repositories;

use App\Models\Quotation;

class QuotationRepository extends BaseRepository
{

    const RELATIONS =[
        'customer'
    ];

    public function __construct(Quotation $quotation)
    {
        parent::__construct($quotation, self::RELATIONS);
    }

    public function allQ($q)
    {
        $querybuilder = $this->model
            ->join('customers', 'quotations.customer_id', '=', 'customers.id')
            ->when($q ?? false, function($query, $busqueda){
                $query->where('quotations.supplier', 'LIKE', "%$busqueda%");
                $query->orWhere('customers.cedula', 'LIKE', "%$busqueda%");
                $query->orWhere('customers.name', 'LIKE', "%$busqueda%");
                $query->orWhere('customers.last_name', 'LIKE', "%$busqueda%");

            })
            ->paginate(10);
        return $querybuilder;
     }
}
