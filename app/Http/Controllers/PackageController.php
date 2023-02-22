<?php

namespace App\Http\Controllers;

use App\Models\MedicineProcedure;
use App\Models\Package;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\PackageMedicine;
use App\Models\PackageTreatment;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $package = Package::all();
        return response()->json([
            "data" => $package
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageRequest $request)
    {

        $package = new Package();
        $package->costs = $request->costs;
        $package->total_amount = $request->total_amount;
        $package->name = $request->package_name;
        $package->code = $request->package_code;
        $package->from = $request->from;
        $package->to = $request->to;
        $package->save();

//        Package Treatment
        if ($request->treatment_id){
            $treatment_id = $request->treatment_id;
            $treatment_unit_id = $request->treatment_unit_id;
            $treatment_unit_sale_id = $request->treatment_unit_sale_id;
            $body_part = $request->body_part;
            $treatment_unit_name = $request->treatment_unit_name;
            $treatment_unit_type = $request->treatment_unit_type;
            $treatment_unit_quantity = $request->treatment_unit_quantity;
            $treatment_unit_amount = $request->treatment_unit_amount;
            $treatment_unit_origin_amount = $request->treatment_unit_origin_amount;
            $aa=0;$bb=0;$cc=0;$dd=0;$ee=0;$ff=0;$gg=0;$hh=0;$ii=0;$jj=0;
            foreach ($treatment_id as $treatment){
                $package_treatment = new PackageTreatment();
                $package_treatment->package_id = $package->id;
                $package_treatment->treatment_id = $treatment_id[$aa++];
                $package_treatment->treatment_unit_id = $treatment_unit_id[$bb++];
                $package_treatment->treatment_unit_sale_id = $treatment_unit_sale_id[$cc++];
                $package_treatment->body_part = $body_part[$dd++];
                $package_treatment->treatment_unit_name = $treatment_unit_name[$ee++];
                $package_treatment->treatment_unit_type = $treatment_unit_type[$ff++];
                $package_treatment->treatment_unit_quantity = $treatment_unit_quantity[$gg++];
                $package_treatment->treatment_unit_amount = $treatment_unit_amount[$hh++];
                $package_treatment->treatment_unit_origin_amount = $treatment_unit_origin_amount[$ii++];
                $package_treatment->save();
            }
        }
        if ($request->item_id){
            $item_id = $request->item_id;
            $code = $request->code;
            $duration = $request->duration;
            $name = $request->name;
            $dose_unit = $request->dose_unit;
            $dose_qty = $request->dose_qty;
            $quantity = $request->quantity;
            $price = $request->price;
            $a=0;$b=0;$c=0;$d=0;$e=0;$f=0;$g=0;$h=0;$i=0;$j=0;
            foreach ($item_id as $item){
                $package_medicine = new PackageMedicine();
                $package_medicine->package_id = $package->id;
                $package_medicine->medicine_id = $item_id[$a++];
                $package_medicine->code = $code[$b++];
                $package_medicine->name = $name[$c++];
                $package_medicine->dose_unit = $dose_unit[$d++];
                $package_medicine->dose_quantity = $dose_qty[$e++];
                $package_medicine->duration = $duration[$f++];
                $package_medicine->quantity = $quantity[$g++];
                $package_medicine->origin_price = $price[$h++];
                $package_medicine->package_price = $price[$i++];
                $package_medicine->save();
            }
        }
        return response()->json([
            'data'=> $package,
        ],200);



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageRequest  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        //
    }
}
