<?php

namespace App\Http\Controllers;

use App\Models\CoffeePot;
use App\Models\Feedback;
use App\Services\FeedbackService;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function __construct(protected FeedbackService $service)
    {
        
    }

    public function showForm()
    {   
        return view("pages.user.feedBack", $this->service->getUserFeedbacks());
    }

    public function addFeedback(Request $request)
    {
        $this->service->createFeedback($request);

        return redirect()->route('showForm');
    }

    public function adminShowFeedback($coffeePot_id = 0)
    {   
        return view("pages.admin.feedback", $this->service->getAdminFeedback($coffeePot_id));
    }

    public function addResponse(Request $request, $id)
    {   
        $this->service->createResponse($request, $id);

        return redirect()->route('admin.showFeedback');
    }
}
