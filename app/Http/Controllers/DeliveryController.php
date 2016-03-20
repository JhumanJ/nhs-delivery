<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\User;
use Illuminate\Http\Request;
use DB;
use Image;
use Mail;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
            'image'       => 'required|image',
        ]);

        //default status is awaiting
        $request->status = 1;
        $request->created_at = \Carbon\Carbon::now()->toDateTimeString();
        $request->updated_at = \Carbon\Carbon::now()->toDateTimeString();

        $id = DB::table('deliveries')->insertGetId([
            'user_id'     => $request->user_id,
            'status'      => $request->status,
            'reference'   => $request->reference,
            'description' => $request->description,
            'size'        => $request->size,
            'weight'      => $request->weight,
            'created_at'  => $request->created_at,
            'updated_at'  => $request->updated_at,
        ]);

        Image::make($request->file('image'))->save(storage_path().'/app/public/img/deliveries/'.$id.'.jpg',60);

//        $user = User::find($request->user_id);
//        $delivery = Delivery::find($id);
//
//        Mail::send('emails.new', ['user' => $user, 'delivery' => $delivery], function ($m) use ($user) {
//            $m->from('nhsdelivery@unisales.co.uk', 'NHS Delivery');
//
//            $m->to($user->email, $user->firstName. $user->lastName)->subject('Package waiting at Reception');
//        });

        return redirect('/deliveries-all');

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
                $array['id']            =$delivery->id;
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
                $array['id']            =$delivery->id;
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
        DB::table('deliveries')
            ->where('id', $delivery)
            ->update(['status' => 0, 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
//
//        $deliveryToCancel = Delivery::find($delivery);
//        $user = User::find($deliveryToCancel->user_id);
//
//        Mail::send('emails.cancel', ['user' => $user, 'delivery' => $deliveryToCancel], function ($m) use ($user) {
//            $m->from('nhsdelivery@unisales.co.uk', 'NHS Delivery');
//
//            $m->to($user->email, $user->firstName. $user->lastName)->subject('Package Cancelled');
//        });

        return redirect('/deliveries-all');
    }

    public function collect(Request $request, $delivery) {

        $this->validate($request, [
            'signature'     => 'required',
        ]);

        $image = $request->signature;

        $image = Image::make($image)->save(storage_path().'/app/public/img/signatures/'.$delivery.'.png');


        DB::table('deliveries')
            ->where('id', $delivery)
            ->update(['status' => 2, 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);

//        $deliveryToCollect = Delivery::find($delivery);
//        $user = User::find($deliveryToCollect->user_id);
//
//        Mail::send('emails.collect', ['user' => $user, 'delivery' => $deliveryToCollect], function ($m) use ($user) {
//            $m->from('nhsdelivery@unisales.co.uk', 'NHS Delivery');
//
//            $m->to($user->email, $user->firstName. $user->lastName)->subject('Package Collected');
//        });

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

//        $deliveryToEdit = Delivery::find($request->id);
//        $user = User::find($deliveryToEdit->user_id);
//
//        Mail::send('emails.edit', ['user' => $user, 'delivery' => $deliveryToEdit], function ($m) use ($user) {
//            $m->from('nhsdelivery@unisales.co.uk', 'NHS Delivery');
//
//            $m->to($user->email, $user->firstName. $user->lastName)->subject('Package Information Edited');
//        });

        return redirect('/deliveries-all');


    }



}
