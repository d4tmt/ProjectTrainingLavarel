<?php

namespace App\Http\Controllers;

use App\Http\Requests\animal\CreateAnimalRequest;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class AnimalController extends Controller
{
    public function index()
    {
        dd(Animal:: all());
    }

    public function show(int $id)
    {
        dd(Animal:: find($id));
    }

    public function getAdd(){
        dd(Animal::all());
    }

    public function create(CreateAnimalRequest $request){
        //Cach 1:
//        $validate = Validator::make($request->all(), [], []);

        //Cach 2:
//        $request->validate([
//            'name' => 'required|unique:animal,name|min:2',
//        ],
//        [
//            'name.required' => 'name not null',
//            'name.unique' => 'name is exist',
//        ]);

        $animal = Animal::create([
            'name' => $request->name,
        ]);
    }

    public function update(Request $request){
        Animal::where('id', $request->id)
                ->update(['name'=> $request->name]);
        dd($request);
    }

    public function delete(int $id){
        $animal = Animal::find($id);
        $animal->delete();
        dd($id);
    }
}
