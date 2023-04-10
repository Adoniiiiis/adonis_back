<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function changeProfile(Request $request)
    {
        $name = $request->profileData['name'];
        $email = $request->profileData['email'];
        $username = $request->profileData['username'];

        if ($name === '') {
            $name = null;
        } else if ($username === '') {
            $username = null;
        }

        User::where('id', $request->profileData['id'])->update([
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'updated_at' => Carbon::now(),
        ]);
    }
}
