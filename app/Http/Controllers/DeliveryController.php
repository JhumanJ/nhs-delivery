<?php

namespace App\Http\Controllers;

use App\Delivery;
use Illuminate\Http\Request;
use DB;
use Symfony\Component\Console\Input\Input;
use Image;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Check that user is logged
        $this->middleware('auth');
        //Check that user is receptionnist
        //$this->middleware('receptionnist');
    }

    public function index(Request $request)
    {

        $awaiting_deliveries = Delivery::where('user_id', $request->user()->id)
                                ->orderBy('updated_at', 'desc')
                                ->where('status', 1)
                                ->get();

        $past_deliveries = Delivery::where('user_id', $request->user()->id)
                            ->where('status', 2)
                            ->orderBy('updated_at', 'desc')
                            ->get();

        return view('deliveries.index', [
            'awaiting_deliveries' => $awaiting_deliveries,
            'past_deliveries' => $past_deliveries,
        ]);

    }

    //Save new delivery
    public function store(Request $request)
    {

        $this->validate($request, [
            'user_id'     => 'required',
            'reference'   => 'required|max:255',
            'description' => 'required|max:255',
            'size'        => 'required|max:255',
            'weight'      => 'required|max:255',
            'image'       => 'required',
        ]);

        //default status is awaiting
        $request->status = 1;
        $request->created_at = \Carbon\Carbon::now()->toDateTimeString();
        $request->updated_at = \Carbon\Carbon::now()->toDateTimeString();

//        $id = DB::table('deliveries')->insertGetId([
//            'user_id'     => $request->user_id,
//            'status'      => $request->status,
//            'reference'   => $request->reference,
//            'description' => $request->description,
//            'size'        => $request->size,
//            'weight'      => $request->weight,
//            'created_at'  => $request->created_at,
//            'updated_at'  => $request->updated_at,
//        ]);

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $request->file('image')->move(public_path().'/img/deliveries/','test.jpg');
            }
        } else {
            echo 'error: </br>';
            dd($request->all());
            echo "<pre>";
            print_r($_FILES);
            echo '</pre>';
        }

        //$imageName =  'test.'.$request->file('image')->getClientOriginalExtension();

        //$request->file('image')->move(base_path().'/public/img/', $imageName);

        //Image::make($request->input('picture'))->save($filename);
        //echo 'success '.$id;
        //return redirect('/deliveries-all');
    }


    //return all deliveries
    public function indexAll(Request $request) {

        $awaiting_deliveries = Delivery::where('deliveries.status', 1)
                    ->orderBy('deliveries.updated_at', 'desc')
                    ->join('users', 'users.id', '=', 'user_id')
                    ->select(DB::raw("deliveries.id as deliveryId,users.id as userId, deliveries.reference as reference,deliveries.description as description, deliveries.size as size, deliveries.weight as weight, users.firstName as firstName, users.lastName as lastName"))
                    ->get();

        $past_deliveries = Delivery::where('deliveries.status', 2)
                    ->orderBy('deliveries.updated_at', 'desc')
                    ->join('users', 'users.id', '=', 'user_id')
                    ->select(DB::raw("deliveries.id as deliveryId,users.id as userId, deliveries.reference as reference,deliveries.description as description, deliveries.size as size, deliveries.weight as weight, users.firstName as firstName, users.lastName as lastName"))
                    ->get();;

        $cancelled_deliveries = Delivery::where('deliveries.status', 0)
            ->orderBy('deliveries.updated_at', 'desc')
            ->join('users', 'users.id', '=', 'user_id')
            ->select(DB::raw("deliveries.id as deliveryId,users.id as userId, deliveries.reference as reference,deliveries.description as description, deliveries.size as size, deliveries.weight as weight, users.firstName as firstName, users.lastName as lastName"))
            ->get();;

        return view('deliveries.all-index', [
            'awaiting_deliveries'   => $awaiting_deliveries,
            'past_deliveries'       => $past_deliveries,
            'cancelled_deliveries'  => $cancelled_deliveries,
        ]);

    }

    public function indexSearchAjax(Request $request, $search){

        //Allows only ajax request
        if (!request()->ajax()){
            return redirect('deliveries');
        }

        //search is the parameter
        if ($search != "" && $search != " " && $search != "all") {
            $id = $request->getUser();

            $deliveries = DB::table('deliveries')->where('reference','like', '%'.$search.'%')
                ->orderBy('updated_at', 'desc')
                ->where('user_id',$request->user()->id)
                ->whereBetween('status', [1, 2])
                ->orWhere('description', 'like', '%'.$search.'%')
                ->get();

            $result = array();
            foreach ($deliveries as $delivery){
                $array['reference']     =$delivery->reference;
                $array['description']   =$delivery->description;
                $array['size']          =$delivery->size;
                $array['weight']        =$delivery->weight;
                $array['status']        =$delivery->status;

                if($delivery->user_id==$request->user()->id) {
                    array_push($result, $array);
                }
            }
        } else if($search == "all"){
            $deliveries = DB::table('deliveries')->where('user_id',$request->user()->id)
                                ->orderBy('updated_at', 'desc')
                                ->whereBetween('status', [1, 2])
                                ->get();

            $result = array();
            foreach ($deliveries as $delivery){
                $array['reference']     =$delivery->reference;
                $array['description']   =$delivery->description;
                $array['size']          =$delivery->size;
                $array['weight']        =$delivery->weight;
                $array['status']        =$delivery->status;

                if($delivery->user_id==$request->user()->id) {
                    array_push($result, $array);
                }
            }
        }


        return response()->json($result);
    }

    public function destroy(Request $request, $delivery)
    {
        DB::table('deliveries')->where('id',$delivery)->delete();
        return redirect('/deliveries-all');
    }

    public function cancel(Request $request, $delivery) {
        DB:DB::table('deliveries')
            ->where('id', $delivery)
            ->update(['status' => 0, 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
        return redirect('/deliveries-all');
    }

    public function collect(Request $request, $delivery) {
        DB:DB::table('deliveries')
            ->where('id', $delivery)
            ->update(['status' => 2, 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
        return redirect('/deliveries-all');
    }

    public function edit(Request $request) {
        $this->validate($request, [
            'id'          => 'required',
            'reference'   => 'required|max:255',
            'description' => 'required|max:255',
            'size'        => 'required|max:255',
            'weight'      => 'required|max:255',
        ]);

        DB:DB::table('deliveries')
            ->where('id', $request->id)
            ->update([
                    'reference'    => $request->reference,
                    'description'  => $request->description,
                    'size'         => $request->size,
                    'weight'       => $request->weight,
                    'updated_at'   => \Carbon\Carbon::now()->toDateTimeString()]);
        return redirect('/deliveries-all');


    }



}
