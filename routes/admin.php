<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SendingMessagesController;
use App\Http\Controllers\StatisticController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoffeePotController;

Route::middleware("auth")->group(function(){
    Route::controller(CoffeePotController::class)->group(function(){
        Route::get("/ProfilesCoffeePot", "show")->name("CoffeePotProfilesShow");

        Route::post("/ProfilesCoffeePot/add", "addCoffeePot")->name('addCoffeePot');
        Route::post("/CoffeePot/Delete/{id}", "deleteCoffeePot")->name('deleteCoffeePot');
        Route::post("/CoffeePot/Update/{id}", "updateCoffeePot")->name('updateCoffeePot');

        Route::post("/coffeePot/user/add", "addUser")->name('UserAdd');
        Route::post("/CoffeePot/user/update/{id}", "updateUser")->name('UserUpdate');
        Route::post("/CoffeePot/user/delete/{id}", "deleteUser")->name('UserDelete');
    });

    Route::controller(FeedbackController::class)->group(function(){
        Route::get("/feedback/{coffeePotId?}", "adminShowFeedback")->name('showFeedback');
        Route::post("/feedback/response/{feedback_id}", "addResponse")->name('feedbackResponse');
    });

    Route::controller(SendingMessagesController::class)->group(function(){
        Route::get("/sending", "showForm")->name('showFormSending');
        Route::post("/sending/process", "sendingProcess")->name('sendingProcess');
    });

    Route::controller(StatisticController::class)->group(function(){
        Route::get("/coffeePot", "showCoffeePotStatistic")->name("showCoffeePotStatistic");
        Route::get("/users", "showUserStatistic")->name("showUserStatistic");
    });
});



