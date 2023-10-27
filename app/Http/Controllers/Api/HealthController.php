<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Health\StoreRequest;
use App\Http\Requests\Health\UpdateRequest;
use App\Http\Resources\HealthCollection;
use App\Http\Resources\HealthResource;
use App\Models\Health;
use App\Repositories\HealthRepository;
use Illuminate\Http\Request;

class HealthController extends Controller
{
    private HealthRepository $healthRepository;

    public function __construct(HealthRepository $healthRepository)
    {
        $this->middleware(['api', 'jwt.verify'])->except(['store']);

        $this->healthRepository = $healthRepository;
    }

    public function index(Request $request)
    {
        $health = $this->healthRepository->all();
        return HealthCollection::make($health);
    }

    public function store(StoreRequest $request)
    {
        $health = new Health($request->all());
        $health = $this->healthRepository->save($health);

        if ($request->get('ages')){
            foreach ($request->get('ages') as $k => $v)
            {
                $health->ages()->sync([$health->id=>$v],false);
                //$health->ages()->attach([$health->id=>$v]);
            }
        }


        //$health->ages()->sync([$request->input('ages',[])]);

        return HealthResource::make($health);
    }

    public function update(UpdateRequest $request, Health $health)
    {
        $health->fill($request->all());
        $health = $this->healthRepository->save($health);

        $health->ages()->sync($request->input('ages',[]));

        return HealthResource::make($health);
    }

    public function destroy(Health $health)
    {
        $health = $this->healthRepository->delete($health);

        return HealthResource::make($health);
    }
}
