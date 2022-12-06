<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\StatisticService;

class StatisticController extends Controller
{   
    public function __construct(protected StatisticService $service)
    {
        
    }

    public function showCoffeePotStatistic()
    {   
        return view("pages.admin.statistics.coffeePot", $this->service->getBarista());
    }

    public function showUserStatistic()
    {
        return view("pages.admin.statistics.users", $this->service->getUsers());
    }
}
