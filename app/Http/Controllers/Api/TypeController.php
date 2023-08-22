<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Type\StoreRequest;
use App\Http\Requests\Type\UpdateRequest;
use App\Http\Resources\TypeCollection;
use App\Http\Resources\TypeResource;
use App\Http\Resources\TypeWithPoliciesCollection;
use App\Models\Type;
use App\Repositories\TypeRepository;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    private TypeRepository $typeRepository;

    public function __construct(TypeRepository $typeRepository)
    {
        $this->middleware(['api','jwt.verify']);
        $this->typeRepository = $typeRepository;
    }

    public function index(Request $request):TypeCollection
    {
        $type = $this->typeRepository->all($request->q);
        return  TypeCollection::make($type);
    }

    public function store(StoreRequest $request):TypeResource
    {
        $type = new Type($request->all());
        $type = $this->typeRepository->save($type);

        return TypeResource::make($type);
    }

    public function show(Type $type):TypeResource
    {
        return TypeResource::make($type);
    }

    public function update(UpdateRequest $request, Type $type):TypeResource
    {
        $type->fill($request->all());
        $type = $this->typeRepository->save($type);

        return TypeResource::make($type);
    }

    public function withPolicies($policy)
    {
        $type = Type::where('name', $policy)
                ->pluck('id');
        $type = $this->typeRepository->get($type);
        return TypeWithPoliciesCollection::make($type);
    }
}
