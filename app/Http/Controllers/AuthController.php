<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('frontend/login');
    }

    public function register(Request $request)
    {
        return view('frontend/register');
    }

    public function forget_password(Request $request)
    {
        return view('frontend/forget_password');
    }
}
