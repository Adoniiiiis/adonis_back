<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Quotes;
use App\Models\Ranking;
use App\Models\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function updateRanking(Request $request)
    {
        $alreadyRated = DB::table('rankings')->where('user_id', $request->userId)->where('content_id', $request->postId)->exists();
        if ($alreadyRated) {
            Ranking::where('user_id', $request->userId)->where('content_id', $request->postId)->delete();
            if ($request->newValue !== 0) {
                Ranking::insert([
                    'user_id' => $request->userId,
                    'content_id' => $request->postId,
                    'rating' => $request->newValue
                ]);
            }
        } else {
            Ranking::insert([
                'user_id' => $request->userId,
                'content_id' => $request->postId,
                'rating' => $request->newValue
            ]);
        }
    }
}            