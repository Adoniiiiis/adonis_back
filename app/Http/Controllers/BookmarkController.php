<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        $userBookmarks = Bookmark::where('user_id', $userId)->get();
        $bookmarks = [];
        foreach ($userBookmarks as $userBookmark) {
            $content = $userBookmark->content();
            $content->category = $content->category();
            $content->isBookmarked = true;
            $ratings = $content->ratings();
            $ratingsArray = [];
            foreach ($ratings as $rating) {
                array_push($ratingsArray, $rating->rating);
            }
            $content->ranking = array_sum($ratingsArray);
            array_push($bookmarks, $content);
        }

        return response()->json([
            'content' => $bookmarks
        ]);
    }

    public function updateBookmark(Request $request)
   {
        $isBookmarked = Bookmark::where('user_id', $request->userId)->where('content_id', $request->postId)->first();
        if ($isBookmarked) {
            $isBookmarked->delete();
        } else {
            Bookmark::insert([
                'user_id' => $request->userId,
                'content_id' => $request->postId
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
