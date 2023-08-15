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
            ->select('quotations.id',
                'quotations.type_id',
                'quotations.supplier',
                'quotations.policy',
                'quotations.customer_id',
                'customers.cedula',
                'customers.name',
                'customers.last_name',
                'customers.email',
                'customers.phone')
            ->join('customers', 'quotations.customer_id', '=', 'customers.id')
            ->when($q ?? false, function($query, $busqueda){
                $query->where('quotations.supplier', 'LIKE', "%$busqueda%");
                $query->orWhere('customers.cedula', 'LIKE', "%$busqueda%");
                $query->orWhere('customers.name', 'LIKE', "%$busqueda%");
                $query->orWhere('customers.last_name', 'LIKE', "%$busqueda%");

            })
            ->orderBy('quotations.id', 'desc')
            ->paginate(10);
        return $querybuilder;
     }
}
