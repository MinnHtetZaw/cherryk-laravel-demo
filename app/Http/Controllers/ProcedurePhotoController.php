<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProcedurePhotoResource;
use App\Models\ProcedurePhoto;
use App\Http\Requests\StoreProcedurePhotoRequest;
use App\Http\Requests\UpdateProcedurePhotoRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProcedurePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photo = ProcedurePhoto::all();
        return ProcedurePhotoResource::collection($photo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProcedurePhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedurePhotoRequest $request)
    {
        $procedurePhoto = new ProcedurePhoto();
        $image = str_replace('data:image/png;base64,', '', $request->photo);
        $image = str_replace(' ', '+', $image);
        $imageName = uniqid().'.'.'png';
        Storage::disk('public')->put($imageName, base64_decode($image));
        $procedurePhoto->photo = $imageName;
        $procedurePhoto->procedure_id = $request->procedure_id;
        $procedurePhoto->save();
        return response()->json([
            "data" => 'Success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedurePhoto  $procedurePhoto
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedurePhoto $procedurePhoto)
    {
        if($procedurePhoto->photo){
		$procedurePhoto->photo = asset('Storage/photo/'.$procedurePhoto->photo);
	};
	return response()->json([
		"data"=> $procedurePhoto,
],200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcedurePhotoRequest  $request
     * @param  \App\Models\ProcedurePhoto  $procedurePhoto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedurePhotoRequest $request, ProcedurePhoto $procedurePhoto)
    {
        $image = str_replace('data:image/png;base64,', '', $request->photo);
        $image = str_replace(' ', '+', $image);
        $imageName = uniqid().'.'.'png';
        Storage::disk('public')->put($imageName, base64_decode($image));
        $procedurePhoto->photo = $imageName;
        $procedurePhoto->update();
        return response()->json([
            'data'=>'Success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedurePhoto  $procedurePhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedurePhoto $procedurePhoto)
    {
        Storage::delete('public/'.$procedurePhoto->photo);
        $procedurePhoto->delete();
        return response()->json([
            'data'=>'Success'
        ]);
    }
}
