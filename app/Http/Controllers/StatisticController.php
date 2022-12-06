<?php

namespace App\Http\Controllers;

use App\Models\User;

class StatisticController extends Controller
{
    public function showCoffeePotStatistic()
    {   
        $users = User::where("role_id", "2")
            ->with(["bonusesCreate" => function($query){
                $query->selectRaw("*, DATE_FORMAT(created_at, '%d-%m-%Y') AS date");
            }, 
            "bonusesWrote" => function($query){
                $query->selectRaw("*, DATE_FORMAT(updated_at, '%d-%m-%Y') AS date");
            }])
            ->get();

        return view("pages.admin.statistics.coffeePot", [
            "users" => $users
        ]);
    }

    public function showUserStatistic()
    {
        $users = User::where("role_id", "3")
            ->with(["bonuses" => function($query){
                $query->selectRaw("
                    *, DATE_FORMAT(created_at, '%d-%m-%Y') AS date, 
                        CASE 
                            WHEN DATEDIFF(NOW(), created_at) < 30
                                THEN '0'
                            ELSE '1'
                        END AS 'burnt'");
            }])
            ->get();

        return view("pages.admin.statistics.users", [
            "users" => $users
        ]);
    }
}
