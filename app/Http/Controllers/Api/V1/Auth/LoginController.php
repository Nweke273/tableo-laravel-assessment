<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);

        if (!Auth::attempt(['email' => config('app.email'), 'password' => $request->password])) {
            throw ValidationException::withMessages([
                'password' => ['The provided password is incorrect.'],
            ]);
        }

        $user = Auth::user();

        $device = substr($request->userAgent() ?? '', 0, 255);
        $expiresAt = $request->has('remember') ? null : now()->addMinutes(config('session.lifetime'));

        $token = $user->createToken($device, $expiresAt ? [$expiresAt] : [])->plainTextToken;

        return response()->json([
            'access_token' => $token,
        ], Response::HTTP_CREATED);
    }
}
