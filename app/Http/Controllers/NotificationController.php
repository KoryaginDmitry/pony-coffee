<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;

class NotificationController extends Controller
{
    public function showNotifications()
    {
        $user_id = auth()->id();

        $notifications = Notifications::where("site", "1")
                ->where("users_read_id", NULL)
                ->orWhere("users_read_id", "NOT LIKE", "%[$user_id]%")
                ->orderBy("created_at", "DESC")
                ->get();

        return view("pages.user.notifications", [
            "notifications" => $notifications
        ]);
    }

    public function readProcess($id)
    {
        $notification = Notifications::findOrFail($id);

        $notification->users_read_id =trim($notification->users_read_id . ",[" . auth()->id() . "]", ",");

        $notification->save();

        return redirect()->route('showNotifications');
    }
}
