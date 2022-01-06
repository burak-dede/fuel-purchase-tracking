<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class PersonelController extends Controller
{
    public function show()
    {
        $users = DB::table("users")->get();
        $vehicles = Vehicle::all();
        return view("dashboard.personels-and-vehicles")->with('users',$users)->with('vehicles',$vehicles);
    }

    public function create()
    {
        return view("dashboard.new-personel");
    }

    public function destroy(Request $request)
    {
        User::destroy($request->id);

        return redirect(RouteServiceProvider::PERSONELSANDVEHICLES);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required','min:5'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect(RouteServiceProvider::PERSONELSANDVEHICLES);
    }
}
