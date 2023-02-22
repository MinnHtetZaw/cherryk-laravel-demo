<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestPhotoRequest;
use App\Http\Requests\UpdateTestPhotoRequest;
use App\Http\Resources\TestPhotoResource;
use App\Models\TestPhoto;

class TestPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testPhoto = TestPhoto::all();
        return TestPhotoResource::collection($testPhoto);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTestPhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestPhotoRequest $request)
    {
        $testPhoto = new TestPhoto();
//        if ($request->file('photo')){
//            $newName='photo_'.uniqid().".".$request->file('photo')->extension();
//            $request->file('photo')->storeAs('public/photo',$newName);
//            $testPhoto->photo = $newName;
//        }
        $testPhoto->photo = $request->photo;
        $testPhoto->save();
        return response()->json([
            'data'=> 'Success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TestPhoto  $testPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(TestPhoto $testPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTestPhotoRequest  $request
     * @param  \App\Models\TestPhoto  $testPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestPhotoRequest $request, TestPhoto $testPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TestPhoto  $testPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(TestPhoto $testPhoto)
    {
        //
    }
}
