<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employee = Employee::get()->each(function ($employee){
            if ($employee->photo === null){
                $employee->photo =asset('user-default.jpg');

            }else{
                $employee->photo=asset('storage/photo/'.$employee->photo);
            }
        });
        return response()->json([
            "data" => $employee,
        ],200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        //
        // $photo = 'photo_'.uniqid().".".$request->file('photo')->extension();
        // $request->file('photo')->storeAs('public/photo',$photo);
        $employee= new Employee();
        $employee->name = $request->name;
        $employee->type = $request->type;
        $employee->salary = $request->salary;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        // $employee->photo = $photo;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->email = $request->email;
        $employee->save();
        return response()->json([
            "data" => $employee,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
