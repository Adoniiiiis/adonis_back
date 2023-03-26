<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function changePassword(Request $request)
    {
        $user = User::where('id', $request->userId)->first();
        $hashedPassword = Hash::make($request->password);

        $user->update([
            'password' => $hashedPassword
        ]);
    }
}
