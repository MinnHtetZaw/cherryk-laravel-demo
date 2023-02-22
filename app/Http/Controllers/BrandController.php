<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Category;
use App\Models\SubCategory;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = Brand::all();

        $brand_lists = array();
        foreach($brands as $brand){
            $related_category = Category::find($brand->category_id);
            $related_subcategory = SubCategory::find($brand->sub_category_id);
            $id = $brand->id;
            $code = $brand->code;
            $name = $brand->name;
            $description = $brand->description;
            $category = $related_category->name ?? 'Category';
            $category_id = $related_category->id ?? '1';
            $subcategory = $related_subcategory->name ?? 'Subcategory';
            $subcategory_id = $related_subcategory->id ?? '1';
            $combined = array('id' => $id, 'name' => $name, 'code' => $code, 'description' => $description, 'category' =>$category,'category_id'=>$category_id,
                'subcategory'=>$subcategory,'subcategory_id'=>$subcategory_id);
            array_push($brand_lists, $combined);
        }
        return response()->json([
            "data" => $brand_lists,
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        //
        $request->validate([
           'code'=>'required',
           'name'=>'required',
        ]);
        $brand = new Brand();
        $brand->code = $request->code;
        $brand->name = $request->name;
        $brand->category_id = $request->category_id;
        $brand->sub_category_id = $request->sub_category_id;
        $brand->description = $request->description;
        $brand->save();
        return response()->json([
            "data" => $brand,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return response()->json([
            "data" => $brand,
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->code = $request->code;
        $brand->name = $request->name;
        $brand->category_id = $request->category_id;
        $brand->sub_category_id = $request->sub_category_id;
        $brand->description = $request->description;
        $brand->update();
        return response()->json([
            "data" => $brand,
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
        $brand->delete();
        return response()->json(null);
    }

    public function delete($id){
        $brand = Brand::find($id);
        $brand->delete();
        return response()->json([
            'data'=>'Success'
        ]);
    }
}
