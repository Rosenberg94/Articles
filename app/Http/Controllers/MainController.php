<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $category_id = $request->category_id;
        $user_id = $request->user_id;

        if($category_id){
            $articles = Article::where('category_id', $category_id)->orderByDesc('created_at')->simplePaginate(10);
        } elseif($user_id) {
              $articles = Article::where('user_id', $user_id)->orderByDesc('created_at')->simplePaginate(10);
        } else{
            $articles = Article::orderByDesc('created_at')->simplePaginate(10);
        }
        $categories = Category::all();

        return view('main', ['articles' => $articles, 'categories' => $categories]);
    }

    public function profileEdit()
    {
        $user = auth()->user();

        return view('auth.editprofile', ['user' => $user]);
    }

    public function profileUpdate(Request $request)
    {
        $input = $request->except('_token');
        $user = User::find($input['id']);
        $user->update($input);

        return redirect(route('main'))->with('success', 'Your profile has been successfully updated!');
    }

    public function foo()
    {
       $article = Article::find(5);
       dump(count($article->comments));

        return view('foo');
    }
}
