<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function create()
    {
        return view("dashboard.new-vehicle");
    }

    public function destroy(Request $request)
    {
        Vehicle::where('registration_plate', $request->plate)->delete();

        return redirect(RouteServiceProvider::PERSONELSANDVEHICLES);
    }
    public function store(Request $request)
    {
        $vehicle = new Vehicle;

        $vehicle->registration_plate = $request->plate;

        $vehicle->save();

        return redirect(RouteServiceProvider::PERSONELSANDVEHICLES);
    }

}
