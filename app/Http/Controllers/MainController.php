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
            $articles = Article::where('category_id', $category_id)->orderByDesc('created_at')->paginate(10);
        } elseif($user_id) {
              $articles = Article::where('user_id', $user_id)->orderByDesc('created_at')->paginate(10);
        } else{
            $articles = Article::orderByDesc('created_at')->paginate(10);
        }
        $categories = Category::all();

        return view('main', ['articles' => $articles, 'categories' => $categories]);
    }

    public function foo()
    {


        $articles = Article::has('comments', '>', 10)->get();
        dump($articles);

        return view('foo',['articles' => $articles]);

//       $article = Article::find(5);
//       dump(count($article->comments));
//
//        return view('foo');
    }


    private function __articleImageDestroy($request)
    {
        $user = User::find($request->user);
        if (isset($user->image)){
            if(Storage::disk('public')->exists($user->image)){
                Storage::delete($user->image);
            }
        }
    }

}
