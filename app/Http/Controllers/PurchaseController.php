<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Show a list of all of the user's purchases.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show()
    {
        $purchases = DB::table('purchases')->select('price', 'km', 'created_at')->get();
        foreach ($purchases as $purchase){
            echo  $purchase;
        }
    }

    public function create(Request $request)
    {
        $plates = DB::table('vehicles')->select('registration_plate as plate')->get();

        return view('purchase.new-purchase')->with('plates',$plates);
    }

    public function destroy(Request $request)
    {
        DB::table('purchases')->where('id', '=', $request->id)->delete();
        return redirect(RouteServiceProvider::HOME);
    }
    public function store(Request $request)
    {
        if ($request->plate == null)
            return redirect(RouteServiceProvider::HOME);

        $userId = Auth::id();
        $vehicleId = DB::table('vehicles')->where('registration_plate',$request->plate)->first()->id;
        $date=date('Y-m-d', strtotime($request->date));

        if (DB::table('purchases')->insert(
            ['user_id'=>$userId, "vehicle_id"=>$vehicleId, "price"=>$request->price, "km"=>$request->km, "litre"=>$request->lt,
                "payment_type"=>$request->payment_type, "p_date"=>$date]
        )){
            return redirect(RouteServiceProvider::HOME);
        }
    }
}
