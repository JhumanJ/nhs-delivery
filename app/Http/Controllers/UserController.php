<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */

    public function __construct(){
        $this->middleware('receptionnist');
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

}