<?php 

namespace App\Services;

use App\Models\CoffeePot;
use App\Models\Feedback;

class FeedbackService
{   
    public function getUserFeedbacks()
    {
        return [
            "coffeePots" => CoffeePot::get(),
            "feedbacks" => Feedback::where("user_id", auth()->id())
                    ->orderBy('created_at', "DESC")
                    ->with('coffeePot', 'responses')
                    ->get()
        ];
    }

    public function createFeedback($request)
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
    }

    public function getAdminFeedback($coffeePot_id = 0)
    {
        $coffeePots = CoffeePot::get();

        if($coffeePot_id != 0){
            $feedBacks = Feedback::where("coffee_pot_id", $coffeePot_id)
                ->orderBy("created_at", "DESC")
                ->with(['coffeePot', 'user', 'responses'])
                ->get();
        }
        else{
            $feedBacks = Feedback::with(['coffeePot', 'user', 'responses'])->orderBy("created_at", "DESC")->get();
        }

        return [
            "coffeePots" => $coffeePots,
            "feedbacks" => $feedBacks
        ];
    }

    public function createResponse($request, $id)
    {
        $request->validate([
            'text' => ["required", "string", "min:10"]
        ]);

        $feedback = Feedback::findOrFail($id);
        
        $feedback->responses()->create([
            "text" => $request->text
        ]);
    }
}