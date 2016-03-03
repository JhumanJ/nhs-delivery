<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

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

}