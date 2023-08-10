<?php
namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerRepository extends BaseRepository
{
    // const RELATIONS =[
    // ];

    public function __construct(Customer $customer)
    {
        parent::__construct($customer);
    }

}
