<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehimodelRequest;
use App\Http\Resources\VehimodelCollection;
use App\Http\Resources\VehimodelResource;
use App\Models\Brand;
use App\Models\Vehimodel;
use App\Repositories\BrandRepository;
use App\Repositories\VehimodelRepository;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class VehimodelController extends Controller
{
    private $vehiModelRepository;
    private $brandRepository;

    public function __construct(VehimodelRepository $vehiModelRepository, BrandRepository $brandRepository)
    {
        $this->middleware(['api', 'jwt.verify']);    
        $this->vehiModelRepository = $vehiModelRepository;
        $this->brandRepository = $brandRepository;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehimodel = $this->vehiModelRepository->all();
        return VehimodelCollection::make($vehimodel);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehimodelRequest $request)
    {
        $brand = Brand::firstOrCreate([
            'brand'=>$request->get('brand')
        ]);        

        $vehiModel = new Vehimodel([
            'brand_id' => strtoupper($brand->id),
            'model' => strtoupper($request->get('model')),
            'status' => 'active'
        ]);
        
        $vehiModel = $this->vehiModelRepository->save($vehiModel);

        return VehimodelResource::make($vehiModel);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehimodel $vehimodel)
    {
        return VehimodelResource::make($vehimodel);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehimodel $vehimodel)
    {
        $validator = Validator::make($request->all(),[
            'model' => 'string|max:55|unique:vehi_models,model,'.$vehimodel->id
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }
        $vehimodel->fill($request->all());
        $vehimodel = $this->vehiModelRepository->save($vehimodel);
        
        return VehimodelResource::make($vehimodel);
    }

}
