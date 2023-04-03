<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
