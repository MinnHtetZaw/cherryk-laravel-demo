<?php

namespace App\Http\Controllers;

use App\Models\Sympton;
use App\Http\Requests\StoreSymptonRequest;
use App\Http\Requests\UpdateSymptonRequest;

class SymptonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sympton = Sympton::all();
        return response()->json([
            "data" => $sympton,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSymptonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSymptonRequest $request)
    {
        //
        $request->validate([
            'name'=>'required',
            'type'=>'required',
        ]);
        $sympton = new Sympton();
        $sympton->type = $request->type;
        $sympton->name = $request->name;
        $sympton->condition = $request->condition;
        $sympton->description = $request->description;
        $sympton->save();
        return response()->json([
            "data" => $sympton,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sympton  $sympton
     * @return \Illuminate\Http\Response
     */
    public function show(Sympton $sympton)
    {
        return response()->json([
            "data" => $sympton,
        ],200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSymptonRequest  $request
     * @param  \App\Models\Sympton  $sympton
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSymptonRequest $request, Sympton $sympton)
    {
        $request->validate([
            'name'=>'required',
            'type'=>'required',
        ]);
        $sympton->type = $request->type;
        $sympton->name = $request->name;
        $sympton->condition = $request->condition;
        $sympton->description = $request->description;
        $sympton->update();
        return response()->json([
            "data" => $sympton,
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sympton  $sympton
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sympton $sympton)
    {
        $sympton->delete();
        return response()->json([
            "data" => "Success",
        ],200);
    }
}
