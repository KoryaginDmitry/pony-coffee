<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function(){
    Route::controller(ProfileController::class)->group(function(){
        Route::get("/user", "showFormUser")->name("addGuest");
        Route::post("/user_process", "addUserProcess")->name("addUser_process");
    });

    Route::controller(BonusController::class)->group(function(){
        Route::get("/bonuses", "showListUsers")->name("showListUsers");
        Route::post("/bonuses/add/{id}", "add")->name("addBonuses");
        Route::post("/bonuses/use/{id}", "use")->name("useBonuses");
        Route::post("/searchUser", "search")->name('searchUser');
    });
});