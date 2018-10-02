<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        return view("user.login");
    }

    public function register()
    {
        return view("user.register");
    }

    public function logout()
    {
        Auth::logout();

        return redirect("/");
    }
}
