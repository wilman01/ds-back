<?php
namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerRepository extends BaseRepository
{
    const RELATIONS =[
        'healths.policy.type',
        'healths.policy'
     ];

    public function __construct(Customer $customer)
    {
        parent::__construct($customer, self::RELATIONS);
    }

    public function all($where = '', $size='', $status=''){
        $query = $this->model;
        $size = is_numeric($size) ? $size : 10;

        $query = $query->with(self::RELATIONS);

        if(!empty($status))
        {
            $query = $query->Status($status);
        }
        return $query->Busqueda($where)
            ->orderBy('id', 'desc')
            ->paginate($size);
    }

}
