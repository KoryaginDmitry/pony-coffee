<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\loginRequest;
use App\Http\Requests\auth\registerRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        return view("pages.auth.login");
    }

    public function login(loginRequest $request)
    {   
        if(auth()->attempt($request->validated())){
            return redirect()->route("home");
        }
        
        return redirect()->route("login")->withErrors(["phone" => "Ошибка входа. Проверьте корректность введенных данных"]);
    }

    public function ShowFormRegister()
    {
        return view("pages.auth.register");
    }

    public function register(registerRequest $request)
    {   
        $user = User::create([
            "name" => $request->name,
            "phone" => $request->phone,
            "password" => bcrypt($request->password),
            "agreement" => $request->agreement ? "1" : "0", 
            "role_id" => 3
        ]);
        
        if($user){
            auth()->login($user);
            return redirect()->route("profile");
        }
        else{
            return redirect()->route("home");
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route("home");
    }
}
