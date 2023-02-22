<?php

namespace App\Http\Controllers;

use App\Models\EmrDocument;
use App\Http\Requests\StoreEmrDocumentRequest;
use App\Http\Requests\UpdateEmrDocumentRequest;

class EmrDocumentController extends Controller
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
     * @param  \App\Http\Requests\StoreEmrDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmrDocumentRequest $request)
    {
        //
        $emr_doc = new EmrDocument();
        $emr_doc->previous_emr_id = $request->previous_emr_id;
        $emr_doc->type = $request->type;
        $emr_doc->file = $request->file;
        $emr_doc->save();
        return response()->json([
            "data" => $emr_doc,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmrDocument  $emrDocument
     * @return \Illuminate\Http\Response
     */
    public function show(EmrDocument $emrDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmrDocumentRequest  $request
     * @param  \App\Models\EmrDocument  $emrDocument
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmrDocumentRequest $request, EmrDocument $emrDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmrDocument  $emrDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmrDocument $emrDocument)
    {
        //
    }
}
