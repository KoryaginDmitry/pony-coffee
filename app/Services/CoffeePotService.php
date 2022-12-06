<?php 

namespace App\Services;

use App\Models\CoffeePot;
use App\Models\UserCoffeePot;

class CoffeePotService
{   
    public function getCoffeePots()
    {
        return [
            "coffeePots" => CoffeePot::orderBy('created_at', "DESC")->get()
        ];
    }

    public function addCoffeePot($request)
    {
        $request->validate([
            "name" => ["nullable", "string"],
            "address" => ["required", "string"]
        ]);

        CoffeePot::create([
            "name" => $request->name,
            "address" => $request->address
        ]);
    }

    public function updateCoffeePot($request, $id)
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
    }

    public function deleteCoffeePot($id)
    {
        $coffeePot = CoffeePot::findOrFail($id);

        UserCoffeePot::where("coffee_pot_id", $id)->delete();

        $coffeePot->delete();
    }
}