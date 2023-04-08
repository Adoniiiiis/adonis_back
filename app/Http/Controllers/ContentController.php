<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\Ranking;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

            $alreadyRatedByUser = Ranking::where('user_id', $userId)->where('content_id', $post->id)->first();
            if ($alreadyRatedByUser) {
                $post->userRating = $alreadyRatedByUser->rating;
            } else {
                $post->userRating = null;
            }

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
   
    public function createContent(Request $request)
    {
        $categoryId = Category::where('name', $request->finalObject["category"])->get('id')[0]->id;
        $content = Content::create([
            'category_id' => $categoryId,
            'author' => $request->finalObject["author"] ?? null,
            'title' => $request->finalObject["title"] ?? null,
            'tag_page' => $request->finalObject["tag_page"] ?? null,
            'tag_time' => $request->finalObject["tag_time"] ?? null,
            'subtitle' => $request->finalObject["subtitle"] ?? null,
            'quote' => $request->finalObject["quote"] ?? null,
            'link' => $request->finalObject["link"] ?? null,
        ]);
        $content->save();
        return response()->json([
            'content' => $content
        ]);
    }
}