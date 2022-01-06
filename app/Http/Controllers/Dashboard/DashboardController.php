<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\PurchasesExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function create()
    {

        if(Auth::check() && Auth::user()->isAdmin()){
            $expenses = DB::table("purchases")
                ->join("users","purchases.user_id","=","users.id")
                ->join("vehicles","purchases.vehicle_id","=","vehicles.id")
                ->select("purchases.id as id","users.name","users.lastname","vehicles.registration_plate","purchases.price","purchases.litre","purchases.km","purchases.p_date","purchases.payment_type")
                ->orderByDesc("purchases.id")
                ->get();
            return view("dashboard.main")->with('expenses',$expenses);
        }
        $expenses = DB::table("purchases")
            ->join("users","purchases.user_id","=","users.id")
            ->join("vehicles","purchases.vehicle_id","=","vehicles.id")
            ->select("purchases.id as id","users.name","users.lastname","vehicles.registration_plate","purchases.price","purchases.litre","purchases.km","purchases.p_date","purchases.payment_type")
            ->orderByDesc("purchases.id")
            ->take(3)
            ->get();
        return view("dashboard.main")->with('expenses',$expenses);
    }

    public function export()
    {
        return Excel::download(new PurchasesExport, 'yakit_gider.xlsx');
    }
}
