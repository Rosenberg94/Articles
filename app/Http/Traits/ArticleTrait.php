<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

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
}
