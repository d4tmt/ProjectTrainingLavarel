<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\CreateUserRequest;
use App\Http\Requests\user\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
//        dd(User::all());
        $user = DB::table('users')
            ->where('state','=',1)
            ->get();
        return UserResource::collection($user);
    }

    public function create(CreateUserRequest $request){
        $user = User::create([
            'userName' => $request->username,
            'firstName' => $request->firstname,
            'lastName' => $request->lastname,
            'date_of_birth' => $request-> dateofbirth,
            'address' => $request->address,
            'email' => $request->email,
            'state' => 1
        ]);
        dd('addUserSuccess');
    }

    public function update(int $id ,UpdateUserRequest $request){
        $user = User::find($id);
        if($user == null){
            dd('Id does not exist');
        }else{
            $user->userName = $request->username;
            $user->firstName = $request->firstname;
            $user->lastName = $request->lastname;
            $user->date_of_birth = $request->date_of_birth;
            $user->address = $request->address;
            $user->email = $request->email;
            $user->save();
            dd('updateUserSuccess');
        }
    }

    public function show(int $id){
        $user = DB::table('users')
            ->where('id','=',$id)
            ->where('state','=',1)->first();
        if($user != null){
//            dd($user);
//            return response()->json([
//                'id' => $user->id,
//                'username'=>$user->username,
//                'firstname'=>$user->firstname,
//                'lastname'=>$user->lastname,
//                'date_of_birth'=>$user->date_of_birth,
//                'address'=>$user->address,
//                'email'=>$user->email,
//                'password'=>$user->password,
//                'created_at' =>$user->created_at,
//                'updated_at'=>$user->updated_at,
//            ]);
            return new UserResource($user);
        }else{
            dd('Id does not Exist');
        }
    }

    public function delete(int $id){
        $user = User::find($id);
        if($user == null){
            dd('Id does not exist');
        }else{
            $user->state = 2;
            $user->save();
            dd('deleteUserSuccess');
        }
    }
}
