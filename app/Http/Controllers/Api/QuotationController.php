<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuotationRequest;
use App\Http\Resources\QuotationCollection;
use App\Http\Resources\QuotationResource;
use App\Models\Quotation;
use App\Repositories\QuotationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuotationController extends Controller
{
    private QuotationRepository $quotationRepository;

    public function __construct(QuotationRepository $quotationRepository)
    {
        $this->middleware(['api', 'jwt.verify'])->except(['index', 'store']);

        $this->quotationRepository = $quotationRepository;
    }

    public function index(Request $request): QuotationCollection
    {
        $where = $request->q ? $request->q : '';
        $quotation = $this->quotationRepository->allQ($where);
        return QuotationCollection::make($quotation);
    }

    public function store(QuotationRequest $request): QuotationResource
    {

        $quotation = Quotation::create([
            'type_id'=>$request->get('type_id'),
            'supplier'=>$request->get('supplier'),
            'customer_id'=>$request->get('customer_id'),
            'policy'=>$request->get('policy'),
        ]);

        return QuotationResource::make($quotation);
    }

    public function show(Quotation $quotation):QuotationResource
    {
        return QuotationResource::make($quotation);
    }

    public function update(Quotation $quotation, Request $request):QuotationResource
    {
        $validator = Validator::make($request->all(),
            [
                'type_id' => 'numeric',
                'supplier' => 'string|max:126',
                'policy' => 'required|string',
            ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        $quotation->fill($request->all());

        $quotation = $this->quotationRepository->save($quotation);

        return QuotationResource::make($quotation);
    }

    public function destroy(Quotation $quotation):QuotationResource
    {
        $quotation = $this->quotationRepository->delete($quotation);

        return QuotationResource::make($quotation);
    }
 }
