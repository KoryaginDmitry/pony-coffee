<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;

class SendingMessagesController extends Controller
{
    public function showForm()
    {   
        $notifications = Notifications::orderBy("created_at", "DESC")->get();

        return view("pages.admin.mailing", [
            "notifications" => $notifications
        ]);
    }

    public function sendingProcess(Request $request)
    {
        $request->validate([
            "email" => ["sometimes", "accepted"],
            "sms" => ["sometimes", "accepted"],
            "site" => ["sometimes", "accepted"],
            "text" => ["required", "string", "min:10"]
        ]);

        if(!$request->email && !$request->sms && !$request->site){
            return redirect()->route('admin.showFormSending')->withErrors(["text" => "Выберите метод рассылки"]);
        }

        if($request->email){
            //email рассылка
        }

        if($request->sms){
            //sms рассылка
        }
         
        Notifications::create([
            "email" => $request->email ? "1" : "0",
            "sms" => $request->sms ? "1" : "0", 
            "site" => $request->site ? "1" : "0",
            "text" => $request->text
        ]);

        return redirect()->route('admin.showFormSending');
    }
}
