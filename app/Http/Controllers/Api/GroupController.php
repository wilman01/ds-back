<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Group\StoreRequest;
use App\Http\Requests\Group\UpdateRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Repositories\GroupRepository;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    private GroupRepository $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->middleware(['api', 'jwt.verify']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $group = new Group($request->all());

        $group = $this->groupRepository->save($group);

        return GroupResource::make($group);
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        return GroupResource::make($group);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Group $group)
    {
        $group->fill($request->all());
        $group = $this->groupRepository->save($group);

        return GroupResource::make($group);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group = $this->groupRepository->delete($group);

        return GroupResource::make($group);
    }
}
