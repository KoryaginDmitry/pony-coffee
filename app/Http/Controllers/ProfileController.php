<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\profileRequest;
use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{   
    public function __construct(protected ProfileService $service)
    {

    }

    public function showProfile()
    {   
        return view("pages.user.profile", [
            "user" => auth()->user()
        ]);
    }

    public function update(profileRequest $request)
    {   
        $this->service->updateUser($request);

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
        $this->service->baristaCreatesUser($request);

        return redirect()->route("coffeePot.addGuest");
    }
}
