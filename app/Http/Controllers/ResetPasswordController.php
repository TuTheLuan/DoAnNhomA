<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Where to redirect users after resetting their password.
    protected $redirectTo = '/login';

    // Show the password reset form
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset_custom')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
