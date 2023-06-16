<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\YearRequest;
use App\Http\Requests\YearUpdateRequest;
use App\Http\Resources\YearCollection;
use App\Http\Resources\YearResource;
use App\Models\Year;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class YearController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api', 'jwt.verify']);    
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return YearCollection::make(Year::all());
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
    public function store(YearRequest $request)
    {
        $year = Year::create([
            'year' => $request->get('year')
        ]);

        return YearResource::make($year);
    }

    /**
     * Display the specified resource.
     */
    public function show(Year $year)
    {
        return YearResource::make($year);
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
    public function update(Request $request, Year $year)
    {
        $validator = Validator::make($request->all(),[
            'year' => 'required|string|max:4|unique:years,year,'.$year->id
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }
        
        $year->update($request->all());

        return YearResource::make($year);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
