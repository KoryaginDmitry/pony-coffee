<?php

namespace App\Http\Controllers;

use App\Models\CoffeePot;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function showForm()
    {   
        $coffeePots = CoffeePot::get();
        $feedBacks = Feedback::where("user_id", auth()->id())->orderBy('created_at', "DESC")->with('coffeePot', 'responses')->get();

        return view("pages.user.feedBack", [
            "coffeePots" => $coffeePots,
            "feedbacks" => $feedBacks
        ]);
    }

    public function addFeedback(Request $request)
    {
        $request->validate([
            "coffeePot" => ["required", "exists:coffee_pots,id"],
            "grade" => ["nullable", "min:1", "max:5"],
            "text" => ["required", "string", "min:15"]
        ]);

        Feedback::create([
            "text" => $request->text,
            "grade" => $request->grade,
            "user_id" => auth()->id(),
            "coffee_pot_id" => $request->coffeePot
        ]);

        return redirect()->route('showForm');
    }

    public function adminShowFeedback($id = 0)
    {   
        $coffeePots = CoffeePot::get();

        if($id != 0){
            $feedBacks = Feedback::where("coffee_pot_id", $id)
                ->orderBy("created_at", "DESC")
                ->with(['coffeePot', 'user', 'responses'])
                ->get();
        }
        else{
            $feedBacks = Feedback::with(['coffeePot', 'user', 'responses'])->orderBy("created_at", "DESC")->get();
        }

        return view("pages.admin.feedback", [
            "coffeePots" => $coffeePots,
            "feedbacks" => $feedBacks
        ]);
    }

    public function addResponse(Request $request, $id)
    {
        $request->validate([
            'text' => ["required", "string", "min:10"]
        ]);

        $feedback = Feedback::findOrFail($id);
        
        $feedback->responses()->create([
            "text" => $request->text
        ]);

        return redirect()->route('admin.showFeedback');
    }
}
