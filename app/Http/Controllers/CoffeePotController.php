<?php

namespace App\Http\Controllers;

use App\Models\CoffeePot;
use App\Models\User;
use App\Models\UserCoffeePotPivot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CoffeePotController extends Controller
{
    public function show()
    {   
        $coffeePots = CoffeePot::orderBy('created_at', "DESC")->get();
        $users = User::where("role_id", "2")->orderBy('created_at', "DESC")->with("userCoffeePot.coffeePot")->get();
        
        return view("pages.admin.coffeePot.show", [
            "coffeePots" => $coffeePots,
            "users" => $users
        ]);
    }

    public function addCoffeePot(Request $request)
    {
        $request->validate([
            "name" => ["nullable", "string"],
            "address" => ["required", "string"]
        ]);

        CoffeePot::create([
            "name" => $request->name,
            "address" => $request->address
        ]);

        return redirect()->route('admin.CoffeePotProfilesShow');
    }

    public function updateCoffeePot(Request $request, $id)
    {   
        $request->validate([
            "name" => ["nullable", "string"],
            "address" => ["required", "string"]
        ]);

        $coffeePot = CoffeePot::findOrFail($id);

        $coffeePot->update([
            "name" => $request->name,
            "address" => $request->address
        ]);

        return redirect()->route('admin.CoffeePotProfilesShow');
    }

    public function deleteCoffeePot($id)
    {
        $coffeePot = CoffeePot::findOrFail($id);

        UserCoffeePotPivot::where("coffee_pot_id", $id)->delete();

        $coffeePot->delete();

        return redirect()->route('admin.CoffeePotProfilesShow');
    }

    public function addUser(Request $request)
    {
        $request->validate([
            "name" => ["required", "string"],
            "last_name" => ["nullable", "string"],
            "phone" => ["required", "regex:/(\+7)[0-9]{10}/"],
            "password" => ["required", "string"]
        ]);

        $coffeePot = CoffeePot::find($request->coffeePot);

        $user = User::create([
            "name" => $request->name,
            "last_name" => $request->last_name,
            "phone" => $request->phone,
            "phone_verified_at" => Carbon::now(),
            "password" => bcrypt($request->password),
            "agreement" => "1",
            "role_id" => "2"
        ]);

        if($coffeePot){
            UserCoffeePotPivot::create([
                "user_id" => $user->id,
                "coffee_pot_id" => $coffeePot->id
            ]);
        }

        return redirect()->route('admin.CoffeePotProfilesShow');
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            "name" => ["required", "string"],
            "last_name" => ["nullable", "string"],
            "phone" => ["required", "regex:/(\+7)[0-9]{10}/"],
        ]);

        $user = User::findOrFail($id);

        $user->update([
            "name" => $request->name,
            "last_name" => $request->last_name,
            "phone" => $request->phone
        ]);

        if($request->coffeePot != 0){
            $coffeePot = CoffeePot::find($request->coffeePot);

            UserCoffeePotPivot::updateOrCreate(
                [
                    "user_id" => $user->id
                ],
                [
                    "coffee_pot_id" => $coffeePot->id
                ]
            );
        }

        return redirect()->route('admin.CoffeePotProfilesShow');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.CoffeePotProfilesShow');
    }
}
