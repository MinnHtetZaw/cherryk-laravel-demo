<?php

namespace App\Http\Controllers;
use App\Http\Resources\AppointmentResource;
use App\Models\Customer;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $appointment = Appointment::orderBy('date','desc')->get();
        return AppointmentResource::collection($appointment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentRequest $request)
    {
        $appointment = new Appointment();
        if($request->patient_status == 2){
            $customer  = Customer::find($request->patient_name);
            $name = $customer->name;
            $appointment->old_customer_id = $request->patient_name;
            $appointment->patient_name = $name;
            $appointment->title = $name.' Doctor:'.$request->doctor_name;
        }
        if($request->patient_status == 1) {
            $appointment->title = $request->patient_name.'Doctor'.$request->doctor_name;
            $appointment->patient_name = $request->patient_name;
        }
        $appointment->patient_status = $request->patient_status;
        $appointment->doctor_name = $request->doctor_name;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->end = $request->end;
        $appointment->phone = $request->phone;
        $appointment->description = $request->description;
        $appointment->save();
        return  response()->json([
            "data" => $appointment,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return new AppointmentResource($appointment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAppointmentRequest  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
//        if($request->patient_status == 2){
//            $customer  = Customer::find($request->patient_name);
//            $name = $customer->name;
//            $appointment->old_customer_id = $request->patient_name;
//            $appointment->patient_name = $name;
//            $appointment->title = $name.' Doctor:'.$request->doctor_name;
//        }
//        if($request->patient_status == 1) {
//            $appointment->title = $request->patient_name.'Doctor'.$request->doctor_name;
//            $appointment->patient_name = $request->patient_name;
//        }
        $appointment->patient_status = $request->patient_status;
        $appointment->doctor_name = $request->doctor_name;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->end = $request->end;
        $appointment->phone = $request->phone;
        $appointment->description = $request->description;
        $appointment->update();
        return response()->json([
            'data'=>'Success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {

        $appointment->delete();
        return response()->json([
            'data' => 'Success'
        ]);
    }
    public function search(Request $request)
    {
        $appointment = Appointment::where('patient_name',$request->patient_name)
                                   ->orWhere('date',$request->date)
                                   ->orWhere('phone',$request->phone)
                                   ->get();
        return response()->json([
            "data" => $appointment,
            ],200);
    }
}
