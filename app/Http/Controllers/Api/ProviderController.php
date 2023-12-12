<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\StoreRequest;
use App\Http\Requests\Provider\UpdateRequest;
use App\Http\Resources\ProviderCollection;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use App\Repositories\ProviderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
    private $providerRepository;

    public function __construct(ProviderRepository $providerRepository)
    {
        $this->middleware(['api', 'jwt.verify'])->except(['index']);

        $this->providerRepository = $providerRepository;
    }


    public function index(Request $request):ProviderCollection
    {
        $provider = $this->providerRepository->all($request->q, $request->size);

        return ProviderCollection::make($provider);
    }

    public function store(StoreRequest $request)
    {
        $provider = new Provider($request->all());
        $provider = $this->providerRepository->save($provider);

        return ProviderResource::make($provider);
    }


    public function show(Provider $provider)
    {
        return ProviderResource::make($provider);
    }



    public function update(UpdateRequest $request, Provider $provider)
    {
        $provider->fill($request->all());

        $provider = $this->providerRepository->save($provider);

        return ProviderResource::make($provider);
    }
}
