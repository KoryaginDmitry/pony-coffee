<?php 

namespace App\Services;

use App\Models\CoffeePot;
use App\Models\User;
use App\Models\UserCoffeePot;
use Carbon\Carbon;

class BaristaService
{   
    public function getUsersBarista()
    {
        return [
            "users" => User::where("role_id", "2")
                        ->orderBy('created_at', "DESC")
                        ->with("userCoffeePot.coffeePot")
                        ->get(),
            "coffeePots" => CoffeePot::orderBy('created_at', "DESC")
                        ->get()
        ];
    }

    public function createBarista($request)
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
            UserCoffeePot::create([
                "user_id" => $user->id,
                "coffee_pot_id" => $coffeePot->id
            ]);
        }
    }

    public function updateBarista($request, $id)
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

            UserCoffeePot::updateOrCreate(
                [
                    "user_id" => $user->id
                ],
                [
                    "coffee_pot_id" => $coffeePot->id
                ]
            );
        }
        else {
            UserCoffeePot::where("user_id", $user->id)->delete();
        }
    }

    public function deleteBarista($id)
    {
        $user = User::findOrFail($id);

        $user->delete();
    }
}