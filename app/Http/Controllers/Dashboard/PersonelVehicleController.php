<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vehicle;
use function view;

class PersonelVehicleController extends Controller
{
    public function create()
    {
        $users = User::all();
        $vehicles = Vehicle::all();
        return view("dashboard.personels-and-vehicles")->with('users',$users)->with('vehicles',$vehicles);
    }
}
