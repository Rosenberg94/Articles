<?php

namespace App\Http\Traits;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ArticleTrait
{
    public function getArticleData(Request $request)
    {
        $user = auth()->user();
        $article_data = $request->except("_token");
        $file = $request->file('image');
        if($file){
            $article_data['image'] = $request->file('image')->store(
                'images', 'public');
        }
        $article_data['user_id'] = $user->id;

        return $article_data;
    }

//    public function editArticleData(Request $request)
//    {
//        $user = auth()->user();
//        $article_data = $request->except("_token");
//        $file = $request->file('image');
//        if ($file) {
//            $article = Article::find($request->article);
//            if(Storage::disk('public')->exists($article->image)){
//                Storage::delete($article->image);
//            }
//            $article_data['image'] = $request->file('image')->store(
//                'images', 'public');
//        }
//        $article_data['user_id'] = $user->id;
//
//        return $article_data;
//    }
}
