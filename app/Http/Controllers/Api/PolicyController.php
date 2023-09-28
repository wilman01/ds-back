<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Policy\StoreRequest;
use App\Http\Requests\Policy\UpdateRequest;
use App\Http\Resources\PolicyCollection;
use App\Http\Resources\PolicyResource;
use App\Models\Policy;
use App\Repositories\PolicyRepository;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    private PolicyRepository $policyRepository;

    public function __construct(PolicyRepository $policyRepository)
    {
        $this->middleware(['api', 'jwt.verify'])->except(['index','show']);
        $this->policyRepository = $policyRepository;
    }

    public function index(Request $request)
    {
        $policy = $this->policyRepository->all($request->q, $request->size);
        return PolicyCollection::make($policy);
    }

    public function store(StoreRequest $request)
    {
        $policy = new Policy($request->all());
        $policy = $this->policyRepository->save($policy);

        $policy->details()->sync($request->input('details', []));

        return PolicyResource::make($policy);
    }

    public function show(Policy $policy)
    {
        return PolicyResource::make($policy);
    }

    public function update(UpdateRequest $request, Policy $policy)
    {
        $policy->fill($request->all());
        $policy = $this->policyRepository->save($policy);

        $policy->details()->sync($request->input('details', []));
        return PolicyResource::make($policy);
    }

    public function destroy(Policy $policy):PolicyResource
    {
        $policy = $this->policyRepository->delete($policy);

        return PolicyResource::make($policy);
    }
}
