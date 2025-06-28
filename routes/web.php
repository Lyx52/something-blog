<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;

Route::name("auth.")->group(function () {
    Route::get("/login", [AuthController::class, "loginPage"])->name("login.page");
    Route::post("/login", [AuthController::class, "login"])->name("login");

    Route::get("/register", [AuthController::class, "registerPage"])->name("register.page");
    Route::post("/register", [AuthController::class, "register"])->name("register");

    Route::post("/logout", [AuthController::class, "logout"])->name("logout");
});

Route::name("home.")->group(function () {
    Route::get("/", [HomepageController::class, "index"])->name("index.page");
});
