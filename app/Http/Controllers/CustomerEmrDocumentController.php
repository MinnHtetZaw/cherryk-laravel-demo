<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerEmrDocumentRequest;
use App\Http\Requests\UpdateCustomerEmrDocumentRequest;
use App\Models\CustomerEmrDocument;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class CustomerEmrDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerEmrDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerEmrDocumentRequest $request)
    {
        $request->validate([
            'customer_emr_id'=>'required',
            'file'=>'required',
        ]);
        $date = Carbon::now()->toDateString();
        $document = new CustomerEmrDocument();
        if ($request->file('file')){
            $extension = $request->file('file')->extension();
            $newName='file_'.uniqid().".".$extension;
            $request->file('file')->storeAs('public/document',$newName);

            $document->file = $newName;
            $document->customer_emr_id = $request->customer_emr_id;
            $document->type = $extension;
            $document->date = $date;
            $document->save();
        }

        return response()->json([
            'data'=> $document,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerEmrDocument  $customerEmrDocument
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerEmrDocument $customerEmrDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerEmrDocumentRequest  $request
     * @param  \App\Models\CustomerEmrDocument  $customerEmrDocument
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerEmrDocumentRequest $request, CustomerEmrDocument $customerEmrDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerEmrDocument  $customerEmrDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerEmrDocument $customerEmrDocument)
    {
        //
    }
}
