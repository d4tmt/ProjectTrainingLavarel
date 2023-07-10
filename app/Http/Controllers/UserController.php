<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\CreateUserRequest;
use App\Http\Requests\user\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index()
    {
//        dd(User::all());

//        $user = DB::table('users')
//            ->where('state','=',1)
//            ->get();
//        return UserResource::collection($user);

        $users = User::where('state', 1)->get();
        return UserResource::collection($users);
    }

    public function create(CreateUserRequest $request)
    {
        $user = User::create([
            'username' => $request->username,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'email' => $request->email,
            'state' => 1 //Không nên để 1 như này, cần dùng enum để chỉ ra ý nghĩa.
        ]);

        return new UserResource($user);
    }

    public function update(int $id, Request $request)
    {
//        $user = User::find($id);
//        if($user == null){                \\Biết check là tốt, nhưng sai cách r :)
//            dd('Id does not exist');
//        }else{
//            $user->userName = $request->username;
//            $user->firstName = $request->firstname;
//            $user->lastName = $request->lastname;
//            $user->date_of_birth = $request->date_of_birth;
//            $user->address = $request->address;
//            $user->email = $request->email;
//            $user->save();
//            dd('updateUserSuccess');
//        }

        //Có thể viết luôn validate như này

        $data = $request->validate([
            'username' => 'required|unique:users',  //Thêm unique để đảm bảo ko bị trùng
            'firstname' => 'required',
            'lastname' => 'required',
            'date_of_birth' => ['required', 'date', 'date_format:d-m-Y'], //Có thể viết như này
            'address' => 'required',
            'email' => 'required|email|unique:users',
        ], [
            'username.required' => 'Name is not null',
            'firstname.required' => 'Firstname is not null',
            'lastname.required' => 'Lastname is not null',
            'date_of_birth.required' => 'Date of birth is not null',
            'date_of_birth.date' => 'Date of birth is invalid',
            'address.required' => 'Address is not null',
            'email.required' => 'Email is not null',
            'email.email' => 'Email is invalid',
        ]);

        try {
            $user = User::findOrFail($id);

            $user->update([
                'username' => $data['username'],
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'date_of_birth' => $data['date_of_birth'],
                'address' => $data['address'],
                'email' => $data['email'],
            ]);

            return new UserResource($user);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function show(int $id)
    {
//        $user = DB::table('users')
//            ->where('id', '=', $id)
//            ->where('state', '=', 1)->first();
//        if ($user != null) {
////            dd($user);
////            return response()->json([
////                'id' => $user->id,
////                'username'=>$user->username,
////                'firstname'=>$user->firstname,
////                'lastname'=>$user->lastname,
////                'date_of_birth'=>$user->date_of_birth,
////                'address'=>$user->address,
////                'email'=>$user->email,
////                'password'=>$user->password,
////                'created_at' =>$user->created_at,
////                'updated_at'=>$user->updated_at,
////            ]);
//            return new UserResource($user);
//        } else {
//            dd('Id does not Exist');
//        }

        try {
            return new UserResource(User::findOrFail($id));
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function delete(int $id)
    {
//        $user = User::find($id);
//        if ($user == null) {
//            dd('Id does not exist');
//        } else {
//            $user->state = 2;
//            $user->save();
//            dd('deleteUserSuccess');
//        }

        try {
            $user = User::findOrFail($id);

            if ($user->delete()) {
                return new UserResource($user); // Nếu xóa thành công thì trả về dữ liệu user bị xóa
            }

            return response()->json('Cannot delete user.');
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
