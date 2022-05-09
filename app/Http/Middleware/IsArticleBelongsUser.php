<?php

namespace App\Http\Middleware;

use App\Models\Article;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsArticleBelongsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->authUserCheck($request->id)){
            return $next($request);
        }

        return redirect(route('categories'))->withErrors( 'U don\'t have access to this action');
    }

    /**
     * @param $article_id
     * @return bool
     */
    public function authUserCheck($article_id):bool
    {
        $user = auth()->user();
        $article = Article::find($article_id);

        return $user->id == $article->user_id || $user->role_id == User::ROLE_ADMIN;
    }
}
