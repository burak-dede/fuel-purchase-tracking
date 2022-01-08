<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\PurchasesExport;
use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function create()
    {
        $expenses = Purchase::query()->join("users","purchases.user_id","=","users.id")
            ->join("vehicles","purchases.vehicle_id","=","vehicles.id")
            ->select("purchases.id as id","users.name","users.lastname","vehicles.registration_plate","purchases.price","purchases.liter","purchases.km","purchases.p_date","purchases.payment_type")
            ->orderByDesc("purchases.id");

        if(Auth::check() && Auth::user()->isAdmin()){
            return view("dashboard.main")->with('expenses',$expenses->get());
        }
        return view("dashboard.main")->with('expenses',$expenses->take(3)->get());
    }

    public function export()
    {
        return Excel::download(new PurchasesExport, 'fuel_expenses.xlsx');
    }
}
