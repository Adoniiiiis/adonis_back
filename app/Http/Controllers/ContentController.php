<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function getRankingCategoryIsBookmarked($contents, $userId) 
    {
        $contentArray = [];
        foreach($contents as $post) {
            $ratingsArray = [];
            foreach ($post->ratings() as $rating) {
                array_push($ratingsArray, $rating->rating);
            }
            $post->ranking = array_sum($ratingsArray);
            $post->category = $post->category();
            $post->isBookmarked = DB::table('bookmarks')->where('user_id', $userId)->where('content_id', $post->id)->exists();
            array_push($contentArray, $post);
        }
        return $contentArray;
    }

    public function getPopularContent($userId)
    {
        $contents = Content::all();
        $contentArray = $this->getRankingCategoryIsBookmarked($contents, $userId);

        usort($contentArray, function($a, $b) {
            return $a['ranking'] < $b['ranking'];
        });

        return response()->json([
            'content' => $contentArray,
        ]);
    }

    public function getContentByCategory($categoryName, $userId)
    {
        $category = Category::where('name', $categoryName)->get('id');
        $contents = Content::where('category_id', $category[0]->id)->get();
        $contentArray = $this->getRankingCategoryIsBookmarked($contents, $userId);

        return response()->json([
            'content' => $contentArray
        ]);
    }

    public function getNewContent($userId)
    {
       $contents = Content::orderBy('created_at','desc')->get();
       $contentArray = $this->getRankingCategoryIsBookmarked($contents, $userId);

        return response()->json([
            'content' => $contentArray
        ]);
    }
}