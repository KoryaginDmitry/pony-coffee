<?php 

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserBonusesService
{   
    public function getUsers()
    {
        return User::where("role_id", 3)->with(['bonuses' => function($query){
            $query->where("usage", "0")
                ->where(DB::raw("DATEDIFF(NOW(), created_at)"), "<", "30");
        }])->get();
    }

    public function add($id)
    {
        $user = User::where("role_id", 3)->findOrFail($id);

        $user->bonuses()->create([
            "user_id_create" => auth()->id()
        ]);

        return [
            "count" => User::userCountActiveBonuses($user),
            "id" => $id
        ];
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

            $message = "Бонусы списаны";
        }
        else{
            $message = "Недостаточно баллов";
        }

        return [
            "count" => User::userCountActiveBonuses($user),
            "id" => $id,
            "message" => $message,
        ];
    }

    public function searchUser($request)
    {
        if(!empty($request->value)){
            $request->validate([
                "value" => ["required", "string", "min:1", "max:12"]
            ]);

            return User::where("role_id", "3")
                ->where("id", $request->value)
                ->orWhere("phone", $request->value)
                ->with(['bonuses' => function($query){
                    $query->where("usage", "0")
                        ->where(DB::raw("DATEDIFF(NOW(), created_at)"), "<", "30");
                }])
                ->get();
        }
        else{
            return User::where("role_id", 3)->with(['bonuses' => function($query){
                $query->where("usage", "0")
                    ->where(DB::raw("DATEDIFF(NOW(), created_at)"), "<", "30");
            }])->get();
        }
    }
}