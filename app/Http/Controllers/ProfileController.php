<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\profileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile()
    {   
        return view("pages.user.profile", [
            "user" => auth()->user()
        ]);
    }

    public function update(profileRequest $request)
    {
        $user = User::find($request->user_id);
        
        if($user->email != $request->email){
            if(User::where("email", $request->email)->exists()){
                return redirect()->route("profile")->withErrors(["email" => "Такой email уже занят"]);
            }

            $user->email = $request->email;
            $user->email_verified_at = NULL;
        }

        if($user->phone != $request->phone){
            if(User::where("phone", $request->phone)->exists()){
                return redirect()->route("profile")->withErrors(["phone" => "Такой номер телефона уже занят"]);
            }

            $user->phone = $request->phone;
            $user->phone_verified_at = NULL;
        }

        $user->name = $request->name;
        $user->last_name = $request->last_name ? $request->last_name : NULL;
        $user->save();

        return redirect()->route("profile");
    }

    public function verficationEmail()
    {

    }

    public function verificationPhone()
    {

    }

    public function showFormUser()
    {
        return view("pages.coffeePot.user");
    }

    public function addUserProcess(Request $request)
    {
        $request->validate([
            "name" => ["required", "string"],
            "phone" => ["required", "regex:/(\+7)[0-9]{10}/", "unique:users"]
        ]);

        User::create([
            "name" => $request->name,
            "phone" => $request->phone,
            "agreement" => "1",
            "role_id" => 3
        ]);

        return redirect()->route("coffeePot.addGuest");
    }
}
