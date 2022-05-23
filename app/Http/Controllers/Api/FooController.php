<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class FooController extends Controller
{

    public function articles()
    {
        $articles = Article::all()
        ->map(function ($article) {
            return [
                'title' => $article->title,
                'content' => $article->content,
                'author' => $article->user['name'],
            ];
        })->toArray();

        return response()->json(['articles'=>$articles]);
    }


    public function authors()
    {
        $authors = Article::all()
            ->map(function($item){
                return [
                    'author' => $item->user['name'],
                ];
            })->toArray();

        return response()->json(['authors'=>$authors]);
    }



}
