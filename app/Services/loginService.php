<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function authenticateUser($password)
    {
        if (Auth::check()) {
            if (Hash::check($password, Auth::user()->password)) {
                return redirect()->intended('quotes-page');
            }
        }

        $user = User::first();
        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
        }
    }
}
