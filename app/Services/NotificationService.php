<?php 

namespace App\Services;

use App\Models\Notifications;

class NotificationService
{   
    public function getUserNotifications($user_id)
    {
        $notifications = Notifications::where("site", "1")
                ->where("users_read_id", NULL)
                ->orWhere("users_read_id", "NOT LIKE", "%[$user_id]%")
                ->orderBy("created_at", "DESC")
                ->get();

        return [
            "notifications" => $notifications
        ];  
    }

    public function readNotification($id)
    {
        $notification = Notifications::findOrFail($id);

        $notification->users_read_id =trim($notification->users_read_id . ",[" . auth()->id() . "]", ",");

        $notification->save();
    }

    public function getAllNotifications()
    {   
        return [
            "notifications" => Notifications::orderBy("created_at", "DESC")->get()
        ];
    }

    public function createNotification($request)
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
    }
}