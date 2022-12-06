<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BonusController extends Controller
{
    public function showListUsers()
    {   
        $users = User::where("role_id", 3)->with(['bonuses' => function($query){
            $query->where("usage", "0")
                ->where(DB::raw("DATEDIFF(NOW(), created_at)"), "<", "30");
        }])->get();

        return view("pages.coffeePot.bonuses", [
            "users" => $users
        ]);
    }
    public function add($id)
    {
        $user = User::where("role_id", 3)->findOrFail($id);

        $user->bonuses()->create([
            "user_id_create" => auth()->id()
        ]);

        $bonuses = $user->bonuses()
            ->where("usage", "0")
            ->where(DB::raw("DATEDIFF(NOW(), created_at)"), "<", "30")
            ->get();

        return response()->json([
            "count" => $bonuses->count(),
            "id" => $id
        ]);
    }

    public function use($id)
    {
        $user = User::where("role_id", 3)->findOrFail($id);
        
        $bonuses = $user->bonuses()
                ->where("usage", "0")
                ->where(DB::raw("DATEDIFF(NOW(), created_at)"), "<", "30")
                ->orderBy("created_at", "DESC")
                ->limit(3)
                ->get();
        
        if($bonuses->count() == 3){
            foreach($bonuses as $bonus){
                $bonus->usage = '1';
                $bonus->user_id_wrote = auth()->id();

                $bonus->save();
            }

            $bonuses = $user->bonuses()
                ->where("usage", "0")
                ->where(DB::raw("DATEDIFF(NOW(), created_at)"), "<", "30")
                ->get();

            return response()->json([
                "count" => $bonuses->count(),
                "id" => $id,
                "message" => "Бонусы списаны",
            ]);
        }

        $bonuses = $user->bonuses()
                ->where("usage", "0")
                ->where(DB::raw("DATEDIFF(NOW(), created_at)"), "<", "30")
                ->get();

        return response()->json([
            "count" => $user->bonuses()->count(),
            "id" => $id,
            "message" => "Недостаточно баллов"
        ]);
    }

    public function search(Request $request)
    {   
        if(!empty($request->value)){
            $request->validate([
                "value" => ["required", "min:1", "max:12"]
            ]);

            $users = User::where("role_id", "3")
                ->where("id", $request->value)
                ->orWhere("phone", $request->value)
                ->with(['bonuses' => function($query){
                    $query->where("usage", "0")
                        ->where(DB::raw("DATEDIFF(NOW(), created_at)"), "<", "30");
                }])
                ->get();
        }
        else{
            $users = User::where("role_id", 3)->with(['bonuses' => function($query){
                $query->where("usage", "0")
                    ->where(DB::raw("DATEDIFF(NOW(), created_at)"), "<", "30");
            }])->get();
        }

        if($users){
            return response()
                ->view("components.coffeePot.bonuses.table", [
                    "users" => $users
                ], 200)->header("Content-Type", "html");
        }
    }
}
