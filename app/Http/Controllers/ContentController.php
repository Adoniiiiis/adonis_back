<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function getRankingAndCategory($content) 
    {
        $contentArray = [];
        foreach($content as $post) {
            $ratings = $post->ratings();
            $ratingsArray = [];
            foreach ($ratings as $rating) {
                array_push($ratingsArray, $rating->rating);
            }
            $post->ranking = array_sum($ratingsArray);
            $post->category = $post->category();
            array_push($contentArray, $post);
        }
        return $contentArray;
    }

    public function getPopularContent()
    {
        $content = Content::all();
        $contentArray = $this->getRankingAndCategory($content);

        usort($contentArray, function($a, $b) {
            return $a['ranking'] < $b['ranking'];
        });

        return response()->json([
            'content' => $contentArray,
        ]);
    }

    public function getContentByCategory($categoryName)
    {
        $content = Category::where('name', $categoryName)->contents();
        $contentArray = $this->getRankingAndCategory($content);

        return response()->json([
            'content' => $contentArray,
        ]);
    }

    public function getNewContent()
    {
       $content = Content::orderBy('created_at','desc')->get();
       $contentArray = $this->getRankingAndCategory($content);

        return response()->json([
            'content' => $contentArray
        ]);
    }
}