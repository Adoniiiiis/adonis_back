<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $existingUser = User::where('email', $request->email)->first();
        $isPasswordRight = Hash::check($request->password, $existingUser->password);

        if ($existingUser && $isPasswordRight) {
            return response()->json([
                'status' => 'success',
                'userData' => $existingUser,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => '*Email ou mot de passe incorrects'
            ]);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
