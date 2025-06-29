<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function loginPage() {
        if (Auth::check()) {
            return redirect()->route('home.index.page');
        }
        return view("pages.auth.login");
    }

    public function login(LoginRequest $request) {
        $validatedPayload = $request->validated();
        if (Auth::attempt($validatedPayload)) {
            $request->session()->regenerate();

            return redirect()->route('home.index.page');
        }

        return back()->withErrors([
            'generic' => 'The email or password is incorrect.',
        ])->onlyInput('email');
    }

    public function registerPage()
    {
        if (Auth::check()) {
            return redirect()->route('home.index.page');
        }
        return view("pages.auth.register");
    }

    public function register(RegisterRequest $request) {
        $validatedPayload = $request->validated();
        if (empty($validatedPayload)) {
            return back()->withErrors([
                "generic" => "Oops! Something went wrong!",
            ]);
        }

        User::create([
            "username" => $validatedPayload["username"],
            "email" => $validatedPayload["email"],
            "password" => Hash::make($validatedPayload["password"]),
        ]);

        Log::info("User with email {email} registered successfully.", [
            "email" => $validatedPayload["email"],
        ]);

        return redirect()->route("auth.login.page");
    }

    public function logout() {
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect()->route("home.index.page");
    }
}
