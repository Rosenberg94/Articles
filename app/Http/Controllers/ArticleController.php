<?php

namespace App\Http\Controllers;

use App\Events\ArticleDeleteEvent;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Traits\ArticleTrait;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    use ArticleTrait;

    public function articleShow(Request $request)
    {
        $article = Article::find($request->id);
        $user = auth()->user();
        $user_role = User::ROLE_ADMIN;
        $article->comments = Comment::where('article_id', '=', $article->id)->orderByDesc('created_at')->get();

        return view('forms.article.article', ['comments' => $article->comments,'article' => $article, 'user' => $user, 'user_role' => $user_role]);
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
        $article = Article::find($request->id);

        return view('forms.article.edit', ['article' => $article, 'categories' => $categories]);
    }


    public function articleUpdate(ArticleUpdateRequest $request)
    {
        $article = Article::find($request->id);
        $input = $request->except('_token');
        if ($article){
            $file = $request->file('image');
            if ($file) {
                $this->__articleImageDestroy($request);
                $input['image'] = $request->file('image')->store(
                    'images', 'public');
            }
            $article->update($input);

            return redirect(route('main'))->with('success', 'Article has been successfully edited!');
        }

        return back()->withErrors( 'The article not isset');
    }


    public function destroy(Request $request)
    {
        $article = Article::find($request->id);
        if ($article){
            if($this->__authUserCheck($article)){
                $article->delete();
                event(new ArticleDeleteEvent($article));

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


    public function like(Request $request)
    {
        if ($this->__ifUserHasLike($request->id)) {

            return back()->withErrors('U already has like here!');
        }
        Like::create([
            'user_id' => auth()->user()->id,
            'article_id' => $request->id,
        ]);

        return back()->with('success', 'U liked it');
    }


    private function __ifUserHasLike($article_id)
    {
        $like = Like::where([
           'user_id' => auth()->user()->id,
           'article_id' => $article_id,
        ])->first();

        return $like ? true : false;
    }


    private function __articleImageDestroy($request)
    {
        $article = Article::find($request->article);
        if (isset($article->image)){
            if(Storage::disk('public')->exists($article->image)){
                Storage::delete($article->image);
            }
        }
    }


}
