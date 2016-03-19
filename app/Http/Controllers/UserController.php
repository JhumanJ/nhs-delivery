<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */

    public function __construct(){
        $this->middleware('auth');
    }


    public function addDelivery()
    {
        $users = DB::table('users')->get();

        return view('deliveries.create', ['users' => $users]);
    }

    public static function getUser($id){
        $user = DB::table('users')->where('id', $id)->get();

        return $user;
    }

    public function indexSearchAjax($search){

        //Allows only ajax request
        if (!request()->ajax()){
            return redirect('create');
        }

        //search is the parameter
        if ($search != "" && $search != " " && $search != "all") {
            $users = DB::table('users')->where('firstName','like', '%'.$search.'%')
                                       ->orWhere('lastName', 'like', '%'.$search.'%')
                                       ->get();

            $result = array();
            foreach ($users as $user){
                $array['firstname']=$user->firstName;
                $array['lastname']=$user->lastName;
                $array['id']=$user->id;

                array_push($result,$array);
            }
        } else if($search == "all"){
            $users = DB::table('users')->get();

            $result = array();
            foreach ($users as $user){
                $array['firstname']=$user->firstName;
                $array['lastname']=$user->lastName;
                $array['id']=$user->id;

                array_push($result,$array);
            }
        }


        return response()->json($result);
    }

    public function getProfile(Request $request) {
        $user = $request->user();

        return view('user.profile', [
            'user' => $user,
        ]);
    }

    public function updateProfile(Request $request) {
        $user = $request->user();

        $this->validate($request, [
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'primaryLocation' => 'required|max:255',
            'department' => 'required|max:255'
        ]);

        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->department = $request->department;
        $user->primaryLocation = $request->primaryLocation;


        $user->save();

        return view('user.profile', [
            'user' => $user,
        ]);
    }

}