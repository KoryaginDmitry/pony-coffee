<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Services\NotificationService;

class NotificationController extends Controller
{   
    public function __construct(protected NotificationService $service)
    {
        
    }

    public function showNotifications()
    {
        return view("pages.user.notifications", $this->service->getUserNotifications(auth()->id()));
    }

    public function readProcess($id)
    {   
        $this->service->readNotification($id);

        return redirect()->route('showNotifications');
    }

    public function showForm()
    {
        return view("pages.admin.mailing", $this->service->getAllNotifications());
    }

    public function createNotification(Request $request)
    {   
        $this->service->createNotification($request);

        return redirect()->route('admin.notifications.show');
    }
}
