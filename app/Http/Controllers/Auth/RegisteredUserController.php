<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        $credentials = request(['name', 'username', 'email', 'password']);
        $credentials['password'] = Hash::make($credentials['password']);

        $existingUser = User::where('email', $credentials['email'])->first();
        if ($existingUser) {
            return response()->json([
                'status' => 'error',
                'message' => '*Addresse email déjà utilisée'
            ]);
        } else {
            User::create($credentials);
            return response()->json([
                'status' => 'success',
                'user' => $existingUser
            ]);
        }
    }
}
