<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehiversionCollection;
use App\Repositories\RelationshipvehiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class VehiversionController extends Controller
{
    private $relationshipRepository;
    public function __construct(RelationshipvehiRepository $relationshipRepository)
    {
        $this->middleware(['api', 'jwt.verify'])->except('index');    

        $this->relationshipRepository = $relationshipRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    { 

        // if(!$request->vehi_model_id){
        //     return response()->json(
        //         [
        //             'ERROR'=>'Debe indicar el Id del Modelo de las Versiones que desea consultar'
        //         ],400);
        // }

        // $where = [
        //     ['vehi_model_id', $request->vehi_model_id],
          
        // ];


        $version = $this->relationshipRepository->search($request);
  
        return VehiversionCollection::make($version);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
