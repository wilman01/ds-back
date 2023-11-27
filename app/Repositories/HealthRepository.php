<?php
namespace App\Repositories;

use App\Models\Health;

class HealthRepository extends BaseRepository
{
    const RELATIONS =[
        'customer',
        'policy',
        'type'
    ];
    public function __construct(Health $health)
    {
        parent::__construct($health, self::RELATIONS);
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

    public function allQ($q, $status='', $size='')
    {
        $size = is_numeric($size) ? $size : 10;

        $querybuilder = $this->model
            ->Fields()
            ->join('customers', 'healths.customer_id', '=', 'customers.id')
            ->join('policies', 'healths.policy_id', '=', 'policies.id')
            ->join('providers', 'policies.provider_id', '=', 'providers.id')
            ->join('types', 'policies.type_id', '=', 'types.id')
            ->Busqueda($q);
        if(!empty($status))
        {
           $querybuilder->Status($status);
        }

        return $querybuilder ->orderBy('healths.id', 'desc')
            ->paginate($size);
    }

    public function history($customer)
    {
        $query = $this->model;
        return $query->History($customer)
            ->paginate();
    }

}
