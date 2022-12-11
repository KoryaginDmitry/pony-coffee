<?php

namespace App\Http\Controllers;

class homeController extends Controller
{
    public function home()
    {
        return view("main");
    }
}
