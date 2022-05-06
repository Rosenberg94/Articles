<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function createForm(Request $request)
    {
        $article = Article::find($request->id);

        return view('forms.comment.create', ['article' => $article]);
    }

    public function create(Request $request)
    {
        $data = $request->except("_token");
        $request->validate([
            'content' => ['bail', 'required', 'string', 'min:10', 'max:2555'],
        ]);
        $data['user_id'] = auth()->user()->id;
        Comment::create($data);

        return view('forms.article.article', ['article' => Article::find($request->article_id)]);
    }
}
