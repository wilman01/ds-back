<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->middleware(['api', 'jwt.verify'])->except(['index', 'store']);

        $this->customerRepository = $customerRepository;
    }


    public function index(Request $request):CustomerCollection
    {
        $customer = $this->customerRepository->all($request->q, $request->size);

        return CustomerCollection::make($customer);
    }

    public function store(Request $request)
    {
        $request['birthdate'] = $request->birthdate ? Carbon::createFromFormat( 'd/m/Y', $request->birthdate) : null;
    /*    $customer = Customer::firstOrCreate([
            'cedula' => $request->cedula,
        ],
        [
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'birthdate' => $birthdate,
            'phone' => $request->phone,
        ]);*/
        $customer = Customer::Where('cedula',$request->all('cedula'))->first();

        if(is_null($customer)){
            $validator = Validator::make($request->all(), [
                    'cedula' => 'required|string|max:8|unique:customers',
                    'name' => 'required|string|max:55',
                    'last_name' => 'required|string|max:55',
                    'email' => 'required|string|email|unique:customers',
                    'phone' => 'required|string|max:20'
                ]);

            if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
            }

            $customer = new Customer($request->all());
            $customer = $this->customerRepository->save($customer);
        }

        return CustomerResource::make($customer);
    }


    public function show(Customer $customer)
    {
        return CustomerResource::make($customer);
    }



    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'cedula' => 'required|string|max:8|unique:customers,cedula,'.$customer['id'],
            'name' => 'required|string|max:55',
            'last_name' => 'required|string|max:55',
            'email' => 'required|string|email|unique:customers,email,'.$customer['id'],
            'phone' => 'required|string|max:20'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        $customer->fill($request->all());

        $customer = $this->customerRepository->save($customer);

        return CustomerResource::make($customer);
    }

    public function destroy(Customer $customer):CustomerResource
    {
        $customer = $this->customerRepository->delete($customer);

        return CustomerResource::make($customer);
    }
}
