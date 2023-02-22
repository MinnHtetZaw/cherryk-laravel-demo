<?php

namespace App\Http\Controllers;


use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAuthRequest;
use App\Http\Requests\UpdateAuthRequest;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = ['1','2'];
        $users = User::whereIn('role',$role)->get();
        return AuthResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAuthRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuthRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function show(Auth $auth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuthRequest  $request
     * @param  \App\Models\Auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthRequest $request, Auth $auth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auth $auth)
    {
        //
    }

    public function register(Request $request)
    {
        //
        $user = new User();
        $user->name =$request->name;
        $user->email =$request->email;
        $user->password =Hash::make($request->password);
        $user->save();
        return response()->json([
            "data" =>$user,
        ],200);
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Login Fail!',
            ],422);
        }
        else{
            $user = User::where('email',$request->email)->first();
            $token = $user->createToken('user-auth')->plainTextToken;
            return response()->json([
                'data' =>$token,
                'user'=> Auth::user(),
            ],200);
        }
    }

    public function checkToken(Request $request){

        return response()->json([
            "data" =>Auth::check(),
        ]);
    }

    public function logout()
    {
        //
        $user = Auth::user()->currentAccessToken()->delete();
//        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            "data" =>'Success',
        ]);
    }
}
