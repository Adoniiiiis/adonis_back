<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

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

    public function changeProfileImg(Request $request)
    {
        $raw_file = $request->profileImg;
        $fileName = time().'.'.$raw_file->getClientOriginalName();
        $filePath = 'profileImgs/'.$fileName;

        $file = Image::make($raw_file);
        $file->stream();
        $isFileUploaded = Storage::disk('s3')->put($filePath, $file->__toString());    
        if ($isFileUploaded) {
            $newProfileImg = 'https://d1su1qzc1audfz.cloudfront.net/'.$filePath;
        }

        if ($newProfileImg) {
            User::where('id', $request->userId)->update([
                'profile_img' => $newProfileImg,
                'updated_at' => Carbon::now(),
            ]);

            return response()->json([
                'profile_img' => $newProfileImg,
            ]);
        }
    }

    public function getProfileImg($userId)
    {
        $profileImg = User::where('id', $userId)->get('profile_img');
        return response()->json([
            'profileImg' => $profileImg[0],
        ]);
    }
}
