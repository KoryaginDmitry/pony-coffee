<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{   
    private $paths = [
        "admin" => [
            "home" => ["Главная страница", route('home')],
        ],
        "coffeePot" => [
            "home" => ["Главная страница", route('home')],
        ],
        "user" => [
            [
                "text" => "Войти",
                "url" => route('login')
            ],
            [
                "text" => "Войти",
                "url" => route('login')
            ],
            [
                "text" => "Войти",
                "url" => route('login')
            ],
            [
                "text" => "Войти",
                "url" => route('login')
            ],
            [
                "text" => "Войти",
                "url" => route('login')
            ],
        ],
        "guest" => [
            [
                "text" => "Войти",
                "url" => route('login')
            ],
            [
                "text" => "Регистрация",
                "url" => route('register')
            ]
        ]
    ];

    public function getHeader()
    {
        return response()->json($this->paths);
    }
}
