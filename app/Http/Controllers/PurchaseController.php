<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Vehicle;
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
        $plates = Vehicle::all('registration_plate as plate');

        return view('purchase.new-purchase')->with('plates',$plates);
    }

    public function destroy(Request $request)
    {
        Purchase::destroy($request->id);
        return redirect(RouteServiceProvider::HOME);
    }

    public function store(Request $request)
    {
        if ($request->plate == null)
            return redirect(RouteServiceProvider::HOME);

        $userId = Auth::id();
        $vehicleId = DB::table('vehicles')->where('registration_plate',$request->plate)->first()->id;
        $date=date('Y-m-d', strtotime($request->date));

        $purchase = new Purchase;
        $purchase->user_id = $userId;
        $purchase->vehicle_id = $vehicleId;
        $purchase->price = $request->price;
        $purchase->km = $request->km;
        $purchase->liter = $request->liter;
        $purchase->payment_type = $request->payment_type;
        $purchase->p_date = $date;

        if ($purchase->save()){
            return redirect(RouteServiceProvider::HOME);
        }
    }
}
