<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);
        $user = User::first();

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['The provided credentials are incorrect.'],
            ]);
        }

        $device = substr($request->userAgent() ?? '', 0, 255);
        $expiresAt = $request->has('remember') ? null : now()->addMinutes(config('session.lifetime'));

        $token = $user->createToken($device, $expiresAt ? [$expiresAt] : [])->plainTextToken;

        return response()->json([
            'access_token' => $token,
        ], Response::HTTP_CREATED);
    }
}
