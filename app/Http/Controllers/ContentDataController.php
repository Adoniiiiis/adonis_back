<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Quotes;
use App\Models\User;
use App\Models\Videos;
use Illuminate\Http\Request;

class ContentDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getHomepageContent()
    {
        $books = Books::all();
        $quotes = Quotes::all();
        $videos = Videos::all();

        $homepageContentData = [];
        
        foreach ($books as $book) {
            $book->category = 'book';
            array_push($homepageContentData, $book);
        }
        foreach ($quotes as $quote) {
            $quote->category = 'quote';
            array_push($homepageContentData, $quote);
        }
        foreach ($videos as $video) {
            $video->category = 'video';
            array_push($homepageContentData, $video);
        }
        usort($homepageContentData, function($a, $b) {
            return $a['ranking'] < $b['ranking'];
        });

        return response()->json([
            'contentData' => $homepageContentData,
        ]);
    }

    public function getHomepageSortedContent()
    {
        $books = Books::all()->sortBy('ranking');
        $videos = Videos::all()->sortBy('ranking');
        $quotes = Quotes::all()->sortBy('ranking');

        return response()->json([
            'books' => $books,
            'videos' => $videos,
            'quotes' => $quotes
        ]);
    }

    public function getNewContent()
    {
        $books = Books::all()->sortBy('created_at');
        $videos = Videos::all()->sortBy('created_at');
        $quotes = Quotes::all()->sortBy('created_at');

        $newContentData = [];
        foreach ($books as $book) {
            $book->category = 'book';
            array_push($newContentData, $book);
        }
        foreach ($quotes as $quote) {
            $quote->category = 'quote';
            array_push($newContentData, $quote);
        }
        foreach ($videos as $video) {
            $video->category = 'video';
            array_push($newContentData, $video);
        }
        usort($newContentData, function($a, $b) {
            return strtotime($a['created_at']) < strtotime($b['created_at']);
        });

        return response()->json([
            'contentData' => $newContentData
        ]);
    }
}