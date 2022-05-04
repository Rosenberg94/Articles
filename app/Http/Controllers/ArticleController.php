<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCreateRequest;
use App\Http\Traits\ArticleTrait;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    use ArticleTrait;

    public function articleShow(Request $request)
    {
        $article_id = $request->id;
        $article = Article::find($article_id);

        return view('forms.article.article', ['article' => $article]);
    }

    public function articleCreateForm(Request $request)
    {
        $categories = Category::all();

        return view('forms.article.create', ['categories' => $categories]);
    }

    public function articleCreate(ArticleCreateRequest $request)
    {
        Article::create($this->getArticleData($request));

        return redirect(route('main'));
    }

    public function articleEditForm(Request $request)
    {
        $categories = Category::all();
        $article_id = $request->id;
        $article = Article::find($article_id);

        return view('forms.article.edit', ['article' => $article, 'categories' => $categories]);
    }

    public function articleUpdate(Request $request)
    {
        $article = Article::find($request->id);
        $input = $request->except('_token');
        if ($article){
            if($this->__authUserCheck($article)) {
                $article->update($input);

                return redirect(route('main'))->with('success', 'Article has been successfully edited!');
            } else {

                return back()->withErrors('You have no access for this action or article is not exist');
            }
        }

        return back()->withErrors( 'The article not isset');
    }

    public function destroy(Request $request)
    {
        $article = Article::find($request->id);
        if ($article){
            if($this->__authUserCheck($article)){
                $article->delete();

                return redirect(route('main'))->with('success', 'Article has been successfully deleted!');
            }
            return back()->withErrors( 'You have no access for this action!');
        }
        return back()->withErrors( 'This article is not exist already!');
    }

    private function __authUserCheck($article)
    {
        $user = auth()->user();

        return $user->id == $article->user_id || $user->role_id == User::ROLE_ADMIN;
    }
}
