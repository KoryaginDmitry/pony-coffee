<?php

use App\Http\Controllers\Admin\BaristaProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\StatisticController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CoffeePotController;
use App\Http\Controllers\NotificationController;

Route::middleware("auth")->group(function(){
    Route::controller(CoffeePotController::class)->group(function(){
        Route::get("/coffeePots", "show")->name("coffeePot.show");
        Route::post("/CoffeePot/add", "add")->name('coffeePot.add');
        Route::post("/CoffeePot/Update/{id}", "update")->name('coffeePot.update');
        Route::post("/CoffeePot/Delete/{id}", "delete")->name('coffeePot.delete');
    });

    Route::controller(BaristaProfileController::class)->group(function(){
        Route::get("/barista", "show")->name("barista.show");
        Route::post("/barista/add", "addUser")->name('barista.add');
        Route::post("/barista/Update/{id}", "updateUser")->name('barista.update');
        Route::post("/barista/Delete/{id}", "deleteUser")->name('barista.delete');
    });

    Route::controller(FeedbackController::class)->group(function(){
        Route::get("/feedback/{coffeePotId?}", "adminShowFeedback")->name('showFeedback');
        Route::post("/feedback/response/{feedback_id}", "addResponse")->name('feedbackResponse');
    });

    Route::controller(NotificationController::class)->group(function(){
        Route::get("/notifications", "showForm")->name('notifications.show');
        Route::post("/notifications/create", "createNotification")->name('notifications.create');
    });

    Route::controller(StatisticController::class)->group(function(){
        Route::get("/coffeePot", "showCoffeePotStatistic")->name("showCoffeePotStatistic");
        Route::get("/users", "showUserStatistic")->name("showUserStatistic");
    });
});



