<?php

namespace App\Http\Controllers;

use App\Services\UserBonusesService;
use Illuminate\Http\Request;

class BonusController extends Controller
{   
    public function __construct(protected UserBonusesService $service){

    }

    public function showListUsers()
    {   
        return view("pages.coffeePot.bonuses", [
            "users" => $this->service->getUsers()
        ]);
    }

    public function add($id)
    {   
        return response()->json($this->service->add($id));
    }

    public function use($id)
    {
        return response()->json($this->service->use($id));
    }

    public function search(Request $request)
    {   
        return response()
                ->view("components.coffeePot.bonuses.table", [
                    "users" => $this->service->searchUser($request)
                ], 200)->header("Content-Type", "html");
    }
}
