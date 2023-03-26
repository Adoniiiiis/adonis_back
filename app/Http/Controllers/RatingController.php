<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Quotes;
use App\Models\Videos;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function updateRanking(Request $request)
    {
        if ($request->category === 'quote') {
            $quote = Quotes::where('id', $request->postId)->first();
            $quote->update([
                'ranking' => $quote->ranking + $request->note
            ]);
        } else if ($request->category === 'book') {
            $book = Books::where('id', $request->postId)->first();
            $book->update([
                'ranking' => $book->ranking + $request->note
            ]);
        } else if ($request->category === 'video') {
            $video = Videos::where('id', $request->postId)->first();
            $video->update([
                'ranking' => $video->ranking + $request->note
            ]);
        }
    }
}
