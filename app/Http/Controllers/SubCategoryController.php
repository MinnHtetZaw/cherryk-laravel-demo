<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use Illuminate\Http\Request;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subcategories = SubCategory::all();
        $subcategory_lists = array();
        foreach($subcategories as $subcategory){
            $related_category = Category::find($subcategory->category_id);
            $id = $subcategory->id;
            $code = $subcategory->code;
            $name = $subcategory->name;
            $description = $subcategory->description;
            $category = $related_category->name ?? 'Category';
            $category_id = $related_category->id ?? 1;
            $combined = array('id' => $id, 'name' => $name, 'code' => $code, 'description' => $description, 'category' =>$category, 'category_id'=>$category_id);
            array_push($subcategory_lists, $combined);
        }

        return response()->json([
            "data" => $subcategory_lists,
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
     * @param  \App\Http\Requests\StoreSubCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubCategoryRequest $request)
    {
        //
        $request->validate([
           'code'=>'required',
           'name'=>'required',
           'category_id' =>'required'
        ]);
        $subcategory = new SubCategory();
        $subcategory->code = $request->code;
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->description = $request->description;
        $subcategory->save();
        return response()->json([
            "data" => $subcategory,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        return response()->json([
            "data"=>$subCategory,
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubCategoryRequest  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {

        return response()->json([
            "data" => $subCategory,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return response()->json(null);
    }

    public function showSubcategory($id){
        $subcategory = SubCategory::find($id);
        return response()->json([
           'data'=>$subcategory
        ]);
    }

    public function delete($id){
        $subcategory = SubCategory::find($id);
        $subcategory->delete();
        return response()->json([
           'data'=>'Success'
        ]);
    }
    public function updateSubcategory(Request $request){
        $subcategory = SubCategory::find($request->id);
        $subcategory->code = $request->code;
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->description = $request->description;
        $subcategory->update();
        return response()->json([
            'data'=>$subcategory
        ]);
    }
}
