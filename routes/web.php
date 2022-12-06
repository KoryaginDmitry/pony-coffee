<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware("auth")->group(function(){
    Route::controller(ProfileController::class)->group(function(){
        Route::get("/profile", "ShowProfile")->name("profile");
        Route::post("/update", "update")->name("profile.update");
    });

    Route::controller(NotificationController::class)->group(function(){
        Route::get("/notifications", "showNotifications")->name("showNotifications");
        Route::post("/notifications/read/{id}", "readProcess")->name("readNotification");
    });

    Route::controller(FeedbackController::class)->group(function(){
        Route::get("/feedback", "showForm")->name('showForm');
        Route::post("/feedback/add", "addFeedback")->name('addFeedback');
    });

    Route::controller(AuthController::class)->group(function(){
        Route::get("/logout", "logout")->name("logout");
    });
});

Route::middleware("guest")->group(function(){
    Route::controller(AuthController::class)->group(function(){
        Route::get("/login", "showFormLogin")->name("login");
        Route::get("/register", "showFormRegister")->name("showFormRegister");
        Route::post("/login_process", "login")->name("login_process");
        Route::post("/register_process", "register")->name("register_process");
    });
});

Route::get('/', [homeController::class, "home"])->name("home");



