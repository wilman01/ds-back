<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandStoreRequest;
use App\Http\Resources\BrandCollection;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Status;


class BrandController extends Controller
{
    private $brandRepository;
    public function __construct(BrandRepository $brandRepository)
    {
        $this->middleware(['api', 'jwt.verify'])->except('index');    

        $this->brandRepository = $brandRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $where = [
            ['brand', 'like', "%$request->q%"]
        ];
        $brand = $this->brandRepository->all($where);

        return BrandCollection::make($brand);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandStoreRequest $request)
    {
        $brand = Brand::create([
            'brand'=>$request->get('brand'),
            'status'=>$request->get('status')
        ]);

        return BrandResource::make($brand);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return BrandResource::make($brand);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $validator = Validator::make($request->all(),[
            'brand' => 'required|string|max:55|unique:brands,brand,'.$brand->id,
            'status' => [new Enum(Status::class)]
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }
        
        //$year->update($request->all());

        $brand->fill($request->all());

        $brand = $this->brandRepository->save($brand);

        return BrandResource::make($brand);
    }

}
