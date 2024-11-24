<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class DataController extends Controller
{
    //
    function get_data(){
        $data = User::all();
        if(!$data->isEmpty()){
            return $data;
        }
        return "No Data";
    }
    function post_data(Request $req){
        $rules= [
            "first_name"=>"required",
            "last_name"=>"required",
            "age"=>"required|numeric|min:0",
            "address"=>"required",
            "email"=>"required|email|unique:accounts,email",
        ];
        $validator = Validator::make($req->all(),$rules);
        if($validator->fails()){
            return  response()->json($validator->errors(), 400);
        }

        $user = new User;
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->age = $req->age;
        $user->address = $req->address;
        $user->email = $req->email;
        $result = $user->save();
        if($result){
            return "Data has been saved";
        }else{
            return "Something went wrong";
        }
      
    }
    function update_data(Request $req){
        $user = User::find($req->id);
        if(!$user){
            return response()->json(["message"=>"User not found"],404);
        }

        $rules= [
            "first_name"=>"required",
            "last_name"=>"required",
            "age"=>"required|numeric|min:0",
            "address"=>"required",
            "email"=>"required|email",
        ];
        $validator = Validator::make($req->all(),$rules);

        if($validator->fails()){
            return  response()->json($validator->errors(), 400);
        }
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->age = $req->age;
        $user->address = $req->address;
        $user->email = $req->email;
        $saved_result = $user->save();
        if(!$saved_result){
            return response()->json(["message" => "Something went wrong"], 404); 
        }else{
            return response()->json(["message"=>"Update Data Successfully"],200);
        }

    }
    function delete_data($id){
        $user = User::find($id);
        
        if($user){
            $user->delete($id);
            return response()->json(["message"=>"id: ". $id ." deleted successfully"],200);
        }else{
            return response()->json(["message" => "id ".$id. " not found"], 404);     
           }
    }
    function search_data($search){
        $users =  User::where("first_name","like","%".$search."%")
                        ->orwhere("last_name","like","%".$search."%")
                        ->orwhere("address","like","%".$search."%")

                        ->get(); //like and % % to display all data with that character
        if(!$users->isEmpty()){
            return response()->json($users);
        }else{
            return response()->json(["message" => "search: ".$search. " not found"], 404);      
        }
    }
}
