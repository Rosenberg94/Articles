<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index(Request $request)
    {
        $category_id = $request->category_id;

        if($category_id){
            $articles = Article::where('category_id', $category_id)->get()->sortBy('updated_at');
        } else {
            $articles = Article::all()->sortByDesc('created_at');
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

        return redirect(route('main'));
    }

    public function foo()
    {
        return view('foo');
    }

}
