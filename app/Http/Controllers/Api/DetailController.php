<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Detail\StoreRequest;
use App\Http\Requests\Detail\UpdateRequest;
use App\Http\Resources\DetailCollection;
use App\Http\Resources\DetailResource;
use App\Models\Detail;
use App\Repositories\DetailRepository;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    private DetailRepository $detailRepository;

    public function __construct(DetailRepository $detailRepository)
    {
        $this->middleware(['api', 'jwt.verify']);
        $this->detailRepository = $detailRepository;

    }

    public function index(Request $request)
    {
        $details = $this->detailRepository->all();
        return DetailCollection::make($details);
    }

    public function store(StoreRequest $request)
    {
        $detail = new Detail($request->all());
        $detail = $this->detailRepository->save($detail);

        return DetailResource::make($detail);
    }

    public function show(Detail $detail)
    {
        return DetailResource::make($detail);
    }

    public function update(UpdateRequest $request, Detail $detail)
    {
        $detail->fill($request->all());
        $detail = $this->detailRepository->save($detail);

        return DetailResource::make($detail);
    }

    public function destroy(Detail $detail)
    {
        $detail = $this->detailRepository->delete($detail);

        return DetailResource::make($detail);
    }
}
